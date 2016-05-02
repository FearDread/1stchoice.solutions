	<?php if ( get_option( 'woo_feat_page' ) <> "" ) { ?>
	
	<div id="featured" class="outer">
	
		<div class="inner">
		
		<?php query_posts('page_id=' . get_option( 'woo_feat_page' ) ); while (have_posts()) : the_post(); ?>
			
			<div id="text">
				
				<?php if ( get_post_meta($post->ID, "image", $single = true) <> "" ) { ?>
				
					<img src="<?php echo get_post_meta($post->ID, "image", $single = true); ?>" alt="<?php the_title(); ?>" class="alignleft" />
			        
				<?php } ?>
			
				<h2><?php the_title(); ?></h2>
				
				<p><?php if ( get_post_meta($post->ID, "page_excerpt", $single = true) <> "" ) { echo get_post_meta($post->ID, "page_excerpt", $single = true); } else { the_excerpt(); } ?></p>
				
				<div id="buttons">
					
					<?php if ( get_post_meta($post->ID, "link1_text", $single = true) <> "" and get_post_meta($post->ID, "link1_link", $single = true) <> "" ) { ?>
						<a class="open" href="<?php echo get_post_meta($post->ID, "link1_link", $single = true); ?>" title="<?php echo get_post_meta($post->ID, "link1_text", $single = true); ?>"><span class="left"></span><span class="middle"><?php echo get_post_meta($post->ID, "link1_text", $single = true); ?></span><span class="right"></span></a>
					<?php } ?>
					
					<?php if ( get_post_meta($post->ID, "link2_text", $single = true) <> "" and get_post_meta($post->ID, "link2_link", $single = true) <> "" ) { ?>
						<a class="more" href="<?php echo get_post_meta($post->ID, "link2_link", $single = true); ?>" title="<?php echo get_post_meta($post->ID, "link2_text", $single = true); ?>"><span class="left"></span><span class="middle"><?php echo get_post_meta($post->ID, "link2_text", $single = true); ?></span><span class="right"></span></a>
					<?php } ?>	
				
				</div><!-- /#buttons -->
			
			</div><!-- /#text -->
			
			<div class="clear"></div>
			
			<?php endwhile; ?>
		
		</div><!-- /.inner -->
		
	</div><!-- /#featured .outer -->
	
	<?php } ?>
