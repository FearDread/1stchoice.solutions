<?php get_header(); ?>
<?php global $woo_options; ?>

    <div id="content" class="col-full">
		<div id="main" class="col-left">

			<?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb( '<div id="breadcrumb"><p>', '</p></div>' ); } ?>
			<div id="striped">
			<?php if ( have_posts() ) : $count = 0; ?>
	            <?php if ( is_category() ) { ?>
	        	<span class="archive_header"><span class="fl cat"><?php _e( 'Archive', 'woothemes' ); ?> | <?php echo single_cat_title(); ?></span> <span class="fr catrss"><?php $cat_obj = $wp_query->get_queried_object(); $cat_id = $cat_obj->cat_ID; echo '<a href="'; get_category_rss_link( true, $cat, '' ); echo '">'; _e( 'RSS feed for this section', 'woothemes' ); echo '</a>'; ?></span></span>

	            <?php } elseif ( is_day() ) { ?>
	            <span class="archive_header"><?php _e( 'Archive', 'woothemes' ); ?> | <?php the_time( get_option( 'date_format' ) ); ?></span>

	            <?php } elseif ( is_month() ) { ?>
	            <span class="archive_header"><?php _e( 'Archive', 'woothemes' ); ?> | <?php the_time( 'F, Y' ); ?></span>

	            <?php } elseif ( is_year() ) { ?>
	            <span class="archive_header"><?php _e( 'Archive', 'woothemes' ); ?> | <?php the_time( 'Y' ); ?></span>

	            <?php } elseif ( is_author() ) { ?>
	            <span class="archive_header"><?php _e( 'Archive by Author', 'woothemes' ); ?></span>

	            <?php } elseif ( is_tag() ) { ?>
	            <span class="archive_header"><?php _e( 'Tag Archives:', 'woothemes' ); ?> <?php echo single_tag_title( '', true ); ?></span>

	            <?php } ?>
	            <div class="fix"></div>

				<div id="plate">
		        <?php while ( have_posts() ) : the_post(); $count++; ?>

		            <!-- Post Starts -->
		            <div class="post arc">

		                <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

		                <?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] != 'content' ) { woo_get_image( 'image', '169', '123', 'fr' ); } ?>
		                <?php woo_post_meta(); ?>

		                <div class="entry">
		                    <?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) { the_content( __( 'Read More...', 'woothemes' ) ); } else { the_excerpt(); } ?>
		                </div><!-- /.entry -->

		                <div class="post-more">
		<span class="comment"><?php comments_popup_link( __( '0 Comments', 'woothemes' ), __( '1 Comment', 'woothemes' ), __( '% Comments', 'woothemes' ), '', '' ); ?></span>
		                	<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'excerpt' ) { ?>
				<span class="more"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Permanent Link to', 'woothemes' ) ) . ' '; the_title_attribute(); ?>"><?php _e( 'Read more', 'woothemes' ); ?></a> &raquo;</span>
		                    <?php } ?>
		                </div>
						<div class="clear"></div>

		            </div><!-- /.post -->

		        <?php endwhile; ?>
		        </div><!-- /.plate -->

	        <?php else: ?>

				<div id="plate">
		            <div class="post">
		                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
		            </div><!-- /.post -->
		        </div><!-- /.plate -->

	        <?php endif; ?>

				<?php woo_pagenav(); ?>

			</div><!-- /#striped -->

			<!-- FEATURED POSTS -->
			<?php if ( isset( $woo_options['woo_featured_archive'] ) && $woo_options['woo_featured_archive'] == 'true' ) { get_template_part( 'includes/featured' ); } ?>

		</div><!-- /#main -->

	    <?php get_sidebar(); ?>

    </div><!-- /#content -->

<?php get_footer(); ?>