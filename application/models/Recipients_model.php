<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Recipients_model extends CI_Model
{
    public function __construct()
    {       
        parent::__construct();
    }
    
    public function insert($data)
    {
        $this->db->insert('recipients', $data);
        return $this->db->insert_id();
    }

    public function getLists($param = null)
    {
        $this->db->select('*');
        if($param != null){
            $this->db->where($param);
        }
        $query = $this->db->get('recipients');
        $row = $query->result();
    }

    public function serach($param)
    {
        $this->db->select('*');
        $this->db->like('firstname', $param);
        $query = $this->db->get('recipients');
        return $query->result();
    }

    public function getRecipient($param = null)
    {
        $this->db->select('*');
        if($param != null){
            $this->db->where($param);
        }
        $this->db->where('is_deleted', '0');
        $query = $this->db->get('recipients');
        $row = $query->row();
        return $row;
    }

    public function update($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('recipients',$data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->delete('recipients', array('id' => $id));      
        return $this->db->affected_rows();
    }
    
}