<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Prohibited_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************prohibited Module********************************************/
    
    public function addNewprohibited($data)
    {
        $this->db->insert('prohibited', $data);
        return $this->db->insert_id();
    }

    public function getProhibitedList()
    {
        //$query = $this->db->get('branch');
        //$query  =   $this->db->get_where('prohibited', array('is_deleted' => '0'));
        //$query  =   $this->db->get();
        //$query = $this->db->last_query();
        //echo $query;
        //die();
		$this->db->select('p.*, sc.name as shipping_category_name, sm.name as shipping_mode_name');
        $this->db->from('prohibited p');
        //$this->db->where('d.is_deleted', "0");
        $this->db->join('shipping_category sc', 'p.shipping_category_id = sc.id');
		$this->db->join('shipping_mode sm', 'p.shipping_mode_id = sm.id');
        $query  =   $this->db->get();
		
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
	
	public function getShippingCategoriesList()
    {
        $query  =   $this->db->get_where('shipping_category', array('status' => '1'));
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
	
	public function getShippingModeList()
    {
        $query  =   $this->db->get_where('shipping_mode', array('status' => '1'));
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
	
	public function checkExistProhibited($name)
    {
        $query  =   $this->db->get_where('prohibited', array('name' => $name));
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
           // $row = $query->result();
            return $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }

    public function editProhibited($id)
    {
        $query  =   $this->db->get_where('prohibited', array('prohibited_id' => $id));
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            //return true;
            //$row['id']  =   $id;
            $row        =   $query->result();
            return  $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }
    
    public function updateProhibited($id, $data)
    {
        $this->db->set($data);
        $this->db->where('prohibited_id',$id);
        $this->db->update('prohibited',$data);
        return $this->db->affected_rows();
    }

    public function deleteProhibited($id)
    {
        $this->db->delete('prohibited', array('prohibited_id' => $id));
        return $this->db->affected_rows();
    }

    
}