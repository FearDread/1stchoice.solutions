<?php global $woo_options; $count = 0; ?>
<div id="slides">
	<div id="slide-box">
	<?php $slides = get_posts( 'suppress_filters=0&post_type=slide&showposts=' . $woo_options['woo_slider_entries'] ); ?>
	<?php if ( ! empty( $slides ) ) : ?>
		<div class="slides_container col-full">  
		<?php foreach( $slides as $post ) : setup_postdata( $post ); $count++; ?>
			
			<div class="slide slide-<?php echo $count; ?>" <?php if( $woo_options['woo_slider_entries'] == 1 ) { echo 'style="display:block;"'; }?>>
			<?php
				$url = get_post_meta( $post->ID, 'url', true );
				$slide_content_class = 'entry';
				$has_video = get_post_meta( $post->ID, 'embed', true );
				$has_image = get_post_meta( $post->ID, 'image', true );
				$post_thumb = get_option('woo_post_image_support') == 'true' && has_post_thumbnail();
				$title = $woo_options['woo_slider_title'] == 'true';
				$content = $woo_options['woo_slider_content'] == 'true';
			?>
			<?php if ( $has_video ) { $slide_content_class = 'video'; } ?>
			
			<?php if ( $has_video || $has_image || $post_thumb ) {	?>
				<?php if ( $title || $content ) { ?>
				<div class="slide-content <?php echo $slide_content_class; ?> fl">
				
					<?php if ( $title ) { ?><h2 class="title"><a href="<?php if ( $url ) { echo $url; } else { echo '#'; } ?>"><?php the_title(); ?></a></h2><?php } ?>
					
					<?php if ( $content ) { ?><?php the_content(); ?><?php } ?>
				
				</div><!-- /.slide-content -->
				<?php } ?>
					
				<?php if ( $has_image || $post_thumb ) { ?>
				<div class="slide-image fl">
				<?php if ( $url ) { ?>
				<a href="<?php echo $url; ?>" title="<?php the_title(); ?>"><?php woo_image('key=image&width=720&height=500&class=slide-img&link=img'); ?></a>
					<?php } else { ?>
					<?php woo_image('key=image&width=720&height=500&class=slide-img&link=img'); } ?>
				</div><!-- /.slide-image -->
				
				<?php } elseif ( $has_video ) {
				
					echo woo_embed('key=embed&width=500&class=video');
					
				  } ?>
							
				<div class="fix"></div>
				
			<?php } else { ?><!-- // End $type IF Statement -->
            
            	<div class="entry">
                    <?php the_content(); ?>
                </div>                        
           
            <?php } ?>
                
			</div><!-- /.slide -->
			
		<?php endforeach; ?>
						
		</div><!-- /.slides_container -->
	<?php endif; ?>
	
	</div><!-- /#slide-box -->
	<?php if ( isset( $woo_options['woo_slider_pagination'] ) && ( $woo_options['woo_slider_pagination'] == 'true' ) && $count > 1 ) { ?>
	<div id="slider_nav">
		<div id="slider_pag">
			<ul class="pagination">
			<?php
				for ( $i = 0; $i < $count; $i++ ) {
			?>
				<li><a href="#<?php echo $i; ?>"><?php echo $i + 1; ?></a></li>
			<?php
				}
			?>
			</ul><!--/.pagination-->
		</div><!--/#slider_pag-->
	</div><!--/#slider_nav-->
	<?php } ?>
</div><!-- /#slides -->
