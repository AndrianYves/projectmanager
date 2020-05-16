<?php
	session_start();
	include 'includes/conn.php';

	date_default_timezone_set("Asia/Manila");


	if(isset($_SESSION['users'])){
		$query = $conn -> prepare("SELECT *, users.id as usID FROM users left join aboutme on users.id = aboutme.userID WHERE users.id = ? ");
		$query -> bind_param("s", $variable);
		$variable = $_SESSION['users'];
		$query -> execute();
		$result = $query->get_result();
		$user = mysqli_fetch_assoc($result);
		$id = $user['usID'];
		$today = date('Y-m-d H:i');

	}
	else{
		header('location: login.php');
		exit();
	}


	
?>