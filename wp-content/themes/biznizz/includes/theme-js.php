<?php
if (!is_admin()) add_action( 'wp_print_scripts', 'woothemes_add_javascript' );
if (!function_exists('woothemes_add_javascript')) {
	function woothemes_add_javascript() {
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/includes/js/superfish.js', array( 'jquery' ) );
		wp_register_script( 'slides', get_template_directory_uri() . '/includes/js/slides.min.jquery.js', array( 'jquery' ) );
		if (is_home()) { 
			wp_enqueue_script( 'slides' );
			wp_enqueue_script( 'jcarousel', get_template_directory_uri() . '/includes/js/jcarousel.js', array( 'jquery' ) );
		}
		if (is_page_template('template-portfolio.php')) {
			wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/includes/js/jquery.prettyPhoto.js', array( 'jquery' ) );					
			wp_enqueue_script( 'portfolio', get_template_directory_uri() . '/includes/js/portfolio.js', array( 'jquery' ) );
		}
	}
}
?>