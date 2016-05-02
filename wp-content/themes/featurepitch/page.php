<?php get_header(); ?>

	<div id="main_content" class="outer">
	
		<div class="inner">
		
			<div id="content">
				
				<?php if ( get_option( 'woo_breadcrumbs' ) == 'true') { yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>'); } ?>
				
				<div id="posts">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<div class="post">

						<?php if (  get_post_meta($post->ID, 'embed', true) <> "" ) { ?>
							<div class="video">
								<?php echo woo_get_embed('embed','500','285'); ?> 
							</div>
						<?php } ?>							
						
						<div class="entry">

							<?php the_content(); ?>
						
						</div><!-- /.entry -->
					
					</div><!-- /.post -->

					<?php endwhile; ?>
			
					<div class="clear"></div>
					
					<div class="pagenavi">
						<?php if (function_exists('wp_pagenavi')) { ?><?php wp_pagenavi(); ?><?php } ?>
					</div>
			
				<?php endif; ?>					
				
				</div><!-- /#posts -->
					
			</div><!-- /#content -->
			
			<?php get_sidebar(); ?>
			
			<div class="clear"></div>
			
		</div><!-- /.inner -->
	
	</div><!-- /#main_content .outer -->
			
<?php get_footer(); ?>