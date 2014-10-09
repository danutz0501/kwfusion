<?php
/**
 *
 * An open source application development framework for PHP 5.5 or newer
 *
 * @package		kW Fusion
 * @author		Andrew Rout [ arout@kwfusion.com ]
 * @copyright	Copyright (c) 2014, Andrew Rout
 * @license		http://kwfusion.com/support/license
 * @link		http://kwfusion.com
 * @since		Version 1.0
 * @filesource
 *
 */

/**
 * Let's build a website!
 *
 * Set Error Reporting environment here.
 * Default options are essentially "ON / OFF". We will display all errors / notices
 * to help us along during the development,
 * but be sure to set error reporting to FALSE in a live environment.
 *
 */
use Fusion\System;
use Fusion\Config;
use Fusion\Database;
use Fusion\Toolbox;

// Turn error reporting off by setting this value to FALSE
define('DEBUG', TRUE);

if ( defined('DEBUG') )
{
	switch (DEBUG)
	{
		case TRUE:
            error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
			ini_set('display_errors', '1');
		break;

		case FALSE:
			error_reporting(0);
			ini_set('display_errors', '0');
		break;

		default:
			exit("The debugging environment is not set correctly. Edit the index.php file
			( location: <code>".__FILE__."</code> ) and set DEBUG to either TRUE or FALSE");
	}
}

/**
 * Define the path to the front controller (this file)
 */
define('BASEPATH', dirname(__FILE__).'/');

/**
 * Define the path to vendors
 */
define('VENDOR_PATH', BASEPATH.'vendor/');

/**
 * Define the path to Fusion dir
 */
define('FUSION_PATH', BASEPATH.'vendor/Fusion/');

/**
 * Define path to System
 */
define('SYSTEM_PATH', VENDOR_PATH.'Fusion/System/');

/**
 * Fetching required application files
 */

// Get Composer autoloader
require_once(VENDOR_PATH.'autoload.php');
// Load registry
require_once(SYSTEM_PATH.'Registry.php');
// Load directory definitions
require_once(SYSTEM_PATH.'Paths.php');
// Fetch autoloader
require_once(SYSTEM_PATH.'Autoload.php');
// Begin registering classes
require_once(SYSTEM_PATH.'Init.php');

// When adding your own files to autoload, append it to the end of array
// Example:  autoload_toolbox(  array( 'Filename_of_your_helper', 'another_custom_file' ) );
// Please note that the below autoloaders do not implement lazy loading --
// your files will be loaded into the application whether a script needs it or not
autoload_db(  array( 'Database' ) );
autoload_system( array( 'Traits', 'Interfaces', 'Session' ) );
// Uncomment below and insert your custom Toolbox helpers to be loaded
autoload_toolbox( array( 'Email' ) );

// Run opcache
Application::run('Opcache');
// Some Opcache examples
// Application::run('Opcache')->invalidate(BASEPATH.'vendor/Fusion/System/Autoload.php');
// Application::run('Opcache')->status();
// Application::run('Opcache')->configuration();
// Application::run('Opcache')->reset();

/**
 * Off we go
 */
$template = Application::run('Template');

$template->header();

Application::run('SystemController');

$template->footer();

/**
KINT example

## Docs available at http://raveren.github.io/kint/#about

// create demo data
$variable = array(1, 17, "hello", null, array(1, 2, 3));

// use KINT directly (which has been loaded automatically via Composer)
Kint::dump($variable);

// or shorthand dump method

d($variable);

// or, to seize execution after dumping use dd();
dd( $variable ); // same as d( $variable ); die;

// to see trace:
Kint::trace();

// or pass 1 to a dumper function
Kint::dump( 1 );

// to disable all output
Kint::enabled(false);

*/
