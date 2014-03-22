<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	
	$pass = $_GET['pass'];
	$query = 'update profile set pass=\''.$pass.'\' where email=\''.$_SESSION['email'].'\'';
	@mysql_query($query, $conn);
	
	echo 'thanhcong';

?>