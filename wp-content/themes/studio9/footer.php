<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
	global $woo_options;

	$total = 4;
	if ( isset( $woo_options['woo_footer_sidebars'] ) && ( $woo_options['woo_footer_sidebars'] != '' ) ) {
		$total = $woo_options['woo_footer_sidebars'];
	}

?>

</div><!-- /#wrapper -->

	
<?php woo_footer_before(); ?>

<div id="footer-wrapper">

	<?php

		if ( ( woo_active_sidebar( 'footer-1' ) ||
			   woo_active_sidebar( 'footer-2' ) ||
			   woo_active_sidebar( 'footer-3' ) ||
			   woo_active_sidebar( 'footer-4' ) ) && $total > 0 ) {

	?>
		
	<section id="footer-widgets" class="col-full col-<?php echo $total; ?> fix">

		<?php $i = 0; while ( $i < $total ) { $i++; ?>
			<?php if ( woo_active_sidebar( 'footer-' . $i ) ) { ?>

		<div class="block footer-widget-<?php echo $i; ?>">
        	<?php woo_sidebar( 'footer-' . $i ); ?>
		</div>

	        <?php } ?>
		<?php } // End WHILE Loop ?>

	</section><!-- /#footer-widgets  -->
	<?php } // End IF Statement ?>
	<!-- /#footer  -->
	<!-- /#echo logos of clients if entered in theme options.  -->
	<?php $logoslidefoot = get_option( 'woo_footer_logos' ); 
		if ( $logoslidefoot != '' ) {
	?>
			<section class="slide-footer col-full fix">
				<ul class="jcarousel3 slide2">
				<?php echo stripslashes( $logoslidefoot ) . "\n" ?>
				</ul>
			</section>
	<?php	} // End logo slider section ?>


</div><!-- /#footer-wrapper  -->
<footer id="footer">
<div class="footer-short">

		<div id="credit" class="col-right">
		
		<?php
		if ( isset( $woo_options['woo_footer_right'] ) && $woo_options['woo_footer_right'] == 'true' ) {

        	echo stripslashes($woo_options['woo_footer_right_text']);

		} else { ?>
			<p><?php _e( 'Powered by', 'woothemes' ); ?> <a href="http://www.mafiashare.net">WordPress</a>.</p>
		<?php } ?>
		</div>

		<div id="copyright" class="col-left">
		<?php if( isset( $woo_options['woo_footer_left'] ) && $woo_options['woo_footer_left'] == 'true' ) {
				echo stripslashes( $woo_options['woo_footer_left_text'] );
		} else { ?>
			<p><?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <a href="http://www.siteslike.com">siteslike</a></p>
		<?php } ?>
		</div>
</div>
	</footer>
<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>