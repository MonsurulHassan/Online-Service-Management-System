<?php
	define("TITLE", "Service Status");
	include_once("../dbConnection.php");
	session_start();
	if(!$_SESSION["is_login"]){
		header("location:login.php");
	}
	
	include_once("includes/header.php");
	
	if(isset($_POST["search"])){
		$checkid = $_POST["checkid"];
		
		//TO CHECK BLANK INPUT FIELD	
		if($checkid == ""){
			$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
					  Please input your Request ID.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>';
		}
		//TO CHECK PENDING REQUEST
		else{
			$sql = "select request_id from submitrequest_tb where request_id = ?";
			$stmt = $conn->prepare($sql);	
			$stmt->bind_param("i", $checkid);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$msg = '<div class="alert alert-warning alert-dismissible" role="alert">
						  Your Request is pending.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}
			//TO CHECK ASSIGNED REQUEST DETAILS
			else{
				$sql = "select * from assignwork_tb where request_id = ?";
				$stmt = $conn->prepare($sql);	
				$stmt->bind_param("i", $checkid);
				$stmt->execute();
				$result = $stmt->get_result();
				if($result->num_rows > 0){
					$row = $result->fetch_assoc();
					$assign_msg = '<h3 class="mt-3">Assigned Work Details</h3>
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
									</div>';
				}
				//TO CHECK NON-EXIST REQUEST ID
				else{
					$msg = '<div class="alert alert-warning alert-dismissible" role="alert">
							  Please provide a valid Request ID.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>';
				}
			}			
		}
	}
?>

			
			<div class="col-sm-4 mt-5 ml-5">
			
				<?php
					/* if($_POST["close"]){
						echo '<meta http-equiv="refresh" content="0;URL=?closed" />';
					} */
					if(isset($msg)){
						echo $msg;
					}
				?>
			
				<form action="" method="post" class="d-print-none">
					<div class="form-group">
						<label for="checkid">Enter Request ID:</label>
						<input type="text" class="form-control" name="checkid" id="checkid" />
					</div>
					
					<input type="submit" name="search" class="btn btn-danger btn-sm" value="Search" />
				</form>
				
				<?php
					if(isset($assign_msg)){
						echo $assign_msg;
					}
				?>

			</div>
			
			
<?php include_once("includes/footer.php"); ?>