<?php
/**
 * Column Post Widgets
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return array $corporate_plus_post_number
 *
 */
if ( !function_exists('corporate_plus_post_number') ) :
    function corporate_plus_post_number() {
        $corporate_plus_post_number =  array(
            1 => __( '1', 'corporate-plus' ),
            2 => __( '2', 'corporate-plus' ),
            3 => __( '3', 'corporate-plus' ),
            4 =>  __( '4', 'corporate-plus' )
        );
        return apply_filters( 'corporate_plus_post_number', $corporate_plus_post_number );
    }
endif;

/**
 * Custom columns of category with various options
 *
 * @package AcmeThemes
 * @subpackage Corporate Plus
 */
if ( ! class_exists( 'corporate_plus_posts_col' ) ) {
    /**
     * Class for adding widget
     *
     * @package AcmeThemes
     * @subpackage Corporate_Plus_posts_col
     * @since 1.0.0
     */
    class corporate_plus_posts_col extends WP_Widget {

        /*defaults values for fields*/
        private $defaults = array(
            'unique_id'             => '',
            'title'                 => '',
            'corporate_plus_cat_id' => '',
            'post_number'           => 3,
            'button_url'            => ''
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'corporate_plus_posts_col',
                /*Widget name will appear in UI*/
                __('AT Posts Column', 'corporate-plus'),
                /*Widget description*/
                array( 'description' => __( 'Show recents post or post from category', 'corporate-plus' ), )
            );
        }
        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $title = esc_attr( $instance[ 'title' ] );
            $corporate_plus_selected_cat = esc_attr( $instance[ 'corporate_plus_cat_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $button_url = esc_url( $instance[ 'button_url' ] );
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
                <label for="<?php echo $this->get_field_id('corporate_plus_cat_id'); ?>"><?php _e('Select Category', 'corporate-plus'); ?></label>
                <?php
                $corporate_plus_dropown_cat = array(
                    'show_option_none'   => __('From Recent Posts','corporate-plus'),
                    'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $corporate_plus_selected_cat,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('corporate_plus_cat_id'),
                    'id'                 => $this->get_field_name('corporate_plus_cat_id'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'category',
                    'hide_if_empty'      => false,
                );
                wp_dropdown_categories($corporate_plus_dropown_cat);
                ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e( 'Number', 'corporate-plus' ); ?>:</label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" >
                    <?php
                    $corporate_plus_post_numbers = corporate_plus_post_number();
                    foreach ( $corporate_plus_post_numbers as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $post_number ); ?>><?php echo esc_attr( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
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
            $instance['corporate_plus_cat_id'] = ( isset( $new_instance['corporate_plus_cat_id'] ) ) ? esc_attr( $new_instance['corporate_plus_cat_id'] ) : '';
            $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );
            $instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );

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
            $instance = wp_parse_args( (array) $instance, $this->defaults);

            $init_animate_title = '';
            $init_animate_content = '';
            if ( 'corporate-plus-home' == $corporate_plus_sidebar_id ){
                $init_animate_title = "init-animate animated fadeInUp";
                $init_animate_content = "init-animate animated fadeInLeft";
            }

            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $corporate_plus_cat_id = esc_attr( $instance[ 'corporate_plus_cat_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $button_url = esc_url( $instance[ 'button_url' ] );
            /**
             * Filter the arguments for the Recent Posts widget.
             *
             * @since 1.0.0
             *
             * @see WP_Query
             *
             */
            $corporate_plus_cat_post_args = array(
                'posts_per_page'      => $post_number,
                'no_found_rows'       => true,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true
            );
            if( -1 != $corporate_plus_cat_id ){
                $corporate_plus_cat_post_args['cat'] = $corporate_plus_cat_id;
            }
            $the_query = new WP_Query( $corporate_plus_cat_post_args );
            echo $args['before_widget'];
            ?>
            <section id="<?php echo esc_attr( $unique_id );?>" class="<?php echo esc_attr( $corporate_plus_sidebar_id );?>">
                <div class="container">
                    <div class="main-title <?php echo esc_attr( $init_animate_title ); ?>">
                        <?php
                        if( !empty( $title ) ) {
                            echo $args['before_title'] .esc_html( $title ).$args['after_title'];
                        }
                        ?>
                    </div>
                    <div class="row">
                        <?php
                        if ( $the_query->have_posts() ):
                            $i = 1;
                            ?>
                            <?php
                            while( $the_query->have_posts() ):$the_query->the_post();
                                if ( 'corporate-plus-home' == $corporate_plus_sidebar_id ){
                                    if ( $i == 1 ) {
                                        $init_animate_content = "init-animate animated fadeInDown";
                                    }
                                    elseif ( $i == 2 ) {
                                        $init_animate_content = "init-animate animated fadeInRight";
                                    }
                                }
                                $clearfix = '';
                                if ( $i % 2 == 0 && $i > 1 ) {
                                    if( $post_number > 3 ){
                                        $clearfix = "<div class='clearfix'></div>";
                                    }
                                    if ( 'corporate-plus-home' == $corporate_plus_sidebar_id ){
                                        $init_animate_content = "init-animate animated fadeInRight";
                                    }
                                }
                                if( 1 == $post_number ){
                                    $b_col = "col-sm-12";
                                }
                                elseif( 3 == $post_number ){
                                    $b_col = "col-sm-4";
                                }
                                else{
                                    $b_col = "col-sm-6";
                                }
                                ?>
                                <div class="<?php echo esc_attr( $b_col ); ?>">
                                    <div class="blog-item <?php echo esc_attr( $init_animate_content );?>">
                                        <?php
                                        if( has_post_thumbnail() ):
                                            $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumbnail' );
                                        else:
                                            $image_url[0] = get_template_directory_uri().'/assets/img/no-image-400-320.png';
                                        endif;
                                        ?>
                                        <div class="blog-img">
                                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" /></a>
                                        </div>
                                        <h3>
                                            <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <header class="entry-header">
                                            <div class="entry-meta">
                                                <?php corporate_plus_posted_on(); ?>
                                            </div><!-- .entry-meta -->
                                        </header><!-- .entry-header -->
                                        <p>
                                            <?php echo esc_html( get_the_excerpt() ); ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                                echo $clearfix;
                                $i++;
                            endwhile;
                            ?>
                            <?php
                        endif;
                        if( !empty( $button_url )){
                            ?>
                            <div class="clearfix"></div>
                            <div class="at-btn-wrap">
                                <a class="btn btn-primary" href="<?php echo $button_url;?>">
                                    <?php _e( 'View More','corporate-plus' ); ?>
                                </a>
                            </div>
                            <?php
                        }
                        wp_reset_query();
                        ?>
                    </div>
                </div>
            </section>
            <?php
            echo $args['after_widget'];
        }
    } // Class corporate_plus_posts_col ends here
}
if ( ! function_exists( 'corporate_plus_posts_col' ) ) :
    /**
     * Function to Register and load the widget
     *
     * @since 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function corporate_plus_posts_col() {
        register_widget( 'corporate_plus_posts_col' );
    }
endif;
add_action( 'widgets_init', 'corporate_plus_posts_col' );