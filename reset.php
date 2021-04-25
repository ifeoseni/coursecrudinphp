<?php 

include ('include/header.php');

$resetStatus = $userdetail = $suggestOption = ""; 
 //$nameErr = $emailErr = $phoneErr = $majorlocationErr = $addressErr = $industryErr = $passwordErr = $remotestatusErr = "";
 
if (isset($_POST['reset']) ){
            $userdetail  = $_POST['userdetail'];
            $userphone = $_POST['userphone'];
            $userpassword= $_POST['userpassword'];


                $checkDetails = mysqli_query($conn,"SELECT * FROM users WHERE phone = '$userphone' AND  email = '$userdetail'") ;
                if (mysqli_num_rows($checkDetails) === 1) {//here is to ensure no one uses another email address
                    $updateAccount  = mysqli_query($conn, "UPDATE users SET password = '".md5($userpassword)."' WHERE name ='$userdetail' OR email = '$userdetail' ");
					if($updateAccount){

                        $resetStatus = "Your Account Has Been Reset Successfully. <a href='login.php'>Login here</a>";
                        header("refresh:5; url=login.php");
                    }else{

                        $resetStatus = "There was an error when trying to reset your password. Try again or create a new user account <a href='register.php'>here</a>";
                    }

                    
                }else{
                    $resetStatus = "Details Provided Not Correct. Check details before submitting";

                }

            

            

}


    

?>
<title>Reset Page For <?php echo $websiteName; ?></title>
<link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>

</head>

<body>                

                    <div class="col-lg-12 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class='card-head'>
                                <h2 class="text-center">Reset Password</h2>
                                <h3><?php echo $resetStatus; echo $suggestOption; ?></h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-12">Enter your email Address Here</label>
                                        <div class="col-md-12 border-bottom">
                                            <input type="email" name="userdetail" placeholder="Enter the email you used in."
                                                class="form-control" value="<?php echo $userdetail; ?>" required> 
                                        </div>                         
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-12">Enter The Phone Number You Used In Creating The Account Here</label>
                                        <div class="col-md-12 border-bottom">
                                            <input type="number" name="userphone" min="7000000000" max="9099999999"  placeholder="Enter your phone number here" required class="form-control" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Enter Password You Want To Use</label>
                                        <div class="col-md-12 border-bottom">
                                            <input type="password" name="userpassword" placeholder="Enter new password here" class="form-control" required >
                                        </div>
                                    </div>
                                     
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" type="submit" name="reset">RESET Account</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                             <div class="card-footer text-center">
                                <strong><a href="register.php">Create An Account Here</a> | <a href="login.php">Login Here</a></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>

</html>