<?php


include ('include/header.php');
if ( empty($_SESSION['login']) AND ($_SESSION['login'] !== true) ) {
	$_SESSION['out'] = "You do not have permission to login";
	header("location:login.php");
}
$report = "";
$name = $_SESSION['name']; $email = $_SESSION['email'];
if (isset($_POST['addCourse']) ) {
	$coursename = $_POST['coursename'];
	$checkuser = mysqli_query($conn,"SELECT * FROM courses WHERE name = '$name' ");
	if(mysqli_num_rows($checkuser) > 0){
		while($row = mysqli_fetch_assoc($checkuser)){
			if($row['coursename'] == $coursename){
				$report = "Course $coursename has been added already";
			}
		}

		$checkCourse =  mysqli_query($conn,"SELECT * FROM courses WHERE name = '$name' AND coursename ='$coursename' ");
		if (mysqli_num_rows($checkCourse) > 0) {
			$report =  "Course $coursename already exist";
		}else{
			$insert = mysqli_query($conn, "INSERT INTO courses (name,email,coursename) VALUES ('$name','$email','$coursename') ");
			if ($insert) {
				$report = $coursename ." has been added";
			}else{
				$report = "We could not add the course ". $coursename." at the moment";
			}		
		}

	}else{
		$insert = mysqli_query($conn, "INSERT INTO courses (name,email,coursename) VALUES ('$name','$email','$coursename') ");
		if ($insert) {
			$report = $coursename ." has been added";
		}else{
			$report = "We could not add the course ". $coursename." at the moment";
		}	
	}
	
}

	if(isset($_GET['logout'])){
	        session_unset();
	        $_SESSION['report'] = "You have just logged out from your account";
	        header("Location: login.php");

	}
	if (isset($_POST['editCourse'])) {
		$id = $_POST['id'];
		$changecoursename = $_POST['changecoursename'];
		 
		$editchange = mysqli_query($conn, "UPDATE courses SET coursename='$changecoursename' WHERE email='$email' AND id = '$id'");
		if ($editchange) {
			$_SESSION['report'] = "Course has been changed  to <strong>".$changecoursename."</strong>";
			
		}else{
			$_SESSION['report'] = "Change could not be effected to <strong>$newcoursename</strong>";
			
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title class="text-capitalize">Welcome <?php echo $name; ?></title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-lg-10 col-sm-12 text-center">
				<h1 class="text-center ">Welcome To The Course Portal</h1>
				<h3 class="text-center text-capitalize">Hi <?php echo $name; ?>, you can add, edit or delete a course on this portal. </h3>

			</div>
			<div class="col-md-2 col-lg-2 col-sm-12 text-center">
				<form action='dashboard.php' method='GET' class="row">
         		   <button type='submit' name='logout' class='btn btn-danger btn-sm btn-outline-danger btn-dark text-white   text-right '>Logout Here</button>
				</form>
			</div>
		</div>
	</div>

<?php
	if (isset($_SESSION['report']) ) {
		echo $_SESSION['report'];
		$_SESSION['report'] = "";
	}
?>
<h2>Add, View, Edit And Delete Courses Here</h2>
<?php echo $report; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-lg-8 col-sm-12"></div>
				<form class="form-horizontal form-material form-group" action="dashboard.php" method="POST" class="">		
				    <label>Add A Course Here In The Input Box Below</label><br>
					<input type="text" name="coursename" placeholder="Enter coursename here." class="form-inlline form-control-sm" required> 
					<button type="submit" name="addCourse" class="btn btn-success"> Add Course</button>
				</form>
		</div>
	</div>
	                              





            <?php

		$checkUser=  mysqli_query($conn,"SELECT * FROM courses WHERE name = '$name' AND email ='$email' ");
              if (mysqli_num_rows($checkUser) >0) {
              	$x = 1;
              echo "<table class='table table-striped table-dark'>";
        		 echo "<thead class='thead-dark'>";
         			echo "<tr>";
         			  echo "<th>ID</th>";
          			  echo "<th> Course </th>";
          			  echo "<th> Edit A Course </th>";
          			  echo "<th>Delete A Course </th>";
         			 echo "</tr>";
       			 echo "</thead>";
                while($row = mysqli_fetch_assoc($checkUser)){
                	
                  ?>
          <tr>
            <td> <?php echo $x;//$row['id']; ?></td>
            <td> <?php echo $row['coursename']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>&coursename=<?php echo $row['coursename']; ?>" class="text-info">Edit <?php echo $row['coursename'] ?></a>
            </td>
            <td>
            	<a href="delete.php?id=<?php echo $row['id']; ?>&coursename=<?php echo $row['coursename']; ?>"  class="text-danger">Delete <?php echo $row['coursename'] ?></a>
            </td>
          </tr>
          <?php
          		$x++;
              }
            }
            else{
                echo "You have not yet added a course.";
                $getCourses = mysqli_query($conn,"SELECT DISTINCT coursename FROM courses");
                if(mysqli_num_rows($getCourses) > 0){
                	echo "Here are some available course you can add.<ol>";
                	while($row = mysqli_fetch_assoc($getCourses)){
                		echo "<li>".$row['coursename']."</li>";
                	}
                	echo "</ol>";
                }else{
                	echo "There are no courses suggested for you. Kindly upload any course you are interested in.";
                }

             }    
          ?>
      		</table>
<form action='dashboard.php' method='GET'>
	<button type='submit' name='logout' class="btn btn-sm btn-danger btn-outline-light">Logout Here</button>
</form>
</body>
</html>