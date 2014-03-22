<?php
	session_start();
	
	require 'connect.php';
	
	$email = $_GET['email'];
	$pass = $_GET['pass'];
	
	$query = "select CONCAT_WS('  ', lastname, firstname) as name, email from profile where email='".$email."' and pass='".$pass."'";
	$result = mysql_query($query, $conn);
	if(mysql_num_rows($result) == 1){
		while($row = mysql_fetch_row($result)){
			$_SESSION['ten'] = 	$row[0];
			$_SESSION['email'] = $row[1];
			$_SESSION['user'] = $row[1];
			echo 'true';
			return;
		}
	}
	echo 'false';
	return;




?>