<?php
	session_start();
	if(isset($_SESSION['ten'])&&isset($_SESSION['email']))
		header('Location: userpage.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Đăng nhập | Facebook</title>
        <link rel="stylesheet" type="text/css" href="DangNhap/CSS/login.css"/>
        <script type="text/javascript" src="DangNhap/JS/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="DangNhap/JS/ajax_check.js"></script>
    </head>
    <body>
        <div id="pagelet_bluebar" data-referrer="pagelet_bluebar">
            <div id="blueBarHolder" class="loggedOut">
                <div id="blueBar">
                    <div class="logOut">
                    	<div class="clearfix">
                        	<a class="lfloat" href="" title="Vào Trang Chủ Facebook">
                            	<img class="logo_img" src="DangNhap/IMG/logo1.png" alt="Logo Facebook" width="170" height="36">
                            </a>
                        </div>
                    	
                    </div>
                    <div class="SignUp">
                    	<div class="SUBar">
                        	<label id="btn-reg">
                            	<input id="btnDangKy" type="submit" value="Đăng Ký" name="btnDangKy" class="btnDangKy" />
                            </label>
                            <span class="content">Facebook giúp bạn kết nối và chia sẻ với mọi người.</span>
                        </div>
                    </div>
                </div>
            </div>
		</div>
        <div id="content" class="contentfix">
        <div class="bottom">
        	<div class="loginbox">
            	<div class="head">
                	<div class="uiHead"></div>
                    <div style="margin-top:-10px;">
                		<h2 tabindex="0" class="headtitle">Đăng nhập facebook</h2>
                    </div>
                </div>
                <div class="form">
                	<div class="logincontainer">
                    	<div class="loginform">
                        	<input type="hidden" name="lsd" value="AVobCl3w" autocomplete="off">
                            <div id="ThongBao" class="uiLoi">
                            	<h2 class="message">Hãy đăng nhập, và kết nối cùng chúng tôi</h2>                              
                            </div>
                            <div class="login">
                        	<table cellpadding="0px" cellspacing="0px" align="center" width="380px">
                            	<tr height="30px">
                                    <td width="100px" height="20px" class="tdEmailPass" align="left" valign="middle">Email:</td>
                                    <td align="left">
                                        <input id="emailDangNhap" type="text" name="text_Email" width="183px" height="22px" align="left" class="textEmailPass" value="" />
                                    </td>
                                </tr>
                                <tr height="30px">
                                	<td width="100px" height="20px" class ="tdEmailPass" >Mật Khẩu:</td>
                                    <td align="left">
                                        <input id="passDangNhap" type="password" name="text_Password" width="183px" height="22px" align="left" class="textEmailPass" />
                                </tr>
                                <tr height="20px">
                                	<td></td>
                                    <td align="left" valign="middle">
                                    	<input type="checkbox" style=" padding-left:3px; padding-right:3px;" />
                                        <font style=" padding-left:3px; padding-right:3px;font-size:11px;" >Duy trì đăng nhập</font>
                                    </td>
                                </tr>
                                <tr height="41px">
                                	<td></td>
                                    <td align="left" valign="middle">                                      
                                    	<label id="sub-login">
                                        	<input id="btnDangNhap" type="button" value="Đăng Nhập" class="SUButtonLogin"/>
                                        </label>
                                        <div id="btnlink">
                                        hoặc 
                                        <strong>
                                        <a href="#"
                                        target="_blank" rel="nofollow" id="linkfb" tabindex="-1">Đăng ký Facebook</a>
                                        </strong>
                                        </div>
                                    </td>
                                 </tr>
                                 
                                 <tr>
                                 	<td></td>
                                    <td>
                                    <a href="" target="" id="quenmk">Quên mật khẩu?</a>
                                    </td>
                                 </tr>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>

