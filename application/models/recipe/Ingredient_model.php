<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingredient_model extends CI_Model {

    /**
     * Recipe table
     */
    protected $table;
    
    function __construct(){
		parent::__construct();		
        $this->table = 'recipe_ingredients';
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
}
