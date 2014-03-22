<?php
	session_start();
	
	// connect database
	include 'connect.php';
	
	$city = $_GET['city'];
	$query = 'update profile set city=N\''.$city.'\' where email=\''.$_SESSION['user'].'\'';
	mysql_query($query, $conn);
	
	$home = $_GET['home'];
	$query = 'update profile set homeTown=N\''.$home.'\' where email=\''.$_SESSION['user'].'\'';
	mysql_query($query, $conn);
	
	echo '<span class="khung job"><img src="DangNhap/IMG/places.png" /></span>';
		$query = 'select city from profile where email=\''.$_SESSION['user'].'\'';
		$result = @mysql_query($query, $conn);
		
		while($rows = @mysql_fetch_row($result)){
			$city = $rows[0];	
		}
		if($city == ''){
			echo '<span class="tieude"><a href="javascript:showone(\'show-living\')">Thêm Thành Phố Hiện Tại</a></span>';
		}else{
			echo '<span class="tieude"><a>Thành phố: </a>'.$city.'</span>';	
		}
	
	echo '<span class="khung edu"><img src="DangNhap/IMG/places.png" /></span>';
		$query = 'select homeTown from profile where email=\''.$_SESSION['user'].'\'';
		$result = @mysql_query($query, $conn);
		
		while($rows = @mysql_fetch_row($result)){
			$home = $rows[0];	
		}
		if($home == ''){
			echo '<span class="tieude"><a href="javascript:showone(\'show-living\')">Thêm Quê Hương</a></span>';
		}else{
			echo '<span class="tieude"><a>Quê quán: </a>'.$home.'</span>';	
		}

?>