<?php
require ('database.php');
if(!isset($_SESSION['ROLE'])){
	header('location:signin.php');
	die();
}


if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from `leave` where id='$id'");
}
if(isset($_GET['type']) && $_GET['type']=='update' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	$status=mysqli_real_escape_string($con,$_GET['status']);
	mysqli_query($con,"update `leave` set leave_status='$status' where id='$id'");
}
if($_SESSION['ROLE']==1){ 
	$sql="select `leave`.*, employee.name,employee.id as eid from `leave`,employee where `leave`.employee_id=employee.id order by `leave`.id desc";
}else{
	$eid=$_SESSION['USER_ID'];
	$sql="select `leave`.*, employee.name ,employee.id as eid from `leave`,employee where `leave`.employee_id='$eid' and `leave`.employee_id=employee.id order by `leave`.id desc";
}
$res=mysqli_query($con,$sql);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<link rel="icon" href="../img/a.png" type="image/icon" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Page</title>
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
	<link rel = "stylesheet" href = "../css/jquery.dataTables.css" />
	<!--------------------------------------------------------------------------------------->
	<style>
		.navbar-dark .navbar-nav .nav-link.active, .navbar-dark .navbar-nav .show>.nav-link{
			color:  rgb(194,83,111);
			font-size: 18px;
			font-weight: 500;
		}
	</style>
</head>

<body style="background:#eee;">
<!--Start navbar------------------------------------------------------------------>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="admin.php">
		<img src="../img/download.jpg" alt="Logo" width="50px" height="30px">
	  </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin.php">Home</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="Departments.php">Departments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="LeavingT.php">Leaving Type</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="Employees.php">Employees</a>
        </li>
      </ul>
		    <form class="form-inline my-2 my-lg-0">
		<i  style="color:rgb(194,83,111);font-size: 20px" ></i>&nbsp;
		<h6 style="color: rgb(194,83,111);display: inline">Hello  | <?php echo $_SESSION['USER_NAME'] ?></h6>&nbsp;
		<a href="logout.php" data-toggle="tooltip" data-placement="top" title="logout"><i  style="color:rgb(194,83,111);font-size: 25px"  class="fas fa-sign-out-alt"></i></a>
    </form>
    </div>
  </div>
</nav>
	<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a  style="color:rgb(194,83,111)"class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i ></i>&nbsp;Home</a>
  </li>
  <li class="nav-item" role="presentation">
    <a  style="color:rgb(194,83,111)"class="nav-link" id="Absences-tab" data-bs-toggle="tab" href="#Absences" role="tab" aria-controls="Absences" aria-selected="false"><i></i>&nbsp;Absences</a>
  </li>
  <li class="nav-item" role="presentation">
    <a  style="color:rgb(194,83,111)"class="nav-link" id="immediately-tab" data-bs-toggle="tab" href="#immediately" role="tab" aria-controls="immediately" aria-selected="false"><i ></i>&nbsp;Attendance</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		<h1 align="center" style="font-weight: 900;font-family: bitter;font-size: 50px;padding: 10px;color:rgb(194,83,111);"><i ></i>&nbsp;leaving requests</h1>
		<div class="container">
			<div class="row">
						 <div style="height: 100px auto;background-color: white;border-radius: 20px;text-align: center" class="table-responsive-sm bg-white">
							 <br>
								 <table id="table" class="table table-hover ">
                                 <thead class="alert-warning">
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
									   <th width="15%">Employee Name</th>
                                       <th width="14%">From</th>
									   <th width="14%">To</th>
									   <th width="15%">Description</th>
									   <th width="18%">Leave Status</th>
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
												echo "Applied";
											}if($row['leave_status']==2){
												echo "Approved";
											}if($row['leave_status']==3){
												echo "Rejected";
											}
										   ?>
										   <?php if($_SESSION['ROLE']==1){ ?>
										   <select class="form-control" onchange="update_leave_status('<?php echo $row['id']?>',this.options[this.selectedIndex].value)">
											<option value="">Update Status</option>
											<option value="2">Approved</option>
											<option value="3">Rejected</option>
										   </select>
										   <?php } ?>
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
  <div class="tab-pane fade" id="Absences" role="tabpanel" attendance aria-labelledby="Absences-tab">
	  		<h1 align="center" style="font-weight: 900;font-family: bitter;font-size: 50px;padding: 10px;color:rgb(194,83,111);"><i></i>&nbsp;A b s e n c e s</h1>
		<div class="container">
			<div class="row">
						 <div style="height: 100px auto;background-color: white;border-radius: 20px;text-align: center" class="table-responsive-sm">
							 <?php
							 $sqlh ="SELECT * FROM `timein`";
							 $reslh =mysqli_query($con,$sqlh);
							 $row=mysqli_fetch_assoc($reslh);
							 ?>
							 <br/>
								  <table id="table2" class="table table-hover ">
									 <thead class="alert-warning">
										<tr style="font-size: 16px;">
										   <th>S.No</th>
										   <th>ID</th>
										   <th>Employees ID</th>
										   <th>The Names of Employees </th>
										   <th>Time IN</th>
										   <th>Time Out</th>
										   <th>Date</th>
										</tr>
									 </thead>
									 <tbody>
								   <?php 
									$i=1;
									while($row=mysqli_fetch_assoc($reslh)){
										
										 ?>
										 
										<tr>
											<td><?php echo $i ?></td>
										   <td><?php echo $row['id'] ?></td>
										   <td><?php echo $row['user_no'] ?></td>
										   <td><?php echo $row['user_name'] ?></td>
										   <td><?php echo $row['time'] ?></td>
										   <td><?php echo $row['out'] ?></td>
										   <td><?php echo $row['date'] ?></td>
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
  <div class="tab-pane fade" id="immediately" role="tabpanel" aria-labelledby="immediately-tab">
	 		<h1 align="center" style="font-weight: 900;font-family: bitter;font-size: 50px;padding: 10px;color: rgb(194,83,111);"><i ></i>&nbsp;Attendance</h1>
		<div class="container">
			<div class="row">
						 <div style="height: 100px auto;background-color: white;border-radius: 20px;text-align: center"  class="table-responsive-sm">
							 <?php
							 $sqlh ="SELECT * FROM `late` where id = 'ONLINE'";
							 $resli =mysqli_query($con,$sqlh);

							 ?>
							 <br/>
								  <table id="table3" class="table table-hover ">
									 <thead class="alert-warning">
										<tr style="font-size: 16px;">
										   <th>S.No</th>
										   <th>ID</th>
										   <th>Uasr_no</th>
										   <th> Name</th>
										   <th> Status</th>
										</tr>
									 </thead>
									 <tbody>
								   <?php 
									$i=1;
										while($row=mysqli_fetch_assoc($resli)){
										
										 ?>
										<tr>
										   <td><?php echo $i ?></td>
										   <td><?php echo $row['late_id'] ?></td>
										   <td><?php echo $row['user_no'] ?></td>
										   <td><?php echo $row['user_name'] ?></td>
										   <td><?php echo $row['id'] ?></td

										</tr>
									<?php 
									$i++;
									} 
									 
											   ?>
									 </tbody>
								  </table>
								</div>
							</div>
						</div> 
  </div>
</div>
<!--End navbar------------------------------------------------------------------>
	<script src = "../js/jquery.dataTables.js"></script>
	         <script>
		 function update_leave_status(id,select_value){
			window.location.href='admin.php?id='+id+'&type=update&status='+select_value;
		 }
		 </script>
		<script type = "text/javascript">
		$(document).ready(function(){
			$('#table').DataTable();
			$('#table2').DataTable();
			$('#table3').DataTable();
		});
	</script>
</body>
</html>
