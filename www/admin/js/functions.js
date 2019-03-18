var urlParams;
(window.onpopstate = function () {
    var match,
        pl     = /\+/g,  // Regex for replacing addition symbol with a space
        search = /([^&=]+)=?([^&]*)/g,
        decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
        query  = window.location.search.substring(1);

    urlParams = {};
    while (match = search.exec(query))
       urlParams[decode(match[1])] = decode(match[2]);
})();

$(document).ready(function() {
	$(".select2").select2({
	});
});

$(function(){
	$('.datefield').datepicker({ 
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true 
	});
	$('.timepicker').timepicker({
    	timeFormat: 'HH:mm:ss', //format 24 hours not am/pm
		startTime: new Date(0, 0, 0, 0, 00, 0), //start time from 01 PM
		interval: 5 //interval per minutes
    });
	
	$('.notif').click(function(){
		$(this).fadeOut();
	});
});


function ui_alert(msg, options){
	$('#dialog').html(msg);
	$('#dialog').dialog(options);
}

function popup(url, t, w, h){
	// don't make popup if in mobile condition resolution < 600 px 
	if($('#header .nav-menu').is(':visible')){
		window.location = url;
		return;
	}
	
	$.get(url, function(d){
		ui_alert(d, {title: t, width: w, height: h});
	});
}

function logout(){
	if(confirm('Are you sure want to logout?')){
		return true;
	}
	
	return false;
}

function user_suggestion(e){
	var user = $(e).html().split(':');
	
	$('#login-form form input[name="username_email"]').val(user[0]);
	$('#login-form form input[name="password"]').val(user[1]);
	$('#login-form form').submit();
}


function menuSlide(){
	$('#sidebar').slideToggle('medium', function(){
		if($(this).is(':visible'))
			$(this).css('display', 'inline-block');
	});
}

