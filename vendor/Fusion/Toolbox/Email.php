<?php
namespace Fusion\Toolbox;

### Functioning example usage below
### \Toolbox::helper('Email')->send( "andrewr@dynamicartisans.com", "Andrew Rout", "kW Fusion", "arout@kwfusion.com", "This is a test", "Holla!!!!" );

class Email {
	
	function send( $to, $recipient_name, $from, $reply_to, $subject, $message )
	{	
	
		/**
		 * $to is the email address of recipient; can be an array
		 * $recipient_name is the name of recipient
		 * $from is the company / website name
		 * $reply_to is the reply to address
		 */
		 
		// message
		$formatted_message = '
		<html>
		<head>
			 <title>'. $subject .'</title>
		</head>
		<body>
			<p>'. $message .'</p>
		</body>
		</html>
		';

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional headers
		$headers .= 'To: '. $recipient_name .' <'. $to .'>' . "\r\n";
		$headers .= 'From: '. $from .' <'. $reply_to .'>' . "\r\n";
		
		
		// Mail it
		mail($to, $subject, $formatted_message, $headers);
	}

}

// Build Validation helper
\Toolbox::register('Email', function() {
	
	return new Email;
});