<?php
	define("TITLE", "Dashboard");
	include_once("../dbConnection.php");
	session_start();
	
	if(!$_SESSION["is_adminlogin"]){
		header("location:login.php");
	}
	else{
		//echo "Welcome Admin";
	}
	
	include_once("includes/header.php");
	
	$sql = "select max(request_id) from submitrequest_tb";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		$row = $result->fetch_row();
	}
	
	$sql = "select max(rno) from assignwork_tb";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		$row = $result->fetch_row();
	}
	
	$sql = "select * from technician_tb";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	$rows = $result->num_rows;
?>

			
	<div class="col-sm-9 col-md-10 mt-3">
		<div class="row mt-5 mx-auto">
			<div class="col-sm-4">
				<div class="card text-white bg-danger text-center" style="max-width: 18rem;">
				  <div class="card-header">Requests Received</div>
				  <div class="card-body">
					<h3 class="card-title font-weight-bold"><?php echo $row[0]; ?></h3>
					<a href="request.php" class="card-text text-white">View</a>
				  </div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card text-white bg-success text-center" style="max-width: 18rem;">
				  <div class="card-header">Assigned Works</div>
				  <div class="card-body">
					<h3 class="card-title font-weight-bold"><?php echo $row[0]; ?></h3>
					<a href="work.php" class="card-text text-white">View</a>
				  </div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card text-white bg-info text-center" style="max-width: 18rem;">
				  <div class="card-header">Number of Technicians</div>
				  <div class="card-body">
					<h3 class="card-title font-weight-bold"><?php echo $rows; ?></h3>
					<a href="technician.php" class="card-text text-white">View</a>
				  </div>
				</div>
			</div>
		</div>
		
		<div class="mt-5 text-center">
			<p class="bg-dark text-white p-2">List of Requesters</p>
			<?php
				$sql = "select * from requesterlogin_tb";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
				if($result->num_rows > 0){
					echo '<table class="table">
							  <thead>
								<tr>
								  <th scope="col">Requester ID</th>
								  <th scope="col">Name</th>
								  <th scope="col">Email</th>
								</tr>
							  </thead>';
								  
						  while($row = $result->fetch_assoc()){
							echo '<tbody>
									<tr>
									  <td>'.$row["r_login_id"].'</td>
									  <td>'.$row["r_name"].'</td>
									  <td>'.$row["r_email"].'</td>
									</tr>
								  </tbody>
						  </table>';
							}
				} 
			?>
			
		</div>
	</div>
			
	<?php include_once("includes/header.php"); ?>
		
