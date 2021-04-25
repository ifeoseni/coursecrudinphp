<?php 

include ('include/header.php');


$name = $email = $phone = ""; // to prevent errors from popping up

$emailReport = $nameReport = $passwordReport = $registerReport  = ""; 
 //$nameErr = $emailErr = $phoneErr = $majorlocationErr = $addressErr = $industryErr =  = $remotestatusErr = "";
 
if (isset($_POST['register']) ){
            $name  = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            

            if ($password === $cpassword) {
                $checkEmail = mysqli_query($conn,"SELECT * FROM users WHERE email ='$email'");
                if (mysqli_num_rows($checkEmail) > 0) {//here is to ensure no one uses another email address
					$emailReport = "The email is in use. Kindly contact the admin or create another account with another email. You can also login <a href='login.php'>here</a>";
				}else{
                    $checkName = mysqli_query($conn,"SELECT * FROM users WHERE name ='$name'");
                    if (mysqli_num_rows($checkName) > 0) {//here is to ensure no one uses another email address
                        $nameReport = "Someone is using that name. Complain to us by sending us an email with proof of owning the ID to help you resolve this issue";
                    }else{
                        $checkPassword = mysqli_query($conn,"SELECT * FROM users WHERE password ='".md5($password)."' ");
                        if (mysqli_num_rows($checkPassword) > 0) {//here is to ensure no one uses another email address
                            $passwordReport = "That password is too common. Kindly change it to ensure you are security compliant with our system.";
                        }else{
                            $insertUser = mysqli_query($conn,"INSERT INTO users(name,email,phone,password) values('$name','$email','$phone','".md5($password)."') ");  
                                if($insertUser){ 
                                    $_SESSION['login'] = true; $_SESSION['name'] = $name;  $_SESSION['email'] = $email; 
                                    $registerReport =  "Your account has been successfully created. You will be logged in to our system in the next 15 seconds. Check your biodata once again before you get into our system.";   
                                    header("location:dashboard.php");                             
                                    

                                // $_SESSION['']
                                }else{
                                    $registerReport = "We are sorry we could not create an account for you at the moment. Try some few minutes from now.";
                                } 
                        }//else of checkPassword > 0
                    }//else of checkName > 0
                }//else of mysqli_num_rows($checkEmail) > 0

                
 


            }else{//end of if of $password === $cpassword


                $passwordReport = "Password does not match";
            }
            

            

}


    

?>
<title>Register <?php echo $websiteName; ?></title>
<link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>



</head>

<body>
   <div class="bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h3 class="text-center">Create/Register Your Account Here</h3>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class='card-head'>                                
                                <h3><?php echo $emailReport; echo $nameReport; echo $passwordReport; echo $registerReport;  ?></h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Kindly Enter Your Name Here</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="name" placeholder="Enter your name here."
                                                class="form-control p-0 border-0"  value="<?php echo $name; ?>" required> 
                                        </div>                         
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Your Email Address </label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" name="email" placeholder="Enter your email address here"
                                                class="form-control p-0 border-0" 
                                                id="example-email" value="<?php echo $email; ?>" required >
                                        </div>
                                    </div>
                                     <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Your Contact Phone Number</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="number" name="phone" placeholder="Enter your phone number here. Ignore the country code"
                                                class="form-control p-0 border-0" 
                                                id="example-email"  min="7000000000" max="9099999999" value="<?php echo $phone; ?>" required ><br/>
                                                <small>Note that only Nigerian numbers are allowed</small>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Enter Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" name="password" class="form-control p-0 border-0" >
                                        </div>
                                    </div>
                                     <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Confirm Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" value="" name="cpassword" class="form-control p-0 border-0" >
                                        </div>
                                    </div>
                                  
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" type="submit" name="register">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                             <div class="card-footer text-center">
                                <strong><a href="login.php">Login To Your Account Here</a> | <a href="reset.php">Reset Account if you have forgotten your password</a></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>