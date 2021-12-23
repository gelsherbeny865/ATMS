<?php
require('database.php');
if(isset($_POST['updatedata']))
{
	$id =$_POST['update_id'];
	$department_name =$_POST['dbnam'];
	$query="UPDATE department SET department='$department_name' WHERE id='$id' ";
	$query_run =mysqli_query($con ,$query);
	if($query_run)
	{
		echo '<script> alert("Data Updated");</script>';
		header('location:Departments.php');
		
	}else
	{
		echo '<script> alert("Data Not Updated");</script>';
	}
}
?>