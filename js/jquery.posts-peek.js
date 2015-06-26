jQuery(function ($) {
	$('#posts-peek-toggle').click(function () {
		$('#posts-peek-content').show().find('.category-link:first').click();
		//$('#wrap-main-section, header, .jumbotron').hide();
		$(document.body).find('> *').not('#posts-peek-content').hide();
	});
	$('#posts-peek-close').click(function () {
		$('#posts-peek-content').hide();
		//$('#wrap-main-section, header, .jumbotron').show();
		$(document.body).find('> *').not('#posts-peek-content').show();
	});
	
	$('#posts-peek-content').find('.category-link').click(function () {
		var $link = $(this);
		$('#posts-peek-content').find('.posts-list').removeClass('active');
		$('#posts-peek-content').find('#posts-category-' + $link.data('category')).addClass('active');
		$('#posts-peek-content').find('.category-link').removeClass('active');
		$link.addClass('active');
		
		// Calculate link position
		var $links = $('#posts-peek-content').find('.category-link');
		var offset = 0;
		$links.each(function () {
			var width = $(this).outerWidth(true);
			if ($(this).hasClass('active')) {
				offset += width/2;
				return false;
			}
			offset += width;
		});
		var left = parseInt($('#posts-peek-content').width()/2 - offset);
		$('#posts-peek-content').find('.categories-scroller').animate({
			'left': left
		}, 'fast');
		
		return false;
	});
	$('#posts-peek-content').find('.category-link:first').click();
	
	$('#posts-peek-content').find('.categories-list, .wp-post-image').swipe(function (evt, dx, dy) {
		if (dx > 30) {
			$('#posts-peek-content').find('.category-link.active').prev().click();
		} else if (dx < -30) {
			$('#posts-peek-content').find('.category-link.active').next().click();
		} else if (Math.abs(dy) > 30) {
			var targetScroll = $(document.body).scrollTop() - 5*dy;
			$(document.body).animate({
				'scrollTop': targetScroll
			}, 'fast');
		}
	});
});
