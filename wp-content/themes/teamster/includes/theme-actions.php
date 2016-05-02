<?php

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Add custom styling to HEAD
- Add custom typograhpy to HEAD
- Add layout to body_class output
- woo_feedburner_link

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Theme Setup */
/*-----------------------------------------------------------------------------------*/
/**
 * Theme Setup
 *
 * This is the general theme setup, where we add_theme_support(), create global variables
 * and setup default generic filters and actions to be used across our theme.
 *
 * @package WooFramework
 * @subpackage Logic
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */

if ( ! isset( $content_width ) ) $content_width = 640;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support for post thumbnails.
 *
 * To override woothemes_setup() in a child theme, add your own woothemes_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for automatic feed links.
 * @uses add_editor_style() To style the visual editor.
 */

add_action( 'after_setup_theme', 'woothemes_setup' );

if ( ! function_exists( 'woothemes_setup' ) ) {
	function woothemes_setup () {

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		if ( is_child_theme() ) {
			$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );

			define( 'CHILD_THEME_URL', $theme_data['URI'] );
			define( 'CHILD_THEME_NAME', $theme_data['Name'] );
		}

	}
}

/*-----------------------------------------------------------------------------------*/
/* Add Custom Styling to HEAD */
/*-----------------------------------------------------------------------------------*/

add_action( 'woo_head','woo_custom_styling' );			// Add custom styling to HEAD

if (!function_exists( 'woo_custom_styling')) {
	function woo_custom_styling() {

		global $woo_options;

		$output = '';
		// Get options
		$body_color = $woo_options[ 'woo_body_color' ];
		$body_img = $woo_options[ 'woo_body_img' ];
		$body_repeat = $woo_options[ 'woo_body_repeat' ];
		$body_position = $woo_options[ 'woo_body_pos' ];
		$link = $woo_options[ 'woo_link_color' ];
		$hover = $woo_options[ 'woo_link_hover_color' ];
		$button = $woo_options[ 'woo_button_color' ];

		// Add CSS to output
		if ($body_color)
			$output .= 'body {background:'.$body_color.'}' . "\n";

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
		
		if( is_home()){
			//Post and portfolio date backgrounds
			//.author-posts .author-post-meta .date 
			$posts_date = $woo_options[ 'woo_date_posts_color' ];
			$portfolio_date = $woo_options[ 'woo_date_portfolio_color' ];
			
			if($posts_date){
				$output .= '.author-posts .author-post-meta .date_post {background:'.$posts_date.'}' . "\n";
			}
			
			if($portfolio_date){
				$output .= '.author-posts .author-post-meta .date_portfolio {background:'.$portfolio_date.'}' . "\n";
			}
			
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

add_action( 'woo_head','woo_custom_typography' );			// Add custom typography to HEAD

if (!function_exists( 'woo_custom_typography')) {
	function woo_custom_typography() {

		// Get options
		global $woo_options;

		// Reset
		$output = '';

		// Add Text title and tagline if text title option is enabled
		if ( $woo_options[ 'woo_texttitle' ] == "true" ) {

			if ( $woo_options[ 'woo_font_site_title' ] )
				$output .= '#logo .site-title a {'.woo_generate_font_css($woo_options[ 'woo_font_site_title' ]).'}' . "\n";
			if ( $woo_options[ 'woo_tagline' ] == "true" AND $woo_options[ 'woo_font_tagline' ] )
				$output .= '#logo .site-description {'.woo_generate_font_css($woo_options[ 'woo_font_tagline' ]).'}' . "\n";
		}

		if ( $woo_options[ 'woo_typography' ] == "true") {

			if ( $woo_options[ 'woo_font_body' ] )
				$output .= 'body { '.woo_generate_font_css($woo_options[ 'woo_font_body' ], '1.5').' }' . "\n";

			if ( $woo_options[ 'woo_font_nav' ] )
				$output .= '#navigation, #navigation .nav a { '.woo_generate_font_css($woo_options[ 'woo_font_nav' ], '1.4').' }' . "\n";

			if ( $woo_options[ 'woo_font_post_title' ] )
				$output .= '.post .title { '.woo_generate_font_css($woo_options[ 'woo_font_post_title' ]).' }' . "\n";

			if ( $woo_options[ 'woo_font_post_meta' ] )
				$output .= '.post-meta { '.woo_generate_font_css($woo_options[ 'woo_font_post_meta' ]).' }' . "\n";

			if ( $woo_options[ 'woo_font_post_entry' ] )
				$output .= '.entry, .entry p { '.woo_generate_font_css($woo_options[ 'woo_font_post_entry' ], '1.5').' } h1, h2, h3, h4, h5, h6 { font-family: '.stripslashes($woo_options[ 'woo_font_post_entry' ]['face']).', arial, sans-serif; }'  . "\n";

			if ( $woo_options[ 'woo_font_widget_titles' ] )
				$output .= '.widget h3 { '.woo_generate_font_css($woo_options[ 'woo_font_widget_titles' ]).' }'  . "\n";

		// Add default typography Google Font
		} else {

			// Set default font face
			$woo_options['woo_default_face_1'] = array('face' => 'Droid Sans');
			
			// Output default font face
			$output .= 'body, .entry, .entry p, .post-meta, .nav li ul  { '.woo_generate_font_css($woo_options['woo_default_face_1']).' }' . "\n";			

			/*$woo_options['woo_default_face_2'] = array('face' => 'Droid Serif');
			$output .= 'h1, h2, h3, h4, h5, h6, .post .title, .page .title, .archive_header, .post .post-date { '.woo_generate_font_css($woo_options['woo_default_face_2']).' }' . "\n";*/	
		

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

add_filter( 'body_class','woo_layout_body_class' );		// Add layout to body_class output

if (!function_exists( 'woo_layout_body_class')) {
	function woo_layout_body_class($classes) {

		global $woo_options;
		$layout = $woo_options[ 'woo_site_layout' ];

		// Set main layout on post or page
		if ( is_singular() ) {
			global $post;
			$single = get_post_meta($post->ID, '_layout', true);
			if ( $single != "" AND $single != "layout-default" )
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
/* woo_feedburner_link() */
/*-----------------------------------------------------------------------------------*/
/**
 * woo_feedburner_link()
 *
 * Replace the default RSS feed link with the Feedburner URL, if one
 * has been provided by the user.
 *
 * @package WooFramework
 * @subpackage Filters
 */

add_filter( 'feed_link', 'woo_feedburner_link', 10 );

function woo_feedburner_link ( $output, $feed = null ) {

	global $woo_options;

	$default = get_default_feed();

	if ( ! $feed ) $feed = $default;

	if ( $woo_options[ 'woo_feed_url' ] && ( $feed == $default ) && ( ! stristr( $output, 'comments' ) ) ) $output = esc_url( $woo_options[ 'woo_feed_url' ] );

	return $output;

} // End woo_feedburner_link()

/*-----------------------------------------------------------------------------------*/
/* Add slider options */
/*-----------------------------------------------------------------------------------*/

add_filter('woo_head', 'woo_slider_options');
function woo_slider_options() { 
	
	global $woo_options;
	
	if ($woo_options['woo_author_sorter'] == 'true' && is_home() && !is_paged()): ?>
	
		<script type="text/javascript">
			jQuery(window).load(function(){
				
				jQuery('#author-slides').slides({
					preload: true,
					container: "author-slides-container",
					paginationClass: 'pagination',
					generatePagination: false,
					autoHeight: true
				});
											
			});
		</script>
		
	<?php endif;

	if ($woo_options['woo_featured'] == 'true' && is_home() && !is_paged()): ?>
		
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('#slides').slides({
					crossfade: true,
					preload: true,
					effect: '<?php echo $woo_options['woo_slider_effect']; ?>',				
					<?php if ($woo_options['woo_slider_auto'] == "true"): ?>
					play: <?php echo $woo_options['woo_slider_interval'] * 1000; ?>,
					<?php endif; ?>				
					<?php if ($woo_options['woo_slider_hover'] == "true"): ?>			
					hoverPause: true,
					<?php endif; ?>
					container: '#slides_container',
					slideSpeed: <?php echo $woo_options['woo_slider_speed'] * 1000; ?>,
					generatePagination: false
				});
			});
		</script>
		
	<?php endif;

}

/*-----------------------------------------------------------------------------------*/
/* Add 'author' body class to Team Page Template */
/*-----------------------------------------------------------------------------------*/

add_filter('body_class','woo_special_body_classes');
function woo_special_body_classes($classes) {
		
	if (is_page_template('template-team.php')) {
		$classes[] = 'author';
	}

	return $classes;
	
}

/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
?>