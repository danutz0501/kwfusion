<?php
namespace Fusion\System;

trait Load {
	
	/**
	 * Shared map for Loader and Autoload classes
	 */

	function cache()
	{
		return \Application::run('Cache');
	}

	function config($className) {
		
		foreach( $className as $className ){
			
			$filename = SYSTEM_PATH."config/" . $className . ".php";
			if (is_readable($filename)) {
				require_once $filename;
			} 
			else {
				echo '<div class="alert alert-danger"><h1>Fatal Error</h1>
				<h4>Could not load core system file: '. $className .'.php</h4>
				Please ensure that the file exists and permission to read the file (644)
				</div>';
				exit;
			}
		}
	}
	
	function core($className) {
		
		foreach( $className as $className )
		{
			$filename = SYSTEM_PATH."core/" . ucwords($className) . ".php";
			if (is_readable($filename)) {
				require_once $filename;
			}
			else {
				echo '<div class="alert alert-danger"><h1>Fatal Error</h1>
				<h4>Could not load core system file: <code>'. $className .'.php</code></h4>
				Please ensure that the file exists and permission to read the file (644)
				</div>';
				exit;
			}
		}
	}
	
	function redirect($url) {
		
		if( strpos($url, 'http://') )
			return header('Location: '.$url);

		elseif( strpos($url, 'https://') )
			return header('Location: '.$url);
		
		else
			return header('Location: '.BASEURL.$url);
	}

	function hooks($className) {
		
		foreach( $className as $className )
		{
			$filename = SYSTEM_PATH."hooks/" . $className . ".php";
			if (is_readable($filename)) {
				require_once $filename;
			}
			else {
				echo '<div class="alert alert-danger"><h1>Fatal Error</h1>
				<h4>Could not load hook file: <code>'. $className .'.php</code></h4>
				Please ensure that the file exists and permission to read the file (644)
				</div>';
				exit;
			}
		}
	}
	
	function model($file){
        $dir = MODELS_DIR;
		$file = ucwords($file);
		
		if( is_readable($dir.$file.'Model.php') ){
			$this->db = \Application::run('Database');
			require_once( $dir.$file.'Model.php' );
			$this->model = $file.'Model';
			return $this->model = new $this->model($this->db);
		}
		else
			require_once($dir.'errors/model.php');
    }

	function route($param){
		$route = \Application::run('Router');
		return $route->$param;
	}
	
	function toolbox($className) {
		
		foreach( $className as $className ){
			$filename = SYSTEM_PATH."toolbox/" . ucwords($className) . ".php";
			if (is_readable($filename)) {
				require_once $filename;
			}
			else {
				echo '<div class="alert alert-danger"><h1>Fatal Error</h1
				><h4>Could not load toolbox helper file: <code>'. $className .'.php</code></h4>
				Please ensure that the file exists and permission to read the file (644)
				</div>';
				exit;
			}
		}
	}
	
    function view($file, $data = NULL){
    	
        $dir = VIEWS_DIR;

		if( is_readable($dir.$file.'.php') ) {
			require_once( $dir.$file.'.php' );
		}
		else {
			$filename = $dir.$file.'.php';
			self::viewerror($filename, $data);
		}
    }

    function viewerror($file, $data = NULL){
    	
        $dir = VIEWS_DIR;

		if( is_readable($dir.$file.'.php') ) {
			require_once( $dir.$file.'.php' );
		}
		else {
			$filename = $file;
			require_once($dir.'errors/view.php');
		}
    }

    function template($file, $data = NULL, $config){
		
        $dir = TEMPLATE_BASE_PATH;

		if( is_readable($dir.$file.'.php') )
			require_once( $dir.$file.'.php' );
		else
			require_once($dir.'errors/error-model.php');
    }

}

trait Account {

	#########################
	#  Login functions      #
	#########################
	function login() {

		$this->view('forms/login_form');
	}

	function logout() {

        $this->cache->destroy();
		$this->redirect('welcome/index');
	}
	
	function login_validate() {

		// Begin form validation by sanitizing all $_POST submitted
		$form = $this->toolbox('Sanitize')->form($_POST);

		// Now we can check the submitted form to see if it is filled out properly
		$check_if_valid = $this->input->validate->form($form, array(
			
			'email'    => 'required|valid_email',
			'password' => 'required|max_len,100|min_len,6'
		));

		if( $check_if_valid == TRUE ) {

			// Form is valid -- continue to login query
			if( $this->model('Member')->check_login($form) )
				// Valid login
				$this->redirect('member/home');
			else
				// Invalid login -- redirect to login error page
				$this->redirect('member/login/error');
		}
		else {
		    // Did not pass validation -- Show errors
			echo '<div class="alert alert-danger">';
			foreach( $check_if_valid as $invalid )
				echo '<i class="fa fa-exclamation-triangle"></i> '. $invalid .'<br>';
			echo '</div>';
			$this->view('forms/login_form');
		}
		
	}
	
	function forgot_password() {
		
		/**
		 *
		 * === Program workflow ===
		 *
		 * When password reset form is submitted, the email address is recorded
		 * into the password_reset table. A sha1 token is then generated and stored
		 * along with it, as well as a Unix timestamp of when the request was made.
		 * The timestamp is necessary as a security precaution -- the user has 24 hours
		 * to reset the password.
		 * An email is then dispatched, providing a link to update their password. The
		 * link simply fetches the email, using the the hash (which is a URL parameter) 
		 * as the lookup index.
		 *
		 */
		$form = $this->toolbox('Sanitize')->form($_POST);
		
		$q = "SELECT username, email, password FROM users WHERE email = ?";
		$result = $this->db->prepare($q);
		$result->execute( array($form['email']) );
		
		if( ! empty($result) ) {
			
			foreach( $result as $row ) {
				$data['username'] = $row['username'];
				$data['email'] = $row['email'];
				
				$data['create_token'] = sha1($row['username'].$row['email'].time().'#$!&^*(');
				$data['create_token'] = str_replace('3', '-', $data['create_token']);
				$data['create_token'] = str_replace('9', '_', $data['create_token']);
				$data['create_token'] = urlencode($data['create_token']);
				
				$q2 = "INSERT INTO password_reset(email, hash, timestamp) VALUES(?, ?, ?)";
				$r = $this->db->prepare($q2);
				$r->execute( array($row['email'], $data['create_token'], time()) );
				
				$to = $data['email'];
				$subject="Did You Forget Your Password?";
				$from = $this->config->setting('site_name');
				$body="You (or someone claiming to be you) has requested to reset your profile password on ".$this->config->setting('site_name').".<br> 
				If you requested your password to be reset, please do so here: ".BASEURL.'member/password_reset/'.$data['create_token'].".<br> 
				If you did not request a password reset, or otherwise feel this is in error, there is no need to do anything. Your password and other information 
				is safe, and has not been accessed or changed in any way.";
				$headers = "From: " . strip_tags($from) . "\r\n";
				$headers .= "Reply-To: ". strip_tags($this->config->setting('site_email')) . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	 
				mail($to,$subject,$body,$headers);
			
			}
		}
		
		$this->view('static/forgot_password', $data);
	}
	
	function password_reset() {
		
		$data['token'] = $this->route->param1;
		
		$q = "SELECT email, hash, timestamp FROM password_reset WHERE hash = ?";
		$result = $this->db->prepare($q);
		$result->execute( array($data['token']) );
		
		// It is only possible to have one (successful) result.
		// If zero found, it is likely a hack attempt or malformed URL
		// so just redirect them to the original password reset form
		$rows_found = $result->rowCount();
		
		if( $rows_found == 1 ) {
			foreach( $result as $row ) {
				
				// 86400 seconds = 24 hours
				// Password must be reset within 24 hours, else must send a new request
				if( time() > ($row['timestamp']+86400) )
				 // More than 24 hours has passed; send new request
				 $this->redirect('member/forgot_password/expired');
				else
					$this->view('forms/password_reset', $data);
			} // End foreach
		}
		else {
			$this->redirect('member/forgot_password');
			exit;
		} // End if/else
		
		if($_POST) {
			// New password submitted
			$form = $this->toolbox('Sanitize')->form($_POST);
			$this->model('Member')->update_password($_POST['password'], $row['email']);
			$this->redirect('member/login/password_reset_complete');
		}
	}
	#########################
	#  End Login functions  #
	#########################
	
	
	#########################
	#  Signup functions     #
	#########################
	function signup() {
		
		$this->view('forms/signup_form', $data = NULL);
	}

	function signup_validate() {
		
		// Begin form validation by sanitizing all $_POST submitted
		$form = $this->toolbox('Sanitize')->form($_POST);
		
		/**
		 * Now set validation rules for each field.
		 * Pass the sanitized $form variable above
		 * to the function below
		 */		
		$check_if_valid = $this->input->validate->form($form, array(
		
			'username' 			=> 'required|alpha_numeric',
			'password' 			=> 'required|max_len,40|min_len,6',
			'confirm_password'  => 'required|contains,'.$form['password'].'',
			'first_name' 		=> 'required|valid_name',
			'last_name' 		=> 'required|valid_name',
			'email'    			=> 'required|valid_email',
			'dob'    			=> 'required',
			'city'    			=> 'required',
			'state'    			=> 'required|exact_len,2',
			'zip'    			=> 'required|numeric|exact_len,5',
			'phone'    			=> 'numeric|exact_len, 10'
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
			$this->redirect('member/signup/complete');
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
	#########################
	#  End Signup functions #
	#########################

}