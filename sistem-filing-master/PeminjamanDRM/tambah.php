<?php include('/config/config.php'); ?>

<center>
	<font size="6">Tambah Data</font>
</center>
<hr>
<?php

$no_pm = mysqli_query($koneksi, "SELECT * FROM peminjaman") or die(mysqli_error($koneksi));
if (mysqli_num_rows($no_pm) == 0) {
	$no_pm = 'PJ001';
} else {
	$last_pm = false;
	foreach ($no_pm as $key => $value) {
		$last_pm = $value['no_pinjam'];
	}
	(int)$last_pm = substr($last_pm, 2);
	$last_pm++;
	$num_padded = sprintf("%03d", $last_pm);
	(string)$no_pm = "PM" . $num_padded;
}



if (isset($_POST['submit'])) {
	$no_pinjam	= $no_pm;
	$tgl_pinjam	= $_POST['tgl_pinjam'];
	$kd_petugas	= $_POST['kd_petugas'];
	$tujuan_pinjam		= $_POST['tujuan_pinjam'];
	$lokasi_pinjam	= $_POST['lokasi_pinjam'];
	$tanggal_hrs_kmb	= $_POST['tanggal_hrs_kmb'];
	$no_rm	= $_POST['no_rm'];
	$nm_pasien		= $_POST['nm_pasien'];
	$tgl_lahir		= $_POST['tgl_lahir'];





	$cek = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE no_pinjam='$no_pinjam'") or die(mysqli_error($koneksi));
	if (mysqli_num_rows($cek) == 0) {
		$sql = mysqli_query($koneksi, "INSERT INTO peminjaman (no_pinjam, tgl_pinjam, kd_petugas, tujuan_pinjam, lokasi_pinjam, tanggal_hrs_kmb, no_rm, nm_pasien, tgl_lahir) VALUES('$no_pinjam', '$tgl_pinjam', '$kd_petugas', '$tujuan_pinjam','$lokasi_pinjam','$tanggal_hrs_kmb','$no_rm','$nm_pasien','$tgl_lahir')") or die(mysqli_error($koneksi));

		if ($sql) {
			echo '<script>alert("Berhasil menambahkan data."); document.location="dashboard.php?page=tampil_peminjaman_DRM";</script>';
		} else {
			echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
		}
	} else {
		echo '<div class="alert alert-warning">Gagal, nomor pinjam sudah terdaftar.</div>';
	}
}
?>


<!-- terakhir sampai siniiiiiihhhhhhhhhhhhh.. -->
<form action="dashboard.php?page=tambah_peminjaman_DRM" method="post">
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Nomor Pinjam</label>
		<div class="col-md-6 col-sm-6 ">
			<input type="text" value="<?php echo $no_pm ?>" disabled name="no_pinjam" class="form-control" size="4" required placeholder="misal:PM001">
		</div>
	</div>
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Pinjam</label>
		<div class="col-md-6 col-sm-6">
			<input type="date" placeholder="dd/mm/yyyy" date-format="DD/MM/YYYY" name="tgl_pinjam" class="form-control" required>
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
					<option value="<?php echo $value['kd_petugas']; ?>"><?php echo $value['kd_petugas'] . '-' . $value['nm_petugas']; ?></option>
				<?php
				} ?>

			</select>
		</div>
	</div>
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Tujuan Pinjam</label>
		<div class="col-md-6 col-sm-6">
			<input type="text" name="tujuan_pinjam" class="form-control" required>
		</div>
	</div>
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Lokasi Pinjam</label>
		<div class="col-md-6 col-sm-6">
			<input type="text" name="lokasi_pinjam" class="form-control" required>
		</div>
	</div>
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Harus Kembali</label>
		<div class="col-md-6 col-sm-6">
			<?php
			$hari_ini = date("Y-m-d");
			$harus_kembali = date('Y-m-d', strtotime($hari_ini . ' + 2 days'));
			?>
			<input type="date" disabled placeholder="dd/mm/yyyy" data-date-format="DD/MM/YYYY" value="<?php echo $harus_kembali ?>" name="tanggal_hrs_kmb" class="form-control" required>
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
					<option value="<?php echo $value['no_rm']; ?>"><?php echo $value['no_rm'] . '-' . $value['nm_pasien']; ?></option>
				<?php
				} ?>
			</select>
		</div>
	</div>
	<div class="item form-group">
	
	</div>
	<div class="item form-group">
		<div class="col-md-6 col-sm-6 offset-md-3">
			<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
		</div>
</form>
</div>