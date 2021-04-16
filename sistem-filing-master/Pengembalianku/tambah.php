<?php include('/config/config.php'); ?>

<center>
	<font size="6">Tambah Data Pengembalian</font>
</center>
<hr>
<?php

$no_pm = mysqli_query($koneksi, "SELECT * FROM peminjaman where status_pjm ='berlangsung'") or die(mysqli_error($koneksi));
if (mysqli_num_rows($no_pm) !== 0) {
	$data = $no_pm;
}

if (isset($_POST['submit'])) {
	$no_pinjam	= $_POST['no_pinjam'];
	$status_pjm	= "dikembalikan";

	$sql = mysqli_query($koneksi, "UPDATE peminjaman SET status_pjm='$status_pjm' WHERE no_pinjam ='$no_pinjam'") or die(mysqli_error($koneksi));
	if ($sql) {
		echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php?page=tampil_pengembalian_DRM";</script>';
	} else {
		echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
	}
}
?>

<?php
$hari_ini = date("Y-m-d");
$harus_kembali = date('Y-m-d', strtotime($hari_ini . ' + 2 days'));
?>
<!-- terakhir sampai siniiiiiihhhhhhhhhhhhh.. -->
<form action="dashboard.php?page=tambah_pengembalian_DRM" method="post">
	<div class="item form-group">
		<label class="col-form-label col-md-3 col-sm-3 label-align">Nomor Pinjam</label>
		<div class="col-md-6 col-sm-6 ">
			<select class="form-control" name="no_pinjam" id="">
				<option value="">pilih no peminjaman</option>
				<?php
				foreach ($data as $key => $value) {
				?>

					<option value="<?php echo $value['no_pinjam']?>"><?php echo $value['no_pinjam'] ?></option>


				<?php
				}
				?>
			</select>
		</div>
	</div>

	<div class="item form-group">
		<div class="col-md-6 col-sm-6 offset-md-3">
			<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
		</div>
</form>
</div>