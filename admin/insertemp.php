<?php
	define("TITLE", "Technicians");
	include_once("../dbConnection.php");
	session_start();
	
	if(!$_SESSION["is_adminlogin"]){
		header("location:login.php");
	}
	else{
		//echo "Welcome Admin";
	}
	
	include_once("includes/header.php");
	
	if(isset($_POST["add"])){
		$name = $_POST["name"];
		$city = $_POST["city"];
		$mobile = $_POST["mobile"];
		$email = $_POST["email"];
		if($name == "" || $city == "" || $mobile == "" || $email == ""){
			$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
					  All fields are required.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>';
		}
		else{
			$sql = "INSERT INTO technician_tb (`empName`, `empCity`, `empMobile`, `empEmail`) VALUES (?,?,?,?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ssss", $name,$city,$mobile,$email);
			$result = $stmt->execute();
			if($result){
				$msg = '<div class="alert alert-success alert-dismissible" role="alert">
						  Technician added successfully.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}
			else{
				$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
						  Unable to add technician! 
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}
		}
		
	}

?>


<div class="col-6 offset-2 mt-5">
	<div class="jumbotron">
		<h4 class="text-center">Add New Technician</h4>
		
		<?php
			if(isset($msg)){
				echo $msg;
			}
		?>
		
		<form action="" method="post">
			<div class="form-group">
				<label>Name:</label>
				<input type="text" class="form-control" name="name" />
			</div>
			<div class="form-group">
				<label>City:</label>
				<input type="text" class="form-control" name="city" />
			</div>
			<div class="form-group">
				<label>Mobile:</label>
				<input type="text" class="form-control" name="mobile" />
			</div>
			<div class="form-group">
				<label>Email:</label>
				<input type="text" class="form-control" name="email" />
			</div>
			
			<div class="text-center">
				<input type="submit" name="add" class="btn btn-sm btn-danger" value="Add" />
				<a href="technician.php" class="btn btn-sm btn-secondary ml-1">Back</a>
			</div>
		</form>
		
	</div>
</div>




<?php include_once("includes/footer.php"); ?>