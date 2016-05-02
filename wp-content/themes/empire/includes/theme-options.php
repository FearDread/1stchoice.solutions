<?php

if (!function_exists( 'woo_options')) {
function woo_options() {
	
// THEME VARIABLES
$themename = "Empire";
$themeslug = "empire";

// STANDARD VARIABLES. DO NOT TOUCH!
$shortname = "woo";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/'.$themeslug.'/';

//Access the WordPress Categories via an Array
$woo_categories = array();  
$woo_categories_obj = get_categories( 'hide_empty=0' );
foreach ($woo_categories_obj as $woo_cat) {
    $woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
$categories_tmp = array_unshift($woo_categories, "Select a category:" );    
       
//Access the WordPress Pages via an Array
$woo_pages = array();
$woo_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );    
foreach ($woo_pages_obj as $woo_page) {
    $woo_pages[$woo_page->ID] = $woo_page->post_name; }
    
$woo_pages_raw = $woo_pages;
$woo_pages_raw[0] = "Select a page:";
$woo_pages_tmp = array_unshift($woo_pages, "Select a page:" );       

//Stylesheets Reader
$alt_stylesheet_path = get_template_directory() . '/styles/';
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
$zoom = array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$other_entries = array( "Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19" );

// THIS IS THE DIFFERENT FIELDS
$options = array();   
  
// General

$options[] = array( "name" => "General Settings",
					"type" => "heading",
					"icon" => "general" );
                        
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
					"type" => "upload" );    
                                                                                     
$options[] = array( "name" => "Text Title",
					"desc" => "Enable text-based Site Title and Tagline. Setup title & tagline in <a href='".home_url()."/wp-admin/options-general.php'>General Settings</a>.",
					"id" => $shortname."_texttitle",
					"std" => "false",
					"class" => "collapsed",
					"type" => "checkbox" );

$options[] = array( "name" => "Site Title",
					"desc" => "Change the site title typography.",
					"id" => $shortname."_font_site_title",
					"std" => array( 'size' => '30','unit' => 'px','face' => 'Arial','style' => 'bold','color' => '#333333'),
					"class" => "hidden",
					"type" => "typography" );  

$options[] = array( "name" => "Site Description",
					"desc" => "Enable the site description/tagline under site title.",
					"id" => $shortname."_tagline",
					"class" => "hidden",
					"std" => "false",
					"type" => "checkbox" );

$options[] = array( "name" => "Site Description",
					"desc" => "Change the site description typography.",
					"id" => $shortname."_font_tagline",
					"std" => array( 'size' => '12','unit' => 'px','face' => 'Georgia','style' => '','color' => '#999999'),
					"class" => "hidden last",
					"type" => "typography" );  
					          
$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px <a href='http://www.faviconr.com/'>ico image</a> that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload" ); 
                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea" );        

$options[] = array( "name" => "RSS URL",
					"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
					"id" => $shortname."_feed_url",
					"std" => "",
					"type" => "text" );
                    
$options[] = array( "name" => "E-Mail Subscription URL",
					"desc" => "Enter your preferred E-mail subscription URL. (Feedburner or other)",
					"id" => $shortname."_subscribe_email",
					"std" => "",
					"type" => "text" );

$options[] = array( "name" => "Contact Form E-Mail",
					"desc" => "Enter your E-mail address to use on the Contact Form Page Template. Add the contact form by adding a new page and selecting 'Contact Form' as page template.",
					"id" => $shortname."_contactform_email",
					"std" => "",
					"type" => "text" );

$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea" );

$options[] = array( "name" => "Post/Page Comments",
					"desc" => "Select if you want to enable/disable comments on posts and/or pages. ",
					"id" => $shortname."_comments",
					"type" => "select2",
					"options" => array( "post" => "Posts Only", "page" => "Pages Only", "both" => "Pages / Posts", "none" => "None") );                                                          
    
$options[] = array( "name" => "Post Content",
					"desc" => "Select if you want to show the full content or the excerpt on posts. ",
					"id" => $shortname."_post_content",
					"type" => "select2",
					"options" => array( "excerpt" => "The Excerpt", "content" => "Full Content" ) );                                                          

$options[] = array( "name" => "Post Author Box",
					"desc" => "This will enable the post author box on the single posts page. Edit description in <a href='".home_url()."/wp-admin/profile.php'>Profile</a>.",
					"id" => $shortname."_post_author",
					"std" => "true",
					"type" => "checkbox" );
					
$options[] = array( "name" => "Display Breadcrumbs",
					"desc" => "Display dynamic breadcrumbs on each page of your website.",
					"id" => $shortname."_breadcrumbs_show",
					"std" => "false",
					"type" => "checkbox" );
				
$options[] = array( "name" => "Pagination Style",
					"desc" => "Select the style of pagination you would like to use on the blog.",
					"id" => $shortname."_pagination_type",
					"type" => "select2",
					"options" => array( "paginated_links" => "Numbers", "simple" => "Next/Previous" ) );
// Styling 

$options[] = array( "name" => "Styling Options",
					"type" => "heading",
					"icon" => "styling" );   
					
$options[] = array( "name" =>  "Body Background Color",
					"desc" => "Pick a custom color for background color of the theme e.g. #697e09",
					"id" => "woo_body_color",
					"std" => "",
					"type" => "color" );
					
/*

// Won't work well with this theme


$options[] = array( "name" => "Body background image",
					"desc" => "Upload an image for the theme's background",
					"id" => $shortname."_body_img",
					"std" => "",
					"type" => "upload" );
					
$options[] = array( "name" => "Background image repeat",
                    "desc" => "Select how you would like to repeat the background-image",
                    "id" => $shortname."_body_repeat",
                    "std" => "no-repeat",
                    "type" => "select",
                    "options" => array( "no-repeat","repeat-x","repeat-y","repeat"));

$options[] = array( "name" => "Background image position",
                    "desc" => "Select how you would like to position the background",
                    "id" => $shortname."_body_pos",
                    "std" => "top",
                    "type" => "select",
                    "options" => array( "top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right"));

*/

$options[] = array( "name" =>  "Link Color",
					"desc" => "Pick a custom color for links or add a hex color code e.g. #697e09",
					"id" => "woo_link_color",
					"std" => "",
					"type" => "color" );   

$options[] = array( "name" =>  "Link Hover Color",
					"desc" => "Pick a custom color for links hover or add a hex color code e.g. #697e09",
					"id" => "woo_link_hover_color",
					"std" => "",
					"type" => "color" );                    

$options[] = array( "name" =>  "Button Color",
					"desc" => "Pick a custom color for buttons or add a hex color code e.g. #697e09",
					"id" => "woo_button_color",
					"std" => "",
					"type" => "color" );          

/* Typography */	
				
$options[] = array( "name" => "Typography",
					"type" => "heading",
					"icon" => "typography" );   

$options[] = array( "name" => "Enable Custom Typography",
					"desc" => "Enable the use of custom typography for your site. Custom styling will be output in your sites HEAD.",
					"id" => $shortname."_typography",
					"std" => "false",
					"type" => "checkbox" ); 									   

$options[] = array( "name" => "General Typography",
					"desc" => "Change the general font.",
					"id" => $shortname."_font_body",
					"std" => array( 'size' => '13','unit' => 'px','face' => 'Arial','style' => '','color' => '#ededed'),
					"type" => "typography" );  

$options[] = array( "name" => "Navigation",
					"desc" => "Change the navigation font.",
					"id" => $shortname."_font_nav",
					"std" => array( 'size' => '13','unit' => 'px','face' => 'Ubuntu','style' => '','color' => '#ebebeb'),
					"type" => "typography" );  

$options[] = array( "name" => "Post Title",
					"desc" => "Change the post title.",
					"id" => $shortname."_font_post_title",
					"std" => array( 'size' => '24','unit' => 'px','face' => 'Droid Serif','style' => '','color' => '#ffffff'),
					"type" => "typography" );  
					          
$options[] = array( "name" => "Post Entry",
					"desc" => "Change the post entry.",
					"id" => $shortname."_font_post_entry",
					"std" => array( 'size' => '14','unit' => 'px','face' => 'Arial','style' => '','color' => '#ffffff'),
					"type" => "typography" );  

$options[] = array( "name" => "Widget Titles",
					"desc" => "Change the widget titles.",
					"id" => $shortname."_font_widget_titles",
					"std" => array( 'size' => '14','unit' => 'px','face' => 'Ubuntu','style' => '','color' => '#ffffff'),
					"type" => "typography" );  

/* Layout */ 

$options[] = array( "name" => "Layout Options",
					"type" => "heading",
					"icon" => "layout" );   
					 					                   
$url =  get_template_directory_uri() . '/functions/images/';
$options[] = array( "name" => "Main Layout",
					"desc" => "Select which layout you want for your site.",
					"id" => $shortname."_site_layout",
					"std" => "layout-left-content",
					"type" => "images",
					"options" => array(
						'layout-left-content' => $url . '2cl.png',
						'layout-right-content' => $url . '2cr.png')
					); 

$options[] = array( "name" => "Homepage - Page Content Area #1",
          "desc" => "(Optional) Select a page that you'd like to display on the front page <strong>above the widgetized area</strong>.",
          "id" => $shortname."_main_page1",
          "std" => "Select a page:",
			"type" => "select",
			"options" => $woo_pages);   

$options[] = array( "name" => "Homepage - Page Content Area #2",
          "desc" => "(Optional) Select a page that you'd like to display on the front page <strong>below the widgetized area</strong>",
          "id" => $shortname."_main_page2",
          "std" => "Select a page:",
			"type" => "select",
			"options" => $woo_pages);   

								
$options[] = array( "name" => "Header",
					"type" => "heading",
					"icon" => "header" );
                    
$options[] = array( "name" => "Enable Right Header",
                    "desc" => "Select to enable the this area in the top right header.",
                    "id" => $shortname."_header_right",
                    "std" => "true",
                    "type" => "checkbox"); 
                                                          					
$options[] = array( "name" => "Enable Right Header Text",
                    "desc" => "Select to enable the right header textarea.",
                    "id" => $shortname."_header_right_content",
                    "std" => "true",
                    "type" => "checkbox");                     

$options[] = array( "name" => "Right Header Text",
                    "desc" => "Add an optional text to show in your top right header area.",
                    "id" => $shortname."_header_right_text",
                    "std" => "<strong>What We Do</strong><br />We are experts when it comes to leasing, buying, selling, or developing retail properties and land.",
                    "type" => "textarea");
                    
$options[] = array( "name" => "Enable Call-To-Action Button",
                    "desc" => "Select to enable the call-to-action button.",
                    "id" => $shortname."_header_right_btn",
                    "std" => "true",
                    "type" => "checkbox");                     

$options[] = array( "name" => "Button Text",
                    "desc" => "Text to show in the call-to-action button.",
                    "id" => $shortname."_header_right_btn_text",
                    "std" => "Meet our team",
                    "type" => "text"); 
                    
$options[] = array( "name" => "Button Link",
                    "desc" => "The full URL where you want the button to link to e.g http://yoursite.com/meet-the-team/",
                    "id" => $shortname."_header_right_btn_link",
                    "std" => "#",
                    "type" => "text");                                          											   

/* Slider */
$options[] = array( "name" => "Homepage Slider",
					"icon" => "slider",
					"type" => "heading");
					
$options[] = array( "name" => "Enable Slider",
                    "desc" => "Enable the slider on the homepage.",
                    "id" => $shortname."_slider",
                    "std" => "true",
                    "type" => "checkbox");

$options[] = array(    "name" => "Slider Entries",
                    "desc" => "Select the number of entries that should appear in the home page slider.",
                    "id" => $shortname."_slider_entries",
                    "std" => "3",
                    "type" => "select",
                    "options" => $other_entries);

$options[] = array( "name" => "Effect",
					"desc" => "Select the animation effect. ",
					"id" => $shortname."_slider_effect",
					"type" => "select2",
					"options" => array("slide" => "Slide", "fade" => "Fade") );     

$options[] = array( "name" => "Animation Speed",
                    "desc" => "The time in <b>seconds</b> the animation between frames will take.",
                    "id" => $shortname."_slider_speed",
                    "std" => "0.6",
					"type" => "select",
					"options" => array( '0.0', '0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1.0', '1.1', '1.2', '1.3', '1.4', '1.5', '1.6', '1.7', '1.8', '1.9', '2.0' ) );

$options[] = array( "name" => "Hover Pause",
                    "desc" => "Hovering over slideshow will pause it",
                    "id" => $shortname."_slider_hover",
                    "std" => "false",
                    "type" => "checkbox"); 

$options[] = array( "name" => "Randomize",
                    "desc" => "Select to randomize slides.",
                    "id" => $shortname."_slider_random",
                    "std" => "false",
                    "type" => "checkbox"); 
                                        
$options[] = array( "name" => 'Auto Height',
						"desc" => 'Set the slider to adjust automatically depending on the height of the current slide contents.',
						"id" => $shortname."_slider_autoheight",
						"std" => "false",
						"type" => "checkbox");   

$options[] = array( "name" => "Slider Height",
                    "desc" => "The fixed height in pixels of the slider if the Auto Height feature is disabled.",
                    "id" => $shortname."_slider_fixed_height",
                    "std" => "320",
                    "type" => "text");

$options[] = array(    "name" => "Auto Start",
                    "desc" => "Set the slider to start sliding automatically.",
                    "id" => $shortname."_slider_auto",
                    "std" => "false",
                    "type" => "checkbox");   
                                        
$options[] = array(    "name" => "Auto Slide Interval",
                    "desc" => "The time in <b>seconds</b> each slide pauses for, before sliding to the next.",
                    "id" => $shortname."_slider_interval",
                    "std" => "6",
					"type" => "select",
					"options" => array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10' ) );
                    
$options[] = array( "name" => __( 'Show Title with Image Background', 'woothemes' ),
					"desc" => __( 'Show the post title when using an image as slider background.', 'woothemes' ),
					"id" => $shortname."_slider_title",
					"std" => "false",
					"type" => "checkbox");  
					
$options[] = array( "name" => __( 'Show Excerpt with Image Background', 'woothemes' ),
					"desc" => __( 'Show the post excerpt when using an image as slider background.', 'woothemes' ),
					"id" => $shortname."_slider_content",
					"std" => "false",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Next/Previous",
                    "desc" => "Select to display next/previous buttons.",
                    "id" => $shortname."_slider_nextprev",
                    "std" => "true",
                    "type" => "checkbox"); 

$options[] = array( "name" => "Pagination",
                    "desc" => "Select to display pagination.",
                    "id" => $shortname."_slider_pagination",
                    "std" => "true",
                    "type" => "checkbox"); 

/* Portfolio */
$options[] = array( "name" => "Portfolio",
                    "icon" => "portfolio",
					"type" => "heading");    		
					
$options[] = array( "name" => "Portfolio Tags",
					"desc" => "Enter comma seperated tags for portfolio sorting (e.g. web, print, icons). You must add these tags to the portfolio items you want to sort.",
					"id" => $shortname."_portfolio_tags",
					"std" => "",
					"type" => "text");
												
$options[] = array( "name" => "Custom permalink",
          			"desc" => "This option allows you to change the permalink on the individual portfolio pages. (e.g /portfolio-items/pagename to /artwork/pagename/). Please update <a href='". admin_url('options-permalink.php')."'>Permalinks</a> after any changes.",
          			"id" => $shortname."_portfolioitems_rewrite",
          			"std" => "portfolio-items",
          			"type" => "text"); 
          			
$options[] = array( "name" => "Enable Single Portfolio Gallery",
					"desc" => "Enable the gallery feature in the single portfolio page layout.",
					"id" => $shortname."_portfolio_gallery",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Animation Speed",
                    "desc" => "The time in <b>seconds</b> the animation between frames will take.",
                    "id" => $shortname."_single_speed",
                    "std" => "0.6",
					"type" => "select",
					"options" => array( '0.0', '0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1.0', '1.1', '1.2', '1.3', '1.4', '1.5', '1.6', '1.7', '1.8', '1.9', '2.0' ) );

$options[] = array(    "name" => "Auto Start",
                    "desc" => "Set the slider to start sliding automatically.",
                    "id" => $shortname."_single_auto",
                    "std" => "false",
                    "type" => "checkbox");   
                    
$options[] = array(    "name" => "Auto Slide Interval",
                    "desc" => "The time in <b>seconds</b> each slide pauses for, before sliding to the next.",
                    "id" => $shortname."_single_interval",
                    "std" => "6",
					"type" => "select",
					"options" => array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10' ) );

$options[] = array( "name" => "Enable Lightbox",
                    "desc" => "Select to show the large photo(s) in a lightbox window when the gallery thumbnail is clicked. If disabled, clicking the photo thumbnail will take you to the single photo page.",
                    "id" => $shortname."_gallery_lightbox",
                    "std" => "true",
                    "type" => "checkbox"); 
                    
$options[] = array( "name" => "Lightbox Group",
					"desc" => "Select how the lightbox should group multiple photos.",
					"id" => $shortname."_gallery_lightbox_group",
					"type" => "select2",
					"std" => "post",
					"options" => array( "none" => "None", "post" => "Per photo", "all" => "All photos" ) );   
					                    
/* Dynamic Images */
$options[] = array( "name" => "Dynamic Images",
					"type" => "heading",
					"icon" => "image" );    
				    				   
$options[] = array( "name" => 'Dynamic Image Resizing',
					"desc" => "",
					"id" => $shortname."_wpthumb_notice",
					"std" => 'There are two alternative methods of dynamically resizing the thumbnails in the theme, <strong>WP Post Thumbnail</strong> or <strong>TimThumb - Custom Settings panel</strong>. We recommend using WP Post Thumbnail option.',
					"type" => "info");					

$options[] = array( "name" => "WP Post Thumbnail",
					"desc" => "Use WordPress post thumbnail to assign a post thumbnail. Will enable the <strong>Featured Image panel</strong> in your post sidebar where you can assign a post thumbnail.",
					"id" => $shortname."_post_image_support",
					"std" => "true",
					"class" => "collapsed",
					"type" => "checkbox" );

$options[] = array( "name" => "WP Post Thumbnail - Dynamic Image Resizing",
					"desc" => "The post thumbnail will be dynamically resized using native WP resize functionality. <em>(Requires PHP 5.2+)</em>",
					"id" => $shortname."_pis_resize",
					"std" => "true",
					"class" => "hidden",
					"type" => "checkbox" );

$options[] = array( "name" => "WP Post Thumbnail - Hard Crop",
					"desc" => "The post thumbnail will be cropped to match the target aspect ratio (only used if 'Dynamic Image Resizing' is enabled).",
					"id" => $shortname."_pis_hard_crop",
					"std" => "true",
					"class" => "hidden last",
					"type" => "checkbox" );

$options[] = array( "name" => "TimThumb - Custom Settings Panel",
					"desc" => "This will enable the <a href='http://code.google.com/p/timthumb/'>TimThumb</a> (thumb.php) script which dynamically resizes images added through the <strong>custom settings panel below the post</strong>. Make sure your themes <em>cache</em> folder is writable. <a href='http://www.woothemes.com/2008/10/troubleshooting-image-resizer-thumbphp/'>Need help?</a>",
					"id" => $shortname."_resize",
					"std" => "true",
					"type" => "checkbox" );

$options[] = array( "name" => "Automatic Image Thumbnail",
					"desc" => "If no thumbnail is specifified then the first uploaded image in the post is used.",
					"id" => $shortname."_auto_img",
					"std" => "false",
					"type" => "checkbox" );

$options[] = array( "name" => "Thumbnail Image Dimensions",
					"desc" => "Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.",
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_thumb_w',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_thumb_h',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Height')
								  ));
                                                                                                
$options[] = array( "name" => "Thumbnail Image alignment",
					"desc" => "Select how to align your thumbnails with posts.",
					"id" => $shortname."_thumb_align",
					"std" => "alignleft",
					"type" => "radio",
					"options" => array( "alignleft" => "Left","alignright" => "Right","aligncenter" => "Center")); 

$options[] = array( "name" => "Show thumbnail in Single Posts",
					"desc" => "Show the attached image in the single post page.",
					"id" => $shortname."_thumb_single",
					"class" => "collapsed",
					"std" => "false",
					"type" => "checkbox" );    

$options[] = array( "name" => "Single Image Dimensions",
					"desc" => "Enter an integer value i.e. 250 for the image size. Max width is 576.",
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"class" => "hidden last",
					"type" => array( 
									array(  'id' => $shortname. '_single_w',
											'type' => 'text',
											'std' => 200,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_single_h',
											'type' => 'text',
											'std' => 200,
											'meta' => 'Height')
								  ));

$options[] = array( "name" => "Single Post Image alignment",
					"desc" => "Select how to align your thumbnail with single posts.",
					"id" => $shortname."_thumb_single_align",
					"std" => "alignright",
					"type" => "radio",
					"class" => "hidden",
					"options" => array( "alignleft" => "Left","alignright" => "Right","aligncenter" => "Center")); 

$options[] = array( "name" => "Add thumbnail to RSS feed",
					"desc" => "Add the the image uploaded via your Custom Settings to your RSS feed",
					"id" => $shortname."_rss_thumb",
					"std" => "false",
					"type" => "checkbox" );  
					
/* Footer */
$options[] = array( "name" => "Footer Customization",
					"type" => "heading",
					"icon" => "footer" );    
					

$url =  get_template_directory_uri() . '/functions/images/';
$options[] = array( "name" => "Footer Widget Areas",
					"desc" => "Select how many footer widget areas you want to display.",
					"id" => $shortname."_footer_sidebars",
					"std" => "3",
					"type" => "images",
					"options" => array(
						'0' => $url . 'layout-off.png',
						'1' => $url . 'footer-widgets-1.png',
						'2' => $url . 'footer-widgets-2.png',
						'3' => $url . 'footer-widgets-3.png',
						'4' => $url . 'footer-widgets-4.png')
					); 		   
										
$options[] = array( "name" => "Custom Affiliate Link",
					"desc" => "Add an affiliate link to the WooThemes logo in the footer of the theme.",
					"id" => $shortname."_footer_aff_link",
					"std" => "",
					"type" => "text" );	
									
$options[] = array( "name" => "Enable Custom Footer (Left)",
					"desc" => "Activate to add the custom text below to the theme footer.",
					"id" => $shortname."_footer_left",
					"std" => "false",
					"type" => "checkbox" );    

$options[] = array( "name" => "Custom Text (Left)",
					"desc" => "Custom HTML and Text that will appear in the footer of your theme.",
					"id" => $shortname."_footer_left_text",
					"std" => "",
					"type" => "textarea" );
						
$options[] = array( "name" => "Enable Custom Footer (Right)",
					"desc" => "Activate to add the custom text below to the theme footer.",
					"id" => $shortname."_footer_right",
					"std" => "false",
					"type" => "checkbox" );    

$options[] = array( "name" => "Custom Text (Right)",
					"desc" => "Custom HTML and Text that will appear in the footer of your theme.",
					"id" => $shortname."_footer_right_text",
					"std" => "",
					"type" => "textarea" );

/* Subscribe & Connect */
$options[] = array( "name" => "Subscribe & Connect",
					"type" => "heading",
					"icon" => "connect" ); 

$options[] = array( "name" => "Enable Subscribe & Connect - Single Post",
					"desc" => "Enable the subscribe & connect area on single posts. You can also add this as a <a href='".home_url()."/wp-admin/widgets.php'>widget</a> in your sidebar.",
					"id" => $shortname."_connect",
					"std" => 'false',
					"type" => "checkbox" ); 

$options[] = array( "name" => "Subscribe Title",
					"desc" => "Enter the title to show in your subscribe & connect area.",
					"id" => $shortname."_connect_title",
					"std" => '',
					"type" => "text" ); 

$options[] = array( "name" => "Text",
					"desc" => "Change the default text in this area.",
					"id" => $shortname."_connect_content",
					"std" => '',
					"type" => "textarea" ); 

$options[] = array( "name" => "Subscribe By E-mail ID (Feedburner)",
					"desc" => "Enter your <a href='http://www.google.com/support/feedburner/bin/answer.py?hl=en&answer=78982'>Feedburner ID</a> for the e-mail subscription form.",
					"id" => $shortname."_connect_newsletter_id",
					"std" => '',
					"type" => "text" );

$options[] = array( "name" => 'Subscribe By E-mail to MailChimp', 'woothemes',
					"desc" => 'If you have a MailChimp account you can enter the <a href="http://woochimp.heroku.com" target="_blank">MailChimp List Subscribe URL</a> to allow your users to subscribe to a MailChimp List.',
					"id" => $shortname."_connect_mailchimp_list_url",
					"std" => '',
					"type" => "text");

$options[] = array( "name" => "Enable RSS",
					"desc" => "Enable the subscribe and RSS icon.",
					"id" => $shortname."_connect_rss",
					"std" => 'true',
					"type" => "checkbox" ); 

$options[] = array( "name" => "Twitter URL",
					"desc" => "Enter your  <a href='http://www.twitter.com/'>Twitter</a> URL e.g. http://www.twitter.com/woothemes",
					"id" => $shortname."_connect_twitter",
					"std" => '',
					"type" => "text" ); 

$options[] = array( "name" => "Facebook URL",
					"desc" => "Enter your  <a href='http://www.facebook.com/'>Facebook</a> URL e.g. http://www.facebook.com/woothemes",
					"id" => $shortname."_connect_facebook",
					"std" => '',
					"type" => "text" ); 
					
$options[] = array( "name" => "YouTube URL",
					"desc" => "Enter your  <a href='http://www.youtube.com/'>YouTube</a> URL e.g. http://www.youtube.com/woothemes",
					"id" => $shortname."_connect_youtube",
					"std" => '',
					"type" => "text" ); 

$options[] = array( "name" => "Flickr URL",
					"desc" => "Enter your  <a href='http://www.flickr.com/'>Flickr</a> URL e.g. http://www.flickr.com/woothemes",
					"id" => $shortname."_connect_flickr",
					"std" => '',
					"type" => "text" ); 

$options[] = array( "name" => "LinkedIn URL",
					"desc" => "Enter your  <a href='http://www.www.linkedin.com.com/'>LinkedIn</a> URL e.g. http://www.linkedin.com/in/woothemes",
					"id" => $shortname."_connect_linkedin",
					"std" => '',
					"type" => "text" ); 

$options[] = array( "name" => "Delicious URL",
					"desc" => "Enter your <a href='http://www.delicious.com/'>Delicious</a> URL e.g. http://www.delicious.com/woothemes",
					"id" => $shortname."_connect_delicious",
					"std" => '',
					"type" => "text" ); 

$options[] = array( "name" => "Google+ URL",
					"desc" => "Enter your <a href='http://plus.google.com/'>Google+</a> URL e.g. https://plus.google.com/104560124403688998123/",
					"id" => $shortname."_connect_googleplus",
					"std" => '',
					"type" => "text" );

$options[] = array( "name" => "Enable Related Posts",
					"desc" => "Enable related posts in the subscribe area. Uses posts with the same <strong>tags</strong> to find related posts. Note: Will not show in the Subscribe widget.",
					"id" => $shortname."_connect_related",
					"std" => 'true',
					"type" => "checkbox" ); 
							
/* Advertising */
$options[] = array( "name" => "Top Ad (468x60px)",
					"type" => "heading",
					"icon" => "ads" );    

$options[] = array( "name" => "Enable Ad",
					"desc" => "Enable the ad space",
					"id" => $shortname."_ad_top",
					"std" => "false",
					"type" => "checkbox" );    

$options[] = array( "name" => "Adsense code",
					"desc" => "Enter your adsense code (or other ad network code) here.",
					"id" => $shortname."_ad_top_adsense",
					"std" => "",
					"type" => "textarea" );

$options[] = array( "name" => "Image Location",
					"desc" => "Enter the URL to the banner ad image location.",
					"id" => $shortname."_ad_top_image",
					"std" => "http://www.woothemes.com/ads/468x60b.jpg",
					"type" => "upload" );
					
$options[] = array( "name" => "Destination URL",
					"desc" => "Enter the URL where this banner ad points to.",
					"id" => $shortname."_ad_top_url",
					"std" => "http://www.woothemes.com",
					"type" => "text" );                        

$options[] = array( "name" => "Contact Maps",
					"icon" => "maps",
				    "type" => "heading");    

					
$options[] = array( "name" => "Contact Form Google Maps Coordinates",
					"desc" => 'Enter your Google Map coordinates to display a map on the Contact Form page template and a link to it on the Contact Us widget. You can get these details from <a href="http://www.getlatlon.com/" target="_blank">Google Maps</a>',
					"id" => $shortname."_contactform_map_coords",
					"std" => "",
					"type" => "text" );
										
$options[] = array( "name" => "Google Maps API Key",
					"desc" => "Enter your Google Maps API key before using any of Postcard's mapping functionality. <a href='http://code.google.com/apis/maps/signup.html'>Signup for an API key here</a>.",
					"id" => $shortname."_maps_apikey",
					"std" => "",
					"class" => "hidden",
					"type" => "text"); 
					
$options[] = array( "name" => "Disable Mousescroll",
					"desc" => "Turn off the mouse scroll action for all the Google Maps on the site. This could improve usability on your site.",
					"id" => $shortname."_maps_scroll",
					"std" => "",
					"type" => "checkbox");

$options[] = array( "name" => "Map Height",
					"desc" => "Height in pixels for the maps displayed on Single.php pages.",
					"id" => $shortname."_maps_single_height",
					"std" => "250",
					"type" => "text");
					
$options[] = array( "name" => "Default Map Zoom Level",
					"desc" => "Set this to adjust the default in the post & page edit backend.",
					"id" => $shortname."_maps_default_mapzoom",
					"std" => "9",
					"type" => "select2",
					"options" => $zoom);

$options[] = array( "name" => "Default Map Type",
					"desc" => "Set this to the default rendered in the post backend.",
					"id" => $shortname."_maps_default_maptype",
					"std" => "Normal",
					"type" => "select2",
					"options" => array('G_NORMAL_MAP' => 'Normal','G_SATELLITE_MAP' => 'Satellite','G_HYBRID_MAP' => 'Hybrid','G_PHYSICAL_MAP' => 'Terrain'));
					                                              
// Add extra options through function
if ( function_exists( "woo_options_add") )
	$options = woo_options_add($options);

if ( get_option( 'woo_template') != $options) update_option( 'woo_template',$options);      
if ( get_option( 'woo_themename') != $themename) update_option( 'woo_themename',$themename);   
if ( get_option( 'woo_shortname') != $shortname) update_option( 'woo_shortname',$shortname);
if ( get_option( 'woo_manual') != $manualurl) update_option( 'woo_manual',$manualurl);

// Woo Metabox Options
// Start name with underscore to hide custom key from the user
$woo_metaboxes = array();

global $post;

if ( ( get_post_type() == 'post') || ( !get_post_type() ) ) {

	$woo_metaboxes[] = array (	"name" => "image",
								"label" => "Image",
								"type" => "upload",
								"desc" => "Upload an image or enter an URL." );
	
	if ( get_option( 'woo_resize') == "true" ) {						
		$woo_metaboxes[] = array (	"name" => "_image_alignment",
									"std" => "Center",
									"label" => "Image Crop Alignment",
									"type" => "select2",
									"desc" => "Select crop alignment for resized image",
									"options" => array(	"c" => "Center",
														"t" => "Top",
														"b" => "Bottom",
														"l" => "Left",
														"r" => "Right"));
	}

	$woo_metaboxes[] = array (  "name"  => "embed",
					            "std"  => "",
					            "label" => "Embed Code",
					            "type" => "textarea",
					            "desc" => "Enter the video embed code for your video (YouTube, Vimeo or similar)" );
					            
					            
	$woo_metaboxes[] = array (	"name" => "_layout",
								"std" => "normal",
								"label" => "Layout",
								"type" => "images",
								"desc" => "Select the layout you want on this specific post/page.",
								"options" => array(
											'layout-default' => $url . 'layout-off.png',
											'layout-full' => get_template_directory_uri() . '/functions/images/' . '1c.png',
											'layout-left-content' => get_template_directory_uri() . '/functions/images/' . '2cl.png',
											'layout-right-content' => get_template_directory_uri() . '/functions/images/' . '2cr.png'));

					            
					            
} // End post

if ( ( get_post_type() == 'slide') || ( !get_post_type() ) ) {


					         
	$woo_metaboxes[] = array (	"name" => "image",
								"label" => "Image",
								"type" => "upload",
								"desc" => "Upload an image or enter an URL.");					         
					            

	$woo_metaboxes[] = array( 	"name" => "slide_layout",
								"label" => "Slider Overlay Layout",
								"desc" => "Specify where you want the slider overlay content to display",
								"std" => "right",
								"type" => "select2",
									"options" => array(	"left" => "Left",
														"right" => "Right",
														"top" => "Top",
														"bottom" => "Bottom",
														"none" => "None"));
	$woo_metaboxes[] = array (	"name" => "slide-url",
								"label" => "Slide URL",
								"type" => "text",
								"desc" => "Enter a URL for the slide to click through to.");
	
} // End post

if ( get_post_type() == 'portfolio' || !get_post_type() ) {

	$woo_metaboxes[] = array (	"name" => "portfolio-image",
								"label" => "Portfolio Image",
								"type" => "upload",
								"desc" => "Upload an image or enter an URL to your portfolio image");
					            
	$woo_metaboxes[] = array (	"name" => "embed-url",
								"label" => "Video URL",
								"type" => "text",
								"desc" => "Enter a URL to your video (for use in the lightbox on the portfolio page).");
								
	$woo_metaboxes[] = array (  "name"  => "embed",
					            "std"  => "",
					            "label" => "Video Embed Code",
					            "type" => "textarea",
					            "desc" => "Enter the video embed code for your video (YouTube, Vimeo or similar). Will show instead of your image on single portfolio page.");
					            
} //End portfolio

if( get_post_type() == 'feedback' || !get_post_type()){
							
	$woo_metaboxes['feedback_author'] = array (	
								"name" => "feedback_author",
								"label" => "Feedback Author",
								"type" => "text",
								"desc" => "Enter the name of the author of the feedback e.g. Joe Bloggs"
			);
 
	$woo_metaboxes['feedback_url'] = array (	
								"name" => "feedback_url",
								"label" => "Feedback URL",
								"type" => "text",
								"desc" => "(optional) Enter the URL to the feedback author e.g. http://www.woothemes.com"
			);
			
} // End feedback


// Add extra metaboxes through function
if ( function_exists( "woo_metaboxes_add") )
	$woo_metaboxes = woo_metaboxes_add($woo_metaboxes);
    
if ( get_option( 'woo_custom_template' ) != $woo_metaboxes) update_option( 'woo_custom_template', $woo_metaboxes );      

} // END woo_options()
} // END function_exists()

// Add options to admin_head
add_action( 'admin_head','woo_options' );  

//Enable WooSEO on these Post types
$seo_post_types = array( 'post','page' );
define( "SEOPOSTTYPES", serialize($seo_post_types));

//Global options setup
add_action( 'init','woo_global_options' );
function woo_global_options(){
	// Populate WooThemes option in array for use in theme
	global $woo_options;
	$woo_options = get_option( 'woo_options' );
}

?>