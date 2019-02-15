<?php
 require 'config.php';
	
    if(isset($_POST['login'])) {
		$errMsg = '';

		// Get data from FROM
		//$pName = $_POST['pName'];
		//$pIC = $_POST['pIC'];
		//$pNoPhone = $_POST['pNoPhone'];
		//$pAddress = $_POST['pAddress'];
		//$pEmail = $_POST['pEmail'];
		//$pRole = $_POST['pRole'];
		//$pStatus = $_POST['pStatus'];
		$pUsername = $_POST['pUsername'];
		$pPassword = $_POST['pPassword'];

		/*
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
		*/
		if($pUsername == '')
			$errMsg = 'Enter Username';
		if($pPassword == '')
			$errMsg = 'Enter Password';

		if($errMsg == ''){
			try {
				$stmt = $connect->prepare('SELECT personId, uniqueID, pName, pUsername, pPassword, pRole FROM person WHERE pUsername = :pUsername');
				$stmt->execute(array(
					':pUsername' => $pUsername
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);

				if($data == false){
					$errMsg = "User $username not found.";
				}
				else {
					if($pPassword == $data['pPassword']) {
						$_SESSION['pName'] = $data['pName'];
						$_SESSION['uniqueID'] = $data['uniqueID'];
						$_SESSION['pUsername'] = $data['pUsername'];
						$_SESSION['pPassword'] = $data['pPassword'];
						$_SESSION['pRole'] = $data['pRole'];
						
						if ($_SESSION['pRole'] == "student"){
							header('Location: st/index.php');
						}
						else if($_SESSION['pRole'] == "teacher"){
							header('Location: tc/index.php');
						}	
						else if($_SESSION['pRole'] == "admin"){
							header('Location: ad/index.php');
						}							
						exit;
					}
					else
						$errMsg = 'Password not match.';
				}
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
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
    <title>Login | SPP</title>
	
    <!-- Include stylesheets for better appearance of login form -->
     
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body{padding-top:20px;background-color:#f9f9f9;}
    </style>
     <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
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
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                  
			<div class="panel panel-info" >
				<div class="panel-heading">
					<div class="panel-title">Sign In to myHomework</div>
				</div>
				
				<div style="padding-top:30px" class="panel-body">
				
					<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						 
					<form id="loginform" class="form-horizontal" role="form" method="post">
											 
						<div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="login-username" type="text" class="form-control" name="pUsername" value="" placeholder="Username">                                        
						</div>
										 
						<div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="login-password" type="password" class="form-control" name="pPassword" placeholder="Password">
						</div>
		 
						<div style="margin-top:10px" class="form-group">
							<!-- Button -->
							<div class="col-sm-12 controls">
								<input type="hidden" name="login" value="login">
								<button type="submit" id="btn-login" class="btn btn-success">Login</button>
							</div>
						</div>
						<!--
						<div class="form-group" style="margin-bottom:0px;">
							<div class="col-md-12 control">
								<div style="border-top: 1px solid #bce8f1; padding-top:15px; padding-left:10px; font-size:85%; margin: 0 -15px;" >Don't have an account! 
									<a href="signup.php">Sign Up Here</a>
								</div>
							</div>
						</div>
						-->						
					</form>     
				</div>                     
			</div>  
		</div>
    </div>
</body>
</html>