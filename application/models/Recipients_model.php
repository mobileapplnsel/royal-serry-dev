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
        $this->db->insert('quotation_to_address', $data);
        return $this->db->insert_id();
    }

    public function getLists($param = null)
    {
        $this->db->select('*');
        if($param != null){
            $this->db->where($param);
        }
        $query = $this->db->get('quotation_to_address');
        $row = $query->result();
    }

    public function serach($param,$customer_id)
    {
        $this->db->distinct();
        $this->db->where('customer_id', $customer_id);
        $this->db->like('firstname', $param);
        $this->db->order_by("id", "desc");
        //$this->db->group_by('telephone');
        $query = $this->db->get('quotation_to_address');
        return $query->result_array();
    }

    public function getRecipient($param = null)
    {
        $this->db->select('*');
        if($param != null){
            $this->db->where($param);
        }
        $this->db->where('is_deleted', '0');
        $query = $this->db->get('quotation_to_address');
        $row = $query->row();
        return $row;
    }

    public function update($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('quotation_to_address',$data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->delete('quotation_to_address', array('id' => $id));      
        return $this->db->affected_rows();
    }
    
}