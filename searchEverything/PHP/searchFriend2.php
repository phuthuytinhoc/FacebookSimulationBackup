<?php
	session_start();
	include '../../DangNhap/PHP/connect.php';
	
	$text = $_GET['text'];
	
	
	$query = 'select * from profile where firstname like \'%'.$text.'%\' or lastname like \'%'.$text.'%\'';
	$result = @mysql_query($query, $conn);
	
	echo '<ul>
			<li class="header-search">
				<a>
					<span class="first-b">Facebook</span>
				</a>
			</li>';
	
	while($rows = @mysql_fetch_row($result)){

			echo '<li class="show-search" >
				 <a href="userpage.php?user='.$rows[0].'">
					 <table >
						<tr>
							<td><img src="';
							
							$query2 = 'select * from album where albumID = \'ALB001'.$rows[0].'\';';
							$result2 = @mysql_query($query2, $conn);
							if(@mysql_num_rows($result2) == 0){
								echo '../IMAGE/avatar.jpg';	
							}else{
								$query1 = 'select imageID from image where albumID = \'ALB001'.$rows[0].'\' and statusIMG = 1';
								$result1 = @mysql_query($query1, $conn);
								if(@mysql_num_rows($result1) != 0){
									while($rows1 = mysql_fetch_row($result1)){
										$str = str_replace('.', 'thumbnail.', $rows1[0]);
									}
								}
								echo '../IMAGE/'.$str;							
							}
							
						echo'" height="50px" width="50px" /></td>
							<td valign="top">
								<table>
									<tr><td><a class="username-search">'.$rows[4].' '.$rows[3].'</a></td></tr>
									<tr><td><label class="add-search">'.$rows[8].'</label></td></tr>
								</table>
							</td>
						</tr>
					</table>
				</a>
			</li> ';                    
		   
			          
	}	
	
	echo '<li>
				<a href="#">
					<div class="foot-search">
						<span style="text-align:center;">Hiện thêm kết quá</span>
					</div>
				</a>
			</li>                        
		</ul>';
	
?>