<?php
    session_start();
	require_once "g-config.php";
	include 'includes/conn.php'; 

	if (isset($_SESSION['access_token']))
		$gClient->setAccessToken($_SESSION['access_token']);
	else if (isset($_GET['code'])) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['access_token'] = $token;
	} else {
		header('Location: login.php');
		exit();
	}

	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();
	$_SESSION['picture'] = $userData['picture'];
	$_SESSION['email'] = $userData['email'];
	$_SESSION['familyName'] = $userData['familyName'];
	$_SESSION['givenName'] = $userData['givenName'];

	$sql = $conn->prepare("INSERT INTO users(email, firstname, lastname, usedtologin) VALUES(?, ?, ?, ?)");
    $sql->bind_param("ssss", $email, $firstname, $lastname, $usedtologin);
    $usedtologin = '3';
    $email = $_SESSION['email'];
    $firstname = $_SESSION['givenName'];
    $lastname = $_SESSION['familyName'];
    $sql->execute();
    $sql->close();

    $sql1 = mysqli_query($conn, "SELECT * from users where email = '$email'");
  	$row1 = mysqli_fetch_assoc($sql1);
  	$timestamp = date("Y-m-d H:i:s");
    $result1 = mysqli_query($conn,"UPDATE users SET lastlogin='$timestamp' WHERE email='$email'");
    $_SESSION['users'] = $row1['id'];
    
    $sql = $conn->prepare("INSERT INTO aboutme(userID, image) VALUES(?, ?)");
    $sql->bind_param("ss", $id, $image);
    $image = $_SESSION['picture'];
    $id = $_SESSION['users'];
    $sql->execute();
    $sql->close();

	header('Location: index.php');
	exit();
?>