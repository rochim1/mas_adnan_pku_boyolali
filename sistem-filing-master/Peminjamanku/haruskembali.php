<?php
//memasukkan file config.php
include('/config/config.php');
?>


<div class="container" style="margin-top:20px">
	<center>
		<font size="6">Harap Segera dikembalikan</font>
	</center>
	<hr>

	<div class="table-responsive mt-2">
		<table aria-label="Data Pengembalian" id="myTable" class="table table-striped jambo_table bulk_action">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal Pinjam</th>
					<th>Kode Petugas</th>
					<th>Tujuan Pinjam</th>
					<th>Lokasi Pinjam</th>
					<th>harus kembali</th>
					<th>No RM</th>
					<th>Nama Pasien</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
				$kd_peminjam = $_SESSION['kd_peminjam'];
				$hari_ini = date("Y-m-d");
				$sql = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE kd_peminjam = '$kd_peminjam' AND tanggal_hrs_kmb <= '$hari_ini' ORDER BY kd_peminjam ASC") or die(mysqli_error($koneksi));
				//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
				if (mysqli_num_rows($sql) > 0) {
					
					//membuat variabel $no untuk menyimpan nomor urut
					$no = 1;
					//melakukan perulangan while dengan dari dari query $sql
					while ($data = mysqli_fetch_assoc($sql)) {
						//menampilkan data perulangan
						// print_r($data);
					
						echo '<tr class="bg-danger text-white"';
						echo'>
							<td>' . $no++ . '</td>
						
							<td>' . date("d M Y", strtotime($data['tgl_pinjam'])) . '</td>
							
							<td>' . $data['kd_petugas'] . '</td>
							<td>' . $data['tujuan_pinjam'] . '</td>
							<td>' . $data['lokasi_pinjam'] . '</td>
							<td>' . date("d M Y", strtotime($data['tanggal_hrs_kmb'])) . '</td>
							<td>' . $data['no_rm'] . '</td>
							<td>' . $data['nm_pasien'] . '</td>
							<td>
								<a href="dashboard.php?page=detail_peminjaman&no_pinjam=' . $data['no_pinjam'] . '" class="btn btn-secondary btn-sm">Edit</a>
							</td>
						</tr>
						';
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