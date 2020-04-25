<?php
	session_start();
	include 'includes/conn.php';;
	date_default_timezone_set("Asia/Manila");

	if(isset($_SESSION['users'])){
		$query = $conn -> prepare("SELECT * FROM users WHERE id = ? ");
		$query -> bind_param("s", $variable);
		$variable = $_SESSION['users'];
		$query -> execute();
		$result = $query->get_result();
		$user = mysqli_fetch_assoc($result);
		$role = $user['role'];
		$today = date('Y-m-d H:i');

	}
	else{
		header('location: login.php');
		exit();
	}
	
?>