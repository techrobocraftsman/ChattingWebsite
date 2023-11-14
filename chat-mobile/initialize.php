<?php

	require_once('config.php');

	$tables = $connection->query('SHOW TABLES');
	$create_table=TRUE;
if($tables){
	foreach($tables as $table){
		$tablename = 'Tables_in_'.$database;
		if($table[$tablename] == $user_table){
			$create_table=FALSE;
			break;
		}
	}
	if($create_table){
		$sql = "CREATE TABLE ".$user_table." (
		id INT AUTO_INCREMENT,
		username TEXT NOT NULL,
		email TEXT NOT NULL,
		password TEXT NOT NULL,
		img_dir VARCHAR(255) NOT NULL,
		PRIMARY KEY(id)
		)";
		if($connection->query($sql) === TRUE){
			$_SESSION['current_table'] = $match1_id;
			// echo $match1_id.$match1.' table create<br>';
		}
		else {
			echo "<div class='warning'>Error updating record: " . $connection->error."</div>";
		}
	}
}
else {echo $connection -> error;}
?>