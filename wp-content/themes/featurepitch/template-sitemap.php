<?php
/*
Template Name: Sitemap
*/
?>

<?php get_header(); ?>

	<div id="main_content" class="outer">
	
		<div class="inner">
		
			<div id="content">
				
				<?php if ( get_option( 'woo_breadcrumbs' ) == 'true') { yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>'); } ?>
				
				<div id="sitemap">
		
					<div class="block">
								
						<h2><?php _e('Pages', 'woothemes' ); ?></h2>
					
						<ul>
							<?php wp_list_pages('depth=1&sort_column=menu_order&title_li=' ); ?>		
						</ul>				

					</div><!-- /.block -->
							
					<div class="block">
						
						<h2><?php _e('Categories', 'woothemes' ); ?></h2>
					
						<ul>
							<?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
						</ul>	
					
					</div>     <!-- /.block -->               

					<div class="block">
					
						<h2><?php _e('Blog posts by category', 'woothemes' ); ?></h2>
						
						<?php
						
							$cats = get_categories();
							foreach ($cats as $cat) {
						
							query_posts('cat='.$cat->cat_ID);
					
						?>
							
						<h3><?php echo $cat->cat_name; ?></h3>
			
						<ul>	
								<?php while (have_posts()) : the_post(); ?>
								<li style="font-weight:normal !important;"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php _e('Comments', 'woothemes' ); ?> (<?php echo $post->comment_count ?>)</li>
								<?php endwhile;  ?>
						</ul>
						
						<?php } ?>					
					</div><!-- /.block -->
			
				<div class="clear"></div>
					
				</div><!-- /#sitemap -->
					
			</div><!-- /#content -->
			
			<?php get_sidebar(); ?>
			
			<div class="clear"></div>
			
		</div><!-- /.inner -->
	
	</div><!-- /#main_content .outer -->
			
<?php get_footer(); ?>