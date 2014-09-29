<?php

class Form_Helper{
	
	function action($url)
	{
		return BASEURL.$url;
	}
	
	function method($method)
	{
		switch($method){
			case "get":
				return $method;
			case "post":
				return $method;
			case "put":
				return $method;
			case "delete":
				return $method;
			
			default:
				return '<div class="alert alert-danger">Invalid form method specified';	
		}
	}
	
}