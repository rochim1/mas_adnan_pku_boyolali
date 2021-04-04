<?php include('/config/config.php'); ?>

		<center><font size="6">Tambah Data Peminjam</font></center>
		<hr>
		<?php
		if(isset($_POST['submit'])){
			$kd_peminjam	= $_POST['kd_peminjam'];
			$nmpeminjam		= $_POST['nmpeminjam'];
			$alamat			= $_POST['alamat'];
			$no_telp		= $_POST['no_telp'];
			$keterangan		= $_POST['keterangan'];
		
			

			$cek = mysqli_query($koneksi, "SELECT * FROM peminjam WHERE kd_peminjam='$kd_peminjam'") or die(mysqli_error($koneksi));

			if(mysqli_num_rows($cek) == 0){
				$sql = mysqli_query($koneksi, "INSERT INTO peminjam (kd_peminjam, nmpeminjam,alamat, no_telp, keterangan) VALUES('$kd_peminjam', '$nmpeminjam', '$alamat', '$no_telp', '$keterangan')") or die(mysqli_error($koneksi));

				if($sql){
					echo '<script>alert("Berhasil menambahkan data."); document.location="dashboard.php?page=tampil_peminjam";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				}
			}else{
				echo '<div class="alert alert-warning">Gagal, kode peminjam sudah terdaftar.</div>';
			}
		}
		?>

		
	

		<form action="dashboard.php?page=tambah_peminjam" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Kode Peminjam</label>
				<div class="col-md-6 col-sm-6 ">
					<input type="text" name="kd_peminjam" class="form-control" size="4" required placeholder="misal:PJ001">
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Peminjam</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="nmpeminjam" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Alamat</label>
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
				<label class="col-form-label col-md-3 col-sm-3 label-align">Keterangan</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="keterangan" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<div  class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
			</div>
		</form>
	</div>
