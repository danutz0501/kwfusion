<?php
namespace Fusion\System;

class Template{
	
	public $config;
	public $data = array();
	public $route;
	public $load;
	public $cache;

	public function __construct( \Fusion\Config\Config $config, Router $route, SystemView $view, Loader $load, $data )
	{
		$this->config = $config;
		$this->route = $route;
		$this->load = $load;
		$this->view = $view;
		$this->data = $data;
		$this->cache = self::cache();
	}

	public function cache()
	{
		return \Application::run('Session');
	}
	
	public function header()
	{
		if( is_readable(TEMPLATE_BASE_PATH.'header.php') )
			require_once TEMPLATE_BASE_PATH.'header.php';
		else
			$this->load->view('error/template_header');
	}
	
	public function footer()
	{
		$config = $this->config;

		if(is_readable(TEMPLATE_BASE_PATH.'footer.php'))
			$this->load->template( 'footer', null, $this->config, null );
		else
			$this->load->view('error/template_footer');
	}

}