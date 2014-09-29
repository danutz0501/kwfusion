<?php
namespace Fusion\System;

class Loader
{	
	
	// The file being requested
	public $_file;
	// The directory containing requested file
	public $_dir;
	
	
	public function folder($dir) {
		return $this->_dir = $dir;
	}
	
	public function display($_file) {
		return $this->_file = $_file;		
	}

	function cache()
	{
		return \Application::run('Cache');
	}

	function config($className) {
		
		foreach( $className as $className ){
			
			$filename = SYSTEM_PATH."config/" . $className . ".php";
			if (is_readable($filename)) {
				require_once $filename;
			} 
			else {
				echo '<div class="alert alert-danger"><h1>Fatal Error</h1>
				<h4>Could not load core system file: '. $className .'.php</h4>
				Please ensure that the file exists and permission to read the file (644)
				</div>';
				exit;
			}
		}
	}
	
	function core($className) {
		
		foreach( $className as $className )
		{
			$filename = SYSTEM_PATH."core/" . ucwords($className) . ".php";
			if (is_readable($filename)) {
				require_once $filename;
			}
			else {
				echo '<div class="alert alert-danger"><h1>Fatal Error</h1>
				<h4>Could not load core system file: <code>'. $className .'.php</code></h4>
				Please ensure that the file exists and permission to read the file (644)
				</div>';
				exit;
			}
		}
	}
	
	function redirect($url) {
		
		if( strpos($url, 'http://') )
			return header('Location: '.$url);

		elseif( strpos($url, 'https://') )
			return header('Location: '.$url);
		
		else
			return header('Location: '.BASEURL.$url);
	}

	function hooks($className) {
		
		foreach( $className as $className )
		{
			$filename = SYSTEM_PATH."hooks/" . $className . ".php";
			if (is_readable($filename)) {
				require_once $filename;
			}
			else {
				echo '<div class="alert alert-danger"><h1>Fatal Error</h1>
				<h4>Could not load hook file: <code>'. $className .'.php</code></h4>
				Please ensure that the file exists and permission to read the file (644)
				</div>';
				exit;
			}
		}
	}
	
	function model($file){
        $dir = MODELS_DIR;
		$file = ucwords($file);
		
		if( is_readable($dir.$file.'Model.php') ){
			$this->db = \Application::run('Database');
			require_once( $dir.$file.'Model.php' );
			$this->model = $file.'Model';
			return $this->model = new $this->model($this->db);
		}
		else
			require_once($dir.'errors/model.php');
    }

	function route($param){
		$route = \Application::run('Router');
		return $route->$param;
	}
	
	function toolbox($className) {
		
		foreach( $className as $className ){
			$filename = SYSTEM_PATH."toolbox/" . ucwords($className) . ".php";
			if (is_readable($filename)) {
				require_once $filename;
			}
			else {
				echo '<div class="alert alert-danger"><h1>Fatal Error</h1
				><h4>Could not load toolbox helper file: <code>'. $className .'.php</code></h4>
				Please ensure that the file exists and permission to read the file (644)
				</div>';
				exit;
			}
		}
	}
	
    function view($file, $data = NULL){
    	
        $dir = VIEWS_DIR;

		if( is_readable($dir.$file.'.php') ) {
			require_once( $dir.$file.'.php' );
		}
		else {
			$filename = $dir.$file.'.php';
			self::viewerror($filename, $data);
		}
    }

    function viewerror($file, $data = NULL){
    	
        $dir = VIEWS_DIR;

		if( is_readable($dir.$file.'.php') ) {
			require_once( $dir.$file.'.php' );
		}
		else {
			$filename = $file;
			require_once($dir.'errors/view.php');
		}
    }

    function template($file, $data = NULL, $config){
		
        $dir = TEMPLATE_BASE_PATH;

		if( is_readable($dir.$file.'.php') )
			require_once( $dir.$file.'.php' );
		else
			require_once($dir.'errors/error-model.php');
    }
}