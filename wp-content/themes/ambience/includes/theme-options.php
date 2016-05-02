<?php

function woo_options() {

// VARIABLES
$themename = "Ambience";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/ambience/';
$shortname = "woo";

$GLOBALS['template_path'] = get_bloginfo('template_directory');

//Access the WordPress Categories via an Array
$woo_categories = array();  
$woo_categories_obj = get_categories('hide_empty=0');
foreach ($woo_categories_obj as $woo_cat) {
    $woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
$categories_tmp = array_unshift($woo_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$woo_pages = array();

// Setup an array of pages for a dropdown.
$args = array( 'echo' => 0 );
$pages_dropdown = wp_dropdown_pages( $args );
$pages = array();

// Quick string hack to make sure we get the pages with the indents.
$pages_dropdown = str_replace( '<select name="page_id" id="page_id">', '', $pages_dropdown );
$pages_dropdown = str_replace( '</select>', '', $pages_dropdown );
$pages_split = explode( '</option>', $pages_dropdown );

$pages[] = __( 'Select a Page:', 'woothemes' );

foreach ( $pages_split as $k => $v ) {
	
	$id = '';
	
	// Get the ID value.
	preg_match( '/value="(.*?)"/i', $v, $matches );
	
	if ( isset( $matches[1] ) ) {
		
		$id = $matches[1];
		
		$pages[$id] = trim( strip_tags( $v ) );
	
	}
	
} // End FOREACH Loop

$woo_pages = $pages;

//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options


$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");

// THIS IS THE DIFFERENT FIELDS
$options[] = array(	"name" => "General Settings",
					"icon" => "general",
					"type" => "heading");

$options[] = array( 'name' => __( 'Quick Start', 'woothemes' ),
					'type' => 'subheading' );
						
$options[] = array( "name" => "Theme Stylesheet",
					"desc" => "Select your themes alternative color scheme.",
					"id" => $shortname."_alt_stylesheet",
					"std" => "default.css",
					"type" => "select",
					"options" => $alt_stylesheets);

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify an image URL directly.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");    
									 							    
$options[] = array(	"name" => "Use Text Logo?",
					"desc" => "Check this box, if you'd like to use a basic text logo instead which will be pulled from your WP installation.",
					"id" => $shortname."_textlogo",
					"std" => "false",
					"type" => "checkbox");	

$options[] = array(	"name" => "Use Gravatars?",
					"desc" => "Check this box if you wish to use <a href='http://www.gravatar.com'>Gravatars</a> for Author & Commenter profiles.",
					"id" => $shortname."_gravatar",
					"std" => "true",
					"type" => "checkbox");						

$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px <a href='http://www.faviconr.com/'>ico image</a> that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 
                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");        

$options[] = array( 'name' => __( 'Subscription Settings', 'woothemes' ),
					'type' => 'subheading' );

$options[] = array( "name" => "RSS URL",
					"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
					"id" => $shortname."_feedburner_url",
					"std" => "",
					"type" => "text");

$options[] = array( 'name' => __( 'Display Options', 'woothemes' ),
					'type' => 'subheading' );
                    
$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");
                    
$options[] = array(	"name" => "Contact Me Page",
					"desc" => "Please select your Contact Me page.",
					"id" => $shortname."_contactme",
					"std" => "Select a page:",
					"type" => "select2",
					"options" => $woo_pages);					
					
$options[] = array(	"name" => "Your Information",
					"icon" => "misc",
					"type" => "heading");		

$options[] = array(	"name" => "About You",
					"desc" => "Include a little bio for yourself here, that will be displayed on the blog view.",
					"id" => $shortname."_bio",
					"std" => "",
					"type" => "textarea");						
					
$options[] = array(	"name" => "Twitter username",
					"desc" => "Enter your Twitter username to enable the Twitter update status in the header.",
					"id" => $shortname."_twitter",
					"std" => "",
					"type" => "text");				

$options[] = array(	"name" => "Advertising",
					"icon" => "ads",
					"type" => "heading");

$options[] = array( 'name' => __( 'Banners (125 x 125)', 'woothemes' ),
					'type' => 'subheading' );

$options[] = array(	"name" => "Banner Ad #1 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_1",
					"std" => $template_path . "/images/ad.jpg",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #1 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_1",
					"std" => "http://example.com/ads/ad1_destination.html",
					"type" => "text");						

$options[] = array(	"name" => "Banner Ad #2 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_2",
					"std" => $template_path . "/images/ad.jpg",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #2 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_2",
					"std" => "http://example.com/ads/ad1_destination.html",
					"type" => "text");

$options[] = array(	"name" => "Banner Ad #3 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_3",
					"std" => $template_path . "/images/ad.jpg",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #3 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_3",
					"std" => "http://example.com/ads/ad1_destination.html",
					"type" => "text");

$options[] = array(	"name" => "Banner Ad #4 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_4",
					"std" => $template_path . "/images/ad.jpg",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #4 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_4",
					"std" => "http://example.com/ads/ad1_destination.html",
					"type" => "text");						 		                                                

// Add extra options through function
if ( function_exists("woo_options_add") )
	$options = woo_options_add($options);

if ( get_option('woo_template') != $options) update_option('woo_template',$options);      
if ( get_option('woo_themename') != $themename) update_option('woo_themename',$themename);   
if ( get_option('woo_shortname') != $shortname) update_option('woo_shortname',$shortname);
if ( get_option('woo_manual') != $manualurl) update_option('woo_manual',$manualurl);

                                     
// Woo Metabox Options
                    

$woo_metaboxes = array(

		"page-description" => array (
			"name"		=> "page-description",
			"default" 	=> "",
			"label" 	=> "Page Description",
			"type" 		=> "text",
		)

    );
    
// Add extra metaboxes through function
if ( function_exists("woo_metaboxes_add") )
	$woo_metaboxes = woo_metaboxes_add($woo_metaboxes);
    
if ( get_option('woo_custom_template') != $woo_metaboxes) update_option('woo_custom_template',$woo_metaboxes);      

/*
function woo_update_options(){
        $options = get_option('woo_template',$options);  
        foreach ($options as $option){
            update_option($option['id'],$option['std']);
        }   
}

function woo_add_options(){
        $options = get_option('woo_template',$options);  
        foreach ($options as $option){
            update_option($option['id'],$option['std']);
        }   
}


//add_action('switch_theme', 'woo_update_options'); 
if(get_option('template') == 'wooframework'){       
    woo_add_options();
} // end function 
*/


}

add_action( 'admin_head','woo_options' );  

?>