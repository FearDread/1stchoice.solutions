<?php get_header(); ?>

	<div id="main_content" class="outer">
	
		<div class="inner">
		
			<div id="content">
				
				<div id="breadcrumb"><p><?php _e('You are here', 'woothemes' ); ?>: <a href="<?php bloginfo('url'); ?>" title="<?php _e('Go Home', 'woothemes' ); ?>"><?php _e('Home', 'woothemes' ); ?></a> &raquo; <?php _e('404 Error', 'woothemes' ); ?></p></div>
				
				<div id="posts">
				
					<div class="post">		
						
						<div class="entry">

							<p><?php _e('Sorry nothing to be found here!', 'woothemes' ); ?></p>
						
						</div><!-- /.entry -->
					
					</div><!-- /.post -->
			
					<div class="clear"></div>		
				
				</div><!-- /#posts -->
					
			</div><!-- /#content -->
			
			<?php get_sidebar(); ?>
			
			<div class="clear"></div>
			
		</div><!-- /.inner -->
	
	</div><!-- /#main_content .outer -->
			
<?php get_footer(); ?>