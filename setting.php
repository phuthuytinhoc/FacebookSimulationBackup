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
<link href="Setting/CSS/setting.css" type="text/css" rel="stylesheet" />
<script src="Setting/JS/ajaxChange.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="searchEverything/JS/ajaxSearch.js"></script>
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
	<div class="main-col rad-box canhle">
    	<div class="head-set"><h3>Thiết lập tài khoản chung</h3></div>
        <div class="main-set">
        	<table>
            	<tr>
                	<td width="250px;" valign="top"><strong>Thay đổi Tên Họ</strong></td>
                    <td>
                    	<table class="tenho">
                        	  	<tr>
                                	<td width="130px"><label class="tieude-set">Tên:</label></td>
                                    <td><input class="input-set" type="text" id="textTen" autocomplete="off" value="<?php 
										$query = 'select firstname from profile where email=\''.$_SESSION['email'].'\'';
										$result = @mysql_query($query, $conn);
										while($rows = @mysql_fetch_row($result)){
											echo $rows[0];	
										}
									
									?>"/></td>
                                </tr>
                				<tr>
                                	<td><label class="tieude-set">Họ:</label></td>
                                    <td><input class="input-set"  type="text" id="textHo" value="<?php 
									$query = 'select lastname from profile where email=\''.$_SESSION['email'].'\'';
										$result = @mysql_query($query, $conn);
										while($rows = @mysql_fetch_row($result)){
											echo $rows[0];	
										}
									
									 ?>"/></td>
                                </tr>
                              	<tr>
                                	<td></td>
                            		<td>
                                    	<label id="LuuHoTen" class="buttonPost">
                                        	<input class="btnPost" type="button" value="Lưu" id="btnChangeName" />
                                        </label>
                                    	<span class="Cancel" id="btnCancelName"> Hủy </span>
                                    </td>                                   
                            	</tr>
                                <tr></tr>
                                <tr>
                                	<td></td>
                                	<td><div id="nameError"></div><div id="nameSuccess"></div></td>
                                </tr>
                        </table>
                    </td>
                </tr>
               <tr>
                	<td width="250px;" valign="top"  ><strong>Thay đổi Mật Khẩu</strong></td>
                    <td>
                    	<table class="matkhau">
                        	  	<tr>
                                	<td><label class="tieude-set">Mật khẩu hiện tại:</label></td>
                                    <td><input class="input-set" type="password" id="textPassCu" autocomplete="off" /></td>
                                </tr>
                				<tr>
                                	<td><label class="tieude-set">Nhập mật khẩu mới:</label></td>
                                    <td><input class="input-set"  type="password" id="textPassMoi" /></td>
                                </tr>
                               	<tr>
                                	<td><label class="tieude-set">Nhập lại mật khẩu mới:</label></td>
                                    <td><input class="input-set"  type="password" id="textNhapLai" /></td>
                                </tr>
                              	<tr>
                                	<td></td>
                            		<td>
                                    	<label class="buttonPost"><input class="btnPost" type="button" value="Lưu" id="btnChangePass" /></label>
                                    	<span class="Cancel" id="btnCancelPass">Hủy</span>
                                    </td>
                            	</tr>
                                <tr></tr>
                                <tr>
                                	<td></td>
                                	<td><div id="passError"></div><div id="passSuccess"></div></td>
                                </tr
                                
                        </table>
                    </td>
                </tr>
        	</table>
        </div>
        
    </div>	
    
</div>
<!-- InstanceEndEditable -->

</body>
<!-- InstanceEnd --></html>
