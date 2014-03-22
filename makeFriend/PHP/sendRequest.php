<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	
	$query = 'insert into friend(fromUser, toUser, statusFriend) values(\''.$_SESSION['email'].'\', \''.$_SESSION['user'].'\', 0)';
	$result = @mysql_query($query, $conn);
	
	echo true;
	
?>