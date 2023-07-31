<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Form_model');
        if (!$this->session->userdata('id')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please do Login First!</div>');
            redirect('Welcome');
        }
    }
    public function index()
    {
        $this->load->view('report/report');
    }
}
