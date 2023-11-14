<?php
	require_once('header.php');	
	
	if(!isset($_SESSION['loggedin']))header('location: login.php');

	if(isset($_POST['check_database'])){
		$rows = $connection->query("SELECT * FROM ".$_SESSION['current_table']);
		$count_row = 0;
		while($row = mysqli_fetch_assoc($rows))$count_row++;
		echo $count_row;
	}

?>