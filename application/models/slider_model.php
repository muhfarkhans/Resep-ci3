<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends CI_Model {

    /**
     * Users table
     */
    protected $table;
    
    function __construct(){
		parent::__construct();		
        $this->table = 'slider';
    }
    
    public function insert_data($data)
	{
        $this->db->insert($this->table, $data);
        $insertId = $this->db->insert_id();

        return $insertId;
    }
    
    public function is_exists($where)
    {
        return $this->db->get_where($this->table, $where);
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function update_data($data, $id)
	{
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function addOrUpdate($data, $id)
    {
        if ($this->is_exists(['id' => $id])->num_rows() > 0) {
            $this->update_data($data, $id);
            $res = "update ".$id;
        } else {
            $this->insert_data($data);
            $res = "insert ".$id;
        }

        return $res;
    }
}
