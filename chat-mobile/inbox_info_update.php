<?php
	require_once('header.php');

	if(isset($_POST['inbox_info_update'])){
		//echo $_SESSION['second_person'];
		?>
			<div class="friends">
				<div class="pic"><img src="<?php if($_SESSION['second_img']!='')echo $_SESSION['second_img'];else echo 'images/Screenshot_2.png'?>" alt=""></div>
				<div class="choice info"><?php echo $_SESSION['second_person'];?></div>
				<a class="back btn btn-outline-success"><i class="fas fa-long-arrow-alt-left"></i></a>
			</div>
		
		<?php
		
		die();
	}

?>