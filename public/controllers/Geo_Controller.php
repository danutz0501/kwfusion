<?php

class Geo_Controller extends Fusion\System\SystemController {
	
	
	
	public function index() {
        
        $zip = trim( htmlspecialchars($this->route->param1) );
        
        $p = Toolbox::helper("Pagination");
        
        $page = (int)(empty($_GET["page"]) ? 1 : $_GET["page"]);
    	$per_page = 10;
    	$startpoint = ($page * $per_page) - $per_page;
        
        //to make pagination
        $table = "zips";
		
		/**
		 * Below is an example of how we would pass WHERE clause to pagination
		 * Define WHERE clause for the query, as well as PDO->execute() values
		 * We would then replace the two NULL values in $p->paginate with $where
		 * and $where_values
		 */
		$where = "WHERE citycode = ?";
		$where_values = "Hanover";
		
		//show records
        $query = $this->db->prepare("SELECT citycode, statecode FROM {$table} {$where} LIMIT {$startpoint}, {$per_page}");
        $query->execute( array($where_values) );
            
        	foreach($query as $row) {
        	// Send results to view file
        	$data['location'][] = $row;  
            }
            
        $data['pagination'] = $p->paginate( $table, $where, $where_values, $per_page, $page );
        
		$this->view('member/index', $data);
	}
	
	public function all_cities() {
		
		// $get_cities = $this->model('Geoip')->get_all_cities();
		$this->model('Geoip')->get_all_cities();
		echo $this->cache()->get('cities');
		
		
	}
	
}
