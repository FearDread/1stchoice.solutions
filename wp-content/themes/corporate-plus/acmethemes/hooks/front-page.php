<?php
/**
 * Front page hook for all WordPress Conditions
 *
 * @since Corporate Plus 1.1.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'corporate_plus_featured_slider' ) ) :

    function corporate_plus_featured_slider(){
        global $corporate_plus_customizer_all_values;

        $corporate_plus_enable_feature = $corporate_plus_customizer_all_values['corporate-plus-enable-feature'];
        if( is_front_page() && !is_home() && is_active_sidebar( 'corporate-plus-home' ) && 1 == $corporate_plus_enable_feature  ) :
            do_action( 'corporate_plus_action_feature_slider' );
        endif;
    }

endif;
add_action( 'corporate_plus_action_front_page', 'corporate_plus_featured_slider', 10 );

if ( ! function_exists( 'corporate_plus_front_page' ) ) :

    function corporate_plus_front_page() {

        if ( 'posts' == get_option( 'show_on_front' ) ) {
            include( get_home_template() );
        }
        elseif( is_active_sidebar( 'corporate-plus-home' ) ){
            dynamic_sidebar( 'corporate-plus-home' );
        }
        else {
            include( get_page_template() );
        }

    }
endif;
add_action( 'corporate_plus_action_front_page', 'corporate_plus_front_page', 20 );