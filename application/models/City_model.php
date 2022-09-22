<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class City_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************City Module********************************************/
    
   
    public function getCityListByState($stateId)
    {
        
		$this->db->select('*');
        $this->db->from('cities_master');
        $this->db->where('state_id', $stateId);
        $query  =   $this->db->get();
        return $results = $query->result();
    }
	
	/*public function checkExistDocument($name)
    {
        $query  =   $this->db->get_where('document', array('name' => $name));
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
    }*/

    public function editTax($id)
    {
        $query  =   $this->db->get_where('tax', array('id' => $id));
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
    
    public function updateTax($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('tax',$data);
        return $this->db->affected_rows();
    }

    public function deleteTax($id)
    {
        $this->db->delete('tax', array('id' => $id));
        return $this->db->affected_rows();
    }

    
}