<?php

/**
 * Andrew Rout, 9/28/2014
 *
 * === Purpose ===
 *
 * Delete old mysql database backups in order to conserve
 * space on the server.
 *
 * === Program flow ===
 *
 * Scan all backup folders contained in backup folder
 * for backup files older than 31+ days, and delete them.
 *
 */
$scan = new RecursiveDirectoryIterator('/home/dynamica/_DB_BACKUPS');


foreach( new RecursiveIteratorIterator( $scan ) as $filename => $file) {

	// Strip year_m_day_ from filename 
	$new_filename = substr( $filename, -14);
	// Now strip .sql extension to get timestamp of creation date
	$file_created_date = substr( $new_filename, -14, 10);

	$do_not_delete_backup = strpos($new_filename, 'backup.php');
	$do_not_delete_cleanup = strpos($new_filename, 'cleanup.php');
	
	// Make sure that we dont delete backup.php or cleanup.php
	if ( $do_not_delete_backup === false && $do_not_delete_cleanup === false ) {
	    
	    if( (int)time() - $file_created_date >= 2678400 )
		unlink( $filename );
	}
}
