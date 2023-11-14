<?php 
require_once('initialize.php');
session_start();
if(isset($_SESSION['loggedin']))header('location: chatting.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat application</title>
	
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon.ico">


	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="style.css">

	<script src="js/jquery.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
	<div class="box">
		<a class="register" href="register.php">Create an account</a><br>
		Already Have an account? <a class="login" href="login.php">please log in</a>
	</div>

</body>
</html>