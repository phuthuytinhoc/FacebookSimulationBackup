<?php
	session_start();
	
	// connect database
	include 'connect.php';
	
	echo '<span style="display:inline-block; font-size:16px; font-weight:bold;">Tiểu Sử</span>';
	echo '<span style="display:block; margin-top:30px;">';
	echo	'<label style="font-weight:bold; color:#333; margin-right:15px;">'; 
			$query = "select birthday from profile where email = '".$_SESSION['user']."'";
			$result = @mysql_query($query, $conn);

			while($rows = @mysql_fetch_row($result)){
				$time = $rows[0];
			}
			echo substr($time, 0, 4);
	echo ' ';
	echo	'</label>';
	echo	'<label style=" color:#333;"><i class="ico-born"></i>Sinh ngày ';
	echo substr($time, 8, 2);
	echo ' tháng ';
	echo substr($time, 5, 2);
	echo ' năm ';
	echo substr($time, 0, 4);
	echo '</label>';
	echo '</span>';
?>