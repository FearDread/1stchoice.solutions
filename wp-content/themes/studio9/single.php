<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Single Post Template
 *
 * This template is the default page template. It is used to display content when someone is viewing a
 * singular view of a post ('post' post_type).
 * @link http://codex.wordpress.org/Post_Types#Post
 *
 * @package WooFramework
 * @subpackage Template
 */
	get_header();
	global $woo_options;
	
/**
 * The Variables
 *
 * Setup default variables, overriding them if the "Theme Options" have been saved.
 */
	
	$settings = array(
					'thumb_single' => 'false', 
					'single_w' => 200, 
					'single_h' => 200, 
					'thumb_single_align' => 'alignright'
					);
					
	$settings = woo_get_dynamic_values( $settings );
?>
       
    <div id="content" class="col-full">

        <?php
        	if ( have_posts() ) { $count = 0;
        		while ( have_posts() ) { the_post(); $count++;
        ?>

		<header class="page_title">
			<h1><?php _e( 'Blog', 'woothemes' ); ?></h1>
        </header>
		
		<?php woo_main_before(); ?>
    	
		<section id="main" class="col-left">
		           
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

                <div class="article-inner">
				<h2 class="fl"><?php the_title(); ?></h2>
					<span class="post-author"><?php _e( 'by', 'woothemes' ); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a></span>
				<div class="fix"></div>
					
					<!-- For small screens only -->
					<section class="details-small"><?php _e( 'Posted on: ', 'woothemes' ); ?> <?php the_time('j M Y') ?> <?php echo do_shortcode('[twitter use_post_url="true"]'); ?> <?php echo do_shortcode('[fblike style="button_count"]'); ?> <?php the_tags( '<div class="post-tags">'.__( 'Tags: ', 'woothemes' ), ' ', '</div>' ); ?><div class="post-comments"><a href="<?php the_permalink(); ?>#comments"><?php comments_number( 'no comments', '1 comment', '% comments' ); ?></a></div>
					</section>               
					<!-- End of small screens section-->

				<?php echo woo_embed( 'width=560' ); ?>
                <?php if ( $settings['thumb_single'] == 'true' && ! woo_embed( '' ) ) { woo_image( 'width=' . $settings['single_w'] . '&height=' . $settings['single_h'] . '&class=thumbnail ' . $settings['thumb_single_align'] ); } ?>
				<div class="fix"></div>
	                <section class="entry fix">
	                	<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>
					</section>

					<?php the_tags( '<p class="tags">'.__( 'Tags: ', 'woothemes' ), ', ', '</p>' ); ?>

				</div>
									
                                
            </article><!-- .post -->

				<?php if ( isset( $woo_options['woo_post_author'] ) && $woo_options['woo_post_author'] == 'true' ) { ?>
				<aside id="post-author" class="fix">
					<div class="profile-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), '70' ); ?></div>
					<div class="profile-content">
						<h3 class="title"><?php printf( esc_attr__( 'About %s', 'woothemes' ), get_the_author() ); ?></h3>
						<?php the_author_meta( 'description' ); ?>
						<div class="profile-link">
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'woothemes' ), get_the_author() ); ?>
							</a>
						</div><!-- #profile-link	-->
					</div><!-- .post-entries -->
				</aside><!-- .post-author-box -->
				<?php } ?>

				<?php woo_subscribe_connect(); ?>

	        <nav id="post-entries" class="fix">
	            <div class="nav-prev fl"><?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title' ); ?></div>
	            <div class="nav-next fr"><?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>' ); ?></div>
	        </nav><!-- #post-entries -->
            <?php
            	// Determine wether or not to display comments here, based on "Theme Options".
            	if ( isset( $woo_options['woo_comments'] ) && in_array( $woo_options['woo_comments'], array( 'post', 'both' ) ) ) {
            		comments_template();
            	}

				} // End WHILE Loop
			} else {
		?>
			<article <?php post_class(); ?>>
            	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
			</article><!-- .post -->             
       	<?php } ?>  
		<div class="fix"></div>
		</section><!-- #main -->
		<?php woo_main_after(); ?>

        <?php get_sidebar(); ?>

    </div><!-- #content -->
		
<?php get_footer(); ?>