<?php
/**
 * Reset options
 * Its outside options panel
 *
 * @param  array $reset_options
 * @return void
 *
 * @since Corporate Plus 1.1.0
 */
if ( ! function_exists( 'corporate_plus_reset_db_options' ) ) :
    function corporate_plus_reset_db_options( $reset_options ) {
        set_theme_mod( 'corporate_plus_theme_options', $reset_options );
    }
endif;

function corporate_plus_reset_setting_callback( $input, $setting ){
    // Ensure input is a slug.
    $input = sanitize_text_field( $input );
    if( '0' == $input ){
        return '0';
    }
    $corporate_plus_default_theme_options = corporate_plus_get_default_theme_options();
    $corporate_plus_get_theme_options = get_theme_mod( 'corporate_plus_theme_options');

    switch ( $input ) {
        case "reset-color-options":
            $corporate_plus_get_theme_options['corporate-plus-primary-color'] = $corporate_plus_default_theme_options['corporate-plus-primary-color'];
            corporate_plus_reset_db_options($corporate_plus_get_theme_options);
            break;

        case "reset-all":
            corporate_plus_reset_db_options($corporate_plus_default_theme_options);
            break;

        default:
            break;
    }
}
/*adding sections for Reset Options*/
$wp_customize->add_section( 'corporate-plus-reset-options', array(
    'priority'       => 220,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Reset Options', 'corporate-plus' )
) );

/*Reset Options*/
$wp_customize->add_setting( 'corporate_plus_theme_options[corporate-plus-reset-options]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['corporate-plus-reset-options'],
    'sanitize_callback' => 'corporate_plus_reset_setting_callback',
    'transport'			=> 'postMessage'
) );

$choices = corporate_plus_reset_options();
$wp_customize->add_control( 'corporate_plus_theme_options[corporate-plus-reset-options]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Reset Options', 'corporate-plus' ),
    'description'=> __( 'Caution: Reset theme settings according to the given options. Refresh the page after saving to view the effects. ', 'corporate-plus' ),
    'section'   => 'corporate-plus-reset-options',
    'settings'  => 'corporate_plus_theme_options[corporate-plus-reset-options]',
    'type'	  	=> 'select'
) );