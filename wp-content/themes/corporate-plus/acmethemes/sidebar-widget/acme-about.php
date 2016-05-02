<?php
/**
 * About Widgets
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return array $corporate_plus_about_number
 *
 */
if ( !function_exists('corporate_plus_about_number') ) :
    function corporate_plus_about_number() {
        $corporate_plus_about_number =  array(
            1 => __( '1', 'corporate-plus' ),
            2 => __( '2', 'corporate-plus' ),
            3 => __( '3', 'corporate-plus' ),
            4 =>  __( '4', 'corporate-plus' )
        );
        return apply_filters( 'corporate_plus_about_number', $corporate_plus_about_number );
    }
endif;

/**
 * Class for adding About Section Widget
 *
 * @package AcmeThemes
 * @subpackage Corporat Plus
 * @since 1.0.0
 */
if ( ! class_exists( 'Corporate_plus_about' ) ) {

    class Corporate_plus_about extends WP_Widget {
        /*defaults values for fields*/
        private $defaults = array(
            'unique_id'     => '',
            'title'         => '',
            'page_id'       => '',
            'about_number'  => 4
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'corporate_plus_about',
                /*Widget name will appear in UI*/
                __('AT About Section', 'corporate-plus'),
                /*Widget description*/
                array( 'description' => __( 'Show About Section.', 'corporate-plus' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $title = esc_attr( $instance[ 'title' ] );
            $page_id = absint( $instance[ 'page_id' ] );
            $about_number = absint( $instance[ 'about_number' ] );
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
                <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Select Parent Page For About', 'corporate-plus' ); ?>:</label>
                <br />
                <small><?php _e( 'Select parent page and its subpages will display in the frontend. If pages does not have any subpages, then selected single page will display', 'corporate-plus' ); ?></small>
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
                <label for="<?php echo $this->get_field_id( 'about_number' ); ?>"><?php _e( 'Number', 'corporate-plus' ); ?>:</label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'about_number' ); ?>" name="<?php echo $this->get_field_name( 'about_number' ); ?>" >
                    <?php
                    $corporate_plus_about_numbers = corporate_plus_about_number();
                    foreach ( $corporate_plus_about_numbers as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $about_number ); ?>><?php echo esc_attr( $value );?></option>
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
         * @since 1.0.0
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
            $instance[ 'about_number' ] = absint( $new_instance[ 'about_number' ] );

            return $instance;
        }
        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return array
         *
         */
        public function widget($args, $instance) {
            $corporate_plus_sidebar_id = $args['id'];
            $init_animate_title = '';
            $init_animate_content = '';
            if ( 'corporate-plus-home' == $corporate_plus_sidebar_id ){
                $init_animate_title = "init-animate animated fadeInUp";
                $init_animate_content = "init-animate animated fadeInLeft";
            }
            $instance = wp_parse_args( (array) $instance, $this->defaults);

            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $page_id = absint( $instance[ 'page_id' ] );
            $about_number = absint( $instance[ 'about_number' ] );
            echo $args['before_widget'];
            ?>

            <section id="<?php echo $unique_id;?>" class="<?php echo esc_attr( $corporate_plus_sidebar_id ); ?>">
                <div class="container">
                    <div class="main-title <?php echo esc_attr( $init_animate_title ); ?>">
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
                            'posts_per_page'      => $about_number,
                            'post_type'           => 'page',
                            'no_found_rows'       => true,
                            'post_status'         => 'publish'
                        );
                        $about_query = new WP_Query( $corporate_plus_child_page_args );
                        if ( !$about_query->have_posts() ){
                            $corporate_plus_child_page_args = array(
                                'page_id'         => $page_id,
                                'posts_per_page'      => 1,
                                'post_type'           => 'page',
                                'no_found_rows'       => true,
                                'post_status'         => 'publish'
                            );
                            $about_query = new WP_Query( $corporate_plus_child_page_args );
                            $about_number = 1;
                        }
                        /*The Loop*/
                        if ( $about_query->have_posts() ):
                        $i = 1;
                        while( $about_query->have_posts() ):$about_query->the_post();
                            $clearfix = '';
                            if ( $i % 2 == 0 && $i > 1 ) {
                                if( $about_number > 3 ){
                                    $clearfix = "<div class='clearfix'></div>";
                                }
                                if ( 'corporate-plus-home' == $corporate_plus_sidebar_id ){
                                    $init_animate_content = "init-animate animated fadeInRight";
                                }
                            }
                            if( 1 == $about_number ){
                                $b_col = "col-sm-12";
                            }
                            elseif( 3 == $about_number ){
                                $b_col = "col-sm-4";
                            }
                            else{
                                $b_col = "col-sm-6";
                            }
                            ?>
                            <div class="<?php echo esc_attr( $b_col ); ?>">
                                <div class="about-item <?php echo esc_attr( $init_animate_content )?>">
                                    <div class="circle pull-left">
                                        <?php
                                        $corporate_plus_icon = get_post_meta( get_the_ID(), 'corporate-plus-featured-icon', true );
                                        $corporate_plus_icon = isset( $corporate_plus_icon ) ? esc_attr( $corporate_plus_icon ) : '';
                                        if( !empty ( $corporate_plus_icon ) ) { ?>
                                            <i class="fa <?php echo esc_attr( $corporate_plus_icon ); ?>"></i>
                                        <?php }
                                        else{
                                            echo '<i class="fa fa-suitcase"></i>';
                                        }
                                        ?>
                                    </div>
                                    <h4>
                                        <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h4>
                                    <p>
                                        <?php echo esc_html( get_the_excerpt() );?>
                                    </p>
                                </div>
                            </div>
                            <?php
                            echo $clearfix;
                            $i++;
                        endwhile;
                        ?>
                    </div>
                    <?php
                    else:
                    /*do nothing for now*/
                    endif;
                    ?>
                    <?php endif;
                    wp_reset_query();
                    ?>
                </div>
            </section>
            <?php
            echo $args['after_widget'];
        }
    } // Class Corporate_plus_about ends here
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
if ( ! function_exists( 'corporate_plus_about' ) ) :

    function corporate_plus_about() {
        register_widget( 'Corporate_plus_about' );
    }
endif;
add_action( 'widgets_init', 'corporate_plus_about' );