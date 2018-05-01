$(document).ready(function() {
	var pathname = window.location.href;
	$('.navbar-nav > li > a[href="'+pathname+'"]').parent().addClass('active');
});
