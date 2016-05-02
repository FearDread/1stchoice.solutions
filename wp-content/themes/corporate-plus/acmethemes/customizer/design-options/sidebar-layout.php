<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'corporate-plus-design-sidebar-layout-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Sidebar Layout', 'corporate-plus' ),
    'panel'          => 'corporate-plus-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-sidebar-layout'],
    'sanitize_callback' => 'corporate_plus_sanitize_select'
) );
$choices = corporate_plus_sidebar_layout();
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-sidebar-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Sidebar Layout', 'corporate-plus' ),
    'description'    => __( 'Generally home/front page does not have sidebar', 'corporate-plus' ),
    'section'   => 'corporate-plus-design-sidebar-layout-option',
    'settings'  => 'corporate_plus_theme_options[corporate-plus-sidebar-layout]',
    'type'	  	=> 'select'
) );