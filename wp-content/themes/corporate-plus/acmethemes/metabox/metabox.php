<?php
/**
 * Custom Metabox
 * Only added icon not special data
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return void
 *
 */
if( !function_exists( 'corporate_plus_add_metabox' )):
    function corporate_plus_add_metabox() {
        add_meta_box(
            'corporate_plus_meta_fields', // $id
            __( 'Featured Icon', 'corporate-plus' ), // $title
            'corporate_plus_meta_fields_callback', // $callback
            'page', // $page
            'side', // $context
            'core'// $priority
        );
    }
endif;
add_action('add_meta_boxes', 'corporate_plus_add_metabox');

/**
 * Callback function for metabox
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('corporate_plus_meta_fields_callback') ) :
    function corporate_plus_meta_fields_callback(){
        global $post;
        $corporate_plus_featured_icon = get_post_meta( $post->ID, 'corporate-plus-featured-icon', true );
        wp_nonce_field( basename( __FILE__ ), 'corporate_plus_meta_fields_nonce' );
       ?>
        <table class="form-table page-meta-box">
            <tr>
                <td>
                    <label class="description" for="corporate-plus-featured-icon"><?php _e( 'Enter Featured Icon', 'corporate-plus' ); ?></label>
                    <input class="widefat" id="corporate-plus-featured-icon" type="text" name="corporate-plus-featured-icon" value="<?php echo esc_attr( $corporate_plus_featured_icon ); ?>" placeholder="fa-desktop"/>
                    <br />
                    <small>
                        <?php _e( 'Featured Icon Used in Widgets', 'corporate-plus' );

                        printf( __( '%sRefer here%s for icon class. For example: %sfa-desktop%s', 'corporate-plus' ), '<br /><a href="'.esc_url( 'https://fortawesome.github.io/Font-Awesome/cheatsheet/' ).'" target="_blank">','</a>',"<code>","</code>" );
                        ?>
                    </small>

                </td>
            </tr>
        </table>

    <?php }
endif;

/**
 * save the custom metabox data
 * @hooked to save_post hook
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('corporate_plus_save_sidebar_layout') ) :
    function corporate_plus_save_sidebar_layout( $post_id ) {

        // Verify the nonce before proceeding.
        if ( !isset( $_POST[ 'corporate_plus_meta_fields_nonce' ] ) || !wp_verify_nonce( $_POST[ 'corporate_plus_meta_fields_nonce' ], basename( __FILE__ ) ) )
            return;

        // Stop WP from clearing custom fields on autosave
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;

        //Execute this saving function
        if(isset($_POST['corporate-plus-featured-icon'])){
            $new = sanitize_text_field($_POST['corporate-plus-featured-icon']);
            update_post_meta($post_id, 'corporate-plus-featured-icon', $new);

        }
    }

endif;
add_action('save_post', 'corporate_plus_save_sidebar_layout');
