<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Recipe extends CI_Controller {

    function __construct(){
		parent::__construct();		
        $this->load->model('recipe/recipe_model');
        $this->load->model('recipe/ingredient_model');
        $this->load->model('recipe/review_model');
        $this->load->model('recipe/step_model');
        $this->load->model('slider_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }

    function _redirect_to_login()
    {
        if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
    }

	public function index()
	{
        //$data['recipe'] = $this->recipe_model->getPublish()->result_array();
        $jumlah_data = $this->recipe_model->getPublish()->num_rows();

        $config['base_url'] = base_url().'recipe/index/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 9;
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
        $data['recipe'] = $this->recipe_model->data($config['per_page'], $from);
        $data['slider'] = $this->slider_model->getAll();
        
        $this->load->view('home', $data);
    }

    public function explore()
    {
        $data['recipe'] = $this->recipe_model->all()->result_array();
        $this->load->view('recipe/explore', $data);
    }

    public function create()
    {
        $this->_redirect_to_login();
        $id = $this->recipe_model->insert_data(['user_id' => $this->session->userdata("user_id"), 'title' => "Untitled", 'created_at' => date('Y-m-d H:i:s')]);
        //return $this->edit($id);
        return redirect(base_url('recipe/edit/').$id);
    }

    public function detail($id)
    {
        $where = [
            'recipe_id' => $id
        ];
        
        $data['detail'] = $this->recipe_model->is_exists(['id' => $id])->row_array();
        $data['ingredients'] = $this->ingredient_model->is_exists($where)->result_array();
        $data['steps'] = $this->step_model->is_exists($where)->result_array();
        $data['reviews'] = $this->review_model->joinUser($id)->result_array();

        $this->load->view('recipe/detail', ['recipe' => $data]);

        /*
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['recipe' => $data]));
        */
    }
    
    public function edit($id)
    {
        $where = [
            'recipe_id' => $id
        ];

        $data['detail'] = $this->recipe_model->is_exists(['id' => $id])->row_array();
        $data['ingredients'] = $this->ingredient_model->is_exists($where)->result_array();
        $data['steps'] = $this->step_model->is_exists($where)->result_array();

        $this->load->view('recipe/edit', ['recipe' => $data]);

        /**
         * $this->output
         * ->set_content_type('application/json')
         * ->set_output(json_encode(['recipe' => $data]));
         */
    }

    public function search()
    {
        $key = $this->input->post('search');
        $data['key'] = $key;
        $jumlah_data = $this->recipe_model->search($key)->num_rows();
        //$jumlah_data = $this->recipe_model->getPublish()->num_rows();

        $config['base_url'] = base_url().'recipe/search/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 9;
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
        $data['recipe'] = $this->recipe_model->dataSearch($config['per_page'], $from, $key)->result();

        $this->load->view('search', $data);
    }

    public function api_search($key)
    {
        $data['key'] = $key;
        $jumlah_data = $this->recipe_model->search($key)->num_rows();
        //$jumlah_data = $this->recipe_model->getPublish()->num_rows();

        $config['base_url'] = base_url().'recipe/search/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 9;
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
        $data['recipe'] = $this->recipe_model->dataSearch($config['per_page'], $from, $key)->result();

        $this->load->view('search', $data);
    }

    public function store_detail($id)
    {
        $judul = $this->input->post('judul');
        $cerita = $this->input->post('cerita');
        $porsi = $this->input->post('porsi');
        $waktu = $this->input->post('waktu');

        if (!empty($_FILES['imgdetail']['name'])) {
            $upload_image = $this->upload_foto('imgdetail');
            
            if (empty($upload_image['error'])) {
                $data = [
                    'title' => $judul,
                    'story' => $cerita,
                    'serves' => $porsi,
                    'cook_time' => $waktu,
                    'img' => $upload_image['upload_data']['file_name'],
                    'created_at' => date('Y-m-d H:i:s')
                ];
            } else {
                print_r($upload_image);

                return;
            }
        } else {
            $data = [
                'title' => $judul,
                'story' => $cerita,
                'serves' => $porsi,
                'cook_time' => $waktu,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        $result = $this->recipe_model->update_data($data, $id);
        
        redirect(base_url('recipe/edit/'.$id));
    }

    public function delete_image_recipe($id)
    {
        $result = $this->recipe_model->update_data(['img' => null], $id);
        
        redirect(base_url('recipe/edit/'.$id));
    }

    public function store_ingredient($id)
    {
        $name = $this->input->post('bumbu');
        $recipe_id = $this->input->post('recipe_id');
        $data = $this->ingredient_model->insert_data(['recipe_id' => $recipe_id, 'name' => $name]);

        redirect(base_url('recipe/edit/'.$id));
    }

    public function delete_ingredient($r, $id)
    {
        $data = $this->ingredient_model->delete($id);

        redirect(base_url('recipe/edit/'.$r));
    }

    public function store_step($id)
    {
        if (!empty($_FILES['imglangkah']['name'])) {
            $upload_image = $this->upload_foto('imglangkah');
            
            if (empty($upload_image['error'])) {
                $data = [
                    'recipe_id' => $this->input->post('recipe_id'),
                    'content' => $this->input->post('langkah'),
                    'img' => $upload_image['upload_data']['file_name']
                ];
            } else {
                print_r($upload_image);

                return;
            }
        } else {
            $data = [
                'recipe_id' => $this->input->post('recipe_id'),
                'content' => $this->input->post('langkah')
            ];
        }
        $result = $this->step_model->insert_data($data);


        redirect(base_url('recipe/edit/'.$id));
    }

    public function delete_step($r, $id)
    {
        $data = $this->step_model->delete($id);
        
        redirect(base_url('recipe/edit/'.$r));
    }

    public function publish($id)
    {
        $data = [
            true
        ];
        
        $update = $this->recipe_model->publish($data, $id);
        redirect(base_url('recipe'));
    }

    public function unpublish($id)
    {
        $data = [
            false
        ];
        
        $update = $this->recipe_model->publish($data, $id);
        redirect(base_url('recipe'));
    }

    public function k($id)
    {
        $data['reviews'] = $this->review_model->joinUser($id)->result_array();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function store_review()
    {
        $comment = $this->input->post('comment');
        $stars = $this->input->post('stars');
        $recipe_id = $this->input->post('recipe_id');
        $data = $this->review_model->insert_data([
            'recipe_id' => $recipe_id,
            'reviewer_id' => $this->session->userdata('user_id'),
            'comment' => $comment, 
            'stars' => $stars,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        redirect(base_url('recipe/detail/'.$recipe_id));
    }

    public function delete($id)
    {
        $this->recipe_model->delete($id);
        return redirect(base_url('user'));
    }

    public function upload_foto($photo)
    {
        $config['upload_path'] = './assets/recipe';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = 5000;
        $config['max_width'] = 3072;
        $config['max_height'] = 2304;

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
