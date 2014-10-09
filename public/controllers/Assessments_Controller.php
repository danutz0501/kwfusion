<?php

class Assessments_Controller extends Fusion\System\SystemController {
	
	// The page being viewed
	private $page;
	// Name of company
	protected $company;
	// Company URL
	protected $url;
	// Consultant
	private $consultant;
	// Creator of assessment
	private $author;
	// Name given to saved form (without extension)
	protected $file_name;
	// File extension
	private $file_extension = '.docx';
	
	public function __construct() {
		
		if( ! \Application::run('Router')->param1 )
			$this->page = "index";
		else
			$this->page = \Application::run('Router')->param1;
			
		$this->author = $this->session()->fetch('first_name') .' '.$this->session()->fetch('last_name');
		$data['company'] = $this->company;
		
	}
	
	public function index() {
		
		$this->view('assessments/index');			
	}
	
	public function save_draft() {
		
		$data['filename'] = $this->session()->fetch('assessment_file_name');
		$data['company'] = $this->session()->fetch('assessment_company');
		
		if( $this->model('Assessments')->save_draft( $this->session()->fetch('assessment_company'), $this->session()->fetch('assessment_file_name') ) )
			$this->redirect( 'assessments/drafts/saved' );
		else
			$this->view( 'assessments/drafts/save_error', $data );
	}
	
	public function tags() {
		
		if( $_POST )
			$this->model('Assessments')->create_template_tag( strtoupper('{{ '.$_POST['tag'].' }}'), $_POST['value'], $_POST['descr'], $_POST['document'] );
		
		$data['filename'] = $this->model('Assessments')->get_all_documents();
		$data['tags'] = $this->model('Assessments')->template_tags();
		$this->view('assessments/tags', $data);			
	}
	
	public function wizard() {
		
		$data['company'] = $this->session()->fetch('assessment_company');
		$data['latency'] = $this->toolbox('Performance')->check_latency( $this->session()->fetch('assessment_url') );
		$data['download_speed'] = $this->toolbox('Performance')->check_download_speed( $this->session()->fetch('assessment_url') );
		
		// Load the correct view dynamically
		$this->view("assessments/wizard/$this->page", $data);	
	}
	
	public function process_wizard_form_one() {
		
		if ( $_POST ) {
			
			// Sanitize form
			$form = $this->toolbox('Sanitize')->form( $_POST );
			
				$this->company 		= $form['company'];
				$this->url 			= $form['url'];
				$this->cosultant 	= $form['consultant'];
				
				$this->session()->set( 'assessment_company', $form['company'] );
				$this->session()->set( 'assessment_url', $form['url'] );
				
				// We want to assemble the file name here in the following format:
				// Intials_Web_Assess_MMDDYY
				
				// Get the first letter of each word (including hyphenated/underscored words)
				$corpname = preg_split("/[\s,_ -]+/", $form['company']);
				$initials = "";
				
				foreach ($corpname as $firstletter)
				  $initials .= $firstletter[0];
				  
				$this->file_name = $initials.'_Web_Assess_'.date("mdY").$this->file_extension;
				$this->session()->set( 'assessment_file_name', $this->file_name );
				// $this->model('Assessments')->generate_tags( $this->company );
				// Compile form variable tags
				// $this->model('Assessments')->initialize_var_tags( $this->company, $this->url, $form['consultant'], $this->file_name );
				// Track network speeds
				$this->model('Assessments')->network_speed( $this->toolbox('Performance')->check_latency_raw(), $this->toolbox('Performance')->check_download_speed_raw(), $this->company );
				// Saving
				if( $this->model('Assessments')->wizard_step_one( $this->company, $this->url, $form['first_name'], $form['last_name'], $form['consultant'], $this->file_name, $this->author ) )
					$this->redirect('assessments/wizard/server');
				else
					throw new Exception('Error processing request');
		}
		
	}
}