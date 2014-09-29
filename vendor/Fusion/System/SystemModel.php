<?php
namespace Fusion\System;

class SystemModel {
	
	use Load;

	// Database connection passed during Application::register
	protected $db;
	// Session helper
	// public $session;
	// Data caching helper
	public $cache;
	// Data accessed by views / controllers
	public $data;
	
	public function __construct(\PDO $_db)
	{
		$this->db = $_db;
		// $this->session = self::session();
		$this->cache = self::cache();
	}
	
	public function cache()
	{
		return \Application::run('Cache');
	}

	public function session() {

		return \Application::run('Session');
	}

}