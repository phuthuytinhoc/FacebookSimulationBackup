$(document).ready(function(e) {
    $('#btnChangeName').live('click', function(){
		var ten = $('#textTen').val();
		var ho = $('#textHo').val();
		
		if(ten == ''){
			$('#nameError').html('Bạn chưa nhập tên');
			$('#nameError').fadeIn('slow').delay(1000).fadeOut('slow');
			$('#textTen').focus();
		}else{
			if(ho == ''){
				$('#nameError').html('Bạn chưa nhập họ');
				$('#nameError').fadeIn('slow').delay(1000).fadeOut('slow');
				$('#textHo').focus();
			}else{
				$.ajax({
					url: './Setting/PHP/changeName.php',
					type: 'GET',
					async: false,
					data: 'ten='+ten+'&ho='+ho,
					success: function(data){
						if(data == 'thanhcong'){

							$('#nameSuccess').html('Lưu tên thành công');
							$('#nameSuccess').fadeIn('slow').delay(1000).fadeOut('slow');

						}
					}					
				});	
			}
		}
	});
	
	$('#btnCancelName').live('click', function(){
		$('#textTen').val('');
		$('#textHo').val('');
	});
	
	$('#btnChangePass').live('click', function(){
		var pass = $('#textPassCu').val();
		var passnew = $('#textPassMoi').val();
		var nhaplai = $('#textNhapLai').val();
		if(pass == ''){
			$('#passError').html('Bạn chưa nhập mật khẩu cũ');
			$('#passError').fadeIn('slow').delay(1000).fadeOut('slow');
			$('#textPassCu').focus();
		}else{
			if(passnew == ''){
				$('#passError').html('Bạn chưa nhập mật khẩu mới');
				$('#passError').fadeIn('slow').delay(1000).fadeOut('slow');
				$('#textPassMoi').focus();
			}else{
				if(nhaplai == ''){
					$('#passError').html('Bạn chưa nhập lại mật khẩu mới');
					$('#passError').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#textNhapLai').focus();
				}else{
					if(nhaplai != passnew){
						$('#passError').html('Password nhập lại chưa chính xác');
						$('#passError').fadeIn('slow').delay(1000).fadeOut('slow');
						$('#textNhapLai').focus();
					}else{
						$.ajax({
							url: './Setting/PHP/changePass.php',
							type: 'GET',
							async: false,
							data: 'pass='+passnew,
							success: function(data){
								if(data == 'thanhcong'){
									$('#textPassCu').val('');
									$('#textPassMoi').val('');
									$('#textNhapLai').val('');
									
									$('#passSuccess').html('Đổi mới password thành công');
									$('#passSuccess').fadeIn('slow').delay(1000).fadeOut('slow');
		
								}
							}					
						});		
					}
				}
			}
		}
	});
});