<?php

/*---------------------------------------------------------------------------------*/
/* Contact Information */
/*---------------------------------------------------------------------------------*/
class Woo_ContactUs extends WP_Widget {

   function Woo_ContactUs() {
	   $widget_ops = array( 'description' => 'This is a WooThemes Contact Information widget.' );
	   parent::WP_Widget(false, __( 'Woo - Contact Information', 'woothemes' ),$widget_ops);      
   }

   function widget($args, $instance) {  
    global $woo_options;
	extract( $args );
	if ($instance['title']) $title = $instance['title'];
	if ($instance['info_field_text']) $info_field_text = $instance['info_field_text'];
	if ($instance['info_field_label']) $info_field_label = $instance['info_field_label'];
	if ($instance['contact_page_template']) $contact_page_template = $instance['contact_page_template'];
	?>
		<?php echo $before_widget; ?>
		<?php if ($title) { echo $before_title . $title . $after_title; } ?>
		<div class="contact-widget">
			
			<ul>	
				<?php if ( $info_field_label != '' || $info_field_text != '' ) { ?>
				<li class="location">
					<span class="contact-widget-label"><?php _e($info_field_label,'woothemes'); ?></span>
					<span class="contact-widget-text"><?php _e( nl2br($info_field_text),'woothemes'); ?></span>	
				</li>
				<?php } ?>
					
				<?php if ( isset($contact_page_template) && $contact_page_template != '' ) { ?><li class="mail"><a href="<?php echo get_permalink($contact_page_template); ?>" class="mail"><?php _e('Send us an email', 'woothemes'); ?></a></li><?php } ?>
				<?php if ($woo_options['woo_social_facebook']): ?><li class="facebook"><a href="<?php echo $woo_options['woo_social_facebook']; ?>" title="Facebook"><?php _e('Friend us on Facebook', 'woothemes'); ?></a></li><?php endif; ?>
				<?php if ($woo_options['woo_social_twitter']): ?><li class="twitter"><a href="<?php echo $woo_options['woo_social_twitter']; ?>" title="Twitter"><?php _e('Follow us on Twitter', 'woothemes'); ?></a></li><?php endif; ?>				
				
			</ul>
			
			<div class="fix"></div>

		</div>
		<?php echo $after_widget; ?>   
    <?php
	
   }

   function update($new_instance, $old_instance) {                
	   return $new_instance;
   }

   function form($instance) {        
   
		$title = esc_attr($instance['title']);
		$info_field_text = esc_attr($instance['info_field_text']);
		$info_field_label = esc_attr($instance['info_field_label']);
		$contact_page_template = esc_attr($instance['contact_page_template']);
		
		//Access the WordPress Pages via an Array
		$woo_pages = array();
		$woo_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );    
		foreach ($woo_pages_obj as $woo_page) {
		    $woo_pages[$woo_page->ID] = $woo_page->post_name; }
    
		$woo_pages_raw = $woo_pages;
		$woo_pages_raw[0] = "Select a page:";
		$woo_pages_tmp = array_unshift($woo_pages, "Select a page:" ); 

		?>
		<p>
		   <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'woothemes' ); ?></label>
		   <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" />
		</p>
		<p>
		   <label for="<?php echo $this->get_field_id( 'info_field_label' ); ?>"><?php _e( 'Address Label:', 'woothemes' ); ?></label>
		   <input type="text" name="<?php echo $this->get_field_name( 'info_field_label' ); ?>"  value="<?php esc_attr_e( $info_field_label ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'info_field_label' ); ?>" />
		</p>
		<p>
		   <label for="<?php echo $this->get_field_id( 'info_field_text' ); ?>"><?php _e( 'Address:', 'woothemes' ); ?></label>
			<textarea name="<?php echo $this->get_field_name( 'info_field_text' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'info_field_text' ); ?>"><?php echo $info_field_text; ?></textarea>
		</p>
		<p>
            <label for="<?php echo $this->get_field_id( 'contact_page_template' ); ?>"><?php _e( 'Contact Us Page:', 'woothemes' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'contact_page_template' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'contact_page_template' ); ?>">
            	<?php foreach($woo_pages_raw as $k => $v) { ?>
               	<option value="<?php echo $k ?>" <?php if($contact_page_template == $k){ echo "selected='selected'";} ?>><?php _e( $v, 'woothemes' ); ?></option>
                <?php } ?>
            </select>
        </p>
		
		<?php
	}
} 

register_widget( 'Woo_ContactUs' );
?>