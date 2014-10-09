<?php

class Search_Controller extends System\Core\KW_Controller {
	
	public function index()
	{
		$data['url'] = $this->route('param1');
		$data['main_content'] = $this->load->view('search/index', $data);
		$this->load->template('content', $data);
	}
	
	public function docs()
	{
		$data['url'] = $this->route('param1');
		$data['main_content'] = $this->load->view('support/docs/index', $data);
		$this->load->template('content', $data);
	}
	
}