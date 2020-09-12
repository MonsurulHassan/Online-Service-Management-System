<?php
	include_once("dbConnection.php");

	if(isset($_POST["rSignup"])){
		$rName = $_POST["rName"];
		$rEmail = $_POST["rEmail"];
		$rPassword = $_POST["rPassword"];
		
		if(($rName == "") || ($rEmail == "") || ($rPassword == "")){
			$regmsg = '<div class="alert alert-warning alert-dismissible" role="alert">
						  All fields are required.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
					   </div>';
		}
		else{
			$sql = "select * from requesterlogin_tb where r_email = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("s", $rEmail);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$regmsg = '<div class="alert alert-success alert-warning" role="alert">
							  E-mail address already exists!
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						   </div>';
			}
			else{
				$sql = "INSERT INTO requesterlogin_tb (r_name, r_email, r_password) VALUES (?,?,?)";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("sss", $rName,$rEmail,$rPassword);
				$result = $stmt->execute();
				if($result){
					$regmsg = '<div class="alert alert-success alert-dismissible" role="alert">
								  Registration successful.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
							   </div>';
				}
				else{
					$regmsg = '<div class="alert alert-success alert-danger" role="alert">
								  Registration unsuccessful.
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								  </button>
							   </div>';
				}
			}
		}
	}	
?>

<div class="container">
	<h2 class="text-center mt-5">Create an Account</h2>
	<div class="row mt-3">
		<div class="col-12 col-md-6 offset-md-3">
			<form action="" method="post" class="shadow-lg p-4">
			
			  <?php
				if(isset($regmsg)){
					echo $regmsg;
				}
			  ?>	
			
			  <div class="form-group">
				<label for="name"><i class="fa fa-user"></i> Name</label>
				<input type="text" class="form-control" name="rName" id="name" placeholder="Enter name">
			  </div>	
			  <div class="form-group">
				<label for="email"><i class="fa fa-envelope"></i> Email</label>
				<input type="email" class="form-control" name="rEmail" id="email" placeholder="Enter email">
			  </div>
			  <div class="form-group">
				<label for="password"><i class="fa fa-key"></i> Password</label>
				<input type="password" class="form-control" id="password" name="rPassword" placeholder="Password">
			  </div>
			  <button type="submit" name="rSignup" class="btn btn-danger btn-block mt-4">Signup</button>
			  <small>By clicking Signup, you agree to our terms, data policy and cookie policy.</small>
			</form>
		</div>
	</div>
</div>

