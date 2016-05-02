<?php
/*---------------------------------------------------------------------------------*/
/* WooTabs widget */
/*---------------------------------------------------------------------------------*/

class Woo_Tabs extends WP_Widget {

   function Woo_Tabs() {
  	   $widget_ops = array('description' => 'This widget is the Tabs that classicaly goes into the sidebar. It contains the Popular posts, Latest Posts, Recent comments and a Tag cloud.' );
       parent::WP_Widget(false, $name = __('Woo - Tabs', 'woothemes'), $widget_ops);    
   }


   function widget($args, $instance) {        
       extract( $args );
       
       $number = $instance['number']; if ($number == '') $number = 5;
       $thumb_size = $instance['thumb_size']; if ($thumb_size == '') $thumb_size = 35;
	   $order = $instance['order']; if ($order == '') $order = "pop";
	   $pop = $instance['pop'];
	   $latest = $instance['latest'];
	   $comments = $instance['comments'];
	   $tags = $instance['tags']; 
       ?>  

 		<div id="tabs">
           
            <ul class="wooTabs">
                <?php if ( $order == "latest" && !$latest == "on") { ?><li class="latest"><a href="#tab-latest"><?php _e('Latest', 'woothemes'); ?></a></li>
                <?php } elseif ( $order == "comments" && !$comments == "on") { ?><li class="comments"><a href="#tab-comm"><?php _e('Comments', 'woothemes'); ?></a></li>
                <?php } elseif ( $order == "tags" && !$tags == "on") { ?><li class="tags"><a href="#tab-tags"><?php _e('Tags', 'woothemes'); ?></a></li>
                <?php } ?>
                <?php if (!$pop == "on") { ?><li class="popular"><a href="#tab-pop"><?php _e('Popular', 'woothemes'); ?></a></li><?php } ?>
                <?php if ($order <> "latest" && !$latest == "on") { ?><li class="latest"><a href="#tab-latest"><?php _e('Latest', 'woothemes'); ?></a></li><?php } ?>
                <?php if ($order <> "comments" && !$comments == "on") { ?><li class="comments"><a href="#tab-comm"><?php _e('Comments', 'woothemes'); ?></a></li><?php } ?>
                <?php if ($order <> "tags" && !$tags == "on") { ?><li class="tags"><a href="#tab-tags"><?php _e('Tags', 'woothemes'); ?></a></li><?php } ?>
            </ul>
            
            <div class="clear"></div>
            
            <div class="boxes box inside">
                        
	            <?php if ( $order == "latest" && !$latest == "on") { ?>
                <ul id="tab-latest" class="list">
                    <?php if ( function_exists('woo_tabs_latest') ) woo_tabs_latest($number, $thumb_size); ?>                    
                </ul>
	            <?php } elseif ( $order == "comments" && !$comments == "on") { ?>
				<ul id="tab-comm" class="list">
                    <?php if ( function_exists('woo_tabs_comments') ) woo_tabs_comments($number, $thumb_size); ?>                    
                </ul>
	            <?php } elseif ( $order == "tags" && !$tags == "on") { ?>
                <div id="tab-tags" class="list">
                    <?php wp_tag_cloud('smallest=12&largest=20'); ?>
                </div>
                <?php } ?>
                
                <?php if (!$pop == "on") { ?>
                <ul id="tab-pop" class="list">            
                    <?php if ( function_exists('woo_tabs_popular') ) woo_tabs_popular($number, $thumb_size); ?>                    
                </ul>
                <?php } ?>
                <?php if ($order <> "latest" && !$latest == "on") { ?>
                <ul id="tab-latest" class="list">
                    <?php if ( function_exists('woo_tabs_latest') ) woo_tabs_latest($number, $thumb_size); ?>                    
                </ul>
                <?php } ?>
                <?php if ($order <> "comments" && !$comments == "on") { ?>
				<ul id="tab-comm" class="list">
                    <?php if ( function_exists('woo_tabs_comments') ) woo_tabs_comments($number, $thumb_size); ?>                    
                </ul>                
                <?php } ?>
                <?php if ($order <> "tags" && !$tags == "on") { ?>
                <div id="tab-tags" class="list">
                    <?php wp_tag_cloud('smallest=12&largest=20'); ?>
                </div>                
                <?php } ?>

            </div><!-- /.boxes -->
			
        </div><!-- /wooTabs -->
    
         <?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {                
       $number = esc_attr($instance['number']);
       $thumb_size = esc_attr($instance['thumb_size']);
       $order = esc_attr($instance['order']);
       $pop = esc_attr($instance['pop']);
       $latest = esc_attr($instance['latest']); 
       $comments = esc_attr($instance['comments']);
       $tags = esc_attr($instance['tags']);

       ?>    
       <p>
	       <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:','woothemes'); ?>
	       <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
	       </label>
       </p>  
       <p>
	       <label for="<?php echo $this->get_field_id('thumb_size'); ?>"><?php _e('Thumbnail Size (0=disable):','woothemes'); ?>
	       <input class="widefat" id="<?php echo $this->get_field_id('thumb_size'); ?>" name="<?php echo $this->get_field_name('thumb_size'); ?>" type="text" value="<?php echo $thumb_size; ?>" />
	       </label>
       </p>  
        <p>
            <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('First Visible Tab:','woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('order'); ?>" class="widefat" id="<?php echo $this->get_field_id('order'); ?>">
                <option value="pop" <?php if($order == "pop"){ echo "selected='selected'";} ?>><?php _e('Popular', 'woothemes'); ?></option>
                <option value="latest" <?php if($order == "latest"){ echo "selected='selected'";} ?>><?php _e('Latest', 'woothemes'); ?></option>
                <option value="comments" <?php if($order == "comments"){ echo "selected='selected'";} ?>><?php _e('Comments', 'woothemes'); ?></option>
                <option value="tags" <?php if($order == "tags"){ echo "selected='selected'";} ?>><?php _e('Tags', 'woothemes'); ?></option>
            </select>
        </p>
       <p><strong>Hide Tabs:</strong></p>
       <p>
        <input id="<?php echo $this->get_field_id('pop'); ?>" name="<?php echo $this->get_field_name('pop'); ?>" type="checkbox" <?php if($pop == 'on') echo 'checked="checked"'; ?>><?php _e('Popular', 'woothemes'); ?></input>
	   </p>
	   <p>
	       <input id="<?php echo $this->get_field_id('latest'); ?>" name="<?php echo $this->get_field_name('latest'); ?>" type="checkbox" <?php if($latest == 'on') echo 'checked="checked"'; ?>><?php _e('Latest', 'woothemes'); ?></input>
	   </p>
	   <p>
	       <input id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" type="checkbox" <?php if($comments == 'on') echo 'checked="checked"'; ?>><?php _e('Comments', 'woothemes'); ?></input>
	   </p>
	   <p>
	       <input id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>" type="checkbox" <?php if($tags == 'on') echo 'checked="checked"'; ?>><?php _e('Tags', 'woothemes'); ?></input>
       </p>  
       <?php 
   }

} 
register_widget('Woo_Tabs');

// Add Javascript
if(is_active_widget( null,null,'woo_tabs' ) == true) {
	add_action('wp_footer','woo_widget_tabs_js');
}

function woo_widget_tabs_js(){
?>
<!-- Woo Tabs Widget -->
<script type="text/javascript">
jQuery(document).ready(function(){
	// UL = .wooTabs
	// Tab contents = .inside
	
	var tag_cloud_class = '#tagcloud'; 
	
	//Fix for tag clouds - unexpected height before .hide() 
	var tag_cloud_height = jQuery('#tagcloud').height();
	
	jQuery('.inside ul li:last-child').css('border-bottom','0px'); // remove last border-bottom from list in tab content
	jQuery('.wooTabs').each(function(){
		jQuery(this).children('li').children('a:first').addClass('selected'); // Add .selected class to first tab on load
	});
	jQuery('.inside > *').hide();
	jQuery('.inside > *:first-child').show();
	
	jQuery('.wooTabs li a').click(function(evt){ // Init Click funtion on Tabs
	
		var clicked_tab_ref = jQuery(this).attr('href'); // Strore Href value
		
		jQuery(this).parent().parent().children('li').children('a').removeClass('selected'); //Remove selected from all tabs
		jQuery(this).addClass('selected');
		jQuery(this).parent().parent().parent().children('.inside').children('*').hide();
		
		jQuery('.inside ' + clicked_tab_ref).fadeIn(500);
		 
		 evt.preventDefault();
	
	})
})
</script>
<?php
}

?>