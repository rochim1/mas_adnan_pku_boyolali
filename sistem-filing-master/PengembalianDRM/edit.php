<?php include('/config/config.php'); ?>

<div class="container" style="margin-top:20px">
	<center>
		<font size="6">Edit Data</font>
	</center>

	<hr>

	<?php
	//jika sudah mendapatkan parameter GET id dari URL
	$no_pinjam = false;
	if (isset($_GET['kd_pinjam_kembali'])) {
		//membuat variabel $id untuk menyimpan id dari GET id di URL
		$kd_pinjam_kembali = $_GET['kd_pinjam_kembali'];

		//query ke database SELECT tabel mahasiswa berdasarkan id = $id
		$select = mysqli_query($koneksi, "SELECT * FROM pinjam_kembali WHERE kd_pinjam_kembali='$kd_pinjam_kembali'") or die(mysqli_error($koneksi));
		
		//jika hasil query = 0 maka muncul pesan error
		if (mysqli_num_rows($select) == 0) {
			echo '<div class="alert alert-warning">Nomor pinjam kembali tidak ada dalam database.</div>';
			
			exit();
			//jika hasil query > 0
		} else {
			//membuat variabel $data dan menyimpan data row dari query
			$data = mysqli_fetch_assoc($select);
			$no_pinjam = $data['no_pinjam'];
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
		// todo
		// $sql = mysqli_query($koneksi, "SELECT * FROM peminjaman where no_pinjam = '$no_'") or die(mysqli_error($koneksi));
		// $no_pinjam	= $bungkus['no_pinjam'];

		$kd_pinjam_kembali	= $_POST['kd_pinjam_kembali'];
		
		$tgl_pinjam	= $_POST['tgl_pinjam'];
		$kd_petugas = $_POST['kd_petugas'];
		$kd_peminjam = $_POST['kd_peminjam'];
		$tujuan_pinjam	= $_POST['tujuan_pinjam'];
		$lokasi_pinjam	= $_POST['lokasi_pinjam'];
		$tanggal_hrs_kmb	= $_POST['tanggal_hrs_kmb'];
		$no_rm = $_POST['no_rm'];
		$status = $_POST['status'];
		$nm_pasien		= $bungkus[0]['nm_pasien'];
		$tgl_lahir		= $bungkus[0]['tgl_lahir'];


		if ($status == 'berlangsung') {
			$sql = mysqli_query($koneksi, "SELECT * FROM pinjam_kembali WHERE kd_pinjam_kembali ='$kd_pinjam_kembali'") or die(mysqli_error($koneksi));
			if ($sql) {
				// echo 'no pinjam = '.$no_pinjam."<br>";
				$sql_lscode = mysqli_query($koneksi, "UPDATE peminjaman SET status = true WHERE no_pinjam = '$no_pinjam'") or die(mysqli_error($koneksi));
				$hapus_peminjaman = mysqli_query($koneksi, "DELETE FROM pinjam_kembali WHERE kd_pinjam_kembali = '$kd_pinjam_kembali'");
				
				if ($sql_lscode) {
					
						echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php?page=tampil_pengembalian_DRM";</script>';
					}else
					{
					echo "gagal insert dan delete";
					}
			}
		} else {

			$sql = mysqli_query($koneksi, "UPDATE pinjam_kembali SET kd_peminjam='$kd_peminjam', tgl_pinjam='$tgl_pinjam', kd_petugas='$kd_petugas', tujuan_pinjam='$tujuan_pinjam' , lokasi_pinjam='$lokasi_pinjam' , no_rm='$no_rm' , nm_pasien='$nm_pasien', tgl_lahir='$tgl_lahir' WHERE kd_pinjam_kembali = '$kd_pinjam_kembali'") or die(mysqli_error($koneksi));

			if ($sql) {
				// echo 'wididit';
				echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php?page=tampil_pengembalian_DRM";</script>';
			} else {
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
	}
	?>

	<form action="dashboard.php?page=edit_pengembalian_DRM&kd_pinjam_kembali=<?php echo $kd_pinjam_kembali; ?>" method="post">
		<!-- asdadad -->
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Nomor Pinjam Kembali</label>
			<div class="col-md-6 col-sm-6 ">
				<input type="text" name="kd_pinjam_kembali" class="form-control" size="4" value="<?php echo $data['kd_pinjam_kembali']; ?>" readonly required>
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
							<option <?php
									if ($data['kd_peminjam'] == $value['kd_peminjam']) {
										echo "selected";
									}
									?> value="<?php echo $value['kd_peminjam']; ?>"><?php echo $value['kd_peminjam'] . '-' . $value['nmpeminjam']; ?></option>
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
										echo "selected";
									}
									?> value="<?php echo $value['kd_petugas']; ?>"><?php echo $value['kd_petugas'] . '-' . $value['nm_petugas']; ?></option>
					<?php
						}
					} ?>

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
										echo "selected";
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
					<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
						<input type="radio" class="join-btn" name="status" value="berlangsung">Berlangsung
					</label>


					<!-- <label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
						<input type="radio" class="join-btn" name="status" value="dikembalikan">Dikembalikan
					</label> -->

					<!-- <label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
						<input type="radio" class="join-btn" name="status" value="Kadaluarsa" required>Kadaluarsa
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