<?php
/**
 * Homepage Features Panel
 */
 
	/**
 	* The Variables
 	*
 	* Setup default variables, overriding them if the "Theme Options" have been saved.
 	*/
	
	global $woo_options;
	
	$settings = array(
					'blog_thumb_w' => 214, 
					'blog_thumb_h' => 176, 
					'homepage_number_of_posts' => 4,
					'homepage_blog_area_title' => 'Latest Blog Posts', 
					'homepage_posts_category' => 0
					);
					
	$settings = woo_get_dynamic_values( $settings );
	$orderby = 'date';
	
?>
			<?php
			$number_of_features = $settings['homepage_number_of_posts'];
			/* The Query. */
			$query_args = array( 
					'post_type' => 'post', 
					'posts_per_page' => $number_of_features, 
					'orderby' => $orderby
				);

			if ( 0 < intval( $settings['homepage_posts_category'] ) ) {
				$query_args['tax_query'] = array(
												array( 'taxonomy' => 'category', 'field' => 'id', 'terms' => intval( $settings['homepage_posts_category'] ) )
											);
			}

			$the_query = new WP_Query( $query_args );
			/* Query Count */
			$query_count = $the_query->post_count;
			/* The Loop. */
			if ( $the_query->have_posts() ) { $count = 0; ?>


				<section id="blog-posts" class="home-section blog-posts-sc fix">
    		
    			<header class="block highlights">
    				<h3><?php echo stripslashes( $settings['homepage_blog_area_title'] ); ?></h3>
    			</header>
    			
					<?php while ( $the_query->have_posts() ) { $the_query->the_post(); $count++; ?>
					<article class="one<?php if ($count % 4 == 0) { echo ' last'; } ?>">
					<div class="over  item<?php if ($count % 4 == 0) { echo ' last'; } ?>">
						<div class="overview" style="visibility: hidden;">
							<span class="over-view">
								<a href="<?php echo woo_image( 'link=url&return=true' ); ?>" class="over-cap"></a>
								<a href="<?php the_permalink(); ?>" class="over-details"></a>
							</span>
						</div>
						<?php woo_image( 'noheight=true&width=' . $settings['blog_thumb_w'] . '&height=' . $settings['blog_thumb_h'] ); ?>
					</div>
					<div class="home-blogs"><?php echo woo_text_trim( get_the_excerpt() , 12 ); ?> <a href="<?php the_permalink(); ?>"><?php the_time('j F Y') ?></a></div>

					</article>	
					<?php if ( $count %4 == 0 ): ?><div class="fix"></div><?php endif; ?>
    				<?php } // End While Loop ?>
    		
    		</section>
    		<?php } // End If Statement ?>
    		
    		<?php wp_reset_postdata(); ?>