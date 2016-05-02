<?php

function BlockAds()
{

$img_url = array();
$dest_url = array();
$numbers = range(1,4); 
$counter = 0;

shuffle($numbers);

foreach ($numbers as $number) {
	
	$counter++;
	
	$img_url[$counter] = get_option('woo_ad_image_'.$number);
	$dest_url[$counter] = get_option('woo_ad_url_'.$number);
	
	}
	
?>

		<li id="ads">
			
			<h5><?php _e('Advertisments',woothemes); ?></h5>
		
			<?php include(TEMPLATEPATH . '/ads/ads.php'); ?>				
		
		</li>

<?php
		
}

function AboutMeBlurb()
{

?>

	<li>
		
		<h5><?php _e('About Me',woothemes); ?></h5>
		<?php echo stripslashes(get_option('woo_bio')); ?>
		
	</li>
	
<?php 	

}

function Ambience_Tag_Cloud()
{

?>

	<li id="tagcloud" class="widget">
		
		<h5><?php _e('Tag Cloud',woothemes); ?></h5>
		<ul>
			<li><?php if (function_exists('wp_tag_cloud')) { wp_tag_cloud('smallest=10&largest=18'); } ?></li>
		</ul>
		
	</li>
	
<?php 	

}

register_sidebar_widget('125x125 Ad Blocks', 'BlockAds');
register_sidebar_widget('About Me Blurb', 'AboutMeBlurb');
register_sidebar_widget('Ambience Tag Cloud', 'Ambience_Tag_Cloud');

?>