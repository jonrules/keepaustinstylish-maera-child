jQuery(function ($) {
	$logo = $('.site-name-logo').find('img');
	$logo.attr('data-original-src', $logo.attr('src'));
	$logo.hover(
		function () {
			this.src = this.getAttribute('data-original-src').replace('-WHT', '-BLK') + '?time=' + (new Date()).getMilliseconds();
		},
		function () {
			this.src = this.getAttribute('data-original-src') + '?time=' + (new Date()).getMilliseconds();
		}
	);
});