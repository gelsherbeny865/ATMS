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
	$mobile=$row['phone'];
	$password=$row['password'];
	$department_id=$row['department_id'];
	$address=$row['address'];
	$birthday=$row['birthday'];
}
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$mobile=mysqli_real_escape_string($con,$_POST['phone']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$department_id=mysqli_real_escape_string($con,$_POST['department_id']);
	$address=mysqli_real_escape_string($con,$_POST['address']);
	$birthday=mysqli_real_escape_string($con,$_POST['birthday']);
	if($id>0){
		$sql="update employee set name='$name',email='$email',phone='$mobile',password='$password',department_id='$department_id',address='$address',birthday='$birthday' where id='$id'";
	}else{
		$sql="insert into employee(name,email,phone,password,department_id,address,birthday,role) values('$name','$email','$mobile','$password','$department_id','$address','$birthday','3')";
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
	<!--------------------------------JS--Link---------------------------------------------->
	<script src="../js/jQuery.js" type="text/javascript"></script>
	<script src="../js/popper.js" type="text/javascript"></script>
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../js/all.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../css/hover-min.css">
	<link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="../css/owl.theme.default.min.css">
	
	<!-----------------------------------CSS---------------------------------------------------->
	<link rel = "stylesheet" href = "../css/jquery.dataTables.css" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/elegant-icons-style.css" rel="stylesheet" />
    <link href="../css/font-awesome.min.css" rel="stylesheet" />    
    <link href="../css/bootstrap-fullcalendar.css" rel="stylesheet" />
	<link href="../css//fullcalendar.css" rel="stylesheet" />
    <link href="../css/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../css/owl.carousel.css" type="text/css">
	<link href="../css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/fullcalendar.css">
	<link href="../css/widgets.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style-responsive.css" rel="stylesheet" />
	<link href="../css/xcharts.min.css" rel=" stylesheet">	
	<link href="../css/jquery-ui-1.10.4.min.css" rel="stylesheet">
	<!--------------------------------------------------------------------------------------->
	<style>
		.navbar-dark .navbar-nav .nav-link.active, .navbar-dark .navbar-nav .show>.nav-link{
			color:rgb(194,83,111);
			font-size: 18px;
			font-weight: 500;
		}
	</style>
</head>

<body style="background:#eee;">
<!--Start navbar------------------------------------------------------------------>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a  style="color:rgb(194,83,111);" class="nav-link active" aria-current="page" href="employee_home.php">Home</a>
        </li>
		  <li class="nav-item"> 
          <a  style="color:rgb(194,83,111);"class="nav-link" href="employee.php">Profile</a>
        </li>
		<li class="nav-item">
          <a  style="color:rgb(194,83,111);"class="nav-link" href="LeavingR.php">Leaving Requests</a>
        </li>
      </ul>
		    <form class="form-inline my-2 my-lg-0">
		<i  style="color:rgb(194,83,111);font-size: 20px" class="fas fa-user-alt"></i>&nbsp;
		<h6 style="color:rgb(194,83,111);display: inline">Hello  | <?php echo $_SESSION['USER_NAME'] ?></h6>&nbsp;
		<a href="../Admin/logout.php" data-toggle="tooltip" data-placement="top" title="logout"><i  style="color:rgb(194,83,111);font-size: 25px" class="fas fa-sign-out-alt"></i></a>
    </form>
    </div>
  </div>
</nav>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a   style="color:rgb(194,83,111);" class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i ></i>&nbsp;Home</a>
  </li>
	</ul>
<div class="tab-content" id="myTabContent">
	<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class = "container bg-light" style = "margin-top:70px; background-color: #fff;border-radius: 40px">
              	<div class="row">
				  <div class="col-md-12">
					<div class = "well col-lg-12">
				<table id = "table" class = "table table-striped">
            
					<thead class = "alert-success" >
						<tr>
							
							<th>Employee ID</th>
							<th>Employee Details</th>
						
							<th>Time in</th>
							<th>Time out</th>
							<th>Date</th>
						
						
						</tr>
					</thead>
					<tbody>
					<?php
					$late_id=mysqli_real_escape_string($con,$_SESSION['late_id']);
					$sqll=("SELECT * FROM `atms`.`late` WHERE `late_id` ='$late_id'ORDER BY `late_id` ASC");
					$resl=mysqli_query($con ,$sqll);
					$row=mysqli_fetch_assoc($resl);
					
				
			
			
					$user_no = mysqli_real_escape_string($con,$row['user_no']);
						$q_time = $con->query("SELECT * FROM `timein` where user_no = '$user_no'") or die(mysqli_error());
						while($f_time=$q_time->fetch_array()){
						



					?>	
						<tr>
							<td><?php echo htmlentities($f_time['user_no'])?></td>
							<td><?php echo ucwords(htmlentities($f_time['user_name']))?></td>
							
							

							<td><?php echo htmlentities($f_time['time'])?></td>
							<td><?php echo htmlentities($f_time['out'])?></td>
							<td><?php echo date("m-d-Y", strtotime($f_time['date']))?></td>

							<?php
							}
						
							?>
						
						</tr>
						
				
					
					</tbody>
				<tr>
				
                  
				</table>
           
			</div>					  
				  </div>
			</div> 
		</div>
	</div>
         </div>	
	
	
	
		<script src = "../js/jquery.js"></script>
	<script src = "../js/bootstrap.js"></script>
	<script src = "../js/jquery.dataTables.js"></script>
	<script type = "text/javascript">
		$(document).ready(function(){
			$('#table').DataTable();
		});
	</script>
	



</body>
</html>
