<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
        $this->load->view('welcome_message');
    }

    public function table()
    {
        $result['data'] = $this->Form_model->dashboard();
        echo json_encode($result);
    }

    public function ctx()
    {
        $idDept = $this->input->get('idDept');
        $result = $this->Form_model->dasboard_2($idDept);
        echo json_encode($result);
    }

    public function ctxx()
    {
        $result = $this->Form_model->dasboard_3();
        echo json_encode($result);
    }

    public function difference()
    {
        $month = $this->input->get('month');
        $idDept = $this->input->get('idDept');
        $last_month = $this->input->get('last_month');
        $result = $this->Form_model->dasboard_3($idDept, $month, $last_month);
        echo json_encode($result);
    }
}
