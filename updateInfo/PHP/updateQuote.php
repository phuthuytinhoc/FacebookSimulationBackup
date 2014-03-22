<?php
	session_start();
	
	// connect database
	include 'connect.php';
	
	$quote = $_GET['quote'];
	$query = 'update profile set quote=\''.$quote.'\'where email=\''.$_SESSION['user'].'\'';
	mysql_query($query, $conn);
	
	$query = 'select quote from profile where email=\''.$_SESSION['user'].'\'';
	$result = @mysql_query($query, $conn);
	while($rows = @mysql_fetch_row($result)){
		if ($rows[0] == ''){
			echo '<a href="javascript:showone(\'show-favourite\');"> Hãy viết một thứ gì đó ... </a>';
		}else{
			echo $rows[0];
		}
	}

?>