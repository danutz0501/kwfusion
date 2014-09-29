<?php
namespace Fusion\System;

class Session {

	// Session ID
	public $id = NULL;
	

	public function __construct()
	{
		/**
		 * Set session save path
		 */
		// ini_set('session.auto_start', 1);
		// ini_set('session.save_handler', 'memcached');
		// ini_set('session.save_path', PUBLIC_PATH.'cache/session');
		
		$this->id = session_id();
	}

	function data() {

		$data = $_SESSION;
		
		if( ! empty($data) ) {
			
			echo '<div class="console"><h3>Current Session Information</h3>';
			echo '<table class="table"><th>Session Key</th><th>Value</th>';
			
			foreach ($data as $key => $value)
				echo '<tr><td><strong>'.$key .':</strong></td><td>'. $value .'</td></tr>';
			
			echo '</table></div>';
		}
		else
			echo '<div class="console"><h3>No Session Information Available</h3></div>';
	}

	function delete($key) {

		/**
		 * Delete single item from $_SESSION
		 */
		$data = $_SESSION[$key];
		session_unset($data);
	}

	function destroy() {

		/**
		 * Destroy entire session
		 */

		// Check for session
		self::start();
		//remove all the variables in the session
		$this->id = FALSE;
		session_unset(); 
		// Destroy
		return session_destroy();
	}

	function fetch($key) {

		if( isset($_SESSION[$key]) )
			return $_SESSION[$key];
		else
			return FALSE;
	}

	function set($key, $value) {

		return $_SESSION[$key] = $value;
	}

	function start() {

		if( ! session_id() )
		{
			$this->id = session_regenerate_id();
			session_start();
		}
	}
	
	function verify($key) {

		if( isset($_SESSION[$key]) )
			return TRUE;
		else
			return FALSE;
	}

}

##############################################
// Add `Sessions` to the registry array //
##############################################
\Application::register('Session', function() {

    return new Session;
});
