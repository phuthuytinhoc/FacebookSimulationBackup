<?php
	function calculateTime($time){
		
		mysql_query("set names 'utf8'");
		
		@$date = date(',  d.m.Y', $time);
		$date = str_replace(', ', '', $date);
		$temp = substr($date, 0, 3);
		$temp = $temp.' tháng '.substr($date, 4, 2);
		$temp = $temp.' '.substr($date, 7, 4);
		$date = $temp;
		
		@$day = date('D', $time);
		/*switch(1){
			case ($day == 'Mon'):
				$day = 'Thứ hai';
				break;
				
			case ($day == 'Tue'):
				$day = 'Thứ ba';
				break;
				
			case ($day == 'Wed'):
				$day = 'Thứ tư';
				break;
				
			case ($day == 'Thu'):
				$day = 'Thứ năm';
				break;
				
			case ($day == 'Fri'):
				$day = 'Thứ sáu';
				break;
				
			case ($day == 'Sat'):
				$day = 'Thứ bảy';
				break;
				
			case ($day == 'Sun'):
				$day = 'Chủ nhật';
				break;					
		}*/
		$day = '';
		$currentTime = time();
		
		$offset = $currentTime - $time; // Tìm hiệu số thời gian, đơn vị tính là giây
		
		switch(1){
			case($offset < 60): // Nếu thời gian nhỏ hơn 60 giây <=> 1 phút
				if($offset == 0){
					return 'vừa xong';	
				}else if($offset > 0 && $offset < 6){
					return 'vài giây trước';	
				}else{
					$display = ' giây trước';
					return $offset.$display;
				}
				break;
				
			case ($offset >= 60 && $offset < 3600): // Nếu thời gian từ 1 phút đến 59 phút
				$count = floor($offset/60);
				return 'khoảng '.$count.' phút trước';
				break;
				
			case($offset >= 3600 && $offset < 86400 ): // Nếu thời gian từ 1 tiếng đến 24 tiếng
				$count = floor($offset/3600);
				return 'khoảng '.$count.' giờ trước';
				break;
				
			case($offset >= 86400 && $offset < 172800): // trong khoảng thời gian 2 ngày
				return 'Hôm qua, lúc '.@date('H:i', $time);
				break;
				
			case($offset >= 172800): // Nếu khoảng thời gian lớn hơn 2 ngày
				return $day.$date;
				break;
		}
		
	}
?>