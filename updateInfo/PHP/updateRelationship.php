<?php
	session_start();
	
	// connect database
	include 'connect.php';
	
	$relationship = $_GET['relationship'];
	
	$query = 'update profile set relationship=\''.$relationship.'\' where email=\''.$_SESSION['user'].'\'';
	mysql_query($query, $conn);
	
	$query = 'select relationship from profile where email=\''.$_SESSION['user'].'\'';
	$result = @mysql_query($query, $conn);
	
	echo '<span class="khung job"><img src="DangNhap/IMG/relationship.png" /></span>';
	while($rows = @mysql_fetch_row($result)){
		$relation = $rows[0];
	}
	if ($relation != ''){
		echo '<span class="tieude"><a>Tình trạng quan hệ: </a>'.$relation.'</span>';
	}else{
		echo '<span class="tieude"><a href="javascript:showone(\'show-rela\')">Thêm Tình Trạng Quan Hệ</a></span>';	
	}

?>