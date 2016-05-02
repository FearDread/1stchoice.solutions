<?php

//Get Comments

function woothemes_get_comments($limit = 7, $stops = 65) {
	global $wpdb;

	$getcomments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' ORDER BY comment_date DESC LIMIT 0,".$limit);
	
	foreach($getcomments as $thecomments) {
		if ( strlen ( $thecomments->comment_content ) <= $stops ) {
			$comment = $thecomments->comment_content;
		} else {
			$comment = substr($thecomments->comment_content, 0, strrpos(substr($thecomments->comment_content, 0, $stops), ' ')) . '...';
		}
		
		echo '<li><a href="'.get_permalink($thecomments->comment_post_ID).'">'.$comment.'</a> by '.$thecomments->comment_author.'</li>';
	}
}

// Get Pages

function woothemes_get_pages() {
	global $wpdb;

	$getcats = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE $wpdb->posts.post_type = 'page' AND $wpdb->posts.post_status = 'publish'");
	
	foreach($getcats as $thecat) {
		echo '<li><a href="'.get_permalink($thecat->ID).'">'.$thecat->post_title.'<span>'.get_post_meta( $thecat->ID, 'page-description', true ).'</span></a></li>';
	}
}	

// Style Path

	global $style_path;

	$style = $_REQUEST[style];
	
	if ($style != '') {

		$style_path = $style;

	} else {
		
		$stylesheet = get_option('woo_alt_stylesheet');
		$style_path = str_replace(".css","",$stylesheet);
	
	}

/*-----------------------------------------------------------------------------------*/
/* WordPress 3.0 New Features Support */
/*-----------------------------------------------------------------------------------*/

if ( function_exists('wp_nav_menu') ) {
	add_theme_support( 'nav-menus' );
	register_nav_menus( array( 'primary-menu' => __( 'Primary Menu' ) ) );
}
	
?>