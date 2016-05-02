<?php

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Register WP Menus
- Page navigation
- Post Meta
- Custom Post Type - Slides
- Custom Post Type - Portfolio
- Custom Post Type - Feedback
- Subscribe & Connect
- Custom Profile fields
- Woo Get Users of the Site
- Comment Form Fields
- Comment Form Settings
- Google Maps

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Register WP Menus */
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'wp_nav_menu') ) {
	add_theme_support( 'nav-menus' );
	register_nav_menus( array( 'primary-menu' => __( 'Primary Menu', 'woothemes' ) ) );
	register_nav_menus( array( 'top-menu' => __( 'Top Menu', 'woothemes' ) ) );
}


/*-----------------------------------------------------------------------------------*/
/* Page navigation */
/*-----------------------------------------------------------------------------------*/
if (!function_exists( 'woo_pagenav')) {
	function woo_pagenav() {

		global $woo_options;

		// If the user has set the option to use simple paging links, display those. By default, display the pagination.
		if ( array_key_exists( 'woo_pagination_type', $woo_options ) && $woo_options[ 'woo_pagination_type' ] == 'simple' ) {
			if ( get_next_posts_link() || get_previous_posts_link() ) {
		?>
            <div class="nav-entries">
                <?php next_posts_link( '<span class="nav-prev fl">'. __( '<span class="meta-nav">&larr;</span> Older posts', 'woothemes' ) . '</span>' ); ?>
                <?php previous_posts_link( '<span class="nav-next fr">'. __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'woothemes' ) . '</span>' ); ?>
                <div class="fix"></div>
            </div>
		<?php
			}
		} else {
			woo_pagination();

		} // End IF Statement

	} // End woo_pagenav()
} // End IF Statement

/*-----------------------------------------------------------------------------------*/
/* WooTabs - Popular Posts */
/*-----------------------------------------------------------------------------------*/
if (!function_exists( 'woo_tabs_popular')) {
	function woo_tabs_popular( $posts = 5, $size = 45 ) {
		global $post;
		$popular = get_posts( 'ignore_sticky_posts=1&orderby=comment_count&showposts='.$posts);
		foreach($popular as $post) :
			setup_postdata($post);
	?>
	<li>
		<?php if ($size <> 0) woo_image( 'height='.$size.'&width='.$size.'&class=thumbnail&single=true' ); ?>
		<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		<span class="meta"><?php the_time( get_option( 'date_format' ) ); ?></span>
		<div class="fix"></div>
	</li>
	<?php endforeach;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Post Meta */
/*-----------------------------------------------------------------------------------*/

if (!function_exists( 'woo_post_meta')) {
	function woo_post_meta( ) {
?>
<div class="post-meta">
    
    <div class="post-date">
    	<span class="month"><?php the_time( 'M' ); ?></span>
    	<span class="day"><?php the_time( 'd' ); ?></span>
    </div><!-- /.post-date -->

<!--
    <div class="post-comments">
    	<span class="comments"><?php comments_popup_link(__( '<span>0</span> Comments', 'woothemes' ), __( '<span>1</span> Comment', 'woothemes' ), __( '<span>%</span> Comments', 'woothemes' )); ?></span>
    </div>
-->
    
</div><!-- /.post-meta -->
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
    'supports' => array('title','editor','thumbnail'/*'author','thumbnail','excerpt','comments'*/)
  ); 
  register_post_type('slide',$args);
}

/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Portfolio */
/*-----------------------------------------------------------------------------------*/

add_action('init', 'woo_add_portfolio');
if ( !function_exists('woo_add_portfolio') ) {
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
	  
	  $portfolioitems_rewrite = get_option('woo_portfolioitems_rewrite');
	  if(empty($portfolioitems_rewrite)) $portfolioitems_rewrite = 'portfolio-items';
	  
	  $args = array(
	    'labels' => $labels,
	    'public' => false,
	    'publicly_queryable' => true,
		'_builtin' => false,
	    'show_ui' => true, 
	    'query_var' => true,
	    'rewrite' => array('slug'=> $portfolioitems_rewrite),
	    'capability_type' => 'post',
	    'hierarchical' => false,
	    'menu_icon' => get_template_directory_uri() .'/includes/images/portfolio.png',
	    'menu_position' => null,
	    'supports' => array('title','editor','thumbnail'/*'author','excerpt','comments'*/),
		'taxonomies' => array('post_tag'), // add tags so portfolio can be filtered
		'has_archive' => true
	  ); 
	  register_post_type('portfolio',$args);
	
	}
}

/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Feedback */
/*-----------------------------------------------------------------------------------*/

add_action('init', 'woo_add_feedback');
if ( !function_exists('woo_add_feedback') ) {
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
	    'rewrite' => array('slug'=> 'feedback-items'),
	    'capability_type' => 'post',
	    'hierarchical' => false,
	    'menu_icon' => get_template_directory_uri() .'/includes/images/feedback.png',
	    'menu_position' => null,
	    'supports' => array('title','editor',/*'author','thumbnail','excerpt','comments'*/),
	  ); 
	  register_post_type('feedback',$args);
	
	}
}

/*-----------------------------------------------------------------------------------*/
/* Subscribe / Connect */
/*-----------------------------------------------------------------------------------*/

if (!function_exists( 'woo_subscribe_connect')) {
	function woo_subscribe_connect($widget = 'false', $title = '', $form = '', $social = '') {

		global $woo_options;

		// Setup title
		if ( $widget != 'true' ) {
			if (isset($woo_options[ 'woo_connect_title' ])) { $title = $woo_options[ 'woo_connect_title' ]; } else { $title = ''; }
		}
		
		// Setup related post (not in widget)
		$related_posts = '';
		if ( isset($woo_options[ 'woo_connect_related' ]) && $woo_options[ 'woo_connect_related' ] == "true" && $widget != "true" ) {
			$related_posts = do_shortcode( '[related_posts limit="5"]' );
		}

?>
	<?php if ( isset($woo_options[ 'woo_connect' ]) && $woo_options[ 'woo_connect' ] == "true" || $widget == 'true' ) : ?>
	<div id="connect">
		<h3 <?php if ($widget != 'true') { ?> class="title" <?php } ?>><?php if ( $title ) echo stripslashes( $title ); else _e( 'Subscribe', 'woothemes' ); ?></h3>

		<div <?php if ( $related_posts != '' ) echo 'class="col-left"'; ?>>
			<p><?php if ($woo_options[ 'woo_connect_content' ] != '') echo stripslashes($woo_options[ 'woo_connect_content' ]); else _e( 'Subscribe to our e-mail newsletter to receive updates.', 'woothemes' ); ?></p>

			<?php if ( $woo_options[ 'woo_connect_newsletter_id' ] != "" && $form != 'on' ) : ?>
			<form class="newsletter-form<?php if ( $related_posts == '' ) echo ' fl'; ?>" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open( 'http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $woo_options[ 'woo_connect_newsletter_id' ]; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520' );return true">
				<input class="email" type="text" name="email" value="<?php esc_attr_e( 'E-mail', 'woothemes' ); ?>" onfocus="if (this.value == '<?php _e( 'E-mail', 'woothemes' ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'E-mail', 'woothemes' ); ?>';}" />
				<input type="hidden" value="<?php echo $woo_options[ 'woo_connect_newsletter_id' ]; ?>" name="uri"/>
				<input type="hidden" value="<?php bloginfo( 'name' ); ?>" name="title"/>
				<input type="hidden" name="loc" value="en_US"/>
				<input class="submit" type="submit" name="submit" value="<?php _e( 'Submit', 'woothemes' ); ?>" />
			</form>
			<?php endif; ?>
			
			<?php if ( $woo_options['woo_connect_mailchimp_list_url'] != "" && $form != 'on' && $woo_options['woo_connect_newsletter_id'] == "" ) : ?> 
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
			<div class="social<?php if ( $related_posts == '' && $woo_options[ 'woo_connect_newsletter_id' ] != "" ) echo ' fr'; ?>">
		   		<?php if ( $woo_options[ 'woo_connect_rss' ] == "true" ) { ?>
		   		<a href="<?php if ( $woo_options[ 'woo_feed_url' ] ) { echo $woo_options[ 'woo_feed_url' ]; } else { echo get_bloginfo_rss( 'rss2_url' ); } ?>" class="subscribe"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-rss.png" title="<?php esc_attr_e( 'Subscribe to our RSS feed', 'woothemes' ); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_twitter' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_twitter' ]; ?>" class="twitter"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-twitter.png" title="<?php esc_attr_e( 'Follow us on Twitter', 'woothemes' ); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_facebook' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_facebook' ]; ?>" class="facebook"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-facebook.png" title="<?php esc_attr_e( 'Connect on Facebook', 'woothemes' ); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_youtube' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_youtube' ]; ?>" class="youtube"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-youtube.png" title="<?php esc_attr_e( 'Watch on YouTube', 'woothemes' ); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_flickr' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_flickr' ]; ?>" class="flickr"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-flickr.png" title="<?php esc_attr_e( 'See photos on Flickr', 'woothemes' ); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_linkedin' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_linkedin' ]; ?>" class="linkedin"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-linkedin.png" title="<?php esc_attr_e( 'Connect on LinkedIn', 'woothemes' ); ?>" alt=""/></a>

		   		<?php } if ( $woo_options[ 'woo_connect_delicious' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_delicious' ]; ?>" class="delicious"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-delicious.png" title="<?php esc_attr_e( 'Discover on Delicious', 'woothemes' ); ?>" alt=""/></a>
		   		
		   		<?php } if ( $woo_options[ 'woo_connect_googleplus' ] != "" ) { ?>
		   		<a href="<?php echo $woo_options[ 'woo_connect_googleplus' ]; ?>" class="googleplus"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-social-googleplus.png" title="<?php esc_attr_e( 'Connect on Google+', 'woothemes' ); ?>" alt=""/></a>

				<?php } ?>
			</div>
			<?php endif; ?>

		</div><!-- col-left -->

		<?php if ( $woo_options[ 'woo_connect_related' ] == "true" && $related_posts != '' ) : ?>
		<div class="related-posts col-right">
			<h4><?php _e( 'Related Posts:', 'woothemes' ); ?></h4>
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
/* Custom profile fields */
/*-----------------------------------------------------------------------------------*/

add_action( 'show_user_profile', 'woo_custom_profile_fields' );
add_action( 'edit_user_profile', 'woo_custom_profile_fields' );

function woo_custom_profile_fields( $user ) { ?>

	<h3><?php _e( 'Social Networks', 'woothemes' ); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="twitter"><?php esc_attr_e( 'Twitter', 'woothemes' ); ?></label></th>

			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_attr_e( 'Please enter your Twitter username.', 'woothemes' ); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="twitter"><?php esc_attr_e( 'Facebook', 'woothemes' ); ?></label></th>

			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_attr_e( 'Please enter your Facebook URL.', 'woothemes' ); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="twitter"><?php esc_attr_e( 'Flickr', 'woothemes' ); ?></label></th>

			<td>
				<input type="text" name="flickr" id="flickr" value="<?php echo esc_attr( get_the_author_meta( 'flickr', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_attr_e( 'Please enter your Flickr URL.', 'woothemes' ); ?></span>
			</td>
		</tr>
		
		<tr>
			<th><label for="twitter"><?php esc_attr_e( 'Team page exclude', 'woothemes' ); ?></label></th>

			<td>
				<input type="checkbox" name="exclude" id="exclude" value="1" <?php if (get_the_author_meta( 'exclude', $user->ID ) == 1) { echo 'checked="checked"'; } ?> /><br />
				<span class="description"><?php esc_attr_e( 'Exclude the user from the team page template.', 'woothemes' ); ?></span>
			</td>
		</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'woo_save_custom_profile_fields' );
add_action( 'edit_user_profile_update', 'woo_save_custom_profile_fields' );

function woo_save_custom_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'flickr', $_POST['flickr'] );
	update_user_meta( $user_id, 'exclude', $_POST['exclude'] );
	
}

/*-----------------------------------------------------------------------------------*/
/* Woo Get Users of the Site */
/*-----------------------------------------------------------------------------------*/

function woo_get_users($users_per_page = 10, $paged = 1, $role = '', $orderby = 'login', $order = 'ASC', $usersearch = '' ) {

	global $blog_id;
		
	$args = array(
			'number' => $users_per_page,
			'offset' => ( $paged-1 ) * $users_per_page,
			'role' => $role,
			'search' => $usersearch,
			'fields' => 'all_with_meta',
			'blog_id' => $blog_id,
			'orderby' => $orderby,
			'order' => $order
		);


	// Query the user IDs for this page
	$wp_user_search = new WP_User_Query( $args );

	$user_results = $wp_user_search->get_results();
	// $wp_user_search->get_total()
	
	return $user_results;
	
} // End Function


/*-----------------------------------------------------------------------------------*/
/* Comment Form Fields */
/*-----------------------------------------------------------------------------------*/

	add_filter( 'comment_form_default_fields', 'woo_comment_form_fields' );

	if ( ! function_exists( 'woo_comment_form_fields' ) ) {
		function woo_comment_form_fields ( $fields ) {
		
			$commenter = wp_get_current_commenter();

			$required_text = ' <span class="required">(' . __( 'Required', 'woothemes' ) . ')</span>';

			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
			$fields =  array(
				'author' => '<p class="comment-form-author">' . 
							'<input id="author" class="txt" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' . 
							'<label for="author">' . __( 'Name' ) . ( $req ? $required_text : '' ) . '</label> ' . 
							'</p>',
				'email'  => '<p class="comment-form-email">' . 
				            '<input id="email" class="txt" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . 
				            '<label for="email">' . __( 'Email' ) . ( $req ? $required_text : '' ) . '</label> ' .
				            '</p>',
				'url'    => '<p class="comment-form-url">' . 
				            '<input id="url" class="txt" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />' . 
				            '<label for="url">' . __( 'Website' ) . '</label>' . 
				            '</p>',
			);
		
			return $fields;
		
		} // End woo_comment_form_fields()
	}

/*-----------------------------------------------------------------------------------*/
/* Comment Form Settings */
/*-----------------------------------------------------------------------------------*/

	add_filter( 'comment_form_defaults', 'woo_comment_form_settings' );

	if ( ! function_exists( 'woo_comment_form_settings' ) ) {
		function woo_comment_form_settings ( $settings ) {
		
			$settings['comment_notes_before'] = '';
			$settings['comment_notes_after'] = '';
			$settings['label_submit'] = __( 'Submit Comment', 'woothemes' );
			$settings['cancel_reply_link'] = __( 'Click here to cancel reply.', 'woothemes' );
			$settings['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" class="comtext" name="comment" cols="50" rows="10" tabindex="4" aria-required="true"></textarea></p>';
			
			return $settings;
		
		} // End woo_comment_form_settings()
	}

/*-----------------------------------------------------------------------------------*/
/* Exclude Pages */
/*-----------------------------------------------------------------------------------*/

function woo_exclude_pages() {
	$exclude = '';	
	return $exclude;
}

/*-----------------------------------------------------------------------------------*/
/* Get Post image attachments */
/*-----------------------------------------------------------------------------------*/
/* 
Description:

This function will get all the attached post images that have been uploaded via the 
WP post image upload and return them in an array. 

*/
function woo_get_post_images($args) {
	
	// Arguments
	$repeat = 100; 				// Number of maximum attachments to get 
	$photo_size = 'large';		// The WP "size" to use for the large image
	$output = '';
	
	if ( !is_array($args) ) 
		parse_str( $args, $args );
	extract($args);

	if (!isset($offset)) { $offset = 1; }
	if (!isset($exclude)) { $exclude = ''; }
	
	
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
/* Remove Meta From Array (Portfolio Single) */
/*-----------------------------------------------------------------------------------*/

	/* woo_remove_meta_from_array()
	 *
	 * Checks for data from each of the $meta_fields as removes
	 * it from the $array.
	 *
	 * Params:
	 * Array $array (required)
	 * Array $meta_fields (required)
	------------------------------------------------------------*/
	
	function woo_remove_meta_from_array ( $array, $meta_fields ) {
	
		global $post;
	
		// Make sure we've got the right data types.
		foreach ( array( $array, $meta_fields ) as $a ) {
		
			if ( ! is_array( $a ) ) { return; } // End IF Statement
		
		} // End FOREACH Loop
	
		// This is the custom code where we strip out all the images that are listed in custom meta fields.
		// 2011-01-05.
		
		$image_meta_fields = $meta_fields;
		
		$non_gallery_images = array();
			
		// If "upload" custom fields exist, check them for data on the current entry.
		
		if ( count( $image_meta_fields ) ) {
		
			foreach ( $image_meta_fields as $im ) {
			
				$_value = get_post_meta( $post->ID, $im, true );
				
				if ( $_value ) {
				
					$non_gallery_images[] = $_value;
				
				} // End IF Statement
			
			} // End FOREACH Loop
		
		} // End IF Statement
		
		// If we have non-gallery images and attachments, begin our custom processing.
		
		if ( count( $non_gallery_images ) && count( $array ) ) {
		
			foreach ( $array as $k => $v ) {
			
				if ( in_array( $v->guid, $non_gallery_images ) ) {
				
					unset( $array[$k] );
				
				} // End IF Statement
			
			} // End FOREACH Loop
		
		} // End IF Statement
		
		return $array;
	
	} // End woo_remove_meta_from_array()


add_filter( 'pre_get_posts', 'woo_show_portfolio_in_tag' );


/*----------------------------------------
 woo_show_portfolio_in_tag()
 ----------------------------------------
 
 * Make sure `portfolio` posts display
 * in `post_tag` archives as well as
 * the default post types.
----------------------------------------*/

function woo_show_portfolio_in_tag ( $query ) {

   if ( $query->is_tag ) { $query->set( 'post_type', array( 'post', 'portfolio' ) ); }
   
   return $query;

} // End woo_show_portfolio_in_tag()

/*-----------------------------------------------------------------------------------*/
/* Google Maps */
/*-----------------------------------------------------------------------------------*/

function woo_maps_contact_output($args){

	$key = get_option('woo_maps_apikey');
	
	// No More API Key needed
	
	if ( !is_array($args) ) 
		parse_str( $args, $args );
		
	extract($args);	
		
	$map_height = get_option('woo_maps_single_height');
	$featured_w = get_option('woo_home_featured_w');
	$featured_h = get_option('woo_home_featured_h');
	$zoom = get_option('woo_maps_default_mapzoom');
	   
	$lang = get_option('woo_maps_directions_locale');
	$locale = '';
	if(!empty($lang)){
		$locale = ',locale :"'.$lang.'"';
	}
	$extra_params = ',{travelMode:G_TRAVEL_MODE_WALKING,avoidHighways:true '.$locale.'}';
	
	if(empty($map_height)) { $map_height = 250;}
	
	if(is_home() && !empty($featured_h) && !empty($featured_w)){
	?>
    <div id="single_map_canvas" style="width:<?php echo $featured_w; ?>px; height: <?php echo $featured_h; ?>px"></div>
    <?php } else { ?> 
    <div id="single_map_canvas" style="width:100%; height: <?php echo $map_height; ?>px"></div>
    <?php } ?>
    <script src="<?php bloginfo('template_url'); ?>/includes/js/markers.js" type="text/javascript"></script>
    <script type="text/javascript">
		jQuery(document).ready(function(){
			function initialize() {
				
				
			<?php if($streetview == 'on'){ ?>

				
			<?php } else { ?>
				
			  	<?php switch ($type) {
			  			case 'G_NORMAL_MAP':
			  				$type = 'ROADMAP';
			  				break;
			  			case 'G_SATELLITE_MAP':
			  				$type = 'SATELLITE';
			  				break;
			  			case 'G_HYBRID_MAP':
			  				$type = 'HYBRID';
			  				break;
			  			case 'G_PHYSICAL_MAP':
			  				$type = 'TERRAIN';
			  				break;
			  			default:
			  				$type = 'ROADMAP';
			  				break;
			  	} ?>
			  	
			  	var myLatlng = new google.maps.LatLng(<?php echo $geocoords; ?>);
				var myOptions = {
				  zoom: <?php echo $zoom; ?>,
				  center: myLatlng,
				  mapTypeId: google.maps.MapTypeId.<?php echo $type; ?>
				};
			  	var map = new google.maps.Map(document.getElementById("single_map_canvas"),  myOptions);
				<?php if(get_option('woo_maps_scroll') == 'true'){ ?>
			  	map.scrollwheel = false;
			  	<?php } ?>
			  	
				<?php if($mode == 'directions'){ ?>
			  	directionsPanel = document.getElementById("featured-route");
 				directions = new GDirections(map, directionsPanel);
  				directions.load("from: <?php echo $from; ?> to: <?php echo $to; ?>" <?php if($walking == 'on'){ echo $extra_params;} ?>);
			  	<?php
			 	} else { ?>
			 
			  		var point = new google.maps.LatLng(<?php echo $geocoords; ?>);
	  				var root = "<?php bloginfo('template_url'); ?>";
	  				var the_link = '<?php echo get_permalink(get_the_id()); ?>';
	  				<?php $title = str_replace(array('&#8220;','&#8221;'),'"',get_the_title(get_the_id())); ?>
	  				<?php $title = str_replace('&#8211;','-',$title); ?>
	  				<?php $title = str_replace('&#8217;',"`",$title); ?>
	  				<?php $title = str_replace('&#038;','&',$title); ?>
	  				var the_title = '<?php echo html_entity_decode($title) ?>'; 
	  				
	  			<?php		 	
			 	if(is_page()){ 
			 		$custom = get_option('woo_cat_custom_marker_pages');
					if(!empty($custom)){
						$color = $custom;
					}
					else {
						$color = get_option('woo_cat_colors_pages');
						if (empty($color)) {
							$color = 'red';
						}
					}			 	
			 	?>
			 		var color = '<?php echo $color; ?>';
			 		createMarker(map,point,root,the_link,the_title,color);
			 	<?php } else { ?>
			 		var color = '<?php echo get_option('woo_cat_colors_pages'); ?>';
	  				createMarker(map,point,root,the_link,the_title,color);
				<?php 
				}
					if(isset($_POST['woo_maps_directions_search'])){ ?>
					
					directionsPanel = document.getElementById("featured-route");
 					directions = new GDirections(map, directionsPanel);
  					directions.load("from: <?php echo htmlspecialchars($_POST['woo_maps_directions_search']); ?> to: <?php echo $address; ?>" <?php if($walking == 'on'){ echo $extra_params;} ?>);
  					
  					
  					
					directionsDisplay = new google.maps.DirectionsRenderer();
					directionsDisplay.setMap(map);
    				directionsDisplay.setPanel(document.getElementById("featured-route"));
					
					<?php if($walking == 'on'){ ?>
					var travelmodesetting = google.maps.DirectionsTravelMode.WALKING;
					<?php } else { ?>
					var travelmodesetting = google.maps.DirectionsTravelMode.DRIVING;
					<?php } ?>
					var start = '<?php echo htmlspecialchars($_POST['woo_maps_directions_search']); ?>';
					var end = '<?php echo $address; ?>';
					var request = {
       					origin:start, 
        				destination:end,
        				travelMode: travelmodesetting
    				};
    				directionsService.route(request, function(response, status) {
      					if (status == google.maps.DirectionsStatus.OK) {
        					directionsDisplay.setDirections(response);
      					}
      				});	
      				
  					<?php } ?>			
				<?php } ?>
			<?php } ?>
			

			  }
			  function handleNoFlash(errorCode) {
				  if (errorCode == FLASH_UNAVAILABLE) {
					alert("Error: Flash doesn't appear to be supported by your browser");
					return;
				  }
				 }

			
		
		initialize();
			
		});
	jQuery(window).load(function(){
			
		var newHeight = jQuery('#featured-content').height();
		newHeight = newHeight - 5;
		if(newHeight > 300){
			jQuery('#single_map_canvas').height(newHeight);
		}
		
	});

	</script>

<?php
}

/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
?>