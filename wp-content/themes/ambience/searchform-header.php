<form method="get" id="header-search" action="<?php bloginfo('url'); ?>/">
	<input type="text" class="search-box" value="<?php _e('Search Keywords',woothemes); ?>" onblur="if (this.value == '') {this.value = '<?php _e('Search Keywords',woothemes); ?>';}"  onfocus="if (this.value == '<?php _e('Search Keywords',woothemes); ?>') {this.value = '';}" name="s" id="s" />
	<input type="image" src="<?php bloginfo('template_directory'); ?>/styles/<?php global $style_path; echo $style_path; ?>/search-button.jpg" class="search-button" value="<?php _e('Search',woothemes); ?>" />
</form>