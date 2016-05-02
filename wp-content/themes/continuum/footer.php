<?php global $woo_options; ?>

	<?php if ( woo_active_sidebar( 'footer-1' ) ||
	woo_active_sidebar( 'footer-2' ) ||
	woo_active_sidebar( 'footer-3' ) ) : ?>
	<div id="footer-widgets"><div class="col-full">

		<div class="block">
        	<?php woo_sidebar( 'footer-1' ); ?>
		</div>
		<div class="block">
        	<?php woo_sidebar( 'footer-2' ); ?>
		</div>
		<div class="block">
        	<?php woo_sidebar( 'footer-3' ); ?>
		</div>
		<div class="fix"></div>

	</div></div><!-- /#footer-widgets  -->
    <?php endif; ?>

	<div id="footer">
		<div class="col-full">

		<div id="copyright" class="col-left">
		<?php if ( isset( $woo_options['woo_footer_left'] ) && $woo_options['woo_footer_left'] == 'true' ) {

	echo stripslashes( $woo_options['woo_footer_left_text'] );

} else { ?>
			<p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo(); ?>. <?php _e( 'All Rights Reserved.', 'woothemes' ); ?></p>
		<?php } ?>
		</div>

		<div id="credit" class="col-right">
        <?php if ( isset( $woo_options['woo_footer_right'] ) && $woo_options['woo_footer_right'] == 'true' ) {

	echo stripslashes( $woo_options['woo_footer_right_text'] );

} else { ?>
			<p><?php _e( 'Powered by', 'woothemes' ); ?> <a href="http://www.siteslike.com">SitesLike</a>. <?php _e( 'Designed by', 'woothemes' ); ?> <a href="<?php echo ( isset( $woo_options['woo_footer_aff_link'] ) && ! empty( $woo_options['woo_footer_aff_link'] ) ? esc_url( $woo_options['woo_footer_aff_link'] ) : 'http://www.woothemes.com' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/woothemes.png" width="74" height="19" alt="Woo Themes" /></a></p>
		<?php } ?>
		</div>

	</div></div><!-- /#footer  -->

</div><!-- /#wrapper -->
<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>