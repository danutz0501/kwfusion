<?php

class Dashboard_Controller extends Fusion\System\SystemController {
	
	public function index() {
		
		if( $this->cache()->fetch('email') == FALSE )
			$this->redirect('dashboard/login');
		else
			$this->view('welcome/index');
	}

	public function home() {
		
		if( $this->cache()->fetch('email') == FALSE )
			$this->redirect('dashboard/login');
			
		$data['session_username'] = $this->session()->fetch('username');
		$this->view('welcome/index', $data);			
	}





	
	
	/*****************************************************************\
	*
	* 			LOGIN / SIGNUP FUNCTIONS BELOW
	*
	*****************************************************************/
	function signup() {
		
		$this->view('admin/forms/signup_form', $data = NULL);
	}

	function signup_validate() {
		
		// Begin form validation by sanitizing all $_POST submitted
		$form = $this->input->sanitize->form($_POST);
		
		/**
		 * Now set validation rules for each field.
		 * Pass the sanitized $form variable above
		 * to the function below
		 */		
		$check_if_valid = $this->input->validate->form($form, array(
		
			'password' 			=> 'required|max_len,40|min_len,6',
			'confirm_password'  => 'required|contains,'.$form['password'].'',
			'first_name' 		=> 'required|valid_name',
			'last_name' 			=> 'required|valid_name',
			'email'    			=> 'required|valid_email'
		));
		
		/**
		 * Now validate the form according to the rules set above.
		 * If $check_if_valid is true, form was successfully validated,
		 * so we can go ahead and process the data.
		 * Otherwise, display the errors encountered.
		 */
		if($check_if_valid === true) {
			// valid submission -- continue
			
			// NOTE THE []; $form must be converted to array
			/*
			foreach($form as $form[]) {
				
				// $phone = $this->toolbox('Formatter')->PhoneNumber($form['phone']);
			}
			*/
			$this->model('Member')->create_member($form);
			$this->redirect('dashboard/login');
				
			// Send email to Dan to notify of new message
            $to = 'jared@dynamicartisans.com, andrewr@dynamicartisans.com';

			// subject
			$subject = 'New Administrator Account Pending';
			
			// message
			$message = '
			<html>
			<head>
			  <title>'.$subject.'</title>
			</head>
			<body>
			  <p>A new Administrator account was created by '.$form['first_name'] . ' ' .$form['last_name'].'. If this person is authorized to access the DAGI backend, 
			  you must manually confirm this account by updating the users table to \'Yes\' in the database named backend. Otherwise, no further action is necessary; 
			  new accounts are locked out by default until it has been manually reviewed and approved.</p>
			</body>
			</html>
			';

			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			// Additional headers
			$headers .= 'To: Jared Wolf <jared@dynamicartisans.com>, Andrew Rout <andrewr@dynamicartisans.com>' . "\r\n";
			$headers .= 'From: DAGI Administration Panel <no-reply@dynamicartisanss.com>' . "\r\n";
			
			
			// Mail it
			mail($to, $subject, $message, $headers);
			exit;
		}
		else {
			// Did not pass validation -- Show errors
			echo '<div class="alert alert-danger">';
			foreach( $check_if_valid as $invalid )
				echo '<i class="fa fa-exclamation-triangle"></i> '. $invalid .'<br>';
			echo '</div>';
			$this->view('forms/signup_form', $data = $form);		
		}
	}

	public function login() {

		$data['a'] = rand(1, 5);
		$data['b'] = rand(1, 5);
		$data['answer'] = $data['a'] * $data['b'];
		$this->view('admin/forms/login_form', $data);
	}
	
	public function login_validate() {

		// Begin form validation by sanitizing all $_POST submitted
		$form = $this->toolbox('Sanitize')->form($_POST);

		// Math problem not solved correctly, no need to continue
		if( $form['math'] !== $form['math_answer'] ) {
			$this->redirect('dashboard/login/error/security');
			exit;
		}
		// Now we can check the submitted form to see if it is filled out properly
		$check_if_valid = $this->toolbox('Validate')->form($form, array(
			
			'email'		=> 'required|valid_email',
			'password'	=> 'required|max_len,100|min_len,6'
		));

		if( $check_if_valid == TRUE ) {

			// Form is valid -- continue to login query
			if( $this->model('Member')->check_login($form) == TRUE )
				// Valid login
				$this->redirect('dashboard/home');
			else
				// Invalid login -- redirect to login error page
				$this->redirect('dashboard/login/error');
		}
		else {
		    // Did not pass validation -- Show errors
			echo '<div class="alert alert-danger">';
			foreach( $check_if_valid as $invalid )
				echo '<i class="fa fa-exclamation-triangle"></i> '. $invalid .'<br>';
			echo '</div>';
			$this->view('admin/forms/login_form', $data = NULL);
		}
		
	}

	public function logout() {

        $this->cache->destroy();
		$this->redirect('dashboard/index');
	}
}