<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>
					<div id="content" class="clearfix">
					
						<div id="left-col">
							
							<?php if (have_posts()) : ?>

								<?php while (have_posts()) : the_post(); ?>
							
									<div id="post-<?php the_ID(); ?>" class="post">
									
										<div class="post-content clearfix">
																			
											<h3><?php _e('Links:',woothemes); ?></h3>
											<ul>
												<?php wp_list_bookmarks('categorize=0&title_li='); ?>
											</ul>
																																	
										</div><!-- End post-content -->
										
									</div><!-- End post -->
																		
								<?php endwhile; ?>
								
							<?php endif; ?>
							
						</div><!-- End left-col -->
						
						<?php get_sidebar(); ?><!-- End right-col -->
						
					</div><!-- End content -->
<?php get_footer(); ?>