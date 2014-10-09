<?php
if(!isset($_SERVER['HTTP_REFERER']))
{
	# Direct access to this script is not allowed. Fire off a 403
	header('Location: ../../404.html');
	exit;	
}
include("geoipcity.inc");
include("geoipregionvars.php");

// uncomment for Shared Memory support
// geoip_load_shared_mem("/usr/local/share/GeoIP/GeoIPCity.dat");
// $gi = geoip_open("/usr/local/share/GeoIP/GeoIPCity.dat",GEOIP_SHARED_MEMORY);

$gi = geoip_open("GeoLiteCity.dat",GEOIP_STANDARD);

$ip = $_SERVER['REMOTE_ADDR'];


$record = geoip_record_by_addr($gi,$ip);

//print $record->country_code . " " . $record->country_code3 . " " . $record->country_name . "\n";
$record->region . " " . $GEOIP_REGION_NAME[$record->country_code][$record->region] . "\n";  // State code, state name
print $record->latitude . "\n";
print $record->longitude . "\n";
$record->metro_code . "\n";
print $record->city . "\n";
$record->postal_code . "\n";
$record->area_code . "\n";

$record->continent_code . "\n";

geoip_close($gi);

$thisurl = $_SERVER['SCRIPT_FILENAME'];



/*    
GeoIP Location  ::  See www.keystonepersonals.com/location.php on how to print location information  
include("geoip/geoipcity.inc");
include("geoip/geoipregionvars.php");
// uncomment for Shared Memory support
// geoip_load_shared_mem("/usr/local/share/GeoIP/GeoIPCity.dat");
// $gi = geoip_open("/usr/local/share/GeoIP/GeoIPCity.dat",GEOIP_SHARED_MEMORY);
$gi = geoip_open("geoip/GeoLiteCity.dat",GEOIP_STANDARD);
$ip = $_SERVER['REMOTE_ADDR'];
$record = geoip_record_by_addr($gi,$ip);

define('MYCITY', $record->city);
define('MYZIP', $record->postal_code);
define('MYAREACODE', $record->area_code);
define('MYREGION', $record->region);

*/

?>