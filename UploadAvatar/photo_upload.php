<?php 
	@session_start();
	
	include '../DangNhap/PHP/connect.php';
	if(!isset($_SESSION['ten'])){
		@header('Location: ../index.php');
	}
	if($_GET['user'] != ''){
		$_SESSION['user'] = $_GET['user'];
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Facebook</title>
<link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" /> 
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="../DangNhap/CSS/trangcanhan.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="../DangNhap/JS/threeaction.js"></script>
<script type="text/javascript">
	//div toggle commet
	function toogleDiv(divclass){
		$("." + divclass).toggle();
	};
	
	
</script>
<script type="text/javascript" src="../makeFriend/JS/ajaxRequest.js"></script>
<script type="text/javascript" src="../searchEverything/JS/ajaxSearch2.js"></script>
</head>
<!-- Bắt đầu phần Header của trang -->
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
													echo '../IMAGE/avatar.jpg';	
												}else{
													$query1 = 'select imageID from image where albumID = \'ALB001'.$rows[0].'\' and statusIMG = 1';
													@$result1 = mysql_query($query1, $conn);
													if(mysql_num_rows($result1) != 0){
														while($rows1 = mysql_fetch_row($result1)){
															$str = str_replace('.', 'thumbnail.', $rows1[0]);
														}
													}
													echo '../IMAGE/'.$str;
													
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
                	<a href="../userpage.php?user=<?php echo $_SESSION['email']; ?>">
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
								echo '../IMAGE/'.$str;							
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
                   		<a href="../setting.php">
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

<!-- kết thúc phần Header của trang -->
<p>&nbsp;</p><p>&nbsp;</p>
<div id="wrap">
    
    <div id="uploader">
    	
        <div id="big_uploader">
            <form name="upload_big" id="upload_big"  method="post" enctype="multipart/form-data" action="upload.php?act=upload" target="upload_target">
              <label for="photo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Upload avatar cá nhân: <input name="photo" id="file" size="27" type="file" /></label>
              <input style="display:none;" type="text" name="height" value="450" size="5"/>
              <input style="display:none;" type="text" name="width" value="450" size="5" />  
               <input style="display:none;" type="text" value="<?php echo time(); ?>" name="time" />            
              <input type="submit" name="action" value="Upload" />
            </form>
    	</div><!-- big_uploader -->
        <div id="notice">Đang tải lên..</div>
        <div id="content">
        
			<div id="uploaded">
	   	      <label>2. Dưới đây là avatar của bạn đã được tải lên, click vào hình để chọn ảnh hiển thị.</label>
                	<div id="div_upload_big"></div>
                	
                    <form name="upload_thumb" id="upload_thumb" method="post" action="upload.php?act=thumb" target="upload_target">

                        <input type="hidden" name="img_src" id="img_src" class="img_src" /> 
                        <input type="hidden" name="height" value="0" id="height" class="height" />
                        <input type="hidden" name="width" value="0" id="width" class="width" />
                            
                         <input type="hidden" id="y1" class="y1" name="y" />
                         <input type="hidden" id="x1" class="x1" name="x" />
                         <input type="hidden" id="y2" class="y2" name="y1" />
                         <input type="hidden" id="x2" class="x2" name="x1" />   
                         <input style="display:none;" type="text" value="<?php echo time(); ?>" name="time" />                         
                         <input type="submit" value="Tạo ảnh hiển thị" />
                          
                    </form>

                    
          </div><!-- uploaded-->

		  <div id="thumbnail">
                     <h3>Xem trước</h3>
                     <div id="preview"></div>
                            
                	<h3>Ảnh hiển thị</h3>
                    <div id="div_upload_thumb"></div>
                    
                    
                    
          </div><!-- thumbnail -->
      		
      </div><!-- content -->
        <iframe id="upload_target" name="upload_target" src="" style="width:100%;height:400px;border:1px solid #ccc; display:none"></iframe>
        <!-- this is the secret iframe :) -->
        
    </div><!-- uploader -->


</div><!-- wrap -->

</body>
</html>