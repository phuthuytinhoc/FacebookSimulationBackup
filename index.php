<?php
	session_start();
	if(isset($_SESSION['ten'])&&isset($_SESSION['email']))
		header('Location: userpage.php');
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Chào mừng đến với facebook</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="DangNhap/CSS/style.css"/>
        <script type="text/javascript" src="DangNhap/JS/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="DangNhap/JS/ajax_check.js"></script>
	</head>
    
    <body>
    	<div id="header">
        	<div id="logo1"><img id="logo" src="DangNhap/IMG/logo1.png"> </div>
            <div class="divLogin">
                	<table id="tableLogin" cellspacing="0">
                    	<tr>
                        	<td><label style="color:white; font-size:11px; font-family:Tahoma, Geneva, sans-serif;">Email hoặc điện thoại:</label></td>
                            <td> <label style="color:white; font-size:11px; font-family:Tahoma, Geneva, sans-serif;">Mật khẩu:</label></td>
                        </tr>
                        <tr>
                        	<td><input id="emailLogin" class="inputText" type="text"></td>
                            <td><input id="passLogin" class="inputText" type="password"></td>
                            <td>
                            	<label id="btn-dangnhap">
                            		<input id="buttonLogin" type="submit" value="Đăng nhập" class="btndangnhap"></td>
                        		</label>
                        </tr>
                        <tr>
                        	
                       	</tr>
                    
                    </table>
            </div>
        </div>
        <div id="divBody" style="background:url(DangNhap/IMG/bg.png);width:100%;height:550px; margin-top:50px;">
        	<table>
            	<tr>
                	<td  id="connect">
                    	<img src="DangNhap/IMG/connecting.png">
                    </td>
                    <td id="tdRegis"> 
                        <p><label class="dk">Đăng kí</label><p>
                        <label style="font-size:16px;">Miễn phí và sẽ luôn như vậy</label>
                        <hr>
                        <table id="tableRegis">
                            <tr>
                                <td valign="top">
                                        <form id="formRegis" action="../PHP/login.php" method="get">
                                        <table style="margin-bottom:7px">
                                            <tr>
                                                <td align="right"><label id="label_info">Tên:</label></td>
                                                <td>
                                                	<div class="khung-info">
                                                    	<input type="text" class="text_info" name="text_Ten" id="TenUser" placeholder="Nhập tên của bạn">
                                                	</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                    <label id="label_info">Họ:</label>
                                                </td>
                                                <td>
                                                	<div class="khung-info">
                                                    	<input class="text_info" type="text" name="text_Ho" id="HoUser" placeholder="Nhập họ của bạn">
                                                	</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                    <label id="label_info">Email của bạn:</label>
                                                </td>
                                                <td>
                                                	<div class="khung-info">
                                                   		<input  class="text_info" type="email" name="text_Email" id="EmailUser" placeholder="Nhập email của bạn">
                                                   	</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                    <label id="label_info">Nhập lại email:</label>
                                                </td>
                                                <td>
                                                	<div class="khung-info">
                                                    	<input class="text_info" type="text" name="text_NhapLaiEmail" id="ReEmail" placeholder="Nhập lại email của bạn">
                                                	</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                    <label id="label_info">Mật khẩu mới:</label>
                                                </td>
                                                <td>
                                                	<div class="khung-info">
                                                    	<input class="text_info" type="password" name="text_NewPassword" id="PassUser" placeholder="Nhập mật khẩu của bạn">
                                               		</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                    <label id="label_info">Tôi là:</label>
                                                </td>
                                                <td>
                                                    <select id="combobox_Sex" name="sex" class="select">
                                                        <option value="-1">Chọn giới tính: </option>
                                                        <option value="Female">Nữ</option>
                                                        <option value="Male">Nam</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                    <label id="label_info">Sinh nhật:</label>
                                                </td>
                                                <td>
                                                <div>
                                                    <select id="combobox_DOB" name="day" style="height:30px; width:70px">
                                                           <option value="-1">Ngày:</option>
                                                           <?php
                                                           for($i=1; $i<=31; $i++)
                                                           {
                                                            echo"<option value='".$i."'>".$i."</option>";
                                                           }
                                                           ?>                                                                             
                                                    </select>
                                               
                                                    <select id="combobox_MOB" name="month" style="height:30px; width:87px">
                                                            <option value="-1">Tháng:</option>
                                                            <?php
                                                            for($m=1; $m<=12; $m++)
                                                            {
                                                             echo"<option value='".$m."'>tháng ".$m."</option>";
                                                            }
                                                            ?>                                                                                
                                                    </select>
                                                
                                                    <select id="combobox_YOB" name="year" style="height:30px; width:68px">
                                                            <option value="-1">Năm:</option>
                                                            <?php
                                                            for($y=2012; $y>=1905; $y--)
                                                            {
                                                             echo"<option value='".$y."'>".$y."</option>";
                                                            }
                                                            ?>
                                                    </select>
                                                    </div>
                                                </td>
                                            </tr>
                                                <td style="height:16px; width:109px"></td>
                                                <td>
                                                    <a href="" title="Nhấp chuột để biết thêm thông tin" rel="dialog" class="tag-a">
                                                        Tại sao tôi cần cung cấp ngày sinh của mình?
                                                    </a>
                                                    </td>
                                            <tr>
                                                <td style="height:66px; width:109px"></td>
                                                <td>
                                                    <p class="label_fbRules">
                                                        Bằng cách nhấn vào Đăng Ký, bạn đồng ý với 
                                                        <a href="" rel="nofollow" class="tag-a" style=" color:#3B5998;">Điều Khoản Sử Dụng</a>  và bạn đã đọc và hiểu 
                                                        <br><a href="" rel="nofollow" class="tag-a" style="color:#3B5998;" > Chính Sách Sử Dụng Dữ Liệu</a> của chúng tôi.
                                                    </p>
                                                </td>
                                            </tr>                                           
                                        </table>
                                        <div style="margin-left:115px">
                                            <label class="label_buttonDangKy" id="btndangky">
                                                <input type ="hidden" name="buttonAction" value="Register">
                                                <input type="button" id="button_Regis" class="button_DangKy" value="Đăng Ký"  name="dangky" >
                                            </label>
                                        
                                         
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td><div id="divError">
                                                                                                            
                                        </div>
                                </td>
                           </tr>
                            
                        </table>
                    </td>
                </tr>
                
            </table>
        </div>
    </body>
</html>