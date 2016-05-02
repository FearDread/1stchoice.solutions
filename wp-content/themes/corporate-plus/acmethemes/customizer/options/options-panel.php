<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'corporate-plus-options', array(
    'priority'       => 210,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Theme Options', 'corporate-plus' ),
    'description'    => __( 'Customize your awesome site with theme options ', 'corporate-plus' )
) );

/*
* file for header breadcrumb options
*/
require_once get_template_directory() . '/acmethemes/customizer/options/breadcrumb.php';


/*
* file for header search options
*/
require_once get_template_directory() . '/acmethemes/customizer/options/search.php';