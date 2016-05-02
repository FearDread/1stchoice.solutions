	<div id="footer" class="outer">
	
		<div class="inner">
			
			<?php if ( get_option( 'woo_footer_left' ) <> "" ) { ?>
		
			<div id="about">
				
				<?php query_posts('page_id=' . get_option( 'woo_footer_left' ) ); while (have_posts()) : the_post(); ?>
			
				<h3><?php the_title(); ?></h3>
				
				<?php the_content(); ?>

				<p id="copyright"><?php _e('Copyright', 'woothemes' ); ?> &copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>. Powered by <a href="http://www.siteslike.com">SitesLike</a></p>
				
				<?php endwhile; ?>
			
			</div><!-- /#about -->
			
			<?php } ?>
			
			<?php if ( get_option( 'woo_footer_right' ) <> "" ) { ?>
			
			<div id="contact">
			
				<?php query_posts('page_id=' . get_option( 'woo_footer_right' ) ); while (have_posts()) : the_post(); ?>
			
				<h3><?php the_title(); ?></h3>
				
				<?php the_content(); ?>
				
				<?php endwhile; ?>
				
			</div><!-- /#contact -->
			
			<?php } ?>
			
			<div class="clear"></div>
			
		</div><!-- .inner -->
	
	</div><!-- /#footer .outer -->

</div><!-- /container -->

<?php wp_footer(); ?>

</body>
</html>