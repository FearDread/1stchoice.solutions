<?php
/**
 *  This page display contains realted to service section at home page
 *  
 * @package Uniform
 */
?>
<section class="uniform-home-section clearfix" id="section-services">
    <div class="mt-container">
        <div class="uniform-services-wrapper">
            <h2 class="section-title" id="service-section-title"><?php echo esc_attr( get_theme_mod( 'service_section_title', 'Our Services' ) ); ?></h2>
            <?php
                $service_category = get_theme_mod( 'service_category', '0' );
                if( $service_category != null ) { ?>
                <div class="services-wrapper mt-column-wrapper ex-12">
                    <?php
                        $services_args = array(
                                            'post_type' => 'post',
                                            'cat' => $service_category,
                                            'post_status' => 'publish',
                                            'posts_per_page' => 14,
                                            'order' => 'DESC'
                                            );
                        $services_query = new WP_Query( $services_args );
                        if( $services_query->have_posts() ) { 
                            while( $services_query->have_posts() ) {
                                $services_query->the_post();
                                $image_id = get_post_thumbnail_id();
                                $image_path = wp_get_attachment_image_src( $image_id, 'uniform_home_section_thumb', true );
                                $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                    ?>
                        <div class="single-service-wrapper mt-column-4">
                            <?php if( has_post_thumbnail() ){ ?>
                                <figure><img src="<?php echo esc_url( $image_path[0] );?>" alt="<?php echo esc_attr( $image_alt );?>" title="<?php the_title();?>" /></figure>
                            <?php } ?>
                            <h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                            <div class="post-excerpt"><?php the_excerpt();?></div>
                            <div class="post-readmore"><a href="<?php the_permalink();?>"><?php _e( 'Read More', 'uniform' );?></a> </div>
                        </div>
                    <?php
                            }
                        }
                        wp_reset_query();
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>