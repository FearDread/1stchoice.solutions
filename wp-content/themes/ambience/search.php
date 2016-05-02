<?php get_header(); ?>	
					<?php
						$title = get_the_title();
						$keys = explode( " ", $s );
						$title 	= preg_replace( '/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title);
					?>
				
					<div id="content" class="clearfix">
					
						<div id="left-col">
							
							<?php if (have_posts()) : ?>
							
								<div class="twitter clearfix">
									<p class="color-blue">
										<h4 class="font-georgia"><?php _e('Search Results for',woothemes); ?> &quot;<em><strong><?php the_search_query() ?></strong></em>&quot;</h4>
									</p>
								</div><!-- End Search Title -->
							
								<?php while (have_posts()) : the_post(); ?>
							
									<div id="post-<?php the_ID(); ?>" class="post">
										<div class="post-meta">
											
											<?php // To show only 1 Category
												$category = get_the_category();
											?>
										
											<h4 class="post-category size-large">
												<a href="<?php echo get_category_link( $category[0]->cat_ID ); ?>"><?php echo $category[0]->cat_name; ?></a>
											</h4>
											
											<span><?php _e('Posted by',woothemes); ?> <?php the_author_posts_link(); ?> - <?php the_time('F jS, Y') ?> <?php comments_popup_link( __('Comments 0',woothemes), __('Comments 1',woothemes), __('Comments %',woothemes)); ?>
										
										</div><!-- End post-meta (post-<?php the_ID(); ?>) -->
										
										<div class="post-content clearfix">
											<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',woothemes); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
											
											<?php the_excerpt(''); ?>
											
											<a href="<?php the_permalink() ?>#more-post-<?php the_ID(); ?>" class="continue-reading"><?php _e('Continue Reading',woothemes); ?>...</a>
											
										</div><!-- End post-content (post-<?php the_ID(); ?>) -->
										
									</div><!-- End post-<?php the_ID(); ?> -->
									
								<?php endwhile; ?>
								
									<div class="single-meta clearfix">
										<div class="left"><h4 class="single-info font-georgia color-white size"><?php next_posts_link(__('&laquo; Older Entries',woothemes)) ?></h4></div>
										<div class="right"><h4 class="single-info font-georgia color-white"><?php previous_posts_link(__('Newer Entries &raquo;',woothemes)) ?></h4></div>
									</div>
									
							<?php else : ?>
							
								<div class="post">
									<div class="post-meta">
										<h4 class="single-info"><?php _e('No Posts Found',woothemes); ?></h4>
									</div>
									
									<p><?php _e('No results were found for',woothemes); ?> &quot;<strong><?php the_search_query() ?></strong>&quot;. <?php _e('Perhaps you would like to try a new search?',woothemes); ?></p>
																		
									<p><?php include( TEMPLATEPATH . '/searchform.php'); ?></p>
									
								</div><!-- End post -->			
								
							<?php endif; ?>
							
						</div><!-- End left-col -->
						
						<?php get_sidebar(); ?><!-- End right-col -->
						
					</div><!-- End content -->
<?php get_footer(); ?>