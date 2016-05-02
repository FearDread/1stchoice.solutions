<?php global $woo_options; ?>
       
    <div id="content" class="col-full">

		<div id="main" class="fullwidth">
		           
		    <div id="portfolio">
		    
			<!-- Tags -->
			<?php if ( $woo_options['woo_portfolio_tags'] ) { ?>
		    	<div id="port-tags">
		            <div class="fl">
		            	<?php
						$tags = explode(',',$woo_options['woo_portfolio_tags']); // Tags to be shown
						foreach ($tags as $tag){
							$tag = trim($tag); 
							$displaytag = $tag;
							$tag = str_replace (" ", "-", $tag);	
							$tag = str_replace ("/", "-", $tag);
							$tag = strtolower ( $tag );
							$link_tags[] = '<a href="#" rel="'.$tag.'">'.$displaytag.'</a>'; 
						}
						$new_tags = implode(' ',$link_tags);
						?>
		                <span class="port-cat"><?php _e('Select a category:', 'woothemes'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" rel="all"><?php _e('All','woothemes'); ?></a>&nbsp;<?php echo $new_tags; ?></span>
		            </div>
		      <div class="fix"></div>
		      </div>
		      
			<?php } ?>
			<!-- /Tags -->		    
		    
			    <?php //do_action('wp_dribbble'); ?>
		    
				<ol class="portfolio dribbbles">

		        <?php if ( get_query_var('paged') ) $paged = get_query_var('paged'); elseif ( get_query_var('page') ) $paged = get_query_var('page'); else $paged = 1; ?>
		        <?php query_posts("post_type=portfolio&paged=$paged"); ?>
		        <?php if (have_posts()) : $count = 0; while (have_posts()) : the_post(); $count++; ?>
		        
					<?php 
						// Portfolio tags class
						$porttag = ""; 
						$posttags = get_the_tags(); 
						if ($posttags) { 
							foreach($posttags as $tag) { 
								$tag = $tag->name;
								$tag = str_replace (" ", "-", $tag);	
								$tag = str_replace ("/", "-", $tag);
								$tag = strtolower ( $tag );
								$porttag .= $tag . ' '; 
							} 
						} 
					?>  		        
		        
					<li class="group <?php echo $porttag; ?>">
						<div class="dribbble">
							<div class="dribbble-shot">
								<div class="portfolio-img dribbble-img">
									
									<?php /* CUSTOM BELOW HERE */ ?>
									
									<?php if ( woo_image('key=portfolio-image&return=true') ) { 

                    					// Check if there is a gallery in post
										// woo_get_post_images is offset by 1 by default. Setting to offset by 0 to show all images
                    					$gallery = woo_get_post_images('offset=0');
                    					$large =  get_post_meta( $post->ID, 'portfolio-image', true );
                    					if ( $gallery ) {
                    						// Get first uploaded image in gallery
                    						$large = $gallery[0]['url'];
                    						$caption = $gallery[0]['caption'];
	                				    } 
	                				    
	                				    // Check for a post thumbnail, if support for it is enabled.
	                				    if ( ( $woo_options['woo_post_image_support'] == 'true' ) && current_theme_supports( 'post-thumbnails' ) ) {
	                				    	$image_id = get_post_thumbnail_id( $post->ID );
	                				    	if ( intval( $image_id ) > 0 ) {
	                				    		$large_data = wp_get_attachment_image_src( $image_id, 'large' );
	                				    		if ( is_array( $large_data ) ) {
	                				    			$large = $large_data[0];
	                				    		}
	                				    	}
	                				    }
	                				    
	                				    $lightbox_url = get_post_meta( $post->ID, 'embed-url', true );
	                				    
	                				    // See if lightbox-url custom field has a value
	                				    if ( $lightbox_url != '' ) {
	                				    	$large = $lightbox_url;
	                				    	unset($gallery);
	                				    }
	                				    
	                				    // Set rel on anchor to show lightbox
                  						if ( isset($woo_options['woo_gallery_lightbox']) && $woo_options['woo_gallery_lightbox'] == 'true' ) {
									
											$rel = 'rel="prettyPhoto['. $post->ID .']"';       
	                				  		if ( isset($woo_options['woo_gallery_lightbox_group']) && $woo_options['woo_gallery_lightbox_group'] == "all" )
												$rel = 'rel="prettyPhoto[gallery]"';                		                  			
	                				  		elseif ( isset($woo_options['woo_gallery_lightbox_group']) && $woo_options['woo_gallery_lightbox_group'] == "none" )
	                				  			$rel = 'rel="prettyPhoto"';
												
                  						} else {
                  							$rel = '';
                  							$large = get_permalink();
                  						}
                  						
									 	?>
					         
                    					<a <?php echo $rel; ?> title="<?php echo $caption; ?>" href="<?php echo $large; ?>" class="thumb dribbble-link">
											<?php woo_image('key=portfolio-image&width=285&height=186&link=img&alt=' . esc_attr( get_the_title() ) . ''); ?>
                    					</a>
										<a href="<?php the_permalink(); ?>" class="dribbble-over"><?php the_title(); ?></a><br/>
										<?php 
										// Output image gallery for lightbox
                    					if ( $gallery ) {
	                    					foreach ( array_slice( $gallery, 1 ) as $img => $attachment ) {
	                    						echo '<a '.$rel.' title="'.$attachment['caption'].'" href="'.$attachment['url'].'" class="gallery-image"></a>';	                    
	                    					}
	                    					unset( $gallery );
	                    				}
									} ?>
								
									<?php /* CUSTOM ABOVE HERE */ ?>
									
									
										<!-- <span class="dim">Your Player Name</span>  -->
										<span><?php the_time( get_option( 'date_format' ) ); ?></span> 
								
															</div>
							</div>
						</div>
					</li>
		        <?php endwhile; else: ?>
	            <div class="post">
	                <p><?php _e('Sorry, no posts matched your criteria.', 'woothemes') ?></p>
	            </div><!-- /.post -->
		        <?php endif; ?>  
	    
				</ol>		        		        
			
		    </div><!-- /#portfolio -->
            <div class="fix"></div>                                                
            <?php woo_pagenav(); ?>
		</div><!-- /#main -->

    </div><!-- /#content -->
