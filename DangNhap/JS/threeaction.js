function showonlyone(thechosenone) {
     $('.popup').each(function(index) {
          if ($(this).attr("id") == thechosenone) {
               $(this).show(200);
          }
          else {
               $(this).hide(600);
          }
     });
}

function showone(thechosenone) {
     $('.bogoc').each(function(index) {
          if ($(this).attr("id") == thechosenone) {
               $(this).show(200);
          }
          else {
               $(this).hide(600);
          }
     });
}

function showthis(thechosenone) {
     $('.allinone').each(function(index) {
          if ($(this).attr("id") == thechosenone) {
               $(this).show(200);
          }
          else {
               $(this).hide(600);
          }
     });
}


function dongbanbe()
{
	$('#divkb').hide(600);
}
function dongtinnhan()
{
	$('#divtn').hide(600);
}
function dongthongbao()
{
	$('#divtb').hide(600);
}

function motuychinh()
{
	$('#divtc').show(200);
}
function dongtuychinh()
{
	$('#divtc').hide(600);
}



function closeabout()
{
	$('#show-about').hide(600);	
}

function closefavourite()
{
	$('#show-favourite').hide(600);	
}

function closerela()
{
	$('#show-rela').hide(600);	
}

function closejob()
{
	$('#show-job').hide(600);	
}

function closeliving()
{
	$('#show-living').hide(600);	
}

function closecontact()
{
	$('#show-contact').hide(600);	
}

function closebasic()
{
	$('#show-basic').hide(600);	
}


//popup cho anh cover

$(function()
{
	$('#coverImage').hover(function(e) {
        $('#img-cover').show();
    }, function(){ $('#img-cover').hide();});
	
	$('#img-cover').hover(function(e) {
        $(this).show();
    });
	
	$('#ava-prof').hover(function(e) {
        $('#img-ava').show();
    }, function(){ $('#img-ava').hide();});
	
	$('#img-ava').hover(function(e) {
        $(this).show();
    });
});
