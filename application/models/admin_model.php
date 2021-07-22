<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    /**
     * Users table
     */
    protected $table;
    
    function __construct(){
		parent::__construct();		
        $this->table = 'admin';
    }
    
    public function insert_data($data)
	{
        $data = array(
            'username' => $data[0],
            'password' => $data[1],
        );
    
        $this->db->insert($this->table, $data);
        $insertId = $this->db->insert_id();

        return  $insertId;
    }
    
    public function is_exists($where)
    {
        return $this->db->get_where($this->table, $where);
    }

    public function update_data($data, $id)
	{
        $data = array(
            'username' => $data[0],
            'password' => $data[1],
        );
        
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }
}
