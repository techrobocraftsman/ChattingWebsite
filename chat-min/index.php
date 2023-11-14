<?php 
require_once('initialize.php');
session_start();
if(isset($_SESSION['loggedin']))header('location: chat.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat application</title>

	<link rel="stylesheet" href="bootstrap.min.css">
	<script src="bootstrap.min.js"></script>

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