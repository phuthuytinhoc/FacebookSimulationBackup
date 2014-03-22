<?php 
	session_start();
	if (isset($_SESSION['admin'])){
		header('Location: admin-page.php');
	}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin-Login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link charset="utf-8" type="text/css" href="../CSS/style-admin.css" rel="stylesheet">
    <script type="text/javascript" src="../JS/jquery.js"></script>
    <script type="text/javascript" src="../JS/ajax.js"></script>
</head>
<body id="bg-main-login">

    <div id="main-adminlogin">
        <div id="content-login">
            <p id="logo-login"></p>
            <p class="text-login">Đăng nhập vào trang admin</p>
            <input type="text" id="txtUser" class="textNameAd" placeholder="Username" name="textUsernameAd"/>
            <input type="password" id="txtPass" class="textNameAd" placeholder="Password" name="textPasswordAd"/>
            <input type="button" id="btnLogin" class="btnLoginAd" value="Đăng Nhập" name="btnLogin"/>

            <div id="warning-login">
                <div class="message error">
                    <h3>Lỗi xảy ra</h3>
                    <p>Tài khoản hoặc mật khẩu chưa chính xác</p>
                </div>
            </div>
        </div>

    </div>

</body>
</html>