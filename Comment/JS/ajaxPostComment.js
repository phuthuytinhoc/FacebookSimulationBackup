$(document).ready(function(e) {
	function Arrow_Points()
	{ 
		var s = $('#container').find('.item-timeline');
		$.each(s,function(i,obj){
		var posLeft = $(obj).css("left");
		$(obj).addClass('borderclass');
		if(posLeft == "0px")
			{
				html = "<span class='rightCorner'></span>";
				$(obj).prepend(html);			
			}
		else
		{
			html = "<span class='leftCorner'></span>";
			$(obj).prepend(html);
		}
	});
	}
	
    $('.btnPost').live('click',function(){
        var comment = $(this).parent().parent().parent().parent().prev().children().next().children().children().children().children().children().val();
		var div = $(this).attr('id').replace('b', 'a');
		var actionID = div.replace('a', '');
		
		$.ajax({
			url: './Comment/PHP/postComment.php',
			type: 'GET',
			async: false,
			data: 'comment='+comment+'&actionID='+actionID,
			success: function(data){
				$('div[id$="'+div+'"]').html(data);
				
				
				$('#container').masonry( 'reload' );

				$('.rightCorner').hide();
				$('.leftCorner').hide();
				Arrow_Points();
				
				return false;
			}
		});
    });
});