<?php 

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

1. Add specific IE hacks to HEAD
2. Add custom styling to HEAD
3. Add custom typograhpy to HEAD
4. Add theme specific actions


-----------------------------------------------------------------------------------*/


add_action('wp_head','woo_IE_head');					// Add specific IE styling/hacks to HEAD
add_action('woo_head','woo_custom_styling');			// Add custom styling to HEAD
add_action('woo_head','woo_custom_typography');			// Add custom typography to HEAD


/*-----------------------------------------------------------------------------------*/
/* 1. Add specific IE hacks to HEAD */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_IE_head')) {
	function woo_IE_head() {
?>
<!--[if IE 6]>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/pngfix.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/menu.js"></script>
<![endif]-->	
<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* 2. Add Custom Styling to HEAD */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_custom_styling')) {
	function woo_custom_styling() {
	
		global $woo_options;
		
		$output = '';
		// Get options
		$body_color = $woo_options['woo_body_color'];
		$body_img = $woo_options['woo_body_img'];
		$body_repeat = $woo_options['woo_body_repeat'];
		$body_position = $woo_options['woo_body_pos'];
		$link = $woo_options['woo_link_color'];
		$hover = $woo_options['woo_link_hover_color'];
		$button = $woo_options['woo_button_color'];
			
		// Add CSS to output
		if ($body_color)
			$output .= '#wrapper, #slider-bg-shadow {background:'.$body_color.'}' . "\n";
			
		if ($body_img)
			$output .= '#wrapper, #slider-bg-shadow {background-image:url('.$body_img.')}' . "\n";

		if ($body_img && $body_repeat && $body_position)
			$output .= '#wrapper, #slider-bg-shadow {background-repeat:'.$body_repeat.'}' . "\n";

		if ($body_img && $body_position)
			$output .= '#wrapper, #slider-bg-shadow {background-position:'.$body_position.'}' . "\n";

		if ($link)
			$output .= 'a:link, a:visited {color:'.$link.'}' . "\n";

		if ($hover)
			$output .= 'a:hover, .post-more a:hover, .post-meta a:hover, .post p.tags a:hover {color:'.$hover.'}' . "\n";

		if ($button) {
			$output .= 'a.button, a.comment-reply-link, #commentform #submit, #contact-page .submit, #connect .newsletter-form .submit {background:'.$button.';border-color:'.$button.'}' . "\n";
			$output .= 'a.button:hover, a.button.hover, a.button.active, a.comment-reply-link:hover, #commentform #submit:hover, #contact-page .submit:hover, #connect .newsletter-form .submit {background:'.$button.';opacity:0.9;}' . "\n";
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
/* 3. Add custom typograhpy to HEAD */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_custom_typography')) {
	function woo_custom_typography() {
	
		// Get options
		global $woo_options;
				
		// Reset	
		$output = '';
		
		// Add Text title and tagline if text title option is enabled
		if ( $woo_options['woo_texttitle'] == "true" ) {		
			
			if ( $woo_options['woo_font_site_title'] )
				$output .= '#logo .site-title a {'.woo_generate_font_css($woo_options['woo_font_site_title']).'}' . "\n";	
			if ( $woo_options['woo_font_tagline'] )
				$output .= '#logo .site-description {'.woo_generate_font_css($woo_options['woo_font_tagline']).'}' . "\n";	
		}

		if ( $woo_options['woo_typography'] == "true") {
			
			if ( $woo_options['woo_font_body'] )
				$output .= 'body { '.woo_generate_font_css($woo_options['woo_font_body'], '1.5').' }' . "\n";	

			if ( $woo_options['woo_font_nav'] )
				$output .= '#navigation, #navigation .nav a { '.woo_generate_font_css($woo_options['woo_font_nav'], '1.4').' }' . "\n";	

			if ( $woo_options['woo_font_post_title'] )
				$output .= '.post .title, #latest-blog-posts a.title { '.woo_generate_font_css($woo_options['woo_font_post_title']).' }' . "\n";	
		
			if ( $woo_options['woo_font_post_meta'] )
				$output .= '.post-meta, #latest-blog-posts .post-meta { '.woo_generate_font_css($woo_options['woo_font_post_meta']).' }' . "\n";	

			if ( $woo_options['woo_font_post_entry'] )
				$output .= '.entry, .entry p { '.woo_generate_font_css($woo_options['woo_font_post_entry'], '1.5').' } h1, h2, h3, h4, h5, h6 { font-family: '.stripslashes($woo_options['woo_font_post_entry']['face']).', sans-serif; }'  . "\n";	

			if ( $woo_options['woo_font_widget_titles'] )
				$output .= '.widget h3 { '.woo_generate_font_css($woo_options['woo_font_widget_titles']).' }'  . "\n";	
				
		// Add default typography Google Font
		} else {
		
			$woo_options['woo_just_face'] = array('face' => 'Droid Sans');
			
			$output .= 'h1, h2, h3, h4, h5, h6, .widget h3, .post .title, .slide-nav li span.title, .slide a.btn, #copyright span, .nav-entries { '.woo_generate_font_css($woo_options['woo_just_face']).' }' . "\n";			
		}
		
		// Output styles
		if (isset($output) && $output != '') {
		
			// Enable Google Fonts stylesheet in HEAD
			if (function_exists('woo_google_webfonts')) woo_google_webfonts();
			
			$output = "\n<!-- Woo Custom Typography -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
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

/*-----------------------------------------------------------------------------------*/
/* 4. Add theme specific actions */
/*-----------------------------------------------------------------------------------*/

add_filter('body_class','woo_classes');
function woo_classes($classes) {

	global $woo_options;
	
	if ($woo_options['woo_slider'] == 'true' && is_home() && !is_paged()) {
			$classes[] = 'woo-slider';
	}

	return $classes;

}

add_filter('woo_head', 'woo_slider_options');
function woo_slider_options() { 
	
	global $woo_options;
	
	if ($woo_options['woo_slider'] == 'true' && is_home() && !is_paged()): ?>
	
		<script type="text/javascript">
	<!--//--><![CDATA[//><!--
			jQuery(function(){
			
				/* Determine whether or not to display the prev/next buttons, based on the pager width.
				------------------------------------------------------------------------------------------*/
			
				// Setup default variables.
				var widthOfLIs = 0;
				var pagerWidth = 0;
				
				if ( jQuery('#slides .pagination').length ) {
				
					// Get the width of the pagination container.	
					pagerWidth = jQuery('#slides .pagination').css('width');
					
					// Remove the "px" from the returned value.
					pagerWidth = pagerWidth.replace( 'px', '' );
					
					// Get the width of all LIs in the pager.
					jQuery('#slides .pagination li').each( function () {
					
						var LIwidth = jQuery(this).css('width');
						
						// Remove the "px" from the returned value.
						LIwidth = LIwidth.replace( 'px', '' );
						
						widthOfLIs += parseInt( LIwidth );
					
					});
				
				} // End IF Statement
				
				var carouselArgs = {
				
					buttonNextHTML: null,
					buttonPrevHTML: null
				
				};
				
				if ( ( widthOfLIs > pagerWidth ) && ( pagerWidth > 0 ) ) {
				
					carouselArgs = {};			
					
				} // End IF Statement
			
				jQuery('#slides').slides({
					autoHeight: true,
					effect: '<?php echo $woo_options['woo_slider_effect']; ?>',
					container: 'slides_container',
					<?php if ($woo_options['woo_slider_crossfade'] == "true"): ?>			
					crossfade: true,
					<?php endif; ?>
					<?php if ($woo_options['woo_slider_hover'] == "true"): ?>			
					hoverPause: true,
					pause: <?php echo $woo_options['woo_slider_interval']; ?>,
					<?php endif; ?>
					<?php if ($woo_options['woo_slider_auto'] == "true"): ?>
					play: <?php echo $woo_options['woo_slider_interval']; ?> * 1000,
					<?php endif; ?>			
					slideSpeed: <?php echo $woo_options['woo_slider_speed']; ?> * 1000,
					generateNextPrev: false,
					generatePagination: false
				});
				
				jQuery('#slides .pagination ul').jcarousel( carouselArgs );
				
			});
	//-->!]]>
		</script>
		
		<?php if ($woo_options['woo_slider_navigation'] == 'true'): ?>
		<style type="text/css">
		.slide-nav li { width: <?php echo $woo_options['woo_slider_nav_width']; ?>px; }
		</style>
		<?php endif; ?>
		
	<?php endif;

}


// Output stylesheet and custom.css after custom styling
remove_action('wp_head', 'woothemes_wp_head');
add_action('woo_head', 'woothemes_wp_head');

/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
?>