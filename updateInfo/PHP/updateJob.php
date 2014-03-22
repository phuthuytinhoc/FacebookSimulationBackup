<?php
	session_start();
	
	// connect database
	include 'connect.php';

	// handler process
	$job = $_GET['job'];
	$query = 'update profile set job=N\''.$job.'\' where email=\''.$_SESSION['user'].'\';';
	mysql_query($query, $conn);
	
	$school = $_GET['school'];
	$query = 'update profile set school=N\''.$school.'\' where email=\''.$_SESSION['user'].'\';';
	mysql_query($query, $conn);
	
	// In ra nghe nghiep
	$query = 'select job from profile where email="'.$_SESSION['user'].'";';
	@$result = mysql_query($query, $conn);
	if(@mysql_num_rows($result) == 0){
		echo '<span class="khung job"><img src="DangNhap/IMG/job.png" /></span>';
		echo '<span class="tieude"><a href="javascript:showone(\'show-job\')">Thêm Nghề Nghiệp</a></span>';
	}elseif(@mysql_num_rows($result) != 0){
		while($rows = @mysql_fetch_row($result)){
			$job = $rows[0];	
		}
		echo '<span class="khung job"><img src="DangNhap/IMG/job.png" /></span>';
		if($job != ''){
			echo '<span class="tieude"><a>Nghề nghiệp :</a> '.$job.'</span>';
		}else{
			echo '<span class="tieude"><a href="javascript:showone(\'show-job\')">Thêm Nghề Nghiệp</a></span>';
		}
	}
	
	// in ra truong hoc
	$query = 'select school from profile where email="'.$_SESSION['email'].'";';
	$result = @mysql_query($query, $conn);
	if(@mysql_num_rows($result) == 0){
		echo '<span class="khung edu"><img src="DangNhap/IMG/education.png" /></span>';
		echo '<span class="tieude"><a href="javascript:showone(\'show-job\')">Thêm Trường Học</a></span>';
	}elseif(@mysql_num_rows($result) != 0){
		while($rows = @mysql_fetch_row($result)){
			$school = $rows[0];	
		}
		echo '<span class="khung edu"><img src="DangNhap/IMG/education.png" /></span>';
		if($school != ''){
			echo '<span class="tieude"><a>Trường : </a>'.$school.'</span>';
		}else{
			echo '<span class="tieude"><a href="javascript:showone(\'show-job\')">Thêm Trường Học</a></span>';
		}
	}
?>