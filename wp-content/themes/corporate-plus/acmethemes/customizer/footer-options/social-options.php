<?php
/*adding sections for footer social options */
$wp_customize->add_section( 'corporate-plus-footer-social', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Social Options', 'corporate-plus' ),
    'panel'          => 'corporate-plus-footer-panel'
) );

/*facebook url*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-facebook-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-facebook-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-facebook-url]', array(
    'label'		=> __( 'Facebook url', 'corporate-plus' ),
    'section'   => 'corporate-plus-footer-social',
    'settings'  => 'corporate_plus_theme_options[corporate-plus-facebook-url]',
    'type'	  	=> 'url',
    'priority'  => 10
) );

/*twitter url*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-twitter-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-twitter-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-twitter-url]', array(
    'label'		=> __( 'Twitter url', 'corporate-plus' ),
    'section'   => 'corporate-plus-footer-social',
    'settings'  => 'corporate_plus_theme_options[corporate-plus-twitter-url]',
    'type'	  	=> 'url',
    'priority'  => 20
) );

/*youtube url*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-youtube-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-youtube-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-youtube-url]', array(
    'label'		=> __( 'Youtube url', 'corporate-plus' ),
    'section'   => 'corporate-plus-footer-social',
    'settings'  => 'corporate_plus_theme_options[corporate-plus-youtube-url]',
    'type'	  	=> 'url',
    'priority'  => 30
) );

/*enable social*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-enable-social]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-enable-social'],
    'sanitize_callback' => 'corporate_plus_sanitize_checkbox',
) );
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-enable-social]', array(
    'label'		=> __( 'Enable social', 'corporate-plus' ),
    'section'   => 'corporate-plus-footer-social',
    'settings'  => 'corporate_plus_theme_options[corporate-plus-enable-social]',
    'type'	  	=> 'checkbox',
    'priority'  => 40
) );