<?php

class Factory {


    public function get_cities($zip) {
		
		$zip = trim( htmlspecialchars($zip) );
		
		$q = "SELECT DISTINCT citycode FROM zips";
		$query = $this->db->prepare($q);
		$query->execute( array() );
        
        $results = fetch($query, PDO::FETCH_OBJ);
        foreach ($results as $result) {
            echo $result->citycode . "\n";
        }
        
        function fetch($query, $fetchMode) {
		
            while ($result = $query->fetch($fetchMode)) {
                yield $result;
            }
        }
		
	}

}
