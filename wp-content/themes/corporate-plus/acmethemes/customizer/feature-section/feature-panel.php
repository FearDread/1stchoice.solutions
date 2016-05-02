<?php
/*adding feature options panel*/
$wp_customize->add_panel( 'corporate-plus-feature-panel', array(
    'priority'       => 160,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Featured Section Options', 'corporate-plus' ),
    'description'    => __( 'Customize your awesome site feature section ', 'corporate-plus' )
) );

/*
* file for feature slider category
*/
require_once get_template_directory() . '/acmethemes/customizer/feature-section/feature-slider.php';


/*
* file for feature section enable
*/
require_once get_template_directory() . '/acmethemes/customizer/feature-section/feature-enable.php';