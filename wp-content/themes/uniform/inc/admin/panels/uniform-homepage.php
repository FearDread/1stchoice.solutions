<?php
/**
 * Homepage Settings Panel and respective sections 
 * 
 * @package Uniform
 */
 
add_action( 'customize_register', 'uniform_homepage_settings_register' );

function uniform_homepage_settings_register( $wp_customize ) {

    $wp_customize->add_panel( 
        'uniform_homepage_panel', 
        array(
            'priority'       => 5,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Homepage Settings', 'uniform' ),
            ) 
    );
    
/*----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Homepage Slider Section
     */
    $wp_customize->add_section(
        'uniform_slider_section',
        array(
            'title'         => __( 'Slider Settings', 'uniform' ),
            'priority'      => 3,
            'panel'         => 'uniform_homepage_panel'
        )
    );
    
    // Slider category
    $wp_customize->add_setting(
        'slider_category',
        array(
            'default' => '0',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => '__return_false_value'
        )
    );
    $wp_customize->add_control( 
        new WP_Customize_Category_Control( 
        $wp_customize,
        'slider_category', 
        array(
            'label' => __( "Slider's Category", 'uniform' ),
            'description' => __( 'Select cateogry for Homepage slider', 'uniform' ),
            'section' => 'uniform_slider_section',
            'priority' => 3
            )
        )
    );
    
    // Slider control
    $wp_customize->add_setting(
        'slider_control_option',
        array(
            'default' =>'hide',
            'sanitize_callback' => 'uniform_show_hide_sanitize',
        )
    );
    $wp_customize->add_control( new WP_Customize_Switch_Control(
        $wp_customize, 
            'slider_control_option', 
            array(
                'type' => 'switch',
                'priority'  => 3,
                'label' => __( 'Slider Control', 'uniform' ),
                'description' => __( 'Show/Hide slider controls', 'uniform' ),
                'section' => 'uniform_slider_section',
                'choices'   => array(
                    'show' => __( 'Show', 'uniform' ),
                    'hide' => __( 'Hide', 'uniform' ),
                    ),
                )
        )
    );    
    
    // Slider Pager
    $wp_customize->add_setting(
        'slider_pager_option',
        array(
            'default' =>'show',
            'sanitize_callback' => 'uniform_show_hide_sanitize',
        )
    );
    $wp_customize->add_control( new WP_Customize_Switch_Control(
        $wp_customize, 
            'slider_pager_option', 
            array(
                'type' => 'switch',
                'priority'  => 3,
                'label' => __( 'Slider Control', 'uniform' ),
                'description' => __( 'Show/Hide slider controls', 'uniform' ),
                'section' => 'uniform_slider_section',
                'choices'   => array(
                    'show' => __( 'Show', 'uniform' ),
                    'hide' => __( 'Hide', 'uniform' ),
                    ),
                )
        )
    );
    
    // Slider Transaction
    $wp_customize->add_setting(
        'slider_transaction_option',
        array(
            'default' =>'auto',
            'sanitize_callback' => 'uniform_sanitize_slider_transaction',
        )
    );
    $wp_customize->add_control(
        'slider_transaction_option',
        array(
            'type' => 'radio',
            'priority'    => 6,
            'label' => __( 'Slider Transaction', 'uniform' ),
            'description' => __( "Choose option about slide's auto/manual transaction at homepage.", 'uniform' ),
            'section' => 'uniform_slider_section',
            'choices' => array(
                'auto'     => __( 'Auto', 'uniform' ),
                'manual'   => __( 'Manual', 'uniform' ),
            ),
        )
    );
    
   
/*----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Homepage service Section
     */
    $wp_customize->add_section(
        'uniform_service_section',
        array(
            'title'         => __( 'Service Settings', 'uniform' ),
            'priority'      => 4,
            'panel'         => 'uniform_homepage_panel'
        )
    );
    
    //Switch section
    $wp_customize->add_setting(
        'service_section_control',
        array(
            'default' => 'enable',
            'sanitize_callback' => 'uniform_sanitize_enable_disable'
            )
    );
     $wp_customize->add_control( new WP_Customize_Switch_Control(
        $wp_customize, 
            'service_section_control', 
            array(
                'type' => 'switch',
                'priority'  => 2,
                'label' => __( 'Section Conrol', 'uniform' ),
                'description' => __( 'Enable/Disable option to display Our Service section at home page.', 'uniform' ),
                'section' => 'uniform_service_section',
                'choices'   => array(
                    'enable' => __( 'Enable', 'uniform' ),
                    'disable' => __( 'Disable', 'uniform' ),
                    ),
                )
        )
    );

    //Service section title
    $wp_customize->add_setting(
        'service_section_title', 
            array(
                'default' => __( 'Our Services', 'uniform' ),
                'sanitize_callback' => 'uniform_sanitize_text',
                'transport' => 'postMessage'
	       )
    );    
    $wp_customize->add_control(
        'service_section_title',
            array(
            'type' => 'text',
            'label' => __( 'Service Section Title', 'uniform' ),
            'descrption' => __( 'Add title for Service section.', 'uniform' ),
            'section' => 'uniform_service_section',
            'priority' => 3
            )
    );
    
    // Service category
    $wp_customize->add_setting(
        'service_category',
        array(
            'default' => '0',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => '__return_false_value'
        )
    );
    $wp_customize->add_control( 
        new WP_Customize_Category_Control( 
        $wp_customize,
        'service_category', 
        array(
            'label' => __( 'Service Category', 'uniform' ),
            'description' => __( "Select cateogry for Homepage's Service section", "uniform" ),
            'section' => 'uniform_service_section',
            'priority' => 4
            )
        )
    );
  
/*----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Homepage Call to action Section
     */
    $wp_customize->add_section(
        'uniform_call_to_action_section',
        array(
            'title'         => __( 'Call to Action', 'uniform' ),
            'priority'      => 5,
            'panel'         => 'uniform_homepage_panel'
        )
    );
    // Section display option
    $wp_customize->add_setting(
        'call_to_action_option',
        array(
            'default' =>'show',
            'sanitize_callback' => 'uniform_show_hide_sanitize',
        )
    );
    $wp_customize->add_control( new WP_Customize_Switch_Control(
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

/*----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Homepage About and Testimonials section
     */
    $wp_customize->add_section(
        'uniform_about_section',
        array(
            'title'         => __( 'About/Testimonals', 'uniform' ),
            'priority'      => 6,
            'panel'         => 'uniform_homepage_panel'
        )
    );
    
    //Switch section
    $wp_customize->add_setting(
        'about_section_control',
        array(
            'default' => 'enable',
            'sanitize_callback' => 'uniform_sanitize_enable_disable'
            )
    );
     $wp_customize->add_control( new WP_Customize_Switch_Control(
        $wp_customize, 
            'about_section_control', 
            array(
                'type' => 'switch',
                'priority'  => 2,
                'label' => __( 'Section Conrol', 'uniform' ),
                'description' => __( 'Enable/Disable option to display About/Testimonilas section at home page.', 'uniform' ),
                'section' => 'uniform_about_section',
                'choices'   => array(
                    'enable' => __( 'Enable', 'uniform' ),
                    'disable' => __( 'Disable', 'uniform' ),
                    ),
                )
        )
    );
    
    //Top Header info
   $wp_customize->add_setting(
        'about_section_info', 
        array(
              'capability' => 'edit_theme_options',
              'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control( 
        new Uniform_Section_Info( 
        $wp_customize,
        'about_section_info', 
        array(
            'type' => 'section_info',
            'label' => __( 'About Us', 'uniform' ),
            'description' => __( 'Set the about us section.', 'uniform' ),
            'section' => 'uniform_about_section',
            'priority' => 3
            )
        )
    );
    
    //Select Category for latest blog
    $wp_customize->add_setting(
        'about_page_left',
        array(
            'default' => '0',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => '__return_false_value'
        )
    );
    $wp_customize->add_control( 
        new WP_Customize_Page_Control( 
        $wp_customize,
        'about_page_left', 
        array(
            'label' => __( 'Select Page', 'uniform' ),
            'description' => __( 'Select page for About section', 'uniform' ),
            'section' => 'uniform_about_section',
            'priority' => 4
            )
        )
    );
    
    //Top Header info
   $wp_customize->add_setting(
        'testimonials_section_info', 
        array(
              'capability' => 'edit_theme_options',
              'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control( 
        new Uniform_Section_Info( 
        $wp_customize,
        'testimonials_section_info', 
        array(
            'type' => 'section_info',
            'label' => __( 'Testimonials Section', 'uniform' ),
            'description' => __( 'Set the testimoinals section.', 'uniform' ),
            'section' => 'uniform_about_section',
            'priority' => 6
            )
        )
    );
    
    //Testimonilas section title
    $wp_customize->add_setting(
        'testimonials_section_title', 
            array(
                'default' => __( 'Testimonials', 'uniform' ),
                'sanitize_callback' => 'uniform_sanitize_text',
                'transport' => 'postMessage'
	       )
    );    
    $wp_customize->add_control(
        'testimonials_section_title',
            array(
            'type' => 'text',
            'label' => __( 'Section Title', 'uniform' ),
            'descrption' => __( 'Add title for tesimonials section.', 'uniform' ),
            'section' => 'uniform_about_section',
            'priority' => 7
            )
    );
    
    // Testimonials category
    $wp_customize->add_setting(
        'testimonials_category',
        array(
            'default' => '0',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => '__return_false_value'
        )
    );
    $wp_customize->add_control( 
        new WP_Customize_Category_Control( 
        $wp_customize,
        'testimonials_category', 
        array(
            'label' => __( 'Testimonials Category', 'uniform' ),
            'description' => __( 'Select cateogry for testimonials posts.', 'uniform' ),
            'section' => 'uniform_about_section',
            'priority' => 8
            )
        )
    );
   
   //Switch section
    $wp_customize->add_setting(
        'flip_about_section_switch',
        array(
            'default' => 'left',
            'sanitize_callback' => 'uniform_flip_section_switch_option'
            )
    );
     $wp_customize->add_control( new WP_Customize_Switch_Control(
        $wp_customize, 
            'flip_about_section_switch', 
            array(
                'type' => 'switch',
                'priority'  => 9,
                'label' => __( 'Flip the About Us', 'uniform' ),
                'description' => __( 'Left/Right option to flip the About us section with Testimonials section.', 'uniform' ),
                'section' => 'uniform_about_section',
                'choices'   => array(
                    'left' => __( 'Left', 'uniform' ),
                    'right' => __( 'Right', 'uniform' ),
                    ),
                )
        )
    );
        
/*----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Latest blog section
     */
    $wp_customize->add_section(
        'uniform_latest_blog_section',
        array(
            'title'         => __( 'Latest Blogs', 'uniform' ),
            'priority'      => 7,
            'panel'         => 'uniform_homepage_panel'
        )
    );
    
    //Switch section
    $wp_customize->add_setting(
        'blog_section_control',
        array(
            'default' => 'enable',
            'sanitize_callback' => 'uniform_sanitize_enable_disable'
            )
    );
    $wp_customize->add_control( new WP_Customize_Switch_Control(
        $wp_customize, 
            'blog_section_control', 
            array(
                'type' => 'switch',
                'priority'  => 3,
                'label' => __( 'Section Conrol', 'uniform' ),
                'description' => __( 'Enable/Disable option to display latest blog section at home page.', 'uniform' ),
                'section' => 'uniform_latest_blog_section',
                'choices'   => array(
                    'enable' => __( 'Enable', 'uniform' ),
                    'disable' => __( 'Disable', 'uniform' ),
                    ),
                )
        )
    );
    
    //Latest Blog section title
    $wp_customize->add_setting(
        'latest_blog_title', 
            array(
                'default' => __( 'Latest News', 'uniform' ),
                'sanitize_callback' => 'uniform_sanitize_text',
                'transport' => 'postMessage'
	       )
    );    
    $wp_customize->add_control(
        'latest_blog_title',
            array(
            'type' => 'text',
            'label' => __( 'Section Title', 'uniform' ),
            'descrption' => __( 'Add title for latest blog section.', 'uniform' ),
            'section' => 'uniform_latest_blog_section',
            'priority' => 4
            )
    );
    
    // Latest Blog category
    $wp_customize->add_setting(
        'latest_blog_category',
        array(
            'default' => '0',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => '__return_false_value'
        )
    );
    $wp_customize->add_control( 
        new WP_Customize_Category_Control( 
        $wp_customize,
        'latest_blog_category', 
        array(
            'label' => __( 'Latest Blogs Category', 'uniform' ),
            'description' => __( 'Select cateogry for latest blog posts.', 'uniform' ),
            'section' => 'uniform_latest_blog_section',
            'priority' => 5
            )
        )
    );
    
    // Post Meta control
    $wp_customize->add_setting(
        'blog_post_meta_option',
        array(
            'default' =>'show',
            'sanitize_callback' => 'uniform_show_hide_sanitize',
        )
    );
    $wp_customize->add_control( new WP_Customize_Switch_Control(
        $wp_customize, 
            'blog_post_meta_option', 
            array(
                'type' => 'switch',
                'priority'  => 6,
                'label' => __( 'Post Meta Conrol', 'uniform' ),
                'description' => __( 'Enable/Disable Post meta in blog section at home page.', 'uniform' ),
                'section' => 'uniform_latest_blog_section',
                'choices'   => array(
                    'show' => __( 'Show', 'uniform' ),
                    'hide' => __( 'Hide', 'uniform' ),
                    ),
                )
        )
    );
/*-------------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Homepage Sections Re-order
     */
    $wp_customize->add_section(
        'uniform_home_section_reorder',
        array(
            'title' => __( 'Homepage Sections Re-order', 'uniform' ),
            'priority' => 15,
            'panel' => 'uniform_homepage_panel'
            )
    );
    
    // Section option
    $wp_customize->add_setting(
        'uniform_section_order_lists',
        array(
            'default' => '',
            'sanitize_callback' => 'uniform_sanitize_text'
            )
    );
    $uniform_section_reorder_url = __( 'Section Re-order by using Drag and Drop is only available in pro version. Please visit ','uniform' ).': <a href="'.esc_url( 'http://mysterythemes.com/wp-themes/uniform-pro/' ).'" target="_blank">'.__( ' here', 'uniform' ).'</a>';
    
     $wp_customize->add_control( new Uniform_Section_Re_Order(
        $wp_customize, 
            'uniform_section_order_lists',
            array(
                'type' => 'dragndrop',
                'priority'  => 3,
                'label' => __( 'Section Re-order', 'uniform' ),
                'description' => $uniform_section_reorder_url,
                'section' => 'uniform_home_section_reorder',
                'choices'   => array(
                    'uniform_service' => __( 'Service Settings', 'uniform' ),
                    'uniform_cta' => __( 'Call to Action', 'uniform' ),
                    'about_testimonials' => __( 'About/Testimonials', 'uniform' ),
                    'uniform_latest_blog' => __( 'Latest Blogs', 'uniform' ),
                    ),
                )
        )
    );
}