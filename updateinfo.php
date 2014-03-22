<?php 
	@session_start();
	include 'DangNhap/PHP/connect.php';
	
	if(!isset($_SESSION['ten'])){
		@header('Location: index.php');
	}
	if($_GET['user'] != ''){
		$_SESSION['user'] = $_GET['user'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/trangcanhan.dwt" codeOutsideHTMLIsLocked="false" -->
<!-- InstanceBeginEditable name="EditRegion1" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="DangNhap/CSS/trangcanhan.css" type="text/css" rel="stylesheet" />
<script src="DangNhap/JS/jquery-1.8.2.js" type="text/javascript" language="JavaScript"></script>
<script src="DangNhap/JS/threeaction.js" type="text/javascript" language="JavaScript"></script>
<script src="updateInfo/JS/ajax.js" type="text/javascript" ></script>
<script type="text/javascript" src="makeFriend/JS/ajaxRequest.js"></script>
<script type="text/javascript" src="searchEverything/JS/ajaxSearch.js"></script>
<link href="DangNhap/CSS/updateinfo.css" type="text/css" rel="stylesheet" />
<title>Facebook</title>
</head>

<body>
<!-- bat dau div menu top -->
<div id="topmenu">
	<!-- bat dau div head -->
	<div id="mainmenu">    	
    	<div id="pageLogo" class="Logo">
    		<a href="#"></a>
        </div>
        <!-- bat dau div 3 actions -->
        <div id="threeaction">        
        	 <ul>
             	<a href="javascript:showonlyone('divkb');" id="show-friend">
                	
                    <?php
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
					?>
                   <li id="KetBan" ></li>
             	</a>
                      
             	<a href="javascript:showonlyone('divtn');" id="show-msg">
                	<!-- <span class="num-invite">1</span>-->
             		<li id="TinNhan" ></li>
                    
             	</a>
                        
             	<a href="javascript:showonlyone('divtb');" id="show-thongbao">	
                	<!-- <span class="num-invite">1</span>-->
             		<li id="TinMoi" ></li> 
                    
             	</a>                       		                                              
             </ul>
          	
    
             <!-- ket ban -->
             <div class="popup" id="divkb">             	
             	<a class="btnclose" href="javascript: dongbanbe();">Đóng</a>
                <div class="popup-content">
                <?php
					$query = 'select * from friend  where toUser=\''.$_SESSION['email'].'\' and statusFriend != 2 limit 6';
					$result = @mysql_query($query, $conn);
					while($rows = @mysql_fetch_row($result)){
						echo ' <div class="list-invited" id="'.$rows[0].'a">
									<table>
										<tr>
											<td><img src="';
												$query2 = 'select * from album where albumID = \'ALB001'.$rows[0].'\';';
												@$result2 = mysql_query($query2, $conn);
												if(@mysql_num_rows($result2) == 0){
													echo 'IMAGE/avatar.jpg';	
												}else{
													$query1 = 'select imageID from image where albumID = \'ALB001'.$rows[0].'\' and statusIMG = 1';
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
														<td><a class="name-invite" href="userpage.php?user='.$rows[0].'">';
														$query3 = "select CONCAT_WS('  ', lastname, firstname) as name from profile where email='".$rows[0]."'";
														$result3 = mysql_query($query3, $conn);
														while($rows1 = @mysql_fetch_row($result3)){
															$ten = $rows1[0];
														}
														echo $ten;
														echo '</a></td>
													</tr>
													<tr><td></td></tr>
												</table>
											</td>
									  		<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td  align="right">
												<label class="ChapNhan"><input id="'.$rows[0].'" class="NhanLoi" type="button" value="Chấp Nhận" /></label>
											</td>
											<td>
												<label class="TuChoi"><span class="DoiTra">Từ Chối</span></label>
											</td>
							   
										</tr>
									</table>
								</div>  ';	
					}
					?>                  
                </div>
               <div class="popup-footer">
                	<a href=""><span>Xem Toàn Bộ</span></a>
                </div>
             </div>
                        
             <!-- tin nhan -->
             <div class="popup" id="divtn">             	
             	<a class="btnclose" href="javascript: dongtinnhan();">Đóng</a>
                <div class="popup-content">
                	Nội Dung Các Tin Nhắn
                </div>
               <div class="popup-footer">
                	<a href=""><span>Xem Toàn Bộ</span></a>
               </div>
             </div>
                        
             <!-- thong bao -->
             <div class="popup" id="divtb">             	
             	<a class="btnclose" href="javascript: dongthongbao();">Đóng</a>
                <div class="popup-content">
                	Nội Dung Các Thông Báo
                </div>
               <div class="popup-footer">
                	<a href=""><span>Xem Toàn Bộ</span></a>
               </div>
             </div>      	
            
      </div>
		<!-- ket thuc div 3 actions -->  
        
        <!-- bat dau div tim kiem -->
        <div id="search">
        	<form method="get">
            	<div id="TimKiem">
                    <div id="khung">
                        <input type="text" id="txtSearch" name="txtTim" class="KhungTimKiem" onkeyup="" title="Tìm Kiếm Bạn Bè" placeholder="Tìm Kiếm" autocomplete="off" />  
                    </div>
                    <div id="iconsearch">
                        <button id="btnSearch" type="submit" />
                    </div>  
                </div>              
            </form>
            <div id="ajax-search" style="display:none;"> <!-- start ajax search -->
                	<ul>
                    	<li class="header-search">
                        	<a>
                            	<span class="first-b">Facebook</span>
                            </a>
                        </li>

                        <li class="show-search" >
                        	 <a href="#">
                                 <table >
                                    <tr>
                                        <td><img src="IMAGE/avatar.jpg" height="50px" width="50px" /></td>
                                        <td valign="top">
                                            <table>
                                                <tr><td><a class="username-search">dong username</a></td></tr>
                                                <tr><td><label class="add-search">Dong dia chi noi o</label></td></tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </a>
                        </li>                      
                       
                         <li>
                         	<a href="#">
                                <div class="foot-search">
                                    <span style="text-align:center;">Hiện thêm kết quá</span>
                                </div>
                            </a>
                        </li>                        
                    </ul>                    
                </div>   <!-- edn ajax search --> 
        </div>
        <!-- ket thuc div tim kiem -->
        
        <!-- bat dau div 3 chuc nang: trang chu, trang ca nhan, tim kiem -->
        <div id="rightcontent">
        	<ul>
            	<li>
                	<a href="userpage.php?user=<?php echo $_SESSION['email']; ?>">
                    	<img class="avatar-canhan" src="<?php 
							$query = 'select * from album where albumID = \'ALB001'.$_SESSION['email'].'\';';
							$result = @mysql_query($query, $conn);
							if(@mysql_num_rows($result) == 0){
								echo 'IMAGE/avatar.jpg';	
							}else{
								$query1 = 'select imageID from image where albumID = \'ALB001'.$_SESSION['email'].'\' and statusIMG = 1';
								$result1 = @mysql_query($query1, $conn);
								if(@mysql_num_rows($result1) != 0){
									while($rows = mysql_fetch_row($result1)){
										$str = str_replace('.', 'thumbnail.', $rows[0]);
									}
								}
								echo 'IMAGE/'.$str;							
							}
						?>" />
                    	<span class="name-user"><?php echo $_SESSION["ten"]; ?></span>
                    </a>
                </li>
            </ul>
            <ul>
            	<li>
                	<a href="#">                    	
                    
                    	<span class="item">Tìm Bạn Bè</span>
                    </a>
                </li>
            </ul>
             <ul>
            	<li>
                	<a href="#">                  	
                    	<span class="item">Trang Chủ</span>
                    </a>
                </li>
            </ul>
        	<ul>
                <a href="javascript:motuychinh()" id="show-tuychinh" class="arrow"></a>                	
           	  <div id="divtc">
                	<a class="btnclose" href="javascript: dongtuychinh();" style="margin-bottom:0px;">Đóng</a>
               	<div class="menu-tc">
                   		<a href="setting.php">
                       	<div class="tc">
                            	<span>Thiết Lập Tài Khoản</span>
                            </div>
                        </a>
                   		<a>
                       	<a href="DangNhap/PHP/logout.php">
                        <div class="tc">
                            	<span>Đăng Xuất</span>
                            </div>
                            </a>
                        </a>
                        <a>
                       	<div class="tc" style="margin-bottom:3px;">
                            	<span>Trợ Giúp</span>
                            </div>
                        </a>

                    </div>
                
              </div>               
          </ul>
            
        </div>
        <!-- ket thuc div 3 chuc nang: trang chu, trang ca nhan, tim kiem -->
        
    </div>
    <!-- ketthuc div head -->
</div>
<!-- ket thuc div menu top -->
<div id="mainbody">

	<div id="left-col-info" >
    	
        <div class="work-edu khung-info"> <!--bat dau-->
            <div style="float:left; margin-left:15px;">
                <i class="ico-job"></i>
                <span style="display:inline-block; font-size:16px; font-weight:bold;">Học vấn và công việc</span>
            </div>
            <?php 
				if($_SESSION['user'] == $_SESSION['email']){
					echo '<div style="float:right;">';
					echo	'<a class="btn-edit" href="javascript:showone(\'show-job\')">';
					echo		'<i class="ico-pencil"></i><span>Sửa đổi</span>';
					echo	'</a>';
					echo '</div>';
				}
			?>
            <div class="job-edu" id="divJob">
            <!-- Phần này hiển thị nghề nghiệp hay trường học nếu có, nếu ko có thì sẽ yêu cầu ng dùng nhập -->
            	<?php
					echo '<span class="khung job"><img src="DangNhap/IMG/job.png" /></span>';
					$query = 'select job from profile where email="'.$_SESSION['user'].'";';
					@$result = mysql_query($query, $conn);
					while($rows = @mysql_fetch_row($result)){
						$job = $rows[0];	
					}
					if($job != ''){
						echo '<span class="tieude"><a>Nghề nghiệp : </a>'.$job.'</span>';
					}elseif(($_SESSION['user'] == $_SESSION['email']) && $job == ''){
						echo '<span class="tieude"><a href="javascript:showone(\'show-job\')">Thêm Nghề Nghiệp</a></span>';
					}elseif(($_SESSION['user'] != $_SESSION['email']) && $job == ''){
						echo '<span class="tieude"><a>Nghề Nghiệp: </a>chưa cập nhật ...</span>';
					}
				?>
                
                <?php
					$query = 'select school from profile where email="'.$_SESSION['user'].'";';
					@$result = mysql_query($query, $conn);
					while($rows = @mysql_fetch_row($result)){
						$school = $rows[0];	
					}
					echo '<span class="khung edu"><img src="DangNhap/IMG/education.png" /></span>';
					if( $school != ''){
						echo '<span class="tieude"><a>Trường : </a>'.$school.'</span>';
					}elseif(($_SESSION['user'] == $_SESSION['email']) && $school == ''){
						echo '<span class="tieude"><a href="javascript:showone(\'show-job\')">Thêm Trường Học</a></span>';
					}elseif(($_SESSION['user'] != $_SESSION['email']) && $school == ''){
						echo '<span class="tieude"><a>Trường Học:</a> chưa cập nhật ...</span>';
					}
				?>
                <!-- Kết thúc phần hiển thị trường học và công việc -->
                
            </div>    
        </div><!--ket thuc -->
        
        <div class="work-edu khung-info"> <!--bat dau-->
            <div style="float:left; margin-left:15px;">
                <i class="ico-living"></i>
                <span style="display:inline-block; font-size:16px; font-weight:bold;">Chỗ ở hiện tại</span>
            </div>
            <?php
				if($_SESSION['user'] == $_SESSION['email']){
					echo '<div style="float:right;">';
					echo	'<a class="btn-edit" href="javascript:showone(\'show-living\')">';
					echo		'<i class="ico-pencil"></i><span>Sửa đổi</span>';
					echo	'</a>';
					echo '</div>';				}
			?>
            <div id="divCity" class="job-edu">
                <span class="khung job"><img src="DangNhap/IMG/places.png" /></span>
                <?php
					$query = 'select city from profile where email=\''.$_SESSION['user'].'\'';
					$result = @mysql_query($query, $conn);
					
					while($rows = @mysql_fetch_row($result)){
						$city = $rows[0];	
					}
					if($city != ''){
						echo '<span class="tieude"><a>Thành phố: </a>'.$city.'</span>';	
					}elseif(($_SESSION['user'] == $_SESSION['email']) && $city == ''){
						echo '<span class="tieude"><a href="javascript:showone(\'show-living\')">Thêm Thành Phố Hiện Tại</a></span>';
					}elseif(($_SESSION['user'] != $_SESSION['email']) && $city == ''){
						echo '<span class="tieude"><a>Thành phố: </a> chưa cập nhật ...</span>';	
					}
					
				?>
                
                <span class="khung edu"><img src="DangNhap/IMG/places.png" /></span>
                <?php
					$query = 'select homeTown from profile where email=\''.$_SESSION['user'].'\'';
					$result = @mysql_query($query, $conn);
					
					while($rows = @mysql_fetch_row($result)){
						$home = $rows[0];	
					}
					if($home != ''){
						echo '<span class="tieude"><a>Quê quán: </a>'.$home.'</span>';	
					}elseif(($_SESSION['user'] == $_SESSION['email']) && $home == ''){
						echo '<span class="tieude"><a href="javascript:showone(\'show-living\')">Thêm Quê Hương</a></span>';
					}elseif(($_SESSION['user'] != $_SESSION['email']) && $home == ''){
						echo '<span class="tieude"><a>Quê quán: </a> chưa cập nhật ...</span>';	
					}
					
				?>
                
            </div>    
        </div><!--ket thuc -->
        
         <div class="work-edu khung-info" style="height:166px;"> <!--bat dau-->
            <div style="float:left; margin-left:15px;">
                <i class="ico-living"></i>
                <span style="display:inline-block; font-size:16px; font-weight:bold;">Mối Quan Hệ</span>
            </div> 
            <?php
				if($_SESSION['user'] == $_SESSION['email']){
					echo '<div style="float:right;">';
					echo	'<a class="btn-edit" href="javascript:showone(\'show-rela\')">';
					echo		'<i class="ico-pencil"></i><span>Sửa đổi</span>';
					echo	'</a>';
					echo '</div>';
				}
			?>     
            <div id="divRelationship" class="job-edu">
                <span class="khung job"><img src="DangNhap/IMG/relationship.png" /></span>
                <?php
					$query = 'select relationship from profile where email=\''.$_SESSION['user'].'\'';
					$result = @mysql_query($query, $conn);

					while($rows = @mysql_fetch_row($result)){
						$relation = $rows[0];
					}
					if ($relation != ''){
						echo '<span class="tieude"><a>Tình trạng quan hệ: </a>'.$relation.'</span>';
					}elseif(($_SESSION['user'] == $_SESSION['email']) && $relation == ''){
						echo '<span class="tieude"><a href="javascript:showone(\'show-rela\')">Thêm Tình Trạng Quan Hệ</a></span>';	
					}elseif(($_SESSION['user'] != $_SESSION['email']) && $relation == ''){
						echo '<span class="tieude"><a>Tình trạng quan hệ: </a>chưa cập nhật ...</span>';
					}
				?>
                               
            </div>    
        </div><!--ket thuc -->
             
        
    </div>
    
	<div id="right-col-info">
    
    	<div class="khung-info add-r"><!-- bat dau about me -->
        	<div id="divBiography" style="float:left; margin-left:15px;">             
                <span style="display:inline-block; font-size:16px; font-weight:bold;">Tiểu Sử</span>
                <span style="display:block; margin-top:30px;">
                	<label style="font-weight:bold; color:#333; margin-right:15px;"><?php  
						$query = "select birthday from profile where email = '".$_SESSION['user']."'";
						$result = @mysql_query($query, $conn);

						while($rows = @mysql_fetch_row($result)){
							$time = $rows[0];
						}
						echo substr($time, 0, 4);
					?></label>
                    <label style=" color:#333;"><i class="ico-born"></i>Sinh ngày <?php echo substr($time, 8, 2); ?> tháng <?php echo substr($time, 5, 2); ?> năm <?php echo substr($time, 0, 4); ?></label>
               	</span>
            </div>      
        </div><!-- ket thuc about me -->
        
        <div class="khung-info add-about"><!-- bat dau about me -->
        	<div style="float:left; margin-left:15px; margin-top:15px; padding-right:15px;">             
                <span style="display:inline-block; font-size:16px; font-weight:bold;">Về Bản Thân</span>
                
                <?php
					if($_SESSION['user'] == $_SESSION['email']){
						echo '<div style="float:right; margin-left:125px; margin-top:auto;">';
						echo	'<a class="btn-edit" href="javascript:showone(\'show-about\');">';
						echo		'<i class="ico-pencil"></i><span>Sửa đổi</span>';
						echo	'</a>';
						echo '</div>';
					}
				
				?>
                <span style="display:block; margin-top:20px; margin-bottom:20px;">
                	<label id="lblAbout"> <?php 
				$query = 'select aboutMe from profile where email=\''.$_SESSION['user'].'\'';
				$result = @mysql_query($query, $conn);
				while($rows = @mysql_fetch_row($result)){
					if ($rows[0] != ''){
						echo $rows[0];
					}elseif(($_SESSION['email'] == $_SESSION['user']) && $rows[0] == '' ){
						echo '<a href="javascript:showone(\'show-about\');"> Hãy viết một thứ gì đó ... </a>';	
					}elseif(($_SESSION['email'] != $_SESSION['user']) && $rows[0] == '' ){
						echo 'chưa cập nhật ...';	
					}
				}
			?></label>
               	</span>
            </div>      
        </div><!-- ket thuc about me -->
        
        <div class="khung-info add-about" style="margin-top:auto;"><!-- bat dau about me -->
        	<div style="float:left; margin-left:15px; margin-top:15px;">             
                <span style="display:inline-block; font-size:16px; font-weight:bold;">Thông Tin Cơ Bản</span>
                
                <?php
					if($_SESSION['user'] == $_SESSION['email']){
						echo '<div style="float:right; margin-left:125px; margin-top:-20px; margin-right:15px;">';
						echo	'<a class="btn-edit" href="javascript:showone(\'show-basic\')">';
						echo		'<i class="ico-pencil"></i><span>Sửa đổi</span>';
						echo	'</a>';
						echo '</div>';
					}
				?>
                
                <span style="display:block; margin-top:30px; margin-bottom:20px;">
                	<table id="tblBasicInfo">
                    	<tr>
                        	<td class="head-td">Sinh Nhật<td>
                            <td><?php  
								$query = "select birthday from profile where email = '".$_SESSION['user']."'";
								$result = @mysql_query($query, $conn);
		
								while($rows = @mysql_fetch_row($result)){
									$time = $rows[0];
								}
								echo substr($time, 8, 2).'/'.substr($time, 5, 2).'/'.substr($time, 0, 4);
							?></td>
                        </tr>
                        <tr>
                        	<td class="head-td">Giới Tính<td>
                            <td><?php 
								$query = 'select sex from profile where email=\''.$_SESSION['user'].'\'';
								$result = @mysql_query($query, $conn);
								while($rows = @mysql_fetch_row($result)){
									$sex = $rows[0];
								}
								echo $sex;
							?></td>
                        </tr>
                    </table>
               	</span>
            </div>      
        </div><!-- ket thuc about me -->
        
         <div class="khung-info add-about" style="margin-top:auto;"><!-- bat dau about me -->
        	<div style="float:left; margin-left:15px; margin-top:15px;">             
                <span style="display:inline-block; font-size:16px; font-weight:bold;">Thông Tin Liên Lạc</span>
                
                <?php
					if($_SESSION['email'] == $_SESSION['user']){
						echo '<div style="float:right; margin-left:90px; margin-top:-20px; margin-right:15px;">';
						echo	'<a class="btn-edit" href="javascript:showone(\'show-contact\')">';
						echo		'<i class="ico-pencil"></i><span>Sửa đổi</span>';
						echo	'</a>';
						echo '</div>';
					}
				?>
                
                <span style="display:block; margin-top:30px; margin-bottom:20px;">
                	<table id="tblContact">
                    	<tr>
                        	<td class="head-td">Điện Thoại<td>
                            <td><?php 
								$query = 'select phoneNumber from profile where email=\''.$_SESSION['user'].'\'';
								$result = @mysql_query($query, $conn);
								
								while($rows = @mysql_fetch_row($result)){
									$phone = $rows[0];	
								}
								if($phone != 0){
									echo $phone;
								}elseif(($_SESSION['email'] == $_SESSION['user']) && $phone == 0){
									echo '<a href="javascript:showone(\'show-contact\')">Hãy nhập số điện thoại của bạn ...</a>';
								}elseif(($_SESSION['email'] != $_SESSION['user']) && $phone == 0){
									echo 'chưa cập nhật ...';
								}
							
							?></td>
                        </tr>
                        <tr>
                        	<td class="head-td">Địa Chỉ<td>
                            <td><?php
                            	$query = 'select address from profile where email=\''.$_SESSION['user'].'\'';
								$result = @mysql_query($query, $conn);
								
								while($rows = mysql_fetch_row($result)){
									$address = $rows[0];	
								}
								if($address != ''){
									echo $address;		
								}elseif(($_SESSION['email'] == $_SESSION['user']) && $address == ''){
									echo '<a href="javascript:showone(\'show-contact\')">Hãy nhập địa chỉ của bạn ...</a>';
								}elseif(($_SESSION['email'] != $_SESSION['user']) && $address == ''){
									echo 'chưa cập nhật ...';
								}
							
							?></td>
                        </tr>
                    </table>
               	</span>
            </div>      
        </div><!-- ket thuc about me -->
        
        <div class="khung-info add-about" style="margin-top:auto;"><!-- bat dau about me -->
        	<div style="float:left; margin-left:15px; margin-top:15px;">             
                <span style="display:inline-block; font-size:16px; font-weight:bold;">Trích Dẫn Ưa Thích</span>
                
                <?php
					if($_SESSION['email'] == $_SESSION['user']){
						echo '<div style="float:right; margin-left:165px; margin-top: -20px; margin-right:15px;">';
						echo	'<a class="btn-edit" href="javascript:showone(\'show-favourite\');">';
						echo		'<i class="ico-pencil"></i><span>Sửa đổi</span>';
						echo	'</a>';
						echo '</div>';
					}
				?>
                
                 <span style="display:block; margin-top:20px;; margin-bottom:20px;">
                	<label id="lblAbout2"><?php 
				$query = 'select quote from profile where email=\''.$_SESSION['user'].'\'';
				$result = @mysql_query($query, $conn);
				while($rows = @mysql_fetch_row($result)){
					if ($rows[0] != ''){
						echo $rows[0];
					}elseif(($_SESSION['email'] == $_SESSION['user']) && $rows[0] == ''){
						echo '<a href="javascript:showone(\'show-favourite\');"> Hãy viết một thứ gì đó ... </a>';
					}elseif(($_SESSION['email'] != $_SESSION['user']) && $rows[0] == ''){
						echo 'chưa cập nhật ...';	
					}
				}
			?></label>
               	</span>
            </div>      
        </div><!-- ket thuc about me -->
        
    </div>
    
    
    <div id="show-about" class="about-you bong bogoc" style="display:none;"><!-- div edit about me -->
    	<div class="arrow-box"></div>
    	<div style="float:left;">
    		<label class="head-td" style="float:left;">Về Bản Thân:</label>
    		<textarea id="txtAbout1" placeholder="" class="text-aboutyou"><?php 
				$query = 'select aboutMe from profile where email=\''.$_SESSION['user'].'\'';
				$result = @mysql_query($query, $conn);
				while($rows = @mysql_fetch_row($result)){
					if ($rows[0] == ''){
						echo '';
					}else{
						echo $rows[0];	
					}
				}
			?></textarea>
      	</div>
        <div style="float:right; margin-top:4px;">
        	<label id="about-accept" class="postAbout"><input class="p-about" type="button"  value="Đăng"/></label>
            <label id="about-cancel" class="postAbout" onclick="closeabout()"><input class="p-about" type="submit" value="Hủy"  /></label>
        </div>
    </div><!-- ket thuc about me -->
    
    <div id="show-favourite" class="favourite bong bogoc" style="display:none;"><!-- div edit trich dan ua thich -->
    	<div class="arrow-box"></div>
    	<div style="float:left;">
    		<label class="head-td" style="float:left;">Trích dẫn ưa thích:</label>
    		<textarea id="txtAbout2" placeholder="" class="text-aboutyou"><?php 
				$query = 'select quote from profile where email=\''.$_SESSION['user'].'\'';
				$result = @mysql_query($query, $conn);
				while($rows = @mysql_fetch_row($result)){
					if ($rows[0] == ''){
						echo '';
					}else{
						echo $rows[0];	
					}
				}
			?></textarea>
      	</div>
        <div style="float:right; margin-top:4px;">
        	<label id="favourite-accept" class="postAbout"><input class="p-about" type="submit"  value="Đăng"/></label>
            <label id="favourite-cancel" class="postAbout" onclick="closefavourite()"><input class="p-about" type="submit" value="Hủy"  /></label>
        </div>
    </div><!-- ket thuc trich dan ua thich -->
    
     <div id="show-rela" class="rela bong bogoc" style="display:none;"><!-- div edit tinh trang quan he -->
    	<div class="arrow-box" style="margin-left:300px;"></div>
    	<div style="float:left;">
    		<label class="head-td" style="float:left;">Tình Trạng Quan Hệ</label>
    		<select id="select-rela">
            	<option value="alone">Độc Thân Vui Tính</option>
                <option value="family">Đã Lập Gia Đình</option>
                <option value="open">Quan Hệ Mở</option>
                <option value="complex">Phức tạp</option>
                <option value="none"></option>
            </select>
      	</div>
        <div style="float:right;">
        	<label id="rela-accept" class="postAbout"><input class="p-about" type="submit"  value="Đăng"/></label>
            <label id="rela-cancel" class="postAbout" onclick="closerela()"><input class="p-about" type="submit" value="Hủy"  /></label>
        </div>
    </div><!-- ket thuc tinh trang quan hes -->
    
     <div id="show-job" class="edit-job bong bogoc" style="display:none;"><!-- div edit nghe nghiep-->
    	<div class="arrow-box"></div>
    	<div style="float:left;">
        	<table>
            	<tr>
                	<td><label class="head-td" style="float:left;">Công Việc Hiện Tại</label></td>
                    <td><input id="iptJob" type="text" name="textJob" style="width:250px;" value="<?php 
						$query = 'select job from profile where email="'.$_SESSION['email'].'";';
						@$result = mysql_query($query, $conn);
						while($rows = mysql_fetch_row($result)){
							$job = $rows[0];
						}
						echo $job;
					?>" /></td>
                </tr>
                <tr>
                	<td><label class="head-td" style="float:left;">Trường Theo Học</label></td>
                    <td><input id="iptSchool" type="text" name="textSchool"  style="width:250px;" value="<?php 
						$query = 'select school from profile where email="'.$_SESSION['email'].'";';
						@$result = mysql_query($query, $conn);
						while($rows = @mysql_fetch_row($result)){
							$job = $rows[0];
						}
						echo $job;
					?>"/></td>
                </tr>
    			
    			
           	</table>
      	</div>
        <div style="float:right;">
        	<label id="job-accept" class="postAbout"><input id="btnJob" class="p-about" type="button"  value="Đăng"/></label>
            <label id="job-cancel" class="postAbout" onclick="closejob()"><input class="p-about" type="button" value="Hủy"  /></label>
        </div>
    </div><!-- ket thuc nghe nghiep-->
    
    <div id="show-living" class="edit-living bong bogoc" style="display:none;"><!-- div edit cho o-->
    	<div class="arrow-box"></div>
    	<div style="float:left;">
        	<table>
            	<tr>
                	<td><label class="head-td" style="float:left;">Thành Phố Hiện Tại</label></td>
                    <td><input id="txtCity" type="text" name="textCity" style="width:250px;" value="<?php 
						$query = 'select city from profile where email=\''.$_SESSION['user'].'\'';
						$result = @mysql_query($query, $conn);
						
						while($rows = @mysql_fetch_row($result)){
							$city = $rows[0];	
						}
						if($city == ''){
							echo '';
						}else{
							echo $city;	
						}
					?>" /></td>
                </tr>
                <tr>
                	<td><label class="head-td" style="float:left;">Quê Hương Của Bạn</label></td>
                    <td><input id="txtHomeTown" type="text" name="textHomeTown"  style="width:250px;" value="<?php
                    	$query = 'select homeTown from profile where email=\''.$_SESSION['user'].'\'';
						$result = @mysql_query($query, $conn);
						
						while($rows = @mysql_fetch_row($result)){
							$home = $rows[0];	
						}
						if($home == ''){
							echo '';
						}else{
							echo $home;	
						}
					?>" /></td>
                </tr>
    			
    			
           	</table>
      	</div>
        <div style="float:right;">
        	<label id="living-accept" class="postAbout"><input class="p-about" type="submit"  value="Đăng"/></label>
            <label id="living-cancel" class="postAbout" onclick="closeliving()"><input class="p-about" type="submit" value="Hủy"  /></label>
        </div>
    </div><!-- ket thuc cho o-->
    
    <div id="show-contact" class="edit-contact bong bogoc" style="display:none;"><!-- div edit thong tin lien lac-->
    	<div class="arrow-box"></div>
    	<div style="float:left;">
        	<table>
            	<tr>
                	<td><label class="head-td" style="float:left;">Điện Thoại</label></td>
                    <td><input id="txtPhoneNumber" type="text" name="textDienThoai" style="width:250px;" value="<?php 
						$query = 'select phoneNumber from profile where email=\''.$_SESSION['user'].'\'';
						$result = @mysql_query($query, $conn);
						
						while($rows = @mysql_fetch_row($result)){
							$phone = $rows[0];	
						}
						if($phone == 0){
							echo '';	
						}else{
							echo $phone;
						}
					?>"/></td>
                </tr>
                <tr>
                	<td><label class="head-td" style="float:left;">Địa Chỉ</label></td>
                    <td><input id="txtAddress" type="text" name="textDiaChi"  style="width:250px;" value="<?php 
						$query = 'select address from profile where email=\''.$_SESSION['user'].'\'';
						$result = @mysql_query($query, $conn);
						
						while($rows = @mysql_fetch_row($result)){
							$address = $rows[0];	
						}
						echo $address;
					?>" /></td>
                </tr>
           	</table>
      	</div>
        <div style="float:right;">
        	<label id="contact-accept" class="postAbout"><input class="p-about" type="submit"  value="Đăng"/></label>
            <label id="contact-cancel" class="postAbout" onclick="closecontact()"><input class="p-about" type="submit" value="Hủy"  /></label>
        </div>
    </div><!-- ket thuc thong tin lien lac-->
    
  	<div id="show-basic" class="edit-basic bong bogoc" style="display:none;"><!-- div edit thong tin lien lac-->
    	<div class="arrow-box"></div>
    	<div style="float:left;">
        	<table>
            	<tr>
                	<td><label class="head-td" style="float:left;">Tôi là: </label></td>
                    <td>
                    	<select id="selectSex">
                        	<option value="0">Nam</option>
                            <option value="1">Nữ</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><label class="head-td" style="float:left;">Ngày Sinh:</label></td>
                    <td>
                     Ngày: 
                    	<select id="dayOfBirth">                       
                        	<?php 
								for($i =1; $i <=31; $i++)
								{
									echo "<option value='$i'>$i</option>";	
								}
							?>
                        </select>
                    Tháng:
                    	<select id="monthOfBirth">                       
                        	<?php 
								for($i =1; $i <=12; $i++)
								{
									echo "<option value='$i'>$i</option>";	
								}
							?>
                        </select>
                     Năm:
                    	<select id="yearOfBirth">                       
                        	<?php 
								for($i =1905; $i <=2012; $i++)
								{
									echo "<option value='$i'>$i</option>";	
								}
							?>
                        </select>   
						<?php 
							
						?>
                   	</td>
                </tr>    			
           	</table>
      	</div>
        <div style="float:right;">
        	<label id="basic-accept" class="postAbout"><input class="p-about" type="submit"  value="Đăng"/></label>
            <label id="basic-cancel" class="postAbout" onclick="closebasic()"><input class="p-about" type="submit" value="Hủy"  /></label>
        </div>
    </div><!-- ket thuc thong tin lien lac-->
    
</div>
<!-- InstanceEndEditable -->

</body>
<!-- InstanceEnd --></html>
