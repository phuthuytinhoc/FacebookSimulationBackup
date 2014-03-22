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
<link href="DangNhap/CSS/updateinfo.css" type="text/css" rel="stylesheet" />
<link href="ShowComments/CSS/showcomments.css" type="text/css" rel="stylesheet" />
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
             		<li id="KetBan" ></li>
             	</a>
                         
             	<a href="javascript:showonlyone('divtn');" id="show-msg">
             		<li id="TinNhan" ></li>
             	</a>
                        
             	<a href="javascript:showonlyone('divtb');" id="show-thongbao">	
             		<li id="TinMoi" ></li> 
             	</a>                       		                                              
             </ul>
          
    
             <!-- ket ban -->
             <div class="popup" id="divkb">             	
             	<a class="btnclose" href="javascript: dongbanbe();">Đóng</a>
                <div class="popup-content">
                	Nội Dung Yêu Cầu Kết Bạn
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
                        <input type="text" name="txtTim" class="KhungTimKiem" onkeyup="" title="Tìm Kiếm Bạn Bè" placeholder="Tìm Kiếm" autocomplete="off" />  
                    </div>
                    <div id="iconsearch">
                        <button id="btnSearch" type="submit" />
                    </div>  
                </div>              
            </form>
        </div>
        <!-- ket thuc div tim kiem -->
        
        <!-- bat dau div 3 chuc nang: trang chu, trang ca nhan, tim kiem -->
        <div id="rightcontent">
        	<ul>
            	<li>
                	<a href="userpage.php?user=<?php echo $_SESSION['email']; ?>">
                    	<img class="avatar-canhan" src="<?php 
							$query = 'select * from album where albumID = \'ALB001'.$_SESSION['email'].'\';';
							@$result = mysql_query($query, $conn);
							if(@mysql_num_rows($result) == 0){
								echo 'IMAGE/avatar.jpg';	
							}else{
								$query1 = 'select imageID from image where albumID = \'ALB001'.$_SESSION['email'].'\' and statusIMG = 1';
								@$result1 = mysql_query($query1, $conn);
								if(mysql_num_rows($result1) != 0){
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
                   		<a>
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
	<div class="main-col rad-box">
    	<div class="head-show">
        	<table>
            	<tr>
                	<td><img src="ShowComments/IMG/avatar.jpg" height="50px" width="50px" /></td>
                    <td>
                        <table>
                            <tr><td><a class="user-show" href="#">Tên User đã đăng stats</a></td></tr>
                            <tr><td><span class="time-show">15 phút trước</span></td></tr>
                         </table>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="main-show">
        	<span style="display:block; font-size:13px; margin-bottom:5px;">Duới đây là nội dung</span>
        	<img src="IMAGE/avatar.jpg" style="max-width:605px; margin-bottom:15px;"/>
        
        </div>
        
        <div class="like-show">
        	<span><a class="like-tool">Thích</a></span>
            <span><a class="like-tool">Bình Luận</a></span>
        </div>
        
        <div class="like-show">
        	<span><i class=" icon-like"></i><a class="likers">92 người</a> thích điều này</span>           
        </div>
    
    	<div class="like-show">
           <table> 
                <tr>
                    <td valign="top"><img src="DangNhap/IMG/ava-prof.jpg" style=" height:32px; width:32px; float:left;" /></td>
                    <td valign="top">
                        <table>
                            <tr><td><a class="link-user">Username</a> <label class="msg-user">Nội dung comment đã sửa</label></td></tr>
                            <tr>
                                <td><label class="time-cmt">ngày 22 tháng 11 năm 2012</label><a class="like-cmt">Thích</a></td>
                            </tr>
                        </table>
                    </td>                    
                </tr>    	              	
            </table>    
        </div>

    	<div class="like-show">
           <table> 
                <tr>
                    <td valign="top"><img src="DangNhap/IMG/ava-prof.jpg" style=" height:32px; width:32px; float:left;" /></td>
                    <td valign="top">
                        <table>
                            <tr><td><a class="link-user">Username</a> <label class="msg-user">Nội dung comment đã sửa</label></td></tr>
                            <tr>
                                <td><label class="time-cmt">Thứ sáu ngày 22 tháng 11 năm 2012</label><a class="like-cmt">Thích</a></td>
                            </tr>
                        </table>
                    </td>                    
                </tr>    	              	
            </table>    
        </div>
        <div class="like-show">
           <table> 
                <tr>
                    <td valign="top"><img src="DangNhap/IMG/ava-prof.jpg" style=" height:32px; width:32px; float:left;" /></td>
                    <td valign="top">
                        <table>
                            <tr><td><a class="link-user">Username</a> <label class="msg-user">Nội dung comment đã sửa</label></td></tr>
                            <tr>
                                <td><label class="time-cmt">Thứ sáu ngày 22 tháng 11 năm 2012</label><a class="like-cmt">Thích</a></td>
                            </tr>
                        </table>
                    </td>                    
                </tr>    	              	
            </table>    
        </div>       
        <div class="like-show">
           <table> 
                <tr>
                    <td valign="top"><img src="DangNhap/IMG/ava-prof.jpg" style=" height:32px; width:32px; float:left;" /></td>
                    <td valign="top">
                       <input type="text" name="textBinhLuan" placeholder="Viết bình luận..." class="cmt-show" />
                    </td>                    
                </tr>    	              	
            </table>    
        </div> 
        
    </div>	
    
</div>
<!-- InstanceEndEditable -->

</body>
<!-- InstanceEnd --></html>
