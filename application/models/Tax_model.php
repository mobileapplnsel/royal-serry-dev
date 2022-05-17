<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Tax_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************branch Module********************************************/
    
    /*public function addNewdocument($data)
    {
        $this->db->insert('document', $data);
        return $this->db->insert_id();
    }*/

    public function getTaxList()
    {
        //$query = $this->db->get('branch');
        //$query  =   $this->db->get_where('document', array('is_deleted' => '0'));
		$this->db->select('t.*');
        $this->db->from('tax t');
        //$this->db->where('d.is_deleted', "0");
        //$this->db->join('document_categories dc', 'd.category_id = dc.cat_id');
        $query  =   $this->db->get();
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