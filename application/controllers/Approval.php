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
        $data['items'] = $this->Form_model->loadItem();
        $this->load->view('form_manager/form', $data);
    }

    public function getData()
    {
        $result['data'] = $this->Form_model->loadData();
        echo json_encode($result);
    }

    public function acc()
    {
        $id_mform = $this->input->post('id');
        $id_role = $this->input->post('role');

        if ($id_role == "2") {
            $app = "app1";
            // echo "MANAGER";
        } else if ($id_role == "3") {
            $app = "app2";
            // echo "ACC";
        } else if ($id_role == "4") {
            $app = "app3";
            // echo "GM";
        } else {
            $app = "date_modified";
            // echo "BUG";
        }

        if (!isset($_POST['remarks_gm'])) {
            $data2 = array(
                'appMan' => (int)$this->input->post('appMan'),
                'appAccp' => (int)$this->input->post('appAccp'),
                'appGm' => (int)$this->input->post('appGm'),
                'active' => (int)$this->input->post('active'),
                'date_modified' => $this->input->post('date_modified'),
                $app => $this->input->post('date_modified')
            );
            $this->Form_model->changeStatusBudget($data2, $id_mform);
        } else {
            $data = array(
                'id_mform' => (int)$this->input->post('id'),
                'remarks_gm' => $this->input->post('remarks_gm'),
                'date_gm' => $this->input->post('date_modified'),
                'status' => $this->input->post('status'),
            );
            $data2 = array(
                'appMan' => (int)$this->input->post('appMan'),
                'appAccp' => (int)$this->input->post('appAccp'),
                'appGm' => (int)$this->input->post('appGm'),
                'active' => (int)$this->input->post('active'),
                'date_modified' => $this->input->post('date_modified'),
                $app => $this->input->post('date_modified')
            );
            $this->Form_model->add_remarks($data);
            $this->Form_model->changeStatusBudget($data2, $id_mform);
        }

        if ((int)$this->input->post('active') === 3) {
            $this->Form_model->del_counting($id_mform);
        } else if ((int)$this->input->post('active') === 4) {
            $this->Form_model->del_counting($id_mform);
        }
        echo json_encode($data2);
    }
}
