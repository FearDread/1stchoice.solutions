<?php
/**
 * Class for adding Featured Section Widget
 *
 * @package AcmeThemes
 * @subpackage Corporat Plus
 * @since 1.0.0
 */
if ( ! class_exists( 'Corporate_plus_featured' ) ) {

    class Corporate_plus_featured extends WP_Widget {
        /*defaults values for fields*/
        private $defaults = array(
            'unique_id'     => '',
            'bg_image'      => '',
            'title'         => '',
            'sub_title'     => '',
            'button_url'   => ''
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'corporate_plus_featured',
                /*Widget name will appear in UI*/
                __('AT Featured Section', 'corporate-plus'),
                /*Widget description*/
                array( 'description' => __( 'Advanced Featured Section with Parallax Background.', 'corporate-plus' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $bg_image = esc_url( $instance[ 'bg_image' ] );
            $title = esc_attr( $instance[ 'title' ] );
            $sub_title = esc_textarea( $instance['sub_title'] );
            $button_url = esc_url( $instance[ 'button_url' ] );
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'unique_id' ); ?>"><?php _e( 'Section ID', 'corporate-plus' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'unique_id' ); ?>" name="<?php echo $this->get_field_name( 'unique_id' ); ?>" type="text" value="<?php echo $unique_id; ?>" />
                <br />
                <small><?php _e('Enter a Unique Section ID. You can use this ID in Menu item for enabling One Page Menu.','corporate-plus')?></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('bg_image'); ?>">
                    <?php _e( 'Select Background Image', 'corporate-plus' ); ?>:
                </label>
                <?php
                $corporate_plus_display_none = '';
                if ( empty( $bg_image ) ){
                    $corporate_plus_display_none = ' style="display:none;" ';
                }
                ?>
                <span class="img-preview-wrap" <?php echo  $corporate_plus_display_none ; ?>>
                    <img class="widefat" src="<?php echo esc_url( $bg_image ); ?>" alt="<?php _e( 'Image preview', 'corporate-plus' ); ?>"  />
                </span><!-- .img-preview-wrap -->
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('bg_image'); ?>" id="<?php echo $this->get_field_id('bg_image'); ?>" value="<?php echo esc_url( $bg_image ); ?>" />
                <input type="button" value="<?php _e( 'Upload Image', 'corporate-plus' ); ?>" class="button media-image-upload" data-title="<?php _e( 'Select Background Image','corporate-plus'); ?>" data-button="<?php _e( 'Select Background Image','corporate-plus'); ?>"/>
                <input type="button" value="<?php _e( 'Remove Image', 'corporate-plus' ); ?>" class="button media-image-remove" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'corporate-plus' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'sub_title' ); ?>"><?php _e( 'Description', 'corporate-plus' ); ?>:</label>
                <textarea class="widefat" rows="5" cols="15" id="<?php echo $this->get_field_id( 'sub_title' ); ?>" name="<?php echo $this->get_field_name( 'sub_title' ); ?>"><?php echo $sub_title; ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button Link Url', 'corporate-plus' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo $button_url; ?>" />
            </p>
            <?php
        }
        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance[ 'unique_id' ] = sanitize_key( $new_instance[ 'unique_id' ] );
            $instance['bg_image'] = ( isset( $new_instance['bg_image'] ) ) ?  esc_url_raw( $new_instance['bg_image'] ): '';

            $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

            if ( current_user_can('unfiltered_html') ){
                $instance[ 'sub_title' ] =  $new_instance[ 'sub_title' ];
            }
            else{
                $instance[ 'sub_title' ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'sub_title' ] ) ) );
            }
            $instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );

            return $instance;
        }
        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return array
         *
         */
        public function widget($args, $instance) {
            $corporate_plus_sidebar_id = $args['id'];
            $instance = wp_parse_args( (array) $instance, $this->defaults);

            $init_animate_title = '';
            $init_animate_content = '';
            if ( 'corporate-plus-home' == $corporate_plus_sidebar_id ){
                $init_animate_title = "init-animate animated fadeInUp";
                $init_animate_content = "init-animate animated fadeInDown";
            }
            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $bg_image = esc_url( $instance['bg_image'] );
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $sub_title = apply_filters( 'widget_text', !empty( $instance[ 'sub_title' ] ) ? $instance['sub_title'] : '' , $instance );
            $button_url = esc_url( $instance[ 'button_url' ] );

            echo $args['before_widget'];
            $bg_image_style = '';
            $bg_image_class = '';
            if ( !empty( $bg_image ) ) {
                $bg_image_style .= 'background-image:url(' . $bg_image . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
                $bg_image_class = 'at-parallax';
            }
            ?>
            <section id="<?php echo $unique_id;?>" class="<?php echo $bg_image_class; ?>" style="<?php echo $bg_image_style; ?>">
                <div class="featured-section">
                    <div class="at-overlay">
                        <div class="container">
                            <div class="main-title <?php echo esc_attr( $init_animate_title ); ?>">
                                <?php
                                if( !empty( $title ) ) {
                                    echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
                                }
                                if( !empty( $sub_title ) ) { ?>
                                    <div class="fs-text-desc">
                                        <p><?php echo esc_html( $sub_title ); ?></p>
                                    </div>
                                <?php }
                                ?>
                            </div>
                            <?php
                            if( !empty( $button_url )){
                                ?>
                                <div class="at-btn-wrap <?php echo esc_attr( $init_animate_content )?>">
                                    <a class="btn btn-primary" href="<?php echo $button_url;?>">
                                        <?php _e( 'Know More','corporate-plus' ); ?>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            echo $args['after_widget'];
        }
    } // Class Corporate_plus_featured ends here
}
/**
 * Function to Register and load the widget
 *
 * @since 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'corporate_plus_featured' ) ) :

    function corporate_plus_featured() {
        register_widget( 'Corporate_plus_featured' );
    }
endif;
add_action( 'widgets_init', 'corporate_plus_featured' );