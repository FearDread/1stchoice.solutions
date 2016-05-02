<?php
/*---------------------------------------------------------------------------------*/
/* RSS widget */
/*---------------------------------------------------------------------------------*/
class Woo_RSS extends WP_Widget {

	function Woo_rss() {
		$widget_ops = array('description' => 'Subscribe widget by WooThemes, shows RSS and e-mail subscription link.' );

		parent::WP_Widget(false, __('Woo - Subscribe', 'woothemes'),$widget_ops);      
	}

	function widget($args, $instance) {  
		extract( $args );
		$desc = $instance['desc'];
		
		echo $before_widget;
						
		?>
		
        <div class="wrap">
            <div class="links">
            	<a href="<?php if ( get_option('woo_feed_url') <> "" ) { echo get_option('woo_feed_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>"><?php _e('RSS Feed','woothemes'); ?></a> 
            	<?php if ( get_option('woo_subscribe_email') <> "" ): ?>
            		&bull; <a href="<?php echo get_option('woo_subscribe_email'); ?>"><?php _e('E-mail Newsletter','woothemes'); ?></a>
            	<?php endif; ?>
            </div>
            <div class="count"><?php if ($desc == '') { echo _e('Subscribe to receive updates','woothemes'); } else { echo stripslashes($desc); } ?></div>
            
        </div>

	   <?php			
	   echo $after_widget;
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
		$desc = esc_attr($instance['desc']);
		?>
		<p>You can setup your RSS feed and e-mail subscription in the options panel (General Options).</p>
		<p>
		   <label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Description (optional):','woothemes'); ?></label>
		   <input type="text" name="<?php echo $this->get_field_name('desc'); ?>"  value="<?php echo $desc; ?>" class="widefat" id="<?php echo $this->get_field_id('desc'); ?>" />
		</p>
   		<?php
	}
} 

register_widget('woo_rss');
?>