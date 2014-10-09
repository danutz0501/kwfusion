<?php

class Member_Controller extends Fusion\System\SystemController {

    /**
     * Login and signup functions moved to Traits file for sake
     * of keeping the member controller as uncluttered as possible,
     * as well as being reused for admin activities
     */

	use Fusion\System\Account;
	
	public function index() {
		/*
		if( $this->cache()->get('username') == FALSE ) {

			$this->redirect('member/login');
			exit;
		}*/

		$data['session_username'] = $this->session()->fetch('username');
		$this->view('member/index', $data);			
	}

	public function home() {

		if( $this->cache()->fetch('username') == FALSE ) {

			$this->redirect('member/login');
			exit;
		}
		
		$data['session_username'] = $this->session()->fetch('username');
		$this->view('member/index', $data);			
	}
	
}
