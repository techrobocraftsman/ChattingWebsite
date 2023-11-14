<?php

	require_once('initialize.php');
	session_start();
	if(isset($_SESSION['loggedin']))header('location: chat.php');

	$allowed_extensions = array('jpg','png','gif','jpeg');
	$error = array();
	$pass = FALSE;
	
	if(isset($_POST['reg'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);

		$file_name = explode('.',$_FILES['userfile']['name']);
		$file_ext = end($file_name);
		$img_dir = 'images/'.$username.$_FILES['userfile']['name'];

		if(in_array($file_ext , $allowed_extensions)){
			$pass = true;
		}
		else  $error['warning'] = 'Please Browse an Profile picture';

		$emailase = $connection->query("SELECT * FROM ".$user_table." WHERE email='$email'");
		
		if(mysqli_num_rows($emailase)>=1)$error['warning'] = "Email already exists";
		elseif($email != NULL && $password != NULL && $pass){
			$query = $connection->query("INSERT INTO ".$user_table." (username,email,password,img_dir) VALUES ('$username','$email','$password','$img_dir')");
			if($query){
				move_uploaded_file($_FILES['userfile']['tmp_name'], $img_dir);
				if(!isset($error['success']))$error['success'] = 'Successfully registered!';
			}
		}
		else if(!isset($error['warning']))$error['warning'] = 'Fill all the fields';
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>

	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="bootstrap.min.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
	<div class="box register">
		<h2>Create an account</h2>
		<form action="" method="POST" class="userregistration" enctype="multipart/form-data">
			<input class="my-inputs" type="text" name="username" placeholder="User name">
			<input class="my-inputs" type="email" name="email" placeholder="Email">
			<input class="my-inputs" type="password" name="password" placeholder="Password">
			<input class="my-inputs" type="file" name="userfile">

			<input class="btn btn-outline-primary" type="submit" value="Register" name="reg">
		</form>
		<div class="success"><?php if(isset($error['success']))echo $error['success'];?></div>
		<div class="warning"><?php if(isset($error['warning']))echo $error['warning'];?></div><br>
		Already Have an account? <a class="login" href="login.php">please log in</a>
	</div>
</body>
</html>