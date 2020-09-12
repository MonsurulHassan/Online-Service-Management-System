<?php
	define("TITLE", "Technicians");
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
		$sql = "DELETE FROM technician_tb WHERE empid = ?";
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

<div class="col-10 mt-5">
	<h4 class="bg-dark text-white text-center py-2 mt-3">List of Technicians</h4>
	
	<?php
		$sql = "select * from technician_tb";
		$stmt = $conn->prepare($sql);	
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
	?>		
	
		<table class="table">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">City</th>
					<th scope="col">Mobile</th>
					<th scope="col">Email</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
					while($row = $result->fetch_assoc()){
				?>
				<tr>
					<td><?php echo $row["empid"]; ?></td>
					<td><?php echo $row["empName"]; ?></td>
					<td><?php echo $row["empCity"]; ?></td>
					<td><?php echo $row["empMobile"]; ?></td>
					<td><?php echo $row["empEmail"]; ?></td>
					<td>
						<form action="" method="post" class="d-inline">
							<input type="hidden" name="id" value="<?php echo $row["empid"]; ?>" />
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
	
	<div>
		<a href="insertemp.php" class="btn btn-sm btn-danger float-right mr-5 mt-5" style="margin-top:20px"><i class="fa fa-plus"></i></a>
	</div>
	
</div>



<?php include_once("includes/footer.php"); ?>