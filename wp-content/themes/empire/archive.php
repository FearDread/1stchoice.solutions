<?php get_header(); ?>
    
    <div id="content" class="col-full">
		<div id="main" class="col-left">
            
		<?php if ( isset($woo_options[ 'woo_breadcrumbs_show' ]) && $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<div id="breadcrumbs">
				<?php woo_breadcrumbs(); ?>
			</div><!--/#breadcrumbs -->
		<?php } ?>  

		<?php if (have_posts()) : $count = 0; ?>
        
            <?php if (is_category()) { ?>
        	<span class="archive_header">
        		<span class="fl cat"><?php _e( 'Archive', 'woothemes' ); ?> | <?php echo single_cat_title(); ?></span> 
        		<span class="fr catrss"><?php $cat_id = get_cat_ID( single_cat_title( '', false ) ); echo '<a href="' . get_category_feed_link( $cat_id, '' ) . '">' . __( "RSS feed for this section", "woothemes" ) . '</a>'; ?></span>
        	</span>        
        
            <?php } elseif (is_day()) { ?>
            <span class="archive_header"><?php _e( 'Archive', 'woothemes' ); ?> | <?php the_time( get_option( 'date_format' ) ); ?></span>

            <?php } elseif (is_month()) { ?>
            <span class="archive_header"><?php _e( 'Archive', 'woothemes' ); ?> | <?php the_time( 'F, Y' ); ?></span>

            <?php } elseif (is_year()) { ?>
            <span class="archive_header"><?php _e( 'Archive', 'woothemes' ); ?> | <?php the_time( 'Y' ); ?></span>

            <?php } elseif (is_author()) { ?>
            <span class="archive_header"><?php _e( 'Archive by Author', 'woothemes' ); ?></span>

            <?php } elseif (is_tag()) { ?>
            <span class="archive_header"><?php _e( 'Tag Archives:', 'woothemes' ); ?> <?php echo single_tag_title( '', true); ?></span>
            
            <?php } ?>
            <div class="fix"></div>
        
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
                	<?php if(isset($woo_options[ 'woo_comments' ])) { $comm = $woo_options[ 'woo_comments' ]; } else { $comm = ''; } if ( ($comm == "post" || $comm == "both") ) { ?>
					<span class="comments"><?php comments_popup_link(__( 'Leave a comment', 'woothemes' ), __( '1 Comment', 'woothemes' ), __( '% Comments', 'woothemes' )); ?></span>
					<span class="post-more-sep">&bull;</span>
					<?php } ?>
                    <span class="read-more"><a href="<?php the_permalink() ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;', 'woothemes' ); ?>"><?php _e( 'Continue Reading &rarr;', 'woothemes' ); ?></a></span>
                    <?php } ?>
                </div>   

            </div><!-- /.post -->
            
        <?php endwhile; else: ?>
        
            <div <?php post_class(); ?>>
                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ) ?></p>
            </div><!-- /.post -->
        
        <?php endif; ?>  
    
			<?php woo_pagenav(); ?>
                
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>