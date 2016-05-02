<?php
/**
 * Design Settings Panel and respective sections 
 * 
 * @package Uniform
 */
 
add_action( 'customize_register', 'uniform_design_settings_register' );

function uniform_design_settings_register( $wp_customize ) {

    $wp_customize->add_panel( 
        'uniform_design_panel', 
        array(
            'priority'       => 5,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Design Settings', 'uniform' ),
            ) 
    );


    $wp_customize->get_section( 'colors' )->panel = 'uniform_design_panel';
    $wp_customize->get_section( 'colors' )->priority = '3';

/*--------------------------------------------------------------------------------------------------------*/
  
  //Primary color
    $wp_customize->add_setting(
        'uniform_theme_color',
        array(
            'default'           => '#a0ce4e',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'uniform_theme_color',
            array(
                'label'         => __( 'Theme color', 'uniform' ),
                'section'       => 'colors',
                'settings'      => 'uniform_theme_color',
                'priority'      => 11
            )
        )
    );

  /**
   * Archive Page sidebar
   */
   $wp_customize->add_section(
        'uniform_archive_sidebar_section',
        array(
            'title'         => __( 'Archive Sidebar', 'uniform' ),
            'priority'      => 3,
            'panel'         => 'uniform_design_panel'
        )
    );
   
   // Archive Default layout
	$wp_customize->add_setting(
        'uniform_archive_sidebar', 
        array(
    		'default' => 'right_sidebar',
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'uniform_page_layout_sanitize'
	       )
    );

	$wp_customize->add_control( new Uniform_Image_Radio_Control(
        $wp_customize, 
        'uniform_archive_sidebar', 
        array(
    		'type' => 'radio',
    		'label' => __( 'Available layouts', 'uniform' ),
            'description' => __( 'Select layout for whole site archives, categories, search page etc.', 'uniform' ),
    		'section' => 'uniform_archive_sidebar_section',
            'priority'       => 3,
    		'choices' => array(
        			'right_sidebar' => UNIFORM_ADMIN_IMAGES_URL . '/right-sidebar.png',
        			'left_sidebar' => UNIFORM_ADMIN_IMAGES_URL . '/left-sidebar.png',
        			'no_sidebar_full_width'	=> UNIFORM_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
        		)
	       )
        )
    );
    
/*--------------------------------------------------------------------------------------------------------*/
  /**
   * Page sidebar
   */
   $wp_customize->add_section(
        'uniform_page_sidebar_section',
        array(
            'title'         => __( 'Page Sidebar', 'uniform' ),
            'priority'      => 4,
            'panel'         => 'uniform_design_panel'
        )
    );
   
   // Archive Default layout
	$wp_customize->add_setting(
        'uniform_default_page_sidebar', 
        array(
    		'default' => 'right_sidebar',
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'uniform_page_layout_sanitize'
	       )
    );

	$wp_customize->add_control( new Uniform_Image_Radio_Control(
        $wp_customize, 
        'uniform_default_page_sidebar', 
        array(
    		'type' => 'radio',
    		'label' => __( 'Available layouts', 'uniform' ),
            'description' => __( 'Select layout for all pages unless unique layout is set for specific page.', 'uniform' ),
    		'section' => 'uniform_page_sidebar_section',
            'priority'       => 3,
    		'choices' => array(
        			'right_sidebar' => UNIFORM_ADMIN_IMAGES_URL . '/right-sidebar.png',
        			'left_sidebar' => UNIFORM_ADMIN_IMAGES_URL . '/left-sidebar.png',
        			'no_sidebar_full_width'	=> UNIFORM_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
        		)
	       )
        )
    );
/*--------------------------------------------------------------------------------------------------------*/
  /**
   * Post sidebar
   */
   $wp_customize->add_section(
        'uniform_post_sidebar_section',
        array(
            'title'         => __( 'Post Sidebar', 'uniform' ),
            'priority'      => 5,
            'panel'         => 'uniform_design_panel'
        )
    );
   
   // Archive Default layout
	$wp_customize->add_setting(
        'uniform_default_single_posts_sidebar', 
        array(
    		'default' => 'right_sidebar',
            'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'uniform_page_layout_sanitize'
	       )
    );

	$wp_customize->add_control( new Uniform_Image_Radio_Control(
        $wp_customize, 
        'uniform_default_single_posts_sidebar', 
        array(
    		'type' => 'radio',
    		'label' => __( 'Available layouts', 'uniform' ),
            'description' => __( 'Select layout for all posts unless unique layout is set for specific page.', 'uniform' ),
    		'section' => 'uniform_post_sidebar_section',
            'priority'       => 3,
    		'choices' => array(
        			'right_sidebar' => UNIFORM_ADMIN_IMAGES_URL . '/right-sidebar.png',
        			'left_sidebar' => UNIFORM_ADMIN_IMAGES_URL . '/left-sidebar.png',
        			'no_sidebar_full_width'	=> UNIFORM_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
        		)
	       )
        )
    );
/*--------------------------------------------------------------------------------------------------------*/
  /**
   * Breadcrumbs 
   */
   $wp_customize->add_section(
        'uniform_bredcrumbs_settings',
        array(
            'title'         => __( 'Breadcrumbs', 'uniform' ),
            'priority'      => 6,
            'panel'         => 'uniform_design_panel'
        )
    );
     
    // Breadcrumbes option
    $wp_customize->add_setting(
        'breadcrumb_option',
        array(
            'default' =>'show',
            'sanitize_callback' => 'uniform_sanitize_show_hide',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Switch_Control(
        $wp_customize, 
            'call_to_action_option', 
            array(
                'type' => 'switch',
                'priority'  => 9,
                'label' => __( 'Section Option', 'uniform' ),
                'description' => __( 'Choose option to show/hide Call to Action section.', 'uniform' ),
                'section' => 'uniform_call_to_action_section',
                'choices'   => array(
                    'show' => __( 'Show', 'uniform' ),
                    'hide' => __( 'Hide', 'uniform' ),
                    ),
                )
        )
    );
/*--------------------------------------------------------------------------------------------------------*/
 /**
  * Customm design
  */ 
 $wp_customize->add_section(
        'uniform_custom_design',
        array(
            'title'         => __( 'Custom Design', 'uniform' ),
            'priority'      => 7,
            'panel'         => 'uniform_design_panel'
        )
    );
     
    // Breadcrumbes option
    $wp_customize->add_setting(
        'uniform_custom_css',
        array(
            'default' =>'',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'uniform_sanitize_text',
        )
    );
    $wp_customize->add_control( new Textarea_Custom_Control(
        $wp_customize,
        'uniform_custom_css',
            array(
                'type' => 'uniform_textarea',
                'label' => __( 'Custom css', 'uniform' ),
                'priority' => 5,
                'section' => 'uniform_custom_design'
                )
        )
    ); 
}