<div class="container-fluid no-padding post-header">
	<div class="post-header-bg" style="background-image:url('<?php echo $post->thumbnail()->src( 'large' ); ?>');"></div>
	<div class="jumbotron no-padding margin-bottom-0">
		<div class="jumbotron-footer-wrapper">
			<div class="container">
				<div class="jumbotron-footer row">
					<div class="col-sm-2"></div>
					<div class="col-xs-6 col-sm-4 black-alpha">
						<div class="post-meta">
							<p>
								<img class="profile-pic"> <span class="hidden-xs">Posted
									On </span>April 18, 2015
							</p>
						</div>
					</div>
					<div class="col-xs-6 col-sm-4 black-alpha">
						<div class="post-meta">
							<p class="comments">
								<span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
								2 <span class="hidden-xs">Comments</span>
							</p>
						</div>

					</div>
				</div>
			</div>
		</div>
		<script>
			jQuery(function ($) {
				var jumboHeight = $('.jumbotron').outerHeight();

				function parallax() {
					var scrolled = $(window).scrollTop();
					$('.bg').css('height', (jumboHeight - scrolled) + 'px');
				}

				$(window).scroll(function(e) {
					parallax();
				});
			});
		</script>
	</div>
</div>