<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('user_model');
        $this->load->model('admin_model');
        $this->load->library('form_validation');
    }

	public function index()
	{
        $this->load->view('login');
    }
    
    public function store()
    {
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() != false){
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $where = [
                'email' => $email,
                'password' => md5($password)
            ];

            $check = $this->user_model->is_exists($where)->num_rows();

            if($check > 0){
                $result = $this->user_model->is_exists($where)->row();
                $data_session = [
                    'user_id' => $result->id,
                    'display_name' => $result->display_name,
                    'email' => $result->email,
                    'photo' => $result->photo,
                    'status' => "login"
                ];
         
                $this->session->set_userdata($data_session);
         
                redirect(base_url());
            }else{
                $this->session->set_flashdata('login_error', 'Email atau Password salah!');

                redirect(base_url('login'));
            }
        }else{
            redirect(base_url('login'));
        }
    }

    public function admin()
    {
        $this->load->view('admin/login');
    }

    public function store_admin()
    {
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() != false){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $where = [
                'username' => $username,
                'password' => md5($password)
            ];

            $check = $this->admin_model->is_exists($where)->num_rows();

            if($check > 0){
                $result = $this->admin_model->is_exists($where)->row();
                $data_session = [
                    'user_id' => $result->id,
                    'username' => $result->username,
                    'status' => "login",
                    'is_admin' => 1,
                ];
         
                $this->session->set_userdata($data_session);
         
                redirect(base_url('admin'));
            }else{
                $this->session->set_flashdata('login_error', 'kombinasi salah!');

                redirect(base_url('login/admin'));
            }
        }else{
            redirect(base_url('login/admin'));
        }
    }
}
