<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo TITLE; ?></title>
	
	<!-- BOOTSTRAP LINKS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	
	<!-- CUSTOM CSS LINK -->
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
	
	<!-- FONT-AWESOME LINK -->
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- GOOGLE FONT LINK -->
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
</head>

<body>	
	<nav class="navbar navbar-expand-sm navbar-dark bg-danger fixed-top">
	  <a class="navbar-brand" href="index.php">OSMS</a>
	  <span class="navbar-text">Customer's happiness is our aim</span>
	</nav>

	<!-- Side bar -->
	<div class="container-fluid">
		<div class="row" style="margin-top:30px">
			<nav class="col-2 bg-light mt-5" >
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
						<li class="nav-item"><a class="nav-link" href="work.php">Work Order</a></li>
						<li class="nav-item"><a class="nav-link" href="request.php">Requests</a></li>
						<li class="nav-item"><a class="nav-link" href="assets.php">Assets</a></li>
						<li class="nav-item"><a class="nav-link" href="technician.php">Technician</a></li>
						<li class="nav-item"><a class="nav-link" href="soldproductreport.php">Sell Report</a></li>
						<li class="nav-item"><a class="nav-link" href="workreport.php">Work Report</a></li>
						<li class="nav-item"><a class="nav-link" href="changepass.php">Change Password</a></li>
						<li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
					</ul>
				</div>
			</nav>