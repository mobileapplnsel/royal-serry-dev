<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Container_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************branch Module********************************************/
    
    public function addNewcontainer($data)
    {
        $this->db->insert('container_shipment', $data);
        return $this->db->insert_id();
    }
	
	public function addNewItemTocontainer($data)
    {
        $this->db->insert('container_shipment_items', $data);
        return $this->db->insert_id();
    }
	
	public function insert_shipment_stops($data)
    {
        $this->db->insert('container_shipment_stops', $data);
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
	
	public function getToBranchList($BranchId)
    {
        //$query  =   $this->db->get_where('document_package_categories', array('status' => '1', 'parent_cat_id' => '0', 'type' => $type));
		$where = array('status' => '1', 'is_main_office' => '0');
		$this->db->select('*');
		$this->db->from('branch');
		$this->db->where($where);
		$this->db->where_not_in('branch_id', $BranchId);
		$query  =   $this->db->get();
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            //$row = $query->result();
			$output = '<option value="">Select To Branch ID</option>';
			foreach($query->result() as $row)
			{
			   $output .= '<option value="'.$row->branch_id.'">'.$row->name.'</option>';
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
	
	
    public function getContainerList($from_branch_id, $to_branch_id)
    {
		$this->db->select('cs.*, sm.name as shipping_mode_name, b.name as from_branch_name, br.name to_branch_name');
        $this->db->from('container_shipment cs');
        $this->db->join('shipping_mode sm', 'cs.shipment_mode = sm.id');
		$this->db->join('branch b', 'cs.from_branch_id = b.branch_id', 'left');
		$this->db->join('branch br', 'cs.to_branch_id = br.branch_id', 'left');
		if($from_branch_id != ''){
            $this->db->where('cs.from_branch_id', $from_branch_id);
        }
		if($to_branch_id != ''){
            $this->db->where('cs.to_branch_id', $to_branch_id);
        }
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
	
	public function getContainerList_ByBranchId($branch_id)
    {
		$this->db->select('cs.*, sm.name as shipping_mode_name, b.name as from_branch_name, br.name to_branch_name');
        $this->db->from('container_shipment cs');
        $this->db->join('shipping_mode sm', 'cs.shipment_mode = sm.id');
		$this->db->join('branch b', 'cs.from_branch_id = b.branch_id', 'left');
		$this->db->join('branch br', 'cs.to_branch_id = br.branch_id', 'left');
		$this->db->join('container_shipment_stops css', 'cs.id = css.shipment_id', 'left');
		$this->db->where('cs.from_branch_id', $branch_id);
		$this->db->or_where('cs.to_branch_id', $branch_id);
		$this->db->or_where('css.branch_id', $branch_id);
		$this->db->group_by('cs.id');
        $query  =   $this->db->get();
		//echo $this->db->last_query(); die;
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
	
	public function getViaBranchList($id)
    {
		$this->db->select('css.*, b.branch_id as branchId, b.name as branchName');
        $this->db->from('container_shipment_stops css');
        //$this->db->join('shipping_mode sm', 'cs.shipment_mode = sm.id');
		$this->db->join('branch b', 'css.branch_id = b.branch_id', 'left');
		$this->db->where('css.shipment_id',$id);
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
	
	public function checkExistRate($ship_mode_id,$ship_cat_id,$ship_subcat_id,$ship_sub_subcat_id,$rate_type)
    {
        $query  =   $this->db->get_where('rate_master', array('ship_mode_id' => $ship_mode_id, 'ship_cat_id' => $ship_cat_id, 'ship_subcat_id' => $ship_subcat_id, 'ship_sub_subcat_id' => $ship_sub_subcat_id, 'rate_type' => $rate_type));
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
	
	public function checkExistRate_byID($ship_mode_id,$ship_cat_id,$ship_subcat_id,$ship_sub_subcat_id,$rate_type,$id)
    {
		
		$array = array('ship_mode_id' => $ship_mode_id, 'ship_cat_id' => $ship_cat_id, 'ship_subcat_id' => $ship_subcat_id, 'ship_sub_subcat_id' => $ship_sub_subcat_id, 'rate_type' => $rate_type);
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

    public function editContainer($id)
    {
        $query  =   $this->db->get_where('container_shipment', array('id' => $id));
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
    
    public function updateContainer($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('container_shipment',$data);
        return $this->db->affected_rows();
    }
	
	public function UpdateContainerItemStatus($id, $data, $shipment_id)
    {
		//get to address
            $this->db->select('zip');
            $this->db->where('shipment_id', $shipment_id);
            $query_tz = $this->db->get('shipment_to_address');
            // echo $this->db->last_query();die;
            if ($query_tz) {
                $to_zip = $query_tz->row_array();
            } else {
                $to_zip = false;
            }
			
		//get to branch_id by pincode
            if (!empty($to_zip)) {
                $this->db->select('`branch_area`.`branch_id` AS tbranch_id');
                $this->db->join('`branch_area`', '`postal_codes_data_master`.`id` = `branch_area`.`area_id`', 'INNER');
                $this->db->where('postal_code', $to_zip['zip']);
                //$this->db->where('is_deleted', '0');
                $query_tb = $this->db->get('postal_codes_data_master');
                // echo $this->db->last_query();
                if ($query_tb) {
                    $to_branchid = $query_tb->row_array();
                } else {
                    $to_branchid = false;
                }
            } else {
                $to_branchid = false;
            }
		//echo '<pre>'; print_r($to_zip); print_r($to_branchid); echo '</pre>';	//die;
		// Start assign order to P/D boy by area
		if (!empty($to_zip) && !empty($to_branchid)) {
			$this->db->select('pdba.*');
			$this->db->from('pickup_delivery_boy_area pdba');
			$this->db->join('branch_users bu', 'pdba.user_id = bu.user_id');
			$this->db->join('postal_codes_data_master pcdm', 'pdba.area_id = pcdm.id');
			$this->db->where('bu.branch_id', $to_branchid['tbranch_id']);
			$this->db->where('pcdm.postal_code', $to_zip['zip']);
			$query  =   $this->db->get();
			//echo $this->db->last_query(); die;
			$row = $query->num_rows();
			if ($row > 0)
			{
				$pdBoyList = $query->result();
				foreach($pdBoyList as $val){
					$pdBoyData = array(
						'shipment_id' => $shipment_id,
						'user_id' => $val->user_id,
						'order_type' => 2,
						'status' => 0,
						'created_date' => date('Y-m-d H:i:s')
					);
					//echo '<pre>'; print_r($pdBoyData);  echo '</pre>';
					$this->db->insert('pd_boy_order_tagging', $pdBoyData);
					$pdboy_insert_id = $this->db->insert_id();
				}
			}
		}
		// End assign order to P/D boy by area
		
		//status
		$statusData = array(
			'shipment_id' => $shipment_id,
			'status_id' => 8,
			'branch_id' => ($to_branchid['tbranch_id'] != '') ? $to_branchid['tbranch_id'] : 0,
			'status_text' => '',
			'created_by' => $this->session->userdata('user_id'),
			'created_date' => DTIME
		);
		//echo '<pre>'; print_r($statusData);  echo '</pre>';die;
		$this->db->insert('shipment_status', $statusData);
		$status_insert_id = $this->db->insert_id();
		
        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('container_shipment_items',$data);
        return $this->db->affected_rows();
    }

    public function deleteContainer($id)
    {
        $this->db->delete('container_shipment', array('id' => $id));
		$this->db->delete('container_shipment_stops', array('shipment_id' => $id));
        return $this->db->affected_rows();
    }
	
	public function deleteContainerStop($id)
    {
		$this->db->delete('container_shipment_stops', array('shipment_id' => $id));
        return $this->db->affected_rows();
    }
	
	
	public function getContainerLocation_byId($id)
    {
		$this->db->select('cs.from_branch_id, cs.to_branch_id, b.name as from_branch_name, br.name as to_branch_name, cs.full_status, cs.shipment_mode');
        $this->db->from('container_shipment cs');
        //$this->db->join('shipping_mode sm', 'cs.shipment_mode = sm.id');
		$this->db->join('branch b', 'cs.from_branch_id = b.branch_id', 'left');
		$this->db->join('branch br', 'cs.to_branch_id = br.branch_id', 'left');
		$this->db->where('cs.id',$id);
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
	
	public function getContainerViaLocation_byId($id)
    {
		$this->db->select('css.branch_id, b.name as branch_name');
        $this->db->from('container_shipment_stops css');
		$this->db->join('branch b', 'css.branch_id = b.branch_id', 'left');
		$this->db->where('css.shipment_id',$id);
        $query  =   $this->db->get();
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
	
	public function getShipmentDetails_by_locationId($FromBranchId, $vialocationArr, $shipment_mode)
    {
		$this->db->select('sobt.shipment_id, sobt.to_branch_id, sm.shipment_no, sm.quotation_id, sm.customer_id, sm.payment_mode, sm.transport_type, b.name as branch_name, u.firstname, u.email, u.telephone');
        $this->db->from('shipment_order_branch_tagging sobt');
		$this->db->join('shipment_master sm', 'sobt.shipment_id = sm.id', 'left');
		$this->db->join('branch b', 'sobt.to_branch_id = b.branch_id', 'left');
		$this->db->join('pd_boy_order_tagging pbot', 'sm.id = pbot.shipment_id', 'left');
		$this->db->join('container_shipment csi', 'sm.transport_type = csi.shipment_mode', 'left');
		$this->db->join('users u', 'sm.customer_id = u.user_id');
		$this->db->where('sobt.from_branch_id',$FromBranchId);
		$this->db->where_in('sobt.to_branch_id', $vialocationArr);
		$this->db->where('sobt.added_to_container','0');
		$this->db->where('pbot.order_type','1');
		$this->db->where('pbot.status','1');
		$this->db->where('sm.status','1');
		$this->db->where('sm.transport_type',$shipment_mode);
		$this->db->group_by('sobt.shipment_id');
		//$this->db->where('sobt.shipment_id !=', 'csi.order_id');
        $query  =   $this->db->get();
		//echo $this->db->last_query();die();
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
	
	public function getAddedItemShipmentDetails_ByContainerID($container_id)
    {
		$this->db->select('csi.id, csi.order_id, sobt.to_branch_id, sobt.from_branch_id, b.name as branch_name, sm.shipment_no');
        $this->db->from('container_shipment_items csi');
		$this->db->join('shipment_order_branch_tagging sobt', 'csi.order_id = sobt.shipment_id', 'left');
		$this->db->join('branch b', 'sobt.to_branch_id = b.branch_id', 'left');
		$this->db->join('shipment_master sm', 'csi.order_id = sm.id', 'left');
		$this->db->where('csi.container_id',$container_id);
		$this->db->where('sm.status','1');
		//$this->db->where('sobt.added_to_container','0');
		$this->db->group_by('csi.order_id');
        $query  =   $this->db->get();
		//echo $this->db->last_query();die();
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
	
	public function getAddedItemShipmentDetails_ByContainerID_byBranch($container_id, $to_branch_id)
    {
		$this->db->select('csi.id, csi.order_id, sobt.to_branch_id, sobt.from_branch_id, b.name as branch_name, sm.shipment_no');
        $this->db->from('container_shipment_items csi');
		$this->db->join('shipment_order_branch_tagging sobt', 'csi.order_id = sobt.shipment_id', 'left');
		$this->db->join('branch b', 'sobt.to_branch_id = b.branch_id', 'left');
		$this->db->join('shipment_master sm', 'csi.order_id = sm.id', 'left');
		$this->db->where('csi.container_id',$container_id);
		$this->db->where('sobt.to_branch_id',$to_branch_id);
		$this->db->or_where('sobt.from_branch_id',$to_branch_id);
		$this->db->where('sm.status','1');
		$this->db->group_by('csi.order_id');
        $query  =   $this->db->get();
		//echo $this->db->last_query();die();
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
	
	public function getAddedItemShipmentDetails_ByContainerID_byDestinationBranch($container_id, $to_branch_id)
    {
		$this->db->select('csi.id, csi.order_id, sobt.to_branch_id, sobt.from_branch_id, b.name as branch_name, sm.shipment_no');
        $this->db->from('container_shipment_items csi');
		$this->db->join('shipment_order_branch_tagging sobt', 'csi.order_id = sobt.shipment_id', 'left');
		$this->db->join('branch b', 'sobt.to_branch_id = b.branch_id', 'left');
		$this->db->join('shipment_master sm', 'csi.order_id = sm.id', 'left');
		$this->db->where('csi.container_id',$container_id);
		$this->db->where('sobt.to_branch_id',$to_branch_id);
		$this->db->where('sm.status','1');
		//$this->db->or_where('sobt.from_branch_id',$to_branch_id);
		$this->db->group_by('csi.order_id');
        $query  =   $this->db->get();
		//echo $this->db->last_query();die();
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
	
	public function containerItemDetails($shipment_id)
    {
		$this->db->select('sid.*, dpc.category_name as item_name');
        $this->db->from('shipment_item_details sid');
		$this->db->join('document_package_categories dpc', 'sid.category_id = dpc.cat_id', 'left');
		//$this->db->join('container_shipment_items csi', 'sid.item_id != csi.item_id', 'left');
		$this->db->where('sid.shipment_id',$shipment_id);
		//$this->db->where('csi.order_id',$shipment_id);
		//$this->db->group_by('vid.id'); 
        $query  =   $this->db->get();
		//echo $this->db->last_query();die();
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
	
	/*public function containerItemDetails($shipment_id)
    {
		$this->db->select('vid.*');
        $this->db->from('shipment_item_details sid');
		$this->db->join('view_item_details vid', 'sid.item_id = vid.id', 'left');
		$this->db->where('sid.shipment_id',$shipment_id);
		$this->db->group_by('vid.id'); 
        $query  =   $this->db->get();
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
	}*/
	
	public function addedcontainerItemDetails($shipment_id)
    {
		$this->db->select('vid.*, csi.status, csi.id as container_shipment_items_id');
        $this->db->from('container_shipment_items csi');
		$this->db->join('view_item_details vid', 'csi.item_id = vid.id', 'left');
		//$this->db->join('container_shipment_items csi', 'sid.item_id != csi.item_id', 'left');
		$this->db->where('csi.order_id',$shipment_id);
		//$this->db->where('csi.order_id',$shipment_id);
		$this->db->group_by('vid.id'); 
        $query  =   $this->db->get();
		//echo $this->db->last_query();die();
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
	
	
	public function checkItemExistByshipmentID($order_id,$item_id)
    {
		
		$array = array('order_id' => $order_id, 'item_id' => $item_id);
		$this->db->select('*');
		$this->db->from('container_shipment_items');
		$this->db->where($array);
		//$this->db->where_not_in('id', $id);
		$query  =   $this->db->get();
		
        $row = $query->num_rows();
        if ($row > 0)
        {
            return $row;            
        }
        else
        {
            return $row;
        }
    }
	public function addedItamdeleteContainer($container_id, $order_id, $item_id)
    {
        $this->db->delete('container_shipment_items', array('container_id' => $container_id, 'order_id' => $order_id, 'id' => $item_id));
        return $this->db->affected_rows();
    }
	
	public function ChangeContainerStatus($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('container_shipment',$data);
        return $this->db->affected_rows();
    }
	
	public function upadte_container_full_status($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('container_shipment', $data);
        return $this->db->affected_rows();
    }


    public function getContainerByshipmentId($shipmentId)
    {
        
        $this->db->select('cs.*');
        $this->db->join('container_shipment_items csi', 'csi.container_id = cs.id');
        $this->db->from('container_shipment as cs');
        $this->db->where('csi.order_id',$shipmentId);
        $query  =   $this->db->get();
        $row = $query->num_rows();
        if ($row > 0)
        {
            return $query->row();            
        }
        else
        {
            return false;
        }
    }

    
}