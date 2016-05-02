<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Blog
 *
 * The blog page template displays the "blog-style" template on a sub-page. 
 *
 * @package WooFramework
 * @subpackage Template
 */

 global $woo_options;
 get_header();
 
/**
 * The Variables
 *
 * Setup default variables, overriding them if the "Theme Options" have been saved.
 */
	
	$settings = array(
					'thumb_w' => 100, 
					'thumb_h' => 100, 
					'thumb_align' => 'alignleft'
					);
					
	$settings = woo_get_dynamic_values( $settings );
?>
    <!-- #content Starts -->
    <div id="content" class="col-full">
    
		<header class="page_title">
			<h1><?php _e( 'Blog', 'woothemes' ); ?></h1>
		</header>

        <?php woo_main_before(); ?>
        
        <section id="main" class="col-left">       
		
		<?php woo_loop_before(); ?>

        <?php
        	if ( get_query_var( 'paged') ) { $paged = get_query_var( 'paged' ); } elseif ( get_query_var( 'page') ) { $paged = get_query_var( 'page' ); } else { $paged = 1; }
        	
        	$query_args = array(
        						'post_type' => 'post', 
        						'paged' => $paged
        					);
        	
        	$query_args = apply_filters( 'woo_blog_template_query_args', $query_args ); // Do not remove. Used to exclude categories from displaying here.
        	
        	remove_filter( 'pre_get_posts', 'woo_exclude_categories_homepage' );
        	
        	query_posts( $query_args );
        	
        	if ( have_posts() ) {
        		$count = 0;
        		while ( have_posts() ) { the_post(); $count++;
        ?>                                                            
            <!-- Post Starts -->
            <article <?php post_class(); ?>>
                
               
				 <section class="details">
					<div class="post-date">
						<p><?php the_time('j') ?></p>
						<span><?php the_time('M') ?><br /><?php the_time('Y') ?></span>
					</div>
					<div class="share-post">
						<span>Share</span>
						<span class="share-post-button"></span>
						<div>
							<?php echo do_shortcode('[twitter use_post_url="true"]'); ?><br />
							<?php echo do_shortcode('[fblike style="button_count"]'); ?><br />
						</div>
					</div>
					
					<?php the_tags( '<div class="post-tags">'.__( 'Tags: ', 'woothemes' ), ' ', '</div>' ); ?>
					
					<div class="post-comments"><a href="<?php the_permalink(); ?>#comments"><?php comments_number( 'no comments', '1 comment', '% comments' ); ?></a></div>
				</section>               

				<!-- starting article content -->
                <div class="article-inner">
                
				   <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<span class="post-author"><?php _e( 'by', 'woothemes' ); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a></span>
					
					<!-- For small screens only -->
					<section class="details-small"><?php _e( 'Posted on: ', 'woothemes' ); ?> <?php the_time('j M Y') ?> <div class="post-comments"><a href="<?php the_permalink(); ?>#comments"><?php comments_number( 'no comments', '1 comment', '% comments' ); ?></a></div>
					</section>               
					<!-- End of small screens section-->

                    <section class="entry fix">
					<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] != 'content' ) { woo_image( 'width=' . $settings['thumb_w'] . '&height=' . $settings['thumb_h'] . '&class=thumbnail ' . $settings['thumb_align'] ); } ?>    

					<div class="fix"></div>

    					<?php global $more; $more = 0; ?>	                                        
                        <?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) { the_content(__( 'Read More...', 'woothemes' ) ); } else { the_excerpt(); } ?>
                    </section>
        			
                    <footer class="post-more">      
                    	<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'excerpt' ) { ?>
                        <span class="read-more"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;', 'woothemes' ); ?>"><?php _e( 'Continue Reading &rarr;', 'woothemes' ); ?></a></span>
                        <?php } ?>
                    </footer>

                </div>
    
            </article><!-- /.post -->
                                                
        <?php
        		} // End WHILE Loop
        	
        	} else {
        ?>
            <article <?php post_class(); ?>>
                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
            </article><!-- /.post -->
        <?php } // End IF Statement ?> 
        
        <?php woo_loop_after(); ?> 
    
        <?php woo_pagenav(); ?>
		<?php wp_reset_query(); ?>                

        </section><!-- /#main -->
        
        <?php woo_main_after(); ?>
            
		<?php get_sidebar(); ?>

    </div><!-- /#content -->    
		
<?php get_footer(); ?>