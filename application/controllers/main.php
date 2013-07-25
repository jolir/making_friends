<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	protected $view_data = array();
	protected $user_session = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->user_session = $this->session->userdata('user_session');
	}

	public function index()
	{	
		if($this->is_login())
			redirect(base_url('/users'));
		else
			$this->load->view('home_page');	
	}

	protected function is_login()
	{
		if($this->user_session['is_logged_in'] && is_numeric($this->user_session['user_id']))
			return TRUE;
		else
			return FALSE;
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

/* end of file */