$(document).ready(function(e) {
    $('.like-cmt').live('click', function(){
		var actionID = $(this).attr('id');
		var html = $(this).html();
		actionID = actionID.replace('like', '');
		$.ajax({
			url: './likeUnlike/PHP/likeComment.php',
			type: 'GET',	
			async: false,
			data: 'actionID='+actionID+'&html='+html,
			success: function(data){
				//alert(data);
				
				$('a[id$="'+actionID+'like"]').html(data);
				$('a[id$="'+actionID+'like"]').attr('class', 'like-cmt1');
				$('a[id$="'+actionID+'like"]').attr('id', '');
			}
		});
	});
	
	$('.like-tool').live('click', function(){
		var actionID = $(this).attr('id');
		var html = $(this).html();
		actionID = actionID.replace('like', '');
		
		$.ajax({
			url: './likeUnlike/PHP/likeStatus.php',
			type: 'GET',	
			async: false,
			data: 'actionID='+actionID+'&html='+html,
			success: function(data){
				//alert(data);
				
				$('a[id$="'+actionID+'like"]').html(data);
				$('a[id$="'+actionID+'like"]').attr('class', 'like-tool1');
				$('a[id$="'+actionID+'like"]').attr('id', '');
			}
		});
	});
});