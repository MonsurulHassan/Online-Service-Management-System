<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Online Service Management System</title>
	
	<!-- BOOTSTRAP LINKS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	
	<!-- JS FILES LINK -->
	<script type="text/javascript" src="js/googlemap.js"></script>
	
	<!-- CUSTOM CSS LINK -->
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	
	<!-- FONT-AWESOME LINK -->
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- GOOGLE FONT LINK -->
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
</head>

<body>
	<!-- START OF NAVIGATION -->
	<nav class="navbar navbar-expand-sm navbar-dark bg-danger fixed-top">
	  <a class="navbar-brand" href="index.php">OSMS</a>
	  <span class="navbar-text">Customer's happiness is our aim</span>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav pl-5 custom-nav">
		  <li class="nav-item">
			<a class="nav-link" href="#">Home</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#">Services</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#">Registration</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="Requester/RequesterLogin.php">Login</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#">Contact</a>
		  </li>
		</ul>
	  </div>
	</nav> 
	<!-- END OF NAVIGATION -->
	

	<!-- START OF BANNER -->
	<div class="back-image mt-5">
		<div class="content">
			<h4>WELCOME TO</h4>
			<h3>Online Service Management System</h3>
			<span>
				<a href="Requester/RequesterLogin.php" class="btn btn-outline-success">LOGIN</a>
				<a href="" class="btn btn-outline-info">SIGNIN</a>
			</span>
		</div>
	</div>
	<!-- END OF BANNER -->
	
	
	<!-- START OF INTRODUCTION -->
	<div class="container mt-4">
		<div class="jumbotron">
			<h3 class="text-center">OSMS Service</h3>
			<p class="text-justify">OSMS Service is Bangladesh's leading chain of multi-brand electronics and electrical service workshops offering wide array of services. We focus on enhancing your uses experience by offering world class electronic appliances maintenance services. Our sole mission is "To provide electronic appliances care services to keep the devices fit and customers happy and smiling". Our state of art workshops are conveniently located in many cities across the country. Just you need to register and can book your service online.</p>
		</div>
	</div>
	<!-- END OF INTRODUCTION -->
	
	
	<!-- START OF SERVICE -->
	<div class="container mt-5 border-bottom">
		<h2 class="text-center">Our Services</h2>
		<div class="row mt-4">
			<div class="col-sm-4 mt-3 mt-sm-0 text-center">
				<a href="#"><i class="fa fa-television fa-5x text-success"></i></a>
				<h4 class="text-center mt-3 mb-3">Electronic Appliances</h4>
			</div>
			<div class="col-sm-4 mt-3 mt-sm-0 text-center">
				<a href="#"><i class="fa fa-sliders fa-5x text-primary"></i></a>
				<h4 class="text-center mt-3 mb-3">Preventive Maintenance</h4>
			</div>
			<div class="col-sm-4 mt-3 mt-sm-0 text-center">
				<a href="#"><i class="fa fa-cogs fa-5x text-info"></i></a>
				<h4 class="text-center mt-3 mb-3">Fault Repair</h4>
			</div>
		</div>
	</div>
	<!-- END OF SERVICE -->
	
	
	<!-- START OF REGISTRATION -->
	<?php include_once("UserRegistration.php");  ?>
	<!-- END OF REGISTRATION -->
	
	
	<!-- START OF CONTACT US -->
	<div class="jumbotron mt-5">
		<div class="row text-center">
			<div class="col-12">
				<strong><h3>Head Office:</h3></strong>
				<strong>OSMS Private Limited</strong><br>
				<i class="fa fa-map-marker"></i> 106/5, Sobhanbag, Savar, Dhaka-1340.<br>
				<i class="fa fa-phone"></i> +8801752084840 <br>
				<a href="#" style="color:black"><i class="fa fa-info-circle"></i> www.osms.org</a><br><br>
			</div>
		</div>
		<div class="row">
			<?php include_once("contactform.php"); ?>
			<div class="col-12 col-sm-6">
				<div id="map">
				</div>
			</div>
		</div>
	</div>
	<!-- END OF CONTACT US -->
	
	
	<!-- START OF FOOTER -->
	<footer class="container-fluid bg-dark mt-1">
		<div class="container">
			<div class="row py-3">
				<div class="col-6 cust-footer-col">
					<span style="color:white">
						Follow us on
						<a href="#" class="pl-3 text-danger"><i class="fa fa-facebook"></i></a>
						<a href="#" class="pl-3 text-danger"><i class="fa fa-twitter"></i></a>
						<a href="#" class="pl-3 text-danger"><i class="fa fa-youtube"></i></a>
						<a href="#" class="pl-3 text-danger"><i class="fa fa-linkedin"></i></a>
					</span>
				</div>
				<div class="col-6 text-right cust-footer-col" style="color:white">
					Maintained by <span class="text-danger">ShohanCodes</span> &copy <?php echo date("Y"); ?>
				</div>
			</div>
		</div>
	</footer>
	<!-- END OF FOOTER -->
	
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxi9Gz3JxflhgQRlA1YEoSu70NypgRntQ&callback=initMap">
    </script>
	
</body>

</html>