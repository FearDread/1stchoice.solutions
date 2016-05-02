<?php
/*customizing default colors section and adding new controls-setting too*/
$wp_customize->add_section( 'colors', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Colors', 'corporate-plus' ),
    'panel'          => 'corporate-plus-design-panel'
) );
/*Primary color*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-primary-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-primary-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'corporate_plus_theme_options[corporate-plus-primary-color]',
        array(
            'label'		=> __( 'Primary Color', 'corporate-plus' ),
            'section'   => 'colors',
            'settings'  => 'corporate_plus_theme_options[corporate-plus-primary-color]',
            'type'	  	=> 'color'
        ) )
);