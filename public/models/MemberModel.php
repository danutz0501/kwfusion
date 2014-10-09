<?php

class MemberModel extends Fusion\System\SystemModel {
		
	public function select() {

		$q = "SELECT * FROM users";
		$r = $this->db->prepare($q);
		$r->execute();
		
		return $r;
	}

	public function count($table) {
	
		//get the number of rows from our query
		$query = $this->db->prepare("SELECT COUNT(*) as count FROM $table");
		$query->execute();
		$count = $query->fetch(PDO::FETCH_ASSOC);
		return $count = $count['count'];
	}

	/**
	 * Check if login is valid
	 */
	public function check_login($form) {
				
		$query = "
		SELECT `confirmed` , `password` , `first_name` , `last_name` , `email`
		FROM `users`
		WHERE `email` = ?
		AND `confirmed` = ?
		";

			$confirmed = "Yes";
			$row = $this->db->prepare($query);
			$row->execute( array( $form['email'], $confirmed ) );

			foreach( $row as $result ) {

				if( empty($result) ) {
					// Email not found, or not confirmed
					return FALSE;
				}
				elseif ( Toolbox::helper('Hash')->verify($form['password'], $result['password']) == FALSE ) {
					// Email found, wrong password
					return FALSE;
				}
				elseif ( Toolbox::helper('Hash')->verify($form['password'], $result['password']) == TRUE ) {
					
					// Email and password are both correct -- valid login
					// $this->session()->set('username', $result['username']);
					$this->session()->set('email', $result['email']);
					$this->session()->set('first_name', $result['first_name']);
					$this->session()->set('last_name', $result['last_name']);
					// $this->session()->set('gender', $result['gender']);
					// $this->session()->set('level', $result['level']);
					// $this->session()->set('latitude', $result['latitude']);
					// $this->session()->set('longitude', $result['longitude']);

					return TRUE;
				}
				else {
					return FALSE;
				}
			}
		
	}

	/**
	 * Create a new member; i.e. signup form
	 */
	public function create_member($form) {
		
		$form['password'] = Toolbox::helper('Hash')->encrypt($form['password']);
		# $form['phone'] = Toolbox::helper('Formatter')->PhoneNumber($form['phone']);
		# $latitude = Toolbox::helper('Geoip')->latitude;
		# $longitude = Toolbox::helper('Geoip')->longitude;
		
		$query = "INSERT INTO users( password, first_name, last_name, email ) 
				  VALUES(?,?,?,?)";
		$r = $this->db->prepare($query);
		$r->execute( array( $form['password'], $form['first_name'], $form['last_name'], $form['email'] ) );
		
	}
	
	public function update_password($password, $email) {
		
		$password = Toolbox::helper('Hash')->encrypt($password);
		$q = "UPDATE users SET password = ? WHERE email = ?";
		$r = $this->db->prepare($q);
		$r->execute( array($password, $email) );
		
	}
	
}
