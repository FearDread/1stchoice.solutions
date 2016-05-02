<?php
/**
 * Register required widget area and function related to widget.
 * 
 * @package Uniform
 */
 
 /**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function uniform_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'uniform' ),
		'id'            => 'uniform_right_sidebar',
		'description'   => esc_html__( 'Show widgets at Right sidebar of archive/posts/pages.', 'uniform' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'uniform' ),
		'id'            => 'uniform_left_sidebar',
		'description'   => esc_html__( 'Show widgets at Left sidebar of archive/posts/pages.', 'uniform' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Home Page: Call to Action', 'uniform' ),
		'id'            => 'uniform_call_to_action_area',
		'description'   => esc_html__( 'Show widget in Homepage at Call to Action Section.', 'uniform' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar One', 'uniform' ),
		'id'            => 'uniform_footer_sidebar_one',
		'description'   => esc_html__( 'Show widgets at footer sidebar one', 'uniform' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Two', 'uniform' ),
		'id'            => 'uniform_footer_sidebar_two',
		'description'   => esc_html__( 'Show widgets at footer sidebar two', 'uniform' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Three', 'uniform' ),
		'id'            => 'uniform_footer_sidebar_three',
		'description'   => esc_html__( 'Show widgets at footer sidebar three', 'uniform' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Four', 'uniform' ),
		'id'            => 'uniform_footer_sidebar_four',
		'description'   => esc_html__( 'Show widgets at footer sidebar four', 'uniform' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
}
add_action( 'widgets_init', 'uniform_widgets_init' );