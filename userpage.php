<?php 
	@session_start();
	include 'DangNhap/PHP/connect.php';
	include 'postStatus/PHP/calculateTime.php';
	
	if(!isset($_SESSION['ten'])){
		@header('Location: index.php');
	}
	if($_GET['user'] != ''){
		$_SESSION['user'] = $_GET['user'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="../Templates/trangcanhan.dwt" codeOutsideHTMLIsLocked="false" -->
<!-- InstanceBeginEditable name="EditRegion1" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="DangNhap/CSS/trangcanhan.css" type="text/css" rel="stylesheet" />
<script src="DangNhap/JS/jquery-1.8.2.js" type="text/javascript" language="JavaScript"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="DangNhap/JS/jquery.masonry.min.js" type="text/javascript"></script>
<script src="DangNhap/JS/threeaction.js" type="text/javascript" language="JavaScript"></script>
<script src="DangNhap/JS/timeline.js" type="text/javascript" language="javascript"></script>
<script src="postStatus/JS/ajaxPostStatus.js" type="text/javascript"></script>
<script type="text/javascript">
	//div toggle commet
	function toogleDiv(divclass){
		$("." + divclass).toggle();
	};
	
	
</script>
<script type="text/javascript" src="postStatus/JS/jquery.form.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
		function Arrow_Points()
		{ 
			var s = $('#container').find('.item-timeline');
			$.each(s,function(i,obj){
			var posLeft = $(obj).css("left");
			$(obj).addClass('borderclass');
			if(posLeft == "0px")
				{
					html = "<span class='rightCorner'></span>";
					$(obj).prepend(html);			
				}
			else
			{
				html = "<span class='leftCorner'></span>";
				$(obj).prepend(html);
			}
		});
		}
		
        $('#photoimg').live('change', function(){
			$('#divPreview').html('');
			$('#divPreview').html('<img src="postStatus/IMAGE/loader.gif" alt="Uploading ..." />');
			$('#frmUploadImage').ajaxForm({
				success: function(data){
					$('#container').masonry( 'remove', $('#dinhchuan').parent());
				
					$("#container").prepend('' +
                        '<div class="item-timeline" style="height:170px;">' +
                            '<div id="dinhchuan" style="padding:5px 5px 5px 5px; position:absolute; top:0px;">' +
                                '<ul><li><a href="javascript:showthis(\'khung-1\')">' +
                                    '<div class="li-status"><i class="ico-status"></i>Trạng Thái</div></a></li>' +
                                    '<li><a href="javascript:showthis(\'khung-2\')"><div class="li-status"><i class="ico-picture"></i>Hình Ảnh</div></a></li></ul>' +
                                     '<div id="khung-1" class="allinone" style="display:block;">' +
                                    '<div class="arrow-status"></div><textarea id="txtStatus" placeholder="Bạn nghĩ gì..." class="textarea-status"></textarea>' +
                                    '<div class="btnDangHet">' +
                                        '<a class="locate-user" title="Vị trí của bạn"></a>'+
                                        '<label id="lblPostStatus" class="buttonPost">' +
                                            '<input type="button" value="Đăng" class="btnPost1" />' +
                                        '</label></div></div>' +
                                    '<div id="khung-2" class="allinone"><div class="arrow-status" style="margin-left:130px;"></div>' +
                                    '<div class="cont-khung"><div class="khung-upanh" style="margin-left:10px;"><span><a href="javascript:showthis(\'start-up\')">Tải Ảnh</a></span></div>' +
                                    '<div class="khung-upanh"><span><a>Tạo Album</a></span></div></div><div class="btnDangHet">' +
                                         '<a class="locate-user" title="Vị trí của bạn" ></a>'+
                                        '<label class="buttonPost">' +
                                            '<input type="button" value="Đăng"  class="btnPost"/>' +
                                        '</label></div></div>' +
                                     '<div id="start-up" class="allinone"><form id="frmUploadImage" action="postStatus/PHP/postImage.php" method="post">' +
                                    '<textarea id="txtImageContent" name="txtImageContent" placeholder="bình luận điều gì đó về bức ảnh này..." style="height:70px; width:385px;"></textarea>' +
                                    '<input type="file" style="display:block;" multiple="multiple" name="photoimg" id="photoimg"/><div id="divPreview"></div></form></div></div></div>'+data);
					
					//$('#divContent').html(data);
					
					$('#container').masonry( 'reload', alert('Tải ảnh lên thành công ^o^') );
					$('#divContent').masonry( 'reload' );
					$('.rightCorner').hide();
					$('.leftCorner').hide();
					Arrow_Points();
					
					//location.reload();
					return false;	
				}
			}).submit();
			
			$('#divPreview').html('');
			$('#txtImageContent').val('');
			$('#photoimg').val('');
			
			$('#container').masonry( 'reload' );

			$('.rightCorner').hide();
			$('.leftCorner').hide();
			Arrow_Points();
			
			//location.reload();
		});
    });
</script>
<script src="Comment/JS/ajaxPostComment.js" type="text/javascript"></script>
<script type="text/javascript" src="makeFriend/JS/ajaxRequest.js"></script>
<script type="text/javascript" src="likeUnlike/JS/ajaxLike.js"></script>
<script type="text/javascript" src="searchEverything/JS/ajaxSearch.js"></script>
<link href="DangNhap/CSS/userpage.css" rel="stylesheet" type="text/css" />
<link href="DangNhap/CSS/timeline.css" rel="stylesheet" type="text/css" />
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
                        <input type="text" id="txtSearch" name="txtTim" class="KhungTimKiem" onkeyup="" title="Tìm Kiếm Bạn Bè" placeholder="Tìm kiếm mọi thứ cùng chúng tôi ..." autocomplete="off" />  
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
	<!-- bat dau div top banner -->
	<div id="topbanner">
    
    	<div id="coverImage">
        	<img src="<?php 
							$query = 'select * from album where albumID = \'ALB002'.$_SESSION['user'].'\';';
							$result = mysql_query($query, $conn);
							if(mysql_num_rows($result) == 0){
								echo 'IMAGE/cover.jpg';	
							}else{
								$query1 = 'select imageID from image where albumID = \'ALB002'.$_SESSION['user'].'\' and statusIMG = 2';
								$result1 = mysql_query($query1, $conn);
								if(mysql_num_rows($result1) != 0){
									while($rows = mysql_fetch_row($result1)){
										$str = $rows[0];
									}
								}
								echo 'IMAGE/'.$str;							
							}
						?>" />
        </div>
        <?php
			if($_SESSION['email'] == $_SESSION['user']){
				echo '<div id="img-cover" class="general vitri1"><i class="ico-pencil"></i><a href="uploadCover/uploadCover.php?user='.$_SESSION['email'].'"> Thay Đổi Nền</a> </div>';
			}
		?>
        
        
        <div id="name-user">
        	<div id="ava-prof">
            	<img src="<?php 
							$query = 'select * from album where albumID = \'ALB001'.$_SESSION['user'].'\';';
							@$result = mysql_query($query, $conn);
							if(@mysql_num_rows($result) == 0){
								echo 'IMAGE/avatar.jpg';	
							}else{
								$query1 = 'select imageID from image where albumID = \'ALB001'.$_SESSION['user'].'\' and statusIMG = 1';
								@$result1 = mysql_query($query1, $conn);
								if(mysql_num_rows($result1) != 0){
									while($rows = mysql_fetch_row($result1)){
										$str = str_replace('.', 'thumbnail.', $rows[0]);
									}
								}
								echo 'IMAGE/'.$str;
								
							}
						?>" />
            </div> 
    	</div>   
        
        <?php
			if($_SESSION['email'] == $_SESSION['user']){
				echo '<div id="img-ava" class="general vitri2"><i class="ico-pencil"></i><a href="UploadAvatar/photo_upload.php?user='.$_SESSION['email'].'">Đổi Ảnh Hiển Thị</a></div>';
			}
		?>
        
 		
        <div id="user">
        	<h2><?php 
			$query = "select CONCAT_WS('  ', lastname, firstname) as name from profile where email='".$_SESSION['user']."'";
			$result = mysql_query($query, $conn);
			while($rows = @mysql_fetch_row($result)){
				$ten = $rows[0];
			}
			echo $ten;
			?></h2>
            <?php
				if($_SESSION['email'] == $_SESSION['user']){
					echo '<h4><a href="updateinfo.php?user='.$_SESSION['email'].'" class="update-info"><span>Cập nhật thông tin</span></a></h4>';
				}
			?>
        	<?php
				// xem xem là vào trang cá nhân của ng khác hay đang ở trên trang của mình
				// nếu vào trang của ng khác
				if($_SESSION['email'] != $_SESSION['user']){
					// TH1:  đã là bạn.
					// kiểm tra xem cả 2 đã là bạn chưa.
					$query = 'select count(*) from friend where fromUser=\''.$_SESSION['user'].'\' and toUser=\''.$_SESSION['email'].'\' and statusFriend = 2';
					$result = @mysql_query($query, $conn);
					while($rows = @mysql_fetch_row($result)){
						$friend1 = $rows[0]; // trường hợp này người gửi yêu cầu ko phải là mình.
					}
					$query = 'select count(*) from friend where fromUser=\''.$_SESSION['email'].'\' and toUser=\''.$_SESSION['user'].'\' and statusFriend = 2';
					$result = @mysql_query($query, $conn);
					while($rows = @mysql_fetch_row($result)){
						$friend2 = $rows[0]; // trường hợp này người gửi yêu cầu là mình.
					}
					if($friend1 || $friend2){ // Nếu 1 trong 2 trường hợp trên xảy ra thì là bạn của nhau.
						// Hủy kết bạn
						echo '<h4 class="btnUnFriend"><a class="update-info"><span>Hủy kết bạn</span></a></h4>';
					}elseif(!$friend1 && !$friend2){// TH2: Trường hợp này ko tìm được mối quan hệ bạn bè nào giữa 2 người
						
						$query = 'select count(*) from friend where fromUser=\''.$_SESSION['user'].'\' and toUser=\''.$_SESSION['email'].'\' and statusFriend != 2';
						$result = @mysql_query($query, $conn);
						while($rows = @mysql_fetch_row($result)){
							$num_row1 = $rows[0]; // Xem xem 2 người này đã gửi yêu cầu cho nhau chưa ?
						}
						 
						$query = 'select count(*) from friend where fromUser=\''.$_SESSION['email'].'\' and toUser=\''.$_SESSION['user'].'\' and statusFriend != 2';
						$result = @mysql_query($query, $conn);
						while($rows = @mysql_fetch_row($result)){
							$num_row2 = $rows[0]; // Xem xem 2 người này đã gửi yêu cầu cho nhau chưa ?
						}
						if(($num_row1 == 1) || ($num_row2 == 1)){ // TH3:  trường hợp này đã gửi yêu cầu cho nhau.
							// tiếp theo ta xem ai là người gửi yêu cầu.
							if($num_row1 == 1){// người gửi là người kia, ko phải là mình.
								// Mình sẽ trả lời lời mời kết bạn cho người kia
								echo '<h4 class="btnResponeRequest"><a class="update-info"><span>Đồng ý lời mời kết bạn</span></a></h4>';
							}elseif($num_row2 == 1){ // Mình là người gửi
								// Thấy lâu quá, ghét, hủy lời mời kết bạn.
								echo '<h4 class="btnDeleteRequest"><a class="update-info"><span>Hủy lời mời kết bạn</span></a></h4>';
							}
							
						}elseif(($num_row1 != 1) && ($num_row2 != 1)){ // TH4: trường hợp này 2 người chưa gửi yêu cầu cho nhau.
							// Cho phép yêu cầu kết bạn
							echo '<h4 class="btnSendRequest"><a class="update-info"><span>Kết bạn</span></a></h4>';
						}
					}
				}

				
			?>
        		<h4 id="delete1" class="btnDeleteRequest" style="display:none;"><a class="update-info"><span>Hủy lời mời kết bạn</span></a></h4>
                <h4 id="send1" class="btnSendRequest" style="display:none;"><a class="update-info"><span>Kết bạn</span></a></h4>
                <h4 id="respone1" class="btnResponeRequest" style="display:none;"><a class="update-info"><span>Trả lời lời mời kết bạn</span></a></h4>
                <h4 id="un1" class="btnUnFriend" style="display:none;"><a class="update-info"><span>Hủy kết bạn</span></a></h4>

            	<div id="start">
        			<a href="updateinfo.php?user=<?php echo $_SESSION['user']; ?>">
                    	<div id="info">
                        	<span >Ngày Sinh:  <?php 
								$query = "select birthday from profile where email = '".$_SESSION['user']."'";
								$result = @mysql_query($query, $conn);
						
								while($rows = @mysql_fetch_row($result)){
									$time = $rows[0];
								}
								if($time != ''){
									echo ' Ngày '.substr($time, 8, 2).' tháng '.substr($time, 5, 2).' năm '.substr($time, 0, 4);
								}else{
									echo ' Chưa cập nhật ...';	
								}
							?></span>
                			<span >Giới tính: <?php
								$query = 'select sex from profile where email=\''.$_SESSION['user'].'\'';
								$result = @mysql_query($query, $conn);
								while($rows = @mysql_fetch_row($result)){
									$sex = $rows[0];
								}
								if($sex != ''){
									echo $sex;
								}else{
									echo ' Chưa cập nhật ...';
								}
							 ?></span>
                            <span>Trường Học: <?php
                            	$query = 'select school from profile where email="'.$_SESSION['user'].'";';
								$result = @mysql_query($query, $conn);
								while($rows = @mysql_fetch_row($result)){
									$school = $rows[0];
								}
								if($school != ''){
									echo $school;
								}else{
									echo ' Chưa cập nhật ...';	
								}
							?></span>
                            <span>Thành Phố Hiện Tại: <?php
                            	$query = 'select city from profile where email=\''.$_SESSION['user'].'\'';
								$result = @mysql_query($query, $conn);
								while($rows = @mysql_fetch_row($result)){
									$city = $rows[0];	
								}
								if($city != ''){
									echo $city;
								}else{
									echo ' Chưa cập nhật ...';
								}
							?></span>                                        
                		</div>
                        
                    </a>                    
                  
                    	<div id="list-photos">
                			asdasd<br />asdsad                          
            			</div>
                       
                	  
               
                    	<a href="showfriends.php"><div id="list-friend">
                			asdasd
            			</div>
                        </a>
                	                
              	    
                    	<div id="list-likes">
                			asdasd
            			</div>
                        
               
                    <label style="float:left; margin-left:150px;">Thông tin</label>
                    <label style="float:left; margin-left:185px;">Hình ảnh</label>
                    <label style="float:left; margin-left:80px;">Bạn bè</label>
                    <label style="float:left; margin-left:80px;">Thích</label>
        		</div>      
        	</div> 
        </div>
        
        <!-- start timeline -->
        <div id="container">

             <!-- timeline navigator  -->
        
            <div class="timeline_container">
                <div class="timeline">
                    <div class="plus"> </div>
                </div>
            </div>
        
            <div class="item-timeline" style="height:170px;"> 
           		<div id="dinhchuan" style="padding:5px 5px 5px 5px; position:absolute; top:0px;">            
                    <table>
                    	<tr>
                        	<td><a href="javascript:showthis('khung-1')"><div class="li-status"><i class="ico-status"></i>Trạng Thái</div></a></td>
                            <td><a href="javascript:showthis('khung-2')"><div class="li-status"><i class="ico-picture"></i>Hình Ảnh</div></a></td>
                        </tr>
                    </table> 
                
                    <div id="khung-1" class="allinone" style="display:block;">
                    	<div class="arrow-status"></div>
                        <textarea id="txtStatus" placeholder="Bạn nghĩ gì..." class="textarea-status"></textarea>
                        <div class="btnDangHet">
                            <a class="locate-user" title="Vị trí của bạn" ></a>
                    		<label id="lblPostStatus" class="buttonPost"><input type="button" value="Đăng" class="btnPost1" /></label>
                    	</div>
                    </div>
                    
                    <div id="khung-2" class="allinone">
                    	<div class="arrow-status" style="margin-left:130px;"></div>
                    	<div class="cont-khung">
                     		<div class="khung-upanh" style="margin-left:10px;">
                            	<span><a href="javascript:showthis('start-up')">Tải Ảnh</a></span>
                            </div>
                            <div class="khung-upanh">
                            	<span><a>Tạo Album</a></span>
                            </div>
                    	</div>
                        <div class="btnDangHet">
                            <a class="locate-user" title="Vị trí của bạn" ></a>
                    		<label class="buttonPost"><input type="button" value="Đăng"  class="btnPost"/></label>
                    	</div>
                  	</div>
                    
                    <div id="start-up" class="allinone">
                    	<form id="frmUploadImage" action="postStatus/PHP/postImage.php" method="post">
                            <textarea id="txtImageContent" name="txtImageContent" placeholder="bình luận điều gì đó về bức ảnh này..." style="height:70px; width:385px;"></textarea>
                            <input type="file" style="display:block;" multiple="multiple" name="photoimg" id="photoimg"/>
                            
                            <div id="divPreview"></div>
                        </form>
                    </div>

            	</div>  
            </div>
            
            <div id="divContent"> <!-- Div này có nhiệm vụ in ra các action khi dùng ajax load lại trang -->
            <!-- Bắt đầu in ra các action có trên timeline của user bằng hàm PHP -->
            <?php 
				$query = 'select * from action where actionLocation=\''.$_SESSION['user'].'\' order by timeUpdate DESC;';
				$result = @mysql_query($query, $conn);
				
				while($rows = @mysql_fetch_row($result)){
					if(((substr($rows[3], 0, 3)) != 'CMT') && ((substr($rows[3], 0, 3)) != 'LIK') ){
						
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
										echo 	'</a></td></tr>
													<tr><td><label class="time-head">'.$timeDisplay.'</label>&nbsp;&nbsp;<label class="time-head">';
													if($rows[5] != '' && $rows[5] != 'NULL' && $rows[5] != ' '){
														echo 'gần '.$rows[5];
													}
													echo '</label></td></tr>
												</table>
										   </td>
										</tr>
									</table>              
								</div>
								<div class="main-head"><br />     		
									<span style="margin-left:10px; margin-right:10px; font-size:13px;">';
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
									<span><a id="'.$rows[0].'like" class="like-tool">';
									
									$query19 = 'select actionType from action where actionID=\''.$rows[0].'\'';
									$result19 = @mysql_query($query19, $conn);
									while($rows19 = @mysql_fetch_row($result19)){
										$statusID = $rows19[0];	
									}
									
									$query15 = 'SELECT count(*), likeID FROM `like` WHERE likeType=\''.$statusID.'\'';
									$result15 = @mysql_query($query15, $conn);
									while($rows15 = @mysql_fetch_row($result15)){
										$numLike1 = $rows15[0];
										$likeID1 = $rows15[1];
										break;
									}
									
									
									//TH1: Nếu chua có ai thik điều này cả, thì ta show nút like.
									if($numLike1 == 0){
										echo 'Thích </a>';
									}elseif($numLike1 == 1){// TH2: nếu chỉ có 1 người thik điều này thôi, thì ta show tên người đó ra, nếu là mình thik thì show ra Bạn thích điều này.
										$query16 = 'select actionUser from action where actionType=\''.$likeID1.'\'';
										$result16 = @mysql_query($query16, $conn);
										while($rows16 = @mysql_fetch_row($result16)){
											$userLike1 = $rows16[0];
											
											break;	
										}
										
										// Nếu người đó là người khác.
										if($userLike1 != $_SESSION['email']){
											$query17 = "select CONCAT_WS('  ', lastname, firstname) as name from profile where email='".$userLike1."'";
											$result17 = mysql_query($query17, $conn);
											while($rows17 = @mysql_fetch_row($result17)){
												$nameUser1 = $rows17[0];
											}
											
										echo 'Thích. <span>'.$nameUser1.' thích điều này. </span></a>';
										}elseif($userLike1 == $_SESSION['email']){// nếu người đó chính là mình.
											echo 'Bạn thích điều này </a>';
										}
									}elseif($numLike1 > 1){
										// TH3: có nhiều hơn 1 người like điều này. Trong đó có mình.
										$userLike1 = '';
										$query18 = 'select action.actionUser from `action`, `like` where like.likeType=\''.$rows4[0].'\' and action.actionType = like.likeID';
										$result18 = @mysql_query($query18, $conn);
										while($rows18 = @mysql_fetch_row($result18)){
											$userLike1 = $rows18[0];
											if($userLike1 == $_SESSION['email']){
												break;	
											}
										}
										if($userLike1 == $_SESSION['email']){// Nếu mình có like 
											echo 'Bạn và '.($numLike1-1).' người khác thích điều này';
										}elseif($userLike1 != $_SESSION['email']){
											echo 'Thích <span>'.$numLike1.' người khác thích điều này.</span></a>';
										}
										
									}
									
									echo'</span>
									<span><a class="like-tool" href="javascript:toogleDiv(\'show-cmt\');">Bình luận</a></span>     
											   
								</div>
									
					  
									</span>';
									// Phần này in ra comment của action
							echo 	'<div id="'.$rows[0].'a">';
										$query4 = 'select * from comment where comment.commentType=\''.$rows[3].'\'';
										$result4 = @mysql_query($query4, $conn);
										if(@mysql_num_rows($result4)){
											// Bắt đầu in comment
											while($rows4 = @mysql_fetch_row($result4)){
												$query7 = 'select timeUpdate from action where actionType=\''.$rows4[0].'\'';
												$result7 = @mysql_query($query7, $conn);
												while($rows7 = @mysql_fetch_row($result7)){
													$timeDisplay1 = calculateTime($rows7[0]);
												}
												
												$query9 = 'select actionUser from action where actionType=\''.$rows4[0].'\'';
												$result9 = @mysql_query($query9, $conn);
												while($rows9 = @mysql_fetch_row($result9)){
													$actionUser = $rows9[0];	
												}
												echo '<div class="show-cmt-like">
													<span class="show-cmt">         
														<table> 
															<tr>
																<td valign="top"><img src="';
																	$query5 = 'select imageID from image where albumID=\'ALB001'.$actionUser.'\' and statusIMG = 1';
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
																		<tr><td><a href="userpage.php?user='.$actionUser.'" class="link-user">';
																		$query6 = "select CONCAT_WS('  ', lastname, firstname) as name from profile where email='".$actionUser."'";
																		$result6 = mysql_query($query6, $conn);
																		while($rows6 = @mysql_fetch_row($result6)){
																			echo $rows6[0];	
																		}
												echo					'</a> <span class="cont-msg1">'.$rows4[2].'</span></td></tr>
																		<tr>
																			<td><span class="time-cmt">'.$timeDisplay1.'</span><a id="';
																			$query10 = 'select actionID from action where actionType=\''.$rows4[0].'\'';
																			$result10 = @mysql_query($query10, $conn);
																			while($rows10 = @mysql_fetch_row($result10)){
																				echo $rows10[0];	
																			}
																		echo 'like" class="like-cmt">';
																		$query11 = 'SELECT count(*), likeID FROM `like` WHERE likeType=\''.$rows4[0].'\'';
																		$result11 = @mysql_query($query11, $conn);
																		while($rows11 = @mysql_fetch_row($result11)){
																			$numLike = $rows11[0];
																			$likeID = $rows11[1];
																			break;
																		}
																		
																		//TH1: Nếu chua có ai thik điều này cả, thì ta show nút like.
																		if($numLike == 0){
																			echo 'Thích </a>';
																		}elseif($numLike == 1){// TH2: nếu chỉ có 1 người thik điều này thôi, thì ta show tên người đó ra, nếu là mình thik thì show ra Bạn thích điều này.
																			$query12 = 'select actionUser from action where actionType=\''.$likeID.'\'';
																			$result12 = @mysql_query($query12, $conn);
																			while($rows12 = @mysql_fetch_row($result12)){
																				$userLike = $rows12[0];
																				
																				break;	
																			}
																			
																			// Nếu người đó là người khác.
																			if($userLike != $_SESSION['email']){
																				$query13 = "select CONCAT_WS('  ', lastname, firstname) as name from profile where email='".$userLike."'";
																				$result13 = mysql_query($query13, $conn);
																				while($rows13 = @mysql_fetch_row($result13)){
																					$nameUser = $rows13[0];
																				}
																				
																			echo 'Thích. <span>'.$nameUser.' thích điều này. </span></a>';
																			}elseif($userLike == $_SESSION['email']){// nếu người đó chính là mình.
																				echo 'Bạn thích điều này </a>';
																			}
																		}elseif($numLike > 1){
																			// TH3: có nhiều hơn 1 người like điều này. Trong đó có mình.
																			$userLike = '';
																			$query14 = 'select action.actionUser from `action`, `like` where like.likeType=\''.$rows4[0].'\' and action.actionType = like.likeID';
																			$result14 = @mysql_query($query14, $conn);
																			while($rows14 = @mysql_fetch_row($result14)){
																				$userLike = $rows14[0];
																				if($userLike == $_SESSION['email']){
																					break;	
																				}
																			}
																			if($userLike == $_SESSION['email']){// Nếu mình có like 
																				echo 'Bạn và '.($numLike-1).' người khác thích điều này';
																			}elseif($userLike != $_SESSION['email']){
																				echo 'Thích <span>'.$numLike.' người khác thích điều này.</span></a>';
																			}
																			
																		}
																		
																	
																		echo '</td>                                           
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
									echo '<span class="show-cmt">        
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
											
										</span>';
										// Kết thúc in commment
			echo					'</div>                  
								</div>';
								// Kết thúc in status	
				}
				}
			
			?>
<script type="text/javascript">
	$('#container').masonry( 'remove', $('#dinhchuan').parent());
	$('#container').masonry( 'reload');
	$('.rightCorner').hide();
	$('.leftCorner').hide();
	
	Arrow_Points();
</script>     
            <!-- Kết thúc in ra các action trên timeline -->
            
            <!-- Kết thúc div in nội dung action -->
            <!-- Div timeline mẫu 
            <div class="item-timeline">
            	<a class="deletebox">x</a>
            	<div class="full-head">
            		<table>
                    	<tr>
                        	<td><img src="DangNhap/IMG/ava-prof.jpg" height="32px" width="32px" /></td>
                            <td>
                            	<table>
                                	<tr><td><a class="name-head">User Name</a></td></tr>
                                    <tr><td><label class="time-head">16 phút trước</label></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>               
                </div>
                <div class="main-head">            		
                	<span style="margin-left:10px; margin-right:10px; font-size:13px;"><br />
                    	ádasdasdasdasd asdasdasdasd asdasdasdasd asdasdasdasd asdasdasdasd asdasdasdasd
                    </span>
                    <span><img class="post-img" src="DangNhap/IMG/coverImage.jpg" /></span>
                </div>
                <div class="act-head">
                	<span><a class="like-tool">Thích</a></span>
                    <span><a class="like-tool" href="javascript:toogleDiv('show-cmt');">Bình luận</a></span>      
                               
                </div>
                
                <div class="show-cmt-like">
                	<span class="show-like"><i class="icon-like"></i>Bạn và <a class="like-tool">Xubi</a> người khác thích điều này</span>
                    
                    <span class="show-cmt">         
                    	<table> 
                        	<tr>
                        		<td valign="top"><img src="DangNhap/IMG/ava-prof.jpg" style=" height:32px; width:32px; float:left;" /></td>
                                <td valign="top">
                                	<table>
                                    	<tr><td><a class="link-user">Username</a> <span class="cont-msg1">Nội dung comment đã sửaNội dung comment đã sửaNội dung comment đã sửaNội dung comment đã sửaNội dung comment đã sửaNội dung comment đã sửaNội dung comment đã sửaNội dung comment đã sửaNội dung comment đã sửa</span></td></tr>
                                        <tr>
                                        	<td><span class="time-cmt">Thứ sáu ngày 22 tháng 11 năm 2012</span><a class="like-cmt">Thích</a></td>                                           
                                        </tr>
                                    </table>
                                </td>                    
                        	</tr>    	              	
                        </table>   
                    </span>
                    
                    <span class="show-cmt">         
                    	<table> 
                        	<tr>
                        		<td valign="top"><img src="DangNhap/IMG/ava-prof.jpg" style=" height:32px; width:32px; float:left;" /></td>
                                <td valign="top">
                                	<table>
                                    	<tr><td> <input type="text" class="write-cmt" name="textComment" placeholder="Viết bình luận..." /></td></tr>
                                       
                                    </table>
                                </td>                    
                        	</tr>  
                            <tr>
                            	<td></td>
                                <td>
                                	<div style="margin-left:30px;">
                                    	<label class="buttonPost" style="margin-left:245px;">
                                        	<input type="submit" value="Bình Luận" class="btnPost" />
                                        </label></span>
                                	</div>
                               </td>
                            </tr>  	              	
                    </table>   
                    </span>                  
                </div>                   
            </div><!-- ket thuc mot div dang timeline-->

            <div class="showmap-locate">
                <div id="map"></div>
            </div>
     
            <div id="popup-timeline" class="shade">
                <div class="Popup_rightCorner"></div>
                <div id="box">
                    <b>Bạn đang nghĩ gì ?</b>
                    <br />
                    <textarea id="txtUpdateStatus"></textarea>
                    <label class="btnUpdate"><input type="button" value="Update" id="update_button" /></label>
                </div>
            </div>
     	</div> <!-- end timeline -->

<!-- ket thuc mainbody -->

<!-- InstanceEndEditable -->

</body>
<!-- InstanceEnd --></html>
