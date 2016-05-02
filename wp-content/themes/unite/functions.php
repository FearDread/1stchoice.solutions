<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Set path to WooFramework and theme specific functions
$functions_path = TEMPLATEPATH . '/functions/';
$includes_path = TEMPLATEPATH . '/includes/';

//Enable Tumblog Functionality and theme is upgraded
update_option('woo_needs_tumblog_upgrade', 'false');
update_option('tumblog_woo_tumblog_upgraded', 'true');
update_option('tumblog_woo_tumblog_upgraded_posts_done', 'true');

// WooFramework
require_once ($functions_path . 'admin-init.php');			// Framework Init
require_once ($functions_path . 'admin-tumblog-quickpress.php');	// Tumblog Dashboard Functionality

// Theme specific functionality
require_once ($includes_path . 'theme-options.php'); 		// Options panel settings and custom settings
require_once ($includes_path . 'theme-functions.php'); 		// Custom theme functions
require_once ($includes_path . 'theme-plugins.php');		// Theme specific plugins integrated in a theme
require_once ($includes_path . 'theme-actions.php');		// Theme actions & user defined hooks
require_once ($includes_path . 'theme-comments.php'); 		// Custom comments/pingback loop
require_once ($includes_path . 'theme-js.php');				// Load javascript in wp_head
require_once ($includes_path . 'sidebar-init.php');			// Initialize widgetized areas
require_once ($includes_path . 'theme-widgets.php');		// Theme widgets
require_once ($includes_path . 'tumblog/theme-tumblog.php');		// Tumblog Output Functions
// Test for Post Formats
if (get_option('woo_tumblog_content_method') == 'post_format') {
	// Tumblog Post Format Class
	require_once( $includes_path . 'tumblog/wootumblog_postformat.class.php' );
} else {
	// Tumblog Custom Taxonomy Class
	require_once ($includes_path . 'tumblog/theme-custom-post-types.php');	// Custom Post Types and Taxonomies
}

// Test for Post Formats
if (get_option('woo_tumblog_content_method') == 'post_format') {
    //Tumblog Post Formats
    global $woo_tumblog_post_format; 
    $woo_tumblog_post_format = new WooTumblogPostFormat(); 
    if ( $woo_tumblog_post_format->woo_tumblog_upgrade_existing_taxonomy_posts_to_post_formats()) {
    	update_option('woo_tumblog_post_formats_upgraded','true');
    }
    
}

/*-----------------------------------------------------------------------------------*/
/* End WooThemes Functions - You can add custom functions below */
/*-----------------------------------------------------------------------------------*/

?>