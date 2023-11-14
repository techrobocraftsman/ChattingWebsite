<?php

	session_start();
	require_once('config.php');
	if(!isset($_SESSION['loggedin']))header('location: login.php');

	$username = $_SESSION['username'];
	$id1 = $_SESSION['id'];
	$email = $_SESSION['email'];

	$users = $connection->query("SELECT img_dir FROM ".$user_table." WHERE username='$username'");
	$user = mysqli_fetch_object($users);
	$user_image = $user->img_dir;

?>