<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Paymentoption_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************branch Module********************************************/
    
    public function addNewpaymentoption($data)
    {
        $this->db->insert('payment_option', $data);
        return $this->db->insert_id();
    }

    public function getPaymentoptionList()
    {
        //$query = $this->db->get('branch');
        $query  =   $this->db->get_where('payment_option');
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
	
	public function checkExistPaymentoption($name)
    {
        $query  =   $this->db->get_where('payment_option', array('name' => $name));
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

    public function editPaymentoption($id)
    {
        $query  =   $this->db->get_where('payment_option', array('id' => $id));
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
    
    public function updatePaymentoption($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('payment_option',$data);
        return $this->db->affected_rows();
    }

    public function deletePaymentoption($id)
    {
        $this->db->delete('payment_option', array('id' => $id));
        return $this->db->affected_rows();
    }

    
}