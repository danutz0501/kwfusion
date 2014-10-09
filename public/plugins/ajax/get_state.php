<?php
ini_set('display_errors', '0');
require_once('../../../vendor/Fusion/Database/Database.php');


$zip = $_REQUEST['zip'];

$sql = Application::run('Database');

$q = "SELECT DISTINCT statecode FROM zips WHERE code = ?";
$s = $sql->prepare($q);
$s->execute( array($zip) );

while($state = $s->fetch())
{
	echo "<option value='" . $state['statecode'] ."'>" . $state['statecode'] . "</option>";
}