<?php get_header(); ?>
<?php global $woo_options; ?>

    <div id="content" class="col-full">
		<div id="main" class="col-left">  
		
	        <?php if ( $woo_options['woo_main_page1'] && $woo_options['woo_main_page1'] != 'Select a page:' ) { ?>
	        <div id="main-page1">
				<?php
					$page = $woo_options['woo_main_page1'];
					if ( ! is_numeric( $page ) ) { $page = get_page_id( $page ); }
					$query_args = array( 'suppress_filters' => false, 'page_id' => $page );
					query_posts( $query_args );
				?>
	            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>		        					
			    <div class="entry"><?php the_content(); ?></div>
	            <?php endwhile; endif; ?>
	            <div class="fix"></div>
	        </div><!-- /#main-page1 -->
	        <?php } ?>		    
            
            <?php if ( $woo_options['woo_mini_features'] == 'true' ) : ?>
	        <div id="mini-features">
	        <?php
	        	$query_args = array( 'suppress_filters' => false, 'post_type' => 'infobox', 'order' => 'ASC', 'posts_per_page' => 20 );
	        	
	        	query_posts( $query_args );
	        ?>
	        <?php if (have_posts()) : while (have_posts()) : the_post(); $counter++; ?>		        					
	
				<?php 
					$icon = get_post_meta($post->ID, 'mini', true); 
					$excerpt = stripslashes(get_post_meta($post->ID, 'mini_excerpt', true)); 
					$button = get_post_meta($post->ID, 'mini_readmore', true);
				?>
				<div class="block <?php if ($counter == 2) echo 'last'; ?>">
					<?php if ( $icon ) { ?>
	                <img src="<?php echo $icon; ?>" alt="" class="home-icon" />				
	                <?php } ?> 
	                                                     
	                <div class="<?php if ( $icon ) echo 'feature'; if ( $counter == 2 ) echo ' last'; ?>">
	                   <h3><?php echo get_the_title(); ?></h3>
	                   <p><?php echo $excerpt; ?></p>
	                   <?php if ( $button ) { ?><a href="<?php echo $button; ?>" class="btn"><?php _e( 'Read More', 'woothemes' ); ?></a><?php } ?>
	                </div>
				</div>
				<?php if ( $counter == 2 ) { $counter = 0; echo '<div class="fix"></div>'; } ?>				
	                
	        <?php endwhile; endif; ?>
	
	            <div class="fix"></div>
	        </div><!-- /#mini-features -->
	        <?php endif; ?>	

	        <?php if ( $woo_options['woo_main_page2'] && $woo_options['woo_main_page2'] != 'Select a page:' ) { ?>
	        <div id="main-page2" class="home-page">
				<?php
					$page = $woo_options['woo_main_page2'];
					if ( ! is_numeric( $page ) ) { $page = get_page_id( $page ); }
					$query_args = array( 'suppress_filters' => false, 'page_id' => $page );
					query_posts( $query_args );
				?>
	            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>		        					
			    <div class="entry"><?php the_content(); ?></div>
	            <?php endwhile; endif; ?>
	            <div class="fix"></div>
	        </div><!-- /#main-page2 -->
	        <?php } ?>
	        
	        <?php if ( $woo_options['woo_latest'] == 'true' ): ?>
	        <div id="latest-blog-posts">
	        
				<h3><?php echo _e( 'Latest from our blog', 'woothemes' ); ?></h3>
				
				<div>
					<?php
						 $posts = $woo_options['woo_latest_entries'];
						 query_posts( array( 'suppress_filters' => false, 'posts_per_page' => $posts ) );
						 if ( have_posts() ) : while ( have_posts() ) : the_post();
					?>
					    <div class="item">
				        	<?php woo_image( 'width=100&height=80&class=thumbnail alignleft' ); ?> 
				        	<h4><a class="title" href="<?php echo get_permalink($post->ID); ?>" title="<?php echo esc_attr( get_the_title($post->ID) ); ?>"><?php echo get_the_title($post->ID); ?></a></h4>
				            <p class="post-meta">
				                <span class="small"><?php _e( 'by', 'woothemes' ); ?></span> <span class="post-author"><?php the_author_posts_link(); ?></span>
				                <span class="small"><?php _e( 'on', 'woothemes' ); ?></span> <span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
				                <span class="small"><?php _e( 'in', 'woothemes' ); ?></span> <span class="post-category"><?php the_category( ', ' ); ?></span>
				            </p>
				            <p><?php echo woo_text_trim( get_the_excerpt(), 25); ?> <span class="read-more"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;','woothemes' ); ?>"><?php _e( 'Continue Reading &rarr;','woothemes' ); ?></a></span></p>
				        </div>
					    
					<?php endwhile; endif; ?>
				</div>
				
			</div><!-- /#latest-blog-posts -->	
			<?php endif; ?>	        
                
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>