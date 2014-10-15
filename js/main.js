
Gumby.ready(function() {

	if($.cookie('er_cookie')){
		$('#cookie').hide();
	} else {
		$('#cookie').show();
	}
	$('#cookieOK').on('click', function(e){
		e.preventDefault;
		$.cookie('er_cookie', 'dismiss_alert', { expires: 70000 });
		$('#cookie').fadeOut();
	});
	$('select').wrap('<div class="picker"></div>');
	$('.search-field').addClass('text input narrow');
	$('label').addClass('inline');
	$('#submitForm').click(function(e){
		e.preventDefault();
		$('#search').submit();
	});
	$('#searchAnchor').on('click', function(e){
		e.preventDefault();
		$('#options').toggle('slow');
		$('#toggle').toggleClass('icon-up-open-big').toggleClass('icon-down-open-big');
	});
	if(Gumby.isOldie || Gumby.$dom.find('html').hasClass('ie9')) {
		$('input, textarea').placeholder();
	}
	$('#skip-switch').on('gumby.onComplete', function() {
		$(this).trigger('gumby.trigger');
	});

}).oldie(function() {
	Gumby.warn("This is an oldie browser...");
}).touch(function() {
	Gumby.log("This is a touch enabled device...");
});
