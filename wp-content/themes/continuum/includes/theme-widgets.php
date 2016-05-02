<?php

/*---------------------------------------------------------------------------------*/
/* Loads all the .php files found in /includes/widgets/ directory */
/*---------------------------------------------------------------------------------*/

$template_directory = get_template_directory();

include( $template_directory . '/includes/widgets/widget-woo-tabs.php' );
include( $template_directory . '/includes/widgets/widget-woo-adspace.php' );
include( $template_directory . '/includes/widgets/widget-woo-blogauthor.php' );
include( $template_directory . '/includes/widgets/widget-woo-embed.php' );
include( $template_directory . '/includes/widgets/widget-woo-flickr.php' );
include( $template_directory . '/includes/widgets/widget-woo-search.php' );
include( $template_directory . '/includes/widgets/widget-woo-twitter.php' );
include( $template_directory . '/includes/widgets/widget-woo-campaignmonitor.php' );
include( $template_directory . '/includes/widgets/widget-woo-feedburner.php' );
include( $template_directory . '/includes/widgets/widget-woo-address.php' );
include( $template_directory . '/includes/widgets/widget-woo-authors.php' );
include( $template_directory . '/includes/widgets/widget-woo-social.php' );


/*---------------------------------------------------------------------------------*/
/* Deregister Default Widgets */
/*---------------------------------------------------------------------------------*/
if ( !function_exists( 'woo_deregister_widgets' ) ) {
	function woo_deregister_widgets(){
		unregister_widget( 'WP_Widget_Search' );
	}
}
add_action( 'widgets_init', 'woo_deregister_widgets' );
?>