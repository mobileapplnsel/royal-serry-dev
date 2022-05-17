<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Custompush_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    public function insertpush($data)
    {
        $this->db->insert('custom_push_notification', $data);
        return $this->db->insert_id();
    }

    public function getPushList()
    {
        $query = $this->db->get('custom_push_notification');
        
        //$query  =   $this->db->get();
        //$query = $this->db->last_query();
        //echo $query;
        //die();
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row = $query->result();
            return $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }

    public function deletepush($id)
    {
        $this->db->delete('custom_push_notification', array('cus_push_id' => $id));      
        return $this->db->affected_rows();
    }

}