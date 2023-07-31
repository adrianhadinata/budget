<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
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

    // Start of Script untuk Admin

    public function index()
    {
        function getRomawi($bln)
        {
            switch ($bln) {
                case 1:
                    return "I";
                    break;
                case 2:
                    return "II";
                    break;
                case 3:
                    return "III";
                    break;
                case 4:
                    return "IV";
                    break;
                case 5:
                    return "V";
                    break;
                case 6:
                    return "VI";
                    break;
                case 7:
                    return "VII";
                    break;
                case 8:
                    return "VIII";
                    break;
                case 9:
                    return "IX";
                    break;
                case 10:
                    return "X";
                    break;
                case 11:
                    return "XI";
                    break;
                case 12:
                    return "XII";
                    break;
            }
        }

        $m = date('n');
        $rm = getRomawi($m);
        $y = date('Y');
        $sum = $this->Form_model->sum_mform_by_id();
        $no = $sum[0]->total;
        $p = $no + 1;
        $c = sprintf("%03s", $p);
        $no_mform = $c . "/" . $rm . "/" . $y;

        $data['no_mform'] = $no_mform;
        $this->load->view('form/form', $data);
    }

    public function getData()
    {
        $d = $this->session->userdata('id_dept');
        $result['data'] = $this->Form_model->loadData($d);
        echo json_encode($result);
    }

    public function getDataSaveModal()
    {
        $id_mform = $this->input->post('id_mform');
        $data = array(
            'description' => $this->input->post('description'),
            'budget' => $this->input->post('budget'),
            'detail_created' => $this->input->post('detail_created'),
            'date_modified' => $this->input->post('date_modified'),
            'id_mform' => $id_mform,
        );

        $this->Form_model->inputDataDetail($data);

        $data2 = array(
            'app' => $this->input->post('app'),
            'app1' => $this->input->post('app1'),
        );
        $this->Form_model->changeStatusBudget($data2, $id_mform);

        echo json_encode($data2);
    }

    public function getDetails()
    {
        $id_mform = $this->input->get('id_mform');
        $result['data'] = $this->Form_model->loadDD($id_mform);
        echo json_encode($result);
    }

    public function getTotal()
    {
        $id = $this->input->post('id');
        $result['data'] = $this->Form_model->ttl($id);
        echo json_encode($result);
    }

    public function u_modal()
    {
        $id = $this->input->post('id_vform');
        $id_mform = $this->input->post('id_mform');

        $data = array(
            'budget' => $this->input->post('budget'),
            'description' => $this->input->post('description'),
            'date_modified' => $this->input->post('date_modified'),
        );

        $this->Form_model->updateDataSaveModal($data, $id);

        $data2 = array(
            'app' => $this->input->post('app'),
            'app1' => $this->input->post('app1'),
        );

        $this->Form_model->changeStatusBudget($data2, $id_mform);
        echo json_encode($data);
    }

    public function del_vform()
    {
        $id = $this->input->post('id_vform');
        $id_mform = $this->input->post('id_mform');

        $this->Form_model->del_vform_vformapp($id);

        $data2 = array(
            'app' => $this->input->post('app'),
            'app1' => $this->input->post('app1'),
        );

        $this->Form_model->changeStatusBudget($data2, $id_mform);
    }

    // End of Script untuk admin

    // Start of Script untuk approval

    public function getDataM()
    {
        $result['data'] = $this->Form_model->loadDataM();
        echo json_encode($result);
    }

    public function getDetailss()
    {
        $id_mform = $this->input->get('id_mform');
        $result['data'] = $this->Form_model->loadDDc($id_mform);
        echo json_encode($result);
    }

    // End of script untuk approval

    // Start of script untuk report

    public function getDataAcc()
    {
        $result['data'] = $this->Form_model->loadFormAcc();
        echo json_encode($result);
    }

    // End of script untuk report
}
