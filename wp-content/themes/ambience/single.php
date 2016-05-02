<?php get_header(); ?>
					<div id="content" class="clearfix">
					
						<div id="left-col">
							
							<?php if (have_posts()) : ?>

								<?php while (have_posts()) : the_post(); ?>
							
									<div id="post-<?php the_ID(); ?>" class="post">
										<div class="post-meta">
											
											<?php // To show only 1 Category
												$category = get_the_category();
											?>
										
											<h4 class="post-category">
												<a href="<?php echo get_category_link( $category[0]->cat_ID ); ?>"><?php echo $category[0]->cat_name; ?></a>
											</h4>
											
											<span><?php _e('Posted by',woothemes); ?> <?php the_author_posts_link(); ?> - <?php the_time('F j, Y'); ?> <a href="#comments"><?php comments_number( __('Comments 0',woothemes), __('Comments 1',woothemes), __('Comments %',woothemes)); ?></a>
										
										</div><!-- End post-meta -->
										
										<div class="post-content clearfix">
											<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',woothemes); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
																						
											<?php the_content(''); ?>
											
											<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
																						
										</div><!-- End post-content -->
										
									</div><!-- End post -->
									
									<?php comments_template(); ?>
									
								<?php endwhile; ?>
								
							<?php endif; ?>
							
						</div><!-- End left-col -->
						
						<?php get_sidebar(); ?><!-- End right-col -->
						
					</div><!-- End content -->
<?php get_footer(); ?>