<?php
	session_start();
	
	// connect database
	include 'connect.php';
	
	$phone = $_GET['phone'];
	$address = $_GET['address'];
	
	$query = 'update profile set phoneNumber=\''.$phone.'\' where email=\''.$_SESSION['user'].'\'';
	mysql_query($query, $conn);
	
	$query = 'update profile set address=N\''.$address.'\' where email=\''.$_SESSION['user'].'\'';
	mysql_query($query, $conn);
	
	echo '<tr>';
	echo	'<td class="head-td">Điện Thoại<td>';
	echo	'<td>';
			$query = 'select phoneNumber from profile where email=\''.$_SESSION['user'].'\'';
			$result = @mysql_query($query, $conn);
			
			while($rows = @mysql_fetch_row($result)){
				$phone = $rows[0];	
			}
			if($phone == 0){
				echo '<a href="javascript:showone(\'show-contact\')">Hãy nhập số điện thoại của bạn ...</a>';
			}else{
				echo $phone;
			}
		
	echo	'</td>';
	echo '</tr>';
	echo '<tr>';
	echo	'<td class="head-td">Địa Chỉ<td>';
	echo	'<td>';
			$query = 'select address from profile where email=\''.$_SESSION['user'].'\'';
			$result = @mysql_query($query, $conn);
			
			while($rows = mysql_fetch_row($result)){
				$address = $rows[0];	
			}
			if($address == ''){
				echo '<a href="javascript:showone(\'show-contact\')">Hãy nhập địa chỉ của bạn ...</a>';	
			}else{
				echo $address;	
			}
		
	echo	'</td>';
	echo '</tr>';

?>