<?php
/**
 * Andrew Rout, 9/28/2014
 *
 * === Purpose ===
 *
 * Run this script daily as a cron to perform daily
 * backups of MySQL databases.
 * The backups will be stored above web root, located
 * in the /home/dynamica/_DB_BACKUPS/ directory, as an
 * .sql file for easy importing with phpMyAdmin
 */
// require_once('/home/dynamica/_DB_BACKUPS/backup.php');

$database = array( 'backend' => 'dynamica_backend', 'demo' => 'dynamica_demo', 'leads' => 'dynamica_leads', 'lists' => 'dynamica_lists', 
	'splash_pages' => 'dynamica_splash_pages', 'subscribe' => 'dynamica_subscribe', 'test_environment' => 'dynamica_testEnvironment', 'wp' => 'dynamica_wp' );

foreach( $database as $folder => $db ) {

	$mysqlDatabaseName 	= $db;
	$mysqlUserName 		= 'dynamica_arout77';
	$mysqlPassword 		= 'dontlose1!';
	$mysqlHostName 		= 'localhost';
	$mysqlExportPath 	= '/home/dynamica/_DB_BACKUPS/'.$folder.'/';

	$filename = date("Y") .'_'. date("m") .'_'.date("d") .'_'. time().'.sql';

	$command = 'mysqldump --opt -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > ' .$mysqlExportPath.$filename;
	exec( $command, $output=array(), $worked );
	switch( $worked ){
	case 0:
	echo 'Database <b>' .$mysqlDatabaseName .'</b> successfully exported to <b>~/' .$mysqlExportPath .'</b>';
	break;
	case 1:
	echo 'There was a warning during the export of <b>' .$mysqlDatabaseName .'</b> to <b>' .$mysqlExportPath .'</b><br>';
	break;
	case 2:
	echo 'There was an error during export. Please check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'
	</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'
	</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr></table>';
	break;
	}
}