jQuery(function ($) {
	$('#brand-logo').attr('data-original-src', $('#brand-logo').attr('src'));
	$('#brand-logo').hover(
		function () {
			//http://keepaustinstylish.patternsinthecloud.com/wp-content/uploads/2015/07/logo-keep-austin-stylish-WHT.svg
			this.src = this.getAttribute('data-original-src').replace('-WHT', '-BLK');
		},
		function () {
			this.src = this.getAttribute('data-original-src');
		}
	);
});