<?php

class Friend extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function add_friend($friend_info)
	{
		$this->load->helper('date');
		if($friend_info['form_action'] == "add_friend")
		{
			$data = array(
				"user_id" => $friend_info['user_id'],
				"friend_id" => $friend_info['friend_id'],
				"created_at" => date("Y-m-d H:i:s"),
				"updated_at" => date("Y-m-d H:i:s")

			);
			return $this->db->insert('friends', $data);			
		}

		if($friend_info['form_action'] == "accept_friend")
		{
			$data = array(
				"status" => FRIENDS,
				"updated_at" => date("Y-m-d H:i:s")
			);

			return $this->db->where('user_id', $friend_info['user_id'])
							->where('friend_id', $friend_info['friend_id'])
							->update("friends", $data);
		}

	}

	public function get_friend($friend_info)
	{
		return $this->db->select('friends.friend_id as friend_id, friends.user_id as user_id, first_name, last_name, email, status')
						->where('user_id', $friend_info)
						->or_where('friend_id', $friend_info)
						->join('users', 'users.id = friends.friend_id')
						->get('friends')->result_array();
	}

	public function get_notification($notification_info)
	{
		return $this->db->select('friends.friend_id as friend_id, friends.user_id as user_id, first_name, last_name, email')
						->where('friend_id', $notification_info)
						->where('status', PENDING_FRIEND)
						->join('users', 'users.id = friends.user_id')
						->get('friends')->result_array();
	}

	public function decline_friend($friend_info)
	{
		return $this->db->where('user_id', $friend_info['user_id'])
						->where('friend_id', $friend_info['friend_id'])
						->delete('friends');
	}
}