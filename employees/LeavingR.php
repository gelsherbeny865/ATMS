<?php 
require ('../Admin/database.php');
if(!isset($_SESSION['ROLE'])){
	header('location:signin.php');
	die();
}
if($_SESSION['ROLE']==1){ 
	$sql="select `leave`.*, employee.name,employee.id as eid from `leave`,employee where `leave`.employee_id=employee.id order by `leave`.id desc";
}else{
	$eid=$_SESSION['USER_ID'];
	$sql="select `leave`.*, employee.name ,employee.id as eid from `leave`,employee where `leave`.employee_id='$eid' and `leave`.employee_id=employee.id order by `leave`.id desc";
}
$res=mysqli_query($con,$sql);
if(isset($_POST['submit'])){
	$leave_id=mysqli_real_escape_string($con,$_POST['leave_id']);
	$leave_from=mysqli_real_escape_string($con,$_POST['leave_from']);
	$leave_to=mysqli_real_escape_string($con,$_POST['leave_to']);
	$employee_id=$_SESSION['USER_ID'];
	$leave_description=mysqli_real_escape_string($con,$_POST['leave_description']);
	$sql="insert into `leave`(leave_id,leave_from,leave_to,employee_id,leave_description,leave_status) values('$leave_id','$leave_from','$leave_to','$employee_id','$leave_description',1)";
	mysqli_query($con,$sql);
	header('location:LeavingR.php');
	die();
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<link rel="icon" href="../img/a.png" type="image/icon" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Leaving Requests</title>
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
			.btn{
				cursor: default;
				border: none;
			}
			.btn-outline-success {
   			 color: #0bec84;
			}
			.btn-outline-success:hover{
				background-color: #0bec84;
				color: #fff;
			}
			btn-outline-danger {
    			color: #ff0000;
			}
			.btn-outline-warning:hover{
				color: #fff
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
          <a class="nav-link " href="employee_home.php">Home</a>
        </li>
		  <li class="nav-item">
          <a class="nav-link " href="employee.php">Profile</a>
        </li>
		<li class="nav-item">
          <a class="nav-link active"  aria-current="page" href="LeavingR.php">Leaving Requests</a>
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
<!--End navbar------------------------------------------------------------------>	
	
		<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="leaveR-tab" data-bs-toggle="tab" href="#leaveR" role="tab" aria-controls="leaveR" aria-selected="true"><i class="fas fa-level-up-alt"></i>&nbsp;Leave Request</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="Absences-tab" data-bs-toggle="tab" href="#Absences" role="tab" aria-controls="Absences" aria-selected="false"><i class="fas fa-plus-circle"></i>&nbsp;Add Leave Request</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="leaveR" role="tabpanel" aria-labelledby="leaveR-tab">
			<h1 align="center" style="font-weight: 900;font-family: bitter;font-size: 50px;padding: 10px;color: #00c292;"><i class="fas fa-level-up-alt"></i>&nbsp;Your Leaveing Requests</h1>
	  <div class="container">
               <div class="row">    
					<div style="height: 100px auto;background-color:white;border-radius: 20px;text-align: center;" class="table-responsive-sm">
                              <table class="table table-hover ">
                                 <thead>
                                    <tr>
                                       <th>S.No</th>
                                       <th>ID</th>
									   <th>Employee Name</th>
                                       <th>From</th>
									   <th class="">To</th>
									   <th>Description</th>
									   <th>Leave Status</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
									$i=1;
									while($row=mysqli_fetch_assoc($res)){?>
									<tr>
                                       <td><?php echo $i?></td>
									   <td><?php echo $row['id']?></td>
									   <td><?php echo $row['name'].' ('.$row['eid'].')'?></td>
                                       <td><?php echo $row['leave_from']?></td>
									   <td><?php echo $row['leave_to']?></td>
									   <td><?php echo $row['leave_description']?></td>
									   <td>
										   <?php
											if($row['leave_status']==1){
												echo "<i class='btn btn-outline-warning' style='font-weight:500'>Applied</i>";
											}if($row['leave_status']==2){
												echo "<i class='btn btn-outline-success' style='font-weight:500'>Approved</i>";
											}if($row['leave_status']==3){
												echo "<i class='btn btn-outline-danger' style='font-weight:500'>Rejected</i>";
											}
										   ?>
									   </td>
                                    </tr>
									<?php 
									$i++;
									} ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
  <div class="tab-pane fade" id="Absences" role="tabpanel" aria-labelledby="Absences-tab">
	  			<h1 align="center" style="font-weight: 900;font-family: bitter;font-size: 50px;padding: 10px;color: #00c292;"><i class="fas fa-plus-circle"></i>&nbsp;Add Leave Request</h1>
		  <div class="container">
		      <div class="row">
				  <div style="height: 100px auto;background-color:white;border-radius: 20px">
                        <div class="card-header"><strong>Leave Type</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form   onsubmit="return leavevalidate()"  name="leaveform" method="post">
						   
								<div class="form-group">
									<label class=" form-control-label">Leave Type</label>
									<select name="leave_id" required class="form-control">
										<option value="">Select Leave</option>
										<?php
										$res=mysqli_query($con,"select * from leave_type order by leave_type desc");
										while($row=mysqli_fetch_assoc($res)){
											echo "<option value=".$row['id'].">".$row['leave_type']."</option>";
										}
										?>
									</select>
								</div>
							   <div class="form-group">
									<label class=" form-control-label">From Date</label>
									<input type="date" name="leave_from"  class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">To Date</label>
									<input type="date" name="leave_to" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Leave Description</label>
									<input type="text" name="leave_description" class="form-control" >
								</div>
								
								 <button style="width: 100%;margin-top: 20px;color: white;font-size: 22px" type="submit" name="submit" class="btn btn-lg btn-info btn-block">Submit </button>
							  </form>
                        </div>
                     </div>
                  </div>
               </div>
	</div>
            </div>
		  </div>

		<!--  /////////////////////////////////////////////////////////////-->
<script>
function  leavevalidate(){

var leave_name=document.leaveform.leave_id.value;
var leave_from=document.leaveform.leave_from.value;
var leave_to=document.leaveform.leave_to.value;
var leave_desc=document.leaveform.leave_description.value;

if (leave_name ==""   && leave_from=="" && leave_to="" &&leave_desc=""){
	alert('please, enter all data ')
	return false;
}
}

	<!-- /////////////////////////////////////////////////////////////////////////////////////////////-->
</body>
</html>
