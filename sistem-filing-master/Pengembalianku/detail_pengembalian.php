<?php include('/config/config.php'); ?>

<div class="container" style="margin-top:20px">
	<center>
		<font size="6">Detail Pengembalian</font>
	</center>

	<hr>

	<?php
	//jika sudah mendapatkan parameter GET id dari URL
	if (isset($_GET['kd_pengembalian'])) {
		//membuat variabel $id untuk menyimpan id dari GET id di URL
		$kd_pengembalian = $_GET['kd_pengembalian'];

		//query ke database SELECT tabel mahasiswa berdasarkan id = $id
		$select = mysqli_query($koneksi, "SELECT * FROM pinjam_kembali WHERE kd_pinjam_kembali='$kd_pengembalian'") or die(mysqli_error($koneksi));
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


	<form action="dashboard.php?page=edit_peminjaman_DRM&no_pinjam=<?php echo $kd_pengembalian; ?>" method="post">
		<!-- asdadad -->
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">kd pengembalian</label>
			<div class="col-md-6 col-sm-6 ">
				<input disabled type="text" name="no_pinjam" class="form-control" size="4" value="<?php echo $data['kd_pinjam_kembali']; ?>" readonly required>
			</div>
		</div>

		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Pinjam</label>
			<div class="col-md-6 col-sm-6">

				<input disabled type="date" value="<?php echo date('Y-m-d', strtotime($data['tgl_pinjam'])) ?>" name="tgl_pinjam" class="form-control" required>
			</div>
		</div>

		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Kembali</label>
			<div class="col-md-6 col-sm-6">

				<input disabled type="date" value="<?php echo date('Y-m-d', strtotime($data['tanggal_pengembalian'])) ?>" name="tgl_pinjam" class="form-control" required>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Kode Peminjam</label>
			<div class="col-md-6 col-sm-6">
				<select disabled name="kd_peminjam" class="form-control">
					<?php
					$peminjam = mysqli_query($koneksi, "SELECT * FROM peminjam");
					if (mysqli_num_rows($peminjam) == 0) {
					?>
						<option value="">peminjam kosong</option>
						<?php
					} else {
						foreach ($peminjam as $key => $value) {

						?>
							<option value="<?php echo $value['kd_peminjam']; ?>">
								<?php echo $value['kd_peminjam'] . '-' . $value['nmpeminjam']; ?></option>
					<?php
						}
					} ?>

				</select>
			</div>
		</div>

		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Kode Petugas</label>
			<div class="col-md-6 col-sm-6">
				<select disabled name="kd_petugas" class="form-control">
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
											?>" value="<?php echo $value['kd_petugas']; ?>">
							<?php echo $value['kd_petugas'] . '-' . $value['nm_petugas']; ?></option>
					<?php
					} ?>

				</select>
			</div>
		</div>

		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Tujuan Pinjam</label>
			<div class="col-md-6 col-sm-6">
				<input disabled type="text" name="tujuan_pinjam" value="<?php echo $data['tujuan_pinjam']; ?>" class="form-control" required>
			</div>
		</div>

		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Lokasi Pinjam</label>
			<div class="col-md-6 col-sm-6">
				<input disabled type="text" name="lokasi_pinjam" value="<?php echo $data['lokasi_pinjam']; ?>" class="form-control" required>
			</div>
		</div>

		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align">Nomor RM Pasien</label>
			<div class="col-md-6 col-sm-6">
				<select disabled id="no_rm" name="no_rm" class="form-control">
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
											} ?>" value="<?php echo $value['no_rm']; ?>"><?php echo $value['no_rm'] . '-' . $value['nm_pasien']; ?>
						</option>
					<?php
					} ?>
				</select>
			</div>
		</div>


		<div class="item form-group">
			<div class="col-md-6 col-sm-6 offset-md-3">
				<a href="dashboard.php?page=tampil_pengembalianku" class="text-white btn btn-primary">Kembali</a>
			</div>
			<!-- asdasdasd -->
	</form>
</div>