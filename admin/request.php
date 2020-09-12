<?php
	define("TITLE", "Requests");
	include_once("../dbConnection.php");
	session_start();
	
	if(!$_SESSION["is_adminlogin"]){
		header("location:login.php");
	}
	
	include_once("includes/header.php");
?>

<!-- CARDS CONTAINING REQUESTER INFO -->
<div class="col-4 mt-5 ml-4">
	<?php
		$sql = "select * from submitrequest_tb";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo '<div class="card bg-light mb-5" style="max-width: 18rem;">
					  <div class="card-header">Request ID: '.$row["request_id"].'</div>
					  <div class="card-body">
						<h5 class="card-title">Request Info: '.$row["request_info"].'</h5>
						<p class="card-text">Requester Name: '.$row["requester_name"].'</p>
						<p class="card-text">Requester Date: '.$row["request_date"].'</p>
						<div class="float-right">
							<form action="" method="post">
								<input type="hidden" name="id" value='.$row["request_id"].' />
								<input type="submit" name="view" class="btn btn-sm btn-danger" value="View" />
								<input type="submit" name="close" class="btn btn-sm btn-secondary" value="Close" />
							</form>
						</div>
					  </div>
					</div>';
			}
		}
	?>
</div>


<!-- REQUESTER DETAILS -->
<div class="col-5 mt-5 jumbotron">
	<form action="" method="post">
	
	<?php
		//DISPLAYING ALL INFO OF A PARTICULAR REQUESTER AFTER PRESSING VIEW BUTTON
		if(isset($_POST["view"])){
			$request_id = $_POST["id"];
			$sql = "select * from submitrequest_tb where request_id = ?";
			$stmt = $conn->prepare($sql);	
			$stmt->bind_param("i", $request_id);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$row = $result->fetch_assoc();
			}
		}
		
		//DELETING REQUESTER INFO BY PRESSING CLOSE BUTTON AFTER ASSIGNING WORK TO A TECHNICIAN 
		if(isset($_POST["close"])){
			$request_id = $_POST["id"];
			$sql = "DELETE FROM submitrequest_tb WHERE request_id = ?";
			$stmt = $conn->prepare($sql);	
			$stmt->bind_param("i", $request_id);
			$result = $stmt->execute();
			if($result){
				echo '<meta http-equiv="refresh" content="0;URL=?closed" />';
			}
			else{
				echo "Unable to delete";
			}
		}
		
		//ASSIGNING WORK TO THE TECHNICIAN
		if(isset($_POST["assign"])){
			$assigntech = $_POST["assigntech"];
			$inputdate = $_POST["inputdate"];
			if(($assigntech == "") || ($inputdate == "")){
				$msg = '<div class="alert alert-warning alert-dismissible" role="alert">
						  All fields are required.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}
			else{
				$rid = $_POST["requestid"];
				$requestinfo = $_POST["requestinfo"];
				$requestdesc = $_POST["requestdesc"];
				$requestername = $_POST["requestername"];
				$requesteradd1 = $_POST["requesteradd1"];
				$requesteradd2 = $_POST["requesteradd2"];
				$requestercity = $_POST["requestercity"];
				$requesterstate = $_POST["requesterstate"];
				$requesterzip = $_POST["requesterzip"];
				$requesteremail = $_POST["requesteremail"];
				$requestermobile = $_POST["requestermobile"];
				
				$sql = "INSERT INTO assignwork_tb (`request_id`, `request_info`, `request_desc`, `requester_name`, `requester_add1`, `requester_add2`, `requester_city`, `requester_state`, `requester_zip`, `requester_email`, `requester_mobile`, `assign_tech`, `assign_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$stmt = $conn->prepare($sql);	
				$stmt->bind_param("isssssssissss", $rid,$requestinfo,$requestdesc,$requestername,$requesteradd1,$requesteradd2,$requestercity,$requesterstate,$requesterzip,$requesteremail,$requestermobile,$assigntech,$inputdate);
				$result = $stmt->execute();
				if($result){
					$msg = '<div class="alert alert-success alert-dismissible" role="alert">
							  Work is assigned successfully.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>';
				}
				else{
					$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
							  Unable to assign work! 
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>';
				}
			}
		}
	?>
	
		<h3 class="text-center mb-4">Assign Work Order Request</h3>
		
		<?php
			if(isset($msg)){
				echo $msg;
			}
		?>
		
		<div class="form-group">
			<label>Request ID</label>
			<input type="text" class="form-control" name="requestid" value="<?php if(isset($row["request_id"])){echo $row["request_id"];} ?>" readonly>
		</div>
		<div class="form-group">
			<label>Request Info</label>
			<input type="text" class="form-control" name="requestinfo" value="<?php if(isset($row["request_info"])){echo $row["request_info"];} ?>" readonly>
		</div>
		<div class="form-group">
			<label>Description</label>
			<input type="text" class="form-control" name="requestdesc" value="<?php if(isset($row["request_desc"])){echo $row["request_desc"];} ?>"readonly>
		</div>
		<div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" name="requestername" value="<?php if(isset($row["requester_name"])){echo $row["requester_name"];} ?>"readonly>
		</div>
		
		<div class="form-row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Address Line 1</label>
					<input type="text" class="form-control" name="requesteradd1" value="<?php if(isset($row["requester_add1"])){echo $row["requester_add1"];} ?>"readonly>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Address Line 2</label>
					<input type="text" class="form-control" name="requesteradd2" value="<?php if(isset($row["requester_add2"])){echo $row["requester_add2"];} ?>"readonly>
				</div>
			</div>
		</div>
		
		<div class="form-row">
			<div class="col-md-5">
				<div class="form-group">
					<label>City</label>
					<input type="text" class="form-control" name="requestercity" value="<?php if(isset($row["requester_city"])){echo $row["requester_city"];} ?>"readonly>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>State</label>
					<input type="text" class="form-control" name="requesterstate" value="<?php if(isset($row["requester_state"])){echo $row["requester_state"];} ?>"readonly>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Zip</label>
					<input type="text" class="form-control" name="requesterzip" value="<?php if(isset($row["requester_zip"])){echo $row["requester_zip"];} ?>" readonly >
				</div>
			</div>
		</div>
		
		<div class="form-row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="requesteremail" value="<?php if(isset($row["requester_email"])){echo $row["requester_email"];} ?>"readonly>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Mobile</label>
					<input type="text" class="form-control" name="requestermobile" value="<?php if(isset($row["requester_mobile"])){echo $row["requester_mobile"];} ?>" readonly>
				</div>
			</div>
		</div>	
		
		<div class="form-row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Assign to Technician</label>
					<input type="text" class="form-control" name="assigntech" placeholder="Name of Technician">
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="form-group">
					<label>Date</label>
					<input type="date" class="form-control" name="inputdate">
				</div>
			</div>
		</div>	
		<div class="float-right">
			<input type="submit" class="btn btn-success mr-3" name="assign" value="Assign" />
			<input type="reset" class="btn btn-secondary mr-3" name="reset" value="Reset" />
		</div>
	</form>
</div>