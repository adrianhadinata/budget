<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Log_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function logout()
	{
		$insert = [
			'username' => $this->session->userdata['username'],
			'ip_add' => $this->session->userdata['ipman'],
			'remarks' => 'out',
			'date' => date('Y-m-d H:i:s'),
		];
		$this->Log_model->step($insert);
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('id_role');
		$this->session->unset_userdata('id_dept');
		$this->session->unset_userdata('ipman');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
		redirect('Welcome');
	}
}
