<?php
/**
 * This fucntion is responsible for rendering metaboxes in single post area
 * 
 * @package Uniform
 */

add_action( 'add_meta_boxes', 'uniform_sidebar_layout' );
/**
 * Add Meta Boxes.
 */
function uniform_sidebar_layout() {
	// Adding layout meta box for page
	add_meta_box( 
                'page-sidebar', // $id
                __( 'Select Layout', 'uniform' ), // $title 
                'uniform_page_sidebar', // $callback 
                'page', // $page
                'normal', // $context
                'high' ); // $priority
                 
	// Adding layout meta box for
	add_meta_box( 
                'page-sidebar', //$id
                __( 'Select Layout', 'uniform' ), //$title
                'uniform_page_sidebar', //$callback 
                'post', //$page
                'normal', //$context
                'high' ); // $priority
}

/****************************************************************************************/

global $page_sidebar;
$page_sidebar = array(
					'default-sidebar' 	=> array(
												'id'			=> 'uniform_page_sidebar',
												'value' 		=> 'default_sidebar',
												'label' 		=> __( 'Default Layout', 'uniform' )
												),
					'right-sidebar' 	=> array(
												'id'			=> 'uniform_page_sidebar',
												'value' 		=> 'right_sidebar',
												'label' 		=> __( 'Right Sidebar', 'uniform' )
												),
					'left-sidebar' 	=> array(
												'id'			=> 'uniform_page_sidebar',
												'value' 		=> 'left_sidebar',
												'label' 		=> __( 'Left Sidebar', 'uniform' )
												),
					'no-sidebar-full-width' => array(
													'id'			=> 'uniform_page_sidebar',
													'value' 		=> 'no_sidebar_full_width',
													'label' 		=> __( 'No Sidebar Full Width', 'uniform' )
													)
				);

/****************************************************************************************/

/**
 * Displays metabox to for select layout option
 */
function uniform_page_sidebar() {
	global $page_sidebar, $post;

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'uniform_page_sidebar_nonce' );

	foreach ($page_sidebar as $field) {
		$sidebar_meta = get_post_meta( $post->ID, $field['id'], true );
		if( empty( $sidebar_meta ) ) { $sidebar_meta = 'default_sidebar'; }
		?>
			<input class="post-format" type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $sidebar_meta ); ?>/>
			<label class="post-format-icon"><?php echo $field['label']; ?></label><br/>
		<?php
	}
}

/****************************************************************************************/

add_action('pre_post_update', 'uniform_save_page_sidebar_meta');
/**
 * save the custom metabox data
 * @hooked to pre_post_update hook
 */
function uniform_save_page_sidebar_meta( $post_id ) {
	global $page_sidebar, $post;

	// Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'uniform_page_sidebar_nonce' ] ) || !wp_verify_nonce( $_POST[ 'uniform_page_sidebar_nonce' ], basename( __FILE__ ) ) )
      return;

	// Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)
      return;

	if ('page' == $_POST['post_type']) {
      if (!current_user_can( 'edit_page', $post_id ) )
         return $post_id;
   }
   elseif (!current_user_can( 'edit_post', $post_id ) ) {
      return $post_id;
   }

	foreach ( $page_sidebar as $field ) {
		//Uniform this saving function
		$old = get_post_meta( $post_id, $field['id'], true );
		$new = $_POST[$field['id']];
		if ( $new && $new != $old ) {
			update_post_meta( $post_id, $field['id'], $new );
		} elseif ( '' == $new && $old ) {
			delete_post_meta( $post_id, $field['id'], $old );
		}
	} // end foreach
}