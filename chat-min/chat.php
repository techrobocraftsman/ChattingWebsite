<?php 
require_once('person_change.php');
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat box</title>

<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<link rel="manifest" href="favicon/site.webmanifest">

	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="css/all.min.css">
	<script src="bootstrap.min.js"></script>
	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	
	<link rel="stylesheet" href="style.css">
	<script src="js/script.js"></script>
	
</head>
<body>
	<div class="user-info box">
		<div class="pic"><img src="<?php if($user_image!='')echo $user_image;else echo 'images/Screenshot_2.png';?>" alt=""></div>
		<div class="choice info"><?php echo $username;?></div>
		<div class="email"><?php echo $email;?></div>
		<a class="btn btn-outline-primary logout" href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
	</div>
	<div class="chat box">
		<div class="friend-list sortable">
			<?php 
				$users = $connection->query("SELECT * FROM ".$user_table);
				if (!$users) {
 					echo("Error description: " . $connection -> error);
 				}else{				
				foreach($users as $user){
					if($user['username'] != $username){
			?>

			<div class="friends">
				<div class="pic"><img src="<?php if($user['img_dir']!='')echo $user['img_dir'];else echo 'images/Screenshot_2.png'?>" alt=""></div>
				<div class="choice info" value="<?php echo $user['username'];?>" userid="<?php echo $user['id'];?>"><?php echo $user['username'];?></div>
				<div class="email"><?php echo $user['email'];?></div>
			</div>

			<?php }}} ?>

		</div>
		<div class="chat-area">
			<!--
			<div class="inbox-info">
				<div class="friends">
					<div class="pic"><img src="images/Screenshot_2.png" alt=""></div>
					<div class="choice info">Username</div>
				</div>
			</div>
			-->

			<form action="" class="chatform" method="POST">
				<div class="input-group mb-2">
					<input class="form-control" placeholder="Type here" type="text" name="message" aria-label="Recipient's username" aria-describedby="button-addon2">
					<button class="btn btn-outline-success" id="button-addon2" type="submit">
						<div class="r">
							<div class="c"><i class="far fa-paper-plane"></i></div>
							<div class="c username"><div class="choice info">Username</div></div>
							<div class="c img"><div class="pic"><img src="images/Screenshot_2.png" alt=""></div></div>
						</div>
					</button>
				</div>
			</form>
			<div class="squarebox"><div class="messages scrollable"></div></div>
		</div>

	</div>

	<?php if($_SESSION['starting'] <=10 )$_SESSION['starting']++; ?>
<!--
	<i class="fas fa-sign-out-alt"></i>
	<i class="fas fa-user"></i>
-->

	<script>
		jQuery('.sortable').sortable();
	</script>
	
</body>
</html>