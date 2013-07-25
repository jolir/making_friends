<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main.php');
class Users extends Main {
	
	public function __construct()
	{
		parent::__construct();

	}

	public function create_user()
	{
		$post_data = $this->input->post();

		if(isset($post_data['form_action']) && $post_data['form_action'] == "create_user")
		{
			$this->load->model('User');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('password_confirmation', 'Confirm Password', 'trim|required|matches[password]');

			if($this->form_validation->run() === FALSE)
			{
				$data['status'] = FALSE;
				$data['errors'] = validation_errors();
			}
			else
			{
				$this->load->model('User');
				$create_user = $this->User->create_user($post_data);

				if($create_user)
				{
					$data['status'] = TRUE;
					$data['message'] = "Successfully created a new user!";
				}
				else
				{
					$data['status'] = FALSE;
					$data['errors'] = "Database error! Please sign up again later!";
				}
			}
			echo json_encode($data);
		}
		else
			$this->load->view('home_page');

		
	}
	public function login()
	{	
		$post_data = $this->input->post();

		if(isset($post_data['form_action']) && $post_data['form_action'] == "login" )
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			
			if($this->form_validation->run() === FALSE)
			{
				$data['status'] = FALSE;
				$data['errors'] = validation_errors();
			}
			else
			{	
				$user = array(
					'email' => $post_data["email"], 
					'password' => md5(HASH_START . $post_data["password"] . HASH_END)
				);

				$this->load->model('User');
				$user = $this->User->get_user($user);

				if(count($user) > 0)
				{	
					$user_session = array(
						'user_id' => $user->id,
						'email' => $user->email,
						'first_name' => $user->first_name,
						'last_name' => $user->last_name,
						'is_logged_in' => TRUE
					);

					$this->session->set_userdata('user_session', $user_session);
							
					$data['status'] = TRUE;
					$data['redirect_url'] = base_url('/users/dashboard');
				}
				else
				{
					$data['status'] = FALSE;
					$data["errors"] = "Invalid email and Password! Please Try Again!";
				}
			}
			echo json_encode($data);
		}
		else
			$this->load->view('home_page');
	}

	public function dashboard()
	{
		$this->load->view('dashboard');
	}
}

/* end of file */