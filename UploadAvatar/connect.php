<?php
	$database = 'facebook';
	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$conn = mysql_connect($server, $user, $pass);
	mysql_select_db($database, $conn);
?>