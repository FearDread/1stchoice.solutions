<?php
/*---------------------------------------------------------------------------------*/
/* Get In Touch widget */
/*---------------------------------------------------------------------------------*/
class Woo_GIT extends WP_Widget {

	function Woo_GIT() {
		$widget_ops = array( 'description' => 'Note: To be used on your Homepage' );

		parent::WP_Widget(false, __( 'Woo - Get In Touch', 'woothemes' ),$widget_ops);      
	}

	function widget($args, $instance) {  
		extract( $args );
		
   		$title = apply_filters('widget_title', empty($instance['title']) ?  __( 'Get in touch', 'woothemes' ) : $instance['title']);
   		$phone = $instance['phone'];
		$email = $instance['email'];
		$vcard = $instance['vcard'];
		
		echo $before_widget;
		if ($title) { echo $before_title.__( $title, 'woothemes' ).$after_title; } ?>
            
        <div class="wrap">
            <ul>
            	<?php if ($phone != '') { ?><li class="phone"><span><?php _e( 'Phone', 'woothemes' ); ?></span><?php echo $phone; ?></li><?php } ?>
            	<?php if ($email != '') { ?><li class="email"><span><?php _e( 'Email', 'woothemes' ); ?></span><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li><?php } ?>
            	<?php if ($vcard != '') { ?><li class="vcard"><span><?php _e( 'V-Card', 'woothemes' ); ?></span><a href="<?php echo $vcard; ?>"><?php _e( 'Download', 'woothemes' ); ?></a></li><?php } ?>
            </ul>
        </div>

	   <?php			
	   echo $after_widget;
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {
   
   		$title = esc_attr($instance['title']);
		$phone = esc_attr($instance['phone']);
		$email = esc_attr($instance['email']);
		$vcard = esc_attr($instance['vcard']);
		        
		?>
		<p>
		   <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'woothemes' ); ?></label>
		   <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" />
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone Number:', 'woothemes' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $phone; ?>" class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:', 'woothemes' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $email; ?>" class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'vcard' ); ?>"><?php _e( 'V-Card:', 'woothemes' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'vcard' ); ?>" value="<?php echo $vcard; ?>" class="widefat" id="<?php echo $this->get_field_id( 'vcard' ); ?>" />
        </p>
                
		<?php
	}
} 

register_widget( 'woo_git' );
?>