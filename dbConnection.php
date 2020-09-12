<?php

$conn = new mysqli("localhost","root","","newosms");
if($conn->connect_error){
	die("Connection error");
}
else{
	//echo "Connection successful";
}

?>