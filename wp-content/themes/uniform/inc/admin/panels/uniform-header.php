<?php
/**
 * Header Settings Panel and respective sections 
 * 
 * @package Uniform
 */
 
add_action( 'customize_register', 'uniform_header_settings_register' );
 
function uniform_header_settings_register( $wp_customize ) {
    $wp_customize->get_section( 'header_image' )->panel = 'uniform_header_panel';
    $wp_customize->get_section( 'header_image' )->priority = '13';
    
    $wp_customize->add_panel( 
        'uniform_header_panel', 
        array(
            'priority'       => 4,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'Header Settings', 'uniform' ),
            ) 
    );
/*----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Top Header Section
     */
    $wp_customize->add_section(
        'uniform_top_header',
        array(
            'title'         => __( 'Top Header Section', 'uniform' ),
            'priority'      => 3,
            'panel'         => 'uniform_header_panel'
        )
    );
    
    // Top Header Option
    $wp_customize->add_setting(
        'top_header_option', 
        array(
              'default' => 0,
              'capability' => 'edit_theme_options',
              'sanitize_callback' => 'uniform_sanitize_checkbox'
            )
    );
   $wp_customize->add_control(
        'top_header_option', 
        array(
              'type' => 'checkbox',
              'label' => __( 'Top Header Option', 'uniform' ),
              'description' => __( 'Checked to hide top header section.', 'uniform' ),
              'section' => 'uniform_top_header',
              'priority'      => 3
            )
   );
   
   //Top Header info
   $wp_customize->add_setting(
        'top_header_section_info', 
        array(
              'capability' => 'edit_theme_options',
              'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control( 
        new uniform_Section_Info( 
        $wp_customize,
        'top_header_section_info', 
        array(
            'type' => 'section_info',
            'label' => __( 'Top Header Elements', 'uniform' ),
            'description' => __( 'Add your email address, contact number to display at top header section as contact info.', 'uniform' ),
            'section' => 'uniform_top_header',
            'priority' => 4
            )
        )
    );
   // Email field
    $wp_customize->add_setting(
        'top_header_email', 
        array(
              'default' => __( 'info@example.com', 'uniform' ),
              'capability' => 'edit_theme_options',
              'transport'=> 'postMessage',
              'sanitize_callback' => 'uniform_sanitize_email',
            )
    );
   $wp_customize->add_control(
        'top_header_email', 
        array(
              'type' => 'text',
              'label' => __( 'Top Header Email', 'uniform' ),
              'section' => 'uniform_top_header',
              'priority'      => 5
            )
   );
   
   // Contact number field
    $wp_customize->add_setting(
        'top_header_phone', 
        array(
              'default' => __( '167-157-5987', 'uniform' ),
              'capability' => 'edit_theme_options',
              'transport'=> 'postMessage',
              'sanitize_callback' => 'uniform_sanitize_text',
            )
    );
   $wp_customize->add_control(
        'top_header_phone', 
        array(
              'type' => 'text',
              'label' => __( 'Top Header Contact', 'uniform' ),
              'section' => 'uniform_top_header',
              'priority'      => 6
            )
   );
   
   //Top Header info right side
   $wp_customize->add_setting(
        'top_header_section_info_social', 
        array(
              'capability' => 'edit_theme_options',
              'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control( 
        new Uniform_Section_Info( 
        $wp_customize,
        'top_header_section_info_social', 
        array(
            'type' => 'section_info',
            'label' => __( 'Top Header Social Links', 'uniform' ),
            'description' => __( 'Add your social link to display at top header section as social icons.', 'uniform' ),
            'section' => 'uniform_top_header',
            'priority' => 7
            )
        )
    );
    
    //Add Facebook Link
    $wp_customize->add_setting(
        'social_fb_link',
        array(
            'default' => __( 'https://facebook.com/', 'uniform' ),
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'social_fb_link',
        array(
            'type' => 'text',
            'priority' => 8,
            'label' => __( 'Facebook', 'uniform' ),
            'section' => 'uniform_top_header'
            )
    );
    
    //Add twitter Link
    $wp_customize->add_setting(
        'social_tw_link',
        array(
            'default' => __( 'https://twitter.com/', 'uniform' ),
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'social_tw_link',
        array(
            'type' => 'text',
            'priority' => 8,
            'label' => __( 'Twitter', 'uniform' ),
            'section' => 'uniform_top_header'
            )
    );
    
    //Add google plus Link
    $wp_customize->add_setting(
        'social_gp_link',
        array(
            'default' => __( 'https://plus.google.com/', 'uniform' ),
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'social_gp_link',
        array(
            'type' => 'text',
            'priority' => 8,
            'label' => __( 'Google Plus', 'uniform' ),
            'section' => 'uniform_top_header'
            )
    );
    
    //Add LinkedIn Link
    $wp_customize->add_setting(
        'social_lnk_link',
        array(
            'default' => __( 'https://linkedin.com/', 'uniform' ),
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'social_lnk_link',
        array(
            'type' => 'text',
            'priority' => 8,
            'label' => __( 'LinkedIn', 'uniform' ),
            'section' => 'uniform_top_header'
            )
    );
    
    //Add youtube Link
    $wp_customize->add_setting(
        'social_yt_link',
        array(
            'default' => __( 'https://youtube.com/', 'uniform' ),
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'social_yt_link',
        array(
            'type' => 'text',
            'priority' => 8,
            'label' => __( 'YouTube', 'uniform' ),
            'section' => 'uniform_top_header'
            )
    );
    
    //Add vimeo Link
    $wp_customize->add_setting(
        'social_vm_link',
        array(
            'default' => __( 'https://vimeo.com/', 'uniform' ),
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'social_vm_link',
        array(
            'type' => 'text',
            'priority' => 8,
            'label' => __( 'Vimeo', 'uniform' ),
            'section' => 'uniform_top_header'
            )
    );

    //Add Pinterest link
    $wp_customize->add_setting(
        'social_pin_link',
        array(
            'default' => __( 'https://www.pinterest.com/', 'uniform' ),
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'social_pin_link',
        array(
            'type' => 'text',
            'priority' => 9,
            'label' => __( 'Pinterest', 'uniform' ),
            'section' => 'uniform_top_header'
            )
    );

    //Add Instagram link
    $wp_customize->add_setting(
        'social_insta_link',
        array(
            'default' => __( 'https://www.instagram.com', 'uniform' ),
            'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'social_insta_link',
        array(
            'type' => 'text',
            'priority' => 10,
            'label' => __( 'Instagram', 'uniform' ),
            'section' => 'uniform_top_header'
            )
    );
/*----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Header Style
     */
    $wp_customize->add_section(
        'uniform_header_section',
        array(
            'title'         => __( 'Header Section', 'uniform' ),
            'priority'      => 4,
            'panel'         => 'uniform_header_panel'
        )
    );
    
    // Search icon Option
    $wp_customize->add_setting(
        'header_search_option', 
        array(
              'default' => 0,
              'capability' => 'edit_theme_options',
              'capability' => 'edit_theme_options',
            'transport'=> 'postMessage',
              'sanitize_callback' => 'uniform_sanitize_checkbox'
            )
    );
   $wp_customize->add_control(
        'header_search_option', 
        array(
              'type' => 'checkbox',
              'label' => __( 'Search Icon Option', 'uniform' ),
              'description' => __( 'Checked to show/add search icon at primary menu section.', 'uniform' ),
              'section' => 'uniform_header_section',
              'priority'      => 3
            )
   );
   
   // Sticky menu
    $wp_customize->add_setting(
        'sticky_menu_option', 
        array(
              'default' => 0,
              'capability' => 'edit_theme_options',
              'capability' => 'edit_theme_options',
              'transport'=> 'postMessage',
              'sanitize_callback' => 'uniform_sanitize_checkbox'
            )
    );
   $wp_customize->add_control(
        'sticky_menu_option', 
        array(
              'type' => 'checkbox',
              'label' => __( 'Sticky Menu Option', 'uniform' ),
              'description' => __( 'Checked to sticky menu at header while scroll page down.', 'uniform' ),
              'section' => 'uniform_header_section',
              'priority'      => 4
            )
   );
    
}