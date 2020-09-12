<?php
	include_once("../dbConnection.php");
	session_start();
	
	if(!isset($_SESSION["is_adminlogin"])){	
		if(isset($_POST["aLogin"])){
		$aEmail = htmlspecialchars(trim($_POST["aEmail"]));
		$aPassword = htmlspecialchars(trim($_POST["aPassword"]));
		
			if(($aEmail == "") || ($aPassword == "")){
				$regmsg = '<div class="alert alert-warning alert-dismissible" role="alert">
							  All fields are required.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						   </div>';
			}
			else{
				$sql = "select * from adminlogin_tb where a_email = ? and a_password = ?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("ss", $aEmail,$aPassword);
				$stmt->execute();
				$result = $stmt->get_result();
				if($result->num_rows > 0){
					$_SESSION["is_adminlogin"] = "loggedin";
					$_SESSION["aEmail"] = $aEmail;
					header("location:dashboard.php");
				}
				else{
					$regmsg = '<div class="alert alert-danger alert-dismissable" role="alert">
								  Login credentials do not match!
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
							   </div>';
				}
			}
		}
	}
	/* else{
		header("location:dashboard.php");
	} */
	
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Login</title>
	
	<!-- BOOTSTRAP LINKS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	
	<!-- CUSTOM CSS LINK -->
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
	
	<!-- FONT-AWESOME LINK -->
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- GOOGLE FONT LINK -->
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
</head>

<body>
	<div class="text-center mt-5">
		<h3 class="text-danger">Online Service Management System</h3>
		<h5 class="mt-3"><i class="fa fa-user-secret"></i> Admin Area</h5>
	</div>
	
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<form action="" method="post" class="p-4 shadow">

				  <?php
					if(isset($regmsg)){
						echo $regmsg;
					}
				  ?>	
				
				  <div class="form-group">
					<label for="email"><i class="fa fa-envelope"></i> Email</label>
					<input type="email" class="form-control" name="aEmail" id="email" placeholder="Enter email">
				  </div>
				  <div class="form-group">
					<label for="password"><i class="fa fa-key"></i> Password</label>
					<input type="password" class="form-control" id="password" name="aPassword" placeholder="Password">
				  </div>
				  <button type="submit" name="aLogin" class="btn btn-outline-danger btn-block mt-4">Login</button>
				</form>
				<div class="text-center"><a href="../index.php" class="btn btn-primary btn-sm mt-5" data-toggle="tooltip" data-placement="right" title="Back to Home"><i class="fa fa-home fa-2x"></i></a></div>
			</div>
		</div>
	</div>
</body>

</html>