<?php
/*-----------------------------------------------------------------------------------*/
/* Theme Frontend JavaScript */
/*-----------------------------------------------------------------------------------*/

if ( ! is_admin() ) { add_action( 'wp_print_scripts', 'woothemes_add_javascript' ); }

if ( ! function_exists( 'woothemes_add_javascript' ) ) {
	function woothemes_add_javascript() {  
		wp_register_script( 'widgetSlider', get_template_directory_uri() . '/includes/js/slides.min.jquery.js', array( 'jquery' ) );
		wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/includes/js/jquery.prettyPhoto.js', array( 'jquery' ) );
		wp_register_script( 'jCarousel', get_template_directory_uri() . '/includes/js/jquery.jcarousel.min.js', array( 'jquery' ) );
		wp_register_script( 'portfolio', get_template_directory_uri() . '/includes/js/portfolio.js', array( 'jquery', 'prettyPhoto', 'jCarousel', 'widgetSlider' ) );
		wp_register_script( 'woo-feedback', get_template_directory_uri() . '/includes/js/feedback.js', array( 'jquery', 'widgetSlider' ) );
		
		// Conditionally load the Slider and Portfolio JavaScript, where needed.
		$load_slider_js = false;
		$load_portfolio_js = false;
		$load_feedback_js = false;
		
		if ( ( get_option( 'woo_slider_magazine' ) == 'true' || get_option( 'woo_slider_biz' ) == 'true' ) ) {
			$load_slider_js = true;
		}
		
		if (
			is_page_template( 'template-portfolio.php' ) || 
			( is_singular() && ( get_post_type() == 'portfolio' ) ) || 
			is_post_type_archive( 'portfolio' ) || 
			is_tax( 'portfolio-gallery' )
		   ) {
			$load_portfolio_js = true;
		}
		
		if ( is_page_template( 'template-feedback.php' ) ) {
			$load_feedback_js = true;
		}
			 
		// Allow child themes/plugins to load the slider and portfolio JavaScript when they need it.
		$load_slider_js = apply_filters( 'woo_load_slider_js', $load_slider_js );
		$load_portfolio_js = apply_filters( 'woo_load_portfolio_js', $load_portfolio_js );
		$load_feedback_js = apply_filters( 'woo_load_feedback_js', $load_feedback_js );
		
		if ( $load_slider_js ) { wp_enqueue_script( 'widgetSlider' ); }
		if ( $load_portfolio_js ) { wp_enqueue_script( 'portfolio' ); }
		if ( $load_feedback_js ) { wp_enqueue_script( 'woo-feedback' ); }
		
		do_action( 'woothemes_add_javascript' );
		
		wp_enqueue_script( 'general', get_template_directory_uri() . '/includes/js/general.js', array( 'jquery' ) );
	} // End woothemes_add_javascript()
}

/*-----------------------------------------------------------------------------------*/
/* Theme Frontend CSS */
/*-----------------------------------------------------------------------------------*/

if ( ! is_admin() ) { add_action( 'wp_print_styles', 'woothemes_add_css' ); }

if ( ! function_exists( 'woothemes_add_css' ) ) {
	function woothemes_add_css() {  
		wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/includes/css/prettyPhoto.css' );
		
		// Conditionally load the Portfolio CSS, where needed.
		$load_portfolio_css = false;
		
		if (
			is_page_template( 'template-portfolio.php' ) || 
			( is_singular() && ( get_post_type() == 'portfolio' ) ) || 
			is_post_type_archive( 'portfolio' ) || 
			is_tax( 'portfolio-gallery' )
		   ) {
			$load_portfolio_css = true;
		}
			 
		// Allow child themes/plugins to load the portfolio CSS when they need it.
		$load_portfolio_css = apply_filters( 'woo_load_portfolio_css', $load_portfolio_css );
	
		if ( $load_portfolio_css ) { wp_enqueue_style( 'prettyPhoto' ); }
		
		do_action( 'woothemes_add_css' );
	} // End woothemes_add_css()
}

/*-----------------------------------------------------------------------------------*/
/* Theme Admin JavaScript */
/*-----------------------------------------------------------------------------------*/

if ( is_admin() ) { add_action( 'admin_print_scripts', 'woothemes_add_admin_javascript' ); }

if ( ! function_exists( 'woothemes_add_admin_javascript' ) ) {
	function woothemes_add_admin_javascript() {
		global $pagenow;
		
		if ( ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) && ( get_post_type() == 'page' ) ) {
			wp_enqueue_script( 'woo-postmeta-options-custom-toggle', get_template_directory_uri() . '/includes/js/meta-options-custom-toggle.js', array( 'jquery' ), '1.0.0' );
		}
		
	} // End woothemes_add_admin_javascript()
}
?>