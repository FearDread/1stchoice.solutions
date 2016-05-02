<?php
/**
 *  This page display contains realted to Latest Blog section at home page
 *  
 * @package Uniform
 */
?>

<section class="uniform-home-section" id="section-latest-blog">
    <div class="blog-post-wrapper">
        <div class="mt-container">
            <h2 class="section-title" id="blog-section-title"><?php echo esc_attr( get_theme_mod( 'latest_blog_title', 'Latest News' ) );?></h2>
            <div class="posts-wrapper mt-column-wrapper clearfix">
                <?php
                    $blog_category = get_theme_mod( 'latest_blog_category', '' );
                    if( !empty( $blog_category ) && $blog_category != '0' ) {
                        $blog_args = array(
                                        'post_type' => 'post',
                                        'cat' => $blog_category,
                                        'post_status' => 'publish',
                                        'posts_per_page' => 3,
                                        'order' => 'DESC'
                                        );
                        $blog_query = new WP_Query( $blog_args );
                        if( $blog_query->have_posts() ) {
                            while( $blog_query->have_posts() ) {
                                $blog_query->the_post();
                                $image_id = get_post_thumbnail_id();
                                $image_path = wp_get_attachment_image_src( $image_id, 'uniform_home_section_thumb', true );
                                $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                ?>
                    <div class="single-post-wrapper mt-column-3">
                        <figure>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <img src="<?php echo esc_url( $image_path[0] );?>" alt="<?php echo esc_attr( $image_alt );?>" />
                            </a>
                        </figure>
                        <h3 class="blog-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                        <div class="blog-meta-wrap">
                            <?php 
                                if( get_theme_mod( 'blog_post_meta_option', 'show' ) == 'show' ) {
                                    uniform_posted_on();
                                }
                            ?>
                        </div>
                        <div class="blog-content"><?php the_excerpt();?></div>
                        <div class="post-readmore"><a href="<?php the_permalink();?>"><?php _e( 'Read More', 'uniform' );?></a> </div>
                    </div>
                <?php
                            }
                        }
                        wp_reset_query();
                    }
                ?>
            </div>
        </div>
    </div>
</section>