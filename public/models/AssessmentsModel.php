<?php

class AssessmentsModel extends Fusion\System\SystemModel {
	
	public function generate_tags( $company ) {
		
		/**
		 * === PURPOSE ===
		 * We want to take each column from the wizard table, and create
		 * a reusable "placeholder" variable that we can use in the final
		 * document for editing. The placeholder variable has the following
		 * format:   {{ VARIABLE }}
		 *
		 * So for example, the company's name variable would be {{ COMPANY }}
		 *
		 * The generate_tags function is run after the first step of the wizard,
		 * and will create a column var_$somecolumn if it does not exist, and then
		 * populate it with the data that we collect from the wizard.
		 *
		 * This function should only run near or at the end of the wizard,
		 * once all of the data has been collected.
		 */
		$query = "SELECT * FROM assessment_wizard WHERE company = ?";
		$r = $this->db->prepare($query);
		$r->execute( array( $company ) );
		
		foreach( $r as $tag => $value) {
			
			$tag = strtoupper( $tag );
			$var_tag = define( '{{ '. $tag .' }}', $value );	
			
			/**
			 * If the column does not exist, create it
			 */
			if( ! $tag[$tag] ) {
				$sql = "
				ALTER TABLE assessment_wizard 
				ADD var_".$tag." varchar(40) NOT NULL,
				ADD var_".$tag."_value varchar(150) NOT NULL;";
				$alter = $this->db->prepare( $sql );
				$alter->execute();
			}
		}
		
	}
	
	public function save_draft( $company, $filename, $timestamp, $author ) {
		
		$query = "REPLACE INTO assessment_drafts( company, filename, date, last_edit_by ) VALUES( ?, ?, ?, ? )";
		$save  = $this->db->prepare( $query );
		$save->execute( array( $company, $filename, $timestamp, $author ) );
		
		if( $save )
			return TRUE;
		else
			return FALSE;
	}
	
	public function get_drafts( $author = NULL ) {
		
		$query = "SELECT company, filename, date, last_edit_by FROM assessment_drafts WHERE 1";
		if( ! is_null( $author ) )
			$query .= " AND last_edit_by = $author";
		
		$get  = $this->db->prepare( $query );
		$get->execute();
		
		if( $get )
			return TRUE;
		else
			return FALSE;
	}

	public function count($table) {
	
		//get the number of rows from our query
		$query = $this->db->prepare("SELECT COUNT(*) as count FROM $table");
		$query->execute();
		$count = $query->fetch(PDO::FETCH_ASSOC);
		return $count = $count['count'];
	}
	
	public function count_where($table, $where, $where_equals) {
	
		//get the number of rows from our query
		$query = $this->db->prepare("SELECT COUNT(*) as count FROM $table WHERE $where = ?");
		$query->execute( array( $where_equals ) );
		$count = $query->fetch(PDO::FETCH_ASSOC);
		return $count = $count['count'];
	}
	
	public function template_tags() {
		
		//get the template tags from wizard as well as var_tags table
		$query = $this->db->prepare("SELECT string, description, value, document FROM assessment_var_tags ORDER BY string ASC");
		$query->execute();
		
		return $query;
	}
	
	public function get_all_documents() {
		
		//get the template tags
		$query = $this->db->prepare("SELECT filename FROM assessment_wizard ORDER BY filename ASC");
		$query->execute();
		
		return $query;
		
	}
	
	public function create_template_tag( $tag, $value, $descr, $doc ) {
		
		$query = "INSERT INTO assessment_var_tags( string, value, description, document ) VALUES( ?, ?, ?, ? )";
		$insert = $this->db->prepare( $query );
		$insert->execute( array(  $tag, $value, $descr, $doc ) );	
		
	}
	
	/* ===================================== *\
	|	Performance tests
	\* ===================================== */
	
	/**
	 * Network speeds collected from Wizard
	 */
	public function network_speed( $latency, $download, $company ) {

			$query = "REPLACE INTO assessment_tests( latency, download_speed, company ) VALUES( ?, ?, ? )";
			$insert = $this->db->prepare( $query );
			$insert->execute( array(  $latency, $download, $company ) );
	}
	
	/**
	 * CSS and JS files, collected from step two of wizard
	 *
	 * Since Network speeds were already collected in step one,
	 * we just need to update the table, not a new insert
	 */
	public function scripts( $js, $css, $company ) {
		
		$query = "UPDATE assessment_tests SET js = ?,  css = ? WHERE company = ?";
		$insert = $this->db->prepare( $query );
		$insert->execute( array(  $js, $css, $company ) );
		
	}
	
	/*************************************\
	*
	*	WIZARD activities
	*
	\*************************************/
	public function wizard_step_one( $company, $url, $fname = '', $lname = '', $consultant, $filename, $author ) {

		$query = "
		INSERT INTO assessment_wizard( company, url, first_name, last_name, consultant, filename, author, date, var_company_value, var_url_value, var_first_name_value, var_last_name_value, var_consultant_value, var_author_value, var_filename_value ) 
		VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";
		$insert = $this->db->prepare( $query );
		$insert->execute( array(  $company, $url, $fname, $lname, $consultant, $filename, $author, time(), $company, $url, $fname, $lname, $consultant, $author, $filename ) );
		
		if( $insert )
			return TRUE;
		else
			return FALSE;
	}
	
	
	
	/*
	public function initialize_var_tags( $company, $url, $consultant, $doc ) {
		
		// We need to establish some base variable tags each time an assessment is created
		$var = array( "{{ COMPANY }}" => $company, "{{ URL }}" => $url, "{{ CONSULTANT }}" => $consultant, "{{ DOCUMENT }}" => $doc );
		
		foreach( $var as $string => $val ) {
		
			$query = "REPLACE INTO assessment_var_tags( string, value, document ) VALUES( ?, ?, ? )";
			$insert = $this->db->prepare( $query );
			$insert->execute( array(  $string, $val, $doc ) );	
		}
	}
	*/
}