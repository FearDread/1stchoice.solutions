<?php
/*---------------------------------------------------------------------------------*/
/* Feedback widget */
/*---------------------------------------------------------------------------------*/
class Woo_Widget_Feedback extends WP_Widget {

   function Woo_Widget_Feedback () {
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_woo_feedback', 'description' => __( 'Display customer feedback.', 'woothemes' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'woo_feedback' );

		/* Create the widget. */
		$this->WP_Widget( 'woo_feedback', __('Woo - Feedback', 'woothemes' ), $widget_ops, $control_ops );
		
	} // End Constructor
   
   function widget($args, $instance) {  
    extract( $args );
   	$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Feedback', 'woothemes' ) : $instance['title']);
   	$unique_id = $args['widget_id'];
	?>

        <div id="<?php echo $unique_id; ?>" class="widget_woo_feedback widget">
        
            <?php if ($title) { ?><h3><?php echo $title; ?><span class="arrow"></span></h3><?php } ?>
        
		    <?php 
			global $post;
			$feedback = get_posts( 'post_type=feedback&orderby=rand&posts_per_page=20' );
			if ( !empty($feedback) ) : 
			?>
            <div class="feedback">
            	<div class="quotes">
            		<div class="quotes-content">
						<?php foreach($feedback as $post) : setup_postdata($post); ?>
					
		        			<?php 
			        		$author = get_post_meta(get_the_ID(), 'feedback_author', true);
			        		$url = get_post_meta(get_the_ID(), 'feedback_url', true);
		        			?>
			            	<div class="quote">
			                    <blockquote><?php the_content(); ?></blockquote>
			                    <div class="fix"></div>
			                    <?php if ( $author ) { ?><a class="quote-author" href="<?php echo $url; ?>"><cite><?php echo $author; ?></cite></a><?php } // End IF Statement ?>
								<?php
					        		if ( count( $feedback ) > 1 )
					        			echo '<a href="#" class="btn-next">' . __( 'Next', 'woothemes' ) . '</a>' . "\n";
					        	?>
			                </div>
			                
			            <?php endforeach; ?>
					</div><!--/.quotes-content-->
	        	</div>
        	</div>
        	<div class="feedback-bottom"></div>
    
        	<?php endif; ?>

        </div>
   		
	<?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form( $instance ) {        
   
       $title = esc_attr($instance['title']);
       $text = esc_attr($instance['text']);
	   $citation = esc_attr($instance['citation']);
       ?>
       <p><?php _e( 'Use the Feedback custom post type to add content to this widget.', 'woothemes' ); ?></p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','woothemes'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p>
      <?php
   }
   
} 
register_widget('Woo_Widget_Feedback');

// Add Javascript
if(is_active_widget( null,null,'woo_feedback' ) == true && !is_admin()) {
	add_action('wp_print_scripts','woo_widget_feedback_js');
	add_action('wp_footer','woo_widget_feedback_js_output');
}

function woo_widget_feedback_js(){
	wp_enqueue_script( 'jquery-cycle', get_template_directory_uri().'/includes/js/jquery.cycle.all.min.js', array( 'jquery' ) );
}

function woo_widget_feedback_js_output() {
// feedback widget
?>
<script type="text/javascript">
jQuery(document).ready( function(){

	var cycleArgs = {};
	
	cycleArgs.timeout = 0; // Disable auto-fade.
	cycleArgs.prev = '.widget_woo_feedback .btn-prev';
	cycleArgs.next = '.widget_woo_feedback .btn-next';
	cycleArgs.sync = true;
	cycleArgs.cleartype =  true;
	cycleArgs.cleartypeNoBg = true;

	jQuery( '.quotes-content' ).cycle( cycleArgs ); 
});
</script>
<?php 
}