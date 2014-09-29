<?php
namespace Fusion\System;
// Declare the interface for Toolbox Hash helper
interface Encrypt {
	
	public function encrypt($password, $key);
	
	public function verify($check_this_hash, $stored_hash);
	
}

if( ! class_exists("Fusion\System\Loader") ) {
	
	interface Loader {
		
		public function folder($dir);
		
		public function display($file);
	}
}