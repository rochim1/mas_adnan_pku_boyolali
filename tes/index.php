<?php 
session_start();

require_once('config/config.php');

if(isset($_POST['login']))
{
	if(!empty($_POST['email']) && !empty($_POST['password']))
	{
		$email 		= trim($_POST['email']);
		$password 	= trim($_POST['password']);
		
		$md5Password = md5($password);
		
		$sql = "select * from tbl_users where email = '".$email."' and password = '".$md5Password."'";
		$rs = mysqli_query($koneksi,$sql);
		$getNumRows = mysqli_num_rows($rs);
		
		if($getNumRows == 1)
		{
			$getUserRow = mysqli_fetch_assoc($rs);
			unset($getUserRow['password']);
			
			$_SESSION = $getUserRow;
						
			header('location:dashboard.php');
			exit;
		}
		else
		{
			$errorMsg = " email atau password salah.";
		}
	}
}

if(isset($_GET['logout']) && $_GET['logout'] == true)
{
	session_destroy();
	header("location:index.php");
	exit;
}


if(isset($_GET['lmsg']) && $_GET['lmsg'] == true)
{
	$errorMsg = "Anda harus login terlebih dahulu";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Simple role based access control example using php and mysqli</title>
  <!-- Bootstrap core CSS-->
  <link href="assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header text-center">SELAMAT DATANG DI SISTEM FILLING  <br> RS PKU AISYIYAH BOYOLALI </div>
      <div class="card-body">
		<?php 
			if(isset($errorMsg))
			{
				echo '<div class="alert alert-danger">';
				echo $errorMsg;
				echo '</div>';
				unset($errorMsg);
			}
		?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" name="email" type="email" placeholder="Enter email" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" name="password" type="password" placeholder="Password" required>
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="login">Login</button>
        </form>
       
      </div>
    </div>
  </div>
 <!-- jQuery -->
 <script src="assets/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="assets/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="assets/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="assets/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="assets/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="assets/skycons/skycons.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="assets/js/custom.min.js"></script>
    <!-- datetime  -->
    <script src="assets/moment.min.js"></script>
</body>

</html>
