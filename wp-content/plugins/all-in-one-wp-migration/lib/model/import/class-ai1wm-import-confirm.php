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

class Ai1wm_Import_Confirm {

	public static function execute( $params ) {

		// Obtain the name of the archive
		$name = ai1wm_archive_name( $params );

		// Obtain the size of the archive
		$size = ai1wm_archive_bytes( $params );

		// Check file size of the archive
		if ( false === $size ) {
			throw new Ai1wm_Not_Accesible_Exception(
				__( "Unable to get the file size of <strong>{$name}</strong>", AI1WM_PLUGIN_NAME )
			);
		}

		$allowed_size = apply_filters( 'ai1wm_max_file_size', AI1WM_MAX_FILE_SIZE );

		// Let's check the size of the file to make sure it is less than the maximum allowed
		if ( ( $allowed_size > 0 ) && ( $size > $allowed_size ) ) {
			throw new Ai1wm_Import_Exception(
				__(
					"The file that you are trying to import is over the maximum upload file size limit of {$allowed_size}.<br />" .
					"You can remove this restriction by purchasing our " .
					"<a href=\"https://servmask.com/products/unlimited-extension\" target=\"_blank\">Unlimited Extension</a>.",
					AI1WM_PLUGIN_NAME
				)
			);
		}

		// Set progress
		Ai1wm_Status::confirm( __(
			'The import process will overwrite your database, media, plugins, and themes. ' .
			'Please ensure that you have a backup of your data before proceeding to the next step.',
			AI1WM_PLUGIN_NAME
		) );

		exit;
	}
}
