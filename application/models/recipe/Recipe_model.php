<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recipe_model extends CI_Model {

    /**
     * Recipe table
     */
    protected $table;

    /**
     * fillable column
     *
     * public $fillable = [
     *   'user_id', 'title', 'story', 'serves', 'cook_time', 'created_at'
     * ];
     */

    function __construct(){
		parent::__construct();		
        $this->table = 'recipes';
    }

    public function all()
    {
        return $this->db->get($this->table); 
    }

    public function getPublish()
    {
        return $this->db->get_where($this->table, ['is_published' => 1]);
    }

    function data($limit, $offset){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_published', 1);
        $this->db->order_by('recipes.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        return $query = $this->db->get()->result();		
	}
    
    public function insert_data($data)
	{
        $this->db->insert($this->table, $data);
        $insertId = $this->db->insert_id();

        return  $insertId;
    }

    public function update_data($data, $id)
	{        
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        
        return $this;
    }
    
    public function is_exists($where)
    {
        return $this->db->get_where($this->table, $where);
    }

    public function search($key)
    {
        $this->db->from($this->table);
        $this->db->where('is_published', 1);
        return $this->db->like('title', $key)->get();
    }

    function dataSearch($limit, $offset, $key){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_published', 1);
        $this->db->like('title', $key);
        $this->db->limit($limit, $offset);
        return $query = $this->db->get();		
	}

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this;
    }

    public function publish($data, $id)
    {
        $data = array(
            'is_published' => $data[0],
        );
        
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }
}
