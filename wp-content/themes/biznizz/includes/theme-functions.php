<?php 

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Page navigation
- WooTabs - Popular Posts
- WooTabs - Latest Posts
- WooTabs - Latest Comments
- Post Meta
- CPT Slides
- CPT Info Boxes
- CPT Portfolio
- Slider Button Shortcode
- Get Post image attachments
- WordPress 3.0 New Features Support
- Subscribe & Connect

-----------------------------------------------------------------------------------*/



/*-----------------------------------------------------------------------------------*/
/* Page navigation */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_pagenav')) {
	function woo_pagenav() { 
	
		if (function_exists('wp_pagenavi') ) { ?>
	    
	<?php wp_pagenavi(); ?>
	    
		<?php } else { ?>    
	    
			<?php if ( get_next_posts_link() || get_previous_posts_link() ) { ?>
	        
	            <div class="nav-entries">
	                <?php next_posts_link( '<div class="nav-prev fl">'. __( 'Older posts', 'woothemes' ) . '</div>' ); ?>
	                <?php previous_posts_link( '<div class="nav-next fr">'. __( 'Newer posts', 'woothemes' ) . '</div>' ); ?>
	                <div class="fix"></div>
	            </div>	
	        
			<?php } ?>
	    
		<?php }   
	}    
}            	
	
/*-----------------------------------------------------------------------------------*/
/* WooTabs - Popular Posts */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_tabs_popular')) {
	function woo_tabs_popular( $posts = 5, $size = 35 ) {
		global $post;
		$popular = get_posts('ignore_sticky_posts=1&orderby=comment_count&showposts='.$posts);
		foreach($popular as $post) :
			setup_postdata($post);
	?>
	<li>
		<?php if ($size <> 0) woo_image('height='.$size.'&width='.$size.'&class=thumbnail&single=true'); ?>
		<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		<span class="meta"><?php the_time( get_option( 'date_format' ) ); ?></span>
		<div class="fix"></div>
	</li>
	<?php endforeach;
	}
}


/*-----------------------------------------------------------------------------------*/
/* WooTabs - Latest Posts */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_tabs_latest')) {
	function woo_tabs_latest( $posts = 5, $size = 35 ) {
		global $post;
		$latest = get_posts('ignore_sticky_posts=1&showposts='. $posts .'&orderby=post_date&order=desc');
		foreach($latest as $post) :
			setup_postdata($post);
	?>
	<li>
		<?php if ($size <> 0) woo_image('height='.$size.'&width='.$size.'&class=thumbnail&single=true'); ?>
		<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		<span class="meta"><?php the_time( get_option( 'date_format' ) ); ?></span>
		<div class="fix"></div>
	</li>
	<?php endforeach; 
	}
}



/*-----------------------------------------------------------------------------------*/
/* WooTabs - Latest Comments */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_tabs_comments')) {
	function woo_tabs_comments( $posts = 5, $size = 35 ) {
		global $wpdb;
		$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
		comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
		comment_type,comment_author_url, comment_status,
		SUBSTRING(comment_content,1,50) AS com_excerpt
		FROM $wpdb->comments
		LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
		$wpdb->posts.ID)
		WHERE comment_status = 'open' AND comment_approved = '1' AND comment_type = '' AND
		post_password = ''
		ORDER BY comment_date_gmt DESC LIMIT ".$posts;
		
		$comments = $wpdb->get_results($sql);
		
		foreach ($comments as $comment) {
		?>
		<li>
			<?php echo get_avatar( $comment, $size ); ?>
		
			<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php _e('on ', 'woothemes'); ?> <?php echo $comment->post_title; ?>">
				<?php echo strip_tags($comment->comment_author); ?>: <?php echo strip_tags($comment->com_excerpt); ?>...
			</a>
			<div class="fix"></div>
		</li>
		<?php 
		}
	}
}



/*-----------------------------------------------------------------------------------*/
/* Post Meta */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('woo_post_meta')) {
	function woo_post_meta( ) {
?>
<p class="post-meta">
    <span class="post-date"><span class="small"><?php _e('Posted on', 'woothemes') ?></span> <?php the_time( get_option( 'date_format' ) ); ?></span>
    <span class="post-author"><span class="small"><?php _e('by', 'woothemes') ?></span> <?php the_author_posts_link(); ?></span>
    <span class="post-category"><span class="small"><?php _e('in', 'woothemes') ?></span> <?php the_category(', ') ?></span>
    <?php edit_post_link( __('{ Edit }', 'woothemes'), '<span class="small">', '</span>' ); ?>
</p>
<?php 
	}
}

/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Slides */
/*-----------------------------------------------------------------------------------*/

add_action('init', 'woo_add_slides');
function woo_add_slides() 
{
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
    'supports' => array('title','editor', 'thumbnail' /*'author','thumbnail','excerpt','comments'*/)
  ); 
  register_post_type('slide',$args);
}


/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Info Boxes */
/*-----------------------------------------------------------------------------------*/

add_action('init', 'woo_add_infoboxes');
function woo_add_infoboxes() 
{
  $labels = array(
    'name' => _x('Mini-Features', 'post type general name', 'woothemes'),
    'singular_name' => _x('Mini-Feature', 'post type singular name', 'woothemes'),
    'add_new' => _x('Add New', 'infobox', 'woothemes'),
    'add_new_item' => __('Add New Mini-Feature', 'woothemes'),
    'edit_item' => __('Edit Mini-Feature', 'woothemes'),
    'new_item' => __('New Mini-Feature', 'woothemes'),
    'view_item' => __('View Mini-Feature', 'woothemes'),
    'search_items' => __('Search Mini-Features', 'woothemes'),
    'not_found' =>  __('No Mini-Features found', 'woothemes'),
    'not_found_in_trash' => __('No Mini-Features found in Trash', 'woothemes'), 
    'parent_item_colon' => ''
  );
  
  $infobox_rewrite = get_option('woo_infobox_rewrite');
  if(empty($infobox_rewrite)) $infobox_rewrite = 'infobox';
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => array('slug'=> $infobox_rewrite),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() .'/includes/images/box.png',
    'menu_position' => null,
    'supports' => array('title','editor',/*'author','thumbnail','excerpt','comments'*/)
  ); 
  register_post_type('infobox',$args);
}

/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Portfolio */
/*-----------------------------------------------------------------------------------*/

add_action('init', 'woo_add_portfolio');
function woo_add_portfolio() 
{
  $labels = array(
    'name' => _x('Portfolio', 'post type general name', 'woothemes'),
    'singular_name' => _x('Portfolio Item', 'post type singular name', 'woothemes'),
    'add_new' => _x('Add New', 'slide', 'woothemes'),
    'add_new_item' => __('Add New Portfolio Item', 'woothemes'),
    'edit_item' => __('Edit Portfolio Item', 'woothemes'),
    'new_item' => __('New Portfolio Item', 'woothemes'),
    'view_item' => __('View Portfolio Item', 'woothemes'),
    'search_items' => __('Search Portfolio Items', 'woothemes'),
    'not_found' =>  __('No Portfolio Items found', 'woothemes'),
    'not_found_in_trash' => __('No Portfolio Items found in Trash', 'woothemes'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => true,
	'_builtin' => false,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() .'/includes/images/portfolio.png',
    'menu_position' => null,
    'supports' => array('title','editor','thumbnail'/*'author','excerpt','comments'*/),
	'taxonomies' => array('post_tag') // add tags so portfolio can be filtered
  ); 
  register_post_type('portfolio',$args);

}

/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Feedback */
/*-----------------------------------------------------------------------------------*/

add_action('init', 'woo_add_feedback');
function woo_add_feedback() 
{
  $labels = array(
    'name' => _x('Feedback', 'post type general name', 'woothemes'),
    'singular_name' => _x('Feedback Item', 'post type singular name', 'woothemes'),
    'add_new' => _x('Add New', 'slide', 'woothemes'),
    'add_new_item' => __('Add New Feedback Item', 'woothemes'),
    'edit_item' => __('Edit Feedback Item', 'woothemes'),
    'new_item' => __('New Feedback Item', 'woothemes'),
    'view_item' => __('View Feedback Item', 'woothemes'),
    'search_items' => __('Search Feedback Items', 'woothemes'),
    'not_found' =>  __('No Feedback Items found', 'woothemes'),
    'not_found_in_trash' => __('No Feedback Items found in Trash', 'woothemes'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => true,
	'_builtin' => false,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() .'/includes/images/feedback.png',
    'menu_position' => null,
    'supports' => array('title','editor',/*'author','thumbnail','excerpt','comments'*/),
  ); 
  register_post_type('feedback',$args);

}

/*-----------------------------------------------------------------------------------*/
/* Slider Button Shortcode */
/*-----------------------------------------------------------------------------------*/

function slider_button($atts, $content = null) {
   extract(shortcode_atts(array('url' => '#'), $atts));
   return '<a class="btn" href="'.$url.'"><span>' . do_shortcode($content) . '</span></a>';
}
add_shortcode('bizbutton', 'slider_button');


/*-----------------------------------------------------------------------------------*/
/* Get Post image attachments */
/*-----------------------------------------------------------------------------------*/
/* 

Description:

This function will get all the attached post images that have been uploaded via the 
WP post image upload and return them in an array. 

*/
function woo_get_post_images($offset = 1) {
	
	// Arguments
	$repeat = 100; 				// Number of maximum attachments to get 
	$photo_size = 'large';		// The WP "size" to use for the large image

	if ( !is_array($args) ) 
		parse_str( $args, $args );
	extract($args);

	global $post;

	$id = get_the_id();
	$attachments = get_children( array(
	'post_parent' => $id,
	'numberposts' => $repeat,
	'post_type' => 'attachment',
	'post_mime_type' => 'image',
	'order' => 'ASC', 
	'orderby' => 'menu_order date')
	);
	if ( !empty($attachments) ) :
		$output = array();
		$count = 0;
		foreach ( $attachments as $att_id => $attachment ) {
			$count++;  
			if ($count <= $offset) continue;
			$url = wp_get_attachment_image_src($att_id, $photo_size, true);	
			if ( $url[0] != $exclude )
				$output[] = array( "url" => $url[0], "caption" => $attachment->post_excerpt );
		}  
	endif; 
	return $output;
}


/*-----------------------------------------------------------------------------------*/
/* WordPress 3.0 New Features Support */
/*-----------------------------------------------------------------------------------*/

if ( function_exists('wp_nav_menu') ) {
	add_theme_support( 'nav-menus' );
	register_nav_menus( array( 'primary-menu' => __( 'Primary Menu', 'woothemes' ) ) );
}     

/*-----------------------------------------------------------------------------------*/
/* Subscribe / Connect */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('woo_subscribe_connect')) {
	function woo_subscribe_connect($widget = 'false', $title = '', $form = '', $social = '') {

		global $woo_options;

		// Setup title
		if ( $widget != 'true' )
			$title = $woo_options[ 'woo_connect_title' ];

		// Setup related post (not in widget)
		$related_posts = '';
		if ( $woo_options[ 'woo_connect_related' ] == "true" AND $widget != "true" )
			$related_posts = do_shortcode('[related_posts limit="5"]');

?>
	<?php if ( $woo_options[ 'woo_connect' ] == "true" OR $widget == 'true' ) : ?>
	<div id="connect">
		<h3><?php if ( $title ) echo $title; else _e('Subscribe','woothemes'); ?></h3>

		<div <?php if ( $related_posts != '' ) echo 'class="col-left"'; ?>>
			<p><?php if ($woo_options[ 'woo_connect_content' ] != '') echo stripslashes($woo_options[ 'woo_connect_content' ]); else _e('Subscribe to our e-mail newsletter to receive updates.', 'woothemes'); ?></p>

			<?php if ( $woo_options[ 'woo_connect_newsletter_id' ] != "" AND $form != 'on' ) : ?>
			<form class="newsletter-form<?php if ( $related_posts == '' ) echo ' fl'; ?>" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $woo_options[ 'woo_connect_newsletter_id' ]; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
				<input class="email" type="text" name="email" value="<?php _e('Enter your email address','woothemes'); ?>" onfocus="if (this.value == '<?php _e('Enter your email address','woothemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Enter your email address','woothemes'); ?>';}" />
				<input type="hidden" value="<?php echo $woo_options[ 'woo_connect_newsletter_id' ]; ?>" name="uri"/>
				<input type="hidden" value="<?php bloginfo('name'); ?>" name="title"/>
				<input type="hidden" name="loc" value="en_US"/>
				<input class="submit" type="submit" name="submit" value="<?php _e('Subscribe', 'woothemes'); ?>" />
			</form>
			<?php endif; ?>

			<?php if ( $woo_options['woo_connect_mailchimp_list_url'] != "" AND $form != 'on' AND $woo_options['woo_connect_newsletter_id'] == "" ) : ?>
			<!-- Begin MailChimp Signup Form -->
			<div id="mc_embed_signup">
				<form class="newsletter-form<?php if ( $related_posts == '' ) echo ' fl'; ?>" action="<?php echo $woo_options['woo_connect_mailchimp_list_url']; ?>" method="post" target="popupwindow" onsubmit="window.open('<?php echo $woo_options['woo_connect_mailchimp_list_url']; ?>', 'popupwindow', 'scrollbars=yes,width=650,height=520');return true">
					<input type="text" name="EMAIL" class="required email" value="<?php _e('E-mail','woothemes'); ?>"  id="mce-EMAIL" onfocus="if (this.value == '<?php _e('E-mail','woothemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('E-mail','woothemes'); ?>';}">
					<input type="submit" value="<?php _e('Submit', 'woothemes'); ?>" name="subscribe" id="mc-embedded-subscribe" class="btn submit button">
				</form>
			</div>
			<!--End mc_embed_signup-->
			<?php endif; ?>

			<?php if ( $social != 'on' ) : ?>
			<div class="social<?php if ( $related_posts == '' AND $woo_options[ 'woo_connect_newsletter_id' ] != "" ) echo ' fr'; ?>">
		   		<?php if ( $woo_options[ 'woo_connect_rss' ] == "true" ) { ?>
		   		<a href="<?php if ( $woo_options[ 'woo_feed_url' ] ) { echo $woo_options[ 'woo_feed_url' ]; } else { echo get_bloginfo_rss('rss2_url'); } ?>" class="subscribe"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-rss.png" title="<?php _e('Subscribe to our RSS feed', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_twitter' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_twitter' ]; ?>" class="twitter"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-twitter.png" title="<?php _e('Follow us on Twitter', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_facebook' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_facebook' ]; ?>" class="facebook"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-facebook.png" title="<?php _e('Connect on Facebook', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_youtube' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_youtube' ]; ?>" class="youtube"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-youtube.png" title="<?php _e('Watch on YouTube', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_flickr' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_flickr' ]; ?>" class="flickr"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-flickr.png" title="<?php _e('See photos on Flickr', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_linkedin' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_linkedin' ]; ?>" class="linkedin"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-linkedin.png" title="<?php _e('Connect on LinkedIn', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_delicious' ] != "" ) { ?>
		   		<a href="<?php echo esc_url( $woo_options['woo_connect_delicious'] ); ?>" class="delicious"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-delicious.png" title="<?php _e('Discover on Delicious', 'woothemes'); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_googleplus' ] != "" ) { ?>
		   		<a href="<?php echo esc_url( $woo_options['woo_connect_googleplus'] ); ?>" class="googleplus"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-googleplus.png" title="<?php _e('View Google+ profile', 'woothemes'); ?>" alt=""/></a>

				<?php } ?>
			</div>
			<?php endif; ?>

		</div><!-- col-left -->

		<?php if ( $woo_options[ 'woo_connect_related' ] == "true" AND $related_posts != '' ) : ?>
		<div class="related-posts col-right">
			<h4><?php _e('Related Posts:', 'woothemes'); ?></h4>
			<?php echo $related_posts; ?>
		</div><!-- col-right -->
		<?php wp_reset_query(); endif; ?>

        <div class="fix"></div>
	</div>
	<?php endif; ?>
<?php
	}
}


/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
    
?>