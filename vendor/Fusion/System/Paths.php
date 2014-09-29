<?php

/**
* Define system and System paths
* System folder contains core system files
* System folder is the "public" directory where
* all controllers, models, views, template files,
* plugins, hooks, etc are stored
*/
define('PUBLIC_PATH', BASEPATH.'public/');
define('CONFIG_PATH', FUSION_PATH.'Config/');

require CONFIG_PATH.'Config.php';
$config = new Fusion\Config\Config;

/**
* Define base url
*/
define('BASEURL', $config->setting['site_url'].'/');

/**
* Define directories
*/

// User-created controllers/models/views
define('CONTROLLERS_DIR', PUBLIC_PATH.'controllers/');
define('MODELS_DIR', PUBLIC_PATH.'models/');
define('VIEWS_DIR', PUBLIC_PATH.'views/');

// Header, content and footer php files located in TEMPLATE_BASE_PATH
define('TEMPLATE_BASE_PATH', PUBLIC_PATH.'template/');

// Store the CSS/JS/IMG files in subdirectory, making it easy
// to swap templates on the fly
define('TEMPLATE_PATH', $config->setting['template_folder']);
define('TEMPLATE_URL', $config->setting['template_url']);

/**
* Third party / plugins
*/
define('PLUGINS_DIR', PUBLIC_PATH.'plugins/');

/**
* Maxmind GeoIP directory
*/
define('GEOIP_DIR', PLUGINS_DIR.'geoip/');