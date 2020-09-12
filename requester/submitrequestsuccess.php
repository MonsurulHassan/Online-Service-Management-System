<?php
	define("TITLE", "Success");
	include_once("includes/header.php");
	include_once("../dbConnection.php");
	session_start();
	
	if(!$_SESSION["is_login"]){
		header("location:RequesterLogin.php");
	}
	else{
		$myid = $_SESSION["myid"];
	}
	
	$sql = "select * from submitrequest_tb where request_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $myid);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		echo "<div class='ml-5 mt-5'>
				<table class='table'>
					<tbody>
						<tr>
							<th>Request ID</th>
							<td>".$row['request_id']."</td>
						</tr>
						<tr>
							<th>Name</th>
							<td>".$row['requester_name']."</td>
						</tr>
						<tr>
							<th>Email ID</th>
							<td>".$row['requester_email']."</td>
						</tr>
						<tr>
							<th>Request Info</th>
							<td>".$row['request_info']."</td>
						</tr>
						<tr>
							<th>Request Description</th>
							<td>".$row['request_desc']."</td>
						</tr>
						
						<tr>
							<td><form class='d-print-none'><input class='btn btn-danger' type='submit' value='Print' onClick='window.print()' /></form></td>
						</tr>
					</tbody>
				</table> 
			</div>";
	}
?>