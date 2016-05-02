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

class Ai1wm_Import_Done {

	public static function execute( $params ) {

		// Set shutdown handler
		@register_shutdown_function( 'Ai1wm_Import_Done::shutdown' );

		// Open the archive file for reading
		$archive = new Ai1wm_Extractor( ai1wm_archive_path( $params ) );

		// Unpack must-use plugins
		$archive->extract_by_files_array( WP_CONTENT_DIR, array( AI1WM_MUPLUGINS_NAME ) );

		// Close the archive file
		$archive->close();

		// Load must-use plugins
		foreach ( wp_get_mu_plugins() as $mu_plugin ) {
			include_once( $mu_plugin );
		}

		return $params;
	}

	public static function shutdown() {
		$error = error_get_last();

		// Deactivate must-use plugins on fatal errors
		if ( $error ) {
			if ( $error['type'] === E_ERROR && stripos( $error['file'], AI1WM_MUPLUGINS_NAME ) !== false ) {
				if ( is_dir( ai1wm_content_path( AI1WM_MUPLUGINS_NAME ) ) ) {
					@rename( ai1wm_content_path( AI1WM_MUPLUGINS_NAME ), sprintf( '%s-%s', ai1wm_content_path( AI1WM_MUPLUGINS_NAME ), date( 'YmdHis' ) ) );
				}
			}
		}

		// Get permalink URL
		$permalink = admin_url( 'options-permalink.php#submit' );

		// Set progress
		Ai1wm_Status::done(
			__(
				"You need to perform two more steps:<br />" .
				"<strong>1. You must save your permalinks structure twice. <a class=\"ai1wm-no-underline\" href=\"{$permalink}\" target=\"_blank\">Permalinks Settings</a></strong> <small>(opens a new window)</small><br />" .
				"<strong>2. <a class=\"ai1wm-no-underline\" href=\"https://wordpress.org/support/view/plugin-reviews/all-in-one-wp-migration?rate=5#postform\" target=\"_blank\">Optionally, review the plugin</a>.</strong> <small>(opens a new window)</small>",
				AI1WM_PLUGIN_NAME
			),
			__(
				"Your data has been imported successfuly!",
				AI1WM_PLUGIN_NAME
			)
		);
	}
}
