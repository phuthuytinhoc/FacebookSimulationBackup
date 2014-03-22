$(document).ready(function(e) {
    $('#txtSearch').live('keyup', function(){
		var text = $('#txtSearch').val();
		if(text == ''){
			$('#ajax-search').fadeOut('fast');
		}else{
			$('#ajax-search').fadeIn('fast');
			$.ajax({
				url: './../searchEverything/PHP/searchFriend2.php',
				type: 'GET',
				async: false,
				data: 'text='+text,
				success: function(data){
					$('#ajax-search').html(data);
				}
			});
		}
	});
});