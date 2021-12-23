<?php
require('database.php');
if(isset($_POST['updatedata']))
{
	$id =$_POST['update_id'];
	$leave_type =$_POST['Leaving_type_name'];
	$query="UPDATE leave_type SET leave_type='$leave_type' WHERE id='$id' ";
	$query_run =mysqli_query($con ,$query);
	echo $leave_type;
	echo $id;
	if($query_run)
	{
		echo '<script> alert("Data Updated");</script>';
		header('location:LeavingT.php');
		
	}else
	{
		echo '<script> alert("Data Not Updated");</script>';
	}
}
?>