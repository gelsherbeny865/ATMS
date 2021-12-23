<?php
require ('../Admin/database.php');
if(!isset($_SESSION['ROLE'])){
	header('location:signin.php');
	die();
}
$name='';
$email='';
$mobile='';
$department_id='';
$address='';
$birthday='';
$id='';
if(isset($_SESSION['USER_ID'])){
	$id=mysqli_real_escape_string($con,$_SESSION['USER_ID']);
	if($_SESSION['ROLE']==3 && $_SESSION['USER_ID']!=$id){
		die('Access denied');
	}
	$res=mysqli_query($con,"select * from employee where id='$id'");
	$row=mysqli_fetch_assoc($res);
	$name=$row['name'];
	$email=$row['email'];
	$mobile=$row['mobile'];
	$password=$row['password'];
	$department_id=$row['department_id'];
	$address=$row['address'];
	$birthday=$row['birthday'];
}
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$department_id=mysqli_real_escape_string($con,$_POST['department_id']);
	$address=mysqli_real_escape_string($con,$_POST['address']);
	$birthday=mysqli_real_escape_string($con,$_POST['birthday']);
	if($id>0){
		$sql="update employee set name='$name',email='$email',mobile='$mobile',password='$password',department_id='$department_id',address='$address',birthday='$birthday' where id='$id'";
	}else{
		$sql="insert into employee(name,email,mobile,password,department_id,address,birthday,role) values('$name','$email','$mobile','$password','$department_id','$address','$birthday','3')";
	}
	mysqli_query($con,$sql);
	header('location:employee.php');
	die();
}
?>

<!doctype HTMl>
<html>
<head>
    <meta charset="utf-8">
	<link rel="icon" href="../img/a.png" type="image/icon" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Employee Page</title>
	<!-- The library------------------------------------------------------------------------>
	<script src="../js/jQuery.js" type="text/javascript"></script>
	<script src="../js/popper.js" type="text/javascript"></script>
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../js/all.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../css/hover-min.css">
	<link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="../css/owl.theme.default.min.css">
	
	<!--------------------------------------------------------------------------------------->
	<style>
		.navbar-dark .navbar-nav .nav-link.active, .navbar-dark .navbar-nav .show>.nav-link{
			color:  #00c292;
			font-size: 18px;
			font-weight: 500;
		}
	</style>
</head>

<body style="background:#eee;">
<!--Start navbar------------------------------------------------------------------>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
		<img src="../img/logo.png" alt="Logo" width="150px" height="30px">
	  </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="employee_home.php">Home</a>
        </li>
		  <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="employee.php">Profile</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="LeavingR.php">Leaving Requests</a>
        </li>
      </ul>
		    <form class="form-inline my-2 my-lg-0">
		<i  style="color: #00c292;font-size: 20px" class="fas fa-user-alt"></i>&nbsp;
		<h6 style="color: #00c292;display: inline">Hello  | <?php echo $_SESSION['USER_NAME'] ?></h6>&nbsp;
		<a href="../Admin/logout.php" data-toggle="tooltip" data-placement="top" title="logout"><i  style="color: #00c292;font-size: 25px" class="fas fa-sign-out-alt"></i></a>
    </form>
    </div>
  </div>
</nav>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i class="fas fa-user-edit"></i>&nbsp;Profile</a>
  </li>
	</ul>
<div class="tab-content" id="myTabContent">
	<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Profile Employee</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post">
							   <div class="form-group">
									<label class=" form-control-label">Name</label>
									<input type="text" value="<?php echo $name?>" name="name" placeholder="Enter employee name" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Email</label>
									<input type="email" value="<?php echo $email?>" name="email" placeholder="Enter employee email" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Mobile</label>
									<input type="text" value="<?php echo $mobile?>" name="mobile" placeholder="Enter employee mobile" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Password</label>
									<input type="password" value="<?php echo $password?>"  name="password" \ class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Department</label>
									<select name="department_id" required class="form-control">
										<option value="">Select Department</option>
										<?php
										$res=mysqli_query($con,"select * from department");
										while($row=mysqli_fetch_assoc($res)){
											if($department_id==$row['id']){
												echo "<option selected='selected' value=".$row['id'].">".$row['department']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['department']."</option>";
											}
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Address</label>
									<input type="text" value="<?php echo $address?>" name="address" placeholder="Enter employee address" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Birthday</label>
									<input type="date" value="<?php echo $birthday?>" name="birthday" placeholder="Enter employee birthday" class="form-control" required>
								</div>
							   <?php if($_SESSION['ROLE']==3){?>
							   <div class="form-group">
								   <label class=" form-control-label"></label>
							   <button style="width: 100%" type="submit" name="submit" class="btn  btn-primary">Submit</button>
							   </div>
							   <?php } ?>
							  </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>	
	
	
	
	
	


<!--End navbar------------------------------------------------------------------>
	         <script>
		 function update_leave_status(id,select_value){
			window.location.href='admin.php?id='+id+'&type=update&status='+select_value;
		 }
		 </script>
</body>
</html>
