<?php
	define("TITLE", "Add Product");
	include_once("../dbConnection.php");
	session_start();
	
	if(!$_SESSION["is_adminlogin"]){
		header("location:login.php");
	}
	else{
		//echo "Welcome Admin";
	}
	
	include_once("includes/header.php");
	
	if(isset($_POST["psubmit"])){
		//$pid = $_POST["pid"];
		$pname = $_POST["pname"];
		$pdop = $_POST["pdop"];
		$pava = $_POST["pava"];
		$ptotal = $_POST["ptotal"];
		$poriginalcost = $_POST["poriginalcost"];
		$psellingcost = $_POST["psellingcost"];
		if($pname == "" || $pdop == "" || $pava == "" || $ptotal == "" || $poriginalcost == "" || $psellingcost == ""){
			$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
					  All fields are required.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>';
		}
		else{
			$sql = "INSERT INTO assets_tb (`pname`, `pdop`, `pava`, ptotal, poriginalcost, psellingcost) VALUES (?,?,?,?,?,?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ssiiii", $pname,$pdop,$pava,$ptotal,$poriginalcost,$psellingcost);
			$result = $stmt->execute();
			if($result){
				$msg = '<div class="alert alert-success alert-dismissible" role="alert">
						  Product added successfully.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}
			else{
				$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
						  Unable to add product! 
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
		<h4 class="text-center">Add Product</h4>
		
		<?php
			if(isset($msg)){
				echo $msg;
			}
		?>
		
		<form action="" method="post">
			<div class="form-group">
				<label>Name:</label>
				<input type="text" class="form-control" name="pname" />
			</div>
			<div class="form-group">
				<label>Date of Purchase:</label>
				<input type="date" class="form-control" name="pdop" />
			</div>
			<div class="form-group">
				<label>Available:</label>
				<input type="text" class="form-control" name="pava" onkeypress="isInputNumber(event)" />
			</div>
			<div class="form-group">
				<label>Total Quantity:</label>
				<input type="text" class="form-control" name="ptotal" onkeypress="isInputNumber(event)" />
			</div>
			<div class="form-group">
				<label>Original Cost:</label>
				<input type="text" class="form-control" name="poriginalcost" onkeypress="isInputNumber(event)" />
			</div>
			<div class="form-group">
				<label>Selling Cost:</label>
				<input type="text" class="form-control" name="psellingcost" onkeypress="isInputNumber(event)" />
			</div>
			
			<div class="text-center">
				<input type="submit" name="psubmit" class="btn btn-sm btn-danger" value="Add" />
				<a href="assets.php" class="btn btn-sm btn-secondary ml-1">Back</a>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	function isInputNumber(event){
		var ch = String.fromCharCode(event.which);
		if(!(/[0-9]/.test(ch))){
			event.preventDefault();
		}
	}
</script>



<?php include_once("includes/footer.php"); ?>	