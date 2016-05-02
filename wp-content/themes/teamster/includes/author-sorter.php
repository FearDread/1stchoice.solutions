<?php global $woo_options; ?>
<div id="author-slides">

	<div class="section col-full">
		
			<div class="section-left">
		
				<div id="author-info">
					<h3><?php _e('Browse by Author', 'woothemes'); ?></h3>
					<?php if ($woo_options[ 'woo_team_page' ] != 'Select a page:') { ?><p><?php _e( 'View the', 'woothemes' ); ?> <a href="<?php echo get_permalink($woo_options[ 'woo_team_page' ]); ?>"><?php _e( 'Team', 'woothemes' ) ?></a> <?php _e( 'page', 'woothemes' ) ?>.</p><?php } ?>
				</div><!--/#author-info -->
				
			</div><!--/.section-left -->
			
			<div class="section-right">
				
				<div id="author-sorter">
					
					<?php // QUERY PER AUTHOR; ?>
					<?php if ( get_query_var('paged') ) $paged = get_query_var('paged'); elseif ( get_query_var('page') ) $paged = get_query_var('page'); else $paged = 1; ?>
					<?php 

						$author_count = 10;
						
						if( $woo_options[ 'woo_author_sorter_num' ] && ($woo_options[ 'woo_author_sorter_num' ] != 'Select a number:') ){
						
							$author_count = $woo_options[ 'woo_author_sorter_num' ];
							
						}
													
						// Get all users
						global $user_list;
						
						global $user_slider_auth;
						
						$user_list = woo_get_users( $author_count , $paged = 1, $role = '', $orderby = 'login', $order = 'ASC', $usersearch = '' , array( array('key' => 'exclude','value' => '1' , 'compare' => '!=') ) );
						
						echo '<ul class="pagination">';
						
						$count = 0;
										
						// Go through each user
						foreach($user_list as $key => $author) {
						
							// Avoid users with no posts
							
							$post_type = $woo_options[ 'woo_author_sorter_type'];
			
							if($post_type == 'both'){
								$post_type_array = array('post' , 'portfolio');
							}else{
								$post_type_array = array($post_type);
							}
							
							$post_args = array('posts_per_page' => 4, 'author' => $author->ID, 'post_type' => $post_type_array, 'suppress_filters' => 0);
							$num_posts = count(get_posts( $post_args ));
							if ($num_posts <= 0) continue;
							
							if (get_the_author_meta('exclude',$author->ID) != 1) {
								
								//Save the first user to display in the slider
								if(!$count){
									$user_slider_auth = $author;
								}
								
								$count++;
								
								$li_class = '';
								
								if($_GET['author_id'] == $author->ID){
									$li_class='class="now"';
								}elseif($count == 1 && !$_GET['author_id'] && ($woo_options[ 'woo_author_sorter_open' ] == 'true') ){
									$li_class='class="now"';
								}
								
								echo '<li ' . $li_class . ' ><a id=' . $author->ID . ' href="?author_id=' . $author->ID . '">';
								echo get_avatar( $author->ID, 48 ); // avatar
								echo '<span class="arrow"></span>';
								echo '</a></li>';
		
							}
							
						}
						
						echo '</ul>';
					
					?>
				
				</div><!--/#author-sorter -->
				
			</div><!--/.section-right -->
			
			<div class="fix"></div>
			
		</div><!--/.section -->	
		
		<div id="author-slides-holder"<?php if ($woo_options[ 'woo_author_sorter_open' ] == 'true') { ?> class="open"<?php } ?>>
			<span class="author_slide_loading" style="display: none;"></span>
			<div class="author-slides-container">	
				
				<?php if ($woo_options[ 'woo_author_sorter_open' ] == 'true'){?>
					<?php get_template_part( 'includes/author-sorter-slide' ); ?>
				<?php } ?>
			</div><!--/.author-slides-container -->
			
		</div><!--/#author-slides-holder -->	

</div><!--/#author-slides -->