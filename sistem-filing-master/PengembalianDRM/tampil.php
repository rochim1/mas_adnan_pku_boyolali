<?php
//memasukkan file config.php
include('/config/config.php');
?>


<div class="container" style="margin-top:20px">
	<center>
		<font size="6">Transaksi Pengembalian DRM</font>
	</center>
	<hr>
	<a href="dashboard.php?page=tambah_pengembalian_DRM"><button class="btn btn-dark right">Tambah Data</button></a>
		
		<button onclick="trig_print()" class="btn btn-primary right" on>Print</button>

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
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
				$sql = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status_pjm = 'dikembalikan' ORDER BY no_pinjam ASC") or die(mysqli_error($koneksi));
				//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
				if (mysqli_num_rows($sql) > 0) {
					
					
					//membuat variabel $no untuk menyimpan nomor urut
					$no = 1;
					//melakukan perulangan while dengan dari dari query $sql
					while ($data = mysqli_fetch_assoc($sql)) {
						//menampilkan data perulangan
						$hari_ini = date("Y-m-d");
						$hrs_kembali = date('Y-m-d', strtotime($data['tanggal_hrs_kmb']));
						
						$peringatan = false;
					if ( $hrs_kembali < $hari_ini && $data['status_pjm'] == 'berlangsung') {
						$peringatan = true;
					}
						echo '
						<tr ';
						if ($peringatan) {
							echo 'class="bg-danger text-white"';
						}
						echo'>
							<td>' . $no++ . '</td>
						
							<td>' . date("d M Y", strtotime($data['tgl_pinjam'])) . '</td>
							
							<td>' . $data['kd_petugas'] . '</td>
							<td>' . $data['tujuan_pinjam'] . '</td>
							<td>' . $data['lokasi_pinjam'] . '</td>
							<td>' . date("d M Y", strtotime($data['tanggal_hrs_kmb'])) . '</td>
							<td>' . $data['no_rm'] . '</td>
							<td>' . $data['nm_pasien'] . '</td>
							<td class="';
							if ($data['status_pjm'] == 'berlangsung') {
								echo 'text-info';
							}else{
								echo 'text-success';
							}
							
							echo '">' . $data['status_pjm'] . '</td>
							
							
							<td width="115px">
								<a href="dashboard.php?page=edit_pengembalian_DRM&no_pinjam=' . $data['no_pinjam'] . '" class="btn btn-secondary btn-sm">Edit</a>
								<a href="dashboard.php?page=delete_pengembalian_PRJ&no_pinjam=' . $data['no_pinjam'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
								<a target="blank" href="trace/print-trace.php?trace=' . $data['no_pinjam'] . '" class="btn btn-success btn-sm")">Trace</a>
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