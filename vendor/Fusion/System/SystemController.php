<?php
namespace Fusion\System;

/*
* File: /system/core/KW_Controller.php
* Purpose: Base class from which all controllers extend
* 
*/

class SystemController {
	
	use Load;
	
	protected 	$db;
	private 	$controller;
	private 	$controller_class;
	private 	$controller_filename;
	protected 	$param;
	protected 	$route;
	protected 	$model;
	public 		$view;
	protected 	$action;
	protected 	$config;
	protected 	$data;
	public 		$session;
	public 		$helper;
	// Input sanitation class
	public 		$input;
	public 		$cache;
	public      $toolbox;
	
	public function __construct( \Fusion\Config\Config $config, Router $route, SystemModel $model, SystemView $view ) {
		
		$this->db = \Application::run('Database');
		$this->config = $config;
		$this->route = $route;
		$this->model = $model;
		$this->view = $view;
		// $this->data = $route;
		$this->session = self::session();
		$this->input = self::input();
		$this->cache = self::cache();
	}
	
	final function dispatch()
	{
		// Define child controller being worked with
		$this->controller = $this->route->controller;
		// The class name contained inside child controller
		$this->controller_class = $this->controller;
		// File name of child controller
		$this->controller_filename = ucwords($this->controller).'.php';
		// Action being requested from child controller
		$this->action = $this->route->action;
		$action = trim( strtolower( $this->route->action ) );
		// URL parameters
		$this->param = $this->route->param;
		
		// Search for requested controller file
		if( is_readable(CONTROLLERS_DIR.$this->controller_filename) ) {
			// File was found and has proper file permissions
			require_once CONTROLLERS_DIR.$this->controller_filename;
			
			if( class_exists($this->controller_class) )
			{
				 // File found and class exists, so instantiate controller class
				 $__instantiate_class = new $this->controller_class( $this->config, $this->route, $this->model, $this->view );
				 
				 if( method_exists($__instantiate_class, $action) )
				 {
				 	// Class method exists
				 	$__instantiate_class->$action();
				 }
				 else {
				 	// Valid controller, but invalid action
					$this->viewerror('errors/action', $this->controller_filename, $this->data, $this->route);
				 }
			}
			else {
				// Controller file exists, but class name
				// is not formatted / spelled properly
				$this->data['controller-error'] = 'Controller file exists, but class name is not formatted / spelled properly';
				$this->viewerror('errors/controller-bad-classname', $this->data['file'], $this->data, $this->route);
			}
		} 
		else
			// Controller file does not exist, or
			// does not have read permissions (644)
			$this->view('errors/controller', $this->route);
	}
	
	public function cache()
	{
		return \Application::run('Cache');
	}

	public function input() {

		return \Toolbox::helper('Sanitize');
	}

	public function model($model)
	{
		return \Application::run('SystemModel')->model($model);
	}

	public function redirect($url) {

		return Load::redirect($url);
	}
	
	public function session() {

		return \Application::run('Session');
	}

	public function toolbox($helper) {

		/**
		 * Load a Toolbox helper
		 */
		$helper = ucwords($helper);
		return \Toolbox::helper("$helper");
	}

}