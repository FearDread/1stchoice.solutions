<?php
/**
 * Footer content
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'corporate_plus_footer' ) ) :

    function corporate_plus_footer() {

        global $corporate_plus_customizer_all_values;
        ?>
    <div class="clearfix"></div>
	<footer class="site-footer">
		<div class="container">
            <?php if( isset( $corporate_plus_customizer_all_values['corporate-plus-footer-copyright'] ) ): ?>
                <p class="init-animate text-center animated fadeInLeft">
                    <?php echo wp_kses_post( $corporate_plus_customizer_all_values['corporate-plus-footer-copyright'] ); ?>
                </p>
            <?php endif; ?>
            <?php
             if ( 1 == $corporate_plus_customizer_all_values['corporate-plus-enable-social'] ) {
                    /**
                     * Social Sharing
                     * corporate_plus_action_social_links
                     * @since Corporate Plus 1.1.0
                     *
                     * @hooked corporate_plus_social_links -  10
                     */
                    do_action('corporate_plus_action_social_links');
                }
             ?>
			<div class="clearfix"></div>
			<div class="footer-copyright border text-center init-animate animated fadeInRight">
                <div class="site-info">
                    <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'corporate-plus' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'corporate-plus' ), 'WordPress' ); ?></a>
                    <span class="sep"> | </span>
                    <?php printf( esc_html__( 'Theme: %1$s by %2$s', 'corporate-plus' ), 'Corporate Plus', '<a href="http://www.acmethemes.com/" rel="designer">AcmeThemes</a>' ); ?>
                </div><!-- .site-info -->
            </div>
            <a href="#page" class="sm-up-container"><i class="fa fa-arrow-circle-up sm-up"></i></a>
		</div>
    </footer>
    <?php
    }
endif;
add_action( 'corporate_plus_action_footer', 'corporate_plus_footer', 10 );

/**
 * Page end
 *
 * @since Corporate Plus 1.1.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'corporate_plus_page_end' ) ) :

    function corporate_plus_page_end() {
        ?>
        </div><!-- #page -->
    <?php
    }
endif;
add_action( 'corporate_plus_action_after', 'corporate_plus_page_end', 10 );