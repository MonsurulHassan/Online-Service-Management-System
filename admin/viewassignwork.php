<?php
	define("TITLE", "Work Order");
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


<div class="col-9 mt-5">
	<?php
		if(isset($_POST["view"])){
			$id = $_POST["id"];
			$sql = "select * from assignwork_tb where request_id = ?";
				$stmt = $conn->prepare($sql);	
				$stmt->bind_param("i", $id);
				$stmt->execute();
				$result = $stmt->get_result();
				if($result->num_rows > 0){
				$row = $result->fetch_assoc();
				echo '<h3 class="mt-3">Assigned Work Details</h3>
						   <table class="table table-bordered">
								<tr>
									<th>Request ID</th>
									<td>'.$row["request_id"].'</td>
								</tr>
								<tr>
									<th>Requester Name</th>
									<td>'.$row["requester_name"].'</td>
								</tr>
								<tr>
									<th>Request Info</th>
									<td>'.$row["request_info"].'</td>
								</tr>
								<tr>
									<th>Requester Email</th>
									<td>'.$row["requester_email"].'</td>
								</tr>
								<tr>
									<th>Requester Mobile</th>
									<td>'.$row["requester_mobile"].'</td>
								</tr>
								<tr>
									<th>Assigned Technician</th>
									<td>'.$row["assign_tech"].'</td>
								</tr>
								<tr>
									<th>Assigned Date</th>
									<td>'.$row["assign_date"].'</td>
								</tr>
							</table>
							<div class="text-center">
								<input type="submit" class="btn btn-sm btn-danger d-print-none" onClick="window.print()" value="Print" />
								<a href="work.php" class="btn btn-sm btn-dark">Back</a>
							</div>';
			}
		}	
	?>
</div>


<?php include_once("includes/footer.php"); ?>