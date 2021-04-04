<?php include('/config/config.php');?>
		
	<div class="container" style="margin-top:20px">
		<center><font size="6">Edit Data</font></center>

		<hr>

		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['no_pinjam'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$no_pinjam = $_GET['no_pinjam'];

			//query ke database SELECT tabel mahasiswa berdasarkan id = $id
			$select = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE no_pinjam='$no_pinjam'") or die(mysqli_error($koneksi));

			//jika hasil query = 0 maka muncul pesan error
			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">Nomor pinjam tidak ada dalam database.</div>';
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
			$no_pinjam	= $_POST['no_pinjam'];
			$tgl_pinjam	= $_POST['tgl_pinjam'];
			$kd_petugas = $_POST['kd_petugas'];
			$tujuan_pinjam	= $_POST['tujuan_pinjam'];
			$lokasi_pinjam	= $_POST['lokasi_pinjam'];
			$tanggal_hrs_kmb	= $_POST['tanggal_hrs_kmb'];
			$no_rm = $_POST['no_rm'];
			$nm_pasien	= $_POST['nm_pasien'];
			$tgl_lahir	= $_POST['tgl_lahir'];


			$sql = mysqli_query($koneksi, "UPDATE peminjaman SET no_pinjam ='$no_pinjam', tgl_pinjam='$tgl_pinjam', kd_petugas='$kd_petugas', tujuan_pinjam='$tujuan_pinjam' , lokasi_pinjam='$lokasi_pinjam' , tanggal_hrs_kmb='$tanggal_hrs_kmb' , no_rm='$no_rm' , nm_pasien='$nm_pasien', tgl_lahir='$tgl_lahir' WHERE no_pinjam ='$no_pinjam'") or die(mysqli_error($koneksi));

			if($sql){
				echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php?page=tampil_peminjaman_DRM";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>

		<form action="dashboard.php?page=edit_peminjaman_DRM&no_pinjam=<?php echo $no_pinjam; ?>" method="post">
			<!-- asdadad -->
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nomor Pinjam</label>
				<div class="col-md-6 col-sm-6 ">
					<input type="text" name="no_pinjam" class="form-control" size="4" value="<?php echo $data['no_pinjam']; ?>" readonly required >
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Pinjam</label>
				<div class="col-md-6 col-sm-6">
					<input type="date"    name="tgl_pinjam" class="form-control" required>
				</div>
				
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Kode Petugas</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="kd_petugas" class="form-control" value="<?php echo $data['kd_petugas']; ?>"  required >
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Tujuan Pinjam</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="tujuan_pinjam" value="<?php echo $data['tujuan_pinjam']; ?>"  class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Lokasi Pinjam</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="lokasi_pinjam" value="<?php echo $data['lokasi_pinjam']; ?>"  class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Harus Kembali</label>
				<div class="col-md-6 col-sm-6">
					<input type="date" value="<?php echo $data['tanggal_hrs_kmb']; ?>"  name="tanggal_hrs_kmb" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nomor RM Pasien</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="no_rm" value="<?php echo $data['no_rm']; ?>"  class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Pasien</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="nm_pasien" value="<?php echo $data['nm_pasien']; ?>"  class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Lahir</label>
				<div class="col-md-6 col-sm-6">
					<input type="date" value="<?php echo $data['tgl_lahir']; ?>"  name="tgl_lahir" class="form-control" required>
				</div>
			</div>
			<div class="item form-group">
				<div  class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
			</div>
			<!-- asdasdasd -->
		</form>
	</div>
