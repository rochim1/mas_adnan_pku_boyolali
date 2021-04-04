<?php
//memasukkan file config.php
include('/config/config.php');
?>


	<div class="container" style="margin-top:20px">
		<center><font size="6">Data Pasien</font></center>
		<hr>
		<a href="dashboard.php?page=tambah_pasien"><button class="btn btn-dark right">Tambah Data</button></a>
		<div class="table-responsive">
		<table class="table table-striped jambo_table bulk_action">
			<thead>
				<tr>
				
					<th>No RM</th>
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
				$sql = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY no_rm ASC") or die(mysqli_error($koneksi));
				//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
				if(mysqli_num_rows($sql) > 0){
					//membuat variabel $no untuk menyimpan nomor urut
					$no = 1;
					//melakukan perulangan while dengan dari dari query $sql
					while($data = mysqli_fetch_assoc($sql)){
						//menampilkan data perulangan
						echo '
						<tr>
							<td>'.$data['no_rm'].'</td>
							<td>'.$data['nm_pasien'].'</td>
							<td>'.$data['tmp_lahir'].' '.$data['tgl_lahir'].' </td>
							<td>'.$data['jenis_klm'].'</td>
							<td>'.$data['pekerjaan'].'</td>
							<td>'.$data['no_telp'].'</td>
							<td>'.$data['alamat'].'</td>

							<td>
								<a href="dashboard.php?page=edit_pasien&no_rm='.$data['no_rm'].'" class="btn btn-secondary btn-sm">Edit</a>
								<a href="dashboard.php?page=delete_pasien&no_rm='.$data['no_rm'].'" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
						// $no++;
					}
				//jika query menghasilkan nilai 0
				}else{
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

