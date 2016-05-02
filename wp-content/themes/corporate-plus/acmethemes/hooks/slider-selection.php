<?php
/**
 * Display default slider
 *
 * @since Corporate Plus 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('corporate_plus_default_slider') ) :
    function corporate_plus_default_slider(){
        ?>
        <?php
        $bg_image_style = '';
        if ( get_header_image() ) :
            $bg_image_style .= 'background-image:url(' . esc_url( get_header_image() ) . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
        else:
            $bg_image_style .= 'background-image:url(' . esc_url( get_template_directory_uri()."/assets/img/startup-slider.jpg" ) . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
        endif; // End header image check.
        ?>
        <section id="at-banner-slider" class="home-fullscreen at-parallax" style="<?php echo $bg_image_style; ?>">
            <div class="at-overlay">
                <div class="slide text-slider-wrapper">
                    <ul class="text-slider at-featured-text-slider clearfix">
                        <li class="clearfix">
                            <span class="lead banner-title init-animate fadeInRight"><?php _e('Welcome to Corporate Plus','corporate-plus' );?></span>
                            <div class="banner-title-line line init-animate fadeInLeft"><span></span></div>
                            <div class="text-slider-caption init-animate fadeInDown">
                                <?php _e('Really Awesome Theme For Your Business-Corporate House or Personal Freelancing Sites','corporate-plus' );?>
                            </div>
                            <a href="http://acmethemes.com/themes/corporate-plus" class="init-animate fadeInUp btn btn-primary outline-outward banner-btn">
                                <?php _e('Know More','corporate-plus'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <a href="#about" class="scroll-wrap arrow">
                <span>
                    <span class="fa fa-angle-down fa-2x"></span>
                </span>
                </a>
            </div>
        </section>
        <?php
    }
endif;

/**
 * Featured Slider display
 *
 * @since Corporate Plus 1.1.0
 *
 * @param null
 * @return void
 */

if ( ! function_exists( 'corporate_plus_display_feature_slider' ) ) :

    function corporate_plus_display_feature_slider( ){
        global $corporate_plus_customizer_all_values;
        $corporate_plus_feature_page = $corporate_plus_customizer_all_values['corporate-plus-feature-page'];
        $corporate_plus_featured_slider_number = $corporate_plus_customizer_all_values['corporate-plus-featured-slider-number'];
        $corporate_plus_go_down = $corporate_plus_customizer_all_values['corporate-plus-go-down'];
        if( 0 != $corporate_plus_feature_page ) :
            $corporate_plus_child_page_args = array(
                'post_parent'         => $corporate_plus_feature_page,
                'posts_per_page'      => $corporate_plus_featured_slider_number,
                'post_type'           => 'page',
                'no_found_rows'       => true,
                'post_status'         => 'publish'
            );
            $slider_query = new WP_Query( $corporate_plus_child_page_args );
            if ( !$slider_query->have_posts() ){
                $corporate_plus_child_page_args = array(
                    'page_id'         => $corporate_plus_feature_page,
                    'posts_per_page'      => $corporate_plus_featured_slider_number,
                    'post_type'           => 'page',
                    'no_found_rows'       => true,
                    'post_status'         => 'publish'
                );
                $slider_query = new WP_Query( $corporate_plus_child_page_args );
            }
            /*The Loop*/
            if ( $slider_query->have_posts() ):

                $bg_image_style = '';
                $bg_image_class = '';
                if ( get_header_image() ) :
                    $bg_image_style .= 'background-image:url(' . get_header_image() . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;';
                    $bg_image_class = ' at-parallax';
                endif; // End header image check.
                ?>

                <section id="at-banner-slider" class="home-fullscreen<?php echo $bg_image_class; ?>" style="<?php echo $bg_image_style; ?>">
                    <div class="at-overlay">
                        <div class="slide text-slider-wrapper">
                            <ul class="text-slider at-featured-text-slider clearfix">
                                <?php
                                while( $slider_query->have_posts() ):$slider_query->the_post();
                                    ?>
                                    <li class="clearfix">
                                        <span class="lead banner-title init-animate fadeInRight"><?php the_title()?></span>
                                        <div class="banner-title-line line init-animate fadeInLeft"><span></span></div>
                                        <div class="text-slider-caption init-animate fadeInDown">
                                            <?php the_excerpt();?>
                                        </div>
                                        <a href="<?php the_permalink()?>" class="init-animate fadeInUp btn btn-primary outline-outward banner-btn">
                                            <?php _e('Know More','corporate-plus'); ?>
                                        </a>
                                    </li>
                                    <?php
                                endwhile;
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                    if( !empty( $corporate_plus_go_down )){
                        ?>
                        <a href="<?php echo esc_attr( $corporate_plus_go_down ); ?>" class="scroll-wrap arrow">
                            <span>
                                <span class="fa fa-angle-down fa-2x"></span>
                            </span>
                        </a>
                        <?php
                    }
                    ?>
                </section>
                <?php
            endif;
            ?>
        <?php
        else:
            corporate_plus_default_slider();
        endif;
        wp_reset_query();
    }
endif;
/**
 * Display related posts from same category
 *
 * @since Corporate Plus 1.0.0
 *
 * @return void
 *
 */
if ( !function_exists('corporate_plus_feature_slider') ) :
    function corporate_plus_feature_slider() {
        ?>
        <div class="home-bxslider">
            <?php corporate_plus_display_feature_slider(); ?>
        </div>
        <div class="clearfix"></div>
        <?php
    }
endif;
add_action( 'corporate_plus_action_feature_slider', 'corporate_plus_feature_slider', 0 );