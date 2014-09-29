<?php
namespace Fusion\System;

/**
 * File: /vendor/Fusion/System/Cache.php
 * Purpose: Memcached class extension for application caching
 * 
 * Note: Change both instances of \Memcached to \Memcache if
 * memcached is not installed or supported on your server
 */

class Cache extends Session{

}

##############################################
// Add `Cache` to the registry array //
##############################################
\Application::register('Cache', function() {
	
	return new Cache();

});
