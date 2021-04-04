<?php include('/config/config.php');?>
		
	<div class="container" style="margin-top:20px">
		<center><font size="6">Edit Data</font></center>

		<hr>

		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['kd_petugas'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$kd_petugas = $_GET['kd_petugas'];

			//query ke database SELECT tabel mahasiswa berdasarkan id = $id
			$select = mysqli_query($koneksi, "SELECT * FROM petugas WHERE kd_petugas='$kd_petugas'") or die(mysqli_error($koneksi));

			//jika hasil query = 0 maka muncul pesan error
			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">Nomor RM tidak ada dalam database.</div>';
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
			$kd_petugas	= $_POST['kd_petugas'];
			$nm_petugas	= $_POST['nm_petugas'];
			$no_telp = $_POST['no_telp'];
			$bagian	= $_POST['bagian'];

			$sql = mysqli_query($koneksi, "UPDATE petugas SET kd_petugas ='$kd_petugas', nm_petugas='$nm_petugas', no_telp='$no_telp', bagian='$bagian' WHERE kd_petugas ='$kd_petugas'") or die(mysqli_error($koneksi));

			if($sql){
				echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php?page=tampil_petugas";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>

		<form action="dashboard.php?page=edit_petugas&kd_petugas=<?php echo $kd_petugas; ?>" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Kode Petugas </label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="kd_petugas" class="form-control" size="4" value="<?php echo $data['kd_petugas']; ?>" readonly required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Petugas</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="nm_petugas" class="form-control" value="<?php echo $data['nm_petugas']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Kontak</label>
				<div class="col-md-6 col-sm-6">
				
					<input type="number" name="no_telp" class="form-control" value="<?php echo $data['no_telp']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Bagian</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="bagian" class="form-control" value="<?php echo $data['bagian']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<div class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
					<a href="dashboard.php?page=tampil_petugas" class="btn btn-warning">Kembali</a>
				</div>
			</div>
		</form>
	</div>
