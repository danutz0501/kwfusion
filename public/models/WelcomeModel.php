<?php

class WelcomeModel extends Fusion\System\SystemModel {
		
	public function select()
	{
		$q = "SELECT * FROM users";
		$r = $this->db->prepare($q);
		$r->execute();
		
		return $r;
	}

	public function count($table)
	{
		//get the number of rows from our query
		$query = $this->db->prepare("SELECT COUNT(*) as count FROM $table");
		$query->execute();
		$count = $query->fetch(PDO::FETCH_ASSOC);
		return $count = $count['count'];
	}

	public function cities($table)
	{
		//grab the current page
		$page = (int)Application::run('Router')->param1;
		if( ! $page )
			$page == 1;

		//get the number of rows from our query
		$count = self::count("zips");

		//number of results per page
		$limit = 20;

		//page being used
		$location = "http://localhost/fusion/test/paginate/?page=";

		//instantiate the pagination
		if( ! isset($pagination) )
		$pagination = new Fusion\Toolbox\Pagination($limit, $count, $page, $location, $type=1, $jumpto=0);

		//now we begin the initial piece
		$start = $pagination->prePagination();

		$this->data['location'] = self::cities('zips');

		// Show pagination links
		$this->data['paginate'] = $pagination->pagination();

		$query = $this->db->prepare("SELECT * FROM $table LIMIT $start, $limit");
		$query->execute();

		return $query;
	}

	public function state($table, $start, $limit)
	{

		$query = $this->db->prepare("SELECT * FROM $table LIMIT $start, $limit");
		$query->execute();

		//a loop to pull out data
		foreach($query->fetchAll() as $row)
		{
			// some code here
			yield $row['citycode'].'<br>';
		}
	}
	
}