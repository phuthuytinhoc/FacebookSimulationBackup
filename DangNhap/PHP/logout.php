<?php
	
	//1. Tim SESSION
	session_start();
	
	//2. Huy bo cac bien cua SESSION
	$_SESSION = array();
	
	//3. Huy COOKIE
	if(isset($_COOKIE[session_name()])){
		@setcookie(session_name(), time()-36000, '/', 0, 0);	
	}
	
	//4. Huy toan bo SESSION
	session_destroy();
	
	//5. Chuyen ve trang index
	@header('Location: ../../index.php');


?>