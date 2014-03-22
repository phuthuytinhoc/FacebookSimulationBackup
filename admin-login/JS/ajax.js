$(document).ready(function(e) {
	$('#warning-login').hide();
	$('#txtUser').focus();
    $('#btnLogin').click(function(e) {
        var user = $('#txtUser').val();
		var pass = $('#txtPass').val();
		
		if (user == '' || pass == ''){
			$('#warning-login').slideDown('slow').delay(3000).slideUp('slow');
			return false;
		}else{
			$.ajax({
				url: 'checkLogin.php',
				type: 'GET',
				async: false,
				data: 'user='+user+'&pass='+pass,
				success: function(data){
					if (data == 'true'){
						document.location = 'http://localhost/facebook/admin-login/PHP/admin-page.php';
					}
					if (data ==  'false'){
						$('#warning-login').slideDown('slow').delay(3000).slideUp('slow');
					}
				}
			});
		}
	});
	$('#btnLogOut').click(function(e) {
        $.ajax({
			url : 'logout.php',
			type: 'GET',
			success: function(data){
				document.location = 'http://localhost/facebook/admin-login/PHP/admin-login.php';
			}
		});
    });
});