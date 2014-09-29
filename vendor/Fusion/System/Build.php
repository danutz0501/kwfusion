<?php
namespace Fusion\System;

/**
 * Here we will take all the collected classes and data
 * and build the application
 */

class Build {

	public $controller;
	public $data;
	public $model;
	public $view;
	public $route;
	public $template;


	public function controller( SystemController $controller ) {

		return $this->controller = $controller;
	}

	public function model( SystemModel $model ) {

		return $this->model = $model;
	}

	public function route( Router $route ) {

		return $this->route = $route;
	}

	public function template( Template $template ) {

		return $this->template = \Application::run('Template');
	}
	
	public function toolbox( $helper ) {

		return Toolbox::helper( $helper );
	}
	
	public function view( SystemView $view ) {

		return $this->view = $view;
	}

}