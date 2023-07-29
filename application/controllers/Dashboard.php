<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => "Username can't be empty!",
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => "Password can't be empty!",
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->db->get_where('muser', ['username' => $username])->row_array();

            if ($user) {
                if (password_verify($password, $user['password'])) {

                    $data = [
                        'username' => $user['username'],
                        'id' => $user['id']
                    ];

                    $this->session->set_userdata($data);
                    redirect('Home');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Error!</div>');
                    redirect('Welcome');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username Error!</div>');
                redirect('Welcome');
            }
        }
    }

    public function index_sd()
    {
        $this->load->view('welcome_message');
    }

    public function testWa()
    {
        $this->load->view('test/wa');
    }
}
