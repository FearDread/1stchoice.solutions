<?php
/**
 * Copyright (C) 2014-2016 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

class Ai1wm_Export_Enumerate {

	public static function execute( $params ) {

		// Set progress
		Ai1wm_Status::info( __( 'Retrieving a list of all WordPress files...', AI1WM_PLUGIN_NAME ) );

		// Total files
		$total = 0;

		// Create map file
		$filemap = fopen( ai1wm_filemap_path( $params ) , 'a+' );

		// Set exclude filters
		$exclude_filters = ai1wm_content_filters();

		// Exclude themes
		if ( isset( $params['options']['no-themes'] ) ) {
			$exclude_filters[] = 'themes';
		}

		// Exclude plugins
		if ( isset( $params['options']['no-plugins'] ) ) {
			$exclude_filters = array_merge( $exclude_filters, array( 'plugins', 'mu-plugins' ) );
		} else {
			$exclude_filters = array_merge( $exclude_filters, ai1wm_plugin_filters() );
		}

		// Exclude media
		if ( isset( $params['options']['no-media'] ) ) {
			$exclude_filters[] = 'uploads';
		}

		try {
			// Iterate over content directory
			$iterator = new RecursiveIteratorIterator(
				new Ai1wm_Recursive_Exclude_Filter(
					new Ai1wm_Recursive_Directory_Iterator(
						WP_CONTENT_DIR
					),
					$exclude_filters
				),
				RecursiveIteratorIterator::SELF_FIRST
			);

			// Write path line
			foreach ( $iterator as $item ) {
				if ( $item->isFile() ) {
					if ( fwrite( $filemap, $iterator->getSubPathName() . PHP_EOL ) ) {
						$total++;
					}
				}
			}
		} catch ( Exception $e ) {
			// Skip bad file permissions
		}

		// Close handle
		fclose( $filemap );

		// Set total files
		$params['total'] = $total;

		// Set progress
		Ai1wm_Status::info( __( 'Done retrieving a list of all WordPress files.', AI1WM_PLUGIN_NAME ) );

		return $params;
	}
}
