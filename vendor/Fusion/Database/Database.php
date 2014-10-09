<?php
namespace Fusion\Database;
use \PDO as PDO;

##########################################
// Add `Database` to the registry array //
##########################################

if( ! class_exists("Application") )
	require( dirname(__FILE__).'/../System/Registry.php' );

\Application::register('Database', function() {
	

## Enter your database connection settings here

$host 		= "localhost";		// Most users should leave this set to localhost
$sqlname 	= "";			// Name of database
$sql_user 	= "";			// Username to connect to database
$sql_pass 	= "";			// Database password

try {  
		$sql = new PDO("mysql:host=$host;dbname=$sqlname", $sql_user, $sql_pass); 
		$sql->setAttribute( PDO::ATTR_EMULATE_PREPARES, false ); 
		$sql->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}  
catch(PDOException $e) {  
		echo '<h1>Fatal Error</h1>
		Could not establish connection to the database. ';  
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);  
}
		
## Setup PDO connection
try {  
		$sql = new PDO("mysql:host=$host;dbname=$sqlname", $sql_user, $sql_pass); 
		$sql->setAttribute( PDO::ATTR_EMULATE_PREPARES, false ); 
		$sql->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}  
catch(PDOException $e) {  
		echo '<h1>Fatal Error</h1>
		Could not establish connection to the database. ';  
		file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);  
}

	return $sql;
});
