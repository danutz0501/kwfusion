<?php

class Newsletter_Controller extends Fusion\System\SystemController {
	
	public function __construct() {
		
		if( $this->cache()->fetch('email') == FALSE )
			$this->redirect('dashboard/login');	
	
	}
	
	public function index() {

		$this->view('newsletter/index');			
	}
	
	public function drafts() {

		$this->view('newsletter/drafts');			
	}
		
}