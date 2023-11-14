<?php 
	require_once('header.php');

	if(isset($_POST['button_info_update'])){
		//echo $_SESSION['second_person'];
		?>
			<div class="r">
				<div class="c"><i class="far fa-paper-plane"></i></div>
			</div>
		
		<?php
		
		die();
	}
	
	$tables = $connection->query('SHOW TABLES');
	$create_table=TRUE;

	if(isset($_POST['person_change'])){
		$_SESSION['second_person'] = $_POST['second_person'];
		$_SESSION['second_img'] = $_POST['second_img'];
		$id2 = $_POST['id2'];
		$tables = $connection->query('SHOW TABLES');
		$create_table=TRUE;
		foreach($tables as $table){
			$match1=$username.$_POST['second_person'];
			$match2=$_POST['second_person'].$username;
			$match1_id='conversation'.$id1.$id2.'a';
			$match2_id='conversation'.$id2.$id1.'a';
			$tablename = 'Tables_in_'.$database;
			if($match1_id == $table[$tablename]){
				$create_table=FALSE;
				$_SESSION['current_table'] = $match1_id;
				// echo $match1_id.'<br />';
				break;
			}
			if($match2_id == $table[$tablename]){
				$create_table=FALSE;
				$_SESSION['current_table'] = $match2_id;
				// echo $match2_id.'<br />';
				break;
			}
		}

		if($create_table){
			/*
			$sql = "CREATE TABLE ".$match1_id." (
			messageid INT AUTO_INCREMENT,
			username TEXT NOT NULL,
			message TEXT NOT NULL,
			email TEXT NOT NULL,
			reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    		seen BOOLEAN NOT NULL,
			PRIMARY KEY(messageid)
			)"; */
			$sql = "CREATE TABLE ".$match1_id." (
			messageid INT AUTO_INCREMENT,
			username TEXT NOT NULL,
			message TEXT NOT NULL,
			reg_date TEXT NOT NULL,
			date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    		seen BOOLEAN NOT NULL,
			PRIMARY KEY(messageid)
			)";
			if($connection->query($sql) === TRUE){
				$_SESSION['current_table'] = $match1_id;
				// echo $match1_id.$match1.' table create<br>';
			}
			else {
				echo "<div class='warning'>Error updating record: " . $connection->error."</div>";
			}
		}
		die();
	}
?>

