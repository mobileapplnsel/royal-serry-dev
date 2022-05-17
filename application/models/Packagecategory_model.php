<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Category_model class.
 * 
 * @extends CI_Model
 */
class Packagecategory_model extends CI_Model
{
    public function __construct()
    {		
		parent::__construct();
    }

    public function getCategoriesList()
    {
		$this->db->select('c.*');
        $this->db->from('package_categories c');
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
					$this->db->from('package_categories');
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
    
    public function getParentCategory($id)
    {
        $this->db->select('*');
        $this->db->from('package_categories');
        $this->db->where('status', '1');
		$this->db->where('parent_cat_id', $id);
        if($id != 0){
            $this->db->where_not_in('cat_id', $id);
        }

        $query  =   $this->db->get();
        //$query = $this->db->last_query();
        //echo $query; die();
        $row    =   $query->num_rows();
        if ($row > 0)
        {           
            $row    =   $query->result();
            return $row;
        }
        else
        {
            return $row;
        }
    }

    public function insertcategory($data)
    {
        $this->db->insert('package_categories', $data);
        return $this->db->insert_id();
    }

    public function editCategory($id)
    {
        $query  =   $this->db->get_where('package_categories', array('cat_id' => $id));
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            $row        =   $query->result();
            return  $row;            
        }
        else
        {
            return $row;
        }
    }

    

    public function updateCategory($id, $data)
    {
        $this->db->set($data);
        $this->db->where('cat_id',$id);
        $this->db->update('package_categories',$data);
        
        /*$query = $this->db->last_query();
        echo $query;*/
        
        return $this->db->affected_rows();
    }

    public function is_parent_category($id)
    {
        $query  =   $this->db->get_where('package_categories', array('parent_cat_id' => $id));
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            $row        =   $query->result();
            return  $row;            
        }
        else
        {
            return $row;
        }
    }
	
	public function category_duplicate_check_by_name($name)
    {
        $query  =   $this->db->get_where('package_categories', array('category_name' => $name));
        $row    =   $query->num_rows();
		return $row;
    }
	
	public function category_duplicate_check_by_name_and_id($name, $id)
    {
        $query  =   $this->db->get_where('package_categories', array('category_name' => $name, 'cat_id !='=> $id));
        $row    =   $query->num_rows();
		return $row;
	}

    public function deleteCategory($id)
    {
        $this->db->delete('package_categories', array('cat_id' => $id));      
        return $this->db->affected_rows();
    }
}