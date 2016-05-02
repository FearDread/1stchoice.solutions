<?php get_header(); ?>
<?php global $woo_options; ?>

    <div id="content" class="col-full">
		<div id="main" class="col-left">

			<!-- SLIDER POSTS -->
			<?php if ( isset( $woo_options['woo_slider'] ) && $woo_options['woo_slider'] == 'true' ) { get_template_part( 'includes/slider' ); } else if ( get_option( 'woo_exclude' ) ) { update_option( "woo_exclude", "" ); } ?>

			<!-- FEATURED POSTS -->
			<?php if ( isset( $woo_options['woo_featured'] ) && $woo_options['woo_featured'] == 'true' ) { get_template_part( 'includes/featured' ); } ?>

			<!-- LATEST NEWS -->
			<?php if ( isset( $woo_options['woo_latest'] ) && $woo_options['woo_latest'] == 'true' ) : ?>
			<div id="latest">
				<h3><?php _e( 'Latest News', 'woothemes' ); ?></h3>
<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
if ( $woo_options['woo_slider_exclude'] == "true" ) $exclude = get_option( 'woo_exclude' ); else $exclude = '';
$args = array( 'post__not_in' => $exclude, 'cat' => '-'.$GLOBALS['video_id'], 'paged'=> $paged, 'posts_per_page' => $woo_options['woo_latest_entries'] );
?>
				<?php query_posts( $args ); ?>
		        <?php if ( have_posts() ) : $count = 0; ?>
		        <?php while ( have_posts() ) : the_post(); $count++; ?>

	            <div class="post">
					<div class="block">

		                <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		                <span class="date"><?php the_time( get_option( 'date_format' ) ); ?></span>
		                <?php woo_image( 'key=image&width=112&height=82&class=img' ); ?>

		                <div class="entry">
							<p><?php echo woo_excerpt( get_the_excerpt(), '100' ); ?></p>
		                </div>

		                <span class="comment"><?php comments_popup_link( __( '0', 'woothemes' ), __( '1', 'woothemes' ), __( '%', 'woothemes' ), '', '' ); ?></span>
						<span class="ico-more"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Permanent Link to', 'woothemes' ) ) . ' '; the_title_attribute(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-more.png" width="21" height="20" alt="Read more" /></a></span>
	                </div>
	            </div><!-- /.post -->
	            <?php if ( $count == 4 ) { $count=0; echo '<div class="fix"></div>'; } ?>
		        <?php endwhile; else: ?>

	            <div class="post">
	                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
	            </div><!-- /.post -->

		        <?php endif; ?>

				<div class="clear"></div>

			</div><!-- /#latest -->
			<?php endif; ?>

			<!-- POPULAR POSTS -->
			<?php if ( isset( $woo_options['woo_popular'] ) && $woo_options['woo_popular'] == 'true' ) { get_template_part( 'includes/popular' ); } ?>

		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->

<?php get_footer(); ?>