<?php
//include file config.php
include('/config/config.php');

//jika benar mendapatkan GET id dari URL
if(isset($_GET['kd_peminjam'])){
	//membuat variabel $id yang menyimpan nilai dari $_GET['id']
	$kd_peminjam = $_GET['kd_peminjam'];

	//melakukan query ke database, dengan cara SELECT data yang memiliki id yang sama dengan variabel $id
	$cek = mysqli_query($koneksi, "SELECT * FROM peminjam WHERE kd_peminjam='$kd_peminjam'") or die(mysqli_error($koneksi));

	//jika query menghasilkan nilai > 0 maka eksekusi script di bawah
	if(mysqli_num_rows($cek) > 0){
		//query ke database DELETE untuk menghapus data dengan kondisi id=$id
		$del = mysqli_query($koneksi, "DELETE FROM peminjam WHERE kd_peminjam='$kd_peminjam'") or die(mysqli_error($koneksi));
		if($del){
			echo '<script>alert("Berhasil menghapus data."); document.location="dashboard.php?page=tampil_peminjam";</script>';
		}else{
			echo '<script>alert("Gagal menghapus data."); document.location="dashboard.php?page=tampil_peminjam";</script>';
		}
	}else{
		echo '<script>alert("kode petugas tidak ditemukan di database."); document.location="dashboard.php?page=tampil_peminjam";</script>';
	}
}else{
	echo '<script>alert("kode petugas tidak ditemukan di database."); document.location="dashboard.php?page=tampil_peminjam";</script>';
}

?>
