
<?php get_header(); ?>
<?php global $woo_options; ?>

    <div id="content" class="page col-full">
	    
	    <div id="main" class="col-full">
    
        <?php if (have_posts()) : $count = 0; ?>
        <?php while (have_posts()) : the_post(); $count++; ?>
        
			<div <?php post_class(); ?>>

           <?php $portfolio_gallery = $woo_options[ 'woo_portfolio_gallery' ] == 'true'; ?>
           
           <?php echo woo_embed( 'width=540' ); ?>
           
            <?php if ( $portfolio_gallery && !woo_embed('')) { ?>
            	<div id="gallery">
				<?php
					$gallery = do_shortcode('[gallery size="thumbnail" columns="4"]');
					
					if ( $gallery ) {
					
						get_template_part('includes/gallery');
						
					} else {
						woo_image('key=portfolio-image&width=540&class=portfolio-img');  
					}
				?>
				</div>
				
				<?php } elseif ( !woo_embed('')) { ?><!-- End If portfolio_gallery -->
				
				<div id="gallery">
				<div class="entry">
                	<?php woo_image('key=portfolio-image&width=540&class=portfolio-img'); ?>
				</div>
				</div>
				<?php } ?>

				<div id="portfolio-content">
					<h2><?php the_title(); ?></h2>
					
					<?php the_tags( '<p class="tags">'.__( '', 'woothemes' ), ' ', '</p>' ); ?>
					
                	<div class="entry">	
                	<?php the_content(); ?>
                	 <?php if ( isset($url) ) { ?><a class="button" href="<?php echo $url; ?>"><?php _e( 'Visit Website', 'woothemes' ); ?></a><?php } ?>
               	</div><!-- /.entry -->
               	
               	</div><!-- /#portfolio-content -->
				<div class="fix"></div>
				<?php edit_post_link( __('{ Edit }', 'woothemes'), '<span class="small">', '</span>' ); ?>
            </div><!-- /.post -->
                                                                
		<?php endwhile; else: ?>
			<div class="post">
            	<p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
            </div><!-- /.post -->
        <?php endif; ?>  
        
		</div><!-- #main -->
	
    </div><!-- #content -->
		
<?php get_footer(); ?>