<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Package_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************branch Module********************************************/
    
    public function addNewpackage($data)
    {
        $this->db->insert('package', $data);
        return $this->db->insert_id();
    }

    public function getPackageList()
    {
        //$query = $this->db->get('branch');
        //$query  =   $this->db->get_where('package', array('is_deleted' => '0'));
		$this->db->select('d.*,dc.category_name');
        $this->db->from('package d');
        $this->db->where('d.is_deleted', "0");
        $this->db->join('document_package_categories dc', 'd.category_id = dc.cat_id');
        $query  =   $this->db->get();
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
	
	public function checkExistPackage($name)
    {
        $query  =   $this->db->get_where('package', array('name' => $name));
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

    public function editPackage($id)
    {
        $query  =   $this->db->get_where('package', array('package_id' => $id));
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
    
    public function updatePackage($id, $data)
    {
        $this->db->set($data);
        $this->db->where('package_id',$id);
        $this->db->update('package',$data);
        return $this->db->affected_rows();
    }

    public function deletePackage($id)
    {
        $this->db->delete('package', array('package_id' => $id));
        return $this->db->affected_rows();
    }
	
	public function getpackageCategoriesList()
    {
		$this->db->select('c.*');
        $this->db->from('document_package_categories c');
		$this->db->where('type', '2');
		$this->db->where('status', '1');
        $query  =   $this->db->get();
        //$query = $this->db->last_query();
        //echo $query;
        //die();
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row = $query->result();
			
			foreach($row as $key => $res) {
				$pcatid = $row[$key]->parent_cat_id;
				if($pcatid != 0)
				{
					$this->db->select('category_name');
					$this->db->from('document_package_categories');
					$this->db->where('cat_id', $pcatid);
					$querycheck = $this->db->get();
					$resultrow = $querycheck->row();
					$row[$key]->parent_cat_name = $resultrow->category_name;
				} else {
					$row[$key]->parent_cat_name = '';
				}
			}
            return $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }

    
}