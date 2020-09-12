<?php
	define("TITLE", "Sell Product");
	include_once("../dbConnection.php");
	session_start();
	
	if(!$_SESSION["is_adminlogin"]){
		header("location:login.php");
	}
	else{
		//echo "Welcome Admin";
	}
	
	include_once("includes/header.php");
	
	if(isset($_POST["sell"])){
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
	
	if(isset($_POST["psubmit"])){
		$pid = $_POST["pid"];
		$pname = $_POST["pname"];
		$psellingcost = $_POST["psellingcost"];
		$pava = $_POST["pava"];
		$pquantity = $_POST["pquantity"];
		$cname = $_POST["cname"];
		$cadd = $_POST["cadd"];
		$selldate = $_POST["selldate"];
		$totalcost = $_POST["psellingcost"] * $_POST["pquantity"];
		
		if($pid == "" || $pname == "" || $psellingcost == "" || $pava == "" || $pquantity == "" || $cname == "" || $cadd == "" || $selldate == ""){
			$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
					  All fields are required except "Total Price".
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>';
		}
		else{
			$pava = $_POST["pava"] - $_POST["pquantity"];
			
			$sql = "INSERT INTO customer_tb (`custname`, `custadd`, `cpname`, `cpquantity`, `cpeach`, `cptotal`, `cpdate`) VALUES (?,?,?,?,?,?,?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("sssiiis", $cname,$cadd,$pname,$pquantity,$psellingcost,$totalcost,$selldate);
			$result = $stmt->execute();
			if($result){
				$_SESSION["genid"] = mysqli_insert_id($conn);
				$msg = '<div class="alert alert-success alert-dismissible" role="alert">
						  Product sold successfully.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}
			
			$upsql = "UPDATE assets_tb SET pava=? WHERE pid = ?";
			$stmt = $conn->prepare($upsql);
			$stmt->bind_param("ii", $pava,$pid);
			$result = $stmt->execute();	
			
			header("location:productsellsuccess.php");
		}
	}
?>


<div class="col-6 offset-2 mt-5">
	<div class="jumbotron">
		<h4 class="text-center">Customer Bill</h4>
		
		<?php
			if(isset($msg)){
				echo $msg;
			}
		?>
		<form action="" method="post">
			<div class="form-group">
				<label>Product ID:</label>
				<input type="text" class="form-control" name="pid" value="<?php if(isset($row["pname"])){echo $row["pid"];} ?>" readonly />
			</div>
			<div class="form-group">
				<label>Product Name:</label>
				<input type="text" class="form-control" name="pname" value="<?php if(isset($row["pname"])){echo $row["pname"];} ?>" readonly />
			</div>
			<div class="form-group">
				<label>Per Unit Product Price:</label>
				<input type="text" class="form-control" name="psellingcost" value="<?php if(isset($row["psellingcost"])){echo $row["psellingcost"];} ?>" readonly />
			</div>
			<div class="form-group">
				<label>Available:</label>
				<input type="text" class="form-control" name="pava" value="<?php if(isset($row["pava"])){echo $row["pava"];}?>" onkeypress="isInputNumber(event)" readonly />
			</div>
			<div class="form-group">
				<label>Selling Quantity:</label>
				<input type="text" class="form-control" name="pquantity" onkeypress="isInputNumber(event)" />
			</div>
			<div class="form-group">
				<label>Customer Name:</label>
				<input type="text" class="form-control" name="cname" />
			</div>
			<div class="form-group">
				<label>Customer Address:</label>
				<input type="text" class="form-control" name="cadd" />
			</div>
			<div class="form-group">
				<label>Date of Selling:</label>
				<input type="date" class="form-control" name="selldate" />
			</div>			
			
			<div class="text-center">
				<input type="submit" name="psubmit" class="btn btn-sm btn-danger" value="Submit" />
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