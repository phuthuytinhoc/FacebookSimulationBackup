<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	
	$fromUser = $_GET['fromUser'];
	$query = 'delete from friend where fromUser=\''.$fromUser.'\' and toUser=\''.$_SESSION['email'].'\'';
	$result = @mysql_query($query, $conn);
	
	echo '';

?>