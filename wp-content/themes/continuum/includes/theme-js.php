<?php
if ( ! is_admin() ) { add_action( 'wp_print_scripts', 'woothemes_add_javascript' ); }
if ( ! function_exists( 'woothemes_add_javascript' ) ) {
	function woothemes_add_javascript() {
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/includes/js/superfish.js', array( 'jquery' ) );
		wp_enqueue_script( 'wootabs', get_template_directory_uri() . '/includes/js/woo_tabs.js', array( 'jquery' ) );
		wp_enqueue_script( 'general', get_template_directory_uri() . '/includes/js/general.js', array( 'jquery' ) );
		if ( get_option( 'woo_slider' ) == 'true' ) {
			wp_enqueue_script( 'slides', get_template_directory_uri() . '/includes/js/slides.min.jquery.js', array( 'jquery' ) );
		}
	} // End woothemes_add_javascript()
}
?>