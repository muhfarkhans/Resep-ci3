<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

	public function index()
	{
        $this->load->view('register');
    }
    
    public function store()
    {
        $this->form_validation->set_rules('name','Nama','required');
        $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() != false){
            $data = [
                $this->input->post('name'),
                $this->input->post('email'),
                md5($this->input->post('password'))
            ];

            $update = $this->user_model->insert_data($data);
            $result = $this->user_model->is_exists(['id' => $update])->row();
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
            $this->load->view('register');
        }
    }

    public function logout()
    {
        session_destroy();
        redirect(base_url());
    }
}
