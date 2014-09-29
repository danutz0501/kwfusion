<?php
namespace Fusion\Config;

class Config{

	public $setting = array();


	public function __construct() {

		/**
		 * Define site url here
		 * If you will be using SSL, use relative URLs (i.e., //example.com instead of http://example.com)
		 * NO TRAILING SLASHES AT THE END OF THE URL
		 */
		$this->setting['site_url'] = 'http://localhost/kwfusion';

		/**
		 * Define the site name
		 */
		$this->setting['site_name'] = 'kW Fusion';

		/**
		 * Does your website/company have a tagline or slogan?
		 */
		$this->setting['site_slogan'] = 'A modern and responsive PHP general purpose framework';
		
		/**
		 * Customer service or support email address
		 */
		$this->setting['site_email'] = 'arout@kwfusion.com';

		/**
		 * Location of front controller
		 */
		$this->setting['basepath'] = BASEPATH;

		/**
		 * Location of the system directory
		 */
		$this->setting['system_folder'] = $this->setting['basepath'].'vendor/Fusion/System/';

		/**
		 * Location of the public directory
		 */
		$this->setting['public_folder'] = $this->setting['basepath'].'public/';

		/**
		 * Name of the directory storing template files ( css/js/img, etc. )
		 */
		$this->setting['template_name'] = 'update';

		/**
		 * Location of template directory
		 */
		$this->setting['template_folder'] = $this->setting['basepath'].'public/template/'.$this->setting['template_name'].'/';

		/**
		 * Template URL for fetching CSS / JS / IMG files
		 */
		$this->setting['template_url'] = $this->setting['site_url'].'/public/template/'.$this->setting['template_name'].'/';

		/**
		 * Gzip compression
		 * Set to true to enable compression, false to disable
		 * 
		 * If you get a blank page when compression is enabled,
		 * it means that you are putting out content before the page
		 * has begun loading.
		 *
		 * Nothing can be sent to the browser before compression begins,
		 * even blank spaces.
		 */
		$this->setting['compression'] = TRUE;

		/**
		 * Enable / disable caching
		 * Cache files with APC
		 */
		$this->setting['cache'] = TRUE;
        
        /**
         * Measure script execution time
         */
		$this->setting['execution_time'] = (microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]);

	}

	public final function setting($setting) {

		return $this->setting["$setting"];
	}

}
