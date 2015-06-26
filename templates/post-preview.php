<div class="row box-shadow">
	<div class="col-xs-5 col-sm-4 no-padding">
		<a href="<?php echo $post->permalink; ?>">
			<?php echo get_the_post_thumbnail( $post->ID, 'thumb-square' ); ?>
		</a>
	</div><!-- end col -->
	<div class="col-xs-7 col-sm-8 no-padding">
		<div class="lib-row lib-header">
			<h2><?php echo esc_html( $post->post_title ); ?></h2>
		</div>
		<div class="lib-row lib-hashtags">
			<div class="white-right"></div>
			<div class="post-hashtags-scroller">
				<ul class="post-hashtags">
					<?php foreach ( $tags as $tag ): ?>
						<li><a href="<?php echo get_tag_link( $tag->term_id ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div class="lib-row lib-desc hidden-xs">
			<?php echo maera_child_get_post_excerpt( $post->ID, 200 ); ?>
		</div>
	</div><!-- end col -->
</div> <!-- end .row.box-shadow -->