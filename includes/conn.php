<?php
	$conn = new mysqli("localhost", "root", "", "projectmanager");
	if($conn->connect_error) {
	  exit('Error connecting to database'); //Should be a message a typical user could understand in production
	}
	
	// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	// error_reporting(0);
	$conn->set_charset("utf8mb4");
	date_default_timezone_set("Asia/Bangkok");
?>