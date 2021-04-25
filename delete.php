<?php


include ('include/header.php');
if ( empty($_SESSION['login']) AND ($_SESSION['login'] !== true) ) {
	$_SESSION['out'] = "You do not have permission to access this page";
	header("location:login.php");
}

$id = $_GET['id']; 
$coursename=$_GET['coursename'];
$email = $_SESSION['email'];

$delete= mysqli_query($conn,"DELETE FROM courses WHERE id='$id'  AND email = '$email'");
if($delete){
	$_SESSION['report'] = "$coursename has been deleted";
	header("refresh:3;url=dashboard.php");
}else{	
	$_SESSION['report'] = "Unable to delete $coursename at the moment. Try again later";
	header("refresh:3;url=dashboard.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Course</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body>
 You deletion process is taking place at the moment. You are temporarily here. You will be redirected back to the previous page in the next 3 seconds.
</body>
</html>