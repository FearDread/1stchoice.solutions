<?php

// =============================== Widget Functions ======================================

// Input Option: Listing Link Categories
function DisplayCats($name,$select)
{
	$linkcats = array();
	$linkcats = get_categories('type=post');
	
	echo '<p><label for="' . $name .  '_category">Link Category:
					<select name="' . $name .  '_category" class="widefat" style="width: 94% !important;">';
	
	foreach ( $linkcats as $singlecat ) {
		
		if ( $select == $singlecat->cat_name ) { echo '<option value="' . $singlecat->cat_name . '" selected="selected">' . $singlecat->cat_name . '</option>'; }
			else { echo '<option value="' . $singlecat->cat_name . '">' . $singlecat->cat_name . '</option>'; }
		
	}
	
	echo '</select></label></p>';

}

// =============================== Subscribe &  widget ======================================
function subscribeWidget()
{

?>

				<div id="subscribe" class="widget">
				
					<h3><?php _e('Subscribe',woothemes); ?></h3>
				
					<ul>
						<li class="rss"><a href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" title="<?php _e('Subscribe to blog RSS',woothemes); ?>"><?php _e('Subscribe to blog RSS',woothemes); ?></a></li>
						<li class="rss"><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('Subscribe to comments RSS',woothemes); ?>"><?php _e('Subscribe to comments RSS',woothemes); ?></a></li>
					</ul>
				
				</div><!-- /#subscribe -->
				
<?php

}
register_sidebar_widget('Woo - Subscribe & Follow', 'subscribeWidget');


// =============================== Ad widget ======================================
function adsWidget()
{
$settings = get_option("widget_adswidget");
$number = $settings['number'];
if ($number == 0) $number = 1;
$img_url = array();
$dest_url = array();

$numbers = range(1,$number); 
$counter = 0;

if (get_option('woo_ads_rotate')) {
	shuffle($numbers);
}
?>
<div id="ads" class="box widget">

<h3><?php _e('Sponsors',woothemes); ?></h3>

<?php
	foreach ($numbers as $number) {	
		$counter++;
		$img_url[$counter] = get_option('woo_ad_image_'.$number);
		$dest_url[$counter] = get_option('woo_ad_url_'.$number);
	
?>
        <a href="<?php echo "$dest_url[$counter]"; ?>"><img src="<?php echo "$img_url[$counter]"; ?>" alt="Ad" /></a>
<?php } ?>
</div><!-- /#ads -->
<?php

}
register_sidebar_widget('Woo - Ads [width - 230px]', 'adsWidget');

function adsWidgetAdmin() {

	$settings = get_option("widget_adswidget");

	// check if anything's been sent
	if (isset($_POST['update_ads'])) {
		$settings['number'] = strip_tags(stripslashes($_POST['ads_number']));

		update_option("widget_adswidget",$settings);
	}

	echo '<p>
			<label for="ads_number">Number of ads (1-4):
			<input id="ads_number" name="ads_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_ads" name="update_ads" value="1" />';

}
register_widget_control('Woo - Ads [width - 230px]', 'adsWidgetAdmin', 200, 200);


// =============================== Search widget ======================================
function searchWidget()
{

?>

			<div id="search" class="widget">
			
				<h3><?php _e('Search',woothemes); ?></h3>
				
				<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" class="search-form">
					<input type="text" value="<?php _e('Enter search keyword',woothemes); ?>" name="s" id="s" class="field" onfocus="if (this.value == '<?php _e('Enter search keyword',woothemes); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Enter search keyword',woothemes); ?>';}" />
					<input class="submitsearch button" type="submit" name="submit" value="<?php _e('submit',woothemes); ?>" />
				</form>				
				
			</div><!-- /search -->	

<?php
}
register_sidebar_widget('Woo - Search', 'searchWidget');

// =============================== Feedburner Subscribe widget ======================================
function feedburnerWidget()
{
	$settings = get_option("widget_feedburnerwidget");

	$id = $settings['id'];
	$title = $settings['title'];
	$google = $settings['google'];	

?>

			<div id="feedburner" class="widget">
			
				<h3><?php echo $title; ?></h3>
			
		<form action="<?php if ($google) { ?>http://feedburner.google.com/fb/a/mailverify<?php } else { ?>http://www.feedburner.com/fb/a/emailverify<?php } ?>" method="post" target="popupwindow" onsubmit="window.open('<?php if ($google) { ?>http://feedburner.google.com/fb/a/mailverify?uri=<?php } else { ?>http://www.feedburner.com/fb/a/emailverifySubmit?feedId=<?php } ?><?php echo $id; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
					
					<input class="field" type="text" name="email" value="<?php _e('Enter your e-mail address',woothemes); ?>" onfocus="if (this.value == '<?php _e('Enter your e-mail address',woothemes); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Enter your e-mail address',woothemes); ?>';}" />
					<input type="hidden" value="<?php echo $id; ?>" name="uri"/>
					<input type="hidden" value="<?php bloginfo('name'); ?>" name="title"/>
					<input type="hidden" name="loc" value="en_US"/>
					
					<input class="button" type="submit" name="submit" value="<?php _e('submit',woothemes); ?>" />
					
				</form>
				
			</div><!-- /feedburner -->	

<?php
}

function feedburnerWidgetAdmin() {

	$settings = get_option("widget_feedburnerwidget");

	// check if anything's been sent
	if (isset($_POST['update_feedburner'])) {
		$settings['id'] = strip_tags(stripslashes($_POST['feedburner_id']));
		$settings['title'] = strip_tags(stripslashes($_POST['feedburner_title']));
		$settings['google'] = $_POST['subscribe_google'];		

		update_option("widget_feedburnerwidget",$settings);
	}

	echo '<p>
			<label for="feedburner_title">Title:
			<input id="feedburner_title" name="feedburner_title" type="text" class="widefat" value="'.$settings['title'].'" /></label></p>';
	echo '<p>
			<label for="feedburner_id">Your Feedburner ID:
			<input id="feedburner_id" name="feedburner_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';			
	echo '<input type="hidden" id="update_feedburner" name="update_feedburner" value="1" />';

	if ( $settings['google'] ) {
	
		echo '<p>
				<label for="subscribe_google">Use Feedburner Google URL?:
				<input id="subscribe_google" name="subscribe_google" type="checkbox" checked /></label></p>';			

	} else {

		echo '<p>
				<label for="subscribe_google">Use Feedburner Google URL?:
				<input id="subscribe_google" name="subscribe_google" type="checkbox" /></label></p>';			
	
	}

}

register_sidebar_widget('Woo - Feedburner Subscription', 'feedburnerWidget');
register_widget_control('Woo - Feedburner Subscription', 'feedburnerWidgetAdmin', 400, 200);


// =============================== CampaignMonitor Subscribe widget ======================================
function campaignmonitorWidget()
{
	$settings = get_option("widget_campaignmonitorwidget");

	$action = $settings['action'];
	$id = $settings['id'];
	$title = $settings['title'];

?>

			<div id="campaignmonitor" class="widget">
			
				<h3><?php echo $title; ?></h3>
			
				<form name="campaignmonitorform" id="campaignmonitorform" action="<?php echo $action; ?>" method="post">
					
					<input type="text" name="cm-<?php echo $id; ?>" id="<?php echo $id; ?>" class="field" value="<?php _e('Enter your e-mail address',woothemes); ?>" onfocus="if (this.value == '<?php _e('Enter your e-mail address',woothemes); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Enter your e-mail address',woothemes); ?>';}" />
					
					<input class="button" type="submit" name="submit" value="<?php _e('submit',woothemes); ?>" />
					
				</form>
				
			</div><!-- /campaignmonitor -->	

<?php
}

function campaignmonitorWidgetAdmin() {

	$settings = get_option("widget_campaignmonitorwidget");

	// check if anything's been sent
	if (isset($_POST['update_campaignmonitor'])) {
		$settings['id'] = strip_tags(stripslashes($_POST['campaignmonitor_id']));
		$settings['action'] = strip_tags(stripslashes($_POST['campaignmonitor_action']));
		$settings['title'] = strip_tags(stripslashes($_POST['campaignmonitor_title']));

		update_option("widget_campaignmonitorwidget",$settings);
	}

	echo '<p>
			<label for="campaignmonitor_title">Title:
			<input id="campaignmonitor_title" name="campaignmonitor_title" type="text" class="widefat" value="'.$settings['title'].'" /></label></p>';
	echo '<p>
			<label for="campaignmonitor_action">Your Campaign Monitor Form Action:
			<input id="campaignmonitor_action" name="campaignmonitor_action" type="text" class="widefat" value="'.$settings['action'].'" /></label></p>';			
	echo '<p>
			<label for="campaignmonitor_id">Your Campaign Monitor ID:
			<input id="campaignmonitor_id" name="campaignmonitor_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';						
	echo '<input type="hidden" id="update_campaignmonitor" name="update_campaignmonitor" value="1" />';

}

register_sidebar_widget('Woo - Campaign Monitor Subscription', 'campaignmonitorWidget');
register_widget_control('Woo - Campaign Monitor Subscription', 'campaignmonitorWidgetAdmin', 400, 200);

// =============================== Flickr widget ======================================
function flickrWidget()
{
	$settings = get_option("widget_flickrwidget");

	$id = $settings['id'];
	$number = $settings['number'];

?>

			<div id="flickr" class="widget">
				
				<h3><?php _e('Our Photos',woothemes); ?></h3>
				
				<div class="images">	
					<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>        
				</div><!-- /pics -->
			
			</div><!-- /flickr -->
			
			<div class="clear"></div>
<?php
}

function flickrWidgetAdmin() {

	$settings = get_option("widget_flickrwidget");

	// check if anything's been sent
	if (isset($_POST['update_flickr'])) {
		$settings['id'] = strip_tags(stripslashes($_POST['flickr_id']));
		$settings['number'] = strip_tags(stripslashes($_POST['flickr_number']));

		update_option("widget_flickrwidget",$settings);
	}

	echo '<p>
			<label for="flickr_id">Flickr ID (<a href="http://www.idgettr.com">idGettr</a>):
			<input id="flickr_id" name="flickr_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';
	echo '<p>
			<label for="flickr_number">Number of photos:
			<input id="flickr_number" name="flickr_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_flickr" name="update_flickr" value="1" />';

}

register_sidebar_widget('Woo - Flickr', 'flickrWidget');
register_widget_control('Woo - Flickr', 'flickrWidgetAdmin', 400, 200);

// =============================== Twitter widget ======================================
class Woo_Twitter extends WP_Widget {
	var $settings = array( 'title', 'limit', 'username' );

	function Woo_Twitter() {
		$widget_ops = array( 'description' => 'Add your Twitter feed to your sidebar with this widget.' );
		parent::WP_Widget( false, __( 'Woo - Twitter Stream', 'woothemes' ), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		$instance = $this->woo_enforce_defaults( $instance );
		extract( $instance, EXTR_SKIP );

		$unique_id = $args['widget_id'];
		echo $before_widget;
		echo '<div id="twitter">';
		if ( $title ) {
			echo $before_title . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $after_title;
		} else {
			?><h3 class="tlogo"><?php _e( 'Twitter', 'woothemes' ); ?></h3><?php
		}
		?><ul id="twitter_update_list_<?php echo $unique_id; ?>"><li></li></ul>
			<p><?php _e('Follow','woothemes'); ?> <a href="http<?php ( is_ssl() ? 's' : '' ) ?>://twitter.com/<?php echo $username; ?>"><strong>@<?php echo $username; ?></strong></a> <?php _e('on Twitter','woothemes'); ?></p></div><div class="clear"></div><?php

		echo woo_twitter_script($unique_id,$username,$limit); //Javascript output function
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$new_instance = $this->woo_enforce_defaults( $new_instance );
		return $new_instance;
	}

	function woo_enforce_defaults( $instance ) {
		$defaults = $this->woo_get_settings();
		$instance = wp_parse_args( $instance, $defaults );
		$instance['title'] = strip_tags( $instance['title'] ); // Not for security so much as to give them feedback that HTML isn't allowed
		$instance['username'] = preg_replace( '|[^a-zA-Z0-9_]|', '', $instance['username'] );
		$instance['limit'] = intval( $instance['limit'] );
		if ( $instance['limit'] < 1 )
			$instance['limit'] = 5;
		return $instance;
	}

	/**
	 * Provides an array of the settings with the setting name as the key and the default value as the value
	 * This cannot be called get_settings() or it will override WP_Widget::get_settings()
	 */
	function woo_get_settings() {
		// Set the default to a blank string
		$settings = array_fill_keys( $this->settings, '' );
		// Now set the more specific defaults
		$settings['limit'] = 5;
		return $settings;
	}

	function form( $instance ) {
		$instance = $this->woo_enforce_defaults( $instance );
		extract( $instance, EXTR_SKIP );
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','woothemes'); ?></label>
				<input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo esc_attr( $title ); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:','woothemes'); ?></label>
				<input type="text" name="<?php echo $this->get_field_name('username'); ?>"  value="<?php echo esc_attr( $username ); ?>" class="widefat" id="<?php echo $this->get_field_id('username'); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit:','woothemes'); ?></label>
				<input type="text" name="<?php echo $this->get_field_name('limit'); ?>"  value="<?php echo esc_attr( $limit ); ?>" class="" size="3" id="<?php echo $this->get_field_id('limit'); ?>" />
			</p>
		<?php
	}

}

register_widget( 'Woo_Twitter' );

// =============================== Video widget ======================================
function videoWidget()
{
	$settings = get_option("widget_videowidget");

	$number = $settings['number'];
	$title = $settings['title'];	

?>

			<div id="videos" class="box widget">
			
					<h3><?php if ( $title <> "" ) { echo $title; } else { echo __('Video Player',woothemes); } ?></h3>
					
					<div class="inside">

						<?php
							global $post;
 							$videos = get_posts('numberposts=1&tag=video');
							foreach($videos as $post) :
				 		?>					
					
						<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
						
						<div class="video">
							<?php echo woo_get_embed('embed','230','132'); ?> 
						</div><!-- /.video -->
						
						<?php endforeach; ?>
						
						<h4>More...</h4>
						
						<ul>

							<?php
								global $post;
 								$videos = get_posts('numberposts=' . $number . '&offset=1&tag=video');
								foreach($videos as $post) :
				 			?>									
								<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
							<?php endforeach; ?>
							
						</ul>
					
					</div><!-- /.inner -->
			
			</div><!-- /#videos -->

<?php
}

function videoWidgetAdmin() {

	$settings = get_option("widget_videowidget");

	// check if anything's been sent
	if (isset($_POST['update_video'])) {
		$settings['number'] = strip_tags(stripslashes($_POST['video_number']));
		$settings['title'] = strip_tags(stripslashes($_POST['video_title']));		

		update_option("widget_videowidget",$settings);
	}
			
	echo '<p>
			<label for="video_title">Widget Title:
			<input id="video_title" name="video_title" type="text" class="widefat" value="'.$settings['title'].'" /></label></p>';
	echo '<p>
			<label for="video_number">Number of videos:
			<input id="video_number" name="video_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_video" name="update_video" value="1" />';

}

register_sidebar_widget('Woo - Video Player', 'videoWidget');
register_widget_control('Woo - Video Player', 'videoWidgetAdmin', 400, 200);

?>