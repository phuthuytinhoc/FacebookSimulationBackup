<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	
	// lúc này ta set statusFriend = 2 là trạng thái đã kết bạn
	$query = 'update friend set statusFriend = 2 where toUser=\''.$_SESSION['email'].'\' and fromUser=\''.$_SESSION['user'].'\'';
	@mysql_query($query, $conn);
	
	//select ra tất cả các yêu cầu chưa đc đọc --> statusFriend = 0
	$query = 'select count(*) from friend where toUser=\''.$_SESSION['email'].'\' and statusFriend=0';
	$result = @mysql_query($query, $conn);
	while($rows = @mysql_fetch_row($result)){
		$num = $rows[0];
	}	
	if($num > 0){
		echo '<span id="friendInvite" class="num-invite">';
		echo $num;
		echo '</span>';
	}
    echo '<li id="KetBan" ></li>';

?>