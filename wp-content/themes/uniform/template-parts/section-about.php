<?php
/**
 *  This page display contains realted to testimonilas and about us section at home page
 *  
 * @package Uniform
 */
?>
<section class="uniform-home-section" id="section-about">
    <div class="about-section-wrapper">
        <div class="mt-container">
            <div class="mt-column-wrapper clearfix">
                <?php $section_side = get_theme_mod( 'flip_about_section_switch', 'left' ); ?>
                <div class="about-wrapper mt-column-2 <?php echo esc_attr( $section_side ); ?>">
                    <?php 
                        $page_id = get_theme_mod( 'about_page_left', '0' ) ;
                        if( !empty( $page_id ) && $page_id != '0' ) {
                            $page_query = new WP_Query( 'page_id='.$page_id );
                            if( $page_query->have_posts() ) {
                                while( $page_query->have_posts() ) {
                                    $page_query->the_post();
                                    $image_id = get_post_thumbnail_id();
                                    $image_path = wp_get_attachment_image_src( $image_id, 'large', true );
                                    $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                    ?>
                        <h2 class="section-title about-us"><?php the_title(); ?></h2>
                        <div class="page-thumb">
                            <?php if( has_post_thumbnail() ) { ?>
                                <figure><img src="<?php echo esc_url( $image_path[0] );?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title();?>" /></figure>
                            <?php } ?>
                        </div>
                        <div class="page-content"><?php the_excerpt(); ?></div>
                        <div class="post-readmore"><a href="<?php the_permalink();?>"> <?php _e( 'Read More', 'uniform' );?></a></div>
                    <?php
                                }
                            }
                        }
                    ?>
                </div>
                <div class="testimonilas-wrapper mt-column-2">
                    <h2 class="testi-title" id="testi-section-title"><?php echo esc_attr( get_theme_mod( 'testimonials_section_title', 'Testimonials' ) ); ?></h2>
                    <div class="testimonials-content-wrapper" id="testimonials-slider">
                        <?php 
                            $testi_category = get_theme_mod( 'testimonials_category', '' );
                            if( !empty( $testi_category ) && $testi_category != '0' ) {
                                $testi_args = array(
                                                'post_type' => 'post',
                                                'cat' => $testi_category,
                                                'post_status'=>'publish',
                                                'posts_per_page' => -1,
                                                'order' => 'DESC'
                                                );
                                $testi_query = new WP_Query( $testi_args );
                                if( $testi_query->have_posts() ) {
                                    echo '<ul class="bx-slider">';
                                    while( $testi_query->have_posts() ) {
                                        $testi_query->the_post();
                                        $image_id = get_post_thumbnail_id();
                                        $image_path = wp_get_attachment_image_src( $image_id, 'thumbnail', true );
                                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        ?>
                            <li class="single-testi-wrapper clearfix">
                                <div class="author-thumb">
                                    <?php if( has_post_thumbnail() ) { ?>
                                        <figure>
                                            <img src="<?php echo esc_url( $image_path[0] );?>" alt="<?php echo esc_attr( $image_alt );?>" title="<?php the_title();?>" />
                                        </figure>
                                    <?php } ?>
                                </div>
                                <div class="testi-content-wrapper">
                                    <div class="testi-content clearfix"><?php the_content(); ?></div>
                                    <div class="author-name"><?php the_title(); ?></div>
                                </div>
                            </li>
                        <?php
                                    }
                                    echo '</ul>';
                                }
                                wp_reset_query();
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>