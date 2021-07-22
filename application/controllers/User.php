<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('user_model');
        $this->load->model('recipe/recipe_model');
        $this->load->model('recipe/review_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');

        if($this->session->userdata('status') != "login" || $this->session->userdata('is_admin')){
			redirect(base_url("login"));
		}
    }

	public function index()
	{
        $data['recipe'] = $this->recipe_model->is_exists(['user_id' => $this->session->userdata("user_id")])->result_array();
        $this->load->view('user/index', $data);
    }
    
    public function edit()
    {
        $this->load->view('user/edit');
    }

    public function review()
    {
        $jumlah_data = $this->review_model->joinRecipe()->num_rows();

        $config['base_url'] = base_url().'user/review/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 5;
        $from = $this->uri->segment(3);
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);		
        $data['reviews'] = $this->review_model->joinRecipePagination($config['per_page'], $from)->result_array();

        $this->load->view('user/review', $data);
    }

    public function delete_review($id)
    {
        $data['reviews'] = $this->review_model->delete($id);

        redirect(base_url('user/review'));
    }

    public function g()
    {
        echo date('Y-m-d H:i:s');
    }

    public function update()
    {
        $this->form_validation->set_rules('name','Nama','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','min_length[8]');

        if($this->form_validation->run() != false){
            $id = $this->session->userdata("user_id");
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            if($this->input->post('password') == "" ) {
                $where = [
                    'id' => $id
                ];

                $result = $this->user_model->is_exists($where)->row();
                $password = $result->password;
            } else {
                $password = md5($this->input->post('password'));
            }

            if (!empty($_FILES['photo']['name'])) {
                $upload_image = $this->upload_foto('photo');
                
                if (empty($upload_image['error'])) {
                    $photo = $upload_image['upload_data']['file_name'];
                } else {
                    $photo = "default.png";
                }
            } else {
                $photo = "default.png";
            }
            
            $data = [
                $name,
                $email,
                $password,
                $photo,
            ];
            
            $update = $this->user_model->update_data($data, $id);
            $this->session->set_userdata([
                'display_name' => $name,
                'email' => $email,
                'photo' => $photo,
            ]);

            redirect(base_url('user'));
        }else{
            $this->load->view('user/index');
        }
    }

    public function upload_foto($photo)
    {
        $config['upload_path'] = './assets/user';
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
