<?php ?>
		<div id="mobile-container-div" class="mobile-container">
			<div id="mobile-main-menu-div" class="mobile-main-menu">
			<nav id="handcraft-expo-mobile-menu" class="mobile-menu" role="navigation">
			<a id="mobile-dropdown-toggle" href="#" title="<?php echo __('Menu', 'handcraft-expo'); ?>"><span id="mobile-toggle-icon">V</span></a>
				<div class="mobile-social-icons">
					<?php get_template_part('socials'); ?>
				</div>
<?php
		$handcraft_expo_mobileMenuOptions = array(
			'theme_location' => 'handcraft-expo_mobile_main_menu',
			'container_class' => 'mobile-main-menu-dropdown'
		);
		wp_nav_menu($handcraft_expo_mobileMenuOptions);
?>
			</nav>
			</div>
<?php 
	$handcraft_expo_visibleTitle = get_theme_mod('handcraft-expo_title_show', 1);
	$handcraft_expo_titlePositionCheck = get_theme_mod('handcraft-expo_title_position', 'left');
	if ($handcraft_expo_visibleTitle == 1 && $handcraft_expo_titlePositionCheck == 'left') { ?>
		<div class="mobile-site-title-container">
			<a class="mobile-site-title-permalink" href="<?php echo home_url(); ?>"><h1 class=" title-show title-center"><?php bloginfo('title'); ?></h1>
			<h3 class="tagline-show tagline-center"><?php bloginfo('description'); ?></h3></a>
		</div>
<?php }
	if (get_theme_mod('handcraft-expo_logo')) { ?>
			<div class="mobile-logo">
<?php handcraft_expo_custom_logo(); ?>
			</div>
<?php } ?>
		</div>
