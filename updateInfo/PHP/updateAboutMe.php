<?php
	session_start();
	
	// connect database
	include 'connect.php';
	
	$about = $_GET['about'];
	
	$query = 'update profile set aboutMe =\''.$about.'\' where email=\''.$_SESSION['user'].'\'';
	mysql_query($query, $conn);
	
	$query = 'select aboutMe from profile where email=\''.$_SESSION['user'].'\'';
	$result = @mysql_query($query, $conn);
	while($rows = @mysql_fetch_row($result)){
		if ($rows[0] == ''){
			echo '<a href="javascript:showone(\'show-about\');"> Hãy viết một thứ gì đó ... </a>';
		}else{
			echo $rows[0];	
		}
	}
?>