<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	
	// lúc này ta set statusFriend = 1 là trạng thái đã đọc.
	$query = 'update friend set statusFriend = 1 where toUser=\''.$_SESSION['email'].'\' and statusFriend!=2';
	@mysql_query($query, $conn);
	

?>