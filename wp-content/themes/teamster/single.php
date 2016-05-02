<?php get_header(); ?>
<?php global $woo_options; ?>
       
    <div id="content" class="col-full">
		<div id="main" class="col-left">
		           
		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<div id="breadcrumbs">
				<?php woo_breadcrumbs(); ?>
			</div><!--/#breadcrumbs -->
		<?php } ?>  

        <?php if (have_posts()) : $count = 0; ?>
        <?php while (have_posts()) : the_post(); $count++; ?>
        
			<div <?php post_class(); ?>>

				<div class="post-header">
				
					<div class="profile-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), '48' ); ?></div>
				
	                <h1 class="title"><?php the_title(); ?></h1>
	                                
	                <?php woo_post_meta(); ?>
                
                </div><!-- .post-header -->
                                
                <div class="entry">
					            
					<?php echo woo_embed( 'width=610' ); ?>
					<?php if ( $woo_options[ 'woo_thumb_single' ] == "true" && !woo_embed( '')) woo_image( 'width='.$woo_options[ 'woo_single_w' ].'&height='.$woo_options[ 'woo_single_h' ].'&class=thumbnail '.$woo_options[ 'woo_thumb_single_align' ]); ?>               
                
                	<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>
					
				</div><!-- .entry -->
									
				<?php the_tags( '<p class="tags">'.__( 'Tags: ', 'woothemes' ), ', ', '</p>' ); ?>
				
				<?php if (function_exists('sharethis_button')) { ?><p class="share"><?php _e( 'Share', 'woothemes' ) ?>: <?php sharethis_button(); ?></p><?php } ?>
                                
            </div><!-- .post -->

			<?php woo_subscribe_connect(); ?>

	        <div id="post-entries">
	            <div class="nav-prev fl"><?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title' ) ?></div>
	            <div class="nav-next fr"><?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>' ) ?></div>
	            <div class="fix"></div>
	        </div><!-- #post-entries -->
            
            <?php $comm = $woo_options[ 'woo_comments' ]; if ( ($comm == "post" || $comm == "both") ) : ?>
                <?php comments_template( '', true); ?>
            <?php endif; ?>
                                                
		<?php endwhile; else: ?>
			<div <?php post_class(); ?>>
            	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ) ?></p>
			</div><!-- .post -->             
       	<?php endif; ?>  
        
		</div><!-- #main -->

        <?php get_sidebar(); ?>

    </div><!-- #content -->
		
<?php get_footer(); ?>