<?php get_header(); ?>
<?php global $woo_options; ?>
	
	
	<?php 
	if ( isset($woo_options['woo_homepage_order']) && $woo_options['woo_homepage_order'] != '' ) {
		$homepage_order = $woo_options['woo_homepage_order'];
	} else {
		$homepage_order = '123';
	} // End If Statement
	
	// Homepage Order Output
	switch ($homepage_order) {
		
		case '123':
			// Connect, Authors, Featured Panel
			if ( is_home() && !is_paged() ) {
				if ( isset($woo_options[ 'woo_home_connect_intro' ]) && ( $woo_options[ 'woo_home_connect_intro' ] == 'true' ) ) { get_template_part( 'includes/homepage-connect-intro' ); } 
				if ( isset($woo_options[ 'woo_author_sorter' ]) && ( $woo_options[ 'woo_author_sorter' ] == 'true' ) ) { get_template_part( 'includes/author-sorter' ); } 
				if ( isset($woo_options[ 'woo_featured' ]) && ( $woo_options['woo_featured'] == 'true' ) ) { get_template_part( 'includes/featured' ); }
			} // End IF Statement
			break;
		case '132':
			// Connect, Featured Panel, Authors
			if ( is_home() && !is_paged() ) {
				if ( isset($woo_options[ 'woo_home_connect_intro' ]) && ( $woo_options[ 'woo_home_connect_intro' ] == 'true' ) ) { get_template_part( 'includes/homepage-connect-intro' ); } 
				if ( isset($woo_options[ 'woo_featured' ]) && ( $woo_options['woo_featured'] == 'true' ) ) { get_template_part( 'includes/featured' ); }
				if ( isset($woo_options[ 'woo_author_sorter' ]) && ( $woo_options[ 'woo_author_sorter' ] == 'true' ) ) { get_template_part( 'includes/author-sorter' ); } 
			} // End IF Statement
			break;
		case '213':
			// Authors, Connect, Featured Panel
			if ( is_home() && !is_paged() ) {
				if ( isset($woo_options[ 'woo_author_sorter' ]) && ( $woo_options[ 'woo_author_sorter' ] == 'true' ) ) { get_template_part( 'includes/author-sorter' ); } 
				if ( isset($woo_options[ 'woo_home_connect_intro' ]) && ( $woo_options[ 'woo_home_connect_intro' ] == 'true' ) ) { get_template_part( 'includes/homepage-connect-intro' ); } 
				if ( isset($woo_options[ 'woo_featured' ]) && ( $woo_options['woo_featured'] == 'true' ) ) { get_template_part( 'includes/featured' ); }
			} // End IF Statement
			break;
		case '231':
			// Authors, Featured Panel, Connect
			if ( is_home() && !is_paged() ) {
				if ( isset($woo_options[ 'woo_author_sorter' ]) && ( $woo_options[ 'woo_author_sorter' ] == 'true' ) ) { get_template_part( 'includes/author-sorter' ); } 
				if ( isset($woo_options[ 'woo_featured' ]) && ( $woo_options['woo_featured'] == 'true' ) ) { get_template_part( 'includes/featured' ); }
				if ( isset($woo_options[ 'woo_home_connect_intro' ]) && ( $woo_options[ 'woo_home_connect_intro' ] == 'true' ) ) { get_template_part( 'includes/homepage-connect-intro' ); } 
			} // End IF Statement
			break;
		case '312':
			// Featured Panel, Connect, Authors
			if ( is_home() && !is_paged() ) {
				if ( isset($woo_options[ 'woo_featured' ]) && ( $woo_options['woo_featured'] == 'true' ) ) { get_template_part( 'includes/featured' ); }
				if ( isset($woo_options[ 'woo_home_connect_intro' ]) && ( $woo_options[ 'woo_home_connect_intro' ] == 'true' ) ) { get_template_part( 'includes/homepage-connect-intro' ); } 
				if ( isset($woo_options[ 'woo_author_sorter' ]) && ( $woo_options[ 'woo_author_sorter' ] == 'true' ) ) { get_template_part( 'includes/author-sorter' ); } 
			} // End IF Statement 
			break;
		case '321':
			// Featured Panel, Authors, Connect
			if ( is_home() && !is_paged() ) {
				if ( isset($woo_options[ 'woo_featured' ]) && ( $woo_options['woo_featured'] == 'true' ) ) { get_template_part( 'includes/featured' ); }
				if ( isset($woo_options[ 'woo_author_sorter' ]) && ( $woo_options[ 'woo_author_sorter' ] == 'true' ) ) { get_template_part( 'includes/author-sorter' ); } 
				if ( isset($woo_options[ 'woo_home_connect_intro' ]) && ( $woo_options[ 'woo_home_connect_intro' ] == 'true' ) ) { get_template_part( 'includes/homepage-connect-intro' ); } 
			} // End IF Statement
			break;
		default :
			// Connect, Authors, Featured Panel
			if ( is_home() && !is_paged() ) {
				if ( isset($woo_options[ 'woo_home_connect_intro' ]) && ( $woo_options[ 'woo_home_connect_intro' ] == 'true' ) ) { get_template_part( 'includes/homepage-connect-intro' ); } 
				if ( isset($woo_options[ 'woo_author_sorter' ]) && ( $woo_options[ 'woo_author_sorter' ] == 'true' ) ) { get_template_part( 'includes/author-sorter' ); } 
				if ( isset($woo_options[ 'woo_featured' ]) && ( $woo_options['woo_featured'] == 'true' ) ) { get_template_part( 'includes/featured' ); }
			} // End IF Statement
			break;
	
	} //End Switch Statement
	?>

<?php get_footer(); ?>