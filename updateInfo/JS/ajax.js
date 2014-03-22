$(document).ready(function(e) {
	// Chinh sua nghe nghiep va truong hoc
    $('#job-accept').live('click', function(){
		var job = $('#iptJob').val();
		var school = $('#iptSchool').val();
		//alert (job + school);
		$.ajax({
			url : './updateInfo/PHP/updateJob.php',
			type: 'GET',
			async: false,
			data : 'job='+job+'&school='+school,
			success: function(data){
				$('#divJob').html(data);
			}
		});
		
		$('#job-cancel').click();
	});
	
	
	// chinh sua About me
	$('#about-accept').live('click', function(){
		var about = $('#txtAbout1').val();
		$.ajax({
			url : './updateInfo/PHP/updateAboutMe.php',
			type : 'GET',
			async: false,
			data: 'about='+about,
			success: function(data){
				$('#lblAbout').html(data);	
			}
		});
		
		
		$('#about-cancel').click();	
	});
	
	// chinh sua Quote -  trich dan ua thich
	$('#favourite-accept').live('click', function(){
		var quote = $('#txtAbout2').val();
		$.ajax({
			url: './updateInfo/PHP/updateQuote.php',
			type: 'GET',
			async: false,
			data: 'quote='+quote,
			success: function(data){
				$('#lblAbout2').html(data);	
			}
		});
		
		
		$('#favourite-cancel').click();	
	});
	
	// chinh sua thong tin co ban
	$('#basic-accept').live('click', function(){
		var sex = $('#selectSex option:selected').html();
		var day = $('#dayOfBirth').val();
		var month = $('#monthOfBirth').val();
		var year = $('#yearOfBirth').val();
		
		$.ajax({
			url: './updateInfo/PHP/updateBasicInfo.php',
			type: 'GET',
			async: false,
			data: 'day='+day+'&month='+month+'&year='+year+'&sex='+sex,
			success: function(data){
				$('#tblBasicInfo').html(data);
			}
		});
		
		$.ajax({
			url: './updateInfo/PHP/updateBiography.php',
			type: 'GET',
			async: false,
			data: 'day='+day+'&month='+month+'&year='+year,
			success: function(data){
				$('#divBiography').html(data);	
			}
		});
		
		$('#basic-cancel').click();
	});
	
	// chinh sua relationship
	$('#rela-accept').live('click', function(){
		var relationship = $('#select-rela option:selected').html();
		
		$.ajax({
			url: './updateInfo/PHP/updateRelationship.php',
			type: 'GET',
			async: false,
			data: 'relationship='+relationship,
			success: function(data){
				$('#divRelationship').html(data);
			}
		});
		
		$('#rela-cancel').click();
	});
	
	// chinh sua contact, thong tin lien he
	$('#contact-accept').live('click', function(){
		var phone = $('#txtPhoneNumber').val();
		var address = $('#txtAddress').val();
		
		$.ajax({
			url: './updateInfo/PHP/updateContact.php',
			type: 'GET',
			async: false,
			data: 'phone='+phone+'&address='+address,
			success: function(data){
				$('#tblContact').html(data);	
			}
		});
		
		$('#contact-cancel').click();
	});
	
	// chinh sua cho o hien tai, city
	$('#living-accept').live('click', function(){
		var city = $('#txtCity').val();
		var homeTown = $('#txtHomeTown').val();
		
		$.ajax({
			url: './updateInfo/PHP/updateCity.php',
			type: 'GET',
			async: false,
			data: 'city='+city+'&home='+homeTown,
			success: function(data){
				$('#divCity').html(data);	
			}
		});
		
		$('#living-cancel').click();
	});
});