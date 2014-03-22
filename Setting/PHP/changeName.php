<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	
	$ten = $_GET['ten'];
	$ho = $_GET['ho'];
	
	$query = 'update profile set firstname=\''.$ten.'\', lastname=\''.$ho.'\' where email=\''.$_SESSION['email'].'\'';
	@mysql_query($query, $conn);
	
	$query3 = "select CONCAT_WS('  ', lastname, firstname) as name from profile where email='".$_SESSION['email']."'";
	$result3 = mysql_query($query3, $conn);
	while($rows1 = @mysql_fetch_row($result3)){
		$ten = $rows1[0];
	}
	$_SESSION['ten'] = $ten;
	
	echo 'thanhcong';

?>