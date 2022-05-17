<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Document_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************branch Module********************************************/
    
    public function addNewdocument($data)
    {
        $this->db->insert('document', $data);
        return $this->db->insert_id();
    }

    public function getDocumentList()
    {
        //$query = $this->db->get('branch');
        //$query  =   $this->db->get_where('document', array('is_deleted' => '0'));
		$this->db->select('d.*,dc.category_name');
        $this->db->from('document d');
        $this->db->where('d.is_deleted', "0");
        $this->db->join('document_package_categories dc', 'd.category_id = dc.cat_id');
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

    public function editDocument($id)
    {
        $query  =   $this->db->get_where('document', array('document_id' => $id));
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
    
    public function updateDocument($id, $data)
    {
        $this->db->set($data);
        $this->db->where('document_id',$id);
        $this->db->update('document',$data);
        return $this->db->affected_rows();
    }

    public function deleteDocument($id)
    {
        $this->db->delete('document', array('document_id' => $id));
        return $this->db->affected_rows();
    }
	
	public function getdocumentCategoriesList()
    {
		$this->db->select('c.*');
        $this->db->from('document_package_categories c');
		$this->db->where('type', '1');
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