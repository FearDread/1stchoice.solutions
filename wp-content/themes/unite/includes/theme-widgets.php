<?php

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- LastFM widget
- Flickr widget
- Ad widget
- Search widget
- Twitter widget
- Blog Author Info
- Deregister Default Widgets 

-----------------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------------*/
/* LastFM widget */
/*---------------------------------------------------------------------------------*/
class Woo_lastfm extends WP_Widget {

	function Woo_lastfm() {
		$widget_ops = array('description' => 'Display your tracks from LastFM.' );

		parent::WP_Widget(false, __('Woo - LastFM', 'woothemes'),$widget_ops);      
	}

	function widget($args, $instance) {  
		extract( $args );
		$user = $instance['user'];
		$count = $instance['count'];
		$period = $instance['period'];
		$refresh = $instance['refresh'];
		$offset = $instance['offset'];
		
		echo $before_widget;
		echo $before_title; ?>
		<?php _e('Listening...','woothemes'); ?>
        <?php echo $after_title; ?>
            
  <div id="lastfmrecords"></div>
  <script type="text/javascript">
    jQuery(document).ready( function() {
      var _config = {
        // last.fm username
        username: '<?php echo $user; ?>',
        // number of images to show
        count: <?php echo $count; ?>,
        // period to get last.fm data from
        period: '<?php echo $period; ?>',
        // when to get new data from last.fm (in minutes)
        refresh: <?php echo $refresh; ?>,
        // difference between your timezone and GMT.
        offset: <?php echo $offset; ?>
    };
   lastFmRecords.init(_config);
   });
  </script>


	   <?php			
	   echo $after_widget;
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
		$user = esc_attr($instance['user']);
		$count = esc_attr($instance['count']);
		$period = esc_attr($instance['period']);
		$refresh = esc_attr($instance['refresh']);
		$offset = esc_attr($instance['offset']);
		?>
        <p>
            <label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('LastFM username:','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('user'); ?>" value="<?php echo $user; ?>" class="widefat" id="<?php echo $this->get_field_id('user'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number (up to 10):','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $count; ?>" class="widefat" id="<?php echo $this->get_field_id('count'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('period'); ?>"><?php _e('Period:','woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('period'); ?>" class="widefat" id="<?php echo $this->get_field_id('period'); ?>">
                <option value="recenttracks" <?php if($period == "recenttracks"){ echo "selected='selected'";} ?>><?php _e('Recent tracks', 'woothemes'); ?></option>
                <option value="7day" <?php if($period == "7day"){ echo "selected='selected'";} ?>><?php _e('7 days', 'woothemes'); ?></option>  
                <option value="3month" <?php if($period == "3month"){ echo "selected='selected'";} ?>><?php _e('3 months', 'woothemes'); ?></option>            
                <option value="6month" <?php if($period == "6month"){ echo "selected='selected'";} ?>><?php _e('6 months', 'woothemes'); ?></option>            
                <option value="12month" <?php if($period == "12month"){ echo "selected='selected'";} ?>><?php _e('12 months', 'woothemes'); ?></option>            
                <option value="overall" <?php if($period == "overall"){ echo "selected='selected'";} ?>><?php _e('Overall', 'woothemes'); ?></option>            
                <option value="topalbums" <?php if($period == "topalbums"){ echo "selected='selected'";} ?>><?php _e('Top albums', 'woothemes'); ?></option>            
                <option value="lovedtracks" <?php if($period == "lovedtracks"){ echo "selected='selected'";} ?>><?php _e('Loved tracks', 'woothemes'); ?></option>            
          
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('refresh'); ?>"><?php _e('Refresh rate:','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('refresh'); ?>" value="<?php echo $refresh; ?>" class="widefat" id="<?php echo $this->get_field_id('refresh'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e('Timezone offset:','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('offset'); ?>" value="<?php echo $offset; ?>" class="widefat" id="<?php echo $this->get_field_id('offset'); ?>" />
        </p>
		<?php
	}
} 

register_widget('woo_lastfm');


/*---------------------------------------------------------------------------------*/
/* Flickr widget */
/*---------------------------------------------------------------------------------*/
class Woo_flickr extends WP_Widget {

	function Woo_flickr() {
		$widget_ops = array('description' => 'This Flickr widget populates photos from a Flickr ID.' );

		parent::WP_Widget(false, __('Woo - Flickr', 'woothemes'),$widget_ops);      
	}

	function widget($args, $instance) {  
		extract( $args );
		$id = $instance['id'];
		$number = $instance['number'];
		$type = $instance['type'];
		$sorting = $instance['sorting'];
		
		echo $before_widget;
		echo $before_title; ?>
		<?php _e('Snapping...','woothemes'); ?>
        <?php echo $after_title; ?>
            
        <div class="wrap">
            <div class="fix"></div>
            <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=<?php echo $sorting; ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type; ?>&amp;<?php echo $type; ?>=<?php echo $id; ?>"></script>        
            <div class="fix"></div>
        </div>

	   <?php			
	   echo $after_widget;
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
		$id = esc_attr($instance['id']);
		$number = esc_attr($instance['number']);
		$type = esc_attr($instance['type']);
		$sorting = esc_attr($instance['sorting']);
		?>
        <p>
            <label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID (<a href="http://www.idgettr.com">idGettr</a>):','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('id'); ?>" value="<?php echo $id; ?>" class="widefat" id="<?php echo $this->get_field_id('id'); ?>" />
        </p>
       	<p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number:','woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('number'); ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>">
                <?php for ( $i = 1; $i < 10; $i += 1) { ?>
                <option value="<?php echo $i; ?>" <?php if($number == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Type:','woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('type'); ?>" class="widefat" id="<?php echo $this->get_field_id('type'); ?>">
                <option value="user" <?php if($type == "user"){ echo "selected='selected'";} ?>><?php _e('User', 'woothemes'); ?></option>
                <option value="group" <?php if($type == "group"){ echo "selected='selected'";} ?>><?php _e('Group', 'woothemes'); ?></option>            
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sorting'); ?>"><?php _e('Sorting:','woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('sorting'); ?>" class="widefat" id="<?php echo $this->get_field_id('sorting'); ?>">
                <option value="latest" <?php if($sorting == "latest"){ echo "selected='selected'";} ?>><?php _e('Latest', 'woothemes'); ?></option>
                <option value="random" <?php if($sorting == "random"){ echo "selected='selected'";} ?>><?php _e('Random', 'woothemes'); ?></option>            
            </select>
        </p>
		<?php
	}
} 

register_widget('woo_flickr');


/*---------------------------------------------------------------------------------*/
/* Ad Widget */
/*---------------------------------------------------------------------------------*/

class Woo_AdWidget extends WP_Widget {

	function Woo_AdWidget() {
		$widget_ops = array('description' => 'Use this widget to add any type of Ad as a widget.' );
		parent::WP_Widget(false, __('Woo - Adspace Widget', 'woothemes'),$widget_ops);      
	}

	function widget($args, $instance) {  
		$title = $instance['title'];
		$adcode = $instance['adcode'];
		$image = $instance['image'];
		$href = $instance['href'];
		$alt = $instance['alt'];

        echo '<div class="adspace-widget widget">';

		if($title != '')
			echo '<h3>'.$title.'</h3>';

		if($adcode != ''){
		?>
		
		<?php echo $adcode; ?>
		
		<?php } else { ?>
		
			<a href="<?php echo $href; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $alt; ?>" /></a>
	
		<?php
		}
		
		echo '</div>';

	}

	function update($new_instance, $old_instance) {                
		return $new_instance;
	}

	function form($instance) {        
		$title = esc_attr($instance['title']);
		$adcode = esc_attr($instance['adcode']);
		$image = esc_attr($instance['image']);
		$href = esc_attr($instance['href']);
		$alt = esc_attr($instance['alt']);
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('adcode'); ?>"><?php _e('Ad Code:','woothemes'); ?></label>
            <textarea name="<?php echo $this->get_field_name('adcode'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"><?php echo $adcode; ?></textarea>
        </p>
        <p><strong>or</strong></p>
        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image Url:','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('href'); ?>"><?php _e('Link URL:','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo $href; ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('Alt text:','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo $alt; ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
        </p>
        <?php
	}
} 

register_widget('Woo_AdWidget');


/*---------------------------------------------------------------------------------*/
/* Search widget */
/*---------------------------------------------------------------------------------*/
class Woo_Search extends WP_Widget {

   function Woo_Search() {
	   $widget_ops = array('description' => 'This is a WooThemes standardized search widget.' );
       parent::WP_Widget(false, __('Woo - Search', 'woothemes'),$widget_ops);      
   }

   function widget($args, $instance) {  
    extract( $args );
   	$title = $instance['title'];
	?>
		<?php echo $before_widget; ?>
        <?php if ($title) { echo $before_title . $title . $after_title; } ?>
        <?php include(TEMPLATEPATH . '/search-form.php'); ?>
		<?php echo $after_widget; ?>   
   <?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
       $title = esc_attr($instance['title']);
       ?>
       <p>
	   	   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p>
      <?php
   }
} 

register_widget('Woo_Search');

/*---------------------------------------------------------------------------------*/
/* Retreat Twitter widget */
/*---------------------------------------------------------------------------------*/
class Woo_RetreatTwitter extends WP_Widget {

   function Woo_RetreatTwitter() {
	   $widget_ops = array('description' => 'Add a Live Twitter feed to your sidebar with this widget.' );
       parent::WP_Widget(false, __('Woo - Live Twitter', 'woothemes'),$widget_ops);      
   }
   
   function widget($args, $instance) {  
    extract( $args );
   	$title = $instance['title'];
    $limit = 1;
	$string = $instance['string'];
	$limit = $instance['limit'];
	$rate = $instance['rate'];
	$rate = $instance['rate'];
	$follow_link = $instance['follow_link'];
	$follow_text = $instance['follow_text'];
	
	$unique_id = $args['widget_id'];	
	
	if(empty($rate)) $rate = 15000;
	if(empty($limit)) $limit = 5;
	?>
		<?php echo $before_widget; ?>
        <?php if ($title) echo $before_title . $title . $after_title; ?>
        		
        		<?php
			    if(!empty($string)){
			    $string_array = explode(",",$string);
			    ?>
				<div id="twitterSearch"> </div>
			    <script type="text/javascript">
			    jQuery(document).ready(function(){
				<?php
				foreach($string_array as $s){ ?>
			  		jQuery('#twitterSearch').liveTwitter('<?php echo $s; ?>', {limit: <?php echo $limit; ?>, rate:<?php echo $rate; ?>});
			  	<?php } ?>
			  	});
			   	</script>
			    <?php } ?>
			   
			   	<?php if(!empty($follow_text)) { ?>
			    <p class="link-ancillary"><a title="Follow us on Twitter" href="<?php echo $follow_link; ?>"><?php echo $follow_text; ?></a></p>
			    <?php } ?>
			    
        <?php echo $after_widget; ?>
        
   		
	<?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
       $title = esc_attr($instance['title']);
	   $string = esc_attr($instance['string']);
	   $rate = esc_attr($instance['rate']);
	   $limit = esc_attr($instance['limit']);
	   $follow_text = esc_attr($instance['follow_text']);
	   $follow_link = esc_attr($instance['follow_link']);

       ?>
       <p>
	   	   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('string'); ?>"><?php _e('Search String:','woothemes'); ?> <small><?php _e('(comma seperated)','woothemes'); ?></small></label>
	       <input type="text" name="<?php echo $this->get_field_name('string'); ?>"  value="<?php echo $string; ?>" class="widefat" id="<?php echo $this->get_field_id('string'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('limit'); ?>"  value="<?php echo $limit; ?>" class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('rate'); ?>"><?php _e('Rate:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('rate'); ?>"  value="<?php echo $rate; ?>" class="widefat" id="<?php echo $this->get_field_id('rate'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('follow_link'); ?>"><?php _e('Follow Link:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('follow_link'); ?>"  value="<?php echo $follow_link; ?>" class="widefat" id="<?php echo $this->get_field_id('follow_link'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('follow_text'); ?>"><?php _e('Follow Text:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('follow_text'); ?>"  value="<?php echo $follow_text; ?>" class="widefat" id="<?php echo $this->get_field_id('follow_text'); ?>" />
       </p>
      <?php
   }
   
} 
register_widget('Woo_RetreatTwitter');

/* Blog Author Info */
/*---------------------------------------------------------------------------------*/
if (class_exists('WP_Widget')) {
	class Woo_BlogAuthorInfo extends WP_Widget {
	
	   function Woo_BlogAuthorInfo() {
		   $widget_ops = array('description' => 'This is a WooThemes Blog Author Info widget.' );
		   parent::WP_Widget(false, __('Woo - Blog Author Info', 'woothemes'),$widget_ops);      
	   }
	
	   function widget($args, $instance) {  
		extract( $args );
		$title = $instance['title'];
		$bio = $instance['bio'];
		$email = $instance['email'];
		$avatar_size = $instance['avatar_size']; if ( !$avatar_size ) $avatar_size = 48;
		$avatar_align = $instance['avatar_align']; if ( !$avatar_align ) $avatar_align = 'left';
		$read_more_text = $instance['read_more_text'];
		$read_more_url = $instance['read_more_url'];
		?>
			<?php echo $before_widget; ?>
			<?php if ($title) { echo $before_title . $title . $after_title; } ?>
			
            <span class="<?php echo $avatar_align; ?>"><?php if ( $email ) echo get_avatar( $email, $size = $avatar_size ); ?></span>
            <p><?php echo $bio; ?></p>
			<?php if ( $read_more_url ) echo '<p><a href="' . $read_more_url . '">' . $read_more_text . '</a></p>'; ?>
			<?php echo $after_widget; ?>   
	   <?php
	   }
	
	   function update($new_instance, $old_instance) {                
		   return $new_instance;
	   }
	
	   function form($instance) {        
	   
			$title = esc_attr($instance['title']);
			$bio = esc_attr($instance['bio']);
			$email = esc_attr($instance['email']);
			$avatar_size = esc_attr($instance['avatar_size']);
			$avatar_align = esc_attr($instance['avatar_align']);
			$read_more_text = esc_attr($instance['read_more_text']);
			$read_more_url = esc_attr($instance['read_more_url']);
			?>
			<p>
			   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','woothemes'); ?></label>
			   <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
			</p>
			<p>
			   <label for="<?php echo $this->get_field_id('bio'); ?>"><?php _e('Bio:','woothemes'); ?></label>
				<textarea name="<?php echo $this->get_field_name('bio'); ?>" class="widefat" id="<?php echo $this->get_field_id('bio'); ?>"><?php echo $bio; ?></textarea>
			</p>
			<p>
			   <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('<a href="http://www.gravatar.com/">Gravatar</a> E-mail:','woothemes'); ?></label>
			   <input type="text" name="<?php echo $this->get_field_name('email'); ?>"  value="<?php echo $email; ?>" class="widefat" id="<?php echo $this->get_field_id('email'); ?>" />
			</p>
			<p>
			   <label for="<?php echo $this->get_field_id('avatar_size'); ?>"><?php _e('Gravatar Size:','woothemes'); ?></label>
			   <input type="text" name="<?php echo $this->get_field_name('avatar_size'); ?>"  value="<?php echo $avatar_size; ?>" class="widefat" id="<?php echo $this->get_field_id('avatar_size'); ?>" />
			</p>
            <p>
                <label for="<?php echo $this->get_field_id('avatar_align'); ?>"><?php _e('Gravatar Alignment:','woothemes'); ?></label>
                <select name="<?php echo $this->get_field_name('avatar_align'); ?>" class="widefat" id="<?php echo $this->get_field_id('avatar_align'); ?>">
                    <option value="left" <?php if($avatar_align == "left"){ echo "selected='selected'";} ?>><?php _e('Left', 'woothemes'); ?></option>
                    <option value="right" <?php if($avatar_align == "right"){ echo "selected='selected'";} ?>><?php _e('Right', 'woothemes'); ?></option>            
                </select>
            </p>
 			<p>
			   <label for="<?php echo $this->get_field_id('read_more_text'); ?>"><?php _e('Read More Text (optional):','woothemes'); ?></label>
			   <input type="text" name="<?php echo $this->get_field_name('read_more_text'); ?>"  value="<?php echo $read_more_text; ?>" class="widefat" id="<?php echo $this->get_field_id('read_more_text'); ?>" />
			</p>
			<p>
			   <label for="<?php echo $this->get_field_id('read_more_url'); ?>"><?php _e('Read More URL (optional):','woothemes'); ?></label>
			   <input type="text" name="<?php echo $this->get_field_name('read_more_url'); ?>"  value="<?php echo $read_more_url; ?>" class="widefat" id="<?php echo $this->get_field_id('read_more_url'); ?>" />
			</p>
          
			<?php
	   	}
	} 
	
	register_widget('Woo_BlogAuthorInfo');
}
	

/*---------------------------------------------------------------------------------*/
/* Deregister Default Widgets */
/*---------------------------------------------------------------------------------*/
function woo_deregister_widgets(){
    unregister_widget('WP_Widget_Search');         
}
add_action('widgets_init', 'woo_deregister_widgets');  


?>