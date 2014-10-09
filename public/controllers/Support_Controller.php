<?php

class Support_Controller extends Fusion\System\SystemController {
	
	public function index()
	{
	
		$this->view('support/index');
	}
	
	public function docs()
	{
		$this->view('support/index');
	}
	
	public function faq()
	{
		$this->view('support/docs/faq');
	}

	public function toolbox()
	{
		$this->view('support/docs/toolbox/index');
	}
}