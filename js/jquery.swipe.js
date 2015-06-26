(function($) {

	$.fn.swipe = function (onSwipe, minDx, minDy) {
		var swipeX = 0;
		var swipeY = 0;
		var swipeTime = 0;
		var minSwipeTime = 500;
		if (minDx == null) {
			minDx = 30;
		}
		if (minDy == null) {
			minDy = 30;
		}
		
		this.each(function () {

			$(this).bind('swipe', onSwipe);
			
			this.addEventListener('touchstart', function (evt) {
				evt.preventDefault();
				if (evt.touches.length > 0) {
					swipeX = evt.touches[0].pageX;
					swipeY = evt.touches[0].pageY;
				}
			}, false);
			
			this.addEventListener('touchend', function (evt) {
				evt.preventDefault();
				swipeX = 0;
				swipeY = 0;
			}, false);
			
			this.addEventListener('touchmove', function (evt) {
				evt.preventDefault();
				var now = new Date();
				if ((now - swipeTime) > minSwipeTime) {
					if (evt.touches.length > 0) {
						if (swipeX > 0 || swipeY > 0) {
							var dx = evt.touches[0].pageX - swipeX;
							var dy = evt.touches[0].pageY - swipeY;
							if (Math.abs(dx) > minDx || Math.abs(dy) > minDy) {
								$(this).trigger('swipe', [dx, dy]);
								swipeTime = now;
							}
						}
					}
				}
			}, false);
		
		});
		
		return this;
	};

}(jQuery));