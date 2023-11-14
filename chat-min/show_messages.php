<?php

	require_once('header.php');

if(isset($_POST['updatehoise']) && isset($_SESSION['current_table'])){
			$datas = mysqli_query($connection,"SELECT * FROM  ".$_SESSION['current_table']." ORDER BY messageid DESC");
	if(!$datas){
		echo("Error description: " . $connection -> error);
		echo '<br />Please choose a person';
	}
		else{
			foreach($datas as $data):	
		?>

		<?php if($data['username'] == $username): ?>

		<p class="first_person">
			<span class="pic"><img src="<?php if($user_image!='')echo $user_image;else echo 'images/Screenshot_2.png';?>" alt=""></span>
			<?php echo $data['message'];?>
			<span class="time"><?php echo $data['reg_date'];?></span>
			<?php if($data['seen'] == 1): ?>
				<i class="fas fa-check-circle"></i>
			<?php endif;?>
		</p>

		<?php endif;?>

		<?php  if($data['username'] == $_SESSION['second_person']): ?>

		<p class="second_person">
			<span class="time"><?php echo $data['reg_date'];?></span>
			<?php echo $data['message'];?>
			<span class="pic"><img src="<?php if($_SESSION['second_img']!='')echo $_SESSION['second_img'];else echo 'images/Screenshot_2.png'?>" alt=""></span>
		</p>
		<?php 
			$sql = "UPDATE ".$_SESSION['current_table']." SET seen=1 WHERE messageid=".$data['messageid'];
			if(!$connection -> query($sql))echo $connection -> error; 

	endif;?>

	<?php endforeach;}
	die();
}

?>