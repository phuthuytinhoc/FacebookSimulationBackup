<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	
	$actionID = $_GET['actionID'];
	
	$query = 'select actionType from action where actionID=\''.$actionID.'\'';
	$result = @mysql_query($query, $conn);
	
	while($rows = @mysql_fetch_row($result)){
		$actionType = $rows[0];
	}	
	
	if(substr($actionType, 0, 3) == 'STT'){
		// Xóa trong bảng Action
		$query = 'delete from action where actionID=\''.$actionID.'\'';
		@mysql_query($query, $conn);
		// Xóa trong bảng status
		$query = 'delete from status where statusID=\''.$actionType.'\'';
		@mysql_query($query, $conn);
		// Xóa comment của status đó trong bảng Action
		$query = 'select commentID from comment where commentType=\''.$actionType.'\'';
		$result = @mysql_query($query, $conn);
		while($rows = @mysql_fetch_row($result)){
			$query1 = 'delete from action where actionID=\''.$rows[0].'\'';
			@mysql_query($query1, $conn);	
		}
		// Xóa comment trong bảng comment
		$query = 'delete from comment where commentType=\''.$actionType.'\'';
		@mysql_query($query, $conn);
	}elseif(substr($actionType, 0, 3) == 'IMG'){
		// Xóa trong bảng Action
		$query = 'delete from action where actionID=\''.$actionID.'\'';
		@mysql_query($query, $conn);
		// Xóa trong bảng status
		$query = 'delete from image where imageID=\''.$actionType.'\'';
		@mysql_query($query, $conn);
		// Xóa comment của status đó trong bảng Action
		$query = 'select commentID from comment where commentType=\''.$actionType.'\'';
		$result = @mysql_query($query, $conn);
		while($rows = @mysql_fetch_row($result)){
			$query1 = 'delete from action where actionID=\''.$rows[0].'\'';
			@mysql_query($query1, $conn);	
		}
		// Xóa comment trong bảng comment
		$query = 'delete from comment where commentType=\''.$actionType.'\'';
		@mysql_query($query, $conn);
	}
?>