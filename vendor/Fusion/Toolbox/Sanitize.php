<?php
namespace Fusion\Toolbox;

/**
 * Used to sanitize input / data
 */

class Sanitize{
	// Used to store key/values for form sanitation
	public $data = array();
	public $key = array();

	/**
	 * Prevent XSS
	 */
	public function form($input) {
		
		foreach( $input as $key => $value ) {
			
			if( ! empty($value) ) {
				// Keep tabs of the keys; used in the validation class
				$this->key = $key;
				//strip HTML tags from input data
				$value = strip_tags($value);
				//turn all characters into their html equivalent
				$this->data[$key] = htmlentities($value);
			}
		}
		
		return $this->data;
	}
	
	public function file($filename) {
		
		/**
		 * Sanitizes a filename replacing whitespace with dashes
		 *
		 * Removes special characters that are illegal in filenames on certain
		 * operating systems and special characters requiring special escaping
		 * to manipulate at the command line. Replaces spaces and consecutive
		 * dashes with a single dash. Trim period, dash and underscore from beginning
		 * and end of filename.
		 *
		 * @since 1.0
		 *
		 * @param string $filename The filename to be sanitized
		 * @return string The sanitized filename
		 */
		$filename_raw = $filename;
	    $special_chars = 
	    		array( 
		    		"?", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", "\"", 
		    		"&", "$", "#", "*", "(", ")", "|", "~", "`", "!", "{", "}"
	    		);
	    
	    $special_chars = apply_filters('sanitize_file_name_chars', $special_chars, $filename_raw);
	    $filename = str_replace($special_chars, '', $filename);
	    $filename = preg_replace('/[\s-]+/', '-', $filename);
	    $filename = trim($filename, '.-_');
    	
    	return apply_filters('sanitize_file_name', $filename, $filename_raw);
	}
}

// Build Validation helper
\Toolbox::register('Sanitize', function() {
	
	return new Sanitize;
});