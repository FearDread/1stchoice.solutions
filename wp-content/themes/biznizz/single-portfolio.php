<?php get_header(); ?>
<?php global $woo_options; ?>
       
    <div id="content" class="col-full">
		<div id="main" class="col-left">
		           
		<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>'); } ?>

        <?php if (have_posts()) : $count = 0; ?>
        <?php while (have_posts()) : the_post(); $count++; ?>
        
			<div <?php post_class(); ?>>

                <h1 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                                
                <?php woo_post_meta(); ?>
                
                <div class="entry">
                
               		<?php 
                		echo woo_embed('width=620');
                		if ( !woo_embed('width=620') )
							woo_image('key=portfolio-image&width=610&class=portfolio-img'); 
						?>
                
                	<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>
				</div>
									
				<?php the_tags('<p class="tags">'.__('Tags: ', 'woothemes'), ', ', '</p>'); ?>
				<?php if ( $woo_options['woo_post_author'] == "true" ) { ?>
				<div id="post-author">
					<div class="profile-image"><?php echo get_avatar( get_the_author_id(), '70' ); ?></div>
					<div class="profile-content">
						<h4><?php printf( esc_attr__( 'About %s', 'woothemes' ), get_the_author() ); ?></h4>
						<?php the_author_meta( 'description' ); ?>
						<div class="profile-link">
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'woothemes' ), get_the_author() ); ?>
							</a>
						</div><!-- #profile-link	-->
					</div><!-- .post-entries -->
					<div class="fix"></div>
				</div><!-- #post-author -->
				<?php } ?>
            </div><!-- .post -->

	        <div id="post-entries">
	            <div class="nav-prev fl"><?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title' ) ?></div>
	            <div class="nav-next fr"><?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>' ) ?></div>
	            <div class="fix"></div>
	        </div><!-- #post-entries -->
            
            <?php $comm = $woo_options['woo_comments']; if ( ($comm == "post" || $comm == "both") ) : ?>
                <?php comments_template('', true); ?>
            <?php endif; ?>
                                                
		<?php endwhile; else: ?>
			<div <?php post_class(); ?>>
            	<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
			</div><!-- .post -->             
       	<?php endif; ?>  
        
		</div><!-- #main -->

        <?php get_sidebar(); ?>

    </div><!-- #content -->
		
<?php get_footer(); ?>