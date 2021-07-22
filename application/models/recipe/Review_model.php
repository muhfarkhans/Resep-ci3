<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_model extends CI_Model {

    /**
     * Recipe table
     */
    protected $table;
    
    function __construct(){
		parent::__construct();		
        $this->table = 'recipe_reviews';
    }
    
    public function insert_data($data)
	{
        $this->db->insert($this->table, $data);
        $insertId = $this->db->insert_id();

        return  $insertId;
    }
    
    public function is_exists($where)
    {
        return $this->db->get_where($this->table, $where);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this;
    }

    public function joinUser($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = recipe_reviews.reviewer_id');
        $this->db->where('recipe_reviews.recipe_id', $id);
        $this->db->order_by('recipe_reviews.created_at', 'DESC');
        $this->db->limit(5);
        return $query = $this->db->get();
    }

    public function joinRecipe()
    {
        $this->db->select('*, recipe_reviews.created_at AS review_created_at');
        $this->db->from($this->table);
        $this->db->join('recipes', 'recipes.id = recipe_reviews.recipe_id');
        $this->db->where('recipe_reviews.reviewer_id', $this->session->userdata('user_id'));
        return $query = $this->db->get();
    }

    public function joinRecipePagination($limit, $offset)
    {
        $this->db->select('*, recipe_reviews.created_at AS review_created_at, recipe_reviews.id AS review_id');
        $this->db->from($this->table);
        $this->db->join('recipes', 'recipes.id = recipe_reviews.recipe_id');
        $this->db->where('recipe_reviews.reviewer_id', $this->session->userdata('user_id'));
        $this->db->limit($limit, $offset);
        return $query = $this->db->get();
    }
}
