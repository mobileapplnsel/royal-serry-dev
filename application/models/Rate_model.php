<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Rate_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************branch Module********************************************/
    
    public function addNewrate($data)
    {
        $this->db->insert('rate_master', $data);
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
	
	public function getDeliveryModeList()
    {
        $query  =   $this->db->get_where('delivery_mode', array('status' => '1'));
        $row = $query->num_rows();
        if ($row > 0)
        {
            $row = $query->result();
            return $row;            
        }
        else
        {
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
	
	public function getShippingDocumentSubCatList_byId($parent_cat_id, $type)
    {
        $query  =   $this->db->get_where('document_package_categories', array('status' => '1', 'parent_cat_id' => $parent_cat_id, 'type' => $type));
		
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
			$output = '<option value="">Select Item Category</option>';
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
	
	
	public function getShippingDocumentSubCatListbyOption($catId,$type)
    {
        $query  =   $this->db->get_where('document_package_categories', array('status' => '1', 'parent_cat_id' => $catId, 'type' => $type));
		
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            //$row = $query->result();
			$output = '<option value="">Select Item Sub-Category</option>';
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
			$output = '<option value="">Select Item Sub-Category</option>';
            return $output;
        }
    }
	
	
    public function getRateList()
    {
		$this->db->select('rm.*,sm.name as ship_mode_name, sc.name as ship_cat_name, dpc.category_name as item_cat_name, dpcat.category_name as item_subcat_name, stm.name as location_from_name, st.name as location_to_name, dm.name as delivery_mode_name');
        $this->db->from('rate_master rm');
        //$this->db->where('d.is_deleted', "0");
        $this->db->join('shipping_mode sm', 'rm.ship_mode_id = sm.id');
		$this->db->join('shipping_category sc', 'rm.ship_cat_id = sc.id');
		$this->db->join('document_package_categories dpc', 'rm.ship_subcat_id = dpc.cat_id');
		$this->db->join('states_master stm', 'rm.location_from = stm.id', 'left');
		$this->db->join('states_master st', 'rm.location_to = st.id', 'left');
		$this->db->join('document_package_categories dpcat', 'rm.ship_sub_subcat_id = dpcat.cat_id', 'left');
		$this->db->join('delivery_mode dm', 'rm.delivery_mode_id = dm.id', 'left');
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
	
	public function checkExistRate($ship_mode_id,$delivery_mode_id,$ship_cat_id,$ship_subcat_id,$ship_sub_subcat_id,$rate_type,$location_from,$location_to)
    {
        $query  =   $this->db->get_where('rate_master', array('ship_mode_id' => $ship_mode_id, 'delivery_mode_id' => $delivery_mode_id, 'ship_cat_id' => $ship_cat_id, 'ship_subcat_id' => $ship_subcat_id, 'ship_sub_subcat_id' => $ship_sub_subcat_id, 'rate_type' => $rate_type, 'location_from' => $location_from, 'location_to' => $location_to));
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
	
	public function checkExistRate_byID($ship_mode_id,$delivery_mode_id,$ship_cat_id,$ship_subcat_id,$ship_sub_subcat_id,$rate_type,$location_from,$location_to,$id)
    {
		
		$array = array('ship_mode_id' => $ship_mode_id, 'delivery_mode_id' => $delivery_mode_id, 'ship_cat_id' => $ship_cat_id, 'ship_subcat_id' => $ship_subcat_id, 'ship_sub_subcat_id' => $ship_sub_subcat_id, 'rate_type' => $rate_type,'location_from' => $location_from, 'location_to' => $location_to);
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

    public function editRate($id)
    {
        $query  =   $this->db->get_where('rate_master', array('id' => $id));
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
    
    public function updateRate($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('rate_master',$data);
        return $this->db->affected_rows();
    }

    public function deleteRate($id)
    {
        $this->db->delete('rate_master', array('id' => $id));
        return $this->db->affected_rows();
    }
	
	public function getRateFactorList()
    {
		$this->db->select('rf.*');
        $this->db->from('rate_factor rf');
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
	
	public function update_rate_factor($data, $id)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('rate_factor', $data);
        return $this->db->affected_rows();
    }

    
}