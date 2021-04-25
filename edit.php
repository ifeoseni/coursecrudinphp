<?php


include ('include/header.php');
if ( empty($_SESSION['login']) AND ($_SESSION['login'] !== true) ) {
	$_SESSION['out'] = "You do not have permission to access this page";
	header("location:login.php");
}

$id = $_GET['id']; 
$coursename=$_GET['coursename'];
$email = $_SESSION['email'];



?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Course</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-lg-8 col-sm-12 offset-md-2 offset-lg-2 text-center">
				<h1 class="text-center ">Welcome To The Course Portal</h1>
				<h3 class="text-center text-capitalize">Edit a course on this page. </h3>

				<form action='dashboard.php' method='POST' class="form-inline form-material">
					<label>Change course name from <?php echo $coursename; ?> to</label>
				    <input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="text" name="changecoursename" placeholder="Enter new course name here." class="form-control form-inline" required> 
					<input type="submit" name="editCourse" class='btn  btn-sm btn-outline-primary btn-success text-white off-set-4' value="Change Course Name"> 
				</form>
			</div>
		</div>
	</div>
         

        <div class="container">
        	<div class="row">
        		<div class="col-md-4 col-lg-4 col-sm-4"></div>
        		<div class="col-md-4 col-lg-4 col-sm-4">
        			<form action='dashboard.php' method='GET'>
						<button type='submit' name='logout' class="btn btn-sm btn-danger btn-outline-light">Logout Here</button>
					</form>
        		</div>
        		<div class="col-md-4 col-lg-4 col-sm-4"></div>
        	</div>
        	
        </div>                     
		
</body>
</html>