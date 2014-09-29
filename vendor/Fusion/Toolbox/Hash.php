<?php
namespace Fusion\Toolbox;

 /**
 * Hash the password using PHP's default settings
 * (currently BCRYPT encryption and cost factor of 10)
 * A quick example of checking password below:
 *
		// The password stored in database
		$stored = 'password_from_database';
		// The password input by user
		$checkthispassword = $_POST['password'];
		
		App\Helper\Hash($stored);
		
		if( App\Helper\PasswordVerify($checkthispassword, $stored) )
			// Valid login
		else {
			// Wrong password
		}
 */

 class Hash implements \Encrypt{
 	
	public $data;
	
	function encrypt($password, $key = NULL) {
		/**
		 * Primary use is to hash passwords, but can also be used to hash
		 * other data, such as credit card numbers, etc
		 */
		$encrypt = password_hash( $password, PASSWORD_DEFAULT );
		return $this->data[$key] = $encrypt;
	}
	
	function verify($check_this_hash, $stored_hash) {
		
		return password_verify( $check_this_hash, $stored_hash );
	}
 }
 
 // Build Hash helper
\Toolbox::register("Hash", function() {
	
	return new Hash;
});