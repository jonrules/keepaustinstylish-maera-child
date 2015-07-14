<?php

add_theme_support( 'infinite-scroll', array(
	'type'           => 'scroll',
	'footer_widgets' => false,
	'container'      => 'main',
	'footer'         => 'page-footer',
	'wrapper'        => true,
	'render'         => false,
	'posts_per_page' => false,
) );

function maera_child_scripts() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_script( 'swipe', get_stylesheet_directory_uri() . '/js/jquery-swipe/jquery.swipe.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery-posts-peek', get_stylesheet_directory_uri() . '/js/jquery.posts-peek.js', array( 'jquery', 'swipe' ) );
}
add_action( 'wp_enqueue_scripts', 'maera_child_scripts' );

function maera_child_setup() {
	add_image_size( 'thumb-square', 237, 192, array( 'center', 'top' ) );
}
add_action( 'after_setup_theme', 'maera_child_setup' );

// function maera_child_widgets_context( $context ) {
// 	$context['left_sidebar'] = Timber::get_widgets( 'left_sidebar' );
// 	return $context;
// }
// add_filter( 'maera/timber/context', 'maera_child_widgets_context' );

/**
 * Print post preview
 * @param TimberPost $post
 */
function maera_child_post_preview( $post ) {
	// Get tags
	$tags = wp_get_post_tags( $post->ID );
	// Include template
	include ( 'templates/post-preview.php' );
}
add_action( 'maera-child/post-preview', 'maera_child_post_preview' );

function maera_child_post_header() {
	if ( ! is_single() ) {
		return;
	}
	$post = new TimberPost();
	if ( $post->ID && $post->slug != 'home' ) {
		include_once ( 'templates/post-header.php' );
	}
}
// add_action( 'maera/header/after', 'maera_child_post_header' );

function maera_child_category_post_panels() {
	if ( ! is_category() ) {
		return;
	}
	$category = get_category( get_query_var( 'cat' ) );
	echo do_shortcode( "[bootstrap-posts-panels category=\"{$category->term_id}\"]" );
}
add_action( 'maera-child/category-post-panels', 'maera_child_category_post_panels' );

function maera_child_get_post_excerpt( $post_id, $charlength ) {
	global $post;
	$temp_post = $post;
	$post = get_post( $post_id );
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			$excerpt = mb_substr( $subex, 0, $excut );
		} else {
			$excerpt = $subex;
		}
		$excerpt .= '<a href="' . get_permalink( $post_id ) . '">More &raquo;</a>';
	}

	$post = $temp_post;

	return $excerpt;
}

function maera_child_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'maera_child_mime_types');

function maera_child_print( $var ) {
	var_dump( $var );
}
add_action( 'maera-child/print', 'maera_child_print' );

// Include components
require_once ( 'components/posts-peek.php' );
require_once ( 'components/infinite-scroll.php' );