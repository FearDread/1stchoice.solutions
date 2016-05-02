<?php

add_action( 'admin_head','woo_options' );  
function woo_options() {
	
// VARIABLES
$themename = "Unite";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/unite/';
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

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//URL Shorteners
if (_iscurlinstalled()) {
	$options_select = array("Off","TinyURL","Bit.ly");
	$short_url_msg = 'Select the URL shortening service you would like to use.'; 
} else {
	$options_select = array("Off");
	$short_url_msg = '<strong>cURL was not detected on your server, and is required in order to use the URL shortening services.</strong>'; 
}

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

$options[] = array( "name" => "General Settings",
					"icon" => "general",
                    "type" => "heading");
                        
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
                                                                                     
$options[] = array( "name" => "Logo Text Title",
					"desc" => "Enable if you want Blog Title and Tagline to be text-based. Setup title/tagline in WP -> Settings -> General.",
					"id" => $shortname."_texttitle",
					"std" => "false",
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

$options[] = array( "name" => "RSS URL",
					"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
					"id" => $shortname."_feed_url",
					"std" => "",
					"type" => "text");
                    
$options[] = array( "name" => "E-Mail URL",
					"desc" => "Enter your preferred E-mail subscription URL. (Feedburner or other)",
					"id" => $shortname."_subscribe_email",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Contact Form E-Mail",
					"desc" => "Enter your E-mail address to use on the Contact Form Page Template. Add the contact form by adding a new page and selecting 'Contact Form' as page template.",
					"id" => $shortname."_contactform_email",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");
                    
$options[] = array( "name" => "Tumblog Setup",
					"icon" => "tumblog",
				    "type" => "heading");  

$content_option_array = array( 	'taxonomy' 	=> 'Taxonomy',
								'post_format' => 'Post Formats'			
									);

$options[] = array( "name" => "Tumblog Content Method",
					"desc" => "Select if you would like to use a Taxonomy of Post Formats to categorize your Tumblog content.",
					"id" => $shortname."_tumblog_content_method",
					"std" => "post_format",
					"type" => "select2",
					"options" => $content_option_array); 
					
$options[] = array( "name" => "Use Custom Tumblog RSS Feed",
					"desc" => "Replaces the default WordPress RSS feed output with Tumblog RSS output.",
					"id" => $shortname."_custom_rss",
					"std" => "true",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Full Content Home",
					"desc" => "Show the full content in posts on homepage instead of the excerpt.",
					"id" => $shortname."_home_content",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Full Content Archive",
					"desc" => "Show the full content in posts on archive pages instead of the excerpt.",
					"id" => $shortname."_archive_content",
					"std" => "false",
					"type" => "checkbox");
					
$options[] = array( "name" => "Articles",
					"desc" => "Select the category that you would like to use for this post type.",
					"id" => $shortname."_articles_category",
					"std" => "Select a category:",
					"type" => "select",
					"class" => "hidden",
					"options" => $woo_categories);  				     					

$options[] = array( "name" => "Images",
					"desc" => "Select the category that you would like to use for this post type.",
					"id" => $shortname."_images_category",
					"std" => "Select a category:",
					"type" => "select",
					"class" => "hidden",
					"options" => $woo_categories);  				     					

$options[] = array( "name" => "Images Link to",
					"desc" => "Select where your Tumblog Images will link to when clicked.",
					"id" => $shortname."_image_link_to",
					"std" => "post",
					"type" => "radio",
					"options" => $options_image_link_to); 	
					
$options[] = array( "name" => "Videos",
					"desc" => "Select the category that you would like to use for this post type.",
					"id" => $shortname."_videos_category",
					"std" => "Select a category:",
					"type" => "select",
					"class" => "hidden",
					"options" => $woo_categories);  				     					

$options[] = array( "name" => "Quotes",
					"desc" => "Select the category that you would like to use for this post type.",
					"id" => $shortname."_quotes_category",
					"std" => "Select a category:",
					"type" => "select",
					"class" => "hidden",
					"options" => $woo_categories);  		

$options[] = array( "name" => "Links",
					"desc" => "Select the category that you would like to use for this post type.",
					"id" => $shortname."_links_category",
					"std" => "Select a category:",
					"type" => "select",
					"class" => "hidden",
					"options" => $woo_categories);  
					
$options[] = array( "name" => "Audio",
					"desc" => "Select the category that you would like to use for this post type.",
					"id" => $shortname."_audio_category",
					"std" => "Select a category:",
					"type" => "select",
					"class" => "hidden",
					"options" => $woo_categories);  

$options[] = array( "name" => "Ajax Functions",
					"icon" => "misc",
					"type" => "heading");   

$options[] = array( "name" => "Homepage Ajax Pagination",
					"desc" => "Replaces the default pagination with an Ajax Load More Posts button.",
					"id" => $shortname."_ajax_home_pagination",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Archive Ajax Pagination",
					"desc" => "Replaces the default pagination with an Ajax Load More Posts button.",
					"id" => $shortname."_ajax_archive_pagination",
					"std" => "true",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Search Ajax Pagination",
					"desc" => "Replaces the default pagination with an Ajax Load More Posts button.",
					"id" => $shortname."_ajax_search_pagination",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Subscribe to Comments Plugin",
					"icon" => "main",
					"type" => "heading");   

$options[] = array( "name" => "Use bundled plugin",
					"desc" => "This theme requires the Subscribe to Comments Plugin. It is included in the theme code. If you wish to manually install the plugin using the WordPress plugin manager, please uncheck and save this option.",
					"id" => $shortname."_exclude_subscribe_to_comments_plugin",
					"std" => "true",
					"type" => "checkbox"); 
																																			
$options[] = array( "name" => "Styling Options",
					"icon" => "styling",
					"type" => "heading");    

$options[] = array( "name" =>  "Link Color",
					"desc" => "Pick a custom color for links or add a hex color code e.g. #697e09",
					"id" => "woo_link_color",
					"std" => "",
					"type" => "color");   

$options[] = array( "name" =>  "Link Hover Color",
					"desc" => "Pick a custom color for links hover or add a hex color code e.g. #697e09",
					"id" => "woo_link_hover_color",
					"std" => "",
					"type" => "color");                                       
 					                   
$options[] = array( "name" => "Dynamic Images",
					"icon" => "image",
				    "type" => "heading");    

$options[] = array( "name" => "Enable Dynamic Image Resizer",
					"desc" => "This will enable the thumb.php script. It dynamicaly resizes images on your site.",
					"id" => $shortname."_resize",
					"std" => "true",
					"type" => "checkbox");    
                    
$options[] = array( "name" => "Automatic Image Thumbs",
					"desc" => "If no image is specified in the 'image' custom field then the first uploaded post image is used.",
					"id" => $shortname."_auto_img",
					"std" => "true",
					"type" => "checkbox");    

$options[] = array( "name" => "Dynamic Image Height",
					"desc" => "If this is enabled, the height of your images will be dynamically calculated based on the width's as set below.",
					"id" => $shortname."_dynamic_img_height",
					"std" => "false",
					"type" => "checkbox");  
					
$options[] = array( "name" => "Thumbnail Image Dimensions",
					"desc" => "Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.",
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_thumb_w',
											'type' => 'text',
											'std' => 460,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_thumb_h',
											'type' => 'text',
											'std' => 200,
											'meta' => 'Height')
								  ));
                                                                                                
$options[] = array( "name" => "Thumbnail Image alignment",
					"desc" => "Select how to align your thumbnails with posts.",
					"id" => $shortname."_thumb_align",
					"std" => "alignleft",
					"type" => "radio",
					"options" => $options_thumb_align); 

$options[] = array( "name" => "Show thumbnail in Single Posts",
					"desc" => "Show the attached image in the single post page.",
					"id" => $shortname."_thumb_single",
					"std" => "true",
					"type" => "checkbox");    

$options[] = array( "name" => "Single Image Dimensions",
					"desc" => "Enter an integer value i.e. 250 for the image size. Max width is 576.",
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_single_w',
											'type' => 'text',
											'std' => 460,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_single_h',
											'type' => 'text',
											'std' => 200,
											'meta' => 'Height')
								  ));

$options[] = array( "name" => "Add thumbnail to RSS feed",
					"desc" => "Add the the image uploaded via your Custom Settings to your RSS feed",
					"id" => $shortname."_rss_thumb",
					"std" => "false",
					"type" => "checkbox");    

// Add extra options through function
if ( function_exists("woo_options_add") )
	$options = woo_options_add($options);

if ( get_option('woo_template') != $options) update_option('woo_template',$options);      
if ( get_option('woo_themename') != $themename) update_option('woo_themename',$themename);   
if ( get_option('woo_shortname') != $shortname) update_option('woo_shortname',$shortname);
if ( get_option('woo_manual') != $manualurl) update_option('woo_manual',$manualurl);

                                     
// Woo Metabox Options
$woo_metaboxes = array(

        "image" => array (
            "name" => "image",
            "label" => "Image",
            "type" => "upload",
            "desc" => "Upload file here..."
        ),
        "video-embed" => array (
            "name" => "video-embed",
            "label" => "Embed Code (Videos)",
            "type" => "textarea",
            "desc" => "Add embed code for video services like Youtube or Vimeo"
        ),
        "quote-author" => array (
            "name"  => "quote-author",
            "std"  => "Unknown",
            "label" => "Quote Author",
            "type" => "text",
            "desc" => "Enter the name of the Quote Author."
        ),
        "quote-url" => array (
            "name"  => "quote-url",
            "std"  => "http://",
            "label" => "Link to Quote",
            "type" => "text",
            "desc" => "Enter the url/web address of the Quote if available."
        ),
        "quote-copy" => array (
            "name"  => "quote-copy",
            "std"  => "Unknown",
            "label" => "Quote",
            "type" => "textarea",
            "desc" => "Enter the Quote."
        ),
        "audio" => array (
            "name"  => "audio",
            "std"  => "http://",
            "label" => "Audio URL",
            "type" => "text",
            "desc" => "Enter the url/web address of the Audio file."
        ),
        "link-url" => array (
            "name"  => "link-url",
            "std"  => "http://",
            "label" => "Link URL",
            "type" => "text",
            "desc" => "Enter the url/web address of the Link."
        ),
	
    );
    
// Add extra metaboxes through function
if ( function_exists("woo_metaboxes_add") )
	$woo_metaboxes = woo_metaboxes_add($woo_metaboxes);
    
if ( get_option('woo_custom_template') != $woo_metaboxes) update_option('woo_custom_template',$woo_metaboxes);      

}

?>