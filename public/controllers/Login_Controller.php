<?php

/**
 * This is simply a working example of how to use the
 * Sanitize, Validate and Session helpers.
 *
 * For built-in functionality, we can use the input field
 * names / id as the session key to set. Example is in the
 * validate() method below, where we first sanitize the entire
 * $_POST array. Then we use the validate helper to verify
 * that the sanitized data is a properly formatted email,
 * and if it is, we use the session helper to set the session
 * email ($_SESSION['email'] = $_POST['email']).
 *
 * The benefit to this is automated session keys, rather than
 * building them manually:
 * we are taking <input name="email">, sanitizing and validating
 * it, and then setting the $_SESSION['email'].
 * 
 * Will be adding the option to modify the session key name shortly
 */

class Login_Controller extends Fusion\System\SystemController {
	
	public function index() {
		
		$this->redirect('http://localhost/textbook/member/login');		
	}
	
	public function validate() {

		$email = $this->input->validate->email($_POST['email']);
		if( $email == TRUE )
			$this->session->set('email', $_POST['email']);
		else
			echo 'Not a valid email';

		$this->session->data();
	}
	
}