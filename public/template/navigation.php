<?php
if( $this->cache()->fetch('email') == FALSE )
	require_once('nav-visitor.php');
else
	require_once('nav-loggedin.php');
	
