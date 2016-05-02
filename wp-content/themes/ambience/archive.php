<?php get_header(); ?>					
					<div id="content" class="clearfix">
					
						<div id="left-col">
							
							<?php if (have_posts()) : ?>
								<?php
									if(isset($_GET['author_name'])) :
										$curauth = get_userdatabylogin(get_the_author_login());
									else :
										$curauth = get_userdata(intval($author));
									endif;
								?>
								<div class="twitter clearfix">
									<p class="color-blue">
										<?php $post = $posts[0]; ?>
										<?php if (is_category()) { ?>
											<h4 class="font-georgia"><?php _e('Archive for the',woothemes); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('Category',woothemes); ?></h4>
										<?php } elseif( is_tag() ) { ?>
											<h4 class="font-georgia"><?php _e('Posts Tagged',woothemes); ?> &#8216;<?php single_tag_title(); ?>&#8217;</h4>
										<?php } elseif (is_day()) { ?>
											<h4 class="font-georgia"><?php _e('Archive for',woothemes); ?> <?php the_time('F jS, Y'); ?></h4>
										<?php } elseif (is_month()) { ?>
											<h4 class="font-georgia"><?php _e('Archive for',woothemes); ?> <?php the_time('F, Y'); ?></h4>
										<?php } elseif (is_year()) { ?>
											<h4 class="font-georgia"><?php _e('Archive for',woothemes); ?> <?php the_time('Y'); ?></h4>
										<?php } elseif (is_author()) { ?>
											<h4 class="font-georgia"><?php _e('Author Archive:',woothemes); ?> <?php echo $curauth->display_name; ?></h4>
										<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
											<h4 class="font-georgia"><?php _e('Blog Archives',woothemes); ?></h4>
										<?php } ?>
									</p>
								</div><!-- End Title -->
							
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
								
							<?php endif; ?>
							
						</div><!-- End left-col -->
						
						<?php get_sidebar(); ?><!-- End right-col -->
						
					</div><!-- End content -->
<?php get_footer(); ?>