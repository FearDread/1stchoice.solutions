<?php



function woo_options() {
// VARIABLES
$themename = "Feature Pitch";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/featurepitch/';
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
$woo_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($woo_pages_obj as $woo_page) {
    $woo_pages[$woo_page->ID] = $woo_page->post_name; }
$woo_pages_tmp = array_unshift($woo_pages, "Select a page:");       

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
$options = array();   

$options[] = array(	"name" => "General Settings",
					                "type" => "heading");
						
$options[] = array(	"name" => "Theme Stylesheet",
					                "desc" => "Select your themes alternative color scheme.",
					                "id" => $shortname."_alt_stylesheet",
					                "std" => "default.css",
					                "type" => "select",
					                "options" => $alt_stylesheets);

$options[] = array(	"name" => "Custom Logo",
					                "desc" => "Upload a logo for your theme, or specify an image URL directly.",
					                "id" => $shortname."_logo",
					                "std" => "",
					                "type" => "upload");	
                                    				 							    
 $options[] = array(    "name" => "Custom Favicon",
                                        "desc" => "Upload a 16px x 16px <a href='http://www.faviconr.com/'>ico image</a> that will represent your website's favicon.",
                                        "id" => $shortname."_custom_favicon",
                                        "std" => "",
                                        "type" => "upload"); 
                                               
$options[] = array(	"name" => "Tracking Code",
					                "desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					                "id" => $shortname."_google_analytics",
					                "std" => "",
					                "type" => "textarea");		

$options[] = array(	"name" => "RSS URL",
					                "desc" => "Enter your preferred RSS URL. (Feedburner or other)",
					                "id" => $shortname."_feedburner_url",
					                "std" => "",
					                "type" => "text");
                                    
$options[] = array( "name" => "Custom CSS",
                                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                                    "id" => $shortname."_custom_css",
                                    "std" => "",
                                    "type" => "textarea");        

$options[] = array(	"name" => "Navigation Settings",
					                "type" => "heading");	

$options[] = array( "name" => "Exclude Pages or Categories from Top Navigation",
                                    "desc" => "Enter a comma-separated list of <a href='http://support.wordpress.com/pages/8/'>ID's</a> that you'd like to exclude from the top navigation. (e.g. 12,23,27,44)",
					                "id" => $shortname."_exclude_pages_main",
					                "std" => "",
					                "type" => "text");	

$options[] = array( "name" => "Highlighted Tab - Text (Optional)",
                                    "desc" => "Add a highlighted button at the end of the menu list. This is the text that will display on top of the button.",
					                "id" => $shortname."_highlight_text",
					                "std" => "",
					                "type" => "text");				

$options[] = array( "name" => "Highlighted Tab - URL (Optional)",
                                    "desc" => "Add a highlighted button at the end of the menu list. This is the URL the button will link to.",
					                "id" => $shortname."_highlight_url",
					                "std" => "",
					                "type" => "text");									         

$options[] = array(	"name" => "Use Breadcrumbs?",
					                "desc" => "Check this box if you'd like to enable the use of breadcrumbs.",
					                "id" => $shortname."_breadcrumbs",
					                "std" => "false",
					                "type" => "checkbox");									                       		                																	                				                
	
$options[] = array(	"name" => "Homepage Settings",
					"type" => "heading");	

$options[] = array(	"name" => "Featured Page",
					"desc" => "Enter the <a href='http://support.wordpress.com/pages/8/'>Page ID</a> show as the featured page, being displayed at the top of the homepage",
					"id" => $shortname."_feat_page",
					"std" => "",
					"type" => "text");	

$options[] = array(	"name" => "Include 'Featured Page' in top navigation?",
					"desc" => "Check this box if you'd like to include the above-listed pages in the top navigation.",
					"id" => $shortname."_inc_feat_page",
					"std" => "false",
					"type" => "checkbox");									

$options[] = array(	"name" => "Mini-featured pages",
					"desc" => "Enter a comma-separated list of the <a href='http://support.wordpress.com/pages/8/'>Page ID's</a> that you'd like to display in a 3x3 format on the homepage.",
					"id" => $shortname."_feat_pages",
					"std" => "",
					"type" => "text");			

$options[] = array(    "name" => "Include 'Mini-featured Pages' in top navigation?",
                    "desc" => "Check this box if you'd like to include the above-listed pages in the top navigation.",
                    "id" => $shortname."_inc_feat_pages",
                    "std" => "false",
                    "type" => "checkbox");        
                    
$options[] = array(	"name" => "Link homepage images to pages",
					"desc" => "Check this box if you'd like to link the homepage images to the relative pages.",
					"id" => $shortname."_homepage_image_link",
					"std" => "false",
					"type" => "checkbox");						

$options[] = array(	"name" => "Footer Settings",
					"type" => "heading");	

$options[] = array(	"name" => "Left Panel Page",
					"desc" => "Enter the <a href='http://support.wordpress.com/pages/8/'>Page ID</a> you'd like to display in the left (larger) panel of the footer.",
					"id" => $shortname."_footer_left",
					"std" => "",
					"type" => "text");	

$options[] = array(	"name" => "Include 'Left Panel Page' in top navigation?",
					"desc" => "Check this box if you'd like to include the above-listed pages in the top navigation.",
					"id" => $shortname."_inc_footer_left",
					"std" => "false",
					"type" => "checkbox");				

$options[] = array(	"name" => "Right Panel Page",
					"desc" => "Enter the <a href='http://support.wordpress.com/pages/8/'>Page ID</a> you'd like to display in the right (right) panel of the footer.",
					"id" => $shortname."_footer_right",
					"std" => "",
					"type" => "text");	

$options[] = array(	"name" => "Include 'Right Panel Page' in top navigation?",
					"desc" => "Check this box if you'd like to include the above-listed pages in the top navigation.",
					"id" => $shortname."_inc_footer_right",
					"std" => "false",
					"type" => "checkbox");																														           
 
$options[] = array(   "name" => "Dynamic Images",
                                    "type" => "heading");    

$options[] = array(    "name" => "Enable Dynamic Image Resizer",
                                        "desc" => "This will enable the thumb.php script. It dynamicaly resizes images on your site.",
                                        "id" => $shortname."_resize",
                                        "std" => "true",
                                        "type" => "checkbox");    
                    
$options[] = array(    "name" => "Automatic Image Thumbs",
                                    "desc" => "If no image is specified in the 'image' custom field then the first uploaded post image is used.",
                                    "id" => $shortname."_auto_img",
                                    "std" => "false",
                                    "type" => "checkbox");    	

$options[] = array(    "name" => "Featured Image (Homepage)",
                                        "desc" => "Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.",
                                        "id" => $shortname."_thumb_articles",
                                        "std" => "",
                                        "type" => array( 
                                                            array(
                                                                    'id' => $shortname. '_minifeat_width',
                                                                    'type' => 'text',
                                                                    'std' => 270,
                                                                    'meta' => 'Width'
                                                                    ),
                                                            array(
                                                                    'id' => $shortname. '_minifeat_height',
                                                                    'type' => 'text',
                                                                    'std' => 295,
                                                                    'meta' => 'Height'
                                                                    )
                                                          )
                                            );       

$options[] = array(    "name" => "Mini-Featured Thumbnails (Homepage)",
                                        "desc" => "Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.",
                                        "id" => $shortname."_thumb_articles",
                                        "std" => "",
                                        "type" => array( 
                                                            array(
                                                                    'id' => $shortname. '_minifeat_width',
                                                                    'type' => 'text',
                                                                    'std' => 218,
                                                                    'meta' => 'Width'
                                                                    ),
                                                            array(
                                                                    'id' => $shortname. '_minifeat_height',
                                                                    'type' => 'text',
                                                                    'std' => 110,
                                                                    'meta' => 'Height'
                                                                    )
                                                          )
                                            );            

$options[] = array(    "name" => "General Post Thumbnails",
                                        "desc" => "Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.",
                                        "id" => $shortname."_thumb_articles",
                                        "std" => "",
                                        "type" => array( 
                                                            array(
                                                                    'id' => $shortname. '_thumb_width',
                                                                    'type' => 'text',
                                                                    'std' => 100,
                                                                    'meta' => 'Width'
                                                                    ),
                                                            array(
                                                                    'id' => $shortname. '_thumb_height',
                                                                    'type' => 'text',
                                                                    'std' => 100,
                                                                    'meta' => 'Height'
                                                                    )
                                                          )
                                            );                          

$options[] = array(	"name" => "Blog / News Settings",
					"type" => "heading");		

$options[] = array(	"name" => "Add Blog / News Link to Main Navigation?",
					"desc" => "If checked, this option will add a blog link to your main navigation next to the Home link.",
					"id" => $shortname."_blog_navigation",
					"std" => "false",
					"type" => "checkbox");																																		

$options[] = array( "name" => "Blog Permalink",
					"desc" => "Please enter the permalink to your blog parent category (i.e. /category/blog/). If you are not using <a href='http://codex.wordpress.org/Using_Permalinks'>Pretty Permalinks</a> then you can use (/?cat=X) where X is your blog category ID.",
					"id" => $shortname."_blog_permalink",
					"std" => "",
					"type" => "text");			

$options[] = array( "name" => "Blog Category ID",
					"desc" => "Please enter the ID of your main blog category. Only the sub-categories of this category will be displayed in the category drop-down.",
					"id" => $shortname."_blog_cat_id",
					"std" => "",
					"type" => "text");							

$options[] = array(	"name" => "Show full post?",
					"desc" => "Check this to display the full post eg. use the_content() instead of the_excerpt().",
					"id" => $shortname."_the_content",
					"std" => "true",
					"type" => "checkbox");				                                                										
															    								
//Advertising
$options[] = array(	"name" => "Ads - Sidebar Widget (Max Width 230px)",
					"type" => "heading");

$options[] = array(	"name" => "Rotate banners?",
					"desc" => "Check this to randomly rotate the banner ads.",
					"id" => $shortname."_ads_rotate",
					"std" => "true",
					"type" => "checkbox");	

$options[] = array(	"name" => "Banner Ad #1 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_1",
					"std" => "http://www.woothemes.com/ads/125x125b.jpg",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #1 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_1",
					"std" => "http://www.woothemes.com",
					"type" => "text");						

$options[] = array(	"name" => "Banner Ad #2 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_2",
					"std" => "http://www.woothemes.com/ads/125x125b.jpg",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #2 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_2",
					"std" => "http://www.woothemes.com",
					"type" => "text");

$options[] = array(	"name" => "Banner Ad #3 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_3",
					"std" => "http://www.woothemes.com/ads/125x125b.jpg",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #3 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_3",
					"std" => "http://www.woothemes.com",
					"type" => "text");

$options[] = array(	"name" => "Banner Ad #4 - Image Location",
					"desc" => "Enter the URL for this banner ad.",
					"id" => $shortname."_ad_image_4",
					"std" => "http://www.woothemes.com/ads/125x125b.jpg",
					"type" => "text");
						
$options[] = array(	"name" => "Banner Ad #4 - Destination",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_url_4",
					"std" => "http://www.woothemes.com",
					"type" => "text");		                          


// Add extra options through function
if ( function_exists("woo_options_add") )
	$options = woo_options_add($options);

if ( get_option('woo_template') != $options) update_option('woo_template',$options);      
if ( get_option('woo_themename') != $themename) update_option('woo_themename',$themename);   
if ( get_option('woo_shortname') != $shortname) update_option('woo_shortname',$shortname);
if ( get_option('woo_manual') != $manualurl) update_option('woo_manual',$manualurl);

                                     
// Woo Metabox Options


                                     
// Woo Metabox Options

$woo_metaboxes = array(
		"image" => array (
			"name"		=> "image",
			"default" 	=> "",
			"label" 	=> "Image",
			"type" 		=> "upload",
			"desc"      => "Enter the URL for image to be used by the Dynamic Image resizer."
		),
		"embed" => array (
			"name"		=> "embed",
			"default" 	=> "",
			"label" 	=> "Video Embed Code",
			"type" 		=> "textarea",
			"desc"      => "Paste the embed code for your video here. Video will be resized automatically. Note: You need to tag this post with 'video' in order to work with the Woo - Video Player widget.",
			"input"     => "textarea"
		),		
		"page_excerpt" => array (
			"name"		=> "page_excerpt",
			"default" 	=> "",
			"label" 	=> "Page Excerpt",
			"type" 		=> "text",
			"desc"      => "Excerpt for this page (used for the mini-featured pages on homepage). We suggest using 1 / 2 shortish sentences."
		),				
		"link1_text" => array (
			"name"		=> "link1_text",
			"default" 	=> "",
			"label" 	=> "Button 1 - Link Text (Optional)",
			"type" 		=> "text",
			"desc"      => "Link text for the button used in the featured page area (homepage)."
		),				
		"link1_link" => array (
			"name"		=> "link1_link",
			"default" 	=> "",
			"label" 	=> "Button 1 - URL (Optional)",
			"type" 		=> "text",
			"desc"      => "Link URL for the button used in the featured page area (homepage)."
		),		
		"link2_text" => array (
			"name"		=> "link2_text",
			"default" 	=> "",
			"label" 	=> "Button 2 - Link Text (Optional)",
			"type" 		=> "text",
			"desc"      => "Link text for the button used in the featured page area (homepage)."
		),				
		"link2_link" => array (
			"name"		=> "link2_link",
			"default" 	=> "",
			"label" 	=> "Button 2 - URL (Optional)",
			"type" 		=> "text",
			"desc"      => "Link URL for the button used in the featured page area (homepage)."
		),							
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