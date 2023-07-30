<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approval extends CI_Controller
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
        $this->load->view('approval/form');
    }

    public function getData()
    {
        $result['data'] = $this->Form_model->loadData();
        echo json_encode($result);
    }

    public function acc()
    {
        $id_mform = $this->input->post('id_mform');

        $data2 = array(
            'app' => $this->input->post('app'),
            'app1' => $this->input->post('app1'),
        );

        $this->Form_model->changeStatusBudget($data2, $id_mform);
        echo json_encode($id_mform);
    }
}
