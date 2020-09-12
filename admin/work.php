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
	
	if(isset($_POST["delete"])){
		$id = $_POST["id"];
		$sql = "DELETE FROM assignwork_tb WHERE request_id = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $id);	
		$result = $stmt->execute();
		if($result){
			$msg = '<div class="alert alert-success alert-dismissible" role="alert">
					  Deleted successfully.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>';
		}
	}
?>


<div class="col-9 mt-5">
	<?php
		if(isset($msg)){
			echo $msg;
		}
	?>
	<?php
		$sql = "select * from assignwork_tb";
		$stmt = $conn->prepare($sql);	
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
	?>		
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Req ID</th>
					<th scope="col">Req Info</th>
					<th scope="col">Name</th>
					<th scope="col">Address</th>
					<th scope="col">City</th>
					<th scope="col">Mobile</th>
					<th scope="col">Technician</th>
					<th scope="col">Assigned Date</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
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
					<td>
						<form action="viewassignwork.php" method="post" class="d-inline">
							<input type="hidden" name="id" value="<?php echo $row["request_id"]; ?>" />
							<input type="submit" name="view" class="btn btn-sm btn-warning" value="View" />
						</form>
						<form action="" method="post" class="d-inline">
							<input type="hidden" name="id" value="<?php echo $row["request_id"]; ?>" />
							<input type="submit" name="delete" class="btn btn-sm btn-secondary" value="Delete" />
						</form>
					</td>
				</tr>
				<?php } ?>
			</tbody>
	    </table>	
	<?php
		}
		else{
			echo "No Result";
		}
	?>		
</div>




<?php include_once("includes/footer.php"); ?>