<?php 

include ('include/header.php');

if (isset($_SESSION['out'])) {
    echo $_SESSION['out'];
}

if (isset($_SESSION['report'])) {
    echo $_SESSION['report'];
}

$loginStatus = $suggestOption = $email = $report= ""; 
 //$nameErr = $emailErr = $phoneErr = $majorlocationErr = $addressErr = $industryErr = $passwordErr = $remotestatusErr = "";
 
if (isset($_POST['login']) ){
            $email  = $_POST['email'];
            $userpassword= $_POST['userpassword'];

                $checkDetails = mysqli_query($conn,"SELECT * FROM users WHERE email ='$email'  AND password ='".md5($userpassword)."' ");
                if (mysqli_num_rows($checkDetails) === 1) {//here is to ensure no one uses another email address
					$loginStatus = "User account found. You will soon be logged into your account.<br/>"; 
                    $_SESSION['login'] = true; $_SESSION['email'] = $email;  
                    while ($row = mysqli_fetch_assoc($checkDetails)) {
                        $_SESSION['name']  = $row['name'];         # code...
                    }                   
                         
                    header("refresh:3;url=dashboard.php");
                    
				}elseif( (mysqli_num_rows($checkDetails) > 1 ) ){
                    $loginStatus = "User account compromised.";
                    $suggestOption = "Get Across to the admin";
                }else{
                    $checkAccount = mysqli_query($conn,"SELECT email,name FROM users WHERE email = '$email'  ");
                    if(mysqli_num_rows($checkAccount) > 0 ){
                        $loginStatus = "Username or email exist but password do not match.";
                    }else{
                        $loginStatus = "Username or email is incorrect. Check again to confirm your name or email";
                    }
                    
                    $suggestOption = "<a href='reset.php'>Reset Password Here</a>";

                }

            

            

}


    

?>
<title class="text-capitalise">Login Page For <?php echo $websiteName; ?></title>
<link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>

<body>
     
        
            <div class="container-fluid">
                <div class="row">
                    <h1></h1>
                    <br/>
                    <h2 class="text-center">Login To The Course Portal</h2>
                    <div class="col-lg-2 col-xlg-2 col-md-2"></div>
                    <div class="col-lg-8 col-xlg-8 col-md-8">
                        <div class="card">
                            <div class='card-head'>
                                
                                <h3>
                                    <?php echo $loginStatus; echo $suggestOption; 
                                    if(!empty($_SESSION['errorReport'])) echo $_SESSION['errorReport']; ?>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                    <div class="mb-4">
                                        <label class="col-md-12 p-0">Enter Your Full Name Or Email Address Here</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" name="email" placeholder="Enter your full name or email address here."
                                                class="form-control" value="<?php echo $email; ?>" required> 
                                        </div>                         
                                    </div>
                                    <div class="mb-4">
                                        <label class="col-md-12 p-0">Enter Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" name="userpassword" placeholder="Enter your password here" class="form-control" required>
                                        </div>
                                    </div>
                                     
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success btn-lg" type="submit" name="login">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <strong><a href="register.php">Create An Account Here</a> | <a href="reset.php">Reset Account if you have forgotten your password</a></strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-xlg-2 col-md-2"></div>
                </div>
            </div>
        

</body>

</html>