<?php
global $woo_options;
?>
<div class="section col-full">

    <div class="section-left">

    	<div id="home-connect">
    		
    		<?php if ( isset($woo_options[ 'woo_home_connect_title' ]) && $woo_options[ 'woo_home_connect_title' ] != '' ) { ?><h3><?php echo $woo_options[ 'woo_home_connect_title' ]; ?></h3><?php } ?>
    		
    		<ul>
    			<?php if ( isset($woo_options[ 'woo_home_connect_addr' ]) && $woo_options[ 'woo_home_connect_addr' ] != '' ) { ?><li class="location"><?php echo $woo_options[ 'woo_home_connect_addr' ]; ?></li><?php } ?>
    			<?php if ( isset($woo_options['woo_contact_page']) && $woo_options['woo_contact_page'] != '' ) { ?><li class="mail"><a href="<?php echo get_permalink($woo_options['woo_contact_page']); ?>" class="mail"><?php _e('Send us an email', 'woothemes'); ?></a></li><?php } ?>
    		</ul>
    		
    	</div><!--/#home-connect -->
    	
    </div><!--/.section-left -->
    
    <div class="section-right">
    	
    	<?php if ($woo_options[ 'woo_home_intro' ]) { ?>			
    	<div id="intro">
    		<p><?php echo stripslashes( $woo_options[ 'woo_home_intro' ] ); ?></p>
    	</div><!--/#intro -->
    	<?php } ?>
    	
    </div><!--/.section-right -->
    
    <div class="fix"></div>
    
</div><!--/.section -->	