<?php global $woo_options; ?>
<div id="slides">
	<?php
		$query_args = array( 'suppress_filters' => false, 'post_type' => 'slide', 'showposts' => $woo_options['woo_slider_entries'] );
		
		$slides = get_posts( $query_args );
		
		if ( ! empty( $slides ) ) {
	?>
		<div class="slides_container col-full">  
		<?php
			$counter = 0;
			foreach( $slides as $post ) { setup_postdata( $post ); $counter++;
			
			$image = get_post_meta( $post->ID, 'slide-image', true );
			$embed = get_post_meta( $post->ID, 'embed', true );
			$image_alt = get_post_meta( $post->ID, 'slide-image-alt', true );
			$url = get_post_meta( $post->ID, 'slide-image-url', true );
		?>	
			<div class="slide" <?php if ( $counter == 1 ) { echo 'style="display:block;"'; } ?>>
			
				<div class="slide-content entry fl"<?php if ( ! $image && ! $embed ) { echo ' style="width:auto;"'; } elseif ( $embed != '' ) { echo ' style="width:380px;"'; } ?>>
				
					<h2 class="title"><?php the_title(); ?></h2>
					
					<?php the_content(); ?>
				
				</div><!-- /.slide-content -->
				<?php					
					if ( $image != '' || $embed != '' ) {
				?>
				<div class="slide-image fr">	
					<?php
						if ( $image != '' ) {
							$image_args = 'width=520&src=' . $image . '&class=slide-img&force=true';
							
							// Cater for custom image ALT text.
							if ( $image_alt != '' ) {
								$image_args .= '&meta=' . esc_attr( $image_alt );
							}
							
							if ( $url )
								echo '<a href="'.$url.'">'.woo_image( $image_args . '&return=true' ).'</a>';
							else
							 	woo_image( $image_args );
							 
						} elseif ( $embed != '' ) {
							echo woo_embed( 'key=embed&width=520&height=320&class=video' );
						}
					?>
				</div><!-- /.slide-image -->				
				<?php } ?>
				
				<div class="fix"></div>
					
			</div><!-- /.slide -->
			
		<?php } ?>		
		</div><!-- /.slides_container -->
	<?php } // End IF Statement ?>
	<?php if ( isset( $woo_options['woo_slider_navigation'] ) && $woo_options['woo_slider_navigation'] == 'true' ) { ?>
	<div class="slide-nav">
		<div class="pagination col-full">
			<ul>
				<?php
					if ( ! empty( $slides ) ) {
						foreach( $slides as $post ) { setup_postdata( $post );
						$description = get_post_meta( $post->ID, 'slide-description', true );
				?>
						<li>
							<a href="#">
								<span class="title"><?php the_title(); ?></span>
								<?php if ( $description != '' ) { ?><span class="content"><?php echo esc_html( $description ); ?></span><?php } ?>
							</a>
						</li>
					<?php } ?>
				<?php } ?>
			</ul>
		</div><!--/.pagination col-full-->
	</div>
	<div id="slider-bg-shadow"></div>
	<?php } ?>
</div><!-- /#slides -->