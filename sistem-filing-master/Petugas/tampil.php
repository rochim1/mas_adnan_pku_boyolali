<?php
//memasukkan file config.php
include('/config/config.php');
?>


<div class="container" style="margin-top:20px">
	<center>
		<font size="6">Data Petugas</font>
	</center>
	<hr>
	<a href="dashboard.php?page=tambah_petugas"><button class="btn btn-dark right">Tambah Data</button></a>

	
		<button onclick="trig_print()" class="btn btn-primary right" on>Print</button>

	<div class="table-responsive mt-2">
		<table aria-label="Data Petugas" id="myTable" class="table table-striped jambo_table bulk_action">
			<thead>
				<tr>

					<th>Kode Petugas</th>
					<th>Nama Petugas</th>
					<th>Kontak</th>
					<th>Bagian</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
				$sql = mysqli_query($koneksi, "SELECT * FROM petugas ORDER BY kd_petugas ASC") or die(mysqli_error($koneksi));
				//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
				if (mysqli_num_rows($sql) > 0) {
					//membuat variabel $no untuk menyimpan nomor urut
					$no = 1;
					//melakukan perulangan while dengan dari dari query $sql
					while ($data = mysqli_fetch_assoc($sql)) {
						//menampilkan data perulangan
						echo '
						<tr>
							<td>' . $data['kd_petugas'] . '</td>
							<td>' . $data['nm_petugas'] . '</td>
							<td>' . $data['no_telp'] . '</td>
							<td>' . $data['bagian'] . '</td>
							<td>
								<a href="dashboard.php?page=edit_petugas&kd_petugas=' . $data['kd_petugas'] . '" class="btn btn-secondary btn-sm">Edit</a>
								<a href="dashboard.php?page=delete_petugas&kd_petugas=' . $data['kd_petugas'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
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