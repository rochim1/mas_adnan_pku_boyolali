<?php include('/config/config.php'); ?>

<div class="container" style="margin-top:20px">
	<center>
		<font size="6">Edit Data</font>
	</center>

	<hr>

	<?php
	//jika sudah mendapatkan parameter GET id dari URL
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
		$no_pinjam	= $_POST['no_pinjam'];
		$tgl_pinjam	= $_POST['tgl_pinjam'];
		$kd_petugas = $_POST['kd_petugas'];
		$tujuan_pinjam	= $_POST['tujuan_pinjam'];
		$lokasi_pinjam	= $_POST['lokasi_pinjam'];
		$tanggal_hrs_kmb	= $_POST['tanggal_hrs_kmb'];
		$no_rm = $_POST['no_rm'];
		$nm_pasien	= $_POST['nm_pasien'];
		$tgl_lahir	= $_POST['tgl_lahir'];
		$status_pjm	= $_POST['status_pjm'];


		$sql = mysqli_query($koneksi, "UPDATE peminjaman SET no_pinjam ='$no_pinjam', tgl_pinjam='$tgl_pinjam', kd_petugas='$kd_petugas', tujuan_pinjam='$tujuan_pinjam' , lokasi_pinjam='$lokasi_pinjam' , tanggal_hrs_kmb='$tanggal_hrs_kmb' , no_rm='$no_rm' , nm_pasien='$nm_pasien', tgl_lahir='$tgl_lahir' , status_pjm='$status_pjm' WHERE no_pinjam ='$no_pinjam'") or die(mysqli_error($koneksi));

		if ($sql) {
			echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php?page=tampil_pengembalian_DRM";</script>';
		} else {
			echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
		}
	}
	?>

	<form action="dashboard.php?page=edit_pengembalian_DRM&no_pinjam=<?php echo $no_pinjam; ?>" method="post">
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
						}
					?>
						<option selected="<?php
											if ($data['kd_petugas'] == $value['kd_petugas']) {
												echo "selected";
											}
											?>" value="<?php echo $value['kd_petugas']; ?>"><?php echo $value['kd_petugas'] . '-' . $value['nm_petugas']; ?></option>
					<?php
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
						}
					?>
						<option selected="<?php if ($data['no_rm'] == $value['no_rm']) {
												echo "selected";
											} ?>" value="<?php echo $value['no_rm']; ?>"><?php echo $value['no_rm'] . '-' . $value['nm_pasien']; ?></option>
					<?php
					} ?>
				</select>
			</div>
		</div>

		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Status Pinjam</label>
			<div class="col-md-6 col-sm-6">
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
						<input type="radio" class="join-btn" name="status_pjm" value="berlangsung" required>Berlangsung
					</label>

					<label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
						<input type="radio" class="join-btn" name="status_pjm" value="dikembalikan" required>Dikembalikan
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