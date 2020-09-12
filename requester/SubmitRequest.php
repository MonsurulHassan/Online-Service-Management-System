<?php
	define("TITLE", "Submit Request");
	include_once("includes/header.php");
	include_once("../dbConnection.php");
	session_start();
	if(!$_SESSION["is_login"]){
		header("location:RequesterLogin.php");
	}
	else{
		$rEmail = $_SESSION["rEmail"];
	}
	
	
	if(isset($_POST["submitrequest"])){
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
		$requestdate = $_POST["requestdate"];
		
		if($requestinfo == "" || $requestdesc == "" || $requestername == "" || $requesteradd1 == "" || $requesteradd2 == "" || $requestercity == "" || $requesterstate == "" || $requesterzip == "" || $requesteremail == "" || $requestermobile == "" || $requestdate == ""){
			$msg = '<div class="alert alert-warning alert-dismissible" role="alert">
						  All fields are required.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
					</div>';
		}
		else{
			$sql = "INSERT INTO submitrequest_tb (`request_info`, `request_desc`, `requester_name`, `requester_add1`, `requester_add2`, `requester_city`, `requester_state`, `requester_zip`, `requester_email`, `requester_mobile`, `request_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("sssssssisis", $requestinfo,$requestdesc,$requestername,$requesteradd1,$requesteradd2,$requestercity,$requesterstate,$requesterzip,$requesteremail,$requestermobile,$requestdate);
			$result = $stmt->execute();
			if($result){
				$genid = mysqli_insert_id($conn);
				$_SESSION["myid"] = $genid;
				$msg = '<div class="alert alert-success alert-dismissible" role="alert">
						  Request submitted successfully
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
				header("location:submitrequestsuccess.php");		
			}
			else{
				$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
						  Error in request submission
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>';
			}
		}
	}	
?>


<div class="col-sm-8 col-md-9 mt-5 ml-5">
	<form action="" method="post">
	
	<?php
		if(isset($msg)){
			echo $msg;	
		}
	?>
	
		<div class="form-group">
			<label>Request Info</label>
			<input type="text" class="form-control" name="requestinfo" placeholder="Request Info">
		</div>
		<div class="form-group">
			<label>Description</label>
			<input type="text" class="form-control" name="requestdesc" placeholder="Write Description">
		</div>
		<div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" name="requestername" placeholder="Name">
		</div>
		
		<div class="form-row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Address Line 1</label>
					<input type="text" class="form-control" name="requesteradd1" placeholder="">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Address Line 2</label>
					<input type="text" class="form-control" name="requesteradd2" placeholder="">
				</div>
			</div>
		</div>
		
		<div class="form-row">
			<div class="col-md-6">
				<div class="form-group">
					<label>City</label>
					<input type="text" class="form-control" name="requestercity" placeholder="City">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>State</label>
					<input type="text" class="form-control" name="requesterstate" placeholder="">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>Zip</label>
					<input type="text" class="form-control" name="requesterzip" placeholder="Zip" onkeypress="isInputNumber(event)">
				</div>
			</div>
		</div>
		
		<div class="form-row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="requesteremail" placeholder="Email">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Mobile</label>
					<input type="text" class="form-control" name="requestermobile" placeholder="Mobile" onkeypress="isInputNumber(event)">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Date</label>
					<input type="date" class="form-control" name="requestdate">
				</div>
			</div>
			
			<button type="submit" class="btn btn-danger mr-3" name="submitrequest">Submit</button>
			<button type="reset" class="btn btn-secondary" name="submitrequest">Reset</button>
		</div>
	</form>
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

	