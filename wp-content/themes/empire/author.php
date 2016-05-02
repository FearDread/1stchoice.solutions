<?php get_header(); ?>
    
    <div id="content" class="col-full">
		<div id="main" class="col-left">
            
		<?php if ( isset($woo_options[ 'woo_breadcrumbs_show' ]) && $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<div id="breadcrumbs">
				<?php woo_breadcrumbs(); ?>
			</div><!--/#breadcrumbs -->
		<?php } ?>  

			<?php 
   			
   			$author = get_userdata(get_query_var('author'));
   			$author_id = $author->ID;
   			$author_name = $author->display_name;
   			/* custom profile fields */
   			$author_twitter = $author->twitter;
   			$author_facebook = $author->facebook;
   			$author_flickr = $author->flickr;
   			?>
        	
			<div id="post-author">
				<div class="profile-image"><?php echo get_avatar( $author_id, '70' ); ?></div>
				<div class="profile-content">
					<h3 class="title"><?php printf( esc_attr__( 'About %s', 'woothemes' ), $author_name ); ?></h3>
					<?php the_author_meta( 'description', $author->ID ); ?>
					
				</div><!-- .post-entries -->
				<div class="profile-social">
					<ul>
						<?php if ($author_twitter != '') { ?><li class="twitter"><a href="http://twitter.com/<?php echo $author_twitter; ?>"><?php _e( 'Twitter', 'woothemes' ); ?></a></li><?php } ?>
						<?php if ($author_facebook != '') { ?><li class="facebook"><a href="<?php echo $author_facebook; ?>"><?php _e( 'Facebook', 'woothemes' ); ?></a></li><?php } ?>
						<?php if ($author_flickr != '') { ?><li class="flickr"><a href="<?php echo $author_flickr; ?>"><?php _e( 'Flickr', 'woothemes' ); ?></a></li><?php } ?>
					</ul>
				</div><!-- .profile-social -->
				<div class="fix"></div>
			</div><!-- #post-author -->        	
        	
        	<?php if ($author_twitter != '') { ?>
        	<div id="author-twitter" class="widget_woo_twitter">
        		
        		<h3 class="title"><?php _e( 'My Twitter', 'woothemes' ); ?></h3>
        	
        		 <ul id="twitter_update_list_<?php echo $author_id; ?>"><li></li></ul>
		        <p><?php _e( 'Follow', 'woothemes' ); ?> <a href="http://twitter.com/<?php echo $author_twitter; ?>"><strong>@<?php echo $author_twitter; ?></strong></a> <?php _e( 'on Twitter', 'woothemes' ); ?></p>
		        <div class="fix"></div>
		        <?php echo woo_twitter_script($author_id,$author_twitter,3); //Javascript output function ?>		    </div><!-- #author-twitter -->  
        		
            <div class="fix"></div>
            <?php } ?>
            
		<?php if (have_posts()) : $count = 0; ?>
       		
        <?php while (have_posts()) : the_post(); $count++; ?>
                                                                    
            <!-- Post Starts -->
            <div <?php post_class(); ?>>

                <?php if ( $woo_options[ 'woo_post_content' ] != "content" ) woo_image( 'width='.$woo_options[ 'woo_thumb_w' ].'&height='.$woo_options[ 'woo_thumb_h' ].'&class=thumbnail '.$woo_options[ 'woo_thumb_align' ]); ?> 

                <?php woo_post_meta(); ?>

                <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                
                <div class="entry">
                    <?php if ( $woo_options[ 'woo_post_content' ] == "content" ) the_content(__( 'Read More...', 'woothemes' )); else the_excerpt(); ?>
                </div><!-- /.entry -->

                <div class="post-more">      
                	<?php if ( $woo_options[ 'woo_post_content' ] == "excerpt" ) { ?>
					<span class="comments"><?php comments_popup_link(__( 'Leave a comment', 'woothemes' ), __( '1 Comment', 'woothemes' ), __( '% Comments', 'woothemes' )); ?></span>
					<span class="post-more-sep">&bull;</span>
                    <span class="read-more"><a href="<?php the_permalink() ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;', 'woothemes' ); ?>"><?php _e( 'Continue Reading &rarr;', 'woothemes' ); ?></a></span>
                    <?php } ?>
                </div>   

            </div><!-- /.post -->
            
        <?php endwhile; else: ?>
        
            <div <?php post_class(); ?>>
                <p><?php _e( 'I have not published any posts yet.', 'woothemes' ) ?></p>
            </div><!-- /.post -->
        
        <?php endif; ?>  
    
			<?php woo_pagenav(); ?>
                
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>