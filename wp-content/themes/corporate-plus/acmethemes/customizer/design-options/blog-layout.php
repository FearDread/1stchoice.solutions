<?php
/*adding sections for blog layout options*/
$wp_customize->add_section( 'corporate-plus-design-blog-layout-option', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Blog/Archive Layout', 'corporate-plus' ),
    'panel'          => 'corporate-plus-design-panel'
) );

/*blog layout*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-blog-archive-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-blog-archive-layout'],
    'sanitize_callback' => 'corporate_plus_sanitize_select'
) );
$choices = corporate_plus_blog_layout();
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-blog-archive-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Blog/Archive Layout', 'corporate-plus' ),
    'description'=> __( 'Image display options', 'corporate-plus' ),
    'section'   => 'corporate-plus-design-blog-layout-option',
    'settings'  => 'corporate_plus_theme_options[corporate-plus-blog-archive-layout]',
    'type'	  	=> 'select'
) );