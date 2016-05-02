<?php
/*adding sections for Search Placeholder*/
$wp_customize->add_section( 'corporate-plus-search', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Search', 'corporate-plus' ),
    'panel'          => 'corporate-plus-options'
) );

/*Search Placeholder*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-search-placholder]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-search-placholder'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-search-placholder]', array(
    'label'		=> __( 'Search Placeholder', 'corporate-plus' ),
    'section'   => 'corporate-plus-search',
    'settings'  => 'corporate_plus_theme_options[corporate-plus-search-placholder]',
    'type'	  	=> 'text',
    'priority'  => 10
) );