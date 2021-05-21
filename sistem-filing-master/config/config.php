<?php
// // koneksi ke database mysql,
// $koneksi = mysqli_connect("localhost","root","","rumahsakit");

// //cek jika koneksi ke mysql gagal, maka akan tampil pesan berikut
// if (mysqli_connect_errno()){
	// 	echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_error();
	// }

	// functiongetUserAccessRoleByID($id)
	// {
		// 	global $koneksi;
		
		// 	$query = "select user_role from tbl_user_role where  id = ".$id;
		
		// 	$rs = mysqli_query($koneksi,$query);
		// 	$row = mysqli_fetch_assoc($rs);
		
		// 	return $row['user_role'];
		// }
		
		define("HOST","localhost");
		define("DB_USER","root");
		define("DB_PASS","");
		define("DB_NAME","rumahsakit");

		
		$koneksi = mysqli_connect(HOST,DB_USER,DB_PASS,DB_NAME);
		
		// if(!$koneksi)
		// {
		// 	die(mysqli_error());
		// }



function getUserAccessRoleByID($id)
{
	global $koneksi;
	
	$query = "select user_role from tbl_user_role where  id = ".$id;
	
	$rs = mysqli_query($koneksi,$query);
	$row = mysqli_fetch_assoc($rs);
	
	return $row['user_role'];
}
	include 'middlewere.php';
?> 


