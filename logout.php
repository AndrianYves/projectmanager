<?php
	require_once "g-config.php";
	$gClient->revokeToken();

	session_start();
	session_destroy();

	session_start();
    $_SESSION['success'] ='Your account has been logout';
    
     header('location: index.php');
?>