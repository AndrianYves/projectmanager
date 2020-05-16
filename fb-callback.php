<?php
	require_once "config.php";

  	include 'includes/conn.php'; 

	try {
		$accessToken = $helper->getAccessToken();
	} catch (\Facebook\Exceptions\FacebookResponseException $e) {
		echo "Response Exception: " . $e->getMessage();
		exit();
	} catch (\Facebook\Exceptions\FacebookSDKException $e) {
		echo "SDK Exception: " . $e->getMessage();
		exit();
	}

	if (!$accessToken) {
		header('Location: login.php');
		exit();
	}

	$oAuth2Client = $FB->getOAuth2Client();
	if (!$accessToken->isLongLived())
		$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

	$response = $FB->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
	$userData = $response->getGraphNode()->asArray();
	$_SESSION['userData'] = $userData;
	$_SESSION['access_token'] = (string) $accessToken;
	$_SESSION['picture'] = $_SESSION['userData']['picture']['url'];

	$sql = $conn->prepare("INSERT INTO users(email, firstname, lastname, usedtologin) VALUES(?, ?, ?, ?)");
    $sql->bind_param("ssss", $email, $firstname, $lastname, $usedtologin);
    $usedtologin = '2';
    $email = $_SESSION['userData']['email'] ;
    $firstname = $_SESSION['userData']['first_name'];
    $lastname = $_SESSION['userData']['last_name'];
    $sql->execute();
    $sql->close();

    $sql1 = mysqli_query($conn, "SELECT * from users where email = '$email'");
  	$row1 = mysqli_fetch_assoc($sql1);
  	$timestamp = date("Y-m-d H:i:s");
    $result1 = mysqli_query($conn,"UPDATE users SET lastlogin='$timestamp' WHERE email='$email'");
    $_SESSION['users'] = $row1['id'];

    
    $sql = $conn->prepare("INSERT INTO aboutme(userID, image) VALUES(?, ?)");
    $sql->bind_param("ss", $id, $image);
    $image = $_SESSION['userData']['picture']['url'];
    $id = $_SESSION['users'];
    $sql->execute();
    $sql->close();

	header('Location: index.php');
	exit();
?>