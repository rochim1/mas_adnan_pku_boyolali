<?php include('/config/config.php');?>
		
	<div class="container" style="margin-top:20px">
		<center><font size="6">Edit Data</font></center>

		<hr>

		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['no_rm'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$no_rm = $_GET['no_rm'];

			//query ke database SELECT tabel mahasiswa berdasarkan id = $id
			$select = mysqli_query($koneksi, "SELECT * FROM pasien WHERE no_rm='$no_rm'") or die(mysqli_error($koneksi));

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
			$nm_pasien	= $_POST['nm_pasien'];
			$tgl_lahir	= $_POST['tgl_lahir'];
			$alamat	= $_POST['alamat'];
			$no_telp = $_POST['no_telp'];
			$pekerjaan	= $_POST['pekerjaan'];
			$tmp_lahir	= $_POST['tmp_lahir'];
			$jenis_klm	= $_POST['jenis_klm'];
			

			$sql = mysqli_query($koneksi, "UPDATE pasien SET no_rm ='$no_rm', nm_pasien='$nm_pasien', tgl_lahir='$tgl_lahir', alamat='$alamat', no_telp='$no_telp', pekerjaan='$pekerjaan', tmp_lahir='$tmp_lahir', jenis_klm='$jenis_klm' WHERE no_rm ='$no_rm'") or die(mysqli_error($koneksi));

			if($sql){
				echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php?page=tampil_pasien";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>

		<form action="dashboard.php?page=edit_pasien&no_rm=<?php echo $no_rm; ?>" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nomor RM </label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="no_rm" class="form-control" size="4" value="<?php echo $data['no_rm']; ?>" readonly required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Pasien</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="nm_pasien" class="form-control" value="<?php echo $data['nm_pasien']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin</label>
				<div class="col-md-6 col-sm-6 ">
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="jenis_klm" value="Laki-Laki" <?php if($data['jenis_klm'] == 'Laki-Laki'){ echo 'checked'; } ?> required>Laki-Laki
						</label>
						<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="jenis_klm" value="Perempuan" <?php if($data['jenis_klm'] == 'Perempuan'){ echo 'checked'; } ?> required>Perempuan
						</label>
					</div>
				</div>
			</div>
		
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Lahir</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="tgl_lahir" class="form-control" value="<?php echo $data['tgl_lahir']; ?>" required>
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
				<label class="col-form-label col-md-3 col-sm-3 label-align">Pekerjaan</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="pekerjaan" class="form-control" value="<?php echo $data['pekerjaan']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Tempat Lahir</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="tmp_lahir" class="form-control" value="<?php echo $data['tmp_lahir']; ?>" required>
				</div>
			</div>
			<div class="item form-group">
				<div class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
					<a href="dashboard.php?page=tampil_pasien" class="btn btn-warning">Kembali</a>
				</div>
			</div>
		</form>
	</div>
