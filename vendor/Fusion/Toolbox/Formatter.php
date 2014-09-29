<?php
namespace Fusion\Toolbox;

/**
 * PhoneNumber function provides a method to define
 * how phone numbers should be formatted, regardless
 * of how the user submits their #.
 * It works by stripping all non-integer characters
 * from the input, then assembling the number back together
 * using the defined formatting options.
 * For example, 123-456-7890 and 123 456.7890 would both return
 * (123) 456-7890 after function processes the input.
 * 
 * By default, the output will return numbers in the following
 * format: (xxx) xxx-xxxx
 * 
 * To change the default format, edit lines 35, 44 and 52 below
 * to whatever you wish
 */
class Formatter {
	
		function PhoneNumber($phoneNumber) {
			
				// Strip all non-integers from input
				$phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
				
				if( strlen($phoneNumber) > 10 ) 
				{
					// Prepend country code to phone number
					$countryCode = substr( $phoneNumber, 0, strlen($phoneNumber)-10 );
					$areaCode = substr( $phoneNumber, -10, 3 );
					$nextThree = substr( $phoneNumber, -7, 3 );
					$lastFour = substr( $phoneNumber, -4, 4 );
				
					$phoneNumber = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
				}
				else if( strlen($phoneNumber) == 10 ) 
				{
					// 10 digit phone number (Area code + number)
					$areaCode = substr( $phoneNumber, 0, 3 );
					$nextThree = substr( $phoneNumber, 3, 3 );
					$lastFour = substr( $phoneNumber, 6, 4 );
			
					$phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
				}
				else if( strlen($phoneNumber) == 7 ) 
				{
					// 7 digit number
					$nextThree = substr( $phoneNumber, 0, 3 );
					$lastFour = substr( $phoneNumber, 3, 4 );
				
					$phoneNumber = $nextThree.'-'.$lastFour;
				}
				
				return $phoneNumber;
		}
	
	### Date and time formats ###
	
	function time($string)
	{
		/* Example output:  7:17am */
		return gmdate("g:ia", $string);
	}
		
	function date($string)
	{
		/* Example output: 11/27/2013 */
		return gmdate("n/d/Y", $string);
	}
	
	function datereverse($string)
	{
		/* Example output: 2013/19/03 */
		return gmdate("Y/d/n", $string);
	}
	
	function datewords($string)
	{
		/* Example output: Monday, March 8, 2003 */
		return gmdate("l, F d, Y", $string);
	}
	
	function datewords_no_prefix($string)
	{
		/* Example output: March 8, 2003 */
		return gmdate("F d, Y", $string);
	}
	
	function datetime($string)
	{
		/* Example output: 11/27/2013 8:08am */
		return gmdate("n/d/Y  g:ia", $string);
	}
	
	function date_to_timestamp($month, $day, $year)
	{
		/* Convert given month, day and year to a Unix timestamp */
		return date("n/d/Y", mktime(0, 0, 0, $month, $day, $year));	
	}

}

// Build Validation helper
\Toolbox::register('Formatter', function() {
	
	return new Formatter;
});