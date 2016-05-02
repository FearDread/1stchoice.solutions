<?php get_header(); ?>
    
    <div id="content" class="col-full">
    	
    	<div id="sidebar" class="col-left author">
    		    			
			<h3><?php _e( 'The Team', 'woothemes' ); ?></h3>
		
			<?php // QUERY PER AUTHOR; ?>
			<?php if ( get_query_var('paged') ) $paged = get_query_var('paged'); else if ( get_query_var('page') ) $paged = get_query_var('page'); else $paged = 1; ?>
			<?php 
				
				$author_count = 10;
				
				if( $woo_options[ 'woo_teampage_author_num' ] && ($woo_options[ 'woo_teampage_author_num' ] != 'Select a number:') ){
					
					$author_count = $woo_options[ 'woo_teampage_author_num' ];
					
				}
				
				// Get all users
				$user_list = woo_get_users( $author_count , $paged = 1, $role = '', $orderby = 'login', $order = 'ASC', $usersearch = '' , array( array('key' => 'exclude','value' => '1' , 'compare' => '!=') ) );
				
				
				echo '<ul class="authors-list">';
				
				$page_author = get_userdata(get_query_var('author'));
								
				// Go through each user
				foreach($user_list as $author) {
				
					// Avoid users with no posts
					$num_posts = count(get_posts( 'suppress_filters=0&posts_per_page=1&author='.$author->ID ));
					if ($num_posts <= 0) continue;
					
					if (get_the_author_meta('exclude',$author->ID) != 1) {
						
						$active_class = '';
						if ($page_author->ID == $author->ID) { 
							$active_class = ' class="active"';
						}
												
						echo '<li><a' . $active_class . ' href="'.get_author_posts_url($author->ID).'">';
						echo get_avatar( $author->ID, 48 ); // avatar
						echo '<span class="name">'.$author->display_name.'</span>';
						if ($author->teamtitle) { echo '<br /><span class="team-title">'.$author->teamtitle.'</span>'; }
						echo '<span class="arrow"></span>';
						echo '</a></li>';

					}
					
				}
				
				echo '</ul>';
			
			?>
    		
    	</div>
    
		<div id="main" class="col-right">
            
		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<div id="breadcrumbs">
				<?php woo_breadcrumbs(); ?>
			</div><!--/#breadcrumbs -->
		<?php } ?>  

		<?php if (have_posts()) : $count = 0; ?>
       
			<?php 
   			
   			$author = get_userdata(get_query_var('author'));
			$author_id = $author->ID;
			$author_name = $author->display_name;
			$author_mail = $author->user_email;
			/* custom profile fields */
			if ($author->dribbble) $author_dribbble = $author->dribbble;
			if ($author->twitter) $author_twitter = $author->twitter;
			if ($author->facebook) $author_facebook = $author->facebook;
			if ($author->flickr) $author_flickr = $author->flickr;
			if ($author->teamtitle) $author_title = $author->teamtitle;

   			?>
   			
   			<div id="post-author">
   							
				<div class="profile-content">
				
					<h2 class="title"><?php echo $author_name; ?></h2>
					
					<div class="profile-social">
					
						<div class="team-title"><?php if ($author_title != '') { ?><span><?php echo $author_title; ?></span><?php } ?></div>
					
						<ul>
							<?php if($author_dribbble != '') { ?><li><a href="http://dribbble.com/<?php echo $author_dribbble; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-user-dribbble.png" alt="<?php _e('Dribbble','woothemes'); ?>" /></a></li><?php } ?>
								<?php if($author_twitter != '') { ?><li><a href="http://twitter.com/<?php echo $author_twitter; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-user-twitter.png" alt="<?php _e('Twitter','woothemes'); ?>" /></a></li><?php } ?>
								<?php if($author_facebook != '') { ?><li><a href="<?php echo $author_facebook; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-user-facebook.png" alt="<?php _e('Facebook','woothemes'); ?>" /></a></li><?php } ?>
								<?php if($author_flickr != '') { ?><li><a href="<?php echo $author_flickr; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-user-flickr.png" alt="<?php _e('Flickr','woothemes'); ?>" /></a></li><?php } ?>
								<li><a href="<?php echo woo_get_author_posts_url_feed($author_id); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-user-rss.png" alt="<?php _e('RSS for ','woo themes'); echo $author_name; ?>" /></a></li>
								<?php if($author_mail != '') { ?><li><a href="<?php if( isset($woo_options['woo_contact_method']) && $woo_options['woo_contact_method'] == 'contactform' ) { echo get_permalink($woo_options['woo_contact_page']).'?authorid='.$author_id; } else { echo 'mailto:'.$author_mail; } ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-user-mail.png" alt="<?php _e('Mail','woo themes'); ?>" /></a></li><?php } ?>
						</ul>
					</div><!-- .profile-social -->
					
					<div class="profile-description">				
						<?php the_author_meta( 'description', $author->ID ); ?>
					</div><!-- .profile-description -->
					
				</div><!-- .profile-content -->	
				
				<div class="profile-image">
					<?php echo get_avatar( $author_id, '195' ); ?>
				</div><!-- .profile-image -->				

				<div class="fix"></div>
				
			</div><!-- #post-author -->        	

       
            <div class="fix"></div>
	        	
	        	<?php 
	        	// Display Author Portfolio Items
	        	$portfolio_args = array('posts_per_page' => 3, 'author' => $author_id, 'post_type' => array('portfolio'), 'suppress_filters' => 0);
				$portfolio_items = get_posts( $portfolio_args );
				// Check if No Portfolio Items
				if (!empty($portfolio_items)) {
					$count=0;	
					?>
					
					<div id="author-portfolio">
					
					<h3 id="recent-by"><?php _e( 'My Portfolio', 'woothemes' ); ?></h3>
					<?php		
					foreach( $portfolio_items as $portfolio_item ) { 
						setup_postdata( $portfolio_item ); $count++; ?>
						<div class="threecol-one post <?php if ($count == 3) echo 'last'; ?>">
							
							<?php 
							$image_key = 'portfolio-image';
							woo_image( 'id='.$portfolio_item->ID.'&key='.$image_key.'&width=185&height=160&class=thumbnail '.$woo_options[ 'woo_thumb_align' ]); ?> 
	
	                		<h2 class="title"><a href="<?php echo get_permalink($portfolio_item->ID) ?>" rel="bookmark" title="<?php echo $portfolio_item->post_title; ?>"><?php echo $portfolio_item->post_title; ?></a></h2>
	                		
	            		</div>
						<?php
					} // End For Loop
					?>
					</div><!-- /#author-portfolio -->
				
					<div class="fix"></div>
				
				<?php $portfolio_count = woo_count_user_posts_by_type($author_id, 'portfolio'); ?>
				<?php if ( $portfolio_count > 3 ) { ?>
				<div class="portfolio-more">
					<a class="portfolio-btn" href="<?php echo get_post_type_archive_link( 'portfolio' ).'?authorid='.$author_id; ?>" title="More Portfolio Items"><?php _e('View More of My Portfolio Items','woothemes'); ?></a>
					<div class="fix"></div>
				</div><!-- /.post-more -->
				<?php } ?>
				
				<?php
			} // End If Statement
        	?>
        	
        	<h3 id="recent-by"><?php _e( 'Recent blog posts written by', 'woothemes' ); ?> <?php echo $author_name; ?></h3>
        
        <?php while (have_posts()) : the_post(); $count++; ?>
                                                                    
            <!-- Post Starts -->
            <div <?php post_class(); ?>>

                <?php if ( $woo_options[ 'woo_post_content' ] != "content" ) woo_image( 'width='.$woo_options[ 'woo_thumb_w' ].'&height='.$woo_options[ 'woo_thumb_h' ].'&class=thumbnail '.$woo_options[ 'woo_thumb_align' ]); ?> 

                <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                
                <div class="entry">
                    <?php if ( $woo_options[ 'woo_post_content' ] == "content" ) the_content(__( 'Read More...', 'woothemes' )); else the_excerpt(); ?>
                </div><!-- /.entry -->
                
                <?php woo_post_meta(); ?>

            </div><!-- /.post -->
            
        <?php endwhile; else: ?>
        
            <div <?php post_class(); ?>>
                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ) ?></p>
            </div><!-- /.post -->
        
        <?php endif; ?>  
    
			<?php woo_pagenav(); ?>
                
		</div><!-- /#main -->

    </div><!-- /#content -->
		
<?php get_footer(); ?>