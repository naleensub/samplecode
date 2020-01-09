<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function index()
	{

	}

	public function insert_users() 
	{
		$this->user_role_id = 3;
		$this->username = $this->input->post('uname');
		$this->first_name = $this->input->post('fname');
		$this->last_name = $this->input->post('lname');
		$this->password = password_hash($this->input->post('pwd'), PASSWORD_BCRYPT);
		$this->email_address = $this->input->post('email');
		$this->mobile_number = $this->input->post('mnumber');
		$this->country_code = 'NP';

		$this->db->insert('users', $this);

		return $this->db->insert_id();
	}
}
