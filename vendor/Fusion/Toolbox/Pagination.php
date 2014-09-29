<?php
namespace Fusion\Toolbox;

class Pagination {
    
   public $db;
   
   function paginate( $query, $where = NULL, $where_values = NULL, $per_page = 10, $page = 1, $url = '?' ){
        $this->db = \Application::run('Database');
    	$query = "SELECT COUNT(*) as `num` FROM {$query}";
    	if ( ! is_null($where) ) {
    	    $query .= ' '. $where;
    	    $_row = $this->db->prepare($query);
    	    $_row->execute( array($where_values) );
    	}
    	else { 
        	$_row = $this->db->prepare($query);
        	$_row->execute( array() );
        }
    	
    	foreach($_row as $row)
    	    $total = $row['num'];
    	    
        $adjacents = 5; 

    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;
    	
    	$pagination = "";
    	if($lastpage > 1)
    	{	
    		$pagination .= "<ul class='pagination'>";
                    $pagination .= "<li class='details'>Page $page of $lastpage</li>";
    		if ($lastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<li><a class='current'>$counter</a></li>";
    				else
    					$pagination.= "<li><a href=$counter>$counter</a></li>";					
    			}
    		}
    		elseif($lastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href=$counter>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>...</li>";
    				$pagination.= "<li><a href=$lpm1>$lpm1</a></li>";
    				$pagination.= "<li><a href=$lastpage>$lastpage</a></li>";		
    			}
    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$pagination.= "<li><a href='1'>1</a></li>";
    				$pagination.= "<li><a href='2'>2</a></li>";
    				$pagination.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href=$counter>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>..</li>";
    				$pagination.= "<li><a href=$lpm1>$lpm1</a></li>";
    				$pagination.= "<li><a href=$lastpage>$lastpage</a></li>";		
    			}
    			else
    			{
    				$pagination.= "<li><a href='1'>1</a></li>";
    				$pagination.= "<li><a href='2'>2</a></li>";
    				$pagination.= "<li class='dot'>..</li>";
    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href=$counter>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$pagination.= "<li><a href=$next>Next</a></li>";
                $pagination.= "<li><a href=$lastpage>Last</a></li>";
    		}else{
    			$pagination.= "<li><a class='current'>Next</a></li>";
                $pagination.= "<li><a class='current'>Last</a></li>";
            }
    		$pagination.= "</ul>\n";		
    	}
    
    
        return $pagination;
    } 
}
 // Build Pagination helper
\Toolbox::register("Pagination", function() {

	return new Pagination;
});
