<?php
if ( ! is_admin() ) {
	add_action( 'wp_print_scripts', 'woothemes_add_javascript' );
	add_action( 'wp_print_styles', 'woothemes_add_css' );
}

if ( ! function_exists( 'woothemes_add_javascript' ) ) {
	function woothemes_add_javascript( ) {
		wp_enqueue_script( 'general', get_template_directory_uri().'/includes/js/general.js', array( 'jquery' ) );
		
		// Load the JavaScript for the slides and testimonals on the homepage.
		
		if ( is_home() ) {
			wp_enqueue_script( 'jcarousel', get_template_directory_uri().'/includes/js/jcarousellite.min.js', array( 'jquery' ) );
			wp_enqueue_script( 'slides', get_template_directory_uri().'/includes/js/slides.min.jquery.js', array( 'jquery' ) );
			//wp_localize_script( 'general', 'woo_slider_settings', $data );
		}
		
		// Load the prettyPhoto JavaScript and CSS for use on the portfolio page template.
		
		if ( is_page_template('template-portfolio.php') || is_front_page() || is_singular( 'portfolio' ) || is_post_type_archive('portfolio') ) {
			wp_register_script( 'prettyPhoto', get_template_directory_uri().'/includes/js/jquery.prettyPhoto.js', array( 'jquery' ) );					
			wp_register_script( 'portfolio', get_template_directory_uri().'/includes/js/portfolio.js', array( 'jquery', 'prettyPhoto' ) );
			
			wp_enqueue_script( 'prettyPhoto' );
			wp_enqueue_script( 'portfolio' );
		}
		
		if ( is_singular( 'portfolio' ) ) {
		wp_enqueue_script( 'jcarousel', get_template_directory_uri().'/includes/js/jcarousel.js', array( 'jquery' ) );
		wp_enqueue_script( 'slides', get_template_directory_uri().'/includes/js/slides.min.jquery.js', array( 'jquery' ) );
		}
		
		// Google Maps
		wp_enqueue_script('googlemaps','http://maps.google.com/maps/api/js?sensor=false');
		
	}
}

if ( ! function_exists( 'woothemes_add_css' ) ) {
	function woothemes_add_css () {
	
		if ( is_page_template('template-portfolio.php') || is_front_page() || is_singular( 'portfolio' ) || is_post_type_archive('portfolio') ) {
			wp_register_style( 'prettyPhoto', get_template_directory_uri().'/includes/css/prettyPhoto.css' );
			wp_enqueue_style( 'prettyPhoto' );
		}
	
	} // End woothemes_add_css()
}
?>