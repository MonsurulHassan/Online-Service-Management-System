<?php
	define("TITLE", "Work Report");
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
				$sql = "select * from assignwork_tb where assign_date between ? and ?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("ss", $startdate,$enddate);
				$stmt->execute();
				$result = $stmt->get_result();
	?>

				<p class="bg-dark text-center text-white py-2">Sell Details</p>
				<table class="table text-center">
					<thead>
						<tr>
							<th scope="col">Request ID</th>
							<th scope="col">Request Info</th>
							<th scope="col">Name</th>
							<th scope="col">Address</th>
							<th scope="col">City</th>
							<th scope="col">Mobile</th>
							<th scope="col">Technician</th>
							<th scope="col">Assigned Date</th>
						</tr>
					</thead>
					
					<tbody>
						<?php
							if(isset($result)){
								if($result->num_rows > 0){
									while($row = $result->fetch_assoc()){
						?>
						<tr>
							<td><?php echo $row["request_id"]; ?></td>
							<td><?php echo $row["request_info"]; ?></td>
							<td><?php echo $row["requester_name"]; ?></td>
							<td><?php echo $row["requester_add2"]; ?></td>
							<td><?php echo $row["requester_city"]; ?></td>
							<td><?php echo $row["requester_mobile"]; ?></td>
							<td><?php echo $row["assign_tech"]; ?></td>
							<td><?php echo $row["assign_date"]; ?></td>
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