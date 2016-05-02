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
	extract( $args );
	$title = apply_filters('widget_title', empty($instance['title']) ? __('Contact Us') : $instance['title']);
	$info_field_text = $instance['info_field_text'];
	$info_field_label = $instance['info_field_label'];
	$map_page_template = $instance['map_page_template'];
	?>
		<?php echo $before_widget; ?>
		<?php if ($title) { echo $before_title . $title . $after_title; } ?>
		<div class="contact-widget">
			
			<div class="fl">
				<span class="sub-title"><?php _e('Address', 'woothemes'); ?></span>
			</div>
			<div class="fr">
				<p>
					<span class="contact-widget-label"><?php _e($info_field_label,'woothemes'); ?></span>
					<span class="contact-widget-text"><?php _e( nl2br($info_field_text),'woothemes'); ?></span>			
					<?php if ( isset($map_page_template) && $map_page_template != '' ) { ?><a href="<?php echo get_permalink($map_page_template); ?>" class="map"><?php _e( 'Map','woothemes'); ?></a><?php } ?>
				</p>
			</div>
			
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
		$map_page_template = esc_attr($instance['map_page_template']);
		
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
            <label for="<?php echo $this->get_field_id( 'map_page_template' ); ?>"><?php _e( 'Contact Us Page:', 'woothemes' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'map_page_template' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'map_page_template' ); ?>">
            	<?php foreach($woo_pages_raw as $k => $v) { ?>
               	<option value="<?php echo $k ?>" <?php if($map_page_template == $k){ echo "selected='selected'";} ?>><?php _e( $v, 'woothemes' ); ?></option>
                <?php } ?>
            </select>
        </p>
		
		<?php
	}
} 

register_widget( 'Woo_ContactUs' );
?>