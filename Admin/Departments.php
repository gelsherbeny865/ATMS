<?php
	require('database.php');
if(!isset($_SESSION['ROLE'])){
	header('location:signin.php');
	die();
}
/*****************************Add Department********************************************/
	$query = mysqli_query($con , "SELECT * FROM `department` order by department desc");
if(isset($_POST['Department_name'])){
	$Department = mysqli_real_escape_string($con , $_POST['Department_name']);
	 mysqli_query($con , "INSERT INTO department(department) VALUES ('$Department')");
	header('location:Departments.php');
	die();
}
/*****************************************************************************************/
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<link rel="icon" href="../img/a.png" type="image/icon" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Department</title>
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
			color: rgb(194,83,111);
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
          <a class="nav-link" href="admin.php">Home</a>
        </li>
		<li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Departments.php">Departments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="LeavingT.php">Leaving Type</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="Employees.php">Employees</a>
        </li>
      </ul>
		<form  class="form-inline my-2 my-lg-0">
		<i  style="color: rgb(194,83,111);font-size: 20px" ></i>&nbsp;
		<h6 style="color: rgb(194,83,111);display: inline">Hello  | <?php echo $_SESSION['USER_NAME'] ?></h6>&nbsp;
		<a href="logout.php" data-toggle="tooltip" data-placement="top" title="logout"><i  style="color: rgb(194,83,111);font-size: 25px" class="fas fa-sign-out-alt" ></i></a>
		</form>
    </div>
  </div>
</nav>
	<!--End navbar------------------------------------------------------------------>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a  style="color:rgb(194,83,111)"class="nav-link active" id="department-tab" data-bs-toggle="tab" href="#department" role="tab" aria-controls="department" aria-selected="true"><i ></i>&nbsp;Department</a>
    <a  style="color:rgb(194,83,111)"class="nav-link" id="Adddp-tab" data-bs-toggle="tab" href="#Adddp" role="tab" aria-controls="Adddp" aria-selected="false"><i ></i>&nbsp;Add Department</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="department" role="tabpanel" aria-labelledby="department-tab">
	  <h1 align="center" style="font-weight: 900;font-family: bitter;font-size: 50px;padding: 10px;color:rgb(194,83,111);"><i ></i>&nbsp;Department</h1>
		<div class="container">
			<div class="row">
						 <div style="height: 100px auto;background-color: white;border-radius: 20px;text-align: center" class="table-responsive-sm">
								  <table class="table table-hover">
									 <thead>
										<tr style="font-size: 16px;">
										   <th>S.No</th>
										   <th>ID</th>
										   <th>Department Name</th>
										   <th></th>
										   <th></th>
										</tr>
									 </thead>
									 <tbody>
										 <?php
										 $i =1;
										 	while($row = mysqli_fetch_assoc($query)){
										 ?>
										<tr>
										   <td><?php echo $i ?></td>
										   <td><?php echo $row['id'] ?></td>
										   <td><?php echo $row['department'] ?></td>
										   <td align="right">
											   
											 	<button type="button"  class="btn btn-primary editbtn" >Edit</button>
										   		<a href="delete.php?id=<?php echo $row['id'] ?>&type=delete" class="btn btn-danger">Delete</a>
											 </td>

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
  <div class="tab-pane fade" id="Adddp" role="tabpanel" aria-labelledby="Adddp-tab">
	  	  <h1 align="center" style="font-weight: 900;font-family: bitter;font-size: 50px;padding: 10px;color:rgb(194,83,111);"><i ></i>&nbsp;Add Department</h1>
		<div class="container">
			<div align="center" class="row">
						 <form onsubmit="return validateform()" name="myform" method="post" class="col-md-12">
						  <div class="form-group ">
							  <label class=" control-label" for="Department_name"></label>
							  <div>
							  <input style="width: 50%;" type="text" id="Department_name" class="form-control input-md" placeholder="Enter the name of Department" name="Department_name" >
							  </div>
						  </div>
						 <div class="form-group ">
						  	<input style="width: 50%;margin-top: 20px" type="submit" value="Add" class="form-control input-md btn btn-primary"  name="submit">
					  	</div>			
						</form>
							</div>
						</div>
  </div>
</div>
<!----------------------------------------------update department----------------------------------------------------------------->
	<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
		<form action="update.php"  method="post">
      <div class="modal-body">
		 <input type="hidden" name="update_id" id="update_id"> 
        
          <div class="mb-3">
            <label for="dbnam" class="col-form-label">Rename Department:</label>
            <input type="text" class="form-control" name="dbnam" id="dbnam">
          </div>
       
      </div>
      <div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button name="updatedata" type="submit" class="btn btn-primary" >Update Department</button>
      </div>
	 </form>
    </div>
  </div>
</div>
<!----------------------------------------------------------------------------------------------------------------------------->
		<script>
		function validateform(){  
var name=document.myform.Department_name.value;
			if (name==null || name==""){  
		alert("Name can't be blank");  
		return false;  
	}else if(name.length<4){  
		alert("Name must be at least 4 characters long.");  
		return false;  
	} 
	}
	</script>
<script>
	$(document).ready(function(){
		$('.editbtn').on('click' , function(){
			$('#editmodal').modal('show');
				$tr =$(this).closest('tr');
				var data = $tr.children("td").map(function(){
					return $(this).text();
				}).get();
				console.log(data);
				$('#update_id').val(data[1]);
				$('#dbnam').val(data[2]);
			
		});
	});
	
	
	</script>
</body>
</html>