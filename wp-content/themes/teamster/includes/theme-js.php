<?php
if ( ! is_admin() ) {
	add_action( 'wp_print_scripts', 'woothemes_add_javascript' );
	add_action( 'wp_print_styles', 'woothemes_add_css' );
}

if ( ! function_exists( 'woothemes_add_javascript' ) ) {
	function woothemes_add_javascript() {
		global $woo_options;
		
		wp_register_script( 'slides', get_template_directory_uri() . '/includes/js/slides.min.jquery.js', array( 'jquery' ) );
		wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/includes/js/jquery.prettyPhoto.js', array( 'jquery' ) );
		wp_register_script( 'jCarousel', get_template_directory_uri() . '/includes/js/jquery.jcarousel.min.js', array( 'jquery' ) );
		wp_register_script( 'portfolio', get_template_directory_uri() . '/includes/js/portfolio.js', array( 'jquery', 'prettyPhoto', 'jCarousel', 'slides' ) );
		wp_register_script( 'authorslider', get_template_directory_uri() . '/includes/js/author-slider.js', array( 'jquery' ) );

		// Load the prettyPhoto JavaScript and CSS for use on the portfolio page template.
		
		if ( is_post_type_archive('portfolio') || is_page_template( 'template-portfolio.php' ) || ( is_singular() && get_post_type() == 'portfolio' ) || is_tax( 'portfolio-gallery' ) ) {			
			wp_enqueue_script( 'portfolio' );
		}

		do_action( 'woothemes_add_javascript' );
		
		wp_enqueue_script( 'general', get_template_directory_uri().'/includes/js/general.js', array( 'jquery' ) );
		
		// Load SlidesJS on the homepage.
		if ( is_home() ) {
			wp_enqueue_script( 'slides' );
			wp_enqueue_script( 'authorslider' );
			wp_enqueue_script( 'jCarousel');
		// Load the custom slider settings.
			
			$autoStart = false;
			$autoSpeed = 6;
			$slideSpeed = 0.5;
			$effect = 'slide';
			$nextprev = 'true';
			$pagination = 'true';
			$hoverpause = 'true';
			$autoheight = 'false';
			
			// Get our values from the database and, if they're there, override the above defaults.
			$fields = array(
							'autoStart' => 'auto', 
							'autoSpeed' => 'interval', 
							'slideSpeed' => 'speed', 
							'effect' => 'effect', 
							'nextprev' => 'nextprev', 
							'pagination' => 'pagination', 
							'hoverpause' => 'hover', 
							'autoHeight' => 'autoheight'
							);
			
			foreach ( $fields as $k => $v ) {
				if ( is_array( $woo_options ) && isset( $woo_options['woo_slider_' . $v] ) && $woo_options['woo_slider_' . $v] != '' ) {
					${$k} = $woo_options['woo_slider_' . $v];
				}
			}
			
			// Set auto speed to 0 if we want to disable automatic sliding.
			if ( $autoStart == 'false' ) {
				$autoSpeed = 0;
			}
			
			$data = array(
						'speed' => $slideSpeed, 
						'auto' => $autoSpeed, 
						'effect' => $effect, 
						'nextprev' => $nextprev, 
						'pagination' => $pagination, 
						'hoverpause' => $hoverpause, 
						'autoheight' => $autoHeight
						);
						
			wp_localize_script( 'general', 'woo_slider_settings', $data );
			
			// enqueue and localise scripts
			
			wp_localize_script( 'authorslider', 'the_ajax_script' , array( 'ajaxurl' => admin_url( 'admin-ajax.php') , 'author_slider_nonce' => wp_create_nonce( 'ajax_author_slider_nonce' ) ) );
		}
		
		
	
	} // End woothemes_add_javascript()
}


if ( ! function_exists( 'woothemes_add_css' ) ) {
	function woothemes_add_css () {
		
		wp_register_style( 'prettyPhoto', get_template_directory_uri().'/includes/css/prettyPhoto.css' );
	
		if ( is_post_type_archive('portfolio') || is_page_template('template-portfolio.php') || ( is_singular() && get_post_type() == 'portfolio' ) || is_tax( 'portfolio-gallery' ) ) {
			wp_enqueue_style( 'prettyPhoto' );
		}
	
		do_action( 'woothemes_add_css' );
	
	} // End woothemes_add_css()
}
?>