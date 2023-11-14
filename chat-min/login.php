<?php
	require_once('initialize.php');
	session_start();
	if(isset($_SESSION['loggedin']))header('location: chat.php');
	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		$emailase = $connection->query("SELECT * FROM ".$user_table." WHERE email='$email'");
		
		if(mysqli_num_rows($emailase)>=1){
			$fetch = mysqli_fetch_assoc($emailase);
			$pass = $fetch['password'];
			
			if(md5($password) == $pass){
				$_SESSION['loggedin'] = 'yes';
				$_SESSION['starting'] = 0;
				$_SESSION['username'] = $fetch['username'];
				$_SESSION['id'] = $fetch['id'];
				$_SESSION['email'] = $fetch['email'];

				header('location: chat.php');
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

	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="bootstrap.min.js"></script>
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