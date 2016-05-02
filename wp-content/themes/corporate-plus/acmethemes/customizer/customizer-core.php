<?php
/**
 * Featured Slider Number
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return array $corporate_plus_featured_slider_number
 *
 */
if ( !function_exists('corporate_plus_featured_slider_number') ) :
    function corporate_plus_featured_slider_number() {
        $corporate_plus_featured_slider_number =  array(
            1 => __( '1', 'corporate-plus' ),
            2 => __( '2', 'corporate-plus' ),
            3 =>  __( '3', 'corporate-plus' )
        );
        return apply_filters( 'corporate_plus_featured_slider_number', $corporate_plus_featured_slider_number );
    }
endif;

/**
 * Header logo/text display options alternative
 *
 * @since Corporate Plus 1.0.2
 *
 * @param null
 * @return array $corporate_plus_header_id_display_opt
 *
 */
if ( !function_exists('corporate_plus_header_id_display_opt') ) :
    function corporate_plus_header_id_display_opt() {
        $corporate_plus_header_id_display_opt =  array(
            'logo-only' => __( 'Logo Only ( First Select Logo Above )', 'corporate-plus' ),
            'title-only' => __( 'Site Title Only', 'corporate-plus' ),
            'title-and-tagline' =>  __( 'Site Title and Tagline', 'corporate-plus' ),
            'disable' => __( 'Disable', 'corporate-plus' )
        );
        return apply_filters( 'corporate_plus_header_id_display_opt', $corporate_plus_header_id_display_opt );
    }
endif;


/**
 * Sidebar layout options
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return array $corporate_plus_sidebar_layout
 *
 */
if ( !function_exists('corporate_plus_sidebar_layout') ) :
    function corporate_plus_sidebar_layout() {
        $corporate_plus_sidebar_layout =  array(
            'right-sidebar'=> __( 'Right Sidebar', 'corporate-plus' ),
            'left-sidebar'=> __( 'Left Sidebar' , 'corporate-plus' ),
            'no-sidebar'=> __( 'No Sidebar', 'corporate-plus' )
        );
        return apply_filters( 'corporate_plus_sidebar_layout', $corporate_plus_sidebar_layout );
    }
endif;


/**
 * Blog layout options
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return array $corporate_plus_blog_layout
 *
 */
if ( !function_exists('corporate_plus_blog_layout') ) :
    function corporate_plus_blog_layout() {
        $corporate_plus_blog_layout =  array(
            'left-image' => __( 'Left Image', 'corporate-plus' ),
            'no-image' => __( 'No Image', 'corporate-plus' )
        );
        return apply_filters( 'corporate_plus_blog_layout', $corporate_plus_blog_layout );
    }
endif;


/**
 * Related posts layout options
 *
 * @since Corporate Plus 1.1.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('corporate_plus_reset_options') ) :
    function corporate_plus_reset_options() {
        $corporate_plus_reset_options =  array(
            '0'  => __( 'Do Not Reset', 'corporate-plus' ),
            'reset-color-options'  => __( 'Reset Colors Options', 'corporate-plus' ),
            'reset-all' => __( 'Reset All', 'corporate-plus' )
        );
        return apply_filters( 'corporate_plus_reset_options', $corporate_plus_reset_options );
    }
endif;

/**
 *  Default Theme layout options
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return array $corporate_plus_theme_layout
 *
 */
if ( !function_exists('corporate_plus_get_default_theme_options') ) :
    function corporate_plus_get_default_theme_options() {

        $default_theme_options = array(
            /*feature section options*/
            'corporate-plus-feature-page'  => 0,
            'corporate-plus-featured-slider-number'  => 2,
            'corporate-plus-go-down'  => '',
            'corporate-plus-enable-feature'  => 1,

            /*header options*/
            'corporate-plus-header-logo'  => '',
            'corporate-plus-header-id-display-opt' => 'title-and-tagline',
            'corporate-plus-facebook-url'  => '',
            'corporate-plus-twitter-url'  => '',
            'corporate-plus-youtube-url'  => '',
            'corporate-plus-enable-social'  => 0,

            /*footer options*/
            'corporate-plus-footer-copyright'  => __( '&copy; All right reserved 2016', 'corporate-plus' ),

            /*layout/design options*/
            'corporate-plus-sidebar-layout'  => 'right-sidebar',
            'corporate-plus-blog-archive-layout'  => 'left-image',
            'corporate-plus-primary-color'  => '#F88C00',
            'corporate-plus-custom-css'  => '',

            /*theme options*/
            'corporate-plus-search-placholder'  => __( 'Search', 'corporate-plus' ),
            'corporate-plus-show-breadcrumb'  => 0,

            /*Reset*/
            'corporate-plus-reset-options'  => '0'
        );

        return apply_filters( 'corporate_plus_default_theme_options', $default_theme_options );
    }
endif;


/**
 *  Get theme options
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return array corporate_plus_theme_options
 *
 */
if ( !function_exists('corporate_plus_get_theme_options') ) :
    function corporate_plus_get_theme_options() {

        $corporate_plus_default_theme_options = corporate_plus_get_default_theme_options();
        $corporate_plus_get_theme_options = get_theme_mod( 'corporate_plus_theme_options');
        if( is_array( $corporate_plus_get_theme_options )){
            return array_merge( $corporate_plus_default_theme_options ,$corporate_plus_get_theme_options );
        }
        else{
            return $corporate_plus_default_theme_options;
        }

    }
endif;