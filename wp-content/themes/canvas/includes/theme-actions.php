<?php
	$woo_options = get_option( 'woo_options' );
	
/*------------------------------------------------------------------------------------

TABLE OF CONTENTS

- Theme Setup
- Woo Conditionals
- Add custom styling
- Add layout to body_class output
- WooSlider Setup
- WooSlider Magazine template
- Navigation
- Post More
- Video Embed
- Single Post Author
- Yoast Breadcrumbs
- Subscribe & Connect
- Optional Top Navigation (WP Menus)
- Footer Widgetized Areas
- Add customisable footer areas
- Add customisable post meta
- Add Post Thumbnail to Single posts on Archives
- Post Inside After
- Modify the default "comment" form field.
- Add theme default comment form fields.
- Add theme default comment form arguments.
- Activate shortcode compatibility in our new custom areas.
- woo_content_templates_magazine()
- woo_feedburner_link()
- Help WooTumblog to recognise if it's on the "Magazine" page template

------------------------------------------------------------------------------------*/

add_action( 'wp_head','woo_custom_styling', 10 );						// Add custom styling
add_filter( 'body_class','woo_layout_body_class', 10 );					// Add layout to body_class output
add_action( 'woo_head','woo_slider', 10 );								// WooSlider Setup
add_action( 'woo_header_after','woo_nav', 10 );							// Navigation
add_action( 'woo_nav_inside','woo_nav_subscribe', 10 );					// Subscribe links in navigation
add_action( 'woo_head', 'woo_conditionals', 10 );						// Woo Conditionals
add_action( 'wp_head', 'woo_author', 10 );								// Author Box
add_action( 'woo_post_after', 'woo_postnav', 10 );						// Single post navigation
add_action( 'wp_head', 'woo_google_webfonts', 10 );						// Add Google Fonts output to HEAD			

if ( isset( $woo_options['woo_breadcrumbs_show'] ) && $woo_options['woo_breadcrumbs_show'] == 'true' ) {
	add_action( 'woo_loop_before', 'woo_breadcrumbs', 10 );				// Breadcrumbs
} // End IF Statement

add_action( 'wp_head', 'woo_subscribe_connect_action', 10 );			// Subscribe & Connect
add_action( 'woo_top', 'woo_top_navigation', 10 );						// Optional Top Navigation (WP Menus)

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
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses add_editor_style() To style the visual editor.
 */

add_action( 'after_setup_theme', 'woothemes_setup' );

if ( ! function_exists( 'woothemes_setup' ) ) {
	function woothemes_setup () {
	
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
	
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
	
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		
	} // End woothemes_setup()
} // End IF Statement

/*-----------------------------------------------------------------------------------*/
/* Woo Conditinals */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_conditionals' ) ) {
	function woo_conditionals() { 
	
		// Video Embed
		if( is_single() && ( get_post_type() != 'portfolio' ) ) { 
			add_action( 'woo_post_inside_before', 'canvas_get_embed' );
		} 
	
		// Post More
		if ( ! is_singular() && ! is_404() || is_page_template( 'template-blog.php' ) || is_page_template( 'template-magazine.php' ) ) {
			add_action( 'woo_post_inside_after', 'woo_post_more' );					  
		}
		
		// Tumblog Content
		if ( get_option( 'woo_woo_tumblog_switch' ) == 'true' ) {
			add_action( 'woo_tumblog_content_before', 'woo_tumblog_content' );
			add_action( 'woo_tumblog_content_after', 'woo_tumblog_content' );
		}
					
	}
}


/*-----------------------------------------------------------------------------------*/
/* // Add custom styling */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_custom_styling' ) ) {
function woo_custom_styling() {

	global $woo_options;
	$output = '';
			
	// Logo
	if ( !$woo_options['woo_logo'] )
		$output .= '#logo .site-title, #logo .site-description { display:block; }' . "\n";

	// Styling options output in header
	if ( isset( $woo_options['woo_style_disable'] ) && $woo_options['woo_style_disable'] != 'true' ) :

		// Layout styling
		$bg = $woo_options['woo_style_bg'];
		$bg_image = $woo_options['woo_style_bg_image'];
		$bg_image_repeat = $woo_options['woo_style_bg_image_repeat'];		
		$border_top = $woo_options['woo_border_top'];
		$border_general = $woo_options['woo_style_border'];
	
		$body = '';
		if ($bg)
			$body .= 'background-color:'.$bg.';';
		if ($bg_image)
			$body .= 'background-image:url('.$bg_image.');';
		if ($bg_image_repeat)
			$body .= 'background-repeat:'.$bg_image_repeat.';background-position:top center;';
		if ($border_top && $border_top['width'] >= 0)
			$body .= 'border-top:'.$border_top["width"].'px '.$border_top["style"].' '.$border_top["color"].';';
	
		if ( $body != '' )
			$output .= 'body {'. $body . '}'. "\n";
	
		if ( $border_general )
			$output .= 'hr, .entry img, img.thumbnail, .entry .wp-caption, #footer-widgets, #comments, #comments .comment.thread-even, #comments ul.children li, .entry h1{border-color:'. $border_general . '}'. "\n";
			
	
		// General styling
		$link = $woo_options['woo_link_color'];
		$hover = $woo_options['woo_link_hover_color'];
		$button = $woo_options['woo_button_color'];
	
		if ($link)
			$output .= 'a:link, a:visited {color:'.$link.'}' . "\n";
		if ($hover)
			$output .= 'a:hover, .post-more a:hover, .post-meta a:hover, .post p.tags a:hover {color:'.$hover.'}' . "\n";
		if ($button)
			$output .= '.button, .reply a {background-color:'.$button.'}' . "\n";
			
		// Header styling		
		$header_bg = $woo_options['woo_header_bg'];	
		$header_bg_image = $woo_options['woo_header_bg_image'];			
		$header_bg_image_repeat = $woo_options['woo_header_bg_image_repeat'];		
		$header_border = $woo_options['woo_header_border'];
		$header_margin_top = $woo_options['woo_header_margin_top'];			
		$header_margin_bottom = $woo_options['woo_header_margin_bottom'];			
		$header_padding_top = $woo_options['woo_header_padding_top'];			
		$header_padding_bottom = $woo_options['woo_header_padding_bottom'];			
		$header_padding_left = $woo_options['woo_header_padding_left'];			
		$header_padding_right = $woo_options['woo_header_padding_right'];					
		$font_logo = $woo_options['woo_font_logo'];	
		$font_desc = $woo_options['woo_font_desc'];	

		$header_css = '';
		if ( $header_bg )
			$header_css .= 'background-color:'.$header_bg.';';	
		if ( $header_bg_image )
			$header_css .= 'background-image:url('.$header_bg_image.');';	
		if ( $header_bg_image_repeat )
			$header_css .= 'background-repeat:'.$header_bg_image_repeat.';background-position:top center;';
		if ( $header_margin_top <> '' || $header_margin_bottom <> '' )
			$header_css .= 'margin-top:'.$header_margin_top.'px;margin-bottom:'.$header_margin_bottom.'px;';	
		if ( $header_padding_top <> '' || $header_padding_bottom <> '' )
			$header_css .= 'padding-top:'.$header_padding_top.'px;padding-bottom:'.$header_padding_bottom.'px;';	
		if ( $header_border && $header_border['width'] >= 0)
			$header_css .= 'border:'.$header_border["width"].'px '.$header_border["style"].' '.$header_border["color"].';';
		if ( $header_border && $header_border['width'] > 0) {
			$width = get_option('woo_layout_width') - $header_border['width']*2;
			if ( $width > 0 ) 
				$header_css .= 'width:'.$width.'px;';
		}
		if ( $header_css != '' )
			$output .= '#header {'. $header_css . '}'. "\n";
			
		if ( $header_padding_left <> '' )
			$output .= '#logo {padding-left:'.$header_padding_left.'px;}';
		if ( $header_padding_right <> '' )
			$output .= '#topad {padding-right:'.$header_padding_right.'px;}'. "\n";
		if ( $font_logo )
			$output .= '#logo .site-title a {' . woo_generate_font_css( $font_logo ) . '}' . "\n";	
		if ( $font_desc )
			$output .= '#logo .site-description {' . woo_generate_font_css( $font_desc ) . '}' . "\n";	
		
		
		// Boxed styling
		$boxed = $woo_options['woo_layout_boxed'];
		$box_bg = $woo_options['woo_style_box_bg'];
		$box_margin_top = $woo_options['woo_box_margin_top'];
		$box_margin_bottom = $woo_options['woo_box_margin_bottom']; 
		$box_border_tb = $woo_options['woo_box_border_tb'];
		$box_border_lr = $woo_options['woo_box_border_lr'];
		$box_border_radius = $woo_options['woo_box_border_radius'];
		$box_shadow = $woo_options['woo_box_shadow'];
	
		$wrapper = '';
		if ($boxed == "true") {
			//$wrapper .= 'margin:0 auto;padding:0 0 20px 0;width:'.get_option('woo_layout_width').';';
			if ( get_option('woo_layout_width') == '940px' )
				$wrapper .= 'padding-left:20px; padding-right:20px;';
			else
				$wrapper .= 'padding-left:30px; padding-right:30px;';			
		}
		if ($boxed == "true" && $box_bg)
			$wrapper .= 'background-color:'.$box_bg.';';
		if ($boxed == "true" && ($box_margin_top || $box_margin_bottom) )
			$wrapper .= 'margin-top:'.$box_margin_top.'px;margin-bottom:'.$box_margin_bottom.'px;';
		if ($boxed == "true" && $box_border_tb["width"] > 0 )
			$wrapper .= 'border-top:'.$box_border_tb["width"].'px '.$box_border_tb["style"].' '.$box_border_tb["color"].';border-bottom:'.$box_border_tb["width"].'px '.$box_border_tb["style"].' '.$box_border_tb["color"].';';
		if ($boxed == "true" && $box_border_lr["width"] > 0 )
			$wrapper .= 'border-left:'.$box_border_lr["width"].'px '.$box_border_lr["style"].' '.$box_border_lr["color"].';border-right:'.$box_border_lr["width"].'px '.$box_border_lr["style"].' '.$box_border_lr["color"].';';
		if ( $boxed == "true" && $box_border_radius )
			$wrapper .= 'border-radius:'.$box_border_radius.';-moz-border-radius:'.$box_border_radius.';-webkit-border-radius:'.$box_border_radius.';';
		if ( $boxed == "true" && $box_shadow == "true" )
			$wrapper .= 'box-shadow: 0px 1px 5px rgba(0,0,0,.3);-moz-box-shadow: 0px 1px 5px rgba(0,0,0,.3);-webkit-box-shadow: 0px 1px 5px rgba(0,0,0,.3);';
	
		if ( $wrapper != '' )
			$output .= '#wrapper {'. $wrapper . '}'. "\n";
	
		// General Typography		
		$font_text = $woo_options['woo_font_text'];	
		$font_h1 = $woo_options['woo_font_h1'];	
		$font_h2 = $woo_options['woo_font_h2'];	
		$font_h3 = $woo_options['woo_font_h3'];	
		$font_h4 = $woo_options['woo_font_h4'];	
		$font_h5 = $woo_options['woo_font_h5'];	
		$font_h6 = $woo_options['woo_font_h6'];	
	
		if ( $font_text )
			$output .= 'body, p { ' . woo_generate_font_css( $font_text, 1.5 ) . ' }' . "\n";	
		if ( $font_h1 )
			$output .= 'h1 { ' . woo_generate_font_css( $font_h1, 1.5 ) . ' }';	
		if ( $font_h2 )
			$output .= 'h2 { ' . woo_generate_font_css( $font_h2, 1.5 ) . ' }';	
		if ( $font_h3 )
			$output .= 'h3 { ' . woo_generate_font_css( $font_h3, 1.5 ) . ' }';	
		if ( $font_h4 )
			$output .= 'h4 { ' . woo_generate_font_css( $font_h4, 1.5 ) . ' }';	
		if ( $font_h5 )
			$output .= 'h5 { ' . woo_generate_font_css( $font_h5, 1.5 ) . ' }';	
		if ( $font_h6 )
			$output .= 'h6 { ' . woo_generate_font_css( $font_h6, 1.5 ) . ' }' . "\n";	
	
		// Post Styling
		$font_post_title = $woo_options['woo_font_post_title'];	
		$font_post_meta = $woo_options['woo_font_post_meta'];	
		$font_post_text = $woo_options['woo_font_post_text'];	
		$font_post_more = $woo_options['woo_font_post_more'];	
		$post_more_border_top = $woo_options['woo_post_more_border_top'];	
		$post_more_border_bottom = $woo_options['woo_post_more_border_bottom'];	
		$post_comments_bg = $woo_options['woo_post_comments_bg'];	
		$post_author_border_top = $woo_options['woo_post_author_border_top'];	
		$post_author_border_bottom = $woo_options['woo_post_author_border_bottom'];	
		$post_author_bg = $woo_options['woo_post_author_bg'];	
		
		if ( $font_post_title )
			$output .= '.post .title, .page .title, .post .title a:link, .post .title a:visited, .page .title a:link, .page .title a:visited {'.woo_generate_font_css( $font_post_title, 1.2 ).'}' . "\n";	
		if ( $font_post_meta )
			$output .= '.post-meta { ' . woo_generate_font_css( $font_post_meta, 1.5 ) . ' }' . "\n";	
		if ( $font_post_text )
			$output .= '.entry, .entry p{ ' . woo_generate_font_css( $font_post_text, 1.5 ) . ' }' . "\n";	
		$post_more_border = '';
		if ( $font_post_more )
			$post_more_border .= 'font:'.$font_post_more["style"].' '.$font_post_more["size"].$font_post_more["unit"].'/1.5em '.stripslashes($font_post_more["face"]).';color:'.$font_post_more["color"].';';	
		if ( $post_more_border_top )
			$post_more_border .= 'border-top:'.$post_more_border_top["width"].'px '.$post_more_border_top["style"].' '.$post_more_border_top["color"].';';	
		if ( $post_more_border_bottom )
			$post_more_border .= 'border-bottom:'.$post_more_border_bottom["width"].'px '.$post_more_border_bottom["style"].' '.$post_more_border_bottom["color"].';';	
		if ( $post_more_border )
		$output .= '.post-more {'.$post_more_border .'}' . "\n";	
	
		if ( $post_comments_bg )
			$output .= '#comments .comment.thread-even {background-color:'.$post_comments_bg.';}' . "\n";

		$post_author = '';
		if ( $post_author_border_top )
			$post_author .= 'border-top:'.$post_author_border_top["width"].'px '.$post_author_border_top["style"].' '.$post_author_border_top["color"].';';	
		if ( $post_author_border_bottom )
			$post_author .= 'border-bottom:'.$post_author_border_bottom["width"].'px '.$post_author_border_bottom["style"].' '.$post_author_border_bottom["color"].';';		
		if ( $post_author_bg )
			$post_author .= 'background-color:'.$post_author_bg;
	
		if ( $post_author )
			$output .= '#post-author, #connect {'.$post_author .'}' . "\n";	
	
		if ( $post_comments_bg )
			$output .= '#comments .comment.thread-even {background-color:'.$post_comments_bg.';}' . "\n";
		
		// Page Nav Styling	
		$pagenav_font = $woo_options['woo_pagenav_font'];	
		$pagenav_bg = $woo_options['woo_pagenav_bg'];	
		$pagenav_border_top = $woo_options['woo_pagenav_border_top'];	
		$pagenav_border_bottom = $woo_options['woo_pagenav_border_bottom'];	
	
		$pagenav_css = '';
		if ( $pagenav_bg )
			$pagenav_css .= 'background-color:'.$pagenav_bg.';';	
		if ( $pagenav_border_top && $pagenav_border_top["width"] > 0 )
			$pagenav_css .= 'border-top:'.$pagenav_border_top["width"].'px '.$pagenav_border_top["style"].' '.$pagenav_border_top["color"].';';	
		if ( $pagenav_border_bottom && $pagenav_border_bottom["width"] > 0 )
			$pagenav_css .= 'border-bottom:'.$pagenav_border_bottom["width"].'px '.$pagenav_border_bottom["style"].' '.$pagenav_border_bottom["color"].';';	
		if ( $pagenav_css != '' )
			$output .= '.nav-entries, .wp-pagenavi, .woo-pagination {'. $pagenav_css . ' padding: 12px 0px; }'. "\n";
		if ( $pagenav_font ) {
			$output .= '.nav-entries a, .wp-pagenavi a:link, .wp-pagenavi a:visited, .wp-pagenavi .current, .wp-pagenavi .on, .wp-pagenavi a:hover, .wp-pagenavi span.extend, .wp-pagenavi span.pages, .woo-pagination { ' . woo_generate_font_css( $pagenav_font ) . ' }' . "\n";	
			$output .= '.wp-pagenavi a:link, .wp-pagenavi a:visited, .woo-pagination a, .woo-pagination a:hover, .wp-pagenavi span.extend, .wp-pagenavi span.pages, .wp-pagenavi span.current {color:'.$pagenav_font["color"].'!important}' . "\n";	
		}
		// Widget Styling
		$widget_font_title = $woo_options['woo_widget_font_title'];	
		$widget_font_text = $woo_options['woo_widget_font_text'];	
		$widget_padding_tb = $woo_options['woo_widget_padding_tb'];
		$widget_padding_lr = $woo_options['woo_widget_padding_lr'];
		$widget_bg = $woo_options['woo_widget_bg'];
		$widget_border = $woo_options['woo_widget_border'];
		$widget_title_border = $woo_options['woo_widget_title_border'];
		$widget_border_radius = $woo_options['woo_widget_border_radius'];
	
		$h3_css = '';
		if ( $widget_font_title )
			$h3_css .= 'font:'.$widget_font_title["style"].' '.$widget_font_title["size"].$widget_font_title["unit"].'/1.5em '.stripslashes($widget_font_title["face"]).';color:'.$widget_font_title["color"].';';	
		if ( $widget_title_border )
			$h3_css .= 'border-bottom:'.$widget_title_border["width"].'px '.$widget_title_border["style"].' '.$widget_title_border["color"].';';	
		if ( isset( $widget_title_border["width"] ) AND $widget_title_border["width"] == 0 )
			$h3_css .= 'margin-bottom:0;';
		
		if ( $h3_css != '' )
			$output .= '.widget h3 {'. $h3_css . '}'. "\n";
		
		if ( $widget_title_border )
			$output .= '.widget_recent_comments li, #twitter li { border-color: '.$widget_title_border["color"].';}'. "\n";
		
		if ( $widget_font_text )
			$output .= '.widget p, .widget .textwidget { ' . woo_generate_font_css( $widget_font_text, 1.5 ) . ' }' . "\n";	
	
		$widget_css = '';
		if ( $widget_font_text )
			$widget_css .= 'font:'.$widget_font_text["style"].' '.$widget_font_text["size"].$widget_font_text["unit"].'/1.5em '.stripslashes($widget_font_text["face"]).';color:'.$widget_font_text["color"].';';	
		if ( $widget_padding_tb || $widget_padding_lr )
			$widget_css .= 'padding:'.$widget_padding_tb.'px '.$widget_padding_lr.'px;';	
		if ( $widget_bg )
			$widget_css .= 'background-color:'.$widget_bg.';';	
		if ( $widget_border["width"] > 0 )
			$widget_css .= 'border:'.$widget_border["width"].'px '.$widget_border["style"].' '.$widget_border["color"].';';	
		if ( $widget_border_radius )
			$widget_css .= 'border-radius:'.$widget_border_radius.';-moz-border-radius:'.$widget_border_radius.';-webkit-border-radius:'.$widget_border_radius.';';	
	
		if ( $widget_css != '' )
			$output .= '.widget {'. $widget_css . '}'. "\n";

		if ( $widget_border["width"] > 0 )
			$output .= '#tabs {border:'.$widget_border["width"].'px '.$widget_border["style"].' '.$widget_border["color"].';}'. "\n";

		// Tabs Widget
		$widget_tabs_bg = $woo_options['woo_widget_tabs_bg'];	
		$widget_tabs_bg_inside = $woo_options['woo_widget_tabs_bg_inside'];	
		$widget_tabs_font = $woo_options['woo_widget_tabs_font'];	
		$widget_tabs_font_meta = $woo_options['woo_widget_tabs_font_meta'];	
		
		if ( $widget_tabs_bg )
			$output .= '#tabs {background-color:'.$widget_tabs_bg.';}'. "\n";
		if ( $widget_tabs_bg_inside )
			$output .= '#tabs .inside, #tabs ul.wooTabs li a.selected, #tabs ul.wooTabs li a:hover {background-color:'.$widget_tabs_bg_inside.';}'. "\n";	
		if ( $widget_tabs_font )
			$output .= '#tabs .inside li a { ' . woo_generate_font_css( $widget_tabs_font, 1.5 ) . ' }'. "\n";	
		if ( $widget_tabs_font_meta )
			$output .= '#tabs .inside li span.meta, #tabs ul.wooTabs li a { ' . woo_generate_font_css( $widget_tabs_font_meta, 1.5 ) . ' }'. "\n";	
	
		//Navigation
		$nav_bg = $woo_options['woo_nav_bg'];	
		$nav_font = $woo_options['woo_nav_font'];	
		$nav_hover = $woo_options['woo_nav_hover'];
		$nav_currentitem = $woo_options['woo_nav_currentitem'];	
		$nav_border_top = $woo_options['woo_nav_border_top'];
		$nav_border_bot = $woo_options['woo_nav_border_bot'];
		$nav_border_lr = $woo_options['woo_nav_border_lr'];
		$nav_border_radius = $woo_options['woo_nav_border_radius'];

		$top_nav_bg = $woo_options['woo_top_nav_bg'];	
		$top_nav_hover = $woo_options['woo_top_nav_hover'];	
		$top_nav_font = $woo_options['woo_top_nav_font'];	
		
		if ( $nav_font )
			$output .= '.nav a, #navigation ul.rss a { ' . woo_generate_font_css( $nav_font ) . ' }' . "\n";	
		if ( $nav_hover )
			$output .= '.nav li a:hover, .nav li.sfHover a.sf-with-ul {background-color:'.$nav_hover.'}' . "\n";
	
		// If we have a hover colour and don't have a current item colour, we use the hover colour as current item colour.
		if ( $nav_currentitem == '' && $nav_hover != '' ) { $nav_currentitem = $nav_hover; }
	
		if ( $nav_currentitem ) {
			$output .= '.nav li.current_page_item a, .nav li.current-menu-ancestor a, .nav li.selected, .nav li.current-menu-item a, .nav li.current_page_parent a { background-color:' . $nav_currentitem . '; }' . "\n";
		}
	
		$navigation_css = '';
		if ( $nav_bg )
			$navigation_css .= 'background-color:'.$nav_bg.';';
		if ( $nav_border_top && $nav_border_top["width"] >= 0 )
			$navigation_css .= 'border-top:'.$nav_border_top["width"].'px '.$nav_border_top["style"].' '.$nav_border_top["color"].';border-bottom:'.$nav_border_bot["width"].'px '.$nav_border_bot["style"].' '.$nav_border_bot["color"].';border-left:'.$nav_border_lr["width"].'px '.$nav_border_lr["style"].' '.$nav_border_lr["color"].';border-right:'.$nav_border_lr["width"].'px '.$nav_border_lr["style"].' '.$nav_border_lr["color"].';';
		if ( $nav_border_radius )
			$navigation_css .= 'border-radius:'.$nav_border_radius.'; -moz-border-radius:'.$nav_border_radius.'; -webkit-border-radius:'.$nav_border_radius.';';	

		if ( $navigation_css != '' )
			$output .= '#navigation {'. $navigation_css . '}'. "\n";
			
		if ( $top_nav_bg )
			$output .= '#top, #top .nav li ul li a:hover { background:'.$top_nav_bg.';}'. "\n";

		if ( $top_nav_hover )
			$output .= '#top .nav a:hover, #top .nav li.current_page_item a, #top .nav li.current_page_parent a,#top .nav li.current-menu-ancestor a,#top .nav li.current-cat a,#top .nav li.current-menu-item a,#top .nav li.sfHover, #top .nav li ul{ background:'.$top_nav_hover.';}'. "\n";

		if ( $top_nav_font )
			$output .= '#top .nav a { ' . woo_generate_font_css( $top_nav_font ) . ' }' . "\n";	
			
	
		// Footer 
		$footer_font = $woo_options['woo_footer_font'];	
		$footer_bg = $woo_options['woo_footer_bg'];	
		$footer_border_top = $woo_options['woo_footer_border_top'];	
		$footer_border_bottom = $woo_options['woo_footer_border_bottom'];	
		$footer_border_lr = $woo_options['woo_footer_border_lr'];	
		$footer_border_radius = $woo_options['woo_footer_border_radius'];	
		
		if ( $footer_font )
			$output .= '#footer, #footer p { ' . woo_generate_font_css( $footer_font ) . ' }' . "\n";	
		$footer_css = '';
		if ( $footer_bg )
			$footer_css .= 'background-color:'.$footer_bg.';';	
		if ( $footer_border_top )
			$footer_css .= 'border-top:'.$footer_border_top["width"].'px '.$footer_border_top["style"].' '.$footer_border_top["color"].';';	
		if ( $footer_border_bottom )
			$footer_css .= 'border-bottom:'.$footer_border_bottom["width"].'px '.$footer_border_bottom["style"].' '.$footer_border_bottom["color"].';';	
		if ( $footer_border_lr )
			$footer_css .= 'border-left:'.$footer_border_lr["width"].'px '.$footer_border_lr["style"].' '.$footer_border_lr["color"].';border-right:'.$footer_border_lr["width"].'px '.$footer_border_lr["style"].' '.$footer_border_lr["color"].';';	
		if ( $footer_border_radius )
			$footer_css .= 'border-radius:'.$footer_border_radius.'; -moz-border-radius:'.$footer_border_radius.'; -webkit-border-radius:'.$footer_border_radius.';';	

		if ( $footer_css != '' )
			$output .= '#footer {'. $footer_css . '}' . "\n";
			
		// Magazine Template
		$slider_magazine_font_title = $woo_options['woo_slider_magazine_font_title'];	
		$slider_magazine_font_excerpt = $woo_options['woo_slider_magazine_font_excerpt'];	
		
		if ( $slider_magazine_font_title )
			$output .= '.magazine #loopedSlider .content h2.title a { ' . woo_generate_font_css( $slider_magazine_font_title ) . ' }'. "\n";	
		if ( $slider_magazine_font_excerpt )
			$output .= '.magazine #loopedSlider .content .excerpt p { ' . woo_generate_font_css( $slider_magazine_font_excerpt, 1.5 ) . ' }'. "\n";	

		// Business Template
		$slider_biz_font_title = $woo_options['woo_slider_biz_font_title'];	
		$slider_biz_font_excerpt = $woo_options['woo_slider_biz_font_excerpt'];	

		if ( $slider_biz_font_title )
			$output .= '.business #loopedSlider .content h2 { ' . woo_generate_font_css( $slider_biz_font_title ) . ' }'. "\n";
			$output .= '.business #loopedSlider .content h2.title a { ' . woo_generate_font_css( $slider_biz_font_title ) . ' }'. "\n";
		if ( $slider_biz_font_excerpt )
			$output .= '#wrapper .business #loopedSlider .content p { ' . woo_generate_font_css( $slider_biz_font_excerpt, 1.5 ) . ' }'. "\n";	
		
		// Archive Header
		$woo_archive_header_font = $woo_options['woo_archive_header_font'];	
		if ( $woo_archive_header_font )
			$output .= '.archive_header { ' . woo_generate_font_css( $woo_archive_header_font ) . 'border-bottom:'.$woo_options['woo_archive_header_border_bottom']["width"].'px '.$woo_options['woo_archive_header_border_bottom']["style"].' '.$woo_options['woo_archive_header_border_bottom']["color"].';}'. "\n";	
		if ( $woo_options['woo_archive_header_disable_rss'] == "true" )
			$output .= '.archive_header .catrss { display:none; }' . "\n";
			
	endif;
	
	// Output styles
	if (isset($output)) {
		$output = "\n<!-- Woo Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n<!-- /Woo Custom Styling -->\n\n";
		echo $output;
	}
		
} 
}

// Returns proper font css output
if ( ! function_exists( 'woo_generate_font_css' ) ) {
	function woo_generate_font_css( $option, $em = '1' ) {

		// Test if font-face is a Google font
		global $google_fonts;
		foreach ( $google_fonts as $google_font ) {

			// Add single quotation marks to font name and default arial sans-serif ending
			if ( $option['face'] == $google_font['name'] )
				$option['face'] = "'" . $option['face'] . "', arial, sans-serif";

		} // END foreach

		if ( !@$option['style'] && !@$option['size'] && !@$option['unit'] && !@$option['color'] )
			return 'font-family: '.stripslashes($option["face"]).';';
		else
			return 'font:'.$option['style'].' '.$option['size'].$option['unit'].'/'.$em.'em '.stripslashes($option['face']).';color:'.$option['color'].';';
	}
}


/*-----------------------------------------------------------------------------------*/
/* Add layout to body_class output */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_layout_body_class' ) ) {
	function woo_layout_body_class( $classes ) {
		global $post, $wp_query, $woo_options;

		$layout = '';
		// Set main layout
		if ( is_singular() ) {
			$layout = get_post_meta( $post->ID, 'layout', true );
			if ( $layout != '' ) {
				$woo_options['woo_layout'] = $layout;
			}
		}
		
		// Add support for WooCommerce "Shop" landing page body CSS class
		if ( class_exists( 'woocommerce' ) && function_exists( 'is_shop' ) && $layout == '' && is_shop() ) {
			$page_id = get_option( 'woocommerce_shop_page_id' );
			$layout = get_post_meta( $page_id, 'layout', true );
			if ( $layout != '' ) {
				$woo_options['woo_layout'] = $layout;
			}
		}
		
		if ( $layout == '' ) {
			$layout = get_option( 'woo_layout' );
				if ( $layout == '' ) 
					$layout = "two-col-left";
		}
		
		// Cater for custom portfolio gallery layout option.
		if ( is_tax( 'portfolio-gallery' ) || is_post_type_archive( 'portfolio' ) ) {
			$portfolio_gallery_layout = get_option( 'woo_portfolio_layout' );
			
			if ( $portfolio_gallery_layout != '' ) { $layout = $portfolio_gallery_layout; }
		}
	
		if ( is_tax( 'portfolio-gallery' ) || is_post_type_archive( 'portfolio' ) || is_page_template( 'template-portfolio.php' ) || ( is_singular() && get_post_type() == 'portfolio' ) ) {
			$classes[] = 'portfolio-component';
		}
	
		// Specify site width
		$width = get_option( 'woo_layout_width' );
		if ( $width == '760px' ) 
			$width = "-760";
		elseif ( $width == '960px' ) 
			$width = "-960";
		elseif ( $width == '880px' ) 
			$width = "-880";
		elseif ( $width == '980px' ) 
			$width = "-980";
		elseif ( $width == '1200px' ) 
			$width = "-1200";
		else 
			$width = "-940";
		
		// Add classes to body_class() output 
		$classes[] = $layout;
		$classes[] = 'width' . $width;
		$classes[] = $layout . $width;
		return $classes;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Woo Slider Setup */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_slider' ) ) {
	function woo_slider( $load_slider_js = false ) {
		global $woo_options;
		
		$load_slider_js = false;
		
		if ( ( is_page_template( 'template-biz.php' ) && isset( $woo_options['woo_slider_biz'] ) && $woo_options['woo_slider_biz'] == 'true' ) || 
			 ( is_page_template( 'template-magazine.php' ) && isset( $woo_options['woo_slider_magazine'] ) && $woo_options['woo_slider_magazine'] == 'true' ) ) { $load_slider_js = true; }
			 
		// Allow child themes/plugins to load the slider JavaScript when they need it.
		$load_slider_js = apply_filters( 'woo_load_slider_js', $load_slider_js );
		
		if ( $load_slider_js != false ) {
		
		// Default slider settings. 
		$defaults = array(
							'autoStart' => 0, 
							'autoHeight' => 'false', 
							'hoverPause' => 'false',
							'containerClick' => 'false', 
							'slideSpeed' => 600, 
							'canAutoStart' => 'false', 
							'next' => 'next', 
							'prev' => 'previous', 
							'container' => 'slides', 
							'generatePagination' => 'false', 
							'crossfade' => 'true', 
							'fadeSpeed' => 600, 
							'effect' => 'slide'
						 );
		
		// Dynamic settings from the "Theme Options" screen.				 
		$args = array();
		
		if ( isset( $woo_options['woo_slider_pagination'] ) && $woo_options['woo_slider_pagination'] == 'true' ) { $args['generatePagination'] = 'true'; }
		if ( isset( $woo_options['woo_slider_effect'] ) && $woo_options['woo_slider_effect'] != '' ) { $args['effect'] = $woo_options['woo_slider_effect']; }
		if ( isset( $woo_options['woo_slider_autoheight'] ) && $woo_options['woo_slider_autoheight'] == 'true' ) { $args['autoHeight'] = 'true'; }
		if ( isset( $woo_options['woo_slider_hover'] ) && $woo_options['woo_slider_hover'] == 'true' ) { $args['hoverPause'] = 'true'; }
		if ( isset( $woo_options['woo_slider_containerclick'] ) && $woo_options['woo_slider_containerclick'] == 'true' ) { $args['containerClick'] = 'true'; }
		if ( isset( $woo_options['woo_slider_speed'] ) && $woo_options['woo_slider_speed'] != '' ) { $args['slideSpeed'] = $woo_options['woo_slider_speed'] * 1000; }
		if ( isset( $woo_options['woo_slider_speed'] ) && $woo_options['woo_slider_speed'] != '' ) { $args['fadeSpeed'] = $woo_options['woo_slider_speed'] * 1000; }
		if ( isset( $woo_options['woo_slider_auto'] ) && $woo_options['woo_slider_auto'] == 'true' ) {
			$args['canAutoStart'] = 'true';
			$args['autoStart'] = $woo_options['woo_slider_interval'] * 1000;
		}
		
		// Merge the arguments with defaults.
		$args = wp_parse_args( $args, $defaults );
		
		// Allow child themes/plugins to filter these arguments.
		$args = apply_filters( 'woo_slider_args', $args );
		
	?>	
	<!-- Woo Slider Setup -->
	<script type="text/javascript">
	jQuery(window).load(function(){
		if ( jQuery( '#loopedSlider .slide' ).length > 1 ) {
		    jQuery( '#loopedSlider' ).slides({
				preload: true,
				preloadImage: '<?php echo get_template_directory_uri(); ?>/images/loading.png',
		        play: <?php echo $args['autoStart']; ?>, 
		        <?php if ( $args['effect'] == 'fade' ) { ?>
		         fadeSpeed: <?php echo $args['fadeSpeed']; ?>, 
		        <?php } else { ?>
		        slideSpeed: <?php echo $args['slideSpeed']; ?>, 
		        <?php } ?>
		        autoHeight: <?php echo $args['autoHeight']; ?>,
		        hoverPause: <?php echo $args['hoverPause']; ?>,
		        bigTarget: <?php echo $args['containerClick']; ?>, 
		        next: '<?php echo $args['next']; ?>', 
		        prev: '<?php echo $args['prev']; ?>', 
		        container: '<?php echo $args['container']; ?>', 
		        effect: '<?php echo $args['effect']; ?>', 
		        crossfade: false, 
		        generatePagination: <?php echo $args['generatePagination']; ?>
		        <?php if ( isset( $args['autoHeight'] ) && ( $args['autoHeight'] == 'true' ) ) { ?>, slidesLoaded: function () { jQuery( '#loopedSlider .slides' ).css( 'height', jQuery( '#loopedSlider .slide:first' ).height() ); } <?php } ?>
		    });
	    
	    	jQuery( '#loopedSlider .pagination' ).wrap( '<div class="pagination-wrap" />' );
	    	
	    } else {
	    	// Hide the next/previous buttons.
	    	jQuery( '#loopedSlider a.next, #loopedSlider a.previous' ).fadeOut();
	    	jQuery( '#loopedSlider .slides' ).fadeIn();
	    	var newHeight = jQuery( '#loopedSlider .slide:first' ).height();
	    	
	    	jQuery( '#loopedSlider .slides, #loopedSlider .container' ).css( 'height', newHeight );
		}
	});
	</script>
	<?php if ( ( isset( $containerClick ) ) && ( $containerClick == 'true' ) ) { ?>
	<style type="text/css">#loopedSlider .container { cursor: pointer; }</style>
	<?php } ?>
	<!-- /Woo Slider Setup -->
	<?php
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Woo Slider Magazine */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_slider_magazine')) {
	function woo_slider_magazine( $args = null ) {
		
		global $woo_options, $wp_query;
		
		// This is where our output will be added.
		$html = '';
		
		// Default slider settings. 
		$defaults = array(
							'id' => 'loopedSlider', 
							'echo' => true, 
							'excerpt_length' => '15', 
							'pagination' => false, 
							'width' => '940', 
							'height' => '350', 
							'order' => 'ASC', 
							'posts_per_page' => '5'
						 );
	
		// Setup width of slider and images
		$width = "610";
		
		$layout = $woo_options['woo_layout'];
		if ( !$layout['woo_layout'] )
			$layout = get_option( 'woo_layout' ); 
		$layout_width = get_option( 'woo_layout_width' );
	
		if ( $layout == "one-col" ) {
	
			if ( $layout_width == '980px' ) { 
				$width = "980";
			} elseif ( $layout_width == '960px' ) {
				$width = "960";
			} elseif ( $layout_width == '880px' ) {
				$width = "880";
			} elseif ( $layout_width == '760px' ) {
				$width = "760";
			} elseif ( $layout_width == '1200px' ) {
				$width = "1200";
			} else {
				$width = "940";
			}
	
		} elseif ( $layout == "two-col-left" || $layout == "two-col-right" || $layout == "two-col-middle" ) {
	
			if ( $layout_width == '980px' ) { 
				$width = "650";
			} elseif ( $layout_width == '960px' ) {
				$width = "630";
			} elseif ( $layout_width == '880px' ) {
				$width = "550";
			} elseif ( $layout_width == '760px' ) {
				$width = "480";
			} elseif ( $layout_width == '1200px' ) {
				$width = "800";
			} else {
				$width = "610";
			}
	
		} elseif ( $layout == "three-col-left" || $layout == "three-col-right" || $layout == "three-col-middle" ) {
	
			if ( $layout_width == '980px' ) { 
				$width = "480";
			} elseif ( $layout_width == '960px' ) {
				$width = "460";
			} elseif ( $layout_width == '880px' ) {
				$width = "420";
			} elseif ( $layout_width == '760px' ) {
				$width = "350";
			} elseif ( $layout_width == '1200px' ) {
				$width = "680";
			} else {
				$width = "440";
			}
	
		} 
	
		// Setup slider tags array
		$slider_tags = explode(',',$woo_options['woo_slider_magazine_tags']); // Tags to be shown
		foreach ($slider_tags as $tags){ 
			$tag = get_term_by( 'name', trim($tags), 'post_tag', 'ARRAY_A' );
			if ( $tag['term_id'] > 0 )
				$tag_array[] = $tag['term_id'];
		}
		if ( empty($tag_array) ) {
			echo '<p class="note">Please setup Featured Slider Tag(s) in your options panel. You must setup tags that are used on active posts.</p>';
			return;
		}
			
		// Setup the slider CSS class.
		$slider_css = '';
		
		if ( @$woo_options['woo_slider_pagination'] == 'true' ) {
			$slider_css = ' class="has-pagination"';
		}
		
		// Setup height of slider.
		$height = $woo_options['woo_slider_magazine_height'];
		if ( $height != '' ) { $defaults['height'] = $height; }
	
		// Setup width of slider and images.
		$layout = get_option('woo_layout');
		$layout_width = get_option('woo_layout_width');
	
		// Setup the number of posts to show.
		$posts_per_page = $woo_options['woo_slider_magazine_entries'];
		if ( $posts_per_page != '' ) { $defaults['posts_per_page'] = $posts_per_page; }
		
		// Setup the excerpt length.
		$excerpt_length = $woo_options['woo_slider_magazine_excerpt_length'];
		if ( $excerpt_length != '' ) { $defaults['excerpt_length'] = $excerpt_length; }
		
		//$width = intval( $layout_width );
		
		if ( $width > 0 && $args['width'] == '' ) { $defaults['width'] = $width; }
	
		// Merge the arguments with defaults.
		$args = wp_parse_args( $args, $defaults );
	
		// Get layout manager information.
		if ( get_option( 'woo_layout_manager_enable' ) == "true" ) {
			$layout_info = Woo_Layout::get_layout_info();
			$woo_layouts = get_option( 'woo_layout_stored_layouts' );
		
			if ( is_array( $layout_info ) && array_key_exists( 'width_main', $layout_info ) && @$woo_options['woo_layout'] != "one-col" ) {
				$args['width'] = $layout_info['gutter'] + $layout_info['width_main'] + $layout_info['gutter'];
			}
		}
				
		if ( ( ( isset($args['width']) ) && ( ( $args['width'] <= 0 ) || ( $args['width'] == '')  ) ) || ( !isset($args['width']) ) ) {	$args['width'] = '100'; }
		if ( ( isset($args['height']) ) && ( $args['height'] <= 0 )  ) { $args['height'] = '100'; }
		
		// Allow child themes/plugins to filter these arguments.
		$args = apply_filters( 'woo_magazine_slider_args', $args );
	
	// Begin setting up HTML output.

	if ( @$woo_options['woo_slider_autoheight'] != 'true' ) {
		 $html .= '<div id="' . $args['id'] . '"' . $slider_css . ' style="height:' . $args['height'] . 'px">' . "\n";
	     $html .= '<div class="container" style="height:' . $args['height'] . 'px">' . "\n";
    } else {
		 $html .= '<div id="' . $args['id'] . '"' . $slider_css . ' style="height:auto;">' . "\n";
	     $html .= '<div class="container" style="height:auto;">' . "\n";
	}
	   
	$saved = $wp_query; query_posts(array('tag__in' => $tag_array, 'showposts' => $args['posts_per_page']));
	
	if ( have_posts() ) : $count = 0;
	
	     if ( @$woo_options['woo_slider_autoheight'] != 'true' )
	         $html .= '<div class="slides" style="height:' . $args['height'] . 'px">' . "\n";
	     else
	         $html .= '<div class="slides">' . "\n";
	       
	        while (have_posts()) : the_post(); global $post; $shownposts[$count] = $post->ID; $count++;
	          
	           $styles = 'width: ' . $args['width'] . 'px;';
				if ( $count >= 2 ) { $styles .= ' display:none;'; }
	
				$url = get_permalink( $post->ID );
				
	            $html .= '<div id="slide-' . $count . '" class="slide" style="' . $styles . '">' . "\n";               
					$html .= '<a href="' . $url . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">' . woo_image('width=' . $args['width'] . '&height=' . $args['height'] . '&link=img&return=true') . '</a>' . "\n";
	                $html .= '<div class="content">' . "\n";              
	                if ( $woo_options['woo_slider_magazine_title'] == 'true' ) {
	                	$html .= '<h2 class="title"><a href="' . $url . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">' . get_the_title( $post->ID ) . '</a></h2>'; }
	                
	                if ( $woo_options['woo_slider_magazine_excerpt'] == 'true' ) {
	                	$html .= '<div class="excerpt"><p>' . woo_text_trim( get_the_excerpt(), $excerpt_length ) . '</p></div>' . "\n";
	                }
	                
	                $html .= '</div>' . "\n";
	
	            $html .= '</div>' . "\n";     
	
	       endwhile; $wp_query = $saved;

		endif; $wp_query = $saved;
	
	    $html .= '</div><!-- /.slides -->' . "\n";
	    $html .= '</div><!-- /.container --> ' . "\n";  
	    
	    $html .= '<a href="#" class="previous"><img src="' . get_template_directory_uri() . '/images/btn-prev-slider.png" alt="&lt;" /></a>' . "\n";
	    $html .= '<a href="#" class="next"><img src="' . get_template_directory_uri() . '/images/btn-next-slider.png" alt="&gt;" /></a>' . "\n";        
	    
	
	$html .= '</div><!-- /#' . $args['id'] . ' -->' . "\n";
	 
    	if ( get_option( 'woo_exclude' ) != $shownposts ) { update_option( "woo_exclude", $shownposts ); } 
	
		if ( $args['echo'] ) {
			echo $html;
		}
		
		return $html;
	
	} // End woo_slider_magazine()
}

/*-----------------------------------------------------------------------------------*/
/* Woo Slider Business */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_slider_biz' ) ) {
	function woo_slider_biz( $args = null ) {
		
		global $woo_options, $post;
		
		// This is where our output will be added.
		$html = '';
		
		// Default slider settings. 
		$defaults = array(
							'id' => 'loopedSlider', 
							'echo' => true, 
							'excerpt_length' => '15', 
							'pagination' => false, 
							'width' => '940', 
							'height' => '350', 
							'order' => 'ASC', 
							'posts_per_page' => '5', 
							'slide_page' => 'all', 
							'use_slide_page' => false
						 );
						 
		// Setup the "Slide Page", if one is set.
		if ( isset( $post->ID ) ) {
			$slide_page = 'all';
			$stored_slide_page = get_post_meta( $post->ID, '_slide-page', true );
			
			if ( $stored_slide_page != '' && $stored_slide_page != 'all' ) {
				$slide_page = $stored_slide_page;
				$defaults['use_slide_page'] = true; // Instruct the slider to apply the necessary conditional.
				$defaults['slide_page'] = $slide_page;
			}
		}
		
		// Setup height of slider.
		$height = $woo_options['woo_slider_biz_height'];
		if ( $height != '' ) { $defaults['height'] = $height; }
	
		// Setup width of slider and images.
		$layout = $woo_options['woo_layout'];
		if ( !$layout )
			$layout = get_option( 'woo_layout' ); 
		$layout_width = get_option('woo_layout_width');
	
		// Setup the number of posts to show.
		$posts_per_page = $woo_options['woo_slider_biz_number'];
		if ( $posts_per_page != '' ) { $defaults['posts_per_page'] = $posts_per_page; }

		// Setup the order of posts.
		$post_order = $woo_options['woo_slider_biz_order'];
		if ( $post_order != '' ) { $defaults['order'] = $post_order; }
		
		// Setup the excerpt length.
		if ( isset($woo_options['woo_slider_biz_excerpt_length']) ) {
			$excerpt_length = $woo_options['woo_slider_biz_excerpt_length'];
			if ( $excerpt_length != '' ) { $defaults['excerpt_length'] = $excerpt_length; }
		} 
		
		$width = intval( $layout_width );
		
		if ( $width > 0 && $args['width'] == '' ) { $defaults['width'] = $width; }
	
		// Merge the arguments with defaults.
		$args = wp_parse_args( $args, $defaults );
		
		if ( ( ( isset($args['width']) ) && ( ( $args['width'] <= 0 ) || ( $args['width'] == '')  ) ) || ( !isset($args['width']) ) ) {	$args['width'] = '100'; }
		if ( ( isset($args['height']) ) && ( $args['height'] <= 0 )  ) { $args['height'] = '100'; }
		
		// Allow child themes/plugins to filter these arguments.
		$args = apply_filters( 'woo_biz_slider_args', $args );
	
		// Setup slider page id's
		$query_args = array(
							'post_type' => 'slide', 
							'order' => $args['order'], 
							'orderby' => 'date', 
							'posts_per_page' => $args['posts_per_page']
						);
		
		if ( $args['use_slide_page'] == true ) {
		
			$query_args['tax_query'] = array( array(
								'taxonomy' => 'slide-page',
								'field' => 'slug',
								'terms' => $args['slide_page']
							) );
		
		}
		
		$slide_query = new WP_Query( $query_args );
		
		if ( ( ! $slide_query->have_posts() ) ) {
			echo '<p class="note">' . __( 'Please add some slider posts using the Slide custom post type.', 'woothemes' ) . '</p>';
			return;
		}
		
		if ( ( $slide_query->found_posts < 1 ) ) {
			echo '<p class="note">' . __( 'Please note that this slider requires 2 or more slides in order to function. Please assign another slide.', 'woothemes' ) . '</p>';
			return;
		}
			
		// Setup the slider CSS class.
		$slider_css = '';
		
		if ( @$woo_options['woo_slider_pagination'] == 'true' ) {
			$slider_css = ' class="has-pagination"';
		}

	// Begin setting up HTML output.
	
	if ( @$woo_options['woo_slider_autoheight'] != 'true' ) {
		 $html .= '<div id="' . $args['id'] . '"' . $slider_css . ' style="height:' . $args['height'] . 'px">' . "\n";
	     $html .= '<div class="container" style="height:' . $args['height'] . 'px">' . "\n";
    } else {
		 $html .= '<div id="' . $args['id'] . '"' . $slider_css . ' style="height:auto;">' . "\n";
	     $html .= '<div class="container" style="height:auto;">' . "\n";
	}

	     
	     if ( @$woo_options['woo_slider_autoheight'] != 'true' )
	         $html .= '<div class="slides" style="height:' . $args['height'] . 'px">' . "\n";
	     else
	         $html .= '<div class="slides">' . "\n";
	                
	       	 if ( $slide_query->have_posts() ) { $count = 0; while ( $slide_query->have_posts() ) { $slide_query->the_post(); global $post; $count++;
	
				$styles = 'width: ' . $args['width'] . 'px;';
				if ( $count >= 2 ) { $styles .= ' display:none;'; }
	
	            $html .= '<div id="slide-' . $count . '" class="slide" style="' . $styles . '">' . "\n";                
	
				$type = get_post_meta( $post->ID, 'image', true );
				
				if ( $type ) {
					$url = get_post_meta( $post->ID, 'url', true );
					
					if ( $url ) {
						$html .= '<a href="' . $url . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">' . woo_image('width=' . $args['width'] . '&height=' . $args['height'] . '&link=img&return=true') . '</a>' . "\n";
					} else {
						$html .= woo_image( 'width=' . $args['width'] . '&height=' . $args['height'] . '&link=img&return=true' );
					}
					
					$html .= '<div class="content">' . "\n";                 
	                
	                if ( $woo_options['woo_slider_biz_title'] == 'true' ) {
	                	if ( $url ) {
		                	$html .= '<div class="title"><h2 class="title"><a href="' . $url . '">' . get_the_title( $post->ID ) . '</a></h2></div>' . "\n";
	                	
	                	} else { 
	                		$html .= '<div class="title"><h2 class="title">' . get_the_title( $post->ID ) . '</h2></div>' . "\n";
	                
	                	}
	                }
	                	$content = get_the_content($post->ID);
						$content = do_shortcode($content);

	                	$html .= '<div class="excerpt">' . wpautop( $content ) . '</div>' . "\n";
	                    $html .= '</div>' . "\n";
	                    
	                } else {
	                
	                	$content = get_the_content($post->ID);
						$content = do_shortcode($content);

	                	$html .= '<div class="entry">' . wpautop( $content ) . '</div>' . "\n";                       
	               
	               }
	
	            $html .= '</div>' . "\n";  
	
	        } // End WHILE Loop
	        
	       } // End IF Statement
	        
	        $html .= '</div><!-- /.slides -->' . "\n";
	    $html .= '</div><!-- /.container --> ' . "\n";  
	    
	    $html .= '<a href="#" class="previous"><img src="' . get_template_directory_uri() . '/images/btn-prev-slider.png" alt="&lt;" /></a>' . "\n";
	    $html .= '<a href="#" class="next"><img src="' . get_template_directory_uri() . '/images/btn-next-slider.png" alt="&gt;" /></a>' . "\n";        
	    
	
	$html .= '</div><!-- /#' . $args['id'] . ' -->' . "\n";
	
		if ( $args['echo'] ) {
			echo $html;
		}
		
		return $html;
	
	} // End woo_slider_biz()
}

/*-----------------------------------------------------------------------------------*/
/* Navigation */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_nav' ) ) {
	function woo_nav() { 
		global $woo_options;
		woo_nav_before();
?>
	<div id="navigation" class="col-full">
		<?php woo_nav_inside(); ?>
		<?php
		if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary-menu' ) ) {
			wp_nav_menu( array( 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
		} else {
		?>
		<ul id="main-nav" class="nav fl">
			<?php 
			if ( get_option( 'woo_custom_nav_menu' ) == 'true' ) {
				if ( function_exists( 'woo_custom_navigation_output' ) )
					woo_custom_navigation_output( "name=Woo Menu 1" );
	
			} else { ?>
				
				<?php if ( is_page() ) $highlight = "page_item"; else $highlight = "page_item current_page_item"; ?>
				<li class="<?php echo $highlight; ?>"><a href="<?php echo home_url( '/' ); ?>"><?php _e( 'Home', 'woothemes' ); ?></a></li>
				<?php wp_list_pages( 'sort_column=menu_order&depth=6&title_li=&exclude=' ); ?>
			<?php } ?>
		</ul><!-- /#nav -->
		<?php } ?>	
	</div><!-- /#navigation -->
<?php
		woo_nav_after();
	} // End woo_nav()
}

/*-----------------------------------------------------------------------------------*/
/* Add subscription links to the navigation bar */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'woo_nav_subscribe' ) ) {
	function woo_nav_subscribe() {
		global $woo_options;
		
		if ( ( isset( $woo_options['woo_nav_rss'] ) ) && ( $woo_options['woo_nav_rss'] == 'true' ) ) { ?>
		<ul class="rss fr">
			<?php if ( ( isset( $woo_options['woo_subscribe_email'] ) ) && ( $woo_options['woo_subscribe_email'] ) ) { ?>
			<li class="sub-email"><a href="<?php echo $woo_options['woo_subscribe_email'] ?>" target="_blank"><?php _e( 'Subscribe by Email', 'woothemes' ); ?></a></li>
			<?php } ?>
			<li class="sub-rss"><a href="<?php if ( $woo_options['woo_feed_url'] ) { echo $woo_options['woo_feed_url']; } else { echo get_bloginfo_rss( 'rss2_url' ); } ?>"><?php _e( 'Subscribe to RSS', 'woothemes' ); ?></a></li>
		</ul>
		<?php }
	} // End woo_nav_subscribe()
}

/*-----------------------------------------------------------------------------------*/
/* Post More  */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'woo_post_more' ) ) {
	function woo_post_more() {
		
		if ( get_option( 'woo_disable_post_more' ) != 'true' ) {
		
		$html = '';
		
		if ( get_option('woo_post_content') == 'excerpt' ) { $html .= '[view_full_article after=" <span class=\'sep\'>&bull;</span>"] '; }
		$html .= '[post_comments]';
		
		$html = apply_filters( 'woo_post_more', $html );
		
			if ( $html != '' ) {
	?>
		<div class="post-more">   
			<?php
				echo $html;
			?>
		</div>                        	
	<?php
			}
		}
	} // End woo_post_more()
}

/*-----------------------------------------------------------------------------------*/
/* Video Embed  */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'canvas_get_embed' ) ) {
	function canvas_get_embed() { 
		global $woo_options;
		
		// Setup height & width of embed
		$width = "610";
		$height = "343";
		$layout = $woo_options['woo_layout'];
		$layout_width = get_option( 'woo_layout_width' );
	
		if ( $layout == "one-col" ) {
	
			if ( $layout_width == '980px' ) { 
				$width = "980";
				$height = '613';
			} elseif ( $layout_width == '960px' ) {
				$width = "960";
				$height = '600';
			} elseif ( $layout_width == '880px' ) {
				$width = "880";
				$height = '550';
			} elseif ( $layout_width == '760px' ) {
				$width = "760";
				$height = '475';
			} elseif ( $layout_width == '1200px' ) {
				$width = "1200";
				$height = '750';
			} else {
				$width = "940";
				$height = '588';
			}
	
		} elseif ( $layout == "two-col-left" || $layout == "two-col-right" || $layout == "two-col-middle" ) {
	
			if ( $layout_width == '980px' ) { 
				$width = "650";
				$height = "365";
			} elseif ( $layout_width == '960px' ) {
				$width = "630";
				$height = "354";
			} elseif ( $layout_width == '880px' ) {
				$width = "550";
				$height = "309";
			} elseif ( $layout_width == '760px' ) {
				$width = "480";
				$height = "270";
			} elseif ( $layout_width == '1200px' ) {
				$width = "800";
				$height = "450";
			} else {
				$width = "610";
			}
	
		} elseif ( $layout == "three-col-left" || $layout == "three-col-right" || $layout == "three-col-middle" ) {
	
			if ( $layout_width == '980px' ) { 
				$width = "480";
				$height = "270";
			} elseif ( $layout_width == '960px' ) {
				$width = "460";
				$height = "259";
			} elseif ( $layout_width == '880px' ) {
				$width = "420";
				$height = "236";
			} elseif ( $layout_width == '760px' ) {
				$width = "350";
				$height = "197";
			} elseif ( $layout_width == '1200px' ) {
				$width = "680";
				$height = "380";
			} else {
				$width = "440";
				$height = "247";
			}
	
		} 
	
		$embed = woo_embed( 'width=' . $width . '&height=' . $height );
	
		if ( $embed != '' ) {
	?>
	
	<div class="post-embed">
		<?php echo $embed; ?>
	</div><!-- /.post-embed -->
	
	<?php 
		}
	} 
}


/*-----------------------------------------------------------------------------------*/
/* Author Box */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_author' ) ) {
	function woo_author() { 
		
		// Author box single post page 
		if ( is_single() && get_option( 'woo_disable_post_author' ) != 'true' )
			add_action( 'woo_post_inside_after', 'woo_author_box', 10 );				

		// Author box author page
		elseif ( is_author() )
			add_action( 'woo_loop_before', 'woo_author_box', 10 );				
	
	}
}


/*-----------------------------------------------------------------------------------*/
/* Single Post Author */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_author_box' ) ) {
	function woo_author_box() { 
		global $post;
		$author_id=$post->post_author;
?>
<div id="post-author">
	<div class="profile-image"><?php echo get_avatar( $author_id, '80' ); ?></div>
	<div class="profile-content">
		<h4><?php printf( esc_attr__( 'About %s', 'woothemes' ), get_the_author_meta( 'display_name', $author_id ) ); ?></h4>
		<?php echo get_the_author_meta( 'description', $author_id ); ?>
		<?php if (is_singular()) : ?>
		<div class="profile-link">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ); ?>">
				<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'woothemes' ), get_the_author_meta( 'display_name', $author_id ) ); ?>
			</a>
		</div><!-- #profile-link	-->
		<?php endif; ?>
	</div>
	<div class="fix"></div>
</div>
<?php 
	}
}


/*-----------------------------------------------------------------------------------*/
/* Yoast Breadcrumbs */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('_dep_woo_breadcrumbs') ) { 
	function _dep_woo_breadcrumbs() {
		if ( function_exists('yoast_breadcrumb') ) { 
			yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>');
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/* Subscribe & Connect  */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_subscribe_connect_action' ) ) {
	function woo_subscribe_connect_action() { 
		
		// single post page 
		if ( is_single() && get_option('woo_connect') == "true" )
			add_action('woo_post_inside_after', 'woo_subscribe_connect');				

	}
}


/*-----------------------------------------------------------------------------------*/
/* Optional Top Navigation (WP Menus)  */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'woo_top_navigation' ) ) {
	function woo_top_navigation() {

		if ( function_exists('has_nav_menu') && has_nav_menu('top-menu') ) { ?>
		
		<div id="top">
			<div class="col-full">
				<?php wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'top-nav', 'menu_class' => 'nav fl', 'theme_location' => 'top-menu' ) ); ?>
			</div>
		</div><!-- /#top -->
		
	    <?php 
    	}
    } 
}

/*-----------------------------------------------------------------------------------*/
/* Footer Widgetized Areas  */
/*-----------------------------------------------------------------------------------*/

add_action( 'woo_footer_top', 'woo_footer_sidebars', 30 );

if ( ! function_exists( 'woo_footer_sidebars' ) ) {
	function woo_footer_sidebars() {
		global $woo_options;
		
		$footer_sidebar_total = 4;
		$has_footer_sidebars = false;
		
		// Check if we have footer sidebars to display.
		for ( $i = 1; $i <= $footer_sidebar_total; $i++ ) {
			if ( woo_active_sidebar( 'footer-' . $i ) && ( $has_footer_sidebars == false ) ) {
				$has_footer_sidebars = true;
			}
		}
		
		// If footer sidebars are available, we're on the "Business" page template and we want to disable them, do so.
		if ( $has_footer_sidebars && is_page_template( 'template-biz.php' ) && ( @$woo_options['woo_biz_disable_footer_widgets'] == 'true' ) ) {
			$has_footer_sidebars = false;
		}
		
		// Lastly, we display the sidebars.
		if ( $has_footer_sidebars ) {
		
			$total = $woo_options['woo_footer_sidebars']; if ( ! $total ) { $total = $footer_sidebar_total; }
			
?>
	<div id="footer-widgets" class="col-full col-<?php echo $total; ?>">
	
		<?php $i = 0; while ( $i < $total ) { $i++; ?>			
			<?php if ( woo_active_sidebar( 'footer-' . $i ) ) { ?>
		<div class="block footer-widget-<?php echo $i; ?>">
	    	<?php woo_sidebar( 'footer-' . $i ); ?>    
		</div>	        
	        <?php } ?>
		<?php } // End WHILE Loop ?>
	    		        
		<div class="fix"></div>
	
	</div><!--/#footer-widgets-->
<?php
		
		} // End IF Statement
		
	} // End woo_footer_sidebars()
}

/*-----------------------------------------------------------------------------------*/
/* Add customisable footer areas */
/*-----------------------------------------------------------------------------------*/

/**
 * Add customisable footer areas.
 *
 * @package WooFramework
 * @subpackage Actions
 */

if ( ! function_exists( 'woo_footer_left' ) ) { 
 function woo_footer_left () {
 
 	global $woo_options;
 
 	woo_do_atomic( 'woo_footer_left_before' );
 	
 	$html = '';
 	
 	if( $woo_options['woo_footer_left'] == 'true' ) {
		$html .= '<p>'.stripslashes( $woo_options['woo_footer_left_text'] ).'</p>';
	} else {
		$html .= '[site_copyright]';
	} // End IF Statement
	
	$html = apply_filters( 'woo_footer_left', $html );
	
	echo $html;
 	
 	woo_do_atomic( 'woo_footer_left_after' );
 
 } // End woo_footer_left()
}

if ( ! function_exists( 'woo_footer_right' ) ) {  
 function woo_footer_right () {
 
 	global $woo_options;
 
 	woo_do_atomic( 'woo_footer_right_before' );
 	
 	$html = '';
 	
 	if( $woo_options['woo_footer_right'] == 'true' ) {
		$html .= '<p>'.stripslashes( $woo_options['woo_footer_right_text'] ).'</p>';
	} else {
		$html .= '[site_credit]';
	} // End IF Statement
	
	$html = apply_filters( 'woo_footer_right', $html );
	
	echo $html;
 	
 	woo_do_atomic( 'woo_footer_right_after' );
 
 } // End woo_footer_right()
}

/*-----------------------------------------------------------------------------------*/
/* Add customisable post meta */
/*-----------------------------------------------------------------------------------*/

/**
 * Add customisable post meta.
 *
 * Add customisable post meta, using shortcodes,
 * to be added/modified where necessary.
 *
 * @package WooFramework
 * @subpackage Actions
 */

if ( ! function_exists( 'woo_post_meta' ) ) { 
 function woo_post_meta() {
 
 	if ( is_page() ) { return; }
 	
 	$post_info = '<span class="small">' . __( 'By', 'woothemes' ) . '</span> [post_author_posts_link] <span class="small">' . __( 'on', 'woothemes' ) . '</span> [post_date] <span class="small">' . __( 'in', 'woothemes' ) . '</span> [post_categories before=""] ' . ' [post_edit]';
	printf( '<div class="post-meta">%s</div>' . "\n", apply_filters( 'woo_filter_post_meta', $post_info ) );
 
 } // End woo_post_meta()
}

/*-----------------------------------------------------------------------------------*/
/* Add Post Thumbnail to Single posts on Archives */
/*-----------------------------------------------------------------------------------*/
 
/**
 * Add Post Thumbnail to Single posts on Archives
 *
 * Add code to the woo_post_inside_before() hook.
 *
 * @package WooFramework
 * @subpackage Actions
 */
 
 add_action( 'woo_post_inside_before', 'woo_display_post_image', 10 );
 
if ( ! function_exists( 'woo_display_post_image' ) ) { 
 function woo_display_post_image() {
 
 	global $woo_options;
 	
 	$display_image = false;
 
 	$width = $woo_options['woo_thumb_w'];
 	$height = $woo_options['woo_thumb_h'];
 	$align = $woo_options['woo_thumb_align'];
 	
 	if ( is_single() && @$woo_options['woo_thumb_single'] == 'true' ) {
 		$width = $woo_options['woo_single_w'];
 		$height = $woo_options['woo_single_h'];
 		$align = $woo_options['woo_thumb_align_single'];
 		$display_image = true; 
 	}
 
 	if ( get_option('woo_woo_tumblog_switch') == 'true' ) { $is_tumblog = woo_tumblog_test(); } else { $is_tumblog = false; }
 
 	if ( $is_tumblog || ( is_single() && @$woo_options['woo_thumb_single'] == 'false' ) ) { $display_image = false; }
 
 	if ( $display_image == true and !woo_embed('') ) { woo_image('width=' . $width . '&height=' . $height . '&class=thumbnail ' . $align); }
 
 } // End woo_display_post_image()
}

/*-----------------------------------------------------------------------------------*/
/* Post Inside After */
/*-----------------------------------------------------------------------------------*/
/**
 * Post Inside After
 *
 * Add code to the woo_post_inside_after() hook.
 *
 * @package WooFramework
 * @subpackage Actions
 */
 
 add_action( 'woo_post_inside_after_singular-post', 'woo_post_inside_after_default', 10 );

if ( ! function_exists( 'woo_post_inside_after_default' ) ) { 
 function woo_post_inside_after_default() {
 	
 	$post_info ='[post_tags before=""]';
	printf( '<div class="post-utility">%s</div>' . "\n", apply_filters( 'woo_post_inside_after_default', $post_info ) );
 
 } // End woo_post_inside_after_default()
}

/*-----------------------------------------------------------------------------------*/
/* Modify the default "comment" form field. */
/*-----------------------------------------------------------------------------------*/
/**
 * Modify the default "comment" form field.
 *
 * @package WooFramework
 * @subpackage Filters
 */
 
  add_filter( 'comment_form_field_comment', 'woo_comment_form_comment', 10 );
 
if ( ! function_exists( 'woo_comment_form_comment' ) ) { 
 function woo_comment_form_comment ( $field ) {
 
 	$field = str_replace( '<label ', '<label class="hide" ', $field );
 	$field = str_replace( 'cols="45"', 'cols="50"', $field );
 	$field = str_replace( 'rows="8"', 'rows="10"', $field );
 
 	return $field;
 
 } // End woo_comment_form_comment()
}

/*-----------------------------------------------------------------------------------*/
/* Add theme default comment form fields. */
/*-----------------------------------------------------------------------------------*/ 
/**
 * Add theme default comment form fields.
 *
 * @package WooFramework
 * @subpackage Filters
 */
 
 add_filter( 'comment_form_default_fields', 'woo_comment_form_fields', 10 );
 
if ( ! function_exists( 'woo_comment_form_fields' ) ) { 
 function woo_comment_form_fields ( $fields ) {
 	
 	$commenter = wp_get_current_commenter();

	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
 	
 	$fields =  array(
		'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" class="txt" tabindex="1" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
					'<label for="author">' . __( 'Name', 'woothemes' ) . ( $req ? ' <span class="required">(' . __( 'required', 'woothemes' ) . ')</span>' : '' ) . '</label> ' . '</p>',
		'email'  => '<p class="comment-form-email"><input id="email" name="email" type="text" class="txt" tabindex="2" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . 
					'<label for="email">' . __( 'Email (will not be published)', 'woothemes' ) . ( $req ? ' <span class="required">(' . __( 'required', 'woothemes' ) . ')</span>' : '' ) . '</label> ' . '</p>',
		'url'    => '<p class="comment-form-url"><input id="url" name="url" type="text" class="txt" tabindex="3" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />' .
		            '<label for="url">' . __( 'Website', 'woothemes' ) . '</label></p>',
	);
 
 	return $fields;
 
 } // End woo_comment_form_fields()
}

/*-----------------------------------------------------------------------------------*/
/* Add theme default comment form arguments. */
/*-----------------------------------------------------------------------------------*/ 
/**
 * Add theme default comment form arguments.
 *
 * @package WooFramework
 * @subpackage Filters
 */
 
 add_filter( 'comment_form_defaults', 'woo_comment_form_args', 10 );
 
if ( ! function_exists( 'woo_comment_form_args' ) ) { 
 function woo_comment_form_args ( $args ) {
 
 	// Add tabindex of "field count + 1" to the comment textarea. This lets us cater for additional fields and have a dynamic tab index.
 	$tabindex = count( $args['fields'] ) + 1;
 	$args['comment_field'] = str_replace( '<textarea ', '<textarea tabindex="' . $tabindex . '" ', $args['comment_field'] );
 
 	// Adjust tabindex for "submit" button.
 	$tabindex++;
 
 	$args['label_submit'] = __( 'Submit Comment', 'woothemes' );
 	$args['comment_notes_before'] = '';
 	$args['comment_notes_after'] = '';
 	$args['cancel_reply_link'] = __( 'Click here to cancel reply.', 'woothemes' );
 
 	return $args;
 
 } // End woo_comment_form_args()
}

/*-----------------------------------------------------------------------------------*/
/* Activate shortcode compatibility in our new custom areas. */
/*-----------------------------------------------------------------------------------*/  
/**
 * Activate shortcode compatibility in our new custom areas.
 *
 * @package WooFramework
 * @subpackage Filters
 */
 	$sections = array( 'woo_filter_post_meta', 'woo_post_inside_after_default', 'woo_post_more', 'woo_footer_left', 'woo_footer_right' );
 
 	foreach ( $sections as $s ) { add_filter( $s, 'do_shortcode', 20 ); }

/*-----------------------------------------------------------------------------------*/
/* woo_content_templates_magazine() */
/*-----------------------------------------------------------------------------------*/ 
/**
 * woo_content_templates_magazine()
 *
 * Remove the tumblog content template from the templates
 * to search through, if on the "Magazine" page template.
 *
 * @package WooFramework
 * @subpackage Filters
 */

add_filter( 'woo_content_templates', 'woo_content_templates_magazine', 10 );

if ( ! function_exists( 'woo_content_templates_magazine' ) ) { 
	function woo_content_templates_magazine ( $templates ) {
	
		global $page_template;
		
		if ( $page_template == 'template-magazine.php' ) {
			foreach ( $templates as $k => $v ) {
				$v = str_replace( '.php', '', $v );
				$bits = explode( '-', $v );
				if ( $bits[1] == 'tumblog' ) {
					unset( $templates[$k] );
				}
			}
		}
		
		return $templates;
	
	} // End woo_content_templates_magazine()
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

if ( ! function_exists( 'woo_feedburner_link' ) ) { 
	function woo_feedburner_link ( $output, $feed = null ) {
	
		global $woo_options;
	
		$default = get_default_feed();
	
		if ( ! $feed ) $feed = $default;
		
		if ( $woo_options[ 'woo_feed_url' ] && ( $feed == $default ) && ( ! stristr( $output, 'comments' ) ) ) $output = $woo_options[ 'woo_feed_url' ];
	
		return $output;
	
	} // End woo_feedburner_link()
}

/*-----------------------------------------------------------------------------------*/
/* Help WooTumblog to recognise if it's on the "Magazine" page template */
/*-----------------------------------------------------------------------------------*/

add_action( 'get_template_part_content', 'woo_magazine_adjust_tumblog_widths', 2, 10 );

/**
 * woo_magazine_adjust_tumblog_widths function.
 * 
 * @access public
 * @param string $slug
 * @param string $name
 * @return void
 */
if ( ! function_exists( 'woo_magazine_adjust_tumblog_widths' ) ) {
	function woo_magazine_adjust_tumblog_widths ( $slug, $name ) {
		if ( $name == 'magazine-grid' ) {
			woo_magazine_apply_tumblog_width_adjustments();
		}
	} // End woo_magazine_adjust_tumblog_widths()
}

/**
 * woo_magazine_apply_tumblog_width_adjustments function.
 * 
 * @access public
 * @return void
 */
if ( ! function_exists( 'woo_magazine_apply_tumblog_width_adjustments' ) ) {
	function woo_magazine_apply_tumblog_width_adjustments () {
		add_filter( 'option_woo_tumblog_image_width', 'woo_magazine_tumblog_adjust_width_grid', 10 );
		add_filter( 'option_woo_tumblog_video_width', 'woo_magazine_tumblog_adjust_width_grid', 10 );
		add_filter( 'option_woo_tumblog_audio_width', 'woo_magazine_tumblog_adjust_width_grid', 10 );
	} // End woo_magazine_apply_tumblog_width_adjustments()
}

/**
 * woo_magazine_tumblog_adjust_width_grid function.
 * 
 * @access public
 * @param string $width
 * @return int $width
 */
if ( ! function_exists( 'woo_magazine_tumblog_adjust_width_grid' ) ) {
	function woo_magazine_tumblog_adjust_width_grid ( $width ) {
		return woo_magazine_determine_tumblog_width( current_filter() );
	} // End woo_magazine_tumblog_adjust_width_grid()
}

/**
 * woo_magazine_determine_tumblog_width function.
 * 
 * @access public
 * @param string $filter
 * @return int $width
 */
if ( ! function_exists( 'woo_magazine_determine_tumblog_width' ) ) {
	function woo_magazine_determine_tumblog_width ( $filter ) {
		global $woo_options;
		$width = 300;
		
		if ( isset( $woo_options['woo_tumblog_magazine_media_width'] ) && ( $woo_options['woo_tumblog_magazine_media_width'] != '' ) ) {
			$width = $woo_options['woo_tumblog_magazine_media_width'];
		}
		
		return apply_filters( 'woo_magazine_tumblog_width', $width, $filter );
	} // End woo_magazine_determine_tumblog_width()
}

/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
?>