<?php
session_start();

include('func.php');
$date = $_POST['time'];
if($_GET['act'] == 'thumb'){

	$arr = array(
	'uploaddir' 	=> '../IMAGE/',
	'tempdir'		=> 'uploads/temp/',
	'height'		=> $_POST['height'],
	'width'			=> $_POST['width'],
	'x'				=> $_POST['x'],
	'y'				=> $_POST['y'],
	'img_src'		=> $_POST['img_src'],
	'thumb'			=> true
	);
	resizeThumb($arr, $date);
	exit;
}

elseif($_GET['act'] == 'upload'){
	
	$big_arr = array(
	'uploaddir'	=> '../IMAGE/',
	'tempdir'	=> 'uploads/temp/',
	'height'	=> $_POST['height'],
	'width'		=> $_POST['width'],
	'x'			=> 0,
	'y'			=> 0
	);
	
	resizeImg($big_arr, $date);	
}
else
{
	//
}
?>