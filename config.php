<?php
    session_start();
	require_once "Facebook/autoload.php";

  $FB = new Facebook\Facebook([
    'app_id' => '231342271496391',
    'app_secret' => 'dce7177b3d8cd6a0c0597f50fc14c7c8',
    'default_graph_version' => 'v2.10'
  ]);

$helper = $FB->getRedirectLoginHelper();
?>