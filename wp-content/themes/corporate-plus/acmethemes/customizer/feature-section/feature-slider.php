<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'corporate-plus-feature-page', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Feature Slider Selection', 'corporate-plus' ),
    'panel'          => 'corporate-plus-feature-panel'
) );

/* feature parent page selection */
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-feature-page]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-feature-page'],
    'sanitize_callback' => 'corporate_plus_sanitize_number'
) );
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-feature-page]', array(
    'label'		    => __( 'Select Parent Page for Feature Slider', 'corporate-plus' ),
    'description'   => __( 'Select parent page and its sub-pages will be shown is slider. Please note that the slider background image can be set from Header-Options -> Header Image', 'corporate-plus' ),
    'section'       => 'corporate-plus-feature-page',
    'settings'      => 'corporate_plus_theme_options[corporate-plus-feature-page]',
    'type'	  	    => 'dropdown-pages',
    'priority'      => 10
) );

/* number of slider*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-featured-slider-number]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-featured-slider-number'],
    'sanitize_callback' => 'corporate_plus_sanitize_select'
) );
$choices = corporate_plus_featured_slider_number();
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-featured-slider-number]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Number Of Slider', 'corporate-plus' ),
    'section'   => 'corporate-plus-feature-page',
    'settings'  => 'corporate_plus_theme_options[corporate-plus-featured-slider-number]',
    'type'	  	=> 'select',
    'priority'  => 20
) );

/*go down id*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-go-down]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-go-down'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-go-down]', array(
    'label'		    => __( 'Enter Link Url', 'corporate-plus' ),
    'description'   => __( 'For scroll down, please enter id with hash. For eg: #id-of-section ', 'corporate-plus' ),
    'section'       => 'corporate-plus-feature-page',
    'settings'      => 'corporate_plus_theme_options[corporate-plus-go-down]',
    'type'	  	    => 'text',
    'priority'      => 30
) );