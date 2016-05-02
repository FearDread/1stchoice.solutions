<?php
/*adding sections for custom css options */
$wp_customize->add_section( 'corporate-plus-design-custom-css-option', array(
    'priority'       => 60,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Custom CSS', 'corporate-plus' ),
    'panel'          => 'corporate-plus-design-panel'
) );

/*custom-css*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-custom-css]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-custom-css'],
    'sanitize_callback'    => 'wp_strip_all_tags'
) );
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-custom-css]', array(
    'label'		=> __( 'Custom CSS', 'corporate-plus' ),
    'section'   => 'corporate-plus-design-custom-css-option',
    'settings'  => 'corporate_plus_theme_options[corporate-plus-custom-css]',
    'type'	  	=> 'textarea',
    'priority'  => 2
) );