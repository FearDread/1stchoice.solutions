<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Uniform
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function uniform_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'uniform_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function uniform_jetpack_setup
add_action( 'after_setup_theme', 'uniform_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function uniform_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function uniform_infinite_scroll_render
