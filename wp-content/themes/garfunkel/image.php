<?php get_header(); ?>

<div class="wrapper">

	<div class="wrapper-inner section-inner thin">

		<div class="content">
												        
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
														
					<div class="featured-media">
					
						<?php $imageArray = wp_get_attachment_image_src($post->ID, 'full', false); ?>
					
						<a href="<?php echo esc_url( $imageArray[0] ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
							<?php echo wp_get_attachment_image( $post->ID, 'post-image' ); ?></a>
					
					</div> <!-- /featured-media -->
					
					<div class="post-inner">
						
						<div class="post-header">
							
							<p class="post-date">
								<?php the_time( get_option( 'date_format' ) ); ?>
								<span class="sep">/</span>
								<?php echo $imageArray[1] // 1 is the width ?> <span style="text-transform:lowercase;">x</span> <?php echo $imageArray[2] . ' px'; // 2 is the height ?>
							</p>
						
							<h2 class="post-title"><?php echo basename(get_attached_file( $post->ID )); ?></h2>
						
						</div> <!-- /post-header -->
																		
						<div class="post-content">
						
							<p><?php the_excerpt(); ?></p>
										
						</div> <!-- /post-content -->
					
					</div>
					
					<div class="comments-page-container">
					
						<div class="comments-page-container-inner">
					
							<?php comments_template( '', true ); ?>
						
						</div>
					
					</div>
																                        
			   	<?php endwhile; else: ?>
			
					<p><?php _e("We couldn't find any posts that matched your query. Please try again.", "garfunkel"); ?></p>
				
				<?php endif; ?>
				
				<?php get_sidebar(); ?>
					
			</div> <!-- /post -->
				
		</div> <!-- /content -->
		
		<div class="clear"></div>
	
	</div> <!-- /section-inner -->

</div> <!-- /wrapper -->
		
<?php get_footer(); ?>