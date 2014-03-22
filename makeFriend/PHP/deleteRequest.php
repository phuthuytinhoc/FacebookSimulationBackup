<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	
	$query = 'delete from friend where fromUser=\''.$_SESSION['email'].'\' and toUser=\''.$_SESSION['user'].'\'';
	$result = @mysql_query($query, $conn);
	$query = 'delete from friend where fromUser=\''.$_SESSION['user'].'\' and toUser=\''.$_SESSION['email'].'\'';
	$result = @mysql_query($query, $conn);
	
	echo true;
	echo '';

?>