<?php
/**
* file: /vendor/Fusion/System/Init.php
*
* System initialization begins here
*
* We are simply using the registry (/vendor/Fusion/System/Registry.php)
* to define dependency containers
*
*/

# Global classes, provides failsafe for un-namespaced
use \PDO as PDO;
use \Memcache as Memcache;
use \Memcached as Memcached;

/**
 * Set default time zone
 */
ini_set('date.timezone', 'America/New_York');

/**
 * Filter input globally
 */
ini_set('filter.default', 'full_special_chars');
ini_set('filter.default_flags', 0);

###############################################
// Add `System Config` to the registry array //
###############################################
Application::register('Config', function() {
	
	return new Fusion\Config\Config;
});

###############################################
// Add `Memcache` to the registry array //
###############################################
Application::register('Cache', function() {
	
	return new Fusion\System\Cache;
});

##############################################
// Add `Sessions` to the registry array //
##############################################
\Application::register('Session', function() {

    return new Session;
});
###############################################
// Add `Opcache` to the registry array //
###############################################
Application::register('Opcache', function() {
	
	return new Fusion\System\Opcache;
});

###############################################
// Add `Loader` to the registry array //
###############################################
Application::register('Loader', function() {
	
	return new Fusion\System\Loader;
});


###############################################
// Add `System Routes` to the registry array //
###############################################
Application::register('Router', function() {
	
	return new Fusion\System\Router;
});

###################################################
// Add `System Controller` to the registry array //
###################################################
Application::register('SystemController', function() {
	
	// Give the System Controller access to:
	// database, config, router, system model, system view
	$config = Application::run('Config');
	$route 	= Application::run('Router');
	$model 	= Application::run('SystemModel');
	$view 	= Application::run('SystemView');

    $sys_controller = new Fusion\System\SystemController($config, $route, $model, $view);

    $sys_controller->dispatch();

    return $sys_controller;
});

###################################################
// Add `Unit Controller` to the registry array //
###################################################
Application::register('UnitController', function() {

    return new Fusion\System\UnitController();
});
##############################################
// Add `System Model` to the registry array //
##############################################
Application::register('SystemModel', function() {

	$db = Application::run('Database');
    return new Fusion\System\SystemModel($db);
});

##############################################
// Add `System Views` to the registry array //
##############################################
Application::register('SystemView', function() {
    
    $cache = Application::run('Cache');
    return new Fusion\System\SystemView($cache);
});


##########################################
// Add `Template` to the registry array //
##########################################
Application::register('Template', function() {
	
	// Give the System Template access to:
	// config, router, system model, system view
	$config = Application::run('Config');
	$route 	= Application::run('Router');
	$view 	= Application::run('SystemView');
	$load 	= Application::run('Loader');
	$data 	= array();

    return new Fusion\System\Template( $config, $route, $view, $load, $data );
});

/**
 * Register Toolbox helpers prior to usage
 */

 // Build Pagination helper
Toolbox::register("Pagination", function() {

	return new Fusion\Toolbox\Pagination;
});
 // Build Validation helper
Toolbox::register("Validate", function() {

	return new Fusion\Toolbox\Validate;
});
 // Build Validation helper
Toolbox::register("Input", function() {

	return new Fusion\Toolbox\Input;
});
 // Build Validation helper
Toolbox::register("Sanitize", function() {

	return new Fusion\Toolbox\Sanitize;
});
 // Build Hash helper
Toolbox::register("Hash", function() {
	
	return new Fusion\Toolbox\Hash;
});
 // Build Hash helper
Toolbox::register("Formatter", function() {
	
	return new Fusion\Toolbox\Formatter;
});
 // Build Hash helper
Toolbox::register("Breadcrumbs", function() {
	
	return new Fusion\Toolbox\Breadcrumbs;
});
 // Build Hash helper
Toolbox::register("Environment", function() {
	
	return new Fusion\Toolbox\Environment;
});
