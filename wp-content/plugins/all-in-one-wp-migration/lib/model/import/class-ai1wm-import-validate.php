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

class Ai1wm_Import_Validate {

	public static function execute( $params ) {

		// Set progress
		Ai1wm_Status::info( __( 'Unpacking archive...', AI1WM_PLUGIN_NAME ) );

		// Open the archive file for reading
		$archive = new Ai1wm_Extractor( ai1wm_archive_path( $params ) );

		// Validate the archive file consistency
		if ( ! $archive->is_valid() ) {
			throw new Ai1wm_Import_Exception(
				__(
					'The archive file is corrupted. Follow this article to resolve the problem: ' .
					'<a href="https://help.servmask.com/knowledgebase/corrupted-archive/" target="_blank">https://help.servmask.com/knowledgebase/corrupted-archive/</a>',
					AI1WM_PLUGIN_NAME
				)
			);
		}

		// Unpack package.json, multisite.json and database.sql files
		$archive->extract_by_files_array(
			ai1wm_storage_path( $params ),
			array(
				AI1WM_PACKAGE_NAME,
				AI1WM_MULTISITE_NAME,
				AI1WM_DATABASE_NAME,
			)
		);

		// Close the archive file
		$archive->close();

		// Check package.json file
		if ( false === is_file( ai1wm_package_path( $params ) ) ) {
			throw new Ai1wm_Import_Exception(
				__( 'Invalid archive file. It should contain <strong>package.json</strong> file.', AI1WM_PLUGIN_NAME )
			);
		}

		return $params;
	}
}
