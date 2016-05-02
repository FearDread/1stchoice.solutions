<?php get_header(); ?>
					<div id="content" class="clearfix">
					
						<div id="left-col">
							
							<?php if (have_posts()) : ?>

								<?php while (have_posts()) : the_post(); ?>
							
									<div id="post-<?php the_ID(); ?>" class="post">
										<div class="post-meta">
																				
											<span><?php _e('Written by',woothemes); ?> <?php the_author_posts_link(); ?> - <?php the_time('F jS, Y') ?></span>
											
										</div><!-- End post-meta -->
										
										<div class="post-content clearfix">
											<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',woothemes); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
											
											<?php the_content(''); ?>
																						
										</div><!-- End post-content -->
										
									</div><!-- End post -->
																		
								<?php endwhile; ?>
								
							<?php endif; ?>
							
						</div><!-- End left-col -->
						
						<?php get_sidebar(); ?><!-- End right-col -->
						
					</div><!-- End content -->
<?php get_footer(); ?>