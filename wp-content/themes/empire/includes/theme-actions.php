<?php 

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Add custom styling to HEAD
- Add custom typograhpy to HEAD
- Add layout to body_class output
- Featured Slider Settings
- Single Portfolio Gallery Settings

-----------------------------------------------------------------------------------*/


add_action( 'woo_head','woo_custom_styling' );			// Add custom styling to HEAD
add_action( 'woo_head','woo_custom_typography' );			// Add custom typography to HEAD
add_filter( 'body_class','woo_layout_body_class' );		// Add layout to body_class output


/*-----------------------------------------------------------------------------------*/
/* Add Custom Styling to HEAD */
/*-----------------------------------------------------------------------------------*/
if (!function_exists( 'woo_custom_styling')) {
	function woo_custom_styling() {
	
		global $woo_options;
		
		$output = '';
		// Get options
		if (isset($woo_options[ 'woo_body_color' ])) { $body_color = $woo_options[ 'woo_body_color' ]; } else { $body_color = ''; }
		if (isset($woo_options[ 'woo_body_img' ])) { $body_img = $woo_options[ 'woo_body_img' ]; } else { $body_img = ''; }
		if (isset($woo_options[ 'woo_body_repeat' ])) { $body_repeat = $woo_options[ 'woo_body_repeat' ]; } else { $body_repeat = ''; }
		if (isset($woo_options[ 'woo_body_pos' ])) { $body_position = $woo_options[ 'woo_body_pos' ]; } else { $body_position = ''; }
		if (isset($woo_options[ 'woo_link_color' ])) { $link = $woo_options[ 'woo_link_color' ]; } else { $link = ''; }
		if (isset($woo_options[ 'woo_link_hover_color' ])) { $hover = $woo_options[ 'woo_link_hover_color' ]; } else { $hover = ''; }
		if (isset($woo_options[ 'woo_button_color' ])) { $button = $woo_options[ 'woo_button_color' ]; } else { $button = ''; }
			
		// Add CSS to output
		if ($body_color)
			$output .= 'body, #header, #footer-wrapper {background:'.$body_color.'}' . "\n";
			
		if ($body_img)
			$output .= 'body {background-image:url( '.$body_img.')}' . "\n";

		if ($body_img && $body_repeat && $body_position)
			$output .= 'body {background-repeat:'.$body_repeat.'}' . "\n";

		if ($body_img && $body_position)
			$output .= 'body {background-position:'.$body_position.'}' . "\n";

		if ($link)
			$output .= 'a {color:'.$link.'}' . "\n";

		if ($hover)
			$output .= 'a:hover, .post-more a:hover, .post-meta a:hover, .post p.tags a:hover {color:'.$hover.'}' . "\n";

		if ($button) {
			$output .= 'a.button, a.comment-reply-link, #commentform #submit, #contact-page .submit {background:'.$button.';border-color:'.$button.'}' . "\n";
			$output .= 'a.button:hover, a.button.hover, a.button.active, a.comment-reply-link:hover, #commentform #submit:hover, #contact-page .submit:hover {background:'.$button.';opacity:0.9;}' . "\n";
		}
		
		// Output styles
		if (isset($output) && $output != '') {
			$output = strip_tags($output);
			$output = "<!-- Woo Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
			
	}
} 

/*-----------------------------------------------------------------------------------*/
/* Add custom typograhpy to HEAD */
/*-----------------------------------------------------------------------------------*/
if (!function_exists( 'woo_custom_typography')) {
	function woo_custom_typography() {
	
		// Get options
		global $woo_options;
				
		// Reset	
		$output = '';
		
		// Add Text title and tagline if text title option is enabled
		if ( isset($woo_options[ 'woo_texttitle' ]) && $woo_options[ 'woo_texttitle' ] == "true" ) {		
			
			if ( $woo_options[ 'woo_font_site_title' ] )
				$output .= '#logo .site-title a {'.woo_generate_font_css($woo_options[ 'woo_font_site_title' ]).'}' . "\n";	
			if ( $woo_options[ 'woo_tagline' ] == "true" && $woo_options[ 'woo_font_tagline' ] ) 
				$output .= '#logo .site-description {'.woo_generate_font_css($woo_options[ 'woo_font_tagline' ]).'}' . "\n";	
		}

		if ( isset($woo_options[ 'woo_typography' ]) && $woo_options[ 'woo_typography' ] == "true") {
			
			if ( $woo_options[ 'woo_font_body' ] )
				$output .= 'body { '.woo_generate_font_css($woo_options[ 'woo_font_body' ], '1.5').' }' . "\n";	

			if ( $woo_options[ 'woo_font_nav' ] )
				$output .= '#navigation, #navigation .nav a, #header-right { '.woo_generate_font_css($woo_options[ 'woo_font_nav' ], '1.4').' }' . "\n";	

			if ( $woo_options[ 'woo_font_post_title' ] )
				$output .= '.post .title, .page .title, .post .title a:link, .post .title a:visited { '.woo_generate_font_css($woo_options[ 'woo_font_post_title' ]).' }' . "\n";	
		
/*
			if ( $woo_options[ 'woo_font_post_meta' ] )
				$output .= '.post-meta { '.woo_generate_font_css($woo_options[ 'woo_font_post_meta' ]).' }' . "\n";	
*/

			if ( $woo_options[ 'woo_font_post_entry' ] )
				$output .= '.entry, .entry p { '.woo_generate_font_css($woo_options[ 'woo_font_post_entry' ], '1.5').' } h1, h2, h3, h4, h5, h6 { font-family: '.stripslashes($woo_options[ 'woo_font_post_entry' ]['face']).', arial, sans-serif; }'  . "\n";	

			if ( $woo_options[ 'woo_font_widget_titles' ] )
				$output .= '.widget h3 { '.woo_generate_font_css($woo_options[ 'woo_font_widget_titles' ]).' }'  . "\n";	

		// Add default typography Google Font
		} else {
		
			// Set default font face
			$woo_options['woo_default_face_1'] = array('face' => 'Ubuntu');
			
			// Output default font face
			$output .= '#navigation, #navigation .nav a, #tabs ul.wooTabs li a, .widget h3, #header-right { '.woo_generate_font_css($woo_options['woo_default_face_1']).' }' . "\n";			

			$woo_options['woo_default_face_2'] = array('face' => 'Droid Serif');
			$output .= 'h1, h2, h3, h4, h5, h6, .post .title, .page .title, .archive_header, .post .post-date { '.woo_generate_font_css($woo_options['woo_default_face_2']).' }' . "\n";			
		
		} 
		
		// Output styles
		if (isset($output) && $output != '') {
		
			// Enable Google Fonts stylesheet in HEAD
			if (function_exists( 'woo_google_webfonts')) woo_google_webfonts();
			
			$output = "<!-- Woo Custom Typography -->\n<style type=\"text/css\">\n" . $output . "</style>\n\n";
			echo $output;
			
		}
			
	}
} 

// Returns proper font css output
if (!function_exists( 'woo_generate_font_css')) {
	function woo_generate_font_css($option, $em = '1') {

		// Test if font-face is a Google font
		global $google_fonts;
		foreach ( $google_fonts as $google_font ) {
					
			// Add single quotation marks to font name and default arial sans-serif ending
			if ( $option[ 'face' ] == $google_font[ 'name' ] )
				$option[ 'face' ] = "'" . $option[ 'face' ] . "', arial, sans-serif";		
		
		} // END foreach
		
		if ( !@$option["style"] && !@$option["size"] && !@$option["unit"] && !@$option["color"] )
			return 'font-family: '.stripslashes($option["face"]).';'; 
		else
			return 'font:'.$option["style"].' '.$option["size"].$option["unit"].'/'.$em.'em '.stripslashes($option["face"]).';color:'.$option["color"].';';
	}
}

// Output stylesheet and custom.css after custom styling
remove_action( 'wp_head', 'woothemes_wp_head' );
add_action( 'woo_head', 'woothemes_wp_head' );


/*-----------------------------------------------------------------------------------*/
/* Add layout to body_class output */
/*-----------------------------------------------------------------------------------*/
if (!function_exists( 'woo_layout_body_class')) {
	function woo_layout_body_class($classes) {
		
		global $woo_options;
		if (isset($woo_options[ 'woo_site_layout' ])) { $layout = $woo_options[ 'woo_site_layout' ]; } else { $layout = ''; }

		// Set main layout on post or page
		if ( is_singular() ) {
			global $post;
			$single = get_post_meta($post->ID, '_layout', true);
			if ( $single != "" && $single != "layout-default" ) 
				$layout = $single;
		}
		
		// Add layout to $woo_options array for use in theme
		$woo_options[ 'woo_layout' ] = $layout;
		
		// Add classes to body_class() output 
		$classes[] = $layout;
		return $classes;						
					
	}
}

/*-----------------------------------------------------------------------------------*/
/* Featured Slider Settings */
/*-----------------------------------------------------------------------------------*/

add_filter('woo_head', 'woo_slider_options');
function woo_slider_options() { 
	
	global $woo_options;
	
	// check interval is within range
	if ( (isset($woo_options[ 'woo_slider_interval' ]) && $woo_options[ 'woo_slider_interval' ] < 1) || (isset($woo_options[ 'woo_slider_interval' ]) && $woo_options[ 'woo_slider_interval' ] > 10 ) )
		$woo_options[ 'woo_slider_interval' ] = 6;

	// check speed is within range
	if ( isset($woo_options[ 'woo_slider_speed' ]) && $woo_options[ 'woo_slider_speed' ] > 2 )
		$woo_options[ 'woo_slider_speed' ] = 0.6;
	
	if (isset($woo_options[ 'woo_slider' ]) && $woo_options[ 'woo_slider' ] == 'true' && is_home() && !is_paged()): ?>
	
		<script type="text/javascript">
			jQuery(document).ready(function(){
				
				jQuery('#slides').slides({
					preload: true,
					preloadImage: '<?php echo get_template_directory_uri(); ?>/images/loading.png',
					<?php if ($woo_options[ 'woo_slider_autoheight' ] == "true"): ?>
					autoHeight: true,
					<?php endif; ?>
					effect: '<?php echo $woo_options[ 'woo_slider_effect' ]; ?>',
					container: 'slides_container',
					<?php if ($woo_options[ 'woo_slider_random' ] == "true"): ?>			
					randomize: true,
					<?php endif; ?>
					<?php if ($woo_options[ 'woo_slider_hover' ] == "true"): ?>			
					hoverPause: true,
					<?php endif; ?>
					<?php if ($woo_options[ 'woo_slider_auto' ] == "true"): ?>
					play: <?php echo $woo_options[ 'woo_slider_interval' ] * 1000; ?>,
					<?php endif; ?>			
					slideSpeed: <?php echo $woo_options[ 'woo_slider_speed' ] * 1000; ?>,
					fadeSpeed: <?php echo $woo_options[ 'woo_slider_speed' ] * 1000; ?>,
					crossfade: true,
					
					generateNextPrev: false,
					<?php if ($woo_options[ 'woo_slider_pagination' ] == "true"): ?>
					generatePagination: true,
					<?php else: ?>
					generatePagination: false,
					<?php endif; ?>
					animationStart: function( current ){
						jQuery('.slide-content').hide().animate({
							/*opacity:0,*/
							right:-500,
							filter:''
						},200);
					},
					animationComplete: function( current ){
						jQuery('.slide-content').show().animate({
							/*opacity:1,*/
							right:0,
							filter:''
						},300);
					}
						
				});
				
				<?php if ($woo_options[ 'woo_slider_pagination' ] == "true"): ?>
				jQuery( '#slides .pagination' ).wrap( '<div id="slider_pag" />' );
				jQuery( '#slides #slider_pag' ).wrap( '<div id="slider_nav" />' );
				<?php endif; ?>				
								
			});
		</script>
				
	<?php endif;

/*-----------------------------------------------------------------------------------*/
/* Single Portfolio Gallery Settings */
/*-----------------------------------------------------------------------------------*/

} 

add_filter('woo_head', 'woo_portfolio_options');
	function woo_portfolio_options() { 
	global $woo_options;
	if ( is_singular( 'portfolio' ) && $woo_options[ 'woo_portfolio_gallery' ] == 'true' ) { ?>
	
		<script type="text/javascript">
			jQuery(window).load(function(){
			
				jQuery("#loopedSlider").slides({
					preload: true,
					preloadImage: '<?php echo get_template_directory_uri(); ?>/images/loading.png',
					autoHeight: true,
					effect: '<?php echo $woo_options[ 'woo_slider_effect' ]; ?>',
					container: 'slides',
					<?php if ($woo_options[ 'woo_slider_hover' ] == "true"): ?>			
					hoverPause: true,
					<?php endif; ?>
					<?php if ($woo_options[ 'woo_single_auto' ] == "true"): ?>
					play: <?php echo $woo_options[ 'woo_single_interval' ] * 1000; ?>,
					<?php endif; ?>			
					slideSpeed: <?php echo $woo_options[ 'woo_single_speed' ] * 1000; ?>,
					
					crossfade: true,
					generatePagination: false, 
					paginationClass: 'pagination'
				});
			
			});
			

		</script><?php 
	}
	
	
	if ( is_singular( 'portfolio' ) && $woo_options[ 'woo_portfolio_gallery' ] == 'true' ) { ?>
		<script type="text/javascript">
			jQuery(window).load(function(){
			
			});

/*-----------------------------------------------------------------------------------*/
/* Single Portfolio Gallery */
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function() {

	var show_thumbs = 3;
	
    jQuery('#loopedSlider.gallery ul.pagination').jcarousel({
    	visible: show_thumbs,
    	wrap: 'both'
    });
});

		</script>
	<?php }}

/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
?>