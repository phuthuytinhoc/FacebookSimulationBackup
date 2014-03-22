<?php
	session_start();
	
	// connect database
	include 'connect.php';
	
	$sex = $_GET['sex'];
	$query = 'update profile set sex=N\''.$sex.'\' where email=\''.$_SESSION['user'].'\'';
	mysql_query($query, $conn);
	
	$day = $_GET['day'];
	$month = $_GET['month'];
	$year = $_GET['year'];
	$query = 'update profile set birthday=\''.$year.'-'.$month.'-'.$day.'\' where email=\''.$_SESSION['user'].'\'';
	mysql_query($query, $conn);
	echo '<tr>';
	echo	'<td class="head-td">Sinh Nhật<td>';
	echo	'<td>';
			$query = "select birthday from profile where email = '".$_SESSION['user']."'";
			$result = @mysql_query($query, $conn);
	
			while($rows = @mysql_fetch_row($result)){
				$time = $rows[0];
			}
			echo substr($time, 8, 2).'/'.substr($time, 5, 2).'/'.substr($time, 0, 4);
	echo	'</td>';
	echo '</tr>';
	echo '<tr>';
    echo    '<td class="head-td">Giới Tính<td>';
    echo    '<td> ';
            $query = 'select sex from profile where email=\''.$_SESSION['user'].'\'';
            $result = @mysql_query($query, $conn);
            while($rows = @mysql_fetch_row($result)){
                $sex = $rows[0];
            }
            echo $sex;
    echo    '</td>';
	echo '</tr>';
	

?>