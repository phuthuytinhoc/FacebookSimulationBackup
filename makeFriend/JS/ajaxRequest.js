$(document).ready(function(e) {
    $('.btnSendRequest').live('click', function(){
		$.ajax({
			url: './makeFriend/PHP/sendRequest.php',
			type: 'GET',
			async: false,
			success: function(data){
				if(data == true){
					$('.btnSendRequest').fadeOut('fast');
					$('.btnDeleteRequest').fadeIn('fast');	
				}
			}
		});
	});
	
	$('.btnDeleteRequest').live('click', function(){

		$.ajax({
			url: './makeFriend/PHP/deleteRequest.php',
			type: 'GET',
			async: false,
			success: function(data){
				if(data == true){					
					$('.btnDeleteRequest').fadeOut('fast');
					$('#send1').fadeIn('fast');	
				}
			}
		});
	});
	
	$('.btnUnFriend').live('click', function(){
		$.ajax({
			url: './makeFriend/PHP/deleteRequest.php',
			type: 'GET',
			async: false,
			success: function(data){
				if(data == true){					
					$('.btnUnFriend').fadeOut('fast');
					$('#send1').fadeIn('fast');	
				}
			}
		});
	});
	
	$('.btnResponeRequest').live('click', function(){
		$.ajax({
			url: './makeFriend/PHP/acceptRequest2.php',
			async: false,
			success: function(data){
				
				$('.btnResponeRequest').fadeOut('fast');				
				$('#un1').fadeIn('fast');
				
				$('#show-friend').html(data);
				
			}
		});
	});
	
	$('#show-friend').live('click', function(){
		$('#show-friend').html('<li id="KetBan" ></li>');
		$.ajax({
			url: './makeFriend/PHP/readRequest.php',	
		});
	});
	
	$('.NhanLoi').live('click', function(){
		var fromUser = $(this).attr('id');
		var div = fromUser+'a';
		$.ajax({
			url : './makeFriend/PHP/acceptRequest.php',
			type: 'GET',
			async: false,
			data: 'fromUser='+fromUser,
			success: function(data){
				$('div[id$="'+div+'"]').html(data);	
			}
		});
	});
	
	$('.DoiTra').live('click', function(){
		var fromUser = $('.NhanLoi').attr('id');
		var div = fromUser+'a';
		$.ajax({
			url : './makeFriend/PHP/refuseRequest.php',
			type: 'GET',
			async: false,
			data: 'fromUser='+fromUser,
			success: function(data){
				$('div[id$="'+div+'"]').html(data);	
			}
		});
	});
});