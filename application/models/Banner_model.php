<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Banner_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************branch Module********************************************/
    
    public function addNewbanner($data)
    {
        $this->db->insert('banner', $data);
        return $this->db->insert_id();
    }

    public function getBannerList()
    {
		$this->db->select('b.*');
        $this->db->from('banner b');
        //$this->db->where('d.is_deleted', "0");
        //$this->db->join('document_package_categories dc', 'd.category_id = dc.cat_id');
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
	
	public function checkExistDocument($name)
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
    }

    public function getBannerDetails($id)
    {
        $query  =   $this->db->get_where('banner', array('id' => $id));
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
    
    public function updateBanner($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('banner',$data);
        return $this->db->affected_rows();
    }

    public function deleteBanner($id)
    {
        $this->db->delete('banner', array('id' => $id));
        return $this->db->affected_rows();
    }
	
	
	

    
}