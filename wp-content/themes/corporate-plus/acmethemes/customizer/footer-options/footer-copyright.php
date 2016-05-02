<?php
/*adding sections for footer options*/
$wp_customize->add_section( 'corporate-plus-footer-option', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Copyright Text', 'corporate-plus' ),
    'panel'          => 'corporate-plus-footer-panel',
) );

/*copyright*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-footer-copyright]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-footer-copyright'],
    'sanitize_callback' => 'wp_kses_post'
) );
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-footer-copyright]', array(
    'label'		=> __( 'Copyright Text', 'corporate-plus' ),
    'section'   => 'corporate-plus-footer-option',
    'settings'  => 'corporate_plus_theme_options[corporate-plus-footer-copyright]',
    'type'	  	=> 'text',
    'priority'  => 2
) );