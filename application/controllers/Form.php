<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    //

    public function getData()
    {
        $d = $this->session->userdata('id_dept');
        $result['data'] = $this->Form_model->loadData($d);
        echo json_encode($result);
    }

    public function getDataApp()
    {
        $result['data'] = $this->Form_model->loadDataApp();
        echo json_encode($result);
    }

    public function getDataM()
    {
        $d = $this->session->userdata('id_dept');
        $result['data'] = $this->Form_model->loadDataM($d);
        echo json_encode($result);
    }

    public function getDataAc()
    {
        $result['data'] = $this->Form_model->loadDataAc();
        echo json_encode($result);
    }

    public function getDataGm()
    {
        $result['data'] = $this->Form_model->loadDataGm();
        echo json_encode($result);
    }

    public function getDetailss()
    {
        $id_mform = $this->input->get('id_mform');
        $result['data'] = $this->Form_model->loadDDc($id_mform);
        echo json_encode($result);
    }

    public function getItem($id)
    {
        $result = $this->Form_model->loadItemById($id);
        echo json_encode($result);
    }

    public function getDept()
    {
        $result['data'] = $this->Form_model->loadDept();
        echo json_encode($result);
    }

    public function u_modals()
    {
        $data = array(
            'order' => $this->input->post('order'),
            'remarks' => $this->input->post('remarks'),
            'date_modified' => $this->input->post('date_modified'),
            'no_po' => $this->input->post('no_po'),
            'unit' => $this->input->post('unit'),
            'price' => $this->input->post('price'),
            'payment' => $this->input->post('payment'),
        );

        $id = $this->input->post('id');

        $this->Form_model->updateDataSaveClone($data, $id);
        echo json_encode($data);
    }

    public function u_po()
    {
        $data = array(
            'no_po' => $this->input->post('no_po'),
            'po_added' => $this->input->post('po_added'),
            'sub_date' => $this->input->post('sub_date'),
            'price' => $this->input->post('price'),
            'cash_remarks' => $this->input->post('cash_remarks')
        );

        $id = $this->input->post('id');
        $this->Form_model->updateDataPO($data, $id);
        echo json_encode($data);
    }

    public function del()
    {
        $id = $this->input->post('id');
        $this->Form_model->del_data($id);
    }

    public function call()
    {
        $id = $this->input->post('id');
        $result = $this->Form_model->mform_by_id($id);
        echo json_encode($result);
    }

    public function gtl()
    {
        $id = $this->input->post('id');
        $result['data'] = $this->Form_model->ttl($id);
        echo json_encode($result);
    }

    public function notu()
    {
        $result['data'] = $this->Form_model->list_123();
        echo json_encode($result);
    }

    public function cnotu()
    {
        $result['data'] = $this->Form_model->list_456();
        echo json_encode($result);
    }

    public function cashr()
    {
        $m = $this->input->get('m');
        $y = $this->input->get('y');
        $result['data'] = $this->Form_model->get_app_c_by_y($m, $y);
        echo json_encode($result);
    }

    public function casht()
    {
        $m = $this->input->get('m');
        $y = $this->input->get('y');

        $result['data'] = $this->Form_model->total_app($m, $y);
        echo json_encode($result);
    }

    public function cashtf()
    {
        $m = $this->input->get('m');
        $y = $this->input->get('y');
        $result['data'] = $this->Form_model->get_app_tf_by_y($m, $y);
        echo json_encode($result);
    }

    public function cashtft()
    {
        $m = $this->input->get('m');
        $y = $this->input->get('y');

        $result['data'] = $this->Form_model->total_tf($m, $y);
        echo json_encode($result);
    }

    public function u_deliv_c()
    {
        $id = $this->input->get('id');
        $data = $this->Form_model->updateDataSaveClone1($id);
        echo json_encode($data);
    }

    public function load_dtl()
    {
        $result['data'] = $this->Form_model->get_dtl();
        echo json_encode($result);
    }

    public function load_voc()
    {
        $result['data'] = $this->Voc_model->load();
        echo json_encode($result);
    }

    public function get_item()
    {
        $id_mvoc = $this->input->get('id_mvoc');
        $result['data'] = $this->Voc_model->load_for_pj($id_mvoc);
        echo json_encode($result);
    }

    public function count()
    {
        $id = $this->input->get('id');
        $result['data'] = $this->Form_model->get_count($id);
        echo json_encode($result);
    }

    public function counting()
    {
        $id = $this->input->post('id');
        $first = $this->input->post('first');
        $second = $this->input->post('second');
        $final = $this->input->post('final');
        $data = array(
            'id_mform' => $id,
            'first' => $first,
            'second' =>  $second,
            'final' => $final
        );
        $this->Form_model->insert_count($data);
    }

    public function record()
    {
        $id = $this->input->get('id');
        $result['data'] = $this->Form_model->get_record($id);
        echo json_encode($result);
    }
}
