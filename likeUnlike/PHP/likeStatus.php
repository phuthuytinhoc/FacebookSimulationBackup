<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	
	$actionID = $_GET['actionID'];
	if(!$actionID){
		echo $html;
		return;	
	}
	$html = $_GET['html'];
	$time = time();
	$query = 'select actionType from action where actionID=\''.$actionID.'\'';
	$result = @mysql_query($query, $conn);
	while($rows = @mysql_fetch_row($result)){
		$actionType = $rows[0];
	}
	
	$query = 'select * from `like`, `action`  where like.likeType=\''.$actionType.'\' and action.actionUser=\''.$_SESSION['email'].'\' and like.likeID = action.actionType';
	$result = @mysql_query($query, $conn);
	while($rows = @mysql_fetch_row($result)){
		$exists = $rows[0];
	}
	if($exists){
		echo $html;
		return;
	}
	$query = 'INSERT INTO `cucch_11851231_facebook`.`like` (`likeID`, `likeType`) VALUES (\'LIK'.$time.'\', \''.$actionType.'\');';
	
	@mysql_query($query, $conn);
	
	$query = 'insert into action(actionID, actionUser, actionLocation, actionType, timeUpdate) values(\'ACT'.$time.'\', \''.$_SESSION['email'].'\', \''.$_SESSION['email'].'\', \'LIK'.$time.'\', '.$time.')';
	@mysql_query($query, $conn);
	
	$query12 = 'SELECT count(*) FROM `like` WHERE likeType=\''.$actionType.'\'';
	$result12 = @mysql_query($query12, $conn);
	while($rows12 = @mysql_fetch_row($result12)){
		$numLike = $rows12[0];	
	}
	
	$query11 = 'select actionUser from action where actionUser=\''.$_SESSION['email'].'\' and actionType=\'LIK'.$time.'\'';
	$result11 = @mysql_query($query11, $conn);
	while($rows11 = @mysql_fetch_row($result11)){
		$user11 = $rows11[0];	
	}
	if($numLike == 1){
		if($user11){
			echo 'Bạn thích điều này.';
		}else{
			$query1 = "select CONCAT_WS('  ', lastname, firstname) as name from profile where email='".$user11."'";
			$result1 = mysql_query($query1, $conn);
			while($rows1 = @mysql_fetch_row($result1)){
				$ten = $rows1[0];
			}
			echo 'Thích <span>'.$ten.'</span> thích điều này.';	
		}
	}elseif($numLike > 1){
		if($user11){
			echo 'Bạn và '.($numLike-1).' người khác thích điều này.';	
		}else{
			echo 'Thích '.$numLike.' người thích điều này.';	
		}
	}elseif($numLike == 0){
		echo 'Thích';	
	}

?>