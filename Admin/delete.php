<?php
	require('database.php');
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from department where id='$id'");
	header('location:Departments.php');
}
?>