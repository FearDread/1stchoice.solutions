<?php

// Register widgetized areas
if (!function_exists('the_widgets_init')) {
	function the_widgets_init() {
	    if ( !function_exists('register_sidebars') )
	        return;
	
		// Widgetized sidebars
	    register_sidebar(array('name' => 'Primary','id' => 'primary','description' => "Normal full width Sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));   
	    register_sidebar(array('name' => 'Secondary','id' => 'secondary', 'description' => "Secondary sidebar for use in three column layout", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	
		// Footer widgetized area
		$total = get_option('woo_footer_sidebars');
		if (!$total)
			$total = 4;
		$i=0; while ($i < $total) : $i++;
			register_sidebar(array('name' => 'Footer '.$i,'id' => 'footer-'.$i, 'description' => "Widgetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
		endwhile;
	 			
	}
}

add_action( 'init', 'the_widgets_init' );  
?>