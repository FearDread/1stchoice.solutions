<?php
/**
 * Services Widgets
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return array $corporate_plus_service_number
 *
 */
if ( !function_exists('corporate_plus_service_number') ) :
    function corporate_plus_service_number() {
        $corporate_plus_service_number =  array(
            1 => __( '1', 'corporate-plus' ),
            2 => __( '2', 'corporate-plus' ),
            3 => __( '3', 'corporate-plus' ),
            4 =>  __( '4', 'corporate-plus' )
        );
        return apply_filters( 'corporate_plus_service_number', $corporate_plus_service_number );
    }
endif;


/**
 * Class for adding Service Section Widget
 *
 * @package AcmeThemes
 * @subpackage Corporat Plus
 * @since 1.0.0
 */
if ( ! class_exists( 'Corporate_plus_service' ) ) {

    class Corporate_plus_service extends WP_Widget {
        /*defaults values for fields*/
        private $defaults = array(
            'unique_id'     => '',
            'title'         => '',
            'page_id'       => '',
            'service_number' => 4
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'corporate_plus_service',
                /*Widget name will appear in UI*/
                __('AT Service Section', 'corporate-plus'),
                /*Widget description*/
                array( 'description' => __( 'Show Service Section.', 'corporate-plus' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $title = esc_attr( $instance[ 'title' ] );
            $page_id = absint( $instance[ 'page_id' ] );
            $service_number = absint( $instance[ 'service_number' ] );
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'unique_id' ); ?>"><?php _e( 'Section ID', 'corporate-plus' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'unique_id' ); ?>" name="<?php echo $this->get_field_name( 'unique_id' ); ?>" type="text" value="<?php echo $unique_id; ?>" />
                <br />
                <small><?php _e('Enter a Unique Section ID. You can use this ID in Menu item for enabling One Page Menu.','corporate-plus')?></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'corporate-plus' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Select Page For Service', 'corporate-plus' ); ?>:</label>
                <br />
                <small><?php _e( 'Select parent page and its subpages will display in the frontend. If page does not have any subpages, then selected single page will display', 'corporate-plus' ); ?></small>
                <?php
                /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
                $args = array(
                    'selected'              => $page_id,
                    'name'                  => $this->get_field_name( 'page_id' ),
                    'id'                    => $this->get_field_id( 'page_id' ),
                    'class'                 => 'widefat',
                    'show_option_none'      => __('Select Page','corporate-plus'),
                );
                wp_dropdown_pages( $args );
                ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'service_number' ); ?>"><?php _e( 'Number', 'corporate-plus' ); ?>:</label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'service_number' ); ?>" name="<?php echo $this->get_field_name( 'service_number' ); ?>" >
                    <?php
                    $corporate_plus_service_numbers = corporate_plus_service_number();
                    foreach ( $corporate_plus_service_numbers as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $service_number ); ?>><?php echo esc_attr( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
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
            $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

            $instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
            $instance[ 'service_number' ] = absint( $new_instance[ 'service_number' ] );

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

            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $page_id = absint( $instance[ 'page_id' ] );
            $service_number = absint( $instance[ 'service_number' ] );

            echo $args['before_widget'];
            ?>
            <section id="<?php echo esc_attr( $unique_id );?>" class="<?php echo esc_attr( $corporate_plus_sidebar_id );?>">
                <div class="container">
                    <div class="main-title init-animate animated fadeInUp">
                        <?php
                        if( !empty( $title ) ) {
                            echo $args['before_title'] .esc_html( $title ).$args['after_title'];
                        }
                        ?>
                    </div>
                    <div class="row">
                        <?php if( !empty ( $page_id ) ) :
                            $corporate_plus_child_page_args = array(
                                'post_parent'         => $page_id,
                                'posts_per_page'      => $service_number,
                                'post_type'           => 'page',
                                'no_found_rows'       => true,
                                'post_status'         => 'publish'
                            );
                            $service_query = new WP_Query( $corporate_plus_child_page_args );
                            
                            if ( !$service_query->have_posts() ){
                                $corporate_plus_child_page_args = array(
                                    'page_id'         => $page_id,
                                    'posts_per_page'      => 1,
                                    'post_type'           => 'page',
                                    'no_found_rows'       => true,
                                    'post_status'         => 'publish'
                                );
                                $service_query = new WP_Query( $corporate_plus_child_page_args );
                                $service_number = 1;
                            }
                            
                            /*The Loop*/
                            if ( $service_query->have_posts() ):
                                $i = 0;
                                while( $service_query->have_posts() ):$service_query->the_post();
                                    $animate = "init-animate animated fadeInRight";
                                    if ( $i == 0 || $i == 1 ) {
                                        $animate = "init-animate animated fadeInLeft";
                                    }
                                    if( 1 == $service_number ){
                                        $b_col = "col-sm-12";
                                    }
                                    elseif( 2 == $service_number ){
                                        $b_col = "col-sm-6";
                                    }
                                    elseif( 3 == $service_number ){
                                        $b_col = "col-sm-12 col-md-4";
                                    }
                                    else{
                                        $b_col = "col-sm-12 col-md-3";
                                    }
                                    ?>
                                    <div class="<?php echo esc_attr( $b_col ); ?>">
                                        <div class="service-item <?php echo esc_attr( $animate );?>">
                                            <div class="circle">
                                                <?php
                                                $corporate_plus_icon = get_post_meta( get_the_ID(), 'corporate-plus-featured-icon', true );
                                                $corporate_plus_icon = isset( $corporate_plus_icon ) ? esc_attr( $corporate_plus_icon ) : '';
                                                if( !empty ( $corporate_plus_icon ) ) { ?>
                                                    <i class="fa <?php echo esc_attr( $corporate_plus_icon ); ?> fa-2x"></i>
                                                <?php }
                                                else{
                                                    echo '<i class="fa fa-suitcase fa-2x"></i>';
                                                }
                                                ?>
                                            </div>
                                            <h3>
                                                <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <p>
                                                <?php echo esc_html( get_the_excerpt() ); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php $i++;
                                endwhile;
                                echo "</div>";
                            endif;
                            ?>
                        <?php endif;
                        wp_reset_query();
                        ?>
                    </div>
                </div>
            </section>
            <?php
            echo $args['after_widget'];
        }
    } // Class Corporate_plus_service ends here
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
if ( ! function_exists( 'corporate_plus_service' ) ) :

    function corporate_plus_service() {
        register_widget( 'Corporate_plus_service' );
    }
endif;
add_action( 'widgets_init', 'corporate_plus_service' );