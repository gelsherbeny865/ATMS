<?php
	require('database.php');
$masg ="";
if(isset($_POST['email']) && isset($_POST['password'])){
	$Email = mysqli_real_escape_string($con , $_POST['email']);
	$Password = mysqli_real_escape_string($con , $_POST['password']);
	$select = "select * from employee where email='$Email' and password='$Password'";
	$query = mysqli_query($con , $select);
	$count = mysqli_num_rows($query);
	if($count>0){
		$row = mysqli_fetch_assoc($query);
		$_SESSION['USER_ID'] = $row['id'];
		$_SESSION['USER_NAME'] = $row['name'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['mobile'] = $row['mobile'];
		$_SESSION['password'] = $row['password'];
		$_SESSION['deparment_id'] = $row['department_id'];
		$_SESSION['address'] = $row['address'];
		$_SESSION['birthday'] = $row['birthday'];
		$_SESSION['ROLE'] = $row['role'];
		$_SESSION['late_id'] = $row['late_id'];
		if($_SESSION['ROLE']==1){
		header('location:admin.php');
		die();
			}elseif($_SESSION['ROLE']==2){
			header('location:head/head.php');
			die();
		}elseif($_SESSION['ROLE']==3){
			header('location:../employees/employee_home.php');
			die();
		}
	}else{
		$masg ="Please Enter Correct Login Details";
	}
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<link rel="icon" href="../img/a.png" type="image/icon" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign IN Page</title>
	<!-- The library------------------------------------------------------------------------>
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../js/all.min.js" type="text/javascript"></script>
	<script src="../js/jQuery.js" type="text/javascript"></script>
	<script src="../js/popper.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../css/hover-min.css">
	<link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="../css/owl.theme.default.min.css">
	<link href="../css/signin.css" rel="stylesheet">
	<!--------------------------------------------------------------------------------------->
	<style>
		.alert-danger{
			color: red;
			background-color: inherit;
			border:none;
			font-size: 16px;;
			
		}
	</style>
  </head>
<body class="text-center">  
	<main class="form-signin">
	  <form action="" method="post">
		  <h6 style="color:#fff">Click To Check IN Attendance</h6>
		<a href="check_in.php"><img class="mb-4" src="../img/icons8-login-64.png" alt=">Attendance Form" width="80" height="80"></a>
		<h1 class="h3 mb-3 fw-normal"> Sign In</h1>
		<label for="inputEmail" class="visually-hidden">Email address</label>
		<input name="email" type="email" id="inputEmail" class="form-control" placeholder="Enter Your Email address" required autofocus>
		<label for="inputPassword" class="visually-hidden">Password</label>
		<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Enter Your Password" required>
		<button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
	  </form>
	</main>
  </body>
</html>