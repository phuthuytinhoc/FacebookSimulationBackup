<?php
session_start();
function uploadImageFile() { // Note: GD library is required for this function

	//Kết nối CSDL
include '../../DangNhap/PHP/connect.php';
	

	$time = $_POST['time'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $iWidth = 850;
		$iHeight = 315; // desired image result dimensions
        $iJpgQuality = 100;

        if ($_FILES) {

            // if no errors and size less than 250kb
            if (! $_FILES['image_file']['error'] && $_FILES['image_file']['size'] < 5 * 250 * 1024) {
                if (is_uploaded_file($_FILES['image_file']['tmp_name'])) {

                    // new unique filename
                    $sTempFileName = '../../IMAGE/IMG' .$time;

                    // move uploaded file into cache folder
                    move_uploaded_file($_FILES['image_file']['tmp_name'], $sTempFileName);

                    // change file permission to 644
                    @chmod($sTempFileName, 0644);

                    if (file_exists($sTempFileName) && filesize($sTempFileName) > 0) {
                        $aSize = getimagesize($sTempFileName); // try to obtain image info
                        if (!$aSize) {
                            @unlink($sTempFileName);
                            return;
                        }

                        // check for image type
                        switch($aSize[2]) {
                            case IMAGETYPE_JPEG:
                                $sExt = '.jpg';

                                // create a new image from file
                                $vImg = @imagecreatefromjpeg($sTempFileName);
                                break;
                            case IMAGETYPE_PNG:
                                $sExt = '.png';

                                // create a new image from file
                                $vImg = @imagecreatefrompng($sTempFileName);
                                break;
                            default:
                                @unlink($sTempFileName);
                                return;
                        }

                        // create a new true color image
                        $vDstImg = @imagecreatetruecolor( $iWidth, $iHeight );

                        // copy and resize part of an image with resampling
                        imagecopyresampled($vDstImg, $vImg, 0, 0, (int)$_POST['x1'], (int)$_POST['y1'], $iWidth, $iHeight, (int)$_POST['w'], (int)$_POST['h']);

                        // define a result image filename
                        $sResultFileName = $sTempFileName . $sExt;

                        // output image to file
                        imagejpeg($vDstImg, $sResultFileName, $iJpgQuality);
                        @unlink($sTempFileName);
						
						$query = 'select albumID from album where albumID=\'ALB002'.$_SESSION['email'].'\';';
						$result = mysql_query($query, $conn);
						if(mysql_num_rows($result) == 0){
							$query = 'insert into album values(\'ALB002'.$_SESSION['email'].'\', N\'Ảnh bìa\', \''.$_SESSION['email'].'\');';
							mysql_query($query, $conn);
							
							$str = str_replace('../../IMAGE/I', 'I', $sResultFileName);
							
							$query = 'insert into image(imageID, albumID, statusIMG) values(\''.$str.'\', \'ALB002'.$_SESSION['email'].'\', 2)';
							mysql_query($query, $conn);
						}else{
								$str = str_replace('../../IMAGE/I', 'I', $sResultFileName);
								
								$query = 'update image set statusIMG = 0 where albumID = \'ALB002'.$_SESSION['email'].'\'';
								mysql_query($query, $conn);
								$query = 'insert into image(imageID, albumID, statusIMG) values(\''.$str.'\', \'ALB002'.$_SESSION['email'].'\', 2)';
								mysql_query($query, $conn);
						}
						
                        return $sResultFileName;
                    }
                }
            }
        }
    }
}

$sImage = uploadImageFile();
echo '<br><h2> Ảnh bìa hiển thị của bạn </h2>';
echo '<img src="uploadCover/'.$sImage.'" />';


?>