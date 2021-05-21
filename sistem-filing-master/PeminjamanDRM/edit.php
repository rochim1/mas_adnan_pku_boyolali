<?php include('/config/config.php'); ?>

<div class="container" style="margin-top:20px">
	<center>
		<font size="6">Edit Data</font>
	</center>

	<hr>

	<?php
	// echo"test";
	//jika sudah mendapatkan parameter GET id dari URL
	$data = false;
	if (isset($_GET['no_pinjam'])) {
		//membuat variabel $id untuk menyimpan id dari GET id di URL
		$no_pinjam = $_GET['no_pinjam'];

		//query ke database SELECT tabel mahasiswa berdasarkan id = $id
		$select = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE no_pinjam='$no_pinjam'") or die(mysqli_error($koneksi));

		//jika hasil query = 0 maka muncul pesan error
		if (mysqli_num_rows($select) == 0) {
			echo '<div class="alert alert-warning">Nomor pinjam tidak ada dalam database.</div>';
			exit();
			//jika hasil query > 0
		} else {
			//membuat variabel $data dan menyimpan data row dari query
			$data = mysqli_fetch_assoc($select);
		}
	}
	?>

	<?php
	//jika tombol simpan di tekan/klik
	if (isset($_POST['submit'])) {
		$no_rm = $_POST['no_rm'];
	$sql = mysqli_query($koneksi, "SELECT * FROM pasien where no_rm = '$no_rm'") or die(mysqli_error($koneksi));

	while ($pecah = $sql->fetch_assoc()) {
		$bungkus[] = $pecah;
	}

		$no_pinjam	= $_POST['no_pinjam'];
		$tgl_pinjam	= $_POST['tgl_pinjam'];
		$kd_petugas = $_POST['kd_petugas'];
		$kd_peminjam = $_POST['kd_peminjam'];
		$tujuan_pinjam	= $_POST['tujuan_pinjam'];
		$lokasi_pinjam	= $_POST['lokasi_pinjam'];
		$tanggal_hrs_kmb	= $_POST['tanggal_hrs_kmb'];
		$no_rm = $_POST['no_rm'];
		$status_pjm = $_POST['status_pjm'];
		$nm_pasien		= $bungkus[0]['nm_pasien'];
		$tgl_lahir		= $bungkus[0]['tgl_lahir'];
		

		// echo $no_pinjam;
		
		if ($status_pjm == 'dikembalikan') {
			$sql = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE no_pinjam ='$no_pinjam'") or die(mysqli_error($koneksi));
			// echo"test1";
			if ($sql) {
				// echo "dikembalikan";
				$pinjamKembali = mysqli_query($koneksi, "SELECT kd_pinjam_kembali FROM pinjam_kembali");

				if (mysqli_num_rows($pinjamKembali) == 0) {
					$pinjamKembali = 'PK001';
				} else {
					$last_kd = false;
					foreach ($pinjamKembali as $key => $value) {
						$last_kd = $value['kd_pinjam_kembali'];
					}
					(int)$last_kd = substr($last_kd, 2);
					$last_kd++;
					$num_padded = sprintf("%03d", $last_kd);
					(string)$pinjamKembali = "PK" . $num_padded;
				}
				// echo $pinjamKembali;
				
				$hari_ini = date("Y-m-d");
				// echo $kd_peminjam . '<br>';
				$sql = 	mysqli_query($koneksi, "INSERT INTO pinjam_kembali
				VALUES('$pinjamKembali','$no_pinjam','$kd_peminjam','$tgl_pinjam','$kd_petugas','$tujuan_pinjam','$lokasi_pinjam','$hari_ini','$no_rm','$nm_pasien','$tgl_lahir','$status_pjm','')") or die(mysqli_error($koneksi));
			
				$cek_empty = mysqli_query($koneksi, "SELECT kode_terakhir_peminjaman FROM kode_terakhir");
				$select_diedit = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE no_pinjam='$no_pinjam'") or die(mysqli_error($koneksi));

				// jika data yang di edit berada pada posisi terbawah
				
				$select = mysqli_query($koneksi, "SELECT * FROM peminjaman ORDER BY no_pinjam DESC LIMIT 1") or die(mysqli_error($koneksi));

				$select_ttl = mysqli_query($koneksi, "SELECT * FROM peminjaman") or die(mysqli_error($koneksi));
				$total = mysqli_num_rows($select_ttl);

				$posisi = 0; //posisi, ga penting sih
				$select_diedit = mysqli_fetch_assoc($select_diedit);
				$select = mysqli_fetch_assoc($select);
				for ($i = 0; $i < $total; $i++) {
					if ($select_diedit['no_pinjam'] == $select['no_pinjam'] ) {
						// berarti last row
						$kod = [];
						while ($kod_akhir = mysqli_fetch_assoc($cek_empty)) {
							$kod = array(
								'kode_terakhir_peminjaman' => $kod_akhir['kode_terakhir_peminjaman'],
							);
							// echo "<br>".$kod_akhir['kode_terakhir_peminjaman']."<br>";
						}

						if ($hasil = empty($kod['kode_terakhir_peminjaman'])) {
							// ini ga mungkin sih karena kalau mau edit walau awal pasti ada datanya dengan no_pinjam PM001
							$sql_lscode = mysqli_query($koneksi, "INSERT INTO kode_terakhir (kode_terakhir_peminjaman) VALUES('$no_pinjam')") or die(mysqli_error($koneksi));
						} else {
							$sql_lscode = mysqli_query($koneksi, "UPDATE kode_terakhir SET kode_terakhir_peminjaman = '$no_pinjam'") or die(mysqli_error($koneksi));
						}

						$posisi = $posisi+$i;
						$i = $total+1; //end looping
					}
				}
				
				
				
				
				// print_r($kod['kode_terakhir_peminjaman']);
				
				

				if ($sql) {
					// mau_dihapus atau pakai status ?
					$update_peminjaman = mysqli_query($koneksi, "UPDATE peminjaman SET status = false where no_pinjam = '$no_pinjam'") or die(mysqli_error($koneksi));
					// $hapus_peminjaman = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE no_pinjam = '$no_pinjam'");
					if ($update_peminjaman) {
						echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php?page=tampil_peminjaman_DRM";</script>';
					}
				}else{	
					echo "gagal insert dan delete";
				}
				
			}
		}else {
		
			$sql = mysqli_query($koneksi, "UPDATE peminjaman SET no_pinjam ='$no_pinjam', kd_peminjam = '$kd_peminjam', tgl_pinjam='$tgl_pinjam', kd_petugas='$kd_petugas', tujuan_pinjam='$tujuan_pinjam' , lokasi_pinjam='$lokasi_pinjam' , no_rm='$no_rm' , nm_pasien='$nm_pasien', tgl_lahir='$tgl_lahir' WHERE no_pinjam ='$no_pinjam'") or die(mysqli_error($koneksi));

			if ($sql) {
				echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php?page=tampil_peminjaman_DRM";</script>';
			} else {
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}

		
	}
	?>

	<form action="dashboard.php?page=edit_peminjaman_DRM&no_pinjam=<?php echo $no_pinjam; ?>" method="post">
		<!-- asdadad -->
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Nomor Pinjam</label>
			<div class="col-md-6 col-sm-6 ">
				<input type="text" name="no_pinjam" class="form-control" size="4" value="<?php echo $data['no_pinjam']; ?>" readonly required>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Pinjam</label>
			<div class="col-md-6 col-sm-6">

				<input type="date" value="<?php echo date('Y-m-d', strtotime($data['tgl_pinjam'])) ?>" name="tgl_pinjam" class="form-control" required>
			</div>

		</div>
		<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Kode Peminjam</label>
		<div class="col-md-6 col-sm-6">
			<select name="kd_peminjam" class="form-control">
				<?php
				$peminjam = mysqli_query($koneksi, "SELECT * FROM peminjam");
				if (mysqli_num_rows($peminjam) == 0) {
				?>
					<option value="">peminjam kosong</option>
				<?php
				} else {
					foreach ($peminjam as $key => $value) {
					
				?>	
				
					<option 
					<?php if ($data['kd_peminjam'] == $value['kd_peminjam']) {
												echo 'selected';		}
					?>
					 value="<?php echo $value['kd_peminjam']; ?>"><?php echo $value['kd_peminjam'] . '-' . $value['nmpeminjam']; ?></option>
				<?php
				}
				} ?>

			</select>
		</div>
	</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Kode Petugas</label>
			<div class="col-md-6 col-sm-6">
				<select name="kd_petugas" class="form-control">
					<?php
					$petugas = mysqli_query($koneksi, "SELECT * FROM petugas");
					if (mysqli_num_rows($petugas) == 0) {
					?>
						<option value="">petugas kosong</option>
					<?php
					} else {
						foreach ($petugas as $key => $value) {
						
					?>
						<option <?php
											if ($data['kd_petugas'] == $value['kd_petugas']) {
												echo 'selected';
											}
											?> value="<?php echo $value['kd_petugas']; ?>"><?php echo $value['kd_petugas'] . '-' . $value['nm_petugas']; ?></option>
					<?php
					} 
					} 
					?>

				</select>
			</div>
		</div>

		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Tujuan Pinjam</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="tujuan_pinjam" value="<?php echo $data['tujuan_pinjam']; ?>" class="form-control" required>
			</div>
		</div>

		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Lokasi Pinjam</label>
			<div class="col-md-6 col-sm-6">
				<input type="text" name="lokasi_pinjam" value="<?php echo $data['lokasi_pinjam']; ?>" class="form-control" required>
			</div>
		</div>

		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Nomor RM Pasien</label>
			<div class="col-md-6 col-sm-6">
				<select id="no_rm" name="no_rm" class="form-control">
					<option value="">pilih no rm</option>
					<?php
					$pasien = mysqli_query($koneksi, "SELECT * FROM pasien");
					if (mysqli_num_rows($pasien) == 0) {
					?>
						<option value="">pasien kosong</option>
					<?php
					} else {
						foreach ($pasien as $key => $value) {
							?>
						<option <?php if ($data['no_rm'] == $value['no_rm']) {
							echo 'selected';
						} ?> value="<?php echo $value['no_rm']; ?>"><?php echo $value['no_rm'] . '-' . $value['nm_pasien']; ?></option>
					<?php
					}
					} ?>
				</select>
			</div>
		</div>

		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Status Pinjam</label>
			<div class="col-md-6 col-sm-6">
				<div class="btn-group" data-toggle="buttons">
					<!-- <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
						<input type="radio" class="join-btn" name="status_pjm" value="berlangsung" required>Berlangsung
					</label> -->

						<label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="status_pjm" value="dikembalikan">Dikembalikan
						</label>

					<!-- <label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
						<input type="radio" class="join-btn" name="status_pjm" value="Kadaluarsa" required>Kadaluarsa
					</label> -->


				</div>
			</div>
		</div>


		<div class="item form-group">
			<div class="col-md-6 col-sm-6 offset-md-3">
				<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
			</div>
			<!-- asdasdasd -->
	</form>
</div>