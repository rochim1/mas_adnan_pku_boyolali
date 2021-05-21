<?php include('/config/config.php'); ?>

<center>
	<font size="6">Tambah Data Pengembalian</font>
</center>
<hr>
<?php

$no_pm = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status = true") or die(mysqli_error($koneksi));
if (mysqli_num_rows($no_pm) !== 0) {
	$data = $no_pm;
}else{
	$data = 'data peminjaman kosong';
}

if (isset($_POST['submit'])) {
	$no_pinjam	= $_POST['no_pinjam'];
	$status	= 0;

	$sql = mysqli_query($koneksi, "UPDATE peminjaman SET status = '$status' WHERE no_pinjam ='$no_pinjam'") or die(mysqli_error($koneksi));
	
	
	$sql_select = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE no_pinjam ='$no_pinjam'") or die(mysqli_error($koneksi));	
	$data_peminjaman = mysqli_fetch_assoc($sql_select);
	$no_rm = $data_peminjaman['no_rm'];
	echo $no_rm;
	$sql = mysqli_query($koneksi, "SELECT * FROM pasien where no_rm = '$no_rm'") or die(mysqli_error($koneksi));

	while ($pecah = $sql->fetch_assoc()) {
		$bungkus[] = $pecah;
	}

	// generate id pinjam kembali 
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

	$tgl_pinjam	= $data_peminjaman['tgl_pinjam'];
	$kd_petugas = $data_peminjaman['kd_petugas'];
	$kd_peminjam = $data_peminjaman['kd_peminjam'];
	$tujuan_pinjam	= $data_peminjaman['tujuan_pinjam'];
	$lokasi_pinjam	= $data_peminjaman['lokasi_pinjam'];
	$tanggal_hrs_kmb	= $data_peminjaman['tanggal_hrs_kmb'];
	$no_rm = $data_peminjaman['no_rm'];
	$status = $data_peminjaman['status'];
	$nm_pasien		= $bungkus[0]['nm_pasien'];
	$tgl_lahir		= $bungkus[0]['tgl_lahir'];

	$hari_ini = date("Y-m-d");
	// echo $kd_peminjam . '<br>';
	$sql = 	mysqli_query($koneksi, "INSERT INTO pinjam_kembali VALUES('$pinjamKembali','$no_pinjam','$kd_peminjam','$tgl_pinjam','$kd_petugas','$tujuan_pinjam','$lokasi_pinjam','$hari_ini','$no_rm','$nm_pasien','$tgl_lahir','$status','')") or die(mysqli_error($koneksi));

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