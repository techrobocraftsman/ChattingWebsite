<?php
	require_once('header.php');	

	if(isset($_POST['chatupdate']) && $_POST['message'] != null){
		$message = $_POST['message'];
		$time_sql = "SELECT CURRENT_TIME";
		$times = $connection -> query($time_sql);
		foreach($times as $time){
			$time_array = explode(':',$time['CURRENT_TIME']);
		}
		if($time_array[0] > 12){
			$time_array[0] = $time_array[0]-12;
			$current_time = $time_array[0].':'.$time_array[1].' pm';
			//echo $current_time;
		}
		else{
			$time_array[0] = $time_array[0];
			$current_time = $time_array[0].':'.$time_array[1].' am';
		}
		$insert = $connection -> query("INSERT INTO ".$_SESSION['current_table']."(username,message,reg_date) VALUES('$username' , '$message','$current_time')");
		if(!$insert){
			echo("Error description: " . $connection -> error);
			exit();
		}
		else die();
	}

?>



