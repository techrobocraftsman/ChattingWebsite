<?php 
require_once('person_change.php');
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat box</title>

<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon.ico">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/all.min.css">
	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	
	<link class="change" rel="stylesheet" href="style.css">
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
			
			<div class="inbox-info">
				<div class="friends">
					<div class="pic"><img src="images/Screenshot_2.png" alt=""></div>
					<div class="choice info">Username</div>
					<a class="back btn btn-outline-success"><i class="fas fa-long-arrow-alt-left"></i></a>
				</div>
			</div>
		

			<form action="" class="chatform" method="POST">
				<div class="input-group mb-2">
					<input class="form-control" placeholder="Type here" type="text" name="message" aria-label="Recipient's username" aria-describedby="button-addon2">
					<button class="btn btn-outline-success" id="button-addon2" type="submit">
						<div class="r">
							<div class="c"><i class="far fa-paper-plane"></i></div>
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