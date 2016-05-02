<?php
/*
Template Name: Archive template
*/
?>

<?php get_header(); ?>

<div class="wrapper">
										
	<div class="wrapper-inner section-inner thin">
	
		<div class="content">
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
				<div class="post">
				
					<?php if ( has_post_thumbnail() ) : ?>
						
						<div class="featured-media">
						
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
							
								<?php the_post_thumbnail('post-image'); ?>
								
								<?php if ( !empty(get_post(get_post_thumbnail_id())->post_excerpt) ) : ?>
												
									<div class="media-caption-container">
									
										<p class="media-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>
										
									</div>
									
								<?php endif; ?>
								
							</a>
									
						</div> <!-- /featured-media -->
							
					<?php endif; ?>
					
					<div class="post-inner">
					
						<div class="post-header">
													
						    <h2 class="post-title"><?php the_title(); ?></h2>
						    				    
					    </div> <!-- /post-header -->
					   				        			        		                
						<div class="post-content">
									                                        
							<?php the_content(); ?>
							
							<div class="clear"></div>
							
							<?php edit_post_link(__('Edit','garfunkel') . ' &rarr;'); ?>
							
							<div class="archive-box">
					
								<div class="archive-col">
													
									<h3><?php _e('All Posts', 'garfunkel') ?></h3>
									            
						            <ul class="all-posts">
							            <?php $archive = get_posts('numberposts=-1');
							            foreach($archive as $post) : ?>
							                <li>
							                	<a href="<?php the_permalink(); ?>">
							                		<?php the_title();?> 
							                		<span>(<?php the_time(get_option('date_format')); ?>)</span>
							                	</a>
							                </li>
							            <?php endforeach; ?>
						            </ul>
						            
						            <h3><?php _e('Archives by Categories', 'garfunkel') ?></h3>
						            
						            <ul>
						                <?php wp_list_categories( 'title_li=', 'garfunkel' ); ?>
						            </ul>
						            
						            <h3><?php _e('Archives by Tags', 'garfunkel') ?></h3>
						            
						            <ul>
						                <?php $tags = get_tags();
						                
						                if ($tags) {
						                    foreach ($tags as $tag) {
						                 	   echo '<li><a href="' . get_tag_link( $tag->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'garfunkel' ), $tag->name ) . '" ' . '>' . $tag->name.'</a></li> ';
						                    }
						                }
						                
						                wp_reset_query();?>
						            </ul>
					            
					            </div> <!-- /archive-col -->
					            
					            <div class="archive-col">
					            
					            	<h3><?php _e('Contributors', 'garfunkel') ?></h3>
					            	
					            	<ul>
					            		<?php wp_list_authors(); ?> 
					            	</ul>
					            	
					            	<h3><?php _e('Archives by Year', 'garfunkel') ?></h3>
					            	
					            	<ul>
					            	    <?php wp_get_archives('type=yearly'); ?>
					            	</ul>
					            	
					            	<h3><?php _e('Archives by Month', 'garfunkel') ?></h3>
					            	
					            	<ul>
					            	    <?php wp_get_archives('type=monthly'); ?>
					            	</ul>
					            
						            <h3><?php _e('Archives by Day', 'garfunkel') ?></h3>
						            
						            <ul>
						                <?php wp_get_archives('type=daily'); ?>
						            </ul>
					            
					            </div> <!-- /archive-col -->
					            
					            <div class="clear"></div>
			            
				            </div> <!-- /archive-box -->
																            			                        
						</div> <!-- /post-content -->
						
						<div class="clear"></div>
					
					</div> <!-- /post-inner -->
					
					<?php if ( comments_open() ) : ?>
						
						<div class="comments-page-container">
						
							<div class="comments-page-container-inner">
						
								<?php comments_template( '', true ); ?>
							
							</div> <!-- /comments-page-container-inner -->
						
						</div> <!-- /comments-page-container -->
					
					<?php endif; ?>
					
					<?php get_sidebar(); ?>
									
				</div> <!-- /post -->
			
			<?php endwhile; else: ?>
			
				<p><?php _e("We couldn't find any posts that matched your query. Please try again.", "garfunkel"); ?></p>
		
			<?php endif; ?>
		
			<div class="clear"></div>
			
		</div> <!-- /content -->
		
	</div> <!-- /section-inner -->

</div> <!-- /wrapper -->
								
<?php get_footer(); ?>