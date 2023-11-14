<?php
	require_once('initialize.php');
	session_start();
	if(isset($_SESSION['loggedin']))header('location: chatting.php');
	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		$emailase = $connection->query("SELECT * FROM ".$user_table." WHERE email='$email'");
		
		if(mysqli_num_rows($emailase)>=1){
			$fetch = mysqli_fetch_assoc($emailase);
			$pass = $fetch['password'];
			
			if($password == $pass){
				$_SESSION['loggedin'] = 'yes';
				$_SESSION['starting'] = 0;
				$_SESSION['username'] = $fetch['username'];
				$_SESSION['id'] = $fetch['id'];
				$_SESSION['email'] = $fetch['email'];

				header('location: chatting.php');
				die();
			}else $warning = "Password doesn't match";
		}
		else{
			$warning = "Email doesn't exists";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log in</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
	<div class="box login">
		<h2>Log in</h2>
		<form action="" method="POST" class="userlogin">
			<input class="my-inputs" type="email" name="email" placeholder="Email">
			<input class="my-inputs" type="password" name="password" placeholder="Password">

			<input class="btn btn-outline-success" type="submit" value="Log in" name="login">
		</form>
		<div class="warning"><?php if(isset($warning))echo $warning;?></div><br>
		Don't have an account <a class="register" href="register.php">Register now!</a><br>
	</div>
</body>
</html>