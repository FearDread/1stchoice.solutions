<?php
/*
Template Name: Meet the Team
*/
?>
<?php get_header(); ?>
<?php global $woo_options; ?>
       
    <div id="content" class="col-full">

		<div id="main" class="col-left">
		           
		    <div id="portfolio">
		    
				<?php if ( get_query_var('paged') ) $paged = get_query_var('paged'); elseif ( get_query_var('page') ) $paged = get_query_var('page'); else $paged = 1; ?>
				<?php 
				// TO DO - PAGINATION
				$user_list = woo_get_users( 10, $paged );
				$count = 0;				
				
				foreach($user_list as $author) {
					
					if (get_the_author_meta('exclude',$author->ID) != 1) {
					 
						$author_id = $author->ID;
						$author_name = $author->display_name;
						/* custom profile fields */
						$author_twitter = $author->twitter;
						$author_facebook = $author->facebook;
						$author_flickr = $author->flickr;
						$author_page_url = get_author_posts_url($author_id);
						
						$count++;

						$avatar = str_replace( "class='avatar", "class='photo avatar thumbnail", get_avatar( $author->user_email,  100) );
	    				?>

						<div class="post entry">
						
							<div class="alignleft"><a href="<?php echo $author_page_url; ?>"><?php echo $avatar; ?></a></div>
							
							<div class="bio">
							
								<a href="<?php echo $author_page_url; ?>" class="author-name"><?php echo $author_name; ?></a>
								<p><?php the_author_meta( 'description', $author->ID ); ?></p>
								
								<div class="profile-social">
									<ul>
										<?php if ($author_twitter != '') { ?><li class="twitter"><a href="http://twitter.com/<?php echo $author_twitter; ?>"><?php _e( 'Twitter', 'woothemes' ); ?></a></li><?php } ?>
										<?php if ($author_facebook != '') { ?><li class="facebook"><a href="<?php echo $author_facebook; ?>"><?php _e( 'Facebook', 'woothemes' ); ?></a></li><?php } ?>
										<?php if ($author_flickr != '') { ?><li class="flickr"><a href="<?php echo $author_flickr; ?>"><?php _e( 'Flickr', 'woothemes' ); ?></a></li><?php } ?>
									</ul>
								</div><!-- .profile-social -->
							
							</div>
							
							<div class="fix"></div>

						</div><!-- .post -->

						<?php
					} // End If Statement
				} // End For Loop
				 
				?>
							
		    </div><!-- /#portfolio -->
                                                            
            <?php woo_pagenav(); ?>
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>