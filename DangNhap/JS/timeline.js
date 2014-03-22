$(document).ready(function(){
  
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

	$('.timeline_container').mousemove(function(e)
	{
		var topdiv=$("#containertop").height();
		var pag= e.pageY - topdiv-506;
		$('.plus').css({"top":pag +"px", "background":"url('DangNhap/IMG/plus.png')","margin-left":"1px"});}).
		mouseout(function()
		{
			$('.plus').css({"background":"url('')"});
		});

	
	// ga binh - PHAN DIEN THONG TIN DU POP UPDATE, CO STATUS -> bien x, con image thi them vao thoi
	$("#update_button").live('click',function()
	{
		var x = $("#txtUpdateStatus").val();
		
		$.ajax({
			url: './postStatus/PHP/postStatus.php',
			type: 'GET',
			async: false,
			data: 'status='+x,
			success: function(data){
				$('#container').masonry( 'remove', $('#dinhchuan').parent());
				
				$("#container").prepend('<div class="item-timeline" style="height:170px;"><div id="dinhchuan" style="padding:5px 5px 5px 5px; position:absolute; top:0px;"><ul><li>' +
                    '<a href="javascript:showthis(\'khung-1\')"><div class="li-status"><i class="ico-status"></i>Trạng Thái</div></a></li><li><a href="javascript:showthis(\'khung-2\')">' +
                    '<div class="li-status"><i class="ico-picture"></i>Hình Ảnh</div></a></li></ul>' +
                    '<div id="khung-1" class="allinone" style="display:block;"><div class="arrow-status"></div><textarea id="txtStatus" placeholder="Bạn nghĩ gì..." class="textarea-status"></textarea>' +
                    '<div class="btnDangHet">' +
                        '<a class="locate-user" title="Vị trí của bạn"></a>'+
                        '<label id="lblPostStatus" class="buttonPost">' +
                            '<input type="button" value="Đăng" class="btnPost1" />' +
                        '</label></div></div><div id="khung-2" class="allinone">' +
                    '<div class="arrow-status" style="margin-left:130px;"></div><div class="cont-khung"><div class="khung-upanh" style="margin-left:10px;">' +
                    '<span><a href="javascript:showthis(\'start-up\')">Tải Ảnh</a></span></div><div class="khung-upanh"><span><a>Tạo Album</a></span></div></div>' +
                    '<div class="btnDangHet">' +
                        '<a class="locate-user" title="Vị trí của bạn"></a>'+
                        '<label class="buttonPost">' +
                            '<input type="button" value="Đăng"  class="btnPost"/>' +
                        '</label></div></div><div id="start-up" class="allinone">' +
                    '<form id="frmUploadImage" action="postStatus/PHP/postImage.php" method="post"><textarea id="txtImageContent" name="txtImageContent" placeholder="bình luận điều gì đó về bức ảnh này..." style="height:70px; width:385px;"></textarea>' +
                    '<input type="file" style="display:block;" multiple="multiple" name="photoimg" id="photoimg"/><div id="divPreview"></div></form></div></div></div>'+data);
				
				//$('#divContent').html(data);
				
				$('#container').masonry( 'reload' );

				$('.rightCorner').hide();
				$('.leftCorner').hide();
				Arrow_Points();
				
				$("#txtUpdateStatus").val('');
				$("#popup-timeline").hide();
				
   	 			return false;
			}
		});
	});
	
	

	// Divs
	$('#container').masonry({itemSelector : '.item-timeline',});
	Arrow_Points();

	//Mouseup textarea false
	$("#popup-timeline").mouseup(function() 
	{
		return false
	});

	$(".timeline_container").click(function(e)
	{
		var topdiv=$("#containertop").height();
		$("#popup-timeline").css({'top':(e.pageY-topdiv-523)+'px'});
		$("#popup-timeline").fadeIn();
		$("#update").focus();


	});  


	$(".deletebox").live('click',function()
	{
		if(confirm("Bạn có muốn xóa tin này ?"))
		{
			var actionID = $(this).attr('id');
			
			$.ajax({
				url: '././postStatus/PHP/deleteStatus.php',
				type: 'GET',
				async: false,
				data: 'actionID='+actionID
			});
			
			$(this).parent().fadeOut('slow');  
		//Remove item
			$('#container').masonry( 'remove', $(this).parent() );
		//Reload masonry
			$('#container').masonry( 'reload' );
			$('.rightCorner').hide();
			$('.leftCorner').hide();
			Arrow_Points();
		}
		return false;
	});



	//Textarea without editing.
	$(document).mouseup(function()
	{
		$('#popup-timeline').hide();

	});
	

	});


	