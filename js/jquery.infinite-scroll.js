jQuery(function ($) {
	if ($('body.home, body.blog, body.archive').length < 1) {
		return;
	}
	
	$(window).scroll(function () {
		if (InfiniteScroll.pageIsLoading || !InfiniteScroll.loadMorePages) {
			return;
		}
		
		var $container = $('.infinite-scroll-container').last();
		var $lastArticle = $container.find('article').last();
		var triggerTop = $lastArticle.offset().top + $lastArticle.height() - $(window).height();
		var scrollTop = $(document.body).scrollTop();
		if (triggerTop < scrollTop) {
			InfiniteScroll.pageNumber++;
			var url = '' + window.location;
			var regex = /\/page\/\d+/;
			if (regex.test(url)) {
				url = url.replace(/\/page\/\d+/, '/page/' + InfiniteScroll.pageNumber);
			} else {
				url = url + 'page/' + InfiniteScroll.pageNumber + '/?page=' + InfiniteScroll.pageNumber;
			}
			InfiniteScroll.pageIsLoading = true;
			$container.addClass('loading');
			$.get(url, null, function (response) {
				var $articles = $(response).find('.infinite-scroll-container').last().find('article');
				if ($articles.length > 0) {
					$container.append($articles);
				} else {
					InfiniteScroll.loadMorePages = false;
				}
				$container.trigger('infinite-scroll-items-loaded', [$articles]);
			}).fail(function(xhr) {
				if (xhr.status == 404) {
					InfiniteScroll.loadMorePages = false;
				} else {
					InfiniteScroll.pageNumber--;
				}
			}).always(function() {
				InfiniteScroll.pageIsLoading = false;
				$container.removeClass('loading');
				$container.trigger('infinite-scroll-finished');
			});
		}
	});
});