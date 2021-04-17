<?php
//memasukkan file config.php
include('/config/config.php');
?>


<div class="container" style="margin-top:20px">
	<center>
		<font size="6">Data Retensi</font>
	</center>
	<hr>
	<form method="POST" action="dashboard.php?page=retensi">
	<button type="submit" name="submit" class="btn btn-dark right">refresh</button>
	</form>
	<!-- <button onclick="trig_print()" class="btn btn-primary right">Print</button> -->



	<div class="table-responsive mt-2">
		<table aria-label="Data Pasien" id="myTable" class="table table-striped jambo_table bulk_action">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Pasien</th>
					<th>Tempat Tanggal Lahir</th>
					<th>Jenis Kelamin</th>
					<th>Profesi</th>
					<th>Kontak</th>
					<th>Alamat</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar

				$tahun = date('Y-m-d', strtotime(' -5 years'));

				$sql = mysqli_query($koneksi, "SELECT * FROM pasien where recent_use <= '$tahun'") or die(mysqli_error($koneksi));
				if (mysqli_num_rows($sql) > 0) {
					while ($data = mysqli_fetch_assoc($sql)) {

						$no_rm = $data['no_rm'];
						$nm_pasien = $data['nm_pasien'];
						$tgl_lahir = $data['tgl_lahir'];
						$alamat = $data['alamat'];
						$no_telpon = $data['no_telp'];
						$pekerjaan = $data['pekerjaan'];
						$tmp_lahir = $data['tmp_lahir'];
						$jenis_klm = $data['jenis_klm'];
						$tgl_daftar = $data['tgl_daftar'];
						$tgl_retensi = date('Y-m-d');

						$sql2 = mysqli_query($koneksi, "SELECT * FROM retensi WHERE no_rm ='$no_rm'") or die(mysqli_error($koneksi));

						if (mysqli_num_rows($sql2) == 0) {
							$sql = mysqli_query($koneksi, "INSERT INTO retensi VALUES('$no_rm','$nm_pasien','$tgl_lahir','$alamat','$no_telpon','$pekerjaan','$tmp_lahir','$jenis_klm','$tgl_daftar','$tgl_retensi','') ") or die(mysqli_error($koneksi));


							// mysqli_query($koneksi, "ALTER TABLE peminjaman NOCHECK CONSTRAINT pasien") or die(mysqli_error($koneksi));
							// mysqli_query($koneksi, "ALTER TABLE pinjam_kembali NOCHECK CONSTRAINT pasien_fk") or die(mysqli_error($koneksi));
							mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS = 0") or die(mysqli_error($koneksi));
							
							$delete = mysqli_query($koneksi, "DELETE FROM pasien WHERE no_rm ='$no_rm'") or die(mysqli_error($koneksi));
							// kelemahan sistem = peggunaan no RM yang tidak unik 
							$delete = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE no_rm ='$no_rm'") or die(mysqli_error($koneksi));
							$delete = mysqli_query($koneksi, "DELETE FROM pinjam_kembali WHERE no_rm ='$no_rm'") or die(mysqli_error($koneksi));
							
							mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS = 1") or die(mysqli_error($koneksi));
							// mysqli_query($koneksi, "ALTER TABLE peminjaman CHECK CONSTRAINT pasien") or die(mysqli_error($koneksi));
							// mysqli_query($koneksi, "ALTER TABLE pinjam_kembali CHECK CONSTRAINT pasien_fk") or die(mysqli_error($koneksi));
						} else {
							echo "data uptodate";
						}
					}
				}

				$sql = mysqli_query($koneksi, "SELECT * FROM retensi ORDER BY no_rm ASC") or die(mysqli_error($koneksi));
				//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
				if (mysqli_num_rows($sql) > 0) {
					//membuat variabel $no untuk menyimpan nomor urut
					$no = 1;
					//melakukan perulangan while dengan dari dari query $sql
					while ($data = mysqli_fetch_assoc($sql)) {
						//menampilkan data perulangan
						echo '
						<tr>
							<td>' . $no++ . '</td>
							<td>' . $data['nm_pasien'] . '</td>
							<td>' . $data['tmp_lahir'] . ' ' . $data['tgl_lahir'] . ' </td>
							<td>' . $data['jenis_klm'] . '</td>
							<td>' . $data['pekerjaan'] . '</td>
							<td>' . $data['no_telp'] . '</td>
							<td>' . $data['alamat'] . '</td>

							<td>
								<a href="dashboard.php?page=recover_retensi&no_rm=' . $data['no_rm'] . '" class="btn btn-secondary btn-sm">recover</a>
								<a href="dashboard.php?page=delete_retensi&no_rm=' . $data['no_rm'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
						// $no++;
					}
					//jika query menghasilkan nilai 0
				} else {
					echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
				}
				?>
			<tbody>
		</table>
	</div>
</div>