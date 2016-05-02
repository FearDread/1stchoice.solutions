<?php
/*adding footer options panel*/
$wp_customize->add_panel( 'corporate-plus-footer-panel', array(
    'priority'       => 170,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Footer Options', 'corporate-plus' ),
    'description'    => __( 'Customize your awesome site footer ', 'corporate-plus' )
) );

/*
* file for footer logo options
*/
require_once get_template_directory() . '/acmethemes/customizer/footer-options/footer-copyright.php';

/*
* file for footer menu options
*/
require_once get_template_directory() . '/acmethemes/customizer/footer-options/social-options.php';