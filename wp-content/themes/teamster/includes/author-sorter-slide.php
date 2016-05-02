
	<?php 
	
		global $woo_options;	
		
		global $user_list;
		
		global $user_slider_auth;
		
		if( isset( $_POST['author_id'] ) ){

			//Get the author
			$author = get_userdata( $_POST['author_id'] );
	
		}else{
			
			//Use the first author in the list
			$author = $user_slider_auth;
		
		}
		
		
		if (get_the_author_meta('exclude',$author->ID) != 1) {
		
			$post_type = $woo_options[ 'woo_author_sorter_type'];
			
			if($post_type == 'both'){
				$post_type_array = array('post' , 'portfolio');
			}else{
				$post_type_array = array($post_type);
			}
			
			$post_args = array('posts_per_page' => 4, 'author' => $author->ID, 'post_type' => $post_type_array, 'suppress_filters' => 0);
			$slides = get_posts( $post_args );
			
			if (!empty($slides)) {
			?>
		
			<div class="author-slide">	
			
				<?php
				
					$author_id = $author->ID;
					$author_name = $author->display_name;
					$author_mail = $author->user_email;
					
					/* custom profile fields */
					if ( isset( $author->dribbble ) ) $author_dribbble = $author->dribbble;
					if ( isset( $author->twitter ) ) $author_twitter = $author->twitter;
					if ( isset( $author->facebook ) ) $author_facebook = $author->facebook;
					if ( isset( $author->flickr ) ) $author_flickr = $author->flickr;
					if ( isset( $author->teamtitle ) ) $author_title = $author->teamtitle;
					$author_page_url = get_author_posts_url($author_id);		
				?>
			
				<div class="author-description">
					
					<div class="team-title">
					
						<?php if ( isset( $author_title) && ($author_title != '' ) 	) 
						{ ?><span><?php echo $author_title; ?></span><?php } ?>
					
					</div>
					
					<ul class="social">
						<?php if( isset($author_dribbble) && $author_dribbble != '' ) { ?><li><a href="http://dribbble.com/<?php echo $author_dribbble; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-user-dribbble.png" alt="<?php _e('Dribbble','woothemes'); ?>" /></a></li><?php } ?>
						<?php if( isset($author_dribbble) && $author_twitter != '') { ?><li><a href="http://twitter.com/<?php echo $author_twitter; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-user-twitter.png" alt="<?php _e('Twitter','woothemes'); ?>" /></a></li><?php } ?>
						<?php if($author_facebook != '') { ?><li><a href="<?php echo $author_facebook; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-user-facebook.png" alt="<?php _e('Facebook','woothemes'); ?>" /></a></li><?php } ?>
						<?php if($author_flickr != '') { ?><li><a href="<?php echo $author_flickr; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-user-flickr.png" alt="<?php _e('Flickr','woothemes'); ?>" /></a></li><?php } ?>	
						<li><a href="<?php echo woo_get_author_posts_url_feed($author_id); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-user-rss.png" alt="<?php _e('RSS for ','woothemes'); echo $author_name; ?>" /></a></li>
						<?php if( isset($author_mail) && $author_mail != '') { ?><li><a href="mailto:<?php if( isset($woo_options['woo_contact_method']) && $woo_options['woo_contact_method'] == 'contactform' ) { echo get_permalink($woo_options['woo_contact_page']).'?authorid='.$author_id; } else { echo 'mailto:'.$author_mail; } ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico-user-mail.png" alt="<?php _e('Mail','woothemes'); ?>" /></a></li><?php } ?>
					</ul>
										
					<h3><a href="<?php echo $author_page_url; ?>"><?php echo $author_name; ?></a></h3>
					
					<div class="the-description"><p><?php echo the_author_meta( 'description', $author->ID ); ?></p></div>
					
					<div><p class="read-more"><a href="<?php echo $author_page_url; ?>"><?php _e( 'Read more about me', 'woothemes' ); ?></a></p></div>
					
				</div><!--/.author-description -->					
				
				<div class="author-posts">
					
					<ul>
						<?php
							$count=0;			
							foreach( $slides as $post ) { setup_postdata( $post ); $count++;
								
								if ($count == 1) {
									$class = 'even';
								} else {
									$class = 'odd';
								}
								
						?>		
								<li class="<?php echo $class; ?>">
									
									<?php 
									$image_key = 'image';	
									if ( $post->post_type == 'portfolio' ) {
										$image_key = 'portfolio-image';	
									} 
									woo_image('key='.$image_key.'&width=278&height=208');
									?>
									
									<div class="author-post-meta">
										<span class="date_<?php echo $post->post_type; ?>"><?php the_time( get_option( 'date_format' ) ); ?></span>
										 <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
										<span class="category"><?php if ( $post->post_type == 'portfolio' ) { echo get_the_term_list($post->ID, 'portfolio-gallery', '', ', ' ); } else { the_category(', '); } ?></span><?php if ( $post->post_type != 'portfolio' ) { ?> - <span class="comments"><?php comments_popup_link(__( '0 Comments', 'woothemes' ), __( '1 Comment', 'woothemes' ), __( '% Comments', 'woothemes' )); ?></span><?php } ?>
									</div><!--/.author-post-meta -->
									
								</li>
								
						<?php			
								if ($count > 1) $count = 0;
								
							}
						?>			
					</ul>
				
				</div><!--/.author-posts -->
				
				<div class="fix"></div>
					 	
			</div><!--/.author-slide -->
			
		<?php			
				}					
				
			}
		
		//} 			
		
		?>	

