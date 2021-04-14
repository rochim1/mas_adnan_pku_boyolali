<?php include('/config/config.php'); ?>

		<center><font size="6">Tambah Data</font></center>
		<hr>
		<?php

			$no_rm = mysqli_query($koneksi, "SELECT no_rm FROM pasien");
			// $max = mysqli_query($koneksi, "SELECT MAX(no_rm) FROM pasien");
			
			if (mysqli_num_rows($no_rm) == 0) {
				$no_rm = 'RM001';	
			}else {
				
				$last_rm = false;
				foreach ($no_rm as $key => $value) {
					$last_rm = $value['no_rm'];
				}
				(int)$last_rm = substr($last_rm, 2);  
				$last_rm++;
				$num_padded = sprintf("%03d", $last_rm);
				(string)$no_rm = "RM".$num_padded;
			}
			
			




		if(isset($_POST['submit'])){

			// $no_rm	= $_POST['no_rm'];
			// no_rm karena field nya di disable maka data ga bsia di post
			$no_rm = $no_rm; //hehe
			$nm_pasien	= $_POST['nm_pasien'];
			$tgl_lahir	= $_POST['tgl_lahir'];
			$alamat		= $_POST['alamat'];
			$no_telp		= $_POST['no_telp'];
			$pekerjaan		= $_POST['pekerjaan'];
			$tmp_lahir		= $_POST['tmp_lahir'];
			$jenis_klm		= $_POST['jenis_klm'];
			$hari_ini		= date('Y-m-d');
		
			$cek = mysqli_query($koneksi, "SELECT * FROM pasien WHERE no_rm='$no_rm'") or die(mysqli_error($koneksi));

			if(mysqli_num_rows($cek) == 0){
				$sql = mysqli_query($koneksi, "INSERT INTO pasien(no_rm, nm_pasien, tgl_lahir, alamat,no_telp,pekerjaan,tmp_lahir,jenis_klm,tgl_daftar) VALUES('$no_rm', '$nm_pasien', '$tgl_lahir', '$alamat', '$no_telp', '$pekerjaan', '$tmp_lahir', '$jenis_klm','$hari_ini')") or die(mysqli_error($koneksi));

				if($sql){
					echo '<script>alert("Berhasil menambahkan data."); document.location="dashboard.php?page=tampil_pasien";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				}
			}else{
				echo '<div class="alert alert-warning">Gagal, NO_RM sudah terdaftar.</div>';
			}
		}
		?>


		<form action="dashboard.php?page=tambah_pasien" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nomor RM</label>
				<div class="col-md-6 col-sm-6 ">
					<input type="text" name="no_rm" class="form-control" size="4" required placeholder="misal:RM1" value="<?php echo $no_rm?>" disabled>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Pasien</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="nm_pasien" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin</label>
				<div class="col-md-6 col-sm-6 ">
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="jenis_klm" value="Laki-Laki" required>Laki-Laki
						</label>
						<label class="btn btn-primary " data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
							<input type="radio" class="join-btn" name="jenis_klm" value="Perempuan" required>Perempuan
						</label>
					</div>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">tanggal lahir</label>
				<div class="col-md-6 col-sm-6">
					<input type="date" name="tgl_lahir" class="form-control" required placeholder="misal: 1-1-1999">
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">alamat</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="alamat" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Kontak</label>
				<div class="col-md-6 col-sm-6">
				<input type="number" name="no_telp" min="0" maxlength = "15"  onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" oninput="maxLengthCheck(this)" class="form-control" required>
				</div>
				<script>
				//berguna untuk memberikan limit input pada form kontak
					function maxLengthCheck(object)
					
					{	
						
						//jika nilai pada parameter objec > maxlength maka
						if (object.value.length > object.maxLength)
						//menggunakan build in method slice untuk dipotong sejumlah maxlength yaitu 15.
						object.value = object.value.slice(0, object.maxLength)
					}
				</script>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Profesi</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="pekerjaan" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Tempat Lahir</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="tmp_lahir" class="form-control" required>
				</div>
			</div>
			<!-- <div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Program Studi</label>
				<div class="col-md-6 col-sm-6">
					<select name="Program_Studi" class="form-control" required>
						<option value="">Pilih Program Studi</option>
						<option value="Teknik Informatika">Teknik Informatika</option>
						<option value="Teknik SipilL">Teknik Sipil</option>
						<option value="Teknik Kimia">Teknik Kimia</option>
						<option value="Teknik Elektro">Teknik Elektro</option>
						<option value="Akuntansi">Akuntansi</option>
						<option value="Manajemen">Manajemen</option>
						<option value="Farmasi">Farmasi</option>
						<option value="Hukum">Hukum</option>
						<option value="Kedokteran">Kedokteran</option>
					</select>
				</div>
			</div> -->
			<div class="item form-group">
				<div  class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
			</div>
		</form>
	</div>
