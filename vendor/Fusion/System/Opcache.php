<?php
namespace Fusion\System;

/**
 * File: /vendor/Fusion/System/Cache.php
 * Purpose: Memcached class extension for application caching
 * 
 * Note: Change both instances of \Memcached to \Memcache if
 * memcached is not installed or supported on your server
 */

class Opcache {
	
	public $invalidate;
	public $reset;

	public function __construct() {
		
		// Sets how much memory to use
		ini_set('opcache.memory_consumption', 128);

		// Sets how much memory should be used by OPcache for storing internal strings 
		// (e.g. classnames and the files they are contained in)
		ini_set('opcache.interned_strings_buffer', 8);

		// The maximum number of files OPcache will cache
		ini_set('opcache.max_accelerated_files', 4000);

		// How often (in seconds) to check file timestamps for changes to the shared
		// memory storage allocation.
		ini_set('opcache.revalidate_freq', 60);

		// If enabled, a fast shutdown sequence is used for the accelerated code
		// The fast shutdown sequence doesn't free each allocated block, but lets
		// the Zend Engine Memory Manager do the work.
		ini_set('opcache.fast_shutdown', 1);

		// Enables the OPcache for the CLI version of PHP.
		ini_set('opcache.enable_cli', 1);

		// If you use any library or code that uses code annotations you must enable save comments:
		ini_set('opcache.save_comments', 1);

	}

	function configuration() {
	
		\Kint::dump( opcache_get_configuration() );
	}

	function invalidate( $file ) {
		
		// Invalidates a specific cached script. The script will be parsed again on the next visit.
		// Be sure to include the full location to the file; typically you will use BASEPATH to point
		// to the desired file -- e.g.,  BASEPATH.'public/views/example/example.php'
		return opcache_invalidate( $file, true );
	}

	function reset() {
	
		return opcache_reset();
	}

	function status() {
	
		var_dump( opcache_get_status() );
	}

}