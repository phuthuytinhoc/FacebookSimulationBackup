$(document).ready(function(e) {
	// BẮT ĐẦU ĐỊNH VỊ
	
	var lat = 0;
	var long = 0;
	var locate = 'Ho Chi Minh City';
	var geocoder;
	var city = 'Ho Chi Minh City';
    $('.showmap-locate').hide();

    $('.locate-user').live({ click: function(){
       	if(navigator.geolocation){ // xác định xem trình duyệt hỗ trợ định vị hay ko? nếu có thì lấy tọa độ
		navigator.geolocation.getCurrentPosition(function(position){
				lat  = position.coords.latitude;
				long =  position.coords.longitude;
				getCity(lat, long);
				showmap(lat, long);
				$('.showmap-locate').show(200);
			});
		}else{
			alert('Trinh duyet ko ho tro dinh vi');
		}     
        }
    });
	
	/***********************************/
	/*** HÀM LẤY THÀNH PHỐ HIỆN TẠI ****/
	/***********************************/
	
	function getCity(lat, long){		
		geocoder = new google.maps.Geocoder();
		var toado = new google.maps.LatLng(lat, long);
		if(geocoder){
			geocoder.geocode({'latLng':toado}, function(results, status){
				if(status ==  google.maps.GeocoderStatus.OK){
					if(results[1]){					
						city = (results[1].formatted_address);
						alert (city);
					}
				}
			});
		}
	}

	
	/*******************************************/
	/*** KẾT THÚC HÀM LẤY THÀNH PHỐ HIỆN TẠI ***/
	/*******************************************/
	
	// Hàm showmap
	function showmap(lat, long){
		// Lấy Vĩ độ và kinh độ từ định vị
		var LatLong = new google.maps.LatLng(lat, long);
		// các thuộc tính lựa chọn khi load map
		var mapOption = {
			zoom:12,
			center: LatLong,
			mapTypeId: google.maps.MapTypeId.ROADMAP,	
		}
		// Chọn vị trí xuất hiện của map
		var map = new google.maps.Map(document.getElementById('map'), mapOption);
		// Tạo 1 đối tượng map
		var marker = new google.maps.Marker({
			position:LatLong, // vị trí canh giữa bản đồ
			map: map, // sử dụng bản đồ nào?
			title: 'Found you!',
		});
		// tạo 1 ghi chú
		var infowindow1 = new google.maps.InfoWindow({
			content: locate, // Nội dung ghi chú
			maxWidth: 200, // chiều rộng tối đa của ghi chú
		});
		// bật ghi chú tại điểm xuất hiện (position) với bản đồ là map, layout là marker
		infowindow1.open(map, marker);
		// bắt sự kiện click lên map
		google.maps.event.addListener(map, 'dblclick', function(event){
			// tạo mới 1 layout (thực ra là cái chấm đỏ trên bản đồ)
			var marker1 = new google.maps.Marker({
				position: event.latLng, // có vị trí tại ngay điểm click
				map: map, // sử dụng map
			});
			
			var conf = confirm('Đây có chính xác là địa điểm của bạn ???');
			if (conf){
				locate = prompt('Hãy đặt tên cho địa điểm của mình nào ^^!', 'Thành phố Hồ Chí Minh');
				// Tạo mới một ghi chú 
				var infowindow = new google.maps.InfoWindow({
					content: locate, // có nội dung là  địa điểm người dùng mới nhập
					boxStyle: {
						opacity: 0.75,
						height: '50px',
						width: '100px',
						zIndex:10,		
					},
					maxWidth: 200, // chiều dài rộng tối đa của ghi chú
				});
				marker.setMap(null);
				infowindow.close();
				infowindow.open(map,marker1);
				// Lưu lại tọa độ(kinh độ, vĩ độ)
				lat = latLng.lat();
				long = latLng.long();
			}else{
				alert('Hãy chọn lại vị trí của bạn bằng cách click chuột ^^~');
			}
		});
	}
	//Kết thúc hàm showmap
	
	// KẾT THÚC ĐỊNH VỊ
	
	
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
	
	
	$('#lblPostStatus').live('click', function(){
		var status = $('#txtStatus').val();
		
		$.ajax({
			url: './postStatus/PHP/postStatus.php',
			type: 'GET',
			async: false,
			data: 'status='+status+'&lat='+lat+'&long='+long+'&locate='+locate,
			success: function(data){
				$('#container').masonry( 'remove', $('#dinhchuan').parent());

                //thay doi o cho buttonPost
				$("#container").prepend(
                    '<div class="item-timeline" style="height:170px;">' +
                        '<div id="dinhchuan" style="padding:5px 5px 5px 5px; position:absolute; top:0px;">' +
                            '<ul>' +
                                '<li>' +
                                    '<a href="javascript:showthis(\'khung-1\')">' +
                                        '<div class="li-status"><i class="ico-status"></i>' +
                                            'Trạng Thái' +
                                        '</div>' +
                                    '</a>' +
                                '</li>' +
                                '<li>' +
                                    '<a href="javascript:showthis(\'khung-2\')">' +
                                        '<div class="li-status">' +
                                            '<i class="ico-picture"></i>' +
                                            'Hình Ảnh' +
                                        '</div>' +
                                    '</a>' +
                                '</li>' +
                        '</ul>' +
                        '<div id="khung-1" class="allinone" style="display:block;">' +
                            '<div class="arrow-status"></div>' +
                            '<textarea id="txtStatus" placeholder="Bạn nghĩ gì..." class="textarea-status"></textarea>' +
                            '<div class="btnDangHet">' +
                                '<a class="locate-user" title="Vị trí của bạn" ></a>'+
                                '<label id="lblPostStatus" class="buttonPost">' +
                                    '<input type="button" value="Đăng" class="btnPost1" />' +
                                '</label>' +
                            '</div' +
                        '></div>' +
                        '<div id="khung-2" class="allinone">' +
                            '<div class="arrow-status" style="margin-left:130px;"></div>' +
                            '<div class="cont-khung">' +
                                '<div class="khung-upanh" style="margin-left:10px;">' +
                                    '<span><a href="javascript:showthis(\'start-up\')">Tải Ảnh</a></span>' +
                                '</div>' +
                        '       <div class="khung-upanh">' +
                                    '<span><a>Tạo Album</a></span>' +
                                '</div>' +
                        '   </div>' +
                            '<div class="btnDangHet">' +
                                '<a class="locate-user" title="Vị trí của bạn" ></a>'+
                                '<label class="buttonPost">' +
                                    '<input type="button" value="Đăng"  class="btnPost"/>' +
                                '</label>' +
                            '</div>' +
                        '</div>' +
                        '<div id="start-up" class="allinone">' +
                            '<form id="frmUploadImage" action="postStatus/PHP/postImage.php" method="post">' +
                                '<textarea id="txtImageContent" name="txtImageContent" placeholder="bình luận điều gì đó về bức ảnh này..." style="height:70px; width:385px;"></textarea>' +
                                '<input type="file" style="display:block;" multiple="multiple" name="photoimg" id="photoimg"/>' +
                                '<div id="divPreview"></div>' +
                            '</form>' +
                        '</div>' +
                    '</div>' +
                '</div>'+data);

				//$('#divContent').html(data);
				
				$('#container').masonry( 'reload' );
				$('#divContent').masonry( 'reload' );
				$('.rightCorner').hide();
				$('.leftCorner').hide();
				Arrow_Points();
				
				$('.showmap-locate').hide(600);
				//location.reload();
				return false;
			}
		});
	});
});