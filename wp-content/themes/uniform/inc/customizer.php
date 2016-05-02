<?php
/**
 * Uniform Theme Customizer
 *
 * @package Uniform
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function uniform_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

/*------------------------------------------------------------------------------------------------------------------------------*/
    /**
     * Theme info
     */
    $uniform_demo_url = __( 'Uniform Demo url ','uniform' ).': <a href="'.esc_url( 'http://demo.mysterythemes.com/uniform/' ).'" target="_blank">'.__( ' here', 'uniform' ).'</a>';
    $uniform_documentation_url = __( 'Theme Documentation ','uniform' ).': <a href="'.esc_url( 'http://docs.mysterythemes.com/uniform/' ).'" target="_blank">'.__( ' here', 'uniform' ).'</a>';
    $unform_pro_info = __( 'Uniform Pro Information ','uniform' ).': <a href="'.esc_url( 'http://mysterythemes.com/wp-themes/uniform-pro/' ).'" target="_blank">'.__( ' here', 'uniform' ).'</a>';
    $uniform_pro_demo_url = __( 'Uniform Pro Demo ','uniform' ).': <a href="'.esc_url( 'http://demo.mysterythemes.com/uniform-pro-landing/' ).'" target="_blank">'.__( ' here', 'uniform' ).'</a>';

    $wp_customize->add_section(
        'uniform_theme_info',
        array(
            'title' => __( 'Theme info', 'uniform' ),
            'priority' => 165,         
        )
    );

    // Uniform Demo
    $wp_customize->add_setting(
        'unidorm_demo_info', 
        array(
            'type'              => 'uniform_theme_info',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( 
        new Uniform_Theme_Info( $wp_customize, 
            'unidorm_demo_info', 
            array(
                'section' => 'uniform_theme_info',
                'label' => __( 'Demo Url', 'uniform' ),
                'description' =>$uniform_demo_url,
                'priority' => 5
                )
        )
    );

    // Theme Documentation
    $wp_customize->add_setting(
        'unidorm_documentation_info', 
        array(
            'type'              => 'uniform_theme_info',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( 
        new Uniform_Theme_Info( $wp_customize, 
            'unidorm_documentation_info', 
            array(
                'section' => 'uniform_theme_info',
                'label' => __( 'Documentation Url', 'uniform' ),
                'description' =>$uniform_documentation_url,
                'priority' => 6
                )
        )
    );
    
    // Pro Theme Information
    $wp_customize->add_setting(
        'unidorm_pro_info', 
        array(
            'type'              => 'uniform_theme_info',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( 
        new Uniform_Theme_Info( $wp_customize, 
            'unidorm_pro_info', 
            array(
                'section' => 'uniform_theme_info',
                'label' => __( 'Uniform Pro Info', 'uniform' ),
                'description' => $unform_pro_info,
                'priority' => 7
                )
        )
    );

    // Uniform Pro Demo
    $wp_customize->add_setting(
        'unidorm_pro_demo_info', 
        array(
            'type'              => 'uniform_theme_info',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( 
        new Uniform_Theme_Info( $wp_customize, 
            'unidorm_pro_demo_info', 
            array(
                'section' => 'uniform_theme_info',
                'label' => __( 'Uniform Pro Demo', 'uniform' ),
                'description' =>$uniform_pro_demo_url,
                'priority' => 8
                )
        )
    );


}
add_action( 'customize_register', 'uniform_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function uniform_customize_preview_js() {
	wp_enqueue_script( 'uniform_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'uniform_customize_preview_js' );
