<?php
//include file config.php
// error_reporting(0);
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
		$no_retensi = $data['no_retensi'];
		print_r($no_retensi);
		$hari_ini = date('Y-m-d');
		$sql = mysqli_query($koneksi, "UPDATE pasien SET status = true, recent_use = '$hari_ini' WHERE no_rm ='$no_rm'") or die(mysqli_error($koneksi));
		
		// print_r($no_rm);
		
		// tidak bisa menghandle error untuk row yang memiliki relasi;
		if($sql){
			$del = mysqli_query($koneksi, "DELETE FROM retensi WHERE no_retensi = '$no_retensi'") or die(mysqli_error($koneksi));
			
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
