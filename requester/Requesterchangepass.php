<?php
	define("TITLE", "Password Change");
	include_once("includes/header.php");
	include_once("../dbConnection.php");
	session_start();
	
	if(!$_SESSION["is_login"]){
		header("location:RequesterLogin.php");
	}
	else{
		$rEmail = $_SESSION["rEmail"];
	}
	
	if(isset($_POST["passupdate"])){
		$rPassword = $_POST["rPassword"];
		if($rPassword == ""){
			$passmsg = '<div class="alert alert-warning alert-dismissible" role="alert">
						  Please enter a password.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
		}
		else{
			$sql = "UPDATE requesterlogin_tb SET r_password = ? WHERE r_email = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ss", $rPassword, $rEmail);
			$result = $stmt->execute();
			if($result){
				$passmsg = '<div class="alert alert-success alert-dismissible" role="alert">
							  Password updated successfully.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>';
			}
			else{
				$passmsg = '<div class="alert alert-danger alert-dismissible" role="alert">
							  Error in password updated.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>';
			}
		}
	}
	
?>


<div class="col-sm-5 mt-5 ml-5">
	<form action="" method="post">
	
	<?php
		if(isset($passmsg)){
			echo $passmsg;	
		}
	?>
	
		<div class="form-group">
			<label>Email</label>
			<input type="email" class="form-control" value="<?php echo $rEmail; ?>" readonly>
		</div>
		<div class="form-group">
			<label>New Password</label>
			<input type="password" class="form-control" name="rPassword" placeholder="Enter new password">
		</div>
			
		<button type="submit" class="btn btn-danger mr-3" name="passupdate">Update</button>
	</form>
</div>	


<?php include_once("includes/footer.php"); ?>	