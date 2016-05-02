<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Uniform
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'uniform' ); ?></a>
    <?php uniform_top_header(); ?>
	<header id="masthead" class="site-header" role="banner">
        <div class="mt-container">
    		<div class="site-branding">
                <?php 
                    $site_logo = get_theme_mod( 'header_image' );
                    if ( $site_logo && $site_logo != 'remove-header' ) { ?>
        			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>"><img class="site-logo" src="<?php echo esc_url( get_theme_mod( 'header_image' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
                <?php } else { ?>
        			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>	        
                <?php } ?>			
    		</div><!-- .site-branding -->

    		<div class="primary-nav-wrapper clearfix">
                <nav id="site-navigation" class="main-navigation" role="navigation">
        			<div class="menu-toggle hide"><i class="fa fa-bars"></i></div>
        			<div class="main-menu-wrapper"> <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?> </div>
        		</nav><!-- #site-navigation -->
                <div class="header-search-wrapper">
                    <?php if( get_theme_mod( 'header_search_option', 0 ) == 1 ) { ?>
                        <span class="search-main"><i class="fa fa-search"></i></span>
                        <div class="search-form-main hide clearfix">
                            <div class="mt-container">
                                <?php get_search_form(); ?>
                            </div>
                        </div>
                    <?php } ?>    
                </div>        
            </div>
        </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
    <?php 
        if( get_theme_mod( 'breadcrumb_option', 'show' ) == 'show' && !is_front_page() ) {
            uniform_breadcrumbs();
        }
    ?>