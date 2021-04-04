<?php include('/config/config.php');?>
		
	<div class="container" style="margin-top:20px">
		<center><font size="6">Edit Data</font></center>

		<hr>

		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['kd_peminjam'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$kd_peminjam = $_GET['kd_peminjam'];

			//query ke database SELECT tabel mahasiswa berdasarkan id = $id
			$select = mysqli_query($koneksi, "SELECT * FROM peminjam WHERE kd_peminjam='$kd_peminjam'") or die(mysqli_error($koneksi));

			//jika hasil query = 0 maka muncul pesan error
			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">Kode Peminjam tidak ada dalam database.</div>';
				exit();
			//jika hasil query > 0
			}else{
				//membuat variabel $data dan menyimpan data row dari query
				$data = mysqli_fetch_assoc($select);
			}
		}
		?>

		<?php
		//jika tombol simpan di tekan/klik
		if(isset($_POST['submit'])){
			$kd_peminjam	= $_POST['kd_peminjam'];
			$nmpeminjam	= $_POST['nmpeminjam'];
			$alamat = $_POST['alamat'];
			$no_telp	= $_POST['no_telp'];
			$keterangan	= $_POST['keterangan'];

			$sql = mysqli_query($koneksi, "UPDATE peminjam SET kd_peminjam ='$kd_peminjam', nmpeminjam='$nmpeminjam',alamat='$alamat', no_telp='$no_telp', keterangan='$keterangan' WHERE kd_peminjam ='$kd_peminjam'") or die(mysqli_error($koneksi));

			if($sql){
				echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php?page=tampil_peminjam";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>

		<form action="dashboard.php?page=edit_peminjam&kd_peminjam=<?php echo $kd_peminjam; ?>" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Kode Peminjam </label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="kd_peminjam" class="form-control" size="4" value="<?php echo $data['kd_peminjam']; ?>" readonly required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Peminjam</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="nmpeminjam" class="form-control" value="<?php echo $data['nmpeminjam']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Alamat</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="alamat" class="form-control" value="<?php echo $data['alamat']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Kontak</label>
				<div class="col-md-6 col-sm-6">
				
					<input type="number" name="no_telp" class="form-control" value="<?php echo $data['no_telp']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Keterangan</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="keterangan" class="form-control" value="<?php echo $data['keterangan']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<div class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
					<a href="dashboard.php?page=tampil_peminjam" class="btn btn-warning">Kembali</a>
				</div>
			</div>
		</form>
	</div>
