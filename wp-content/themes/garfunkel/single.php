<?php 

	get_header(); 
	
	$format = get_post_format();
	
?>

<div class="wrapper">
										
	<div class="wrapper-inner section-inner thin">
	
		<div class="content">
												        
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ($format == 'video') : ?> 
					
						<div class="featured-media">
			
							<?php
								
								// Fetch post content
								$content = get_post_field( 'post_content', get_the_ID() );
								
								// Get content parts
								$content_parts = get_extended( $content );
								
								// oEmbed part before <!--more--> tag
								$embed_code = wp_oembed_get($content_parts['main']); 
								
								echo $embed_code;
							
							
							?>
						
						</div> <!-- /featured-media -->
					
					<?php elseif ($format == 'quote') : ?> 
											
						<div class="post-quote">
							
							<?php
								
								// Fetch post content
								$content = get_post_field( 'post_content', get_the_ID() );
								
								// Get content parts
								$content_parts = get_extended( $content );
								
								// Output part before <!--more--> tag
								echo $content_parts['main'];
							
							?>
						
						</div> <!-- /post-quote -->
						
					<?php elseif ($format == 'link') : ?> 
					
						<div class="post-link">
			
							<?php
								
								// Fetch post content
								$content = get_post_field( 'post_content', get_the_ID() );
								
								// Get content parts
								$content_parts = get_extended( $content );
								
								// Output part before <!--more--> tag
								echo $content_parts['main'];
							
							?>
						
						</div> <!-- /post-link -->
						
					<?php elseif ($format == 'gallery') : ?> 
					
						<div class="featured-media">

							<?php garfunkel_flexslider('post-image'); ?>
											
						</div> <!-- /featured-media -->
				
					<?php elseif ( has_post_thumbnail() ) : ?>
					
						<div class="featured-media">
						
							<?php the_post_thumbnail('post-image'); ?>
							
							<?php if ( !empty(get_post(get_post_thumbnail_id())->post_excerpt) ) : ?>
											
								<div class="media-caption-container">
								
									<p class="media-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>
									
								</div>
								
							<?php endif; ?>
									
						</div> <!-- /featured-media -->
					
					<?php endif; ?>
					
					<div class="post-inner">
					
						<div class="post-header">
						
							<p class="post-date"><?php the_time(get_option('date_format')); ?><?php edit_post_link(__('Edit','garfunkel'), '<span class="sep">/</span>'); ?></p>
							
						    <h1 class="post-title"><?php the_title(); ?></h1>
						    
						</div> <!-- /post-header -->
														                                    	    
						<div class="post-content">
							    		            			            	                                                                                            
							<?php 
								if ($format == 'link' || $format == 'quote' || $format == 'video') { 
									$content = $content_parts['extended'];
									$content = apply_filters('the_content', $content);
									echo $content;
								} else {
									the_content();
								}
										            			            	                                                                                            
								wp_link_pages(); 
							?>
							
							<div class="clear"></div>
										        
						</div> <!-- /post-content -->
						
						<?php 
					    	$args = array(
								'before'           => '<div class="clear"></div><p class="page-links"><span class="title">' . __( 'Pages:','garfunkel' ) . '</span>',
								'after'            => '</p>',
								'link_before'      => '<span>',
								'link_after'       => '</span>',
								'separator'        => '',
								'pagelink'         => '%',
								'echo'             => 1
							);
				    	
				    		wp_link_pages($args); 
						?>
						
					</div> <!-- /post-inner -->
					            					
					<div class="post-meta bottom">
					
						<div class="tab-selector">
							
							<ul>
			
								<li>
									<a class="active tab-comments-toggle" href="#">
										<div class="genericon genericon-comment"></div>
										<span><?php _e('Comments','garfunkel'); ?></span>
									</a>
								</li>
								<li>
									<a class="tab-post-meta-toggle" href="#">
										<div class="genericon genericon-summary"></div>
										<span><?php _e('Post info','garfunkel'); ?></span>
									</a>
								</li>
								<li>
									<a class="tab-author-meta-toggle" href="#">
										<div class="genericon genericon-user"></div>
										<span><?php _e('Author info','garfunkel'); ?></span>
									</a>
								</li>
								
								<div class="clear"></div>
								
							</ul>
							
						</div>
						
						<div class="post-meta-tabs">
						
							<div class="post-meta-tabs-inner">
								
								<div class="tab-post-meta tab">
								
									<ul class="post-info-items fright">
										<li>
											<div class="genericon genericon-user"></div>
											<?php the_author_posts_link(); ?>
										</li>
										<li>
											<div class="genericon genericon-time"></div>
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<?php the_date( get_option('date-format') ); ?>
											</a>
										</li>
										<li>
											<div class="genericon genericon-category"></div>
											<?php the_category(', '); ?>
										</li>
										<?php if ( has_tag() ) : ?>
											<li>
												<div class="genericon genericon-tag"></div>
												<?php the_tags('', ', '); ?>
											</li>
										<?php endif; ?>
									</ul>
								
									<div class="post-nav fleft">
									
										<?php
										$prev_post = get_previous_post();
										if (!empty( $prev_post )): ?>
										
											<a class="post-nav-prev" title="<?php _e('Previous post:', 'garfunkel'); echo ' ' . esc_attr( get_the_title($prev_post) ); ?>" href="<?php echo get_permalink( $prev_post->ID ); ?>">
												<p><?php _e('Previous post', 'garfunkel'); ?></p>
												<h4><?php echo get_the_title($prev_post); ?></h4>
											</a>
									
										<?php endif; ?>
										
										<?php
										$next_post = get_next_post();
										if (!empty( $next_post )): ?>
											
											<a class="post-nav-next" title="<?php _e('Next post:', 'garfunkel'); echo ' ' . esc_attr( get_the_title($next_post) ); ?>" href="<?php echo get_permalink( $next_post->ID ); ?>">
												<p><?php _e('Next post', 'garfunkel'); ?></p>
												<h4><?php echo get_the_title($next_post); ?></h4>
											</a>
									
										<?php endif; ?>
									
									</div>
									
									<div class="clear"></div>
								
								</div> <!-- /tab-post-meta -->
								
								<div class="tab-author-meta tab">
								
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="author-avatar"><?php echo get_avatar( get_the_author_meta( 'email' ), '256' ); ?></a>
								
									<div class="author-meta-inner">
									
										<h3 class="author-name"><?php the_author_posts_link(); ?></h3>
										
										<p class="author-position">
				
											<?php
					
												global $post;
												if ( user_can( $post->post_author, 'administrator' ) ) {
													_e('Administrator','garfunkel');
												} elseif ( user_can( $post->post_author, 'editor' ) ) {
													_e('Editor','garfunkel');
												} elseif ( user_can( $post->post_author, 'author' ) ) {
													_e('Author','garfunkel');
												} elseif ( user_can( $post->post_author, 'contributor' ) ) {
													_e('Contributor','garfunkel');
												} elseif ( user_can( $post->post_author, 'subscriber' ) ) {
													_e('Subscriber','garfunkel');
												} else {
													_e('Guest','garfunkel');
												}
											?>
											
										</p>
										
										<?php $author_meta_description = get_the_author_meta('description'); ?>
										
										<?php if ( ! empty( $author_meta_description ) ) : ?>
											<p class="author-description">
												<?php the_author_meta('description'); ?>
											</p>
										<?php endif; ?>
									
									</div> <!-- /author-meta-inner -->
																		
									<div class="author-content">
									
										<div class="one-half author-posts">
									
											<h4 class="content-by"><?php _e('Posts by','garfunkel'); ?> <?php the_author_meta('display_name'); ?></h4>
										
											<ul>
										
												<?php
		
												$args = array( 
													'posts_per_page' => 5, 
													'post__not_in'=> array($post->ID),
													'author' => get_the_author_meta('id'),
												);
												
												$myposts = get_posts( $args );
												
												foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
													<li <?php if ( has_post_thumbnail() ) { echo 'class="has-thumb"'; } ?>>
														<a href="<?php the_permalink(); ?>">
														
															<div class="post-icon">
																<?php 
																	if ( has_post_thumbnail() ) {
																		the_post_thumbnail('thumbnail');
																	} else {
																		$post_format = get_post_format();
																		if ( empty($post_format) ) { $post_format = 'standard'; }
																		echo '<div class="genericon genericon-' . $post_format . '"></div>';
																	}
																?>
															</div>
															
															<h5 class="title"><?php the_title(); ?></h5>
															
															<p class="meta"><?php the_time(get_option('date_format')); ?></p>
															
															<div class="clear"></div>
															
														</a>
													</li>
												<?php endforeach; 
												
												wp_reset_postdata();?>
												
											</ul>
										
										</div> <!-- /author-posts -->
										
										<div class="one-half author-comments">
										
											<h4 class="content-by"><?php _e('Comments by','garfunkel'); ?> <?php the_author_meta('display_name'); ?></h4>
											
											<ul>
		
												<?php 
													$comments = get_comments('user_id=' . get_the_author_meta('id') . '&number=5');
													foreach($comments as $comment) : ?>
													
														<?php 
															$comment_excerpt = ($comment->comment_content); 
																		
															if (strlen($comment_excerpt) > 60) { 
																$comment_excerpt = substr($comment_excerpt, 0, 60); 
																$comment_excerpt = substr($comment_excerpt,0,strrpos($comment_excerpt," ")); 
																$etc = " ...";  
																$comment_excerpt = $comment_excerpt.$etc; 
															}
														?>
													
														<li>
															<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title='<?php _e('Posted on','garfunkel'); ?> <?php comment_date(get_option('date_format'), $comment->comment_ID); ?> <?php _e('to','garfunkel'); ?> <?php echo get_the_title($comment->comment_post_ID); ?>'>
																<div class="post-icon">
																	<?php if ( '' != get_the_post_thumbnail($comment->comment_post_ID) ) : ?>
																		<?php echo get_the_post_thumbnail($comment->comment_post_ID, 'thumbnail'); ?>
																	<?php else : ?>
																		<div class="genericon genericon-comment"></div>
																	<?php endif; ?>
																</div>
																<h5 class="title"><?php echo get_the_title($comment->comment_post_ID); ?></h5>
																<p class="excerpt"><?php echo $comment_excerpt; ?></p>
															</a>
														</li>
														
													<?php endforeach;
													
													wp_reset_postdata();
												?>
											
											</ul>
										
										</div> <!-- /author-comments -->
										
										<div class="clear"></div>
										
									</div> <!-- /author-content -->
								
								</div> <!-- /tab-author-meta -->
								
								<div class="tab-comments tab">
								
									<?php comments_template( '', true ); ?>
								
								</div> <!-- /tab-comments -->
							
							</div> <!-- /post-meta-tabs-inner -->
						
						</div> <!-- /post-meta-tabs -->
							
					</div> <!-- /post-meta.bottom -->
					
					<div class="post-nav-fixed">
								
						<?php
						$prev_post = get_previous_post();
						if (!empty( $prev_post )): ?>
						
							<a class="post-nav-prev" title="<?php _e('Previous post', 'garfunkel'); echo ': ' . esc_attr( get_the_title($prev_post) ); ?>" href="<?php echo get_permalink( $prev_post->ID ); ?>">
								<span class="hidden"><?php _e('Previous post', 'garfunkel'); ?></span>
								<span class="arrow">&laquo;</span>
							</a>
					
						<?php endif; ?>
						
						<?php
						$next_post = get_next_post();
						if (!empty( $next_post )): ?>
							
							<a class="post-nav-next" title="<?php _e('Next post', 'garfunkel'); echo ': ' . esc_attr( get_the_title($next_post) ); ?>" href="<?php echo get_permalink( $next_post->ID ); ?>">
								<span class="hidden"><?php _e('Next post', 'garfunkel'); ?></span>
								<span class="arrow">&raquo;</span>
							</a>
					
						<?php endif; ?>
															
						<div class="clear"></div>
					
					</div> <!-- /post-nav -->
												                        
			   	<?php endwhile; else: ?>
			
					<p><?php _e("We couldn't find any posts that matched your query. Please try again.", "garfunkel"); ?></p>
				
				<?php endif; ?>    
				
				<?php get_sidebar(); ?>
						
			</div> <!-- /post -->
		
		</div> <!-- /content -->
		
		<div class="clear"></div>
		
	</div> <!-- /wrapper-inner -->

</div> <!-- /wrapper -->
		
<?php get_footer(); ?>