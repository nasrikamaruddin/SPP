<?php
	require 'config.php';
	
    if(isset($_POST['register'])) {
		$errMsg = '';

		// Get data from FROM
		$pName = $_POST['pName'];
		$pIC = $_POST['pIC'];
		$pNoPhone = $_POST['pNoPhone'];
		$pAddress = $_POST['pAddress'];
		$pEmail = $_POST['pEmail'];
		$pRole = $_POST['pRole'];
		$pStatus = $_POST['pStatus'];
		$pUsername = $_POST['pUsername'];
		$pPassword = $_POST['pPassword'];

		if($pName == '')
			$errMsg = 'Enter your fullname';
		if($pIC == '')
			$errMsg = 'Enter I/C number';
		if($pNoPhone == '')
			$errMsg = 'Enter number phone';
		if($pAddress == '')
			$errMsg = 'Enter address';
		if($pEmail == '')
			$errMsg = 'Enter email address';
		if($pRole == '')
			$errMsg = 'Enter user role';
		
		if($pUsername == '')
			$errMsg = 'Enter username';
		if($pPassword == '')
			$errMsg = 'Enter password';

		if($errMsg == ''){
			try {
				$stmt = $connect->prepare('INSERT INTO person (pName, pIC, pNoPhone, pAddress, pEmail, pRole, pStatus, pUsername, pPassword) VALUES (:pName, :pIC, :pNoPhone, :pAddress, :pEmail, :pRole, :pStatus, :pUsername, :pPassword)');
				$stmt->execute(array(
					
					':pName' => $pName,
					':pIC' => $pIC,
					':pNoPhone' => $pNoPhone, 
					':pAddress' => $pAddress, 
					':pEmail' => $pEmail, 
					':pRole' => $pRole, 
					':pStatus' => $pStatus, 
					':pUsername' => $pUsername, 
					':pPassword' => $pPassword
					));
					
					/*echo '<script language="javascript">';
					echo 'alert("Congratulations, you have been registerd!")';
					echo '</script>'; */
				header('Location: login.php');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Signup | SPP</title>
	
    <!-- Include stylesheets for better appearance of login form -->
     
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body{padding-top:20px;background-color:#f9f9f9;}
    </style>
     
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        .control-label{
            text-align:left!important;
        }
    </style>
     
</head>
<body>
    <div class="container">
        
        <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">  
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Sign Up</div>
                     
				</div>  
                
				<div class="panel-body" >
                    <form id="signupform" class="form-horizontal" role="form" style="text-align:left;"  method="post">
                       
						<div class="form-group">
                            <label for="Name" class="col-md-4 control-label">FULL NAME</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="pName" placeholder="Name">
                            </div>
                        </div>
						<div class="form-group">
                            <label for="icNumber" class="col-md-4 control-label">IC NUMBER</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="pIC" placeholder="IC Number">
                            </div>
                        </div>
						<div class="form-group">
                            <label for="phoneNo" class="col-md-4 control-label">PHONE NUMBER</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="pNoPhone" placeholder="PHONE NUMBER">
                            </div>
                        </div>
						<div class="form-group">
                            <label for="address" class="col-md-4 control-label">ADDRESS</label>
                            <div class="col-md-8">
								<textarea class="form-control" name="pAddress" placeholder="Address" rows="3"></textarea>
                            </div>
                        </div>
						
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="pEmail" placeholder="Email Address">
                            </div>
                        </div>
						<div class="form-group">
                            <label for="userID" class="col-md-4 control-label">User Role</label>
                            <div class="col-md-8">
                                <select name="pRole" class="form-control">
									<option  value="teacher">Teacher</option>
									<option  value="student">Student</option>
								</select>
                            </div>
                        </div>
						
						<input type="hidden" class="form-control" name="pStatus" value="active" placeholder="status" >
						
                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">USERNAME</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="pUsername" placeholder="UserName">
                            </div>
                        </div>
                                
						<div class="form-group">
							<label for="password" class="col-md-4 control-label">PASSWORD</label>
							<div class="col-md-8">
								<input type="password" class="form-control" name="pPassword" placeholder="Password">
							</div>
						</div>
						                               
						 
						<div class="form-group">
							<!-- Button -->                                        
							<div class="col-md-offset-4 col-md-8">
								<input type="hidden" name="register" value="register">
									<button id="btn-signup" type="submit" class="btn btn-info"><i class="glyphicon glyphicon-hand-right"></i> &nbsp;Sign Up</button>
							</div>
						</div>
                        <div class="form-group" style="margin-bottom:0px;">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid #bce8f1; padding-top:15px; padding-left:10px; font-size:85%; margin: 0 -15px;" >Already have an account! 
                                    <a href="login.php">Login Here</a>
								</div>
							</div>
						</div> 
                    
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>