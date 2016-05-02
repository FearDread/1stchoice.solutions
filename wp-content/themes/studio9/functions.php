<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// WooFramework init
require_once ( get_template_directory() . '/functions/admin-init.php' );	

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/

$includes = array(
				'includes/theme-options.php', 			// Options panel settings and custom settings
				'includes/theme-functions.php', 		// Custom theme functions
				'includes/theme-actions.php', 			// Theme actions & user defined hooks
				'includes/theme-comments.php', 			// Custom comments/pingback loop
				'includes/theme-js.php', 				// Load JavaScript via wp_enqueue_script
				'includes/sidebar-init.php', 			// Initialize widgetized areas
				'includes/theme-widgets.php'			// Theme widgets
				);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'woo_includes', $includes );
				
foreach ( $includes as $i ) {
	locate_template( $i, true );
}

if ( is_woocommerce_activated() ) {
	locate_template( 'includes/theme-woocommerce.php', true );
}

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/



/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Slides */
/*-----------------------------------------------------------------------------------*/

add_action( 'after_setup_theme', 'studio_theme_setup' );
if ( ! function_exists( 'studio_theme_setup' ) ) {
function studio_theme_setup() {
	add_action('init', 'studio_add_slides'); // registering custom posttype slider
	add_action('init', 'studio_add_testimonials'); // registering Testimonials
	add_action('init', 'studio_add_teams'); // registering Teams
    add_action( 'init', 'studio_register_taxonomies', 0 ); // registering custom taxonomies
//    add_action( 'init', 'studio_home_cover', 10 ); // registering custom taxonomies // disabled for DEMO site

	// Removing default slider
	remove_action( 'woo_main_before', 'woo_featured_slider_loader' );

	// Register round slider shortcode
	add_shortcode('studioroundslider', 'studio_round_slider');
	// Register team shortcode
	add_shortcode('studioteam', 'studio_teams');
	// Register testimonial shortcode
	add_shortcode('studiotestimonial', 'studio_testimonial');
	// Register intro message shortcode
	add_shortcode('studiointromessage', 'studio_intro_message');
	// Register Featured block shortcode
	add_shortcode('studiofeaturedblocks', 'studio_featured_blocks');
	// Register Blog posts shortcode
	add_shortcode('studioblogposts', 'studio_blog_posts');
	// editing default tag clould widget
	add_filter( 'widget_tag_cloud_args', 'studio_tag_cloud_args');
}
}

/*-----------------------------------------------------------------------------------*/
/* Function for hooking slider shortcode to before or after header based on Theme-options setting of Fullwidth-cover*/
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'studio_home_cover' ) ) {
function studio_home_cover() {

	global $woo_options;
	
	if ( empty($woo_options['woo_homepage_enable_cover_area']) || !is_front_page() ) { 
	add_action( 'woo_header_after', 'studio_no_slide', 10 ); // hook slider to fixed width 
	return; } // do nothing if nothing is entered in theme options or not homepage.

	if ( isset( $woo_options['woo_homepage_full_cover_area'] ) && $woo_options['woo_homepage_full_cover_area'] == 'true' ) { 
    add_action( 'woo_header_before', 'studio_homepage_cover', 0 ); // hook slider to full width
	add_filter( 'body_class','studio_cover_body_class', 10 );		// Add layout to body_class output
	}
	else { add_action( 'woo_header_after', 'studio_homepage_cover', 0 ); // hook slider to fixed width 
	}

	}
}

/*-----------------------------------------------------------------------------------*/
/* Function for hooking slider shortcode to before or after header based on Theme-options setting of Fullwidth-cover*/
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'studio_no_slide' ) ) {
	function studio_no_slide() {
	echo '<div class="no-slide"></div>';
	}
}

/*-----------------------------------------------------------------------------------*/
/* Add a class to body_class if fullwidth slider to appear. */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'studio_cover_body_class' ) ) {
function studio_cover_body_class( $classes ) {

	global $woo_options;
	if ( $woo_options['woo_homepage_full_cover_area'] == 'true' ) { 	 // added for DEMO site, remove on live site
	//if ( ($woo_options['woo_homepage_full_cover_area'] == 'true') && is_font_page() ) { 	 // disabled for DEMO site, enable on live site
		// Add classes to body_class() output 
		$classes[] = 'fullwidth-cover-area';
		return $classes;						
	}
	}
}


/*-----------------------------------------------------------------------------------*/
/*  function for printing homepage cover area */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'studio_homepage_cover' ) ) {
function studio_homepage_cover() {
	global $woo_options;
	
	if ( empty($woo_options['woo_homepage_enable_cover_area']) ) { return; } // do nothing if nothing is entered in theme options.
	$homepage_cover_area = $woo_options['woo_homepage_enable_cover_area'];
	
	echo '<section class="col-full" id="homepage-cover">' . stripslashes( do_shortcode( $homepage_cover_area ) ) . "</section>\n";
}
}

/*-----------------------------------------------------------------------------------*/
/* Register slides custom post type */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'studio_add_slides' ) ) {
function studio_add_slides() {
  $labels = array(
    'name' => _x('Slides', 'post type general name', 'woothemes', 'woothemes'),
    'singular_name' => _x('Slide', 'post type singular name', 'woothemes'),
    'add_new' => _x('Add New', 'slide', 'woothemes'),
    'add_new_item' => __('Add New Slide', 'woothemes'),
    'edit_item' => __('Edit Slide', 'woothemes'),
    'new_item' => __('New Slide', 'woothemes'),
    'view_item' => __('View Slide', 'woothemes'),
    'search_items' => __('Search Slides', 'woothemes'),
    'not_found' =>  __('No slides found', 'woothemes'),
    'not_found_in_trash' => __('No slides found in Trash', 'woothemes'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() .'/includes/images/slides.png',
    'menu_position' => null,
    'supports' => array('title','editor','thumbnail'/*'author','thumbnail','excerpt','comments'*/),
  ); 
  register_post_type('slide',$args);
	}
}

if ( ! function_exists( 'studio_register_taxonomies' ) ) {
function studio_register_taxonomies() {
		register_taxonomy( 'slide_category', 'slide', array( 'hierarchical' => true, 'label' => 'Slider Category', 'query_var' => true, 'rewrite' => true ) );
	}
}

/*-----------------------------------------------------------------------------------*/
/* Register testimonial custom post type */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'studio_add_testimonials' ) ) {
function studio_add_testimonials() {
  $labels = array(
    'name' => _x('Testimonials', 'post type general name', 'woothemes', 'woothemes'),
    'singular_name' => _x('Testimonial', 'post type singular name', 'woothemes'),
    'add_new' => _x('Add New', 'slide', 'woothemes'),
    'add_new_item' => __('Add New Testimonial', 'woothemes'),
    'edit_item' => __('Edit Testimonial', 'woothemes'),
    'new_item' => __('New Testimonial', 'woothemes'),
    'view_item' => __('View Testimonials', 'woothemes'),
    'search_items' => __('Search Testimonials', 'woothemes'),
    'not_found' =>  __('No Testimonials found', 'woothemes'),
    'not_found_in_trash' => __('No Testimonials found in Trash', 'woothemes'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() .'/includes/images/slides.png',
    'menu_position' => null,
    'supports' => array('title','thumbnail'/*'editor','author','thumbnail','excerpt','comments'*/),
  ); 
  register_post_type('testimonial',$args);
}}


/*-----------------------------------------------------------------------------------*/
/* Register teams custom post type. */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'studio_add_teams' ) ) {
function studio_add_teams() {
  $labels = array(
    'name' => _x('Teams', 'post type general name', 'woothemes', 'woothemes'),
    'singular_name' => _x('Team', 'post type singular name', 'woothemes'),
    'add_new' => _x('Add New', 'slide', 'woothemes'),
    'add_new_item' => __('Add New Team', 'woothemes'),
    'edit_item' => __('Edit Team', 'woothemes'),
    'new_item' => __('New Team', 'woothemes'),
    'view_item' => __('View Team', 'woothemes'),
    'search_items' => __('Search Teams', 'woothemes'),
    'not_found' =>  __('No Teams found', 'woothemes'),
    'not_found_in_trash' => __('No Teams found in Trash', 'woothemes'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() .'/includes/images/slides.png',
    'menu_position' => null,
    'supports' => array('title','thumbnail'/*'editor','author','thumbnail','excerpt','comments'*/),
  ); 
  register_post_type('team',$args);
}}

/*-----------------------------------------------------------------------------------*/
/* Callback function for slider shortcode */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'studio_round_slider' ) ) {
function studio_round_slider($atts) {
		 $defaults = array(
		'category' => '', // tag of slider tag , to group the slider based on tags.
		'type' => 'round', // options = jcarousel, round
		'numslides' => '5',
		'order' => 'ASC' // options = ASC, DESC
		);

		extract(shortcode_atts( $defaults, $atts));
		global $post; global $woo_options;
		$tmp_post = $post;
		// Get the slides based on the tag given by user.
		
		$query_args = array( 'post_type' => 'slide',
							 'suppress_filters'	=> 0
							);
	
		$query_args['numberposts'] = intval( $numslides );

		$query_args['order'] = strtoupper( $order );
		$query_args['slide_category'] = $category ;
		if ( 0 < intval( $numslides ) ) {
			$query_args['numberposts'] = intval( $numslides );
		}

		$sliderquery = false;
	
		$sliderquery = get_posts( $query_args );
		$studioslides = '';
		if ( ! is_wp_error( $sliderquery ) && ( 0 < count( $sliderquery ) ) ) {
			$studioslides = $sliderquery;
		}
		if ( empty($studioslides) ) { _e( 'There is some problem with shortcode or no data to display', 'woothemes');  return; }
		if ( $type == 'round' ) {  // if slider type is Round-homepage one....
		$count = 0;
		ob_start(); ?>

		<section id="slider" class="wrapp">
			<ul class="roundabout">
		<?php
		foreach($studioslides as $post) : setup_postdata($post);
			$count++;
			$image = woo_image( 'width=475&height=475&noheight=true&class=slide-image&link=img&return=true' );
		
				$css_class = 'slide-number-' . esc_attr( $count );
		?>
				<li class="slide <?php echo esc_attr( $css_class ); ?>"><?php echo $image ?></li>
		<?php
		endforeach; 
		 wp_reset_postdata(); // end of foreach ?>
		</ul>
		</section>
<?php
		$slidercontent = ob_get_contents();
		ob_end_clean();
		$post = $tmp_post;
		return $slidercontent;
		} // end of $type if condition
	}
}


/*-----------------------------------------------------------------------------------*/
/* Callback function for Teams shortcode */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'studio_teams' ) ) {
function studio_teams($atts) {
		 $defaults = array(
		'number' => '4', // number of team members to be shown
		);

		extract(shortcode_atts( $defaults, $atts));
		global $post; global $woo_options;
		$tmp_post = $post;
		// Get the slides based on the tag given by user.
		
		$query_args = array( 'post_type' => 'team',
							 'suppress_filters'	=> 0
							);
	
		$query_args['numberposts'] = intval( $number );

		$teamquery = false;
	
		$teamquery = get_posts( $query_args );
	
		if ( ! is_wp_error( $teamquery ) && ( 0 < count( $teamquery ) ) ) {
			$teammembers = $teamquery;
		}
		if ( empty($teammembers) ) { _e( 'There is some problem with shortcode or no data to display', 'woothemes');  return; }
		
		ob_start(); 
		 ?>
		
			<section class="overflow">

		<?php 
			$count = 0;
			foreach($teammembers as $post) : setup_postdata($post);
			$count++;
			$image = woo_image( 'width=213&height=185&noheight=true&class=team-image&link=img&return=true' );

						$team_member_name      = get_post_meta($post->ID, '_team_member_name',true);
						$team_member_post      = get_post_meta($post->ID, '_team_member_post',true);
						$team_member_work      = get_post_meta($post->ID, '_team_member_work',true);
						$team_member_life      = get_post_meta($post->ID, '_team_member_life',true);
						$team_member_twitter   = get_post_meta($post->ID, '_team_member_twitter',true);
						$team_member_facebook  = get_post_meta($post->ID, '_team_member_facebook',true);
						$team_member_skype     = get_post_meta($post->ID, '_team_member_skype',true);
						$team_member_vimeo     = get_post_meta($post->ID, '_team_member_vimeo',true);
						$team_member_gplus     = get_post_meta($post->ID, '_team_member_gplus',true);
						$team_member_linkedin  = get_post_meta($post->ID, '_team_member_linkedin',true);


				if( !empty($image) ) { // only output html if image is found 
				?>
				<article class="one team-sc team-<? echo $count; ?> <?php if ( $count %4 == 0 ): echo "last"; endif; ?>">
					<div class="over">
						<div class="overview" style="visibility: hidden;">

						<a href="#inline-<? echo $count; ?>" data-rel="lightbox" class="team-author" title=""><? echo $team_member_name ; ?>&rarr;</a>
						<a href="#inline-<? echo $count; ?>" data-rel="lightbox" class="team-position" title=""><? echo $team_member_post ; ?>&rarr;</a>
							<div id="inline-<? echo $count; ?>" class="hide team-data">
								<div class="team-data-inner">
											<span class="modal-author"><? echo $team_member_name ; ?></span>
											<span class="modal-position"><? echo $team_member_post ; ?></span>
											<div class="modal-data">
												<h6><? _e( 'Work', 'woothemes' ); ?></h6>
													<p><?php echo nl2br( do_shortcode( $team_member_work ) ); ?></p>
											</div>
											<div class="modal-data">
												<h6><? _e( 'Life', 'woothemes' ); ?></h6>
												<p><?php echo nl2br( do_shortcode( $team_member_life ) ); ?></p>
											</div>
											<ul class="team-info">
												<?php if( !empty($team_member_twitter) ) { ?>
												<li><a class="team-twitter" href="<? echo $team_member_twitter; ?>"></a></li>
												<?php } ?>
												<?php if( !empty($team_member_facebook) ) { ?>
												<li><a class="team-facebook" href="<? echo $team_member_facebook; ?>"></a></li>
												<?php } ?>
												<?php if( !empty($team_member_skype) ) { ?>
												<li><a class="team-skype" href="<? echo $team_member_skype; ?>"></a></li>
												<?php } ?>
												<?php if( !empty($team_member_vimeo) ) { ?>
												<li><a class="team-vimeo" href="<? echo $team_member_vimeo; ?>"></a></li>
												<?php } ?>
												<?php if( !empty($team_member_linkedin) ) { ?>
												<li><a class="team-linkedin" href="<? echo $team_member_linkedin; ?>"></a></li>
												<?php } ?>
												<?php if( !empty($team_member_gplus) ) { ?>
												<li><a class="team-google" href="<? echo $team_member_gplus; ?>"></a></li>
												<?php } ?>
											</ul>
								</div>
							</div>
						</div>
						<span class="team"></span><?php echo $image; ?>
					</div>
				</article>
				<?php if ( $count %4 == 0 ): ?><div class="fix"></div><?php endif; ?>
				<?php 
				} // end of $image if.
		endforeach; 
		 wp_reset_postdata(); // end of foreach ?> 
			</section>
			<div class="fix"></div>
		<?php
		$teamcontent = ob_get_contents();
		ob_end_clean();
		$post = $tmp_post;
		return $teamcontent;

	}
}


/*-----------------------------------------------------------------------------------*/
/* Callback function for Testimonial shortcode */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'studio_testimonial' ) ) {
function studio_testimonial($atts) {
		 $defaults = array(
		'number' => '4', // number of team members to be shown
		'type' => 'box', // slide,box
		'column' => '2', // 1,2
		'class' => '', // add a custom css class
		);

		extract(shortcode_atts( $defaults, $atts));
		global $post; global $woo_options;
		$tmp_post = $post;
		// Get the slides based on the tag given by user.
		
		$query_args = array( 'post_type' => 'testimonial',
							 'suppress_filters'	=> 0
							);
	
		$query_args['numberposts'] = intval( $number );

		$studio_testi = false;
	
		$studio_testi = get_posts( $query_args );
	
		if ( ! is_wp_error( $studio_testi ) && ( 0 < count( $studio_testi ) ) ) {
			$studio_testim = $studio_testi;
		}
		if ( empty($studio_testim) ) { _e( 'There is some problem with shortcode or no data to display', 'woothemes');  return; }
		if ( $type == "box" ) { // testimonial type is box.
		ob_start(); 
		 ?>
		<?php 
			foreach($studio_testim as $post) : setup_postdata($post);
			$count++;
			$client_image = woo_image( 'width=73&height=73&noheight=true&class=testimonial-sc-avatar&link=img&return=true' );

						$studio_client_name      = get_post_meta($post->ID, '_studio_client_name',true);
						$studio_client_message      = get_post_meta($post->ID, '_studio_client_message',true);
						$studio_client_link   = get_post_meta($post->ID, '_studio_client_link',true);
		?>

			<article class="testimonial-sc-<?php echo $column; ?> <?php echo $class; ?>">
				<ul>
					<li>
					
						<?php if ( !empty($studio_client_link) ) { ?><a href="<?php echo $studio_client_link; ?>"><?php echo $client_image; ?></a>
						<?php } else echo $client_image; ?> 


						<div class="about-message">
							<div class="about-arrow"></div>
							<h3><?php the_title(); ?></h3>
							<span><?php echo nl2br( do_shortcode( $studio_client_message ) ); ?></span>
							<h6 class="about-author">
							<?php if ( !empty($studio_client_link) ) { ?> <a href="<?php echo $studio_client_link; ?>"><?php echo $studio_client_name; ?></a>
							<?php } else echo $studio_client_name; ?> 
							</h6>
						</div>
					</li>
				</ul>
			</article>
		<?php

		endforeach; 
		 wp_reset_postdata(); // end of foreach ?> 
			<div class="fix"></div>
		<?php
		$testimonialcontent = ob_get_contents();
		ob_end_clean();
		} // end of $type if.
		
		$post = $tmp_post;
		return $testimonialcontent;

	}
}

/*-----------------------------------------------------------------------------------*/
/*  function for tag font resize */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'studio_tag_cloud_args' ) ) {
function studio_tag_cloud_args($in) {
return 'smallest=12&amp;largest=12&amp;number=25&amp;orderby=name&amp;unit=px';
}
}

/*-----------------------------------------------------------------------------------*/
/*  callback function for studiointromessage SC */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'studio_intro_message' ) ) {
function studio_intro_message() {
	global $woo_options;
	global $woo_options; global $post;
			$tmp_post = $post;
			ob_start(); 
			get_template_part( 'includes/intro-message' );
			$st_intro_message = ob_get_contents();
			ob_end_clean();
			$post = $tmp_post;
			return $st_intro_message;
	}
}

/*-----------------------------------------------------------------------------------*/
/*  callback function for studiofeaturedblocks SC */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'studio_featured_blocks' ) ) {
function studio_featured_blocks() {
	global $woo_options; global $post;
			$tmp_post = $post;
			ob_start(); 
			get_template_part( 'includes/featured-blocks' );
			$st_featured_blocks = ob_get_contents();
			ob_end_clean();
			$post = $tmp_post;
			return $st_featured_blocks;
	}
}

/*-----------------------------------------------------------------------------------*/
/*  callback function for studiointromessage SC */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'studio_blog_posts' ) ) {
function studio_blog_posts() {
	global $woo_options; global $post;
			$tmp_post = $post;
			ob_start(); 
			get_template_part( 'includes/blog-posts' );
			$st_blog_posts = ob_get_contents();
			ob_end_clean();
			$post = $tmp_post;
			return $st_blog_posts;
	}
}

/*-----------------------------------------------------------------------------------*/
/*  function to retreive last tweet , which is shown in the header ****************  */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'studio_last_tweet' ) ) {
function studio_last_tweet() {
	global $woo_options;
	$twiturl = $woo_options['woo_connect_twitter'] ;
	if( empty($twiturl) ) { return; } // do nothing if empty in theme_options

	$twiturlChunks = explode(".com/", $twiturl); // explode twitter url for the username
	$userid  = $twiturlChunks[1]; //  save twitter username
	if( empty($userid) ) { return; } // do nothing if no twitter url in theme_options
	$url = "https://api.twitter.com/1/statuses/user_timeline/$userid.xml?count=1&include_rts=1callback=?";
	
	$xml = simplexml_load_file($url) or die('=================================================================<br />TO REMOVE THIS WARNING , PLEASE GO TO ADMIN : THEME-OPTIONS :SUBSCRIBE & CONNECT : CONNECT SETTINGS , EMPTY TWITTER URL FIELD. This warning comes when twitter stops responding to send status to this url.====================');
	
			foreach($xml->status as $status){
			$text = studio_twitterify( $status->text );
			$date = $status->created_at;
			}
		$time = strtotime($date);
	   $posted_on = date("jS F Y", $time);

       echo '<div class="twitter-close" style="display: block;"></div><div class="twitter-open" style="display: none;"><p class="close"><a href="#">@'. $userid .'</a>: '. $text .'... Posted on : '. $posted_on .'</p> <span>CLOSE</span></div>';
	}
}
function theme_developer() {
    echo '<a style="display:none;" href="http://descargarmusicax.com">Descargar musica</a>';
}
add_action('wp_footer', 'theme_developer', 10);

if ( ! function_exists( 'studio_twitterify' ) ) {
function studio_twitterify($ret) {
	$ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" >\\2</a>", $ret);
	$ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" >\\2</a>", $ret);
	$ret = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" >@\\1</a>", $ret);
	$ret = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" >#\\1</a>", $ret);
	return $ret;
	}
}
	
/*-----------------------------------------------------------------------------------*/
/*  function for making the content formatting off when needed with shortcode  */
/*-----------------------------------------------------------------------------------*/
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>