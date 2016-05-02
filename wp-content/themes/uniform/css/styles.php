<?php
/**
 * Custom style 
 * 
 * @package Uniform
 */

$root = '../../../..';
if (file_exists($root . '/wp-load.php')) {
    require_once( $root . '/wp-load.php' );
} elseif (file_exists($root . '/wp-config.php')) {
    require_once( $root . '/wp-config.php' );
} else {
    die('/* Error */');
}

header("Content-type: text/css");

//Converts hex colors to rgba for the menu background color
//function uniform_hex2rgba( $color, $opacity = false ) {
//
//        if ($color[0] == '#' ) {
//            $color = substr( $color, 1 );
//        }
//        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
//        $rgb =  array_map('hexdec', $hex);
//        $opacity = 0.9;
//        $output = 'rgba( '.implode( ",",$rgb ).','.$opacity.' )';
//
//        return $output;
//}

    $custom = '';
    //Theme color
    $uniform_theme_color = get_theme_mod( 'uniform_theme_color', '#a0ce4e' );
    if ( $uniform_theme_color != '#a0ce4e' ) {
        $custom .= ".navigation .nav-links a:hover, .bttn:hover, .button, input[type='button']:hover, input[type='reset']:hover, input[type='submit']:hover,.edit-link .post-edit-link,.reply .comment-reply-link,.search-form-main .search-submit,.homeslider-read-more-button:hover,#homepage-slider .bx-pager-item a:hover,#homepage-slider .bx-pager-item a.active,.section-title::after,#section-callaction.uniform-home-section,.about-wrapper .post-readmore a,.widget .widget-title::after,.looks-text,#site-navigation .menu-toggle,.sub-toggle,#testimonials-slider .bx-controls-direction .bx-next:hover,#testimonials-slider .bx-controls-direction .bx-prev:hover,#section-callaction .section-button:hover,.about-wrapper .post-readmore a:hover,.widget_search .search-submit,.scrollup { background:". esc_attr( $uniform_theme_color ) ." }"."\n";
        $custom .= "a,a:hover, a:focus, a:active,.entry-footer a:hover,.comment-author .fn .url:hover,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.left-section a:hover,.right-section a:hover,#site-navigation ul li:hover > a,#site-navigation ul li.current-menu-item > a,#site-navigation ul li.current-menu-ancestor > a,.header-search-wrapper .search-main:hover,.slider-title a:hover,.single-service-wrapper .post-title a:hover,#section-about .section-title a:hover,.blog-post-wrapper .blog-title a:hover,.blog-post-wrapper .posted-on a:hover,.blog-post-wrapper .comments-link a:hover,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.site-info a:hover,.mt-footer-widget .widget a:hover,.mt-footer-widget .widget a:hover::before,.mt-footer-widget .widget li:hover::before,.entry-title a:hover,.entry-meta span a:hover,.number-404,.not-found-text,.post-readmore a:hover { color:". esc_attr( $uniform_theme_color ) ."}"."\n";
        $custom .= ".navigation .nav-links a, .bttn, button, input[type='button'], input[type='reset'], input[type='submit'],.navigation .nav-links a:hover, .bttn:hover, .button, input[type='button']:hover, input[type='reset']:hover, input[type='submit']:hover,.comment-list .comment-body,#site-navigation ul.sub-menu,.search-form-main,.homeslider-read-more-button:hover,.services-wrapper .post-readmore > a::after,.post-readmore > a::after,.testimonials-content-wrapper,.number-404,.main-menu-wrapper,#testimonials-slider .bx-controls-direction .bx-next:hover, #testimonials-slider .bx-controls-direction .bx-prev:hover,#section-callaction .section-button:hover{ border-color:". esc_attr( $uniform_theme_color ) ."}"."\n";
    }
    
    $uniform_custom_css = get_theme_mod( 'uniform_custom_css', '' );
        $custom .= $uniform_custom_css;

    echo $custom;
