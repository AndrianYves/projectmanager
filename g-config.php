<?php
	require_once "GoogleAPI/vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("502847611988-ptb1vdm43u737q44ttdod5qr73r5d6fp.apps.googleusercontent.com");
	$gClient->setClientSecret("AFp-EGIDXvrLNg8YHb13oZa6");
	$gClient->setApplicationName("login with");
	$gClient->setRedirectUri("http://localhost/projectmanager/g-callback.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
