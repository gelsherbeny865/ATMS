<?php
	require('../database.php');
if(!isset($_SESSION['ROLE'])){
	header('location:../signin.php');
	die();
}
/*****************************Add  employee********************************************/
$name='';
$email='';
$mobile='';
$department_id='';
$address='';
$birthday='';
$id='';
	$db_id=mysqli_real_escape_string($con,$_SESSION['deparment_id']);
	$query = mysqli_query($con , "SELECT * FROM `employee` where role=3 and department_id='$db_id'  ");
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	if($_SESSION['ROLE']==3 && $_SESSION['USER_ID']!=$id){
		die('Access denied');
	}
	$res=mysqli_query($con,"select * from employee where id='$id'");
	$row=mysqli_fetch_assoc($res);
	$name=$row['name'];
	$email=$row['email'];
	$mobile=$row['phone'];
	$department_id=$row['department_id'];
	$address=$row['address'];
	$birthday=$row['birthday'];
}
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($con,$_POST['employeea_name']);
	$email=mysqli_real_escape_string($con,$_POST['employeea_email']);
	$mobile=mysqli_real_escape_string($con,$_POST['employeea_mobile']);
	$password=mysqli_real_escape_string($con,$_POST['employeea_password']);
	$department_id=mysqli_real_escape_string($con,$_POST['employeea_department']);
	$address=mysqli_real_escape_string($con,$_POST['employeea_address']);
	$birthday=mysqli_real_escape_string($con,$_POST['employeea_birthday']);
	$employeea_late=mysqli_real_escape_string($con,$_POST['employeea_late']);
	
		$sql="insert into employee(name,email,mobile,password,department_id,address,birthday,role,late_id) values('$name','$email','$mobile','$password','$department_id','$address','$birthday','3' ,'$employeea_late')";
	mysqli_query($con,$sql);
	header('location:Employees.php');
	die();

}
/*****************************************************************************************/
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<link rel="icon" href="../../img/a.png" type="image/icon" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title> employee</title>
	<!-- The library------------------------------------------------------------------------>
	<script src="../../js/jQuery.js" type="text/javascript"></script>
	<script src="../../js/popper.js" type="text/javascript"></script>
	<script src="../../js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../../js/all.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/hover-min.css">
	<link rel="stylesheet" type="text/css" href="../../css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/owl.theme.default.min.css">
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
    <a class="navbar-brand" href="admin.php">
		<img src="../../img/logo.png" alt="Logo" width="150px" height="30px">
	  </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="head.php">Home</a>
        </li>
<!--
		<li class="nav-item">
          <a class="nav-link" href="Departments.php"> Department</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="LeavingT.php">Leaving Type</a>
        </li>
-->
		<li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Employees.php">Employees</a>
        </li>
      </ul>
		<form  class="form-inline my-2 my-lg-0">
		<i  style="color: #00c292;font-size: 20px" class="fas fa-user-alt"></i>&nbsp;
		<h6 style="color: #00c292;display: inline">Hello  | <?php echo $_SESSION['USER_NAME'] ?></h6>&nbsp;
		<a href="../logout.php" data-toggle="tooltip" data-placement="top" title="logout"><i  style="color: #00c292;font-size: 25px" class="fas fa-sign-out-alt"></i></a>
		</form>
    </div>
  </div>
</nav>
	<!--End navbar------------------------------------------------------------------>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active" id="employee-tab" data-bs-toggle="tab" href="#employee" role="tab" aria-controls="employee" aria-selected="true"><i class="fas fa-users"></i>&nbsp;Employee</a>
    <a class="nav-link" id="Add_employee-tab" data-bs-toggle="tab" href="#Add_employee" role="tab" aria-controls="Add_employee" aria-selected="false"><i class="fas fa-cog"></i>&nbsp;Add Employee</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="employee" role="tabpanel" aria-labelledby="employee-tab">
	  <h1 align="center" style="font-weight: 900;font-family: bitter;font-size: 50px;padding: 10px;color: #00c292;"><i class="fas fa-users"></i>&nbsp;Employee</h1>
		<div class="container">
			<div class="row">
						 <div style="height: 100px auto;background-color: white;border-radius: 20px;text-align: center" class="table-responsive-sm">
								  <table class="table table-hover">
									 <thead>
										<tr style="font-size: 16px;">
										   <th>S.No</th>
										   <th>ID</th>
										   <th>Name</th>
										   <th>Email</th>
										   <th>Mobile</th>
										   <th>Address</th>
										   <th>Birthday</th>
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
										   <td><?php echo $row['name'] ?></td>
										   <td><?php echo $row['email'] ?></td>
										   <td><?php echo $row['phone'] ?></td>
										   <td><?php echo $row['address'] ?></td>
										   <td><?php echo $row['birthday'] ?></td>
										   <td align="right">
											   
											 	<button type="button"  class="btn btn-primary editbtn" >Edit</button>
										   		<a href="delete_employee.php?id=<?php echo $row['id'] ?>&type=delete" class="btn btn-danger">Delete</a>
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
  <div class="tab-pane fade" id="Add_employee" role="tabpanel" aria-labelledby="Add_employee-tab">
	  	  <h1 align="center" style="font-weight: 900;font-family: bitter;font-size: 50px;padding: 10px;color: #00c292;"><i class="fas fa-cog"></i>&nbsp;Add Employee</h1>
		<div class="container">
			<div align="center" class="row">
						 <form name="myform"  method="post" onsubmit="return validateform()" class="col-md-12">
						  <div  class="form-group ">
							  <label  class=" control-label" for="employeea_name"></label>
							  <div>
							  <input style="width: 50%;" type="text" id="employeea_name" class="form-control input-md" placeholder="Enter the name of Employee" name="employeea_name" require maxlength="6">
							  </div>
						  </div>
							
						  <div class="form-group ">
							  <label class=" control-label" for="employeea_email"></label>
							  <div>
							  <input style="width: 50%;" type="email" id="employeea_email" class="form-control input-md" placeholder="Enter the email of Employee" name="employeea_email" required >
							  </div>
						  </div>						 
						  <div class="form-group ">
							  <label class=" control-label" for="employeea_mobile"></label>
							  <div>
							  <input style="width: 50%;" type="number" id="employeea_mobile" class="form-control input-md" placeholder="Enter the Mobile of Employee" name="employeea_mobile" required>
							  </div>
							 </div>
							 <div class="form-group ">
							  <label class=" control-label" for="employeea_password"></label>
							  <div>
							  <input style="width: 50%;" type="password" id="employeea_password" class="form-control input-md" placeholder="Enter the Password of Employee" name="employeea_password" required="">
							  </div>
							 </div>
							 <div class="form-group ">
							  <label class="form-control-label" for="employeea_department"></label>
							  <div>
									<select style="width: 50%;" name="employeea_department" required class="form-control">
										<option value="">Select Department</option>
										<?php
										$res=mysqli_query($con,"select * from department where id=$db_id ");
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
						  </div>
							 <div class="form-group ">
							  <label class="form-control-label" for="employeea_late"></label>
							  <div>
									<select style="width: 50%;" name="employeea_late" required class="form-control">
										<option selected='selected'  value="">Select User_no</option>
										<?php
										$res=mysqli_query($con,"select * from late where department_id=$db_id ");
										while($row=mysqli_fetch_assoc($res)){
											
												echo "<option  value=".$row['late_id'].">".$row['user_no']."</option>";
											
											
										}
										?>
									</select>
							  </div>
						  </div>
						  <div class="form-group ">
							  <label class=" control-label" for="employeea_address"></label>
							  <div>
							  <input style="width: 50%;" type="text" id="employeea_address" class="form-control input-md" placeholder="Enter the Address of Employee" name="employeea_address" required="">
							  </div>
						  </div>						 
						  <div class="form-group ">
							  <label class=" control-label" for="employeae_name"></label>
							  <div>
							  <input style="width: 50%;" type="date" id="employeea_birthday" class="form-control input-md" name="employeea_birthday" required="">
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
<!--*****************************modul******************************************************-->
	<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Employee Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
		<form action="update_employee.php"  method="post">
      <div class="modal-body">
		 <input type="hidden" name="update_id" id="update_id"> 
        
          <div class="mb-3">
            <label for="employee_name" class="col-form-label">Edit Name:</label>
            <input type="text" class="form-control" name="employee_name" id="employee_name">
          </div>
		  <div class="mb-3">
            <label for="employee_email" class="col-form-label">Edit Email:</label>
            <input type="text" class="form-control" name="employee_email" id="employee_email">
          </div>
		  <div class="mb-3">
            <label for="employee_mobile" class="col-form-label">Edit Mobile:</label>
            <input type="text" class="form-control" name="employee_mobile" id="employee_mobile">
          </div>
		  <div class="mb-3">
            <label for="employee_password" class="col-form-label">Edit password:</label>
            <input type="password" class="form-control" name="employee_password" id="employee_password" required>
          </div>
		  <div class="mb-3">
            <label for="employee_department_id" class="col-form-label">Edit Department:</label>
            									<select name="employee_department_id" required class="form-control">
										<option value="">Select Department</option>
										<?php
										$res=mysqli_query($con,"select * from department order by department desc");
										while($row=mysqli_fetch_assoc($res)){
											if($id==$row['id']){
												echo "<option selected='selected' value=".$row['id'].">".$row['department']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['department']."</option>";
											}
										}
										?>
								</select>
			  
          </div> 
		  <div class="mb-3">
            <label for="employee_address" class="col-form-label">Edit Address:</label>
            <input type="text" class="form-control" name="employee_address" id="employee_address">
          </div>
		  <div class="mb-3">
            <label for="employee_birthday" class="col-form-label">Edit Brithday Date:</label>
            <input type="date" class="form-control" name="employee_birthday" id="employee_birthday">
          </div> 
       
      </div>
      <div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button name="updatedata" type="submit" class="btn btn-primary" >Update Employee Data</button>
      </div>
	 </form>
    </div>
  </div>
</div>
<!--***********************************************************************************-->
	<script>  
function validateform(){  
var name=document.myform.employeea_name.value;  
var password=document.myform.employeea_password.value;  
var phone=document.myform.employeea_mobile.value;  
var x=document.myform.employeea_email.value;  
var atposition=x.indexOf("@");  
var dotposition=x.lastIndexOf(".");
if (name==null || name==""){  
		alert("Name can't be blank");  
		return false;  
	}
	else if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
	  alert("Please enter a valid e-mail address \n atpostion:"+atposition+"\n dotposition:"+dotposition);  
	  return false;  
  }
	else if(name.length<4){  
		alert("Name must be at least 4 characters long.");  
		return false;  
	} 
	else if (password.length<6) {
		alert("Password must be at least 6 characters long.");  
		return false;  
	}
	if (phone.isNaN) { 
            window.alert( 
              "Please enter your telephone number."); 
            phone.focus(); 
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
				$('#employee_name').val(data[2]);
				$('#employee_email').val(data[3]);
				$('#employee_mobile').val(data[4]);
				$('#employee_address').val(data[5]);
				$('#employee_birthday').val(data[6]);
//				
			
		});
	});
	
	
	</script>
  
</body>
</html>../