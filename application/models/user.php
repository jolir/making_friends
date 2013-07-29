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

	public function get_user($user_info = NULL, $friend_info = NULL)
	{
		if($user_info != NULL)
		{
			if(is_array($user_info))
			{
				return $this->db->where('email', $user_info['email'])
							->where('password', $user_info['password'])
							->get('users')
							->row();
			}
			elseif(is_array($friend_info))
			{
				if(!empty($friend_info))
				{
					foreach($friend_info as $info)
					{
						$friends[] = $info['friend_id'];
					}
					
					return $this->db->where_not_in('id', $friends)
								->get('users')
								->result_array();
				}
				else
					return $this->db->get('users')->result_array();
			}
		}
		else
			return $this->db->get('users')->result_array();
	}

	// public function get_notification($notification_info)
	// {
	// 	return
	// }
}