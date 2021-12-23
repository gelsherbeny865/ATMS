<?php
require('database.php');
if(isset($_POST['updatedata']))
{
	$id =$_POST['update_id'];
	$employee_name =$_POST['employee_name'];
	$employee_email =$_POST['employee_email'];
	$employee_mobile =$_POST['employee_mobile'];
	$employee_password =$_POST['employee_password'];
	$employee_department_id =$_POST['employee_department_id'];
	$employee_address =$_POST['employee_address'];
	$employee_birthday =$_POST['employee_birthday'];
	$query="UPDATE `employee` SET `name`='$employee_name',`email`='$employee_email',`mobile`='$employee_mobile',`password`='$employee_password',`department_id`='$employee_department_id',`address`='$employee_address',`birthday`='$employee_birthday' WHERE id='$id'";
	$query_run =mysqli_query($con ,$query);
	if($query_run)
	{
		echo '<script> alert("Data Updated");</script>';
		header('location:Employees.php');
		
	}else
	{
		echo '<script> alert("Data Not Updated");</script>';
	}
}
?>