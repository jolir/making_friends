<?php

class User extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function create_user($user_info)
	{
		$this->load->helper('date');
		$user = array(
			'first_name' => $user_info['first_name'],
			'last_name' => $user_info['last_name'],
			'email' => $user_info['email'],
			'password' => md5(HASH_START . $user_info['password'] . HASH_END),
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		);
	
		return $this->db->insert('users', $user);
	}
}