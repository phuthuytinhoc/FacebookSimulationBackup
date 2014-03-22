<?php
	session_start();
	
	if(!isset($_SESSION['admin'])){
		@header('Location: admin-login.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin-Page</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link charset="utf-8" type="text/css" href="../CSS/style-admin.css" rel="stylesheet">
    <script type="text/javascript" src="../JS/jquery.js"></script>
    <script type="text/ecmascript" src="../JS/ajax.js"></script>
</head>

<body>

    <div id="login-status" style="float: right; margin-top: -20px;">
        <div style="width: 60px;">
            <img src="../IMG/User-icon.png" style="height: 50px; width: 50px; float: left;" />
        </div>
        <div style="width: 100%;">
            <span class="name-admin">Hello, <strong>Admin</strong></span>
            <span ><button id="btnLogOut" class="btn-logout" >Logout</button></span>
        </div>
    </div>

    <h2>Menu for Admin. Last login is: 14:50 May 3 2013</h2>



    <div id='cssmenu'>
        <ul>
            <li class='active'><a href='#'><span>Home</span></a></li>
            <li class='has-sub'><a href='#'><span>Control User</span></a>
                <ul>
                    <li><a href='#'><span>Add User</span></a></li>
                    <li><a href='#'><span>Edit Infomation</span></a></li>
                    <li><a href='#'><span>Delete User</span></a></li>
                    <li><a href='#'><span>Deactive User</span></a></li>
                </ul>
            </li>
            <li class='has-sub'><a href='#'><span>Control Image</span></a>
            </li>
            <li class='has-sub'><a href='#'><span>Report</span></a>
                <ul>
                    <li><a href='#'><span>List User</span></a></li>
                    <li><a href='#'><span>List Account</span></a></li>
                    <li><a href='#'><span>List Action</span></a></li>
                </ul>
            </li>
            <li class='has-sub'><a href='#'><span>Control Admin Account</span></a>
                <ul>
                    <li><a href="#"><span>Add Account</span></a></li>
                    <li><a href="#"><span>Edit Infomation</span></a></li>
                    <li><a href="#"><span>Delete Account</span></a></li>
                </ul>
            </li>
        </ul>
    </div>

    <style type="text/css">
        table.hovertable {
            font-family: verdana,arial,sans-serif;
            font-size:11px;
            color:#333333;
            border-width: 1px;
            border-color: #999999;
            border-collapse: collapse;
        }
        table.hovertable th {
            background-color:#c3dde0;
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #a9c6c9;
        }
        table.hovertable tr {
            background-color:#d4e3e5;
            overflow: hidden;
            width: 194px;
        }
        table.hovertable td {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #a9c6c9;
            word-wrap: break-word;
        }

        .hovertable tr td :hover{
            background-color: #FFFF66;
        }




        .action-button img{
            height: 15px;
            width: 15px;

        }

    </style>



    <div id="main-admin-work">
        <table class="hovertable">
            <tr onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#d4e3e5';">
                <th>Email</th>
                <th>Password</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Sex</th>
                <th>Birthday</th>
                <th>Address</th>
                <th>City</th>
                <th>Home Town</th>
                <th>Job</th>
                <th>School</th>
                <th>About Me</th>
                <th>Relationship</th>
                <th>Quote</th>
                <th>Phone Number</th>
                <th>Add</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
            <tr onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#d4e3e5';" >
                <td>phuthuytinhoc@yahoo.com</td>
                <td>123456</td>
                <td>Hung Nguyen</td>
                <td>Phuc</td>
                <td>Female</td>
                <td>25-08-1991</td>
                <td>Ho Chi Minh</td>
                <td>Ho Chi Minh</td>
                <td>Viet nam</td>
                <td>Student</td>
                <td>UIT vai dai</td>
                <td>Nothing on you</td>
                <td>F cmn A</td>
                <td>ha ha ha ha</td>
                <td>1234567890</td>
                <td align="center">
                    <a class="action-button" href="#">
                        <img src="../IMG/Add-icon.png">
                    </a>
                </td>
                <td align="center">
                    <a class="action-button" href="#">
                        <img src="../IMG/Delete-icon.png">
                    </a>
                </td>
                <td align="center">
                    <a class="action-button" href="#">
                        <img src="../IMG/Edit-icon.png">
                    </a>
                </td>
            </tr>

        </table>

    </div>

</body>
</html>

