<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('admin_model');
        $this->load->model('slider_model');
        $this->load->library('form_validation');

        if(!$this->session->userdata('is_admin')){
			redirect(base_url("login/admin"));
		}
    }

	public function index()
	{
        //echo md5("admin");
        $data['slider'][] = $this->slider_model->is_exists(['id' => 1])->row();
        $data['slider'][] = $this->slider_model->is_exists(['id' => 2])->row();
        $data['slider'][] = $this->slider_model->is_exists(['id' => 3])->row();
        
        $this->load->view('admin/index', $data);


    }

    public function update()
    {
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','min_length[8]');

        if($this->form_validation->run() != false){
            $id = $this->session->userdata("user_id");
            $username = $this->input->post('username');

            if($this->input->post('password') == "" ) {
                $where = [
                    'id' => $id
                ];

                $result = $this->admin_model->is_exists($where)->row();
                $password = $result->password;
            } else {
                $password = md5($this->input->post('password'));
            }
            
            $data = [
                $username,
                $password,
            ];
            
            $update = $this->admin_model->update_data($data, $id);
            $this->session->set_userdata([
                'user_id' => $id,
                'username' => $username,
                'status' => "login",
                'is_admin' => 1,
            ]);

            redirect(base_url('admin'));
        }else{
            $this->load->view('admin/index');
        }
    }

    public function store_slider($id)
    {
        $this->form_validation->set_rules('text','Text','required');
        $this->form_validation->set_rules('link','Link','required');

        if($this->form_validation->run() != false){
            $text = $this->input->post('text');
            $link = $this->input->post('link');

            if (!empty($_FILES['photo']['name'])) {
                $upload_image = $this->upload_foto('photo');
                
                if (empty($upload_image['error'])) {
                    $photo = $upload_image['upload_data']['file_name'];
                    $data = [
                        'id' => $id,
                        'img' => $photo,
                        'text' => $text,
                        'link' => $link
                    ];
                } else {
                    $data = [
                        'id' => $id,
                        'text' => $text,
                        'link' => $link
                    ];
                }
            } else {
                $data = [
                    'id' => $id,
                    'text' => $text,
                    'link' => $link
                ];
            }
            
            $update = $this->slider_model->addOrUpdate($data, $id);

            redirect(base_url('admin'));
        }else{
            $this->load->view('admin/index');
        }
    }

    public function upload_foto($photo)
    {
        $config['upload_path'] = './assets/slider';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 2048;
        $config['max_height'] = 1506;

        $this->load->library('upload', $config);
    
        if (! $this->upload->do_upload($photo)) {
            $result = [
                'error' => $this->upload->display_errors()
            ];
        } else {
            $result = [
                'upload_data' => $this->upload->data()
            ];
        }

        return $result;
    }
}
