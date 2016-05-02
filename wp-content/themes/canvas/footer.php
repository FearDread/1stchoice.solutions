<?php
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
 
 global $woo_options;

 woo_footer_top();
 	woo_footer_before();
?>
	<div id="footer" class="col-full">
	
		<?php woo_footer_inside(); ?>    
	    
		<div id="copyright" class="col-left">
			<?php woo_footer_left(); ?>
		</div>
		
		<div id="credit" class="col-right">
			<p>Powered by <a href="http://www.siteslike.com">SitesLike</a></p>
		</div>
		
	</div><!-- /#footer  -->
	
	<?php woo_footer_after(); ?>    
	
	</div><!-- /#wrapper -->
	
	<div class="fix"></div><!--/.fix-->
	
	<?php wp_footer(); ?>
	<?php woo_foot(); ?>
	</body>
</html>