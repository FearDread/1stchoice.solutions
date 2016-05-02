<?php get_header(); ?>

	<?php include( TEMPLATEPATH . '/includes/featured.php'); ?>

	<div id="main_content" class="outer">
	
		<div class="inner">

			<?php 
						
				$featpages = get_option('woo_feat_pages');
				$featarr=split(",",$featpages);
				$featarr = array_diff($featarr, array(""));
						
				$i = 0;
                
                if(get_option('woo_homepage_image_link') == 'true'){$home_image_link = true;} else {$home_image_link = false;}
						
				foreach ( $featarr as $featured_tab ) {
							
					query_posts('page_id=' . $featured_tab); while (have_posts()) : the_post();    
					
					$i++;

			?>			
			
				<div class="item <?php if ( $i == 3 ) { echo 'last'; } ?>">
				
					<?php woo_get_image('image',get_option('woo_minifeat_width'),get_option('woo_minifeat_height'),'minifeat',90,get_the_id(),'src',1,0,'','',$home_image_link); ?>
					
					<h2><?php the_title(); ?></h2>
					
					<p><?php if ( get_post_meta($post->ID, "page_excerpt", $single = true) <> "" ) { echo get_post_meta($post->ID, "page_excerpt", $single = true); } else { the_excerpt(); } ?> <a class="more_info" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('More Info', 'woothemes' ); ?></a></p>
				
				</div><!-- /.item -->
				
				<?php if ( $i == 3 ) { echo '<div class="clear"></div>'; $i = 0; } ?>
			
			<?php endwhile; } ?>
				
			<div class="clear"></div>
			
		</div><!-- /.inner -->
	
	</div><!-- /#main_content .outer -->

<?php get_footer(); ?>