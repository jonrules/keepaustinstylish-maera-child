<?php

function maera_child_get_more_posts() {
	$page = $_REQUEST['page'];
	$category = isset( $_REQUEST['category'] ) ? $_REQUEST['category'] : '';
	$tag = isset( $_REQUEST['tag'] ) ? $_REQUEST['tag'] : '';
	
	// Get posts
	$posts_query_args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => 5,
		'order'=> 'DESC',
		'orderby' => 'date'
	);
	if ( $category ) {
		$posts_query_args['category'] = $category;
	}
	if ( $tag ) {
		$posts_query_args['tag'] = $tag;
	}
	$posts_result = get_posts( $posts_query_args );
}
add_action( 'wp_ajax_get_more_posts', 'maera_child_get_more_posts' );

function maera_child_infinite_scroll_scripts() {
	$page = get_query_var( 'paged' );
	if ( $page == '' ) {
		$page = get_query_var( 'page' );
	}
	if ( $page < 1 ) {
		$page = 1;
	}
	wp_register_script( 'jquery-infinite-scroll', get_stylesheet_directory_uri() . '/js/jquery.infinite-scroll.js', array( 'jquery' ) );
	wp_localize_script( 'jquery-infinite-scroll', 'InfiniteScroll', array( 
		'pageNumber' => $page,
		'pageIsLoading' => false,
		'loadMorePages' => true
	) );
	wp_enqueue_script( 'jquery-infinite-scroll' );
}
add_action( 'wp_enqueue_scripts', 'maera_child_infinite_scroll_scripts' );