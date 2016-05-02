<?php
/**
 * Corporate Plus Theme Customizer.
 *
 * @package AcmeThemes
 * @subpackage Corporate Plus
 */

/*
* file for customizer core functions
*/
require_once get_template_directory() . '/acmethemes/customizer/customizer-core.php';

/*
* file for customizer sanitization functions
*/
require_once get_template_directory() . '/acmethemes/customizer/sanitize-functions.php';

/**
 * Adding different options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function corporate_plus_customize_register( $wp_customize ) {

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

    /*saved options*/
    $options  = corporate_plus_get_theme_options();

    /*defaults options*/
    $defaults = corporate_plus_get_default_theme_options();

    /*
     * file for feature panel of home page
     */
    require_once get_template_directory() . '/acmethemes/customizer/feature-section/feature-panel.php';

    /*
    * file for header panel
    */
    require_once get_template_directory() . '/acmethemes/customizer/header-options/header-panel.php';

    /*
    * file for customizer footer section
    */
    require_once get_template_directory() . '/acmethemes/customizer/footer-options/footer-panel.php';

    /*
    * file for design/layout panel
    */
    require_once get_template_directory() . '/acmethemes/customizer/design-options/design-panel.php';

    /*
     * file for options panel
     */
    require_once get_template_directory() . '/acmethemes/customizer/options/options-panel.php';

    /*
  * file for options reset
  */
    require_once get_template_directory() . '/acmethemes/customizer/options/options-reset.php';

    /*removing*/
    $wp_customize->remove_panel('header_image');
    $wp_customize->remove_control('header_textcolor');
}
add_action( 'customize_register', 'corporate_plus_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function corporate_plus_customize_preview_js() {
    wp_enqueue_script( 'corporate-plus-customizer', get_template_directory_uri() . '/acmethemes/core/js/customizer.js', array( 'customize-preview' ), '1.1.0', true );
}
add_action( 'customize_preview_init', 'corporate_plus_customize_preview_js' );



/**
 * Enqueue scripts for customizer
 */
function corporate_plus_customizer_js() {
    wp_enqueue_script('corporate-plus-customizer', get_template_directory_uri() . '/assets/js/corporate-plus-customizer.js', array('jquery'), '1.3.0', 1);

    wp_localize_script( 'corporate-plus-customizer', 'corporate_plus_customizer_js_obj', array(
        'pro' => __('Upgrade To Pro','corporate-plus')
    ) );
    wp_enqueue_style( 'corporate-plus-customizer', get_template_directory_uri() . '/assets/css/corporate-plus-customizer.css');
}
add_action( 'customize_controls_enqueue_scripts', 'corporate_plus_customizer_js' );


/**
 * Theme Update Script
 *
 * For backward compatibility
 */
function corporate_plus_update_check() {

    global $wp_version;
    // Return if wp version less than 4.5
    if ( version_compare( $wp_version, '4.5', '<' ) ) {
        return;
    }
    $corporate_plus_saved_theme_options = corporate_plus_get_theme_options();
    $site_logo = '';
    if( isset( $corporate_plus_saved_theme_options['corporate-plus-header-logo'] )){
        $site_logo = esc_url( $corporate_plus_saved_theme_options['corporate-plus-header-logo'] );
    }
    if ( empty( $site_logo ) ) {
        return;
    }
    /*converting url into attachment ID*/
    $logo = attachment_url_to_postid( $site_logo );
    if ( is_int( $logo ) ) {
        set_theme_mod( 'custom_logo', attachment_url_to_postid( $site_logo ) );
        $corporate_plus_saved_theme_options['corporate-plus-header-logo'] = '';
        set_theme_mod( 'corporate_plus_theme_options', $corporate_plus_saved_theme_options );
    }

}
add_action( 'after_setup_theme', 'corporate_plus_update_check' );