<div class="search_main">
    <form method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
        <input type="text" class="field s" name="s" value="<?php esc_attr_e( 'Enter search keywords', 'woothemes' ); ?>" onfocus="if (this.value == '&lt;?php esc_attr_e( 'Enter search keywords', 'woothemes' ); ?&gt;') {this.value = '';}" onblur="if (this.value == '') {this.value = '&lt;?php esc_attr_e( 'Enter search keywords', 'woothemes' ); ?&gt;';}"> <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/search-btn.png" class="submit" name="submit">
    </form>

    <div class="clear"></div>
</div>