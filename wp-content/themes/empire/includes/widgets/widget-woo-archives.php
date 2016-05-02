<?php
/*-----------------------------------------------------------------------------------

CLASS INFORMATION

Description: A custom WooThemes Archives widget.
Date Created: 2011-04.
Last Modified: 2011-04-26.
Author: WooThemes.
Since: 1.0.0


TABLE OF CONTENTS

- function (constructor)
- function widget ()
- function update ()
- function form ()

- Register the widget on `widgets_init`.

-----------------------------------------------------------------------------------*/

class Woo_Widget_Archives extends WP_Widget {

	/*----------------------------------------
	  Constructor.
	  ----------------------------------------
	  
	  * The constructor. Sets up the widget.
	----------------------------------------*/

	function Woo_Widget_Archives () {
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_woo_archives', 'description' => __( 'A custom WooThemes archives widget.', 'woothemes' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'woo_archives' );

		/* Create the widget. */
		$this->WP_Widget( 'woo_archives', __('Woo - Archives', 'woothemes' ), $widget_ops, $control_ops );
		
	} // End Constructor

	/*----------------------------------------
	  widget()
	  ----------------------------------------
	  
	  * Displays the widget on the frontend.
	----------------------------------------*/

	function widget( $args, $instance ) {  
		
		$html = '';
		
		extract( $args, EXTR_SKIP );
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base );
			
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) {
		
			echo $before_title . $title . $after_title;
		
		} // End IF Statement
		
		/* Widget content. */
		
		// Add actions for plugins/themes to hook onto.
		do_action( 'widget_woo_archives_top' );
		
		global $post;
		
		$myposts = get_posts( 'post_type=post&posts_per_page=-1' );
					
		$dates_array 			= array();
		$year_array 			= array();
		$i 						= 0;
		$prev_post_ts    		= null;
		$prev_post_year  		= null;
		$distance_multiplier 	=  9;
		
		if ( count( $myposts ) > 0 ) {
			foreach( $myposts as $post ) {
				setup_postdata( $post );
				
				$post_ts    = strtotime( $post->post_date );
				$post_year  = date( 'Y', $post_ts );
				$post_month = date( 'm', $post_ts );
				
				// Handle the first year as a special case
				if ( is_null( $prev_post_year ) ) {
?>
<div class="archive">
	
	<div class="fl"><span class="archive_year"><a href="<?php echo get_year_link($post_year); ?>"><?php echo $post_year; ?></a></span></div>
	
	<div class="fr">
	
		<ul class="archives_list">
<?php
				} else if ( $prev_post_year != $post_year ) {
?>
		</ul>
	
	</div>
	
	<div class="fix"></div>

</div><!--/.archive-->
<?php			
	$working_year  =  $prev_post_year;
	
	// Print year headings until we reach the post year
	while ( $working_year > $post_year ) {
		$working_year--;
?>
		<div class="archive">
		<div class="fl"><span class="archive_year"><a href="<?php echo get_year_link($post_year); ?>"><?php echo $post_year; ?></a></span></div>
<?php
	}
// Open a new ordered list
?>
<div class="fr">

<ul class="archives_list">
<?php
				} // End IF Statement
				
				// Compute difference in days
				if ( ! is_null( $prev_post_ts ) && $prev_post_year == $post_year ) {
					$dates_diff  =  ( date( 'z', $prev_post_ts ) - date( 'z', $post_ts ) ) * $distance_multiplier;
				}
				else {
					$dates_diff  =  0;
				}
				
				// jump to next iteneration if month has already been counted 
				if ($prev_post_month == $post_month) continue;
?>
<li>
<a href="<?php echo get_month_link($working_year,get_the_time( 'm' )); ?>"><?php the_time( 'M' ); ?></a>
<?php
		// For subsequent iterations
		$prev_post_ts    =  $post_ts;
		$prev_post_year  =  $post_year;
		$prev_post_month = $post_month;

			} // End FOREACH Loop
			// If we've processed at least *one* post, close the ordered list
			if ( ! is_null( $prev_post_ts ) ) {
?>
</div>	
</ul>
<div class="fix"></div>
</div>
<?php
			}
			
		} // End IF Statement
		
		// Add actions for plugins/themes to hook onto.
		do_action( 'widget_woo_archives_bottom' );

		/* After widget (defined by themes). */
		echo $after_widget;

	} // End widget()

	/*----------------------------------------
	  update()
	  ----------------------------------------
	
	* Function to update the settings from
	* the form() function.
	
	* Params:
	* - Array $new_instance
	* - Array $old_instance
	----------------------------------------*/
	
	function update ( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		return $instance;
		
	} // End update()
	
   /*----------------------------------------
	 form()
	 ----------------------------------------
	  
	  * The form on the widget control in the
	  * widget administration area.
	  
	  * Make use of the get_field_id() and 
	  * get_field_name() function when creating
	  * your form elements. This handles the confusing stuff.
	  
	  * Params:
	  * - Array $instance
	----------------------------------------*/

   function form( $instance ) {       
   
       /* Set up some default widget settings. */
		$defaults = array(
						'title' => __( 'Archives', 'woothemes' )
					);

		$instance = wp_parse_args( (array) $instance, $defaults );
		       
		$instance = wp_parse_args( $instance, array_fill_keys( array( 'title' ), '' ) );
?>
       <!-- Widget Title: Text Input -->
       <p>
	   	   <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional):', 'woothemes' ); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>"  value="<?php echo $instance['title']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" />
       </p>
<?php
	} // End form()
	
} // End Class

/*----------------------------------------
  Register the widget on `widgets_init`.
  ----------------------------------------
  
  * Registers this widget.
----------------------------------------*/

add_action( 'widgets_init', create_function( '', 'return register_widget("Woo_Widget_Archives");' ), 1 ); 
?>