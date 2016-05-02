<div class="search_main">
    <form method="get" class="searchform" action="<?php bloginfo('url'); ?>" >
        <input type="text" class="field s" name="s" value="<?php _e('Search...', 'woothemes') ?>" onfocus="if (this.value == '<?php _e('Search...', 'woothemes') ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search...', 'woothemes') ?>';}" />
        <input type="image" src="<?php bloginfo('template_url'); ?>/images/ico-search.png" class="submit" name="submit" value="<?php _e('Go', 'woothemes'); ?>" />
    </form>    
    <div class="fix"></div>
</div>
