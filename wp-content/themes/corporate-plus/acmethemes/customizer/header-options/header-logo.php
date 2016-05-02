<?php
global $wp_version;
// Return if wp version less than 4.5
if ( version_compare( $wp_version, '4.5', '<' ) ){

    /*header logo*/
    $wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-header-logo]', array(
        'capability'		=> 'edit_theme_options',
        'default'			=> $defaults['corporate-plus-header-logo'],
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'corporate_plus_theme_options[corporate-plus-header-logo]',
            array(
                'label'		=> __( 'Logo', 'corporate-plus' ),
                'section'   => 'title_tagline',
                'settings'  => 'corporate_plus_theme_options[corporate-plus-header-logo]',
                'type'	  	=> 'image',
                'priority'  => 10
            )
        )
    );

}
/*header logo/text display options*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-header-id-display-opt]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-header-id-display-opt'],
    'sanitize_callback' => 'corporate_plus_sanitize_select'
) );
$choices = corporate_plus_header_id_display_opt();
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-header-id-display-opt]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Logo/Site Title-Tagline Display Options', 'corporate-plus' ),
    'section'   => 'title_tagline',
    'settings'  => 'corporate_plus_theme_options[corporate-plus-header-id-display-opt]',
    'type'	  	=> 'radio',
    'priority'  => 30
) );