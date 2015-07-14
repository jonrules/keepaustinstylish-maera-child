<?php

function maera_child_posts_peek_html() {
	echo '<div id="posts-peek-content">';
	
	echo '<div id="posts-peek-nav" class="banner navbar navbar-default">';
	echo '<div class="navbar-header">';
	echo '<button type="button" id="posts-peek-close" class="navbar-toggle"><span class="glyphicon glyphicon-remove"></span></button>';
	echo '<a href="' . get_bloginfo('url') . '" class="site-name-logo navbar-brand">';
	$site_logo = get_option( 'site_logo', false );
	if ( $site_logo ) {
		echo sprintf( '<img id="brand-logo" src="%s" alt="Keep Austin Stylish" />', esc_attr( $site_logo['url'] ) );
	} else {
		echo esc_html( get_bloginfo( 'name' ) );
	}
	echo '</a>';
	echo '</div>';
	echo '</div>';
	
	// Get categories
	$categories_query_args = array(
		'type' => 'post',
		'orderby' => 'name',
		'order' => 'ASC',
		'hide_empty' => 1,
		'hierarchical' => 0,
		'taxonomy' => 'category'
	);
	$categories_result = get_categories( $categories_query_args );
	echo '<div class="categories-list">';
	echo '<div class="categories-scroller">';
	echo '<a href="#" class="category-link category-latest" data-category="latest">Latest</a>';
	foreach ( $categories_result as $category ) {
		echo '<a href="#" class="category-link category-' . $category->slug . '" data-category="' . $category->slug . '">' . esc_html( $category->name ) . '</a>';
	}
	echo '</div>';
	echo '</div>';
	
	echo '<div class="categories-content">';
	// Latest
	echo '<div id="posts-category-latest" class="posts-list category-latest">';
	
	$posts_query_args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => 5,
		'order'=> 'DESC',
		'orderby' => 'date',
	);
	$posts_result = get_posts( $posts_query_args );
	foreach ( $posts_result as $p => $post ) {
		echo '<div class="post post-' . $post->ID . '">';
		if ( $p == 0 ) {
			echo '<a href="' . get_permalink( $post->ID ) . '">';
			echo get_the_post_thumbnail( $post->ID, 'large' );
			echo '</a>';
		}
		echo '<h2 class="post-title"><a href="' . get_permalink( $post->ID ) . '">' . esc_html( $post->post_title ) . '</a></h2>';
		echo '<div class="post-date"><i class="glyphicon glyphicon-calendar"></i> ' . date_i18n( get_option('date_format'), strtotime( $post->post_date ) ) . ' at ' . date_i18n( get_option('time_format'), strtotime( $post->post_date ) ) . '</div>';
		echo '</div>';
	}
	
	echo '<div class="row category-button">';
	echo '<div class="col-xs-12">';
	echo '<a class="btn btn-lg btn-category" href="' . site_url( '/posts' ) . '">Go to Latest</a>';
	echo '</div>';
	echo '</div>';
	
	echo '</div>';
	// By category
	foreach ( $categories_result as $category ) {
		echo '<div id="posts-category-' . $category->slug . '" class="posts-list category-' . $category->slug . '">';
		
		// Get posts
		$posts_query_args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 5,
			'order'=> 'DESC',
			'orderby' => 'date',
			'category' => $category->term_id
		);
		$posts_result = get_posts( $posts_query_args );
		foreach ( $posts_result as $p => $post ) {
			echo '<div class="post post-' . $post->ID . '">';
			if ( $p == 0 ) {
				echo '<a href="' . get_permalink( $post->ID ) . '">';
				echo get_the_post_thumbnail( $post->ID, 'large' );
				echo '</a>';
			}
			echo '<h2 class="post-title"><a href="' . get_permalink( $post->ID ) . '">' . esc_html( $post->post_title ) . '</a></h2>';
			echo '<div class="post-date"><i class="glyphicon glyphicon-calendar"></i> ' . date_i18n( get_option('date_format'), strtotime( $post->post_date ) ) . ' at ' . date_i18n( get_option('time_format'), strtotime( $post->post_date ) ) . '</div>';
			echo '</div>';
		}
		
		echo '<div class="row category-button">';
		echo '<div class="col-xs-12">';
		echo '<a class="btn btn-lg btn-category" href="' . get_category_link( $category->term_id ) . '">Go to ' . esc_html( $category->name ) . '</a>';
		echo '</div>';
		echo '</div>';
		
		echo '</div>';
	}
	echo '</div>';
	
	echo '<div class="row footer footer-links">';
	echo '<div class="col-xs-6">';
	echo '<a href="' . site_url( '/contact' ) . '">Contact</a>';
	echo '</div>';
	echo '<div class="col-xs-6">';
	echo '<a href="' . site_url( '/about' ) . '">About</a>';
	echo '</div>';
	echo '</div>';
	
	echo '<div class="row footer footer-copyright">';
	echo '<div class="col-xs-12">';
	echo '&copy; ' . date( 'Y' ) . ' ' . esc_html( get_bloginfo( 'name' ) );
	echo '</div>';
	echo '</div>';
	
	echo '</div>';
}
add_action( 'maera-child/posts-peek', 'maera_child_posts_peek_html' );