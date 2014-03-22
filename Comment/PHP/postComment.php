<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	include 'calculateTime.php';
	
	$comment = $_GET['comment'];
	$actionID = $_GET['actionID'];
	
	
	if($comment == ''){
		$time = time();
		$query = 'select actionType from action where actionID=\''.$actionID.'\'';
		$result = @mysql_query($query, $conn);
		while($rows = @mysql_fetch_row($result)){
			$actionType = $rows[0];	
		}	
		
		$query = 'select * from action where actionLocation=\''.$_SESSION['user'].'\' order by timeUpdate ASC;';
		$result = @mysql_query($query, $conn);
		
		
		while($rows = @mysql_fetch_row($result)){
			$timeDisplay = calculateTime($rows[4]);
			
			if((substr($rows[3], 0, 3)) == 'CMT'){
				// phần này in tất cả các comment của action
				$query1 = 'select * from comment where commentID=\''.$rows[3].'\' and commentType=\''.$actionType.'\'';
				$result1 = @mysql_query($query1, $conn);
				while($rows1 = @mysql_fetch_row($result1)){
					
					echo '<div class="show-cmt-like">
						<span class="show-cmt">         
							<table> 
								<tr>
									<td valign="top"><img src="';
										$query2 = 'select imageID from image where albumID=\'ALB001'.$rows[1].'\' and statusIMG = 1';
										$result2 = @mysql_query($query2, $conn);
										while($rows2 = @mysql_fetch_row($result2)){
											$image = $rows2[0];	
										}
										if($image != ''){
											$image = str_replace('.', 'thumbnail.', $image);
											echo 'IMAGE/'.$image;	
										}else{
											echo 'IMAGE/avatar.jpg';
										}
					echo			'" style=" height:32px; width:32px; float:left;" /></td>
									<td valign="top">
										<table>
											<tr><td><a href="userpage.php?user='.$rows[1].'" class="link-user">';
											$query3 = "select CONCAT_WS('  ', lastname, firstname) as name from profile where email='".$rows[1]."'";
											$result3 = mysql_query($query3, $conn);
											while($rows3 = @mysql_fetch_row($result3)){
												echo $rows3[0];	
											}
					echo					'</a> <span class="cont-msg1">'.$rows1[2].'</span></td></tr>
											<tr>
												<td><span class="time-cmt">'.$timeDisplay.'</span><a id="'.$rows[0].'like" class="like-cmt">Thích</a></td>                                           
											</tr>
										</table>
									</td>                    
								</tr>    	              	
							</table>   
						</span>
					</div>';
				}
			}
		}
		//Phần này in ô commemnt luôn luôn có.
			echo '<div id="'.$actionID.'a">
					<span class="show-cmt">        
						<table>
							<tr>
								<td valign="top">
									<img src="';
							
							$query4 = 'select imageID from image where albumID=\'ALB001'.$_SESSION['email'].'\' and statusIMG = 1';
								$result4 = @mysql_query($query4, $conn);
								while($rows4 = @mysql_fetch_row($result4)){
									$image = $rows4[0];	
								}
								if($image != ''){
									$image = str_replace('.', 'thumbnail.', $image);
									echo 'IMAGE/'.$image;	
								}else{
									echo 'IMAGE/avatar.jpg';	
								}
							
			echo					'" style=" height:32px; width:32px; float:left;" /></td>
								<td valign="top">
									<table>
										<tr>
											<td> 
												<input type="text" class="write-cmt" name="textComment" placeholder="Viết bình luận..." />
											</td>
										</tr>
								   
									</table>
								</td>                    
							</tr>  
							<tr>
								<td></td>
								<td>
									<div style="margin-left:30px; margin-bottom:10px;">
										<label class="buttonPost" style="margin-left:245px;">
											<input id="'.$actionID.'b" type="button" value="Bình Luận" class="btnPost" />
										</label>
									</div>
						  	 </td>
							</tr> 	              	
					</table>
					
					</span> 
				</div>';
	
	}else{
		$time = time();
		$query = 'select actionType from action where actionID=\''.$actionID.'\'';
		$result = @mysql_query($query, $conn);
		while($rows = @mysql_fetch_row($result)){
			$actionType = $rows[0];	
		}
		
		
		$query = 'insert into comment(commentID, commentType, content) values(\'CMT'.$time.'\', \''.$actionType.'\', \''.$comment.'\')';
		@mysql_query($query, $conn);
		
		
		$query = 'insert into action(actionID, actionUser, actionLocation, actionType, timeUpdate) values(\'ACT'.$time.'\', \''.$_SESSION['email'].'\', \''.$_SESSION['user'].'\', \'CMT'.$time.'\','.$time.')';	
		@mysql_query($query, $conn);
		
		
		$query = 'select * from action where actionLocation=\''.$_SESSION['user'].'\' order by timeUpdate ASC;';
		$result = @mysql_query($query, $conn);
		
		
		while($rows = @mysql_fetch_row($result)){
			$timeDisplay = calculateTime($rows[4]);
			
			if((substr($rows[3], 0, 3)) == 'CMT'){
				// phần này in tất cả các comment của action
				$query1 = 'select * from comment where commentID=\''.$rows[3].'\' and commentType=\''.$actionType.'\'';
				$result1 = @mysql_query($query1, $conn);
				while($rows1 = @mysql_fetch_row($result1)){
					
					echo '<div class="show-cmt-like">
						<span class="show-cmt">         
							<table> 
								<tr>
									<td valign="top"><img src="';
										$query2 = 'select imageID from image where albumID=\'ALB001'.$rows[1].'\' and statusIMG = 1';
										$result2 = @mysql_query($query2, $conn);
										while($rows2 = @mysql_fetch_row($result2)){
											$image = $rows2[0];	
										}
										if($image != ''){
											$image = str_replace('.', 'thumbnail.', $image);
											echo 'IMAGE/'.$image;	
										}else{
											echo 'IMAGE/avatar.jpg';
										}
					echo			'" style=" height:32px; width:32px; float:left;" /></td>
									<td valign="top">
										<table>
											<tr><td><a href="userpage.php?user='.$rows[1].'" class="link-user">';
											$query3 = "select CONCAT_WS('  ', lastname, firstname) as name from profile where email='".$rows[1]."'";
											$result3 = mysql_query($query3, $conn);
											while($rows3 = @mysql_fetch_row($result3)){
												echo $rows3[0];	
											}
					echo					'</a> <span class="cont-msg1">'.$rows1[2].'</span></td></tr>
											<tr>
												<td><span class="time-cmt">'.$timeDisplay.'</span><a id="'.$rows[0].'like" class="like-cmt">Thích</a></td>                                           
											</tr>
										</table>
									</td>                    
								</tr>    	              	
							</table>   
						</span>
					</div>';
				}
			}
		}
		//Phần này in ô commemnt luôn luôn có.
			echo '<div id="'.$actionID.'a">
					<span class="show-cmt">        
						<table>
							<tr>
								<td valign="top">
									<img src="';
							
							$query4 = 'select imageID from image where albumID=\'ALB001'.$_SESSION['email'].'\' and statusIMG = 1';
								$result4 = @mysql_query($query4, $conn);
								while($rows4 = @mysql_fetch_row($result4)){
									$image = $rows4[0];	
								}
								if($image != ''){
									$image = str_replace('.', 'thumbnail.', $image);
									echo 'IMAGE/'.$image;	
								}else{
									echo 'IMAGE/avatar.jpg';	
								}
							
			echo					'" style=" height:32px; width:32px; float:left;" /></td>
								<td valign="top">
									<table>
										<tr>
											<td> 
												<input type="text" class="write-cmt" name="textComment" placeholder="Viết bình luận..." />
											</td>
										</tr>
								   
									</table>
								</td>                    
							</tr>  
							<tr>
								<td></td>
								<td>
									<div style="margin-left:30px; margin-bottom:10px;">
										<label class="buttonPost" style="margin-left:245px;">
											<input id="'.$actionID.'b" type="button" value="Bình Luận" class="btnPost" />
										</label>
									</div>
						  	 </td>
							</tr> 	              	
					</table>
					
					</span> 
				</div>';
	}
	
	
?>