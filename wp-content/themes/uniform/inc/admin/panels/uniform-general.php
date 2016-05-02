<?php
/**
 * General Settings Panel and respective sections 
 * 
 * @package Uniform
 */
 
 add_action( 'customize_register', 'uniform_general_settings_register' );
 
 function uniform_general_settings_register( $wp_customize ) {
    
    $wp_customize->get_section( 'title_tagline' )->panel = 'uniform_general_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = '3';
    $wp_customize->get_section( 'background_image' )->panel = 'uniform_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->priority = '4';
    $wp_customize->get_section( 'static_front_page' )->panel = 'uniform_general_settings_panel';
    $wp_customize->get_section( 'static_front_page' )->priority = '5';
    
    /**
     * Add General Settings Panel 
     */
    $wp_customize->add_panel( 
        'uniform_general_settings_panel', 
        array(
            'priority'       => 3,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'General Settings', 'uniform' ),
            ) 
        );
/*======================================================================================================================*/
    /**
     * Website layout
     */
    
    $wp_customize->add_section(
        'uniform_site_layout',
        array(
            'title'         => __( 'Website Layout', 'uniform' ),
            'description'   => __( 'Choose site layout which shows your website more effective.', 'uniform' ),
            'priority'      => 5,
            'panel'         => 'uniform_general_settings_panel',
        )
    );
    
    $wp_customize->add_setting(
        'site_layout_option',
        array(
            'default'           => 'wide_layout',
            'sanitize_callback' => 'uniform_sanitize_site_layout',
        )       
    );
    $wp_customize->add_control(
        'site_layout_option',
        array(
            'type' => 'radio',
            'priority'    => 7,
            'label' => __( 'Site Layout', 'uniform' ),
            'section' => 'uniform_site_layout',
            'choices' => array(
                'wide_layout' => __( 'Wide Layout', 'uniform' ),
                'boxed_layout' => __( 'Boxed Layout', 'uniform' )
            ),
        )
    );
 }