<?php
//include file config.php
error_reporting(0);
include('/config/config.php');
//jika benar mendapatkan GET id dari URL
if(isset($_GET['no_rm'])){
	//membuat variabel $id yang menyimpan nilai dari $_GET['id']
	$no_rm = $_GET['no_rm'];

	//melakukan query ke database, dengan cara SELECT data yang memiliki id yang sama dengan variabel $id
	$cek = mysqli_query($koneksi, "SELECT * FROM retensi WHERE no_rm='$no_rm'") or die(mysqli_error($koneksi));

	//jika query menghasilkan nilai > 0 maka eksekusi script di bawah
	if(mysqli_num_rows($cek) > 0){

		$data = mysqli_fetch_assoc($cek);

		$no_rm = $no_rm; //hehe
		$nm_pasien	= $data['nm_pasien'];
		$tgl_lahir	= $data['tgl_lahir'];
		$alamat		= $data['alamat'];
		$no_telp		= $data['no_telp'];
		$pekerjaan		= $data['pekerjaan'];
		$tmp_lahir		= $data['tmp_lahir'];
		$jenis_klm		= $data['jenis_klm'];
		$tgl_daftar		= $data['tgl_daftar'];
		$hari_ini		= date('Y-m-d');

		$sql = mysqli_query($koneksi, "INSERT INTO pasien(no_rm, nm_pasien, tgl_lahir, alamat,no_telp,pekerjaan,tmp_lahir,jenis_klm,tgl_daftar,recent_use) VALUES('$no_rm', '$nm_pasien', '$tgl_lahir', '$alamat', '$no_telp', '$pekerjaan', '$tmp_lahir', '$jenis_klm','$tgl_daftar','$hari_ini')") or die(mysqli_error($koneksi));
		$del = mysqli_query($koneksi, "DELETE FROM retensi WHERE no_rm='$no_rm'") or die(mysqli_error($koneksi));
		
		// tidak bisa menghandle error untuk row yang memiliki relasi;
		if($sql){
			echo '<script>alert("Berhasil recover data."); document.location="dashboard.php?page=retensi";</script>';
		}else{
			echo '<script>alert("Gagal recover data."); document.location="dashboard.php?page=retensi";</script>';
		}
	}else{
		echo '<script>alert("ID tidak ditemukan di database."); document.location="dashboard.php?page=retensi";</script>';
	}
}else{
	echo '<script>alert("ID tidak ditemukan di database."); document.location="dashboard.php?page=retensi";</script>';
}

?>
