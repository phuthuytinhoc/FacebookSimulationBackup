<?php
session_start();

function resizeImg($arr, $date){
	
include '../DangNhap/PHP/connect.php';
	
	//you can change the name of the file here
	
	//////////// upload image and resize
	
	$uploaddir 	= $arr['uploaddir'];
	$tempdir	= $arr['tempdir'];
	
	
	$temp_name 	= $_FILES['photo']['tmp_name'];
	
	//echo $temp_name;
	
	$img_parts 	= pathinfo($_FILES['photo']['name']);
	$new_name 	= 'IMG'.$date.'.'.$img_parts['extension'];
	
	$ext = strtolower($img_parts['extension']);
	
	$allowed_ext = array('gif','jpg','jpeg','png');
	if(!in_array($ext,$allowed_ext)){
		echo '<p class="uperror">Please upload again. Only GIF, JPG and PNG files please.</p>';
		exit;
	}
	
	
		$temp_uploadfile = $tempdir . $new_name;
		$new_uploadfile = $uploaddir . $new_name;
	
	// less than 1.3MB
		if($_FILES['photo']['size'] <   2097000 ){
					if (move_uploaded_file($temp_name, $temp_uploadfile)) {
					
					// add key value to arr
					$arr['temp_uploadfile'] = $temp_uploadfile;
					$arr['new_uploadfile'] = $new_uploadfile;
					$query = 'select albumID from album where albumID=\'ALB001'.$_SESSION['email'].'\';';
					$result = mysql_query($query, $conn);
					if(mysql_num_rows($result) != 0){
						$query = 'update image set statusIMG = 0 where albumID = \'ALB001'.$_SESSION['email'].'\'';
						mysql_query($query, $conn);
						$query = 'insert into image(imageID, albumID, statusIMG) values(\''.$new_name.'\', \'ALB001'.$_SESSION['email'].'\', 1)';
						mysql_query($query, $conn);	
					}else{
						$query = 'insert into album values(\'ALB001'.$_SESSION['email'].'\', N\'Ảnh đại diện\', \''.$_SESSION['email'].'\');';
						mysql_query($query, $conn);
						
						$query = 'insert into image(imageID, albumID, statusIMG) values(\''.$new_name.'\', \'ALB001'.$_SESSION['email'].'\', 1)';
						mysql_query($query, $conn);	
					}
					asidoImg($arr);
					
					unlink($temp_uploadfile);
					exit;
					}
		}
		else
		{
			echo '<p class="uperror">Please upload again. Maximum filesize is 1.3MB.</p>';
			exit;
		}

}


function resizeThumb($arr, $date){
	
	$arr['temp_uploadfile'] = $arr['img_src'];
	$arr['new_uploadfile'] = $arr['uploaddir'].'IMG'.$date.'thumbnail.jpg';
	
	asidoImg($arr);
	exit;
}

function asidoImg($arr){
		
	include('asido/class.asido.php');
	asido::driver('gd');
	
	$height		= $arr['height'];
	$width		= $arr['width'];
	$x			= $arr['x'];
	$y			= $arr['y'];				
		
	// process
	$i1 = asido::image($arr['temp_uploadfile'], $arr['new_uploadfile']);	
	// fit and add white frame										
	if($arr['thumb'] === true){
		Asido::Crop($i1, $x, $y, $width, $height);

	}
	else{
		Asido::Frame($i1, $width, $height, Asido::Color(255, 255, 255));			
	}

	// always convert to jpg	
	Asido::convert($i1, 'image/jpg');

	$i1->Save(ASIDO_OVERWRITE_ENABLED);
		$data = array(
		'photo'=> $arr['new_uploadfile']
	  );
		// echo $user_id;
	// delete old file
	echo $data['photo'];	

}

?>