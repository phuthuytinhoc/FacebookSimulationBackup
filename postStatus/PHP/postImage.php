<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	include 'calculateTime.php';
	
	$content = $_POST['txtImageContent'];
	$time = time();
	
	$path = '../../IMAGE/';
	$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		$name = $_FILES['photoimg']['name'];
		$size = $_FILES['photoimg']['size'];
		if(strlen($name)){
			list($txt, $ext) = explode(".", $name);
			if(in_array($ext,$valid_formats)){
					$actual_image_name = 'IMG'.$time.'.'.$ext;
					$tmp = $_FILES['photoimg']['tmp_name'];
					if(move_uploaded_file($tmp, $path.$actual_image_name)){
						$query = 'select albumID from album where albumID=\'ALB003'.$_SESSION['email'].'\'';
						$result = @mysql_query($query, $conn);
						while($rows = @mysql_fetch_row($result)){
							$album = $rows[0];	
						}
						if($album == ''){
							@mysql_query('insert into album(albumID, albumName, email) values(\'ALB003'.$_SESSION['email'].'\', N\'Ảnh trên tường\', \''.$_SESSION['email'].'\')', $conn);
							@mysql_query('insert into image(imageID, albumID, content, statusIMG) values(\''.$actual_image_name.'\', \'ALB003'.$_SESSION['email'].'\', \''.$content.'\', 0)', $conn);
							@mysql_query('insert into action(actionID, actionUser, actionLocation, actionType, timeUpdate) values(\'ACT'.$time.'\', \''.$_SESSION['email'].'\', \''.$_SESSION['user'].'\', \''.$actual_image_name.'\', \''.$time.'\')');
						}elseif($album != ''){
							@mysql_query('insert into image(imageID, albumID, content, statusIMG) values(\''.$actual_image_name.'\', \'ALB003'.$_SESSION['email'].'\', \''.$content.'\', 0)', $conn);
							@mysql_query('insert into action(actionID, actionUser, actionLocation, actionType, timeUpdate) values(\'ACT'.$time.'\', \''.$_SESSION['email'].'\', \''.$_SESSION['user'].'\', \''.$actual_image_name.'\', \''.$time.'\')');
						}
						$query = 'select * from action where actionLocation=\''.$_SESSION['user'].'\' and actionType like \'STT%\' or actionType like \'IMG%\' order by timeUpdate DESC limit 1';
						$result = @mysql_query($query, $conn);
						
						while($rows = @mysql_fetch_row($result)){
							if((substr($rows[3], 0, 3)) != 'CMT'){
								$timeDisplay = calculateTime($rows[4]);
								echo '<div class="item-timeline"> <!-- bat dau mot div tao status dang timeline. Doan nay bo vao timeline.js -->
											<a id="'.$rows[0].'" class="deletebox">x</a>
											<div class="full-head">
												<table>
													<tr>
													<td><img src="';
																$query1 = 'select imageID from image where albumID=\'ALB001'.$rows[1].'\' and statusIMG = 1';
																$result1 = @mysql_query($query1, $conn);
																while($rows1 = @mysql_fetch_row($result1)){
																	$image = $rows1[0];	
																}
																if($image != ''){
																	$image = str_replace('.', 'thumbnail.', $image);
																	echo 'IMAGE/'.$image;	
																}else{
																	echo 'IMAGE/avatar.jpg';
																}
								echo '" height="32px" width="32px" /></td>
													   <td>
													   <table>
															<tr><td><a class="name-head" href="userpage.php?user='.$rows[1].'">';
																	$query8 = "select CONCAT_WS('  ', lastname, firstname) as name from profile where email='".$rows[1]."'";
																	$result8 = mysql_query($query8, $conn);
																	while ($rows8 = @mysql_fetch_row($result8)){
																		echo $rows8[0];	
																	}
																echo'</a></td></tr>
																<tr><td><label class="time-head">'.$timeDisplay.'</label>&nbsp;&nbsp;<label class="time-head">gần Ho Chi Minh City</label></td></tr>
															</table>
													   </td>
													</tr>
												</table>              
											</div>
											<div class="main-head"><br />       		
												<span id="'.$rows[4].'" style="margin-left:10px; margin-right:10px; font-size:13px;">';
												if((substr($rows[3], 0, 3)) == 'STT'){
													$query2 = 'select content from status where statusID=\''.$rows[3].'\'';
													$result2 = @mysql_query($query2, $conn);
													while($rows2 = @mysql_fetch_row($result2)){
														echo $rows2[0];
														echo '</span>';
													}
												}elseif((substr($rows[3], 0, 3)) == 'IMG'){
													$query2 = 'select imageID, content from image where imageID=\''.$rows[3].'\'';
													$result2 = @mysql_query($query2, $conn);
													while($rows2 = @mysql_fetch_row($result2)){
														echo $rows2[1];
														echo '</span>';
														echo '<span><img style="max-height:300px;" class="post-img" src="IMAGE/'.$rows2[0].'" /></span>';
													}
												}
								echo			'</div>
											<br>
											<div class="act-head">
												<span><a id="'.$rows[0].'like" class="like-tool">Thích</a></span>
												<span><a class="like-tool" href="javascript:toogleDiv(\'show-cmt\');">Bình luận</a></span>     
														   
											</div>';
											// Phần này in ra comment của action
									echo 	'<div id="'.$rows[0].'a">';
												$query4 = 'select * from comment where commentType=\''.$rows[3].'\'';
												$result4 = @mysql_query($query4, $conn);
												if(@mysql_num_rows($result4)){
													// Bắt đầu in comment
													while($rows4 = @mysql_fetch_row($result4)){
														$query7 = 'select timeUpdate from action where actionType=\''.$rows4[0].'\'';
														$result7 = @mysql_query($query7, $conn);
														while($rows7 = @mysql_fetch_row($result7)){
															$timeDisplay1 = calculateTime($rows7[0]);
														}
														echo '<div class="show-cmt-like">
															<span class="show-cmt">         
																<table> 
																	<tr>
																		<td valign="top"><img src="';
																			$query5 = 'select imageID from image where albumID=\'ALB001'.$rows[1].'\' and statusIMG = 1';
																			$result5 = @mysql_query($query5, $conn);
																			while($rows5 = @mysql_fetch_row($result5)){
																				$image = $rows5[0];	
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
																				<tr><td><a href="userpage.php?'.$rows[1].'" class="link-user">';
																				$query6 = "select CONCAT_WS('  ', lastname, firstname) as name from profile where email='".$rows[1]."'";
																				$result6 = mysql_query($query6, $conn);
																				while($rows6 = @mysql_fetch_row($result6)){
																					echo $rows6[0];	
																				}
														echo					'</a> <span class="cont-msg1">'.$rows4[2].'</span></td></tr>
																				<tr>
																					<td><span class="time-cmt">'.$timeDisplay1.'</span><a class="like-cmt">Thích</a></td>                                           
																				</tr>
																			</table>
																		</td>                    
																	</tr>    	              	
																</table>   
															</span>
														</div>';
													}	
												}
												// Phần này ta in ra khung comment bên dưới mỗi comment	
								  
										echo	'</span>
												
												<span class="show-cmt">        
													<table>
														<tr>
															<td valign="top"><img src="';
															
															$query3 = 'select imageID from image where albumID=\'ALB001'.$_SESSION['email'].'\' and statusIMG = 1';
																$result3 = @mysql_query($query3, $conn);
																while($rows3 = @mysql_fetch_row($result3)){
																	$image = $rows3[0];	
																}
																if($image != ''){
																	$image = str_replace('.', 'thumbnail.', $image);
																	echo 'IMAGE/'.$image;	
																}else{
																	echo 'IMAGE/avatar.jpg';	
																}
															
								echo							'" style=" height:32px; width:32px; float:left;" /></td>
															<td valign="top">
																<table>
																	<tr><td> <input type="text" class="write-cmt" name="textComment" placeholder="Viết bình luận..." /></td></tr>
																   
																</table>
															</td>                    
														</tr>  
														<tr>
															<td></td>
															<td>
																<div style="margin-left:30px; margin-bottom:10px;">
																	<label class="buttonPost" style="margin-left:245px;">
																		<input id="'.$rows[0].'b" type="button" value="Bình Luận" class="btnPost" />
																	</label></span>
																</div>
														   </td>
														</tr> 	              	
												</table>
													
												</span>                  
											</div>                   
										<!-- ket thuc mot div dang timeline-->';	
							}
						}
					}else return 'failed';
			}else return 'Invalid file format';
		}else return 'Hãy chọn hình ảnh muốn tải lên';
	}
?>