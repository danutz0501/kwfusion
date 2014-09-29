<?php
namespace Fusion\System;

/*
* File: /system/core/Router.php
* Purpose: retrieve $_GET['request'] and break it down into segments. Each
* segment is used to create an MVC routing system
*/

class Router{

	public $controller;
	public $controller_class;
	public $action;
	public $param;
	public $param1;
	public $param2;
	public $param3;
	public $param4;
	public $param5;
	// Files
	public $controller_dir;
	public $view_dir;
	// Pagination
	public $page;

	public function __construct()
	{
		if( isset($_GET['page']) )
			$this->page = (int) $_GET['page'];
		
		self::build();
	}
	
	public function build()
	{

		if( isset($_GET['request']) && ! empty($_GET['request']) )
		{
			// Get the requested URL, and break it up into segments
			$_request = explode('/', $_GET['request'].'/');
			
			/**
			* At this point, we have the $_GET['request'] stored in an array
			* 
			* Example URL and usage:
			* 
			* index.php?request=controller/action/param1/param2/param3
			* 
			* $_request would have the following values:
			* 
			* 	controller
			*  	action
			*  	param1
			*  	param2
			*  	param3
			* 
			* @$_request
			* 
			*/
			
			// Set the controller to the first segment from $_request
			// Otherwise default to the WelcomeController
			$_controller = array_slice($_request, 0, 1);

			if( isset($_controller) && ! empty($_controller) && $_controller != '') {
				$_controller = implode("/", $_controller);
				// Trim whitespace, sanitize profusely and set controller name
				$this->controller = trim( htmlentities( ucwords( strip_tags( $_controller ) ) ) ).'_Controller';
			}
			else
				// Something went wrong. Set to Welcome Controller
				$this->controller = 'Welcome_Controller';
			
			$this->controller_class = $this->controller;
			
			// Set the action to the second segment from $_request
			// Otherwise set to the default action index()
			$_action = array_slice($_request, 1, 1);

			foreach($_action as $_a)
			if( ! empty($_a) && isset($_a) && $_a != '' )
				$this->action = trim(htmlentities(strtolower($_a)));
			else
				$this->action = 'index';
			
			$_params[] = array_slice($_request, 2);
			
			foreach($_params as $_param)
			{
				// Check for parameters

				// First parameter
				if( array_key_exists(0, $_param))
					$this->param1 = trim( htmlentities( strip_tags( $_param[0] ) ) );
				else
					$this->param1 = NULL;
					
				if( array_key_exists(1, $_param))
					$this->param2 = trim( htmlentities( strip_tags( $_param[1] ) ) );
				else
					$this->param2 = NULL;
				
				if( array_key_exists(2, $_param))
					$this->param3 = trim( htmlentities( strip_tags( $_param[2] ) ) );
				else
					$this->param3 = NULL;
					
				if( array_key_exists(3, $_param))
					$this->param4 = trim( htmlentities( strip_tags( $_param[3] ) ) );
				else
					$this->param4 = NULL;
				
				if( array_key_exists(4, $_param))
					$this->param5 = trim( htmlentities( strip_tags( $_param[4] ) ) );
				else
					$this->param5 = NULL;
			}

		} 
		else if( ! isset($_GET['request']) || empty($_GET['request']) || ! isset($_controller)) {

			// Define your default controller here
			// By default, Welcome Controller is active
			// when visitors land on your home page.
			$this->controller = 'Welcome_Controller';
			
			// Do not edit or remove below
			$this->controller_dir = CONTROLLERS_DIR;
			$this->action = 'index';
		}
	}
}