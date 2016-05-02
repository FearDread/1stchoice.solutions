<?php
/**
 * Display Social Links
 *
 * @since Corporate Plus 1.1.0
 *
 * @param null
 * @return void
 *
 */

if ( !function_exists('corporate_plus_social_links') ) :

    function corporate_plus_social_links( ) {

        global $corporate_plus_customizer_all_values;
        ?>
        <ul class="socials text-center init-animate animated fadeInRight">
            <?php
            if ( !empty( $corporate_plus_customizer_all_values['corporate-plus-facebook-url'] ) ) { ?>
                <li class="facebook">
                    <a href="<?php echo esc_url( $corporate_plus_customizer_all_values['corporate-plus-facebook-url'] ); ?>" data-title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                </li>
            <?php }
            if ( !empty( $corporate_plus_customizer_all_values['corporate-plus-twitter-url'] ) ) { ?>
                <li class="twitter">
                    <a href="<?php echo esc_url( $corporate_plus_customizer_all_values['corporate-plus-twitter-url'] ); ?>" data-title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                </li>
            <?php }
            if ( !empty( $corporate_plus_customizer_all_values['corporate-plus-youtube-url'] ) ) { ?>
                <li class="youtube">
                    <a href="<?php echo esc_url( $corporate_plus_customizer_all_values['corporate-plus-youtube-url'] ); ?>" class="youtube" data-title="Youtube" target="_blank"><i class="fa fa-youtube"></i></a>
                </li>
            <?php } ?>
        </ul>
        <?php
    }

endif;

add_filter( 'corporate_plus_action_social_links', 'corporate_plus_social_links', 10 );