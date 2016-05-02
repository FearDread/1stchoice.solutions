<?php global $woo_options; ?>
    
    <div id="footer">


	<?php if ( woo_active_sidebar('footer-1') ||
			   woo_active_sidebar('footer-2') || 
			   woo_active_sidebar('footer-3') || 
			   woo_active_sidebar('footer-4') ) : ?>
	<div id="footer-widgets" class="col-full">

		<div class="block">
        	<?php woo_sidebar('footer-1'); ?>    
		</div>
		<div class="block">
        	<?php woo_sidebar('footer-2'); ?>    
		</div>
		<div class="block">
        	<?php woo_sidebar('footer-3'); ?>    
		</div>
		<div class="block last">
        	<?php woo_sidebar('footer-4'); ?>    
		</div>
		<div class="fix"></div>

	</div><!-- /#footer-widgets  -->
    <?php endif; ?>
    
		<div class="col-full">
		
			<div class="col-left">

				<div id="copyright">
				<?php if($woo_options['woo_footer_left'] == 'true'){
				
						echo stripslashes($woo_options['woo_footer_left_text']);	
		
				} else { ?>
					<p><span><?php bloginfo(); ?></span> &copy; <?php echo date('Y'); ?>. <?php _e('All Rights Reserved.', 'woothemes') ?></p>
				<?php } ?>
				</div>
				
			</div><!-- /.col-left  -->
			
			<div class="col-right">
			
				<div id="credit">
		        <?php if($woo_options['woo_footer_right'] == 'true'){
				
		        	echo stripslashes($woo_options['woo_footer_right_text']);
		       	
				} else { ?>
					<p><?php _e('Powered by', 'woothemes') ?> <a href="http://www.siteslike.com">SitesLike</a>.  <?php _e('Designed by', 'woothemes') ?> <a href="<?php $aff = $woo_options['woo_footer_aff_link']; if(!empty($aff)) { echo $aff; } else { echo 'http://www.woothemes.com'; } ?>"><img src="<?php bloginfo('template_directory'); ?>/images/woothemes.png" width="74" height="19" alt="Woo Themes" /></a></p>
				<?php } ?>
				</div>
						
			</div><!-- /.col-right  -->
			
		</div><!-- /.col-full  -->
		
	</div><!-- /#footer  -->

</div><!-- /#wrapper -->
<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>