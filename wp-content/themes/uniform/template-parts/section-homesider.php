<?php
/**
 *  This page display contains realted to Slider section at home page
 *  
 * @package Uniform
 */
?>

<div class="uniform-slider-wrapper" id="homepage-slider">
    <?php
        $slider_category = get_theme_mod( 'slider_category', '' );
        if( !empty( $slider_category ) && $slider_category !='0' ) {
            $posts_perpage_value = -1;
            $posts_perpage_value = apply_filters( 'uniform_slider_posts', $posts_perpage_value );
            $posts_order_vlaue = 'DESC';
            $posts_order_vlaue = apply_filters( 'uniform_slider_order', $posts_order_vlaue );
            $slider_args = array(
                            'post_type' => 'post',
                            'cat' => $slider_category,
                            'post_status' => 'publish',
                            'posts_per_page' => $posts_perpage_value,
                            'order'=> $posts_order_vlaue
                            );
            $slider_query = new WP_Query( $slider_args );
            if( $slider_query->have_posts() ) {
                echo '<ul class="bx-slider">';
                while( $slider_query->have_posts() ) {
                    $slider_query->the_post();
                    $image_id = get_post_thumbnail_id();
                    $image_path = wp_get_attachment_image_src( $image_id, 'full', true );
                    $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                    if( has_post_thumbnail() ) {
    ?>
                <li class="slider">
                    <div class="slide-image">
                        <figure><img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt );?>" /></figure>
                    </div>
                    <div class="mt-container">
                        <div class="slider-container">
                            <div class="entry-container-description">
                                <h3 class="slider-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <div class="slider-content"><?php the_content();?></div>
                                <div class="clearfix"></div>
                            <a class="atag-button homeslider-read-more-button" href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php _e( 'Read More', 'uniform' );?></a>
                            </div>
                        </div>
                    </div>
                </li>
    <?php
                    }
                }
            }
            wp_reset_query();
            echo '</ul>';
        }
    ?>
</div>