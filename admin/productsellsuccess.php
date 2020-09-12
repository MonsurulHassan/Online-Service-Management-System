<?php
	define("TITLE", "Sell Success");
	include_once("../dbConnection.php");
	session_start();
	
	if(!$_SESSION["is_adminlogin"]){
		header("location:login.php");
	}
	
	include_once("includes/header.php");
?>

<div class="col-6 offset-2 mt-5">
	<h4 class="text-center">Customer Bill</h4>
	
	<?php
		if(isset($_SESSION["genid"])){
			$genid = $_SESSION["genid"];
			$sql = "select * from customer_tb where custid = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("i", $genid);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$row = $result->fetch_assoc();
				echo "<div class='ml-5 mt-5'>
						<table class='table'>
							<tbody>
								<tr>
									<th>Customer ID</th>
									<td>".$row['custid']."</td>
								</tr>
								<tr>
									<th>Customer Name</th>
									<td>".$row['custname']."</td>
								</tr>
								<tr>
									<th>Address</th>
									<td>".$row['custadd']."</td>
								</tr>
								<tr>
									<th>Product</th>
									<td>".$row['cpname']."</td>
								</tr>
								<tr>
									<th>Quantity</th>
									<td>".$row['cpquantity']."</td>
								</tr>
								<tr>
									<th>Per Unit Price</th>
									<td>".$row['cpeach']."</td>
								</tr>
								<tr>
									<th>Total Price</th>
									<td>".$row['cptotal']."</td>
								</tr>
								<tr>
									<th>Date</th>
									<td>".$row['cpdate']."</td>
								</tr>
								
								<tr>
									<td><form class='d-print-none'><input class='btn btn-danger' type='submit' value='Print' onClick='window.print()' /></form></td>
								</tr>
							</tbody>
						</table> 
					</div>";
			}
		}
		
	?>
	
</div>


<?php include_once("includes/footer.php"); ?>		