<?php
// Detect PHP version being run
$php = PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION.'.'.PHP_RELEASE_VERSION;
if( class_exists('Memcached') ) {
  // Memcache is enabled.
	$mcache = 'pass';
} else {
	$mcache = 'fail';
}

if ( array_key_exists('HTTP_MOD_REWRITE', $_SERVER) )
	echo 'detected';
else
	echo 'not detected';
?>

<br>
<legend>Installation information and requirements</legend>

<table class="table">

	<tr><th>Required</th><th>Result</th></tr>
	<tr><td>PHP version 5.5 or later</td><td <?php if ($php >= 5.5) echo 'class="alert alert-success"'; else echo 'class="alert alert-danger"'; ?> >
	<?php if ($php >= 5.5) echo 'Your PHP version ('.$php.') meets the minimum requirements'; else echo 'Installation cannot continue. You must have PHP version 5.5 or higher. 
	Your PHP version: <strong>'.$php.'</strong>'; ?></td></tr>
	<tr><td>Memcache installed and running</td><td <?php if($mcache == 'pass') echo 'class="alert alert-success"'; else echo 'class="alert alert-danger"'; ?> >
	<?php if($mcache == 'pass') echo 'Memcache installed and running'; 
	else echo 'Could not connect to Memcache server. Please confirm that you have Memcache installed, and that it is running. Many servers have it installed, but turned off
		by default.<br>This is not a fatal error. You may still use kW Fusion; however, the session management and caching features will not be functional, and you will need 
	to use PHP\'s builtin functions (or create your own) if those features are needed.'; ?></td></tr>

</table>