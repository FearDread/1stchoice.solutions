<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Uniform
 */

?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer clearfix" role="contentinfo">
        <?php get_sidebar( 'footer' ); ?>
		<div class="site-info">
            <div class="mt-container">
    			<span class="copyright-text">&copy; <?php echo date('Y');?></span><span class="uniform-sitename"> <?php bloginfo( 'name' );?></span>
                <span class="sep"> | </span>
    			<?php 
                    $designer_ur = 'http://mysterythemes.com/';
                    printf( esc_html__( 'Theme: %1$s by %2$s.', 'uniform' ), 'Uniform', '<a href="'. esc_url( $designer_ur ) .'" rel="designer">Mystery Themes</a>' ); ?>
            </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
    
    <a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
