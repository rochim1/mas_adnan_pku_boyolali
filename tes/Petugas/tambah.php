<?php include('/config/config.php'); ?>

		<center><font size="6">Tambah Data Petugas</font></center>
		<hr>
		<?php
		$cek = mysqli_query($koneksi, "SELECT * FROM petugas") or die(mysqli_error($koneksi));

		echo "mantap";
		if (mysqli_num_rows($cek) == 0) {
			$no_kp = 'KP001';
		} else {

			$last_kp = false;
			foreach ($cek as $key => $value) {
				$last_kp = $value['kd_petugas'];
			}
			(int)$last_kp = substr($last_kp, 2);
			$last_kp++;
			$num_padded = sprintf("%02d", $last_kp);
			(string)$cek = "RM" . $num_padded;
			// echo
		}
		
		
		
		
		
			if(isset($_POST['submit'])){
			$kd_petugas	= $_POST['kd_petugas'];
			$nm_petugas	= $_POST['nm_petugas'];
			$no_telp	= $_POST['no_telp'];
			$bagian		= $_POST['bagian'];
		
			if(mysqli_num_rows($cek) == 0){
				$sql = mysqli_query($koneksi, "INSERT INTO petugas (kd_petugas, nm_petugas, no_telp, bagian) VALUES('$kd_petugas', '$nm_petugas', '$no_telp', '$bagian')") or die(mysqli_error($koneksi));

				if($sql){
					echo '<script>alert("Berhasil menambahkan data."); document.location="dashboard.php?page=tampil_petugas";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				}
			}else{
				echo '<div class="alert alert-warning">Gagal, kode petugas sudah terdaftar.</div>';
			}
		}
		?>

	

		<form action="dashboard.php?page=tambah_petugas" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Kode Petugas</label>
				<div class="col-md-6 col-sm-6 ">
					<input type="text" name="kd_petugas" value="<?php echo $last_kp ?>" class="form-control" size="4" required placeholder="misal:KP001">
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Petugas</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="nm_petugas" class="form-control" required>
				</div>
			</div>
			<!-- <div class="item form-group">
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
			</div> -->
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
				<label class="col-form-label col-md-3 col-sm-3 label-align">Bagian</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="bagian" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<div  class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
			</div>
		</form>
	</div>
