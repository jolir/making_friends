<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main.php');
class Users extends Main {
	
	public function __construct()
	{
		parent::__construct();

	}

	public function add_friend()
	{
		$post_data = $this->input->post();

		if(isset($post_data['form_action']) && $post_data['form_action'] == "add_friend")
		{
			$this->load->model('Friend');

			$add_friend = $this->Friend->add_fried($post_data);

			if($add_friend)
			{
				$data['status'] = TRUE;
				$data['message'] = "Succesffuly invited user as friend";
			}
			else
			{
				$data['status'] = FALSE;
				$data['error'] = "Something went wrong! Please invite this user again later.";
			}

			echo json_encode($data);
		}
	}

}

/* end of file */