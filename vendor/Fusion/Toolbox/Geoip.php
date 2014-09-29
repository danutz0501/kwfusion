<?php
namespace Fusion\Toolbox;

class GeoIP{

	/*
	* Use MaxMind GeoIP data to determine user location
	* Globals
	*/
	private $record;
	public $ip_address;
	public $latitude;
	public $longitude;
	public $city;
	public $state;
	public $state_code;
	public $zipcode;
	public $db;


	/*
	* Search radius properties
	*/
	public $radius = array();

	function __construct()
	{
	    $this->db = \Application::run('Database');
	    
		$ip = getenv( 'HTTP_CLIENT_IP' )?:
			getenv( 'HTTP_X_FORWARDED_FOR' )?:
			getenv( 'HTTP_X_FORWARDED' )?:
			getenv( 'HTTP_FORWARDED_FOR' )?:
			getenv( 'HTTP_FORWARDED' )?:
			getenv( 'REMOTE_ADDR' );
	
		$this->ip_address = '174.55.170.115';

		require_once( GEOIP_DIR.'geoipcity.inc' );
		require_once( GEOIP_DIR.'geoipregionvars.php' );

		$gi = geoip_open( GEOIP_DIR."GeoLiteCity.dat",GEOIP_STANDARD );

		$this->record = geoip_record_by_addr( $gi, $this->ip_address );
		$this->city = $this->record->city;
		$this->state = $this->record->region;
		$this->state_code = $this->record->region;	// Two letter abbreviation
		$this->latitude = $this->record->latitude;
		$this->longitude = $this->record->longitude;
		$this->zipcode = $this->record->postal_code;

		geoip_close($gi);
	}

		// $record->region . " " . $GEOIP_REGION_NAME[$record->country_code][$record->region] . "\n";  // State code, state name
		// $record->latitude . "\n";
		// $record->longitude . "\n";
		// $record->metro_code . "\n";
		// $record->city . "\n";
		// $record->postal_code . "\n";
		// $record->area_code . "\n";
		// $record->continent_code . "\n";

	function distance($lat1, $lon1, $lat2, $lon2, $unit) {

	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);

	  if ($unit == "K") {
	    return ($miles * 1.609344);
	  } else if ($unit == "N") {
	      return ($miles * 0.8684);
	    } else {
	    	if( $miles < 10 )
	    		$miles = number_format($miles, 1, '.', '');
	    	else
	    		$miles = number_format($miles);
	        return $miles;
	      }
	}
				
	function search_radius($miles){	
		
		/*
		* This function will try to find all cities within a given radius based on
		* the current visitor's location
		*/
		$miles = $miles++;
		$q = "SELECT DISTINCT citycode, statecode, code,( 3959 * acos( cos( radians( ? ) ) 
			* cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) + sin( radians( ? ) ) 
			* sin( radians( latitude ) ) ) ) AS distance FROM zips HAVING distance < $miles ORDER BY distance ASC;";
		$r = $this->db->prepare($q);
		$r->fetch(\PDO::FETCH_ASSOC);
		$r->execute(array($this->latitude, $this->longitude, $this->latitude));
		
		foreach($r as $r)
		{
			yield $r;
		}
	}

	public function cities($zip) {
		
		$q = " SELECT citycode FROM zips WHERE code = ? ";
		$s = $this->db->prepare($q);
		$s->execute( array($zip) );
		
		while($city = $s->fetch())
		{
			echo "<option value='" . $city['citycode'] ."'>" . $city['citycode'] . "</option>";
		}
	}
}

// Build GeoIP helper
\Toolbox::register('Geoip', function() {
	
	return new GeoIP;
});
