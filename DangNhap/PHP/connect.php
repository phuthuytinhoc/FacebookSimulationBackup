<?php
	$database = 'cucch_11851231_facebook';
	$server = 'sql309.cuccfree.com';
	$user = 'cucch_11851231';
	$pass = 'hung25891';
	$conn = mysql_connect($server, $user, $pass);
	mysql_select_db($database, $conn);
	
	mysql_query("set names 'utf8'"); 

?>