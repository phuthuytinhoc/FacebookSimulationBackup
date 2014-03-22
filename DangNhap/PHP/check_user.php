<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	$email = $_GET['email'];
	
	$query = "SELECT * FROM profile WHERE email='".$email."'";
	$result = mysql_query($query, $conn);
	while($row = mysql_fetch_row($result)){
		if($row[0] == $email){
			echo 'false';
			return;
		}
	}
	$ho = $_GET['ho'];
	$ten = $_GET['ten'];
	$pass = $_GET['pass'];
	$ngaysinh = $_GET['ngaysinh'];
	$thangsinh = $_GET['thangsinh'];
	$namsinh = $_GET['namsinh'];
	$gioitinh = $_GET['gioitinh'];
	if($gioitinh == 'Male'){
		$gioitinh = 'Nam';	
	}else $gioitinh = 'Nữ';
	
	$query = "insert into profile(email, pass, firstname, lastname, sex, birthday) values('".$email."', '".$pass."', '".$ten."', '".$ho."', N'".$gioitinh."', '".$namsinh."-".$thangsinh."-".$ngaysinh."')";
	mysql_query($query, $conn);
	//header('Location: welcome.php');
	$_SESSION['email'] = $email;
	echo 'true';
?>