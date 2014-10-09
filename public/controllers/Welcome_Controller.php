<?php

class Welcome_Controller extends Fusion\System\SystemController {
	

	public function index() {

		/*
		* When using models, we load models from inside the controller by simply calling $this->model('Model_Name')
		* We can then use that model's available methods by chaining the method to the
		* $this->model('Model_Name'). 
		* 
		* Example
		* To call the select() method from the Welcome model, 
		* we would to it like this:
		* $this->model('welcome')->select()
		* 
		* If select() from the example above coincides with one of the built in functions
		* contained in KW_Model, it will simply override it, since $this->model points to
		* a child class of KW_Model, therefore avoiding any conflicts.
		*/
		// $q = "SELECT * FROM users WHERE username = ?";
		// $param = 'Andrew';
		// $data['param'] = $this->route->param1;
		// $data['user'] = $this->model('welcome')->select($q, $param);
		// $this->data['users'] = $this->model('welcome')->select();

		// Load either welcome page or login page, depending on whether user is logged in		
		// if( $this->cache()->fetch('email') == FALSE )
		//	$this->redirect('member/login');
		$this->view('welcome/index');			
	}
		
}