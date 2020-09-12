<?php
	define("TITLE", "Product Sell Report");
	include_once("../dbConnection.php");
	session_start();
	
	if(!$_SESSION["is_adminlogin"]){
		header("location:login.php");
	}
	else{
		//echo "Welcome Admin";
	}
	
	include_once("includes/header.php");
?>


<div class="col-sm-8 col-md-9 mt-5 ml-5">
	<form action="" method="post" class="mt-3">
		<div class="row">
			<div class="col-3">
				<div class="form-group">
					<input type="date" class="form-control" name="startdate" />
				</div>
			</div>
			<span>to</span>
			<div class="col-3">
				<div class="form-group">
					<input type="date" class="form-control" name="enddate" />
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-sm btn-danger ml-3" name="search">Search</button>
			</div>
		</div>
	</form>
	
	<?php
		if(isset($_POST["search"])){
			$startdate = $_POST["startdate"];
			$enddate = $_POST["enddate"];
			
			if($startdate == "" || $enddate == ""){
				echo '<div class="alert alert-danger alert-dismissible" role="alert">
					  Please select date range.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					 </div>';
			}
			else{
				$sql = "select * from customer_tb where cpdate between ? and ?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("ss", $startdate,$enddate);
				$stmt->execute();
				$result = $stmt->get_result();
	?>

				<p class="bg-dark text-center text-white py-2">Sell Details</p>
				<table class="table text-center">
					<thead>
						<tr>
							<th scope="col">Customer ID</th>
							<th scope="col">Customer Name</th>
							<th scope="col">Address</th>
							<th scope="col">Product Name</th>
							<th scope="col">Quantity</th>
							<th scope="col">Per Unit Selling Cost</th>
							<th scope="col">Total</th>
							<th scope="col">Date</th>
						</tr>
					</thead>
					
					<tbody>
						<?php
							if(isset($result)){
								if($result->num_rows > 0){
									while($row = $result->fetch_assoc()){
						?>
						<tr>
							<td><?php echo $row["custid"]; ?></td>
							<td><?php echo $row["custname"]; ?></td>
							<td><?php echo $row["custadd"]; ?></td>
							<td><?php echo $row["cpname"]; ?></td>
							<td><?php echo $row["cpquantity"]; ?></td>
							<td><?php echo $row["cpeach"]; ?></td>
							<td><?php echo $row["cptotal"]; ?></td>
							<td><?php echo $row["cpdate"]; ?></td>
						</tr>
						<?php 		
									}
								}
								else{
									echo "No Result";
								}
							}
						}} ?>
					</tbody>
				</table>
</div>


<?php include_once("includes/footer.php"); ?>