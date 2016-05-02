<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
    <title><?php woo_title(); ?></title>
    <?php woo_meta(); ?>

	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if ( get_option( 'woo_feedburner_url' ) != '' ) { echo get_option( 'woo_feedburner_url' ); } else { echo get_bloginfo_rss( 'rss2_url' ); } ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <!--[if lt IE 7]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE7.js" type="text/javascript"></script>
    <![endif]-->

	<?php wp_head(); ?>

    <!-- Show custom logo -->
    <?php if ( get_option( 'woo_logo' ) != '' ) { ?><style type="text/css">#logo {background: url(<?php echo get_option( 'woo_logo' ); ?>) no-repeat !important; }</style><?php } ?>

    <!-- Show text logo -->
    <?php if ( get_option( 'woo_textlogo' ) == 'true' ) { ?>
	<style type="text/css">
        #logo { background: none !important; margin-top: 30px !important; }
        h1, h2 { text-indent: 0px !important; }
    </style>
    <?php } ?>

</head>
<body <?php body_class(); ?>>
	<div id="main-back">

		<div class="container clearfix">

			<div id="header">

				<div id="top-links">

<?php
$contactme = get_option( 'woo_contactme' ); // Name of the contact me page

if ( isset( $contactme ) ) {
	$contact_page = get_permalink( $contactme );	
} else {
	$contact_page = home_url( '/' );
}
?>

					<a href="<?php echo esc_url( $contact_page ); ?>"><?php _e( 'Contact Me', 'woothemes' ); ?></a> | <a href="<?php if ( get_option( 'woo_feedburner_url' ) != '' ) { echo get_option( 'woo_feedburner_url' ); } else { echo get_bloginfo_rss( 'rss2_url' ); } ?>"><?php _e( 'Subscribe', 'woothemes' ); ?></a>

				</div><!-- End top-links -->

				<div id="banner" class="clearfix">

						<div id="logo" class="clearfix">
							<h1><a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
							<h2><?php bloginfo( 'description' ); ?></h2>
						</div>

					<?php get_template_part( 'searchform', 'header' ); ?>

				</div><!-- End banner -->
				<?php
if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary-menu' ) ) {
	wp_nav_menu( array( 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'navigation', 'theme_location' => 'primary-menu', 'menu_class' => 'menu nav' ) );
} else {
?>
				<ul id="navigation">
				<?php
	if ( get_option( 'woo_custom_nav_menu' ) == 'true' ) {
		if ( function_exists( 'woo_custom_navigation_output' ) )
			woo_custom_navigation_output( 'desc=1' );

	} else { ?>

					<li><a href="<?php bloginfo( 'url' ); ?>">
							<?php _e( 'Home', 'woothemes' ); ?>
							<span><?php _e( 'Where it all began', 'woothemes' ); ?></span>
						</a>
					</li>
					<?php woothemes_get_pages(); ?>
                <?php } ?>
				</ul><!-- End navigation -->
				<?php } ?>
			</div><!-- End header -->