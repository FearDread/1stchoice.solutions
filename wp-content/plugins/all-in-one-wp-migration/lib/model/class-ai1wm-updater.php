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

class Ai1wm_Updater {

	/**
	 * Retrieve plugin installer pages from WordPress Plugins API.
	 *
	 * @param  mixed        $result
	 * @param  string       $action
	 * @param  array|object $args
	 * @return mixed
	 */
	public static function plugins_api( $result, $action = null, $args = null ) {
		if ( empty( $args->slug ) ) {
			return $result;
		}

		$extensions = self::get_extensions();

		// View details page
		if ( isset( $args->slug ) && isset( $extensions[ $args->slug ] ) && $action === 'plugin_information' ) {

			// Get current updates
			$updates = get_site_option( AI1WM_UPDATER, array() );

			// Plugin details
			if ( isset( $updates[ $args->slug ] ) && ( $details = $updates[ $args->slug ] ) ) {
				return (object) $details;
			}
		}

		return $result;
	}

	/**
	 * Update WordPress plugin list page.
	 *
	 * @param  object $transient
	 * @return object
	 */
	public static function update_plugins( $transient ) {
		$extensions = self::get_extensions();

		// Get current updates
		$updates = get_site_option( AI1WM_UPDATER, array() );

		// Get extension updates
		foreach ( $updates as $slug => $update ) {
			if ( isset( $extensions[ $slug ]) && ( $extension = $extensions[ $slug ] ) ) {
				if ( get_site_option( $extension['key'] ) ) {
					if ( version_compare( $extension['version'], $update['version'], '<' ) ) {

						// Get Site URL
						$url = urlencode( get_site_url() );

						// Get Purchase ID
						$key = get_site_option( $extension['key'], false, false );

						// Set plugin details
						$transient->response[ $extension['basename'] ] = (object) array(
							'slug'        => $slug,
							'new_version' => $update['version'],
							'url'         => $update['homepage'],
							'plugin'      => $extension['basename'],
							'package'     => sprintf( '%s/%s?siteurl=%s', $update['download_link'], $key, $url ),
						);
					}
				}
			}
		}

		return $transient;
	}

	/**
	 * Check for extension updates
	 *
	 * @return void
	 */
	public static function check_for_updates() {
		// Get current updates
		$updates = get_site_option( AI1WM_UPDATER, array() );

		// Get extension updates
		foreach ( self::get_extensions() as $slug => $extension ) {
			$response = wp_remote_get( $extension['about'], array(
				'timeout' => 15,
				'headers' => array( 'Accept' => 'application/json' ),
			) );

			// Add updates
			if ( ! is_wp_error( $response ) ) {
				if ( ( $response = json_decode( $response['body'], true ) ) ) {
					// Slug is mandatory
					if ( ! isset( $response['slug'] ) ) {
						return;
					}

					// Version is mandatory
					if ( ! isset( $response['version'] ) ) {
						return;
					}

					// Homepage is mandatory
					if ( ! isset( $response['homepage'] ) ) {
						return;
					}

					// Download link is mandatory
					if ( ! isset( $response['download_link'] ) ) {
						return;
					}

					$updates[ $slug ] = $response;
				}
			}
		}

		// Set new updates
		update_site_option( AI1WM_UPDATER, $updates );
	}

	/**
	 * Add "Check for updates" link
	 *
	 * @param  array  $links The array having default links for the plugin.
	 * @param  string $file  The name of the plugin file.
	 * @return array
	 */
	public static function plugin_row_meta( $links, $file ) {
		$modal = 0;

		// Add link for each extension
		foreach ( self::get_extensions() as $slug => $extension ) {
			$modal++;

			// Get plugin details
			if ( $file === $extension['basename'] ) {
				$url = add_query_arg( array( 'ai1wm_updater' => 1 ), network_admin_url( 'plugins.php' ) );

				// Check Purchase ID
				if ( get_site_option( $extension['key'] ) ) {

					// Add "Check for updates" link
					$links[] = Ai1wm_Template::get_content( 'updater/check', array(
						'url' => wp_nonce_url( $url, 'ai1wm_updater_nonce' ),
					) );

				} else {

					// Add modal
					$links[] = Ai1wm_Template::get_content( 'updater/modal', array(
						'url'   => wp_nonce_url( $url, 'ai1wm_updater_nonce' ),
						'modal' => $modal,
					) );

				}
			}
		}

		return $links;
	}

	/**
	 * Get extensions for update.
	 *
	 * @return array
	 */
	public static function get_extensions() {
		$extensions = array();

		// Add Dropbox Extension
		if ( defined( 'AI1WMDE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMDE_PLUGIN_NAME ] = array(
				'key'      => AI1WMDE_PLUGIN_KEY,
				'about'    => AI1WMDE_PLUGIN_ABOUT,
				'basename' => AI1WMDE_PLUGIN_BASENAME,
				'version'  => AI1WMDE_VERSION,
			);
		}

		// Add Google Drive Extension
		if ( defined( 'AI1WMGE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMGE_PLUGIN_NAME ] = array(
				'key'      => AI1WMGE_PLUGIN_KEY,
				'about'    => AI1WMGE_PLUGIN_ABOUT,
				'basename' => AI1WMGE_PLUGIN_BASENAME,
				'version'  => AI1WMGE_VERSION,
			);
		}

		// Add Amazon S3 extension
		if ( defined( 'AI1WMSE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMSE_PLUGIN_NAME ] = array(
				'key'      => AI1WMSE_PLUGIN_KEY,
				'about'    => AI1WMSE_PLUGIN_ABOUT,
				'basename' => AI1WMSE_PLUGIN_BASENAME,
				'version'  => AI1WMSE_VERSION,
			);
		}

		// Add Multisite Extension
		if ( defined( 'AI1WMME_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMME_PLUGIN_NAME ] = array(
				'key'      => AI1WMME_PLUGIN_KEY,
				'about'    => AI1WMME_PLUGIN_ABOUT,
				'basename' => AI1WMME_PLUGIN_BASENAME,
				'version'  => AI1WMME_VERSION,
			);
		}

		// Add Unlimited Extension
		if ( defined( 'AI1WMUE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMUE_PLUGIN_NAME ] = array(
				'key'      => AI1WMUE_PLUGIN_KEY,
				'about'    => AI1WMUE_PLUGIN_ABOUT,
				'basename' => AI1WMUE_PLUGIN_BASENAME,
				'version'  => AI1WMUE_VERSION,
			);
		}

		// Add FTP Extension
		if ( defined( 'AI1WMFE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMFE_PLUGIN_NAME ] = array(
				'key'      => AI1WMFE_PLUGIN_KEY,
				'about'    => AI1WMFE_PLUGIN_ABOUT,
				'basename' => AI1WMFE_PLUGIN_BASENAME,
				'version'  => AI1WMFE_VERSION,
			);
		}

		// Add URL Extension
		if ( defined( 'AI1WMLE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMLE_PLUGIN_NAME ] = array(
				'key'      => AI1WMLE_PLUGIN_KEY,
				'about'    => AI1WMLE_PLUGIN_ABOUT,
				'basename' => AI1WMLE_PLUGIN_BASENAME,
				'version'  => AI1WMLE_VERSION,
			);
		}

		// Add OneDrive Extension
		if ( defined( 'AI1WMOE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMOE_PLUGIN_NAME ] = array(
				'key'      => AI1WMOE_PLUGIN_KEY,
				'about'    => AI1WMOE_PLUGIN_ABOUT,
				'basename' => AI1WMOE_PLUGIN_BASENAME,
				'version'  => AI1WMOE_VERSION,
			);
		}

		return $extensions;
	}
}
