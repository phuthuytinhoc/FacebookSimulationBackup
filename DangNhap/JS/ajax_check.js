$(document).ready(function(e) {
    $('#button_Regis').click(function(e) {
        var ten = $('#TenUser').val();
		var ho = $('#HoUser').val();
		var email = $('#EmailUser').val();
		var email2 = $('#ReEmail').val();
		var pass = $('#PassUser').val();
		var gioitinh = $('#combobox_Sex option:selected').val();
		var ngaysinh = $('#combobox_DOB option:selected').val();
		var thangsinh = $('#combobox_MOB option:selected').val();
		var namsinh = $('#combobox_YOB option:selected').val();
		var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
		
		if(ten == ''){
			$('#divError').text('Bạn phải nhập vào tên của mình.').slideDown('slow').delay(1000).slideUp('slow');
			$('#TenUser').focus();
			return false;
		}else{
			if(ho == ''){
				$('#divError').text('Bạn phải nhập vào họ của mình.').slideDown('slow').delay(1000).slideUp('slow');
				$('#HoUser').focus();
				return false;
			}else{
				if(!email_regex.test(email) || email == ''){
					$('#divError').text('Bạn phải nhập vào email của mình.').slideDown('slow').delay(1000).slideUp('slow');
					$('#EmailUser').focus();
					return false;
				}else{
					if(!email_regex.test(email) || email2 == '' || email2!= email){
						$('#divError').text('Bạn phải nhập lại email.').slideDown('slow').delay(1000).slideUp('slow');
						$('#ReEmail').focus();
						return false;	
					}else{
						if(pass == ''){
							$('#divError').text('Bạn phải nhập vào mật khẩu.').slideDown('slow').delay(1000).slideUp('slow');
							$('#PassUser').focus();
							return false;						
						}else{
							if(pass != '' && pass.length < 6){
								$('#divError').text('Bạn phải nhập vào mật khẩu có độ dài hơn 6 ký tự.').slideDown('slow').delay(1000).slideUp('slow');
								$('#PassUser').focus();
								return false;
							}else{
								if(gioitinh == -1){
									$('#divError').text('Bạn phải nhập vào giới tính của mình.').slideDown('slow').delay(1000).slideUp('slow');
									$('#combobox_Sex').focus();
									return false;	
								}else{
									if(ngaysinh == -1){
										$('#divError').text('Bạn phải nhập vào ngày sinh của mình.').slideDown('slow').delay(1000).slideUp('slow');
										$('#combobox_DOB').focus();
										return false;
									}else{
										if(thangsinh == -1){
											$('#divError').text('Bạn phải nhập vào tháng sinh của mình.').slideDown('slow').delay(1000).slideUp('slow');
											$('#combobox_MOB').focus();
											return false;	
										}else{
											if(namsinh == -1){
												$('#divError').text('Bạn phải nhập vào năm sinh của mình.').slideDown('slow').delay(1000).slideUp('slow');
												$('#combobox_YOB').focus();
												return false;
											}else{
												$.ajax({
													url: './DangNhap/PHP/check_user.php',
													type: 'GET',
													async: true,
													data:'email='+email+'&pass='+pass+'&ho='+ho+'&ten='+ten+'&gioitinh='+gioitinh+'&ngaysinh='+ngaysinh+'&thangsinh='+thangsinh+'&namsinh='+namsinh,
													success: function(data){
														if(data == 'false'){
															$('#divError').text('Email này đã được dùng để đăng kí một tài khoản khác.').slideDown('slow').delay(1000).slideUp('slow');
															$('#EmailUser').focus();
															return false;
														}
														if(data == 'true'){
															document.location = 'http://socialnetworkvn.cuccfree.com/login.php';
														}
													}
												
												});
											}
										}	
									}
								}
							}
						}
					}
				}
			}
		}
    });
	$('#buttonLogin').click(function(e) {
        var emailLogin = $('#emailLogin').val();
		var passLogin = $('#passLogin').val();
		
		$.ajax({
			url : './DangNhap/PHP/check_Login.php',
			type: 'GET',
			async: true,
			data: 'email='+emailLogin+'&pass='+passLogin,
			success: function(data){
				if(data == 'true'){
					document.location = 'http://socialnetworkvn.cuccfree.com/userpage.php';
				}else{
					if(data == 'false'){
						document.location = 'http://socialnetworkvn.cuccfree.com/login.php';
					}
				}
			}
		});
    });
	
	$('#btnDangKy').click(function(e) {
        document.location = 'http://socialnetworkvn.cuccfree.com/index.php';
    });
	
	$('#btnDangNhap').click(function(e) {
        var email = $('#emailDangNhap').val();
		var pass = $('#passDangNhap').val();
		//alert('da click');
		$.ajax({
			url : './DangNhap/PHP/check_Login.php',
			type: 'GET',
			async: true,
			data: 'email='+email+'&pass='+pass,
			success: function(data){
				if(data == 'true'){
					document.location = 'http://socialnetworkvn.cuccfree.com/userpage.php';
				}else{
					if(data == 'false'){
						$('#emailDangNhap').val('');
						$('#passDangNhap').val('');
						document.location = 'http://socialnetworkvn.cuccfree.com/login.php';
					}
				}
			}
		});
    });
});
