<?php

class Friend extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function add_friend($friend_info)
	{
		$this->load->helper('date');
		$data = array(
			"user_id" => $friend_info['user_id'],
			"friend_id" => $friend_info['friend_id'],
			"created_at" => date("Y-m-d H:i:s"),
			"updated_at" => date("Y-m-d H:i:s")

		);
		return $this->db->insert('friends', $data);
	}

	public function get_friend($friend_info)
	{
		return $this->db->where('user_id', $friend_info)
						->get('friends')->result_array();
	}

	public function get_notification($notification_info)
	{
		return $this->db->where('friend_id', $notification_info)
						->join('users', 'friends.user_id = users.id', 'LEFT OUTER')
						->get('friends')->result_array();
	}
}