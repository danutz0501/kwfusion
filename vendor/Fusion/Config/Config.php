<?php
namespace Fusion\Config;

class Config{

	public $setting = array();


	public function __construct() {

		/**
		 * Define site url here
		 * If you will be using SSL, use relative URLs (i.e., //example.com instead of http://example.com)
		 * NO TRAILING SLASHES AT THE END OF THE URL
		 *
		 * The default setting below SHOULD work for most servers; however, if you still have issues, you
		 * may comment out the two lines below and hardcode your URL into the variable, as shown below
		 *
		 * $this->setting['site_url'] = 'http://example.com';
		 */
		$uri[] = explode('/', $_SERVER["REQUEST_URI"]);
		$this->setting['site_url'] = '//'.$_SERVER["SERVER_NAME"].'/'.$uri[0][1];

		/**
		 * Define the company / site name ( example: Acme Plumbing, LLC )
		 */
		$this->setting['site_name'] = 'Company Name';

		/**
		 * Does your website/company have a tagline or slogan?
		 */
		$this->setting['site_slogan'] = 'A catchy slogan coming soon!';
		
		/**
		 * Customer service or support email address
		 */
		$this->setting['site_email'] = 'admin@'.$_SERVER["SERVER_NAME"].'.com';

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
		 * Cache files with Memcached
		 */
		if (class_exists('Memcached'))
			$this->setting['cache'] = TRUE;
		else
			$this->setting['cache'] = FALSE;
        
        $this->setting['maintenance_mode'] = FALSE;
        /**
         * Measure script execution time
         */
		$this->setting['execution_time'] = (microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]);
		
		/**
		 * Release version
		 */
		$this->setting['software_version'] = '1.0.2';
	}

	public final function setting($setting) {

		return $this->setting["$setting"];
	}

}
