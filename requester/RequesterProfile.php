<?php
	define("TITLE", "Profile");
	include_once("../dbConnection.php");
	session_start();
	if($_SESSION["is_login"]){
		$rEmail = $_SESSION["rEmail"];
	}
	else{
		header("location:RegisterLogin.php");
	}
	
	$sql = "select r_name, r_email from requesterlogin_tb where r_email = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $rEmail);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		$rName = $row["r_name"];
	}
	
	//USER UPDATE
	if(isset($_POST["nameupdate"])){
		$rName = $_POST["rName"];
		if($rName == ""){
			$passmsg = '<div class="alert alert-warning alert-dismissible" role="alert">
						  Please enter username.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
		}
		else{
			$sql = "UPDATE requesterlogin_tb SET r_name = ? WHERE r_email = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ss", $rName,$rEmail);
			$result = $stmt->execute();
			if($result){
				$passmsg = '<div class="alert alert-success alert-dismissible" role="alert">
							  Username updated successfully.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>';
			}
		}
	}
	
	include_once("includes/header.php");
?>

<div class="col-sm-4 mt-5 ml-5">
	<form action="" method="post">
	
		<?php
			if(isset($passmsg)){
				echo $passmsg;
			}
		?>
		
		<div class="form-group">
			<label for="email"><i class="fa fa-envelope"></i> Email</label>
			<input type="email" class="form-control" name="rEmail" id="email" value="<?php echo $rEmail; ?>" readonly>
		</div>
		<div class="form-group">
			<label for="name"><i class="fa fa-envelope"></i> Name</label>
			<input type="text" class="form-control" name="rName" id="name" value="<?php echo $rName; ?>">
		</div>
		<button type="submit" name="nameupdate" class="btn btn-danger">Update</button>
	</form>
</div>	
				

<?php include_once("includes/footer.php"); ?>