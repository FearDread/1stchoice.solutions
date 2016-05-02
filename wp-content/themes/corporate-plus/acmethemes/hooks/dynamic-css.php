<?php
/**
 * Dynamic css
 *
 * @since Corporate Plus 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'corporate_plus_dynamic_css' ) ) :

    function corporate_plus_dynamic_css() {

        global $corporate_plus_customizer_all_values;
        /*Color options */
        $corporate_plus_primary_color = $corporate_plus_customizer_all_values['corporate-plus-primary-color'];
        $custom_css = '';

        /*background*/
        if( get_header_image() ){
            $bg_image_url = get_header_image();
        }
        else{
            $bg_image_url =   get_template_directory_uri()."/assets/img/startup-slider.jpg";
        }
        $custom_css .= "
              .inner-main-title {
                background-image:url('{$bg_image_url}');
                background-repeat:no-repeat;
                background-size:cover;
                background-attachment:fixed;
            }";
        /*color*/
        $custom_css .= "
            a:hover,
            a:active,
            a:focus,
            .btn-primary:hover,
            .widget li a:hover,
            .posted-on a:hover,
            .cat-links a:hover,
            .comments-link a:hover,
            .edit-link a:hover,
            .tags-links a:hover,
            .byline a:hover,
            .nav-links a:hover,
            .bx-controls-direction a:hover i,
            .scroll-wrap.arrow:hover span {
                color: {$corporate_plus_primary_color};
            }";

        /*background color*/
        $custom_css .= "
            .navbar .navbar-toggle:hover,
            .main-navigation .current_page_item > a:before,
            .main-navigation .current-menu-item > a:before,
            .main-navigation .active > a:before,
            .main-navigation .current_page_ancestor > a:before,
            .comment-form .form-submit input,
            .read-more,
            .btn-primary,
            .circle,
            .line > span,
            .wpcf7-form input.wpcf7-submit,
            .wpcf7-form input.wpcf7-submit:hover,
            .breadcrumb{
                background-color: {$corporate_plus_primary_color};
            }";

        /*borders*/
        $custom_css .= "
            .blog article.sticky,
            .btn-primary:before{
                border: 2px solid {$corporate_plus_primary_color};
            }";

        $custom_css .= "
            .comment-form .form-submit input,
            .read-more{
                border: 1px solid {$corporate_plus_primary_color};
            }";

        $custom_css .= "
            .wpcf7-form input.wpcf7-submit::before {
                border: 4px solid {$corporate_plus_primary_color};
            }";

        $custom_css .= "
             .breadcrumb::after {
                border-left: 5px solid {$corporate_plus_primary_color};
            }";

        /*custom css*/
        /*custom css*/
        $corporate_plus_custom_css = wp_strip_all_tags ( $corporate_plus_customizer_all_values['corporate-plus-custom-css'] );
        if ( ! empty( $corporate_plus_custom_css ) ) {
            $custom_css .= $corporate_plus_custom_css;
        }
        wp_add_inline_style( 'corporate-plus-style', $custom_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'corporate_plus_dynamic_css', 99 );