<?php
	@session_start();
	include '../../DangNhap/PHP/connect.php';
	
	$fromUser = $_GET['fromUser'];
	
	$query = 'update friend set statusFriend = 2 where fromUser=\''.$fromUser.'\' and toUser=\''.$_SESSION['email'].'\'';
	@mysql_query($query, $conn);
	
	echo '<a href="userpage.php?user='.$fromUser.'"> <div class="list-invited" id="'.$fromUser.'a">
				<table>
					<tr>
						<td><img src="';
							$query = 'select * from album where albumID = \'ALB001'.$fromUser.'\';';
							@$result = mysql_query($query, $conn);
							if(@mysql_num_rows($result) == 0){
								echo 'IMAGE/avatar.jpg';	
							}else{
								$query1 = 'select imageID from image where albumID = \'ALB001'.$fromUser.'\' and statusIMG = 1';
								@$result1 = mysql_query($query1, $conn);
								if(mysql_num_rows($result1) != 0){
									while($rows1 = mysql_fetch_row($result1)){
										$str = str_replace('.', 'thumbnail.', $rows1[0]);
									}
								}
								echo 'IMAGE/'.$str;
								
							}
						echo '" height="50px" width="50px" /></td>
						<td>
							<table>
								<tr>
									<td><a class="name-invite" href="userpage.php?user='.$fromUser.'">';
									$query = "select CONCAT_WS('  ', lastname, firstname) as name from profile where email='".$fromUser."'";
									$result = mysql_query($query, $conn);
									while($rows1 = @mysql_fetch_row($result)){
										$ten = $rows1[0];
									}
									echo $ten;
									echo '</a></td>
								</tr>
								<tr><td></td></tr>
							</table>
						</td>
						<td>';
				echo		'Bạn và '.$ten.' đã là bạn, hãy viết lên dòng thời gian của '.$ten.' ^o^';
				echo	'</td>
					</tr>
				</table>
			</div></a>';	
?>