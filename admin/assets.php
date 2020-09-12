<?php
	define("TITLE", "Assets");
	include_once("../dbConnection.php");
	session_start();
	
	if(!$_SESSION["is_adminlogin"]){
		header("location:login.php");
	}
	else{
		//echo "Welcome Admin";
	}
	
	include_once("includes/header.php");
	
	if(isset($_POST["delete"])){
		$id = $_POST["id"];
		$sql = "DELETE FROM assets_tb WHERE pid = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $id);	
		$result = $stmt->execute();
		if($result){
			$msg = '<div class="alert alert-success alert-dismissible" role="alert">
					  Product deleted successfully.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>';
		}
	}

?>


<div class="col-10 mt-5">
	<h4 class="bg-dark text-white text-center py-2 mt-3">List of Products</h4>
	
	<?php
		$sql = "select * from assets_tb";
		$stmt = $conn->prepare($sql);	
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
	?>		
	
		<table class="table text-center">
			<thead>
				<tr>
					<th scope="col">Product ID</th>
					<th scope="col">Name</th>
					<th scope="col">DOP</th>
					<th scope="col">Available</th>
					<th scope="col">Total</th>
					<th scope="col">Per Unit Original Cost</th>
					<th scope="col">Per Unit Selling Cost</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
					while($row = $result->fetch_assoc()){
				?>
				<tr>
					<td><?php echo $row["pid"]; ?></td>
					<td><?php echo $row["pname"]; ?></td>
					<td><?php echo $row["pdop"]; ?></td>
					<td><?php echo $row["pava"]; ?></td>
					<td><?php echo $row["ptotal"]; ?></td>
					<td><?php echo $row["poriginalcost"]; ?></td>
					<td><?php echo $row["psellingcost"]; ?></td>
					<td>
						<form action="editproduct.php" method="post" class="d-inline">
							<input type="hidden" name="id" value="<?php echo $row["pid"]; ?>" />
							<input type="submit" name="edit" class="btn btn-sm btn-info" value="Edit" />
						</form>
						<form action="" method="post" class="d-inline">
							<input type="hidden" name="id" value="<?php echo $row["pid"]; ?>" />
							<input type="submit" name="delete" class="btn btn-sm btn-secondary" value="Delete" />
						</form>
						<form action="sellproduct.php" method="post" class="d-inline">
							<input type="hidden" name="id" value="<?php echo $row["pid"]; ?>" />
							<input type="submit" name="sell" class="btn btn-sm btn-success" value="Sell" />
						</form>
					</td>
				</tr>
				<?php } ?>
			</tbody>
	    </table>	
	<?php
		}
		else{
			echo "<div class='text-center'>No Result</div>";
		}
	?>	
	
	<div>
		<a href="addproduct.php" class="btn btn-sm btn-danger float-right mr-5 mt-5" style="margin-top:20px"><i class="fa fa-plus"></i></a>
	</div>
</div>



<?php include_once("includes/footer.php"); ?>