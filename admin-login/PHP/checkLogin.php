<?php
	session_start();
	
	include 'connect.php';
	
	$adminUser = $_GET['user'];
	$adminPass = $_GET['pass'];
	
	$query = 'SELECT adminName, adminPass FROM administrator WHERE adminName="'.$adminUser.'" AND adminPass="'.$adminPass.'"';
	$result = mysql_query($query, $conn);
	if(mysql_num_rows($result) == 1){
		while($row = mysql_fetch_row($result)){
			$_SESSION['admin'] = $row[0];
			echo 'true';
			return;
		}
	}else{
		echo 'false';
		return;
	}
?>