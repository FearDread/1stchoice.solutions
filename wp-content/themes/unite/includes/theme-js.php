<?php
if (!is_admin()) add_action( 'wp_print_scripts', 'woothemes_add_javascript' );
function woothemes_add_javascript( ) {
	wp_enqueue_script('jquery');    
	wp_enqueue_script( 'superfish', get_bloginfo('template_directory').'/includes/js/superfish.js', array( 'jquery' ) );
	wp_enqueue_script( 'wootabs', get_bloginfo('template_directory').'/includes/js/woo_tabs.js', array( 'jquery' ) );
	wp_enqueue_script( 'general', get_bloginfo('template_directory').'/includes/js/general.js', array( 'jquery' ) );
	//wp_enqueue_script( 'tooltips', get_bloginfo('template_directory').'/includes/js/jquery.tools.min.js', array( 'jquery' ) );
	//wp_enqueue_script( 'scrollto', get_bloginfo('template_directory').'/includes/js/jquery.scrollTo-min.js', array( 'jquery' ) );
	wp_enqueue_script( 'scrolling', get_bloginfo('template_directory').'/includes/js/scrolling.js', array( 'scrollto' ) );
	wp_enqueue_script( 'lastfmrecords', get_bloginfo('template_directory').'/includes/js/last.fm.records.js', array( 'jquery' ) );
	wp_enqueue_script( 'livetwitter', get_bloginfo('template_directory').'/includes/js/jquery.livetwitter.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'getgravatar', get_bloginfo('template_directory').'/includes/js/getgravatar.js', array( 'jquery' ) );
	wp_enqueue_script( 'mp3', get_bloginfo('template_directory').'/includes/tumblog/swfobject.js');
	wp_enqueue_script('woo-nav-autocomplete', get_bloginfo('template_directory').'/functions/js/jquery.autocomplete.js', array( 'jquery' ));
	
}
?>