<?php
	define("TITLE", "Edit Product");
	include_once("../dbConnection.php");
	session_start();
	
	if(!$_SESSION["is_adminlogin"]){
		header("location:login.php");
	}
	else{
		//echo "Welcome Admin";
	}
	
	include_once("includes/header.php");
	
	if(isset($_POST["edit"])){
		$id = $_POST["id"];
		
		$sql = "select * from assets_tb where pid = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
		}
	}
	
	if(isset($_POST["pupdate"])){
		$id = $_POST["id"];
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
			$sql = "UPDATE `assets_tb` SET `pname`=?,`pdop`=?,`pava`=?,`ptotal`=?,`poriginalcost`=?,`psellingcost`=? WHERE pid = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ssiiiii", $pname,$pdop,$pava,$ptotal,$poriginalcost,$psellingcost,$id);
			$result = $stmt->execute();
			if($result){
				$msg = '<div class="alert alert-success alert-dismissible" role="alert">
						  Product updated successfully.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}
			else{
				$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
						  Unable to update product! 
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
		<h4 class="text-center">Update Product</h4>
		
		<?php
			if(isset($msg)){
				echo $msg;
			}
		?>
		
		<form action="" method="post">
			<div class="form-group">
				<label>Name:</label>
				<input type="text" class="form-control" name="pname" value="<?php if(isset($row["pname"])){echo $row["pname"];} ?>" />
			</div>
			<div class="form-group">
				<label>Date of Purchase:</label>
				<input type="date" class="form-control" name="pdop" value="<?php if(isset($row["pdop"])){echo $row["pdop"];}?>" />
			</div>
			<div class="form-group">
				<label>Available:</label>
				<input type="text" class="form-control" name="pava" value="<?php if(isset($row["pava"])){echo $row["pava"];}?>" onkeypress="isInputNumber(event)" />
			</div>
			<div class="form-group">
				<label>Total Quantity:</label>
				<input type="text" class="form-control" name="ptotal" value="<?php if(isset($row["ptotal"])){echo $row["ptotal"];}?>" onkeypress="isInputNumber(event)" />
			</div>
			<div class="form-group">
				<label>Original Cost:</label>
				<input type="text" class="form-control" name="poriginalcost" value="<?php if(isset($row["poriginalcost"])){echo $row["poriginalcost"];}?>" onkeypress="isInputNumber(event)" />
			</div>
			<div class="form-group">
				<label>Selling Cost:</label>
				<input type="text" class="form-control" name="psellingcost" value="<?php if(isset($row["psellingcost"])){echo $row["psellingcost"];}?>" onkeypress="isInputNumber(event)" />
			</div>
			
			<div class="text-center">
				<input type="hidden" name="id" value="<?php echo $row["pid"]; ?>" />
				<input type="submit" name="pupdate" class="btn btn-sm btn-danger" value="Update" />
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