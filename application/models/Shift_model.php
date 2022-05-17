<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Shift_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************branch Module********************************************/
    
    public function addNewshift($data)
    {
        $this->db->insert('shift_master', $data);
        return $this->db->insert_id();
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
	
	public function getShippingCatList()
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
	
	public function getShippingDocumentCatList()
    {
        $query  =   $this->db->get_where('document_package_categories', array('status' => '1', 'parent_cat_id' => '0', 'type' => '1'));
		
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
	
	public function getShippingDocumentCatList_byId($type)
    {
        $query  =   $this->db->get_where('document_package_categories', array('status' => '1', 'parent_cat_id' => '0', 'type' => $type));
		
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
	
	public function getShippingDocumentCatListbyOption($type)
    {
        $query  =   $this->db->get_where('document_package_categories', array('status' => '1', 'parent_cat_id' => '0', 'type' => $type));
		
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            //$row = $query->result();
			$output = '';
			foreach($query->result() as $row)
			{
			   $output .= '<option value="'.$row->cat_id.'">'.$row->category_name.'</option>';
			}
			return $output;
            //return $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }
	
	
    public function getShiftList()
    {
		$this->db->select('*');
        $this->db->from('shift_master sm');
        //$this->db->where('d.is_deleted', "0");
        //$this->db->join('shipping_mode sm', 'rm.ship_mode_id = sm.id');
		//$this->db->join('shipping_category sc', 'rm.ship_cat_id = sc.id');
		//$this->db->join('document_package_categories dpc', 'rm.ship_subcat_id = dpc.cat_id');
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
	
	public function checkExistRate($ship_mode_id,$ship_cat_id,$ship_subcat_id,$rate_type)
    {
        $query  =   $this->db->get_where('rate_master', array('ship_mode_id' => $ship_mode_id, 'ship_cat_id' => $ship_cat_id, 'ship_subcat_id' => $ship_subcat_id, 'rate_type' => $rate_type));
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
	
	public function checkExistRate_byID($ship_mode_id,$ship_cat_id,$ship_subcat_id,$rate_type,$id)
    {
		
		$array = array('ship_mode_id' => $ship_mode_id, 'ship_cat_id' => $ship_cat_id, 'ship_subcat_id' => $ship_subcat_id, 'rate_type' => $rate_type);
		$this->db->select('*');
		$this->db->from('rate_master');
		$this->db->where($array);
		$this->db->where_not_in('id', $id);
		$query  =   $this->db->get();
		
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

    public function editShift($id)
    {
        $query  =   $this->db->get_where('shift_master', array('id' => $id));
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
    
    public function updateShift($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('shift_master',$data);
        return $this->db->affected_rows();
    }

    public function deleteShift($id)
    {
        $this->db->delete('shift_master', array('id' => $id));
        return $this->db->affected_rows();
    }

    
}