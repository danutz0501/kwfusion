<?php

class Download_Controller extends Fusion\System\SystemController {
	
	public function index()
	{
		// $this->data['cache'] = new System\Core\Apc;
		$this->data['param'] = $this->route('param2');
		$data['main_content'] = $this->view('static/download', $this->data);
	}
	
	public function demo()
	{
		echo '<div class="bs-callout text-center styleSecondBackground">Demo action loaded!!!  :)</div>';
	}
	
}