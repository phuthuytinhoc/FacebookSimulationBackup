

$(document).ready(function(e) {
	$('.buttonBanBe').live('click', function(){
		var value = $(this).attr('id');		
		$('div' + value).show(600);
	});
	
	$('.Cancel').live('click', function(){
		var value = $(this).children().attr('class');		
		$('div#' + value).hide(600);
	});
	
	 $('.btnPost').live('click', function(){
		var value = $(this).attr('name');		
		
		$.ajax({
			url : './ShowFriends/PHP/deleteFriend.php',
			type: 'GET',
			async: false,
			data : 'email='+ value,
			success: function(data){
				$('.content-friend').html(data);
			}
		});
		
		
	});
	
});