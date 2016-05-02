<?php
/*adding sections for breadcrumb */
$wp_customize->add_section( 'corporate-plus-breadcrumb-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Breadcrumb Options', 'corporate-plus' ),
    'panel'          => 'corporate-plus-options'
) );

/*show breadcrumb*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-show-breadcrumb]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-show-breadcrumb'],
    'sanitize_callback' => 'corporate_plus_sanitize_checkbox'
) );

$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-show-breadcrumb]', array(
    'label'		=> __( 'Enable Breadcrumb', 'corporate-plus' ),
    'section'   => 'corporate-plus-breadcrumb-options',
    'settings'  => 'corporate_plus_theme_options[corporate-plus-show-breadcrumb]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );