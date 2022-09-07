<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Order_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************View Order********************************************/
 

    public function getOrderList($from_date ='', $to_date='', $category_id='', $status_id='')
    {
        //$query = $this->db->get('branch');
        //$query  =   $this->db->get_where('document', array('is_deleted' => '0'));
		$this->db->select('sm.*, u.firstname, u.lastname, spd.grand_total');
        $this->db->from('shipment_master sm');
		$this->db->join('users u', 'sm.customer_id = u.user_id');
		$this->db->join('shipment_price_details spd', 'sm.id = spd.shipment_id');
		if($category_id != ''){
			$this->db->join('shipment_item_details sid', 'sm.id = sid.shipment_id');
			$this->db->where('sid.category_id', $category_id);
		}
		if($status_id != ''){
			$this->db->join('shipment_status shm', 'sm.id = shm.shipment_id');
			$this->db->where('shm.status_id', $status_id);
		}
        $this->db->where('sm.parent_id', "0");
        if($from_date != ''){
            $this->db->where('sm.created_date >=',date('Y-m-d',strtotime($from_date)));
        }
        if($to_date != ''){
            $this->db->where('sm.created_date <=',date('Y-m-d',strtotime($to_date)));
        }

		//$this->db->where('sm.quote_type', "0");
        $this->db->order_by("sm.id", "DESC");
		$this->db->group_by('sm.id'); 
        $query  =   $this->db->get();
        /*$query = $this->db->last_query();
        echo $query;
        die();*/
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row = $query->result();
            //echo $this->db->last_query();
            return $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }
	
	public function getPDBoyRequestQuotationList($user_id, $from_date ='', $to_date='')
    {
		$this->db->select('pdbqr.*, qm.*, u.firstname, u.lastname');
        $this->db->from('pd_boy_quotation_req_tagging pdbqr');
		$this->db->join('quotation_master qm', 'pdbqr.quotation_id = qm.id', 'left');
		$this->db->join('users u', 'qm.customer_id = u.user_id');
        $this->db->where('pdbqr.user_id', $user_id);
		$this->db->where('pdbqr.status', '0');
		$this->db->where('qm.status', '1');
		//$this->db->where($where);
        if($from_date != ''){
            $this->db->where('pdbqr.created_date >=',date('Y-m-d',strtotime($from_date)));
        }
        if($to_date != ''){
            $this->db->where('pdbqr.created_date <=',date('Y-m-d',strtotime($to_date)));
        }
        //$this->db->join('users u', 'qm.customer_id = u.user_id');
		$this->db->order_by("pdbqr.id", "DESC");
        $query  =   $this->db->get();
        
        //echo $this->db->last_query();
        //die();
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row = $query->result();
            //echo $query = $this->db->last_query();
            return $row;            
        }
        else
        {
            //return false;
            //echo $query = $this->db->last_query();
            return $row;
        }
    }
	
	public function getCreditorsOrderList($from_date ='', $to_date='')
    {
		$this->db->select('sm.*, u.firstname, u.lastname, spd.grand_total');
        $this->db->from('shipment_master sm');
		$this->db->join('users u', 'sm.customer_id = u.user_id');
		$this->db->join('shipment_price_details spd', 'sm.id = spd.shipment_id');
        $this->db->where('sm.parent_id', "0");
        if($from_date != ''){
            $this->db->where('sm.created_date >=',date('Y-m-d',strtotime($from_date)));
        }
        if($to_date != ''){
            $this->db->where('sm.created_date <=',date('Y-m-d',strtotime($to_date)));
        }

		$this->db->where('sm.payment_mode', "3");
        $this->db->order_by("sm.id", "DESC");
		$this->db->group_by('sm.id'); 
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
	
	public function getInvoiceOrderList($from_date ='', $to_date='')
    {
		$this->db->select('sm.*, u.firstname, u.lastname, spd.grand_total');
        $this->db->from('shipment_master sm');
		$this->db->join('users u', 'sm.customer_id = u.user_id');
		$this->db->join('shipment_price_details spd', 'sm.id = spd.shipment_id');
        $this->db->where('sm.parent_id', "0");
        if($from_date != ''){
            $this->db->where('sm.created_date >=',date('Y-m-d',strtotime($from_date)));
        }
        if($to_date != ''){
            $this->db->where('sm.created_date <=',date('Y-m-d',strtotime($to_date)));
        }

		$this->db->where('sm.is_invoice', "1");
        $this->db->order_by("sm.id", "DESC");
		$this->db->group_by('sm.id'); 
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
	
	public function getpickupOrderList($branchID,$from_date ='', $to_date='')
    {
        //$query = $this->db->get('branch');
        //$query  =   $this->db->get_where('document', array('is_deleted' => '0'));
		$this->db->select('sm.*, u.firstname, u.lastname, spd.grand_total, sfa.firstname as from_firstname, sfa.lastname as from_lastname, sfa.address as from_address, sfa.address2 from_address2, cm.name as country_name, stm.name as state_name, ctm.name as city_name, sfa.zip from_zip, satm.status_name');
        $this->db->from('shipment_master sm');
		$this->db->join('users u', 'sm.customer_id = u.user_id');
		$this->db->join('shipment_price_details spd', 'sm.id = spd.shipment_id');
		$this->db->join('shipment_order_branch_tagging sobt', 'sm.id = sobt.shipment_id');
		$this->db->join('shipment_from_address sfa', 'sm.id = sfa.shipment_id');
		
		$this->db->join('shipment_status ss', 'sm.id = ss.shipment_id', 'left');
		$this->db->join('status_master satm', 'ss.status_id = satm.id', 'left');
		
		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'sfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');
		
        $this->db->where('sm.parent_id', "0");
		$this->db->where('sm.status', "1");
		$this->db->where('sobt.from_branch_id', $branchID);
        if($from_date != ''){
            $this->db->where('sm.created_date >=',date('Y-m-d',strtotime($from_date)));
        }
        if($to_date != ''){
            $this->db->where('sm.created_date <=',date('Y-m-d',strtotime($to_date)));
        }
		$this->db->group_by('sm.id');
        $this->db->order_by("sm.id", "DESC");
        $query  =   $this->db->get();
        //echo $query = $this->db->last_query();die();
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
	
	public function getdeliveryOrderList($branchID,$from_date ='', $to_date='')
    {
		$this->db->select('sm.*, u.firstname, u.lastname, spd.grand_total, sfa.firstname as from_firstname, sfa.lastname as from_lastname, sfa.address as from_address, sfa.address2 from_address2, cm.name as country_name, stm.name as state_name, ctm.name as city_name, sfa.zip from_zip, satm.status_name');
        $this->db->from('shipment_master sm');
		$this->db->join('users u', 'sm.customer_id = u.user_id');
		$this->db->join('shipment_price_details spd', 'sm.id = spd.shipment_id');
		$this->db->join('shipment_order_branch_tagging sobt', 'sm.id = sobt.shipment_id');
		$this->db->join('shipment_to_address sfa', 'sm.id = sfa.shipment_id');
		
		$this->db->join('shipment_status ss', 'sm.id = ss.shipment_id');
		$this->db->join('status_master satm', 'ss.status_id = satm.id');
		
		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'sfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');
		
        $this->db->where('sm.parent_id', "0");
		$this->db->where('sm.status', "1");
		$this->db->where('sobt.to_branch_id', $branchID);
        if($from_date != ''){
            $this->db->where('sm.created_date >=',date('Y-m-d',strtotime($from_date)));
        }
        if($to_date != ''){
            $this->db->where('sm.created_date <=',date('Y-m-d',strtotime($to_date)));
        }
		$this->db->group_by('sm.id'); 
        $this->db->order_by("sm.id", "DESC");
        $query  =   $this->db->get();
        //echo $query = $this->db->last_query();die();
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
	
	public function getOrderStatus($shipment_no){
        $this->db->select('*,t2.`created_date` AS status_date,t1.`created_date` AS order_date');
        $this->db->from('shipment_master t1');
        $this->db->join('shipment_status t2','t1.id = t2.shipment_id' , 'left');
        $this->db->where('t1.shipment_no', $shipment_no);        
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	public function getCustomOrderStatus($shipment_id, $status_id, $status_type){
        $this->db->select('scs.*');
        $this->db->from('shipment_custom_status scs');
        //$this->db->join('shipment_status t2','t1.id = t2.shipment_id' , 'left');
        $this->db->where('scs.shipment_id', $shipment_id);
		$this->db->where('scs.status_id', $status_id);
		$this->db->where('scs.status_type', $status_type);        
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
	
	public function orderDetails($id)
    {
        $this->db->select('`shipment_master` .*, max(shipment_status.status_id) AS shipment_status_id');
        $this->db->from('shipment_master');
        $this->db->join('shipment_status','shipment_master.id = shipment_status.shipment_id' , 'left');
        $this->db->where('shipment_master.id', $id);
        $this->db->where('shipment_master.status', '1');
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->row_array();
        } else {
            return false;
        }
    }
	
	public function getOrderStatusDetails($id)
    {
        $this->db->select('ss.*, satm.status_name');
        $this->db->from('shipment_status ss');
		$this->db->join('status_master satm', 'ss.status_id = satm.id');
        if ($id != '') {
            $this->db->where('ss.shipment_id', $id);
        }
        $this->db->order_by('ss.id', 'DESC');
		$this->db->limit(1, 0);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	public function orderFromDetails($id)
    {
		$this->db->select('sfa.*, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
        $this->db->from('shipment_from_address sfa');
        $this->db->where('sfa.shipment_id',  $id);
		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master sm', 'sfa.state = sm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');
		
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	public function orderToDetails($id)
    {
		$this->db->select('sta.*, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
        $this->db->from('shipment_to_address sta');
        $this->db->where('sta.shipment_id',  $id);
		$this->db->join('countries_master cm', 'sta.country = cm.id', 'left');
		$this->db->join('states_master sm', 'sta.state = sm.id', 'left');
		$this->db->join('cities_master ctm', 'sta.city = ctm.id', 'left');

        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	public function orderItemDetails($id)
    {
        $this->db->select('`view_shipment_item_details`.*, `document_package_categories`.`category_name` AS subcategory_name, `shipment_charges`.road,  `shipment_charges`.rail,  `shipment_charges`.air,  `shipment_charges`.ship');
        $this->db->join('`shipment_charges`', '`view_shipment_item_details`.`id` = `shipment_charges`.`shipment_item_details_id`', 'LEFT');
		$this->db->join('`document_package_categories`', '`view_shipment_item_details`.`subcategory_id` = `document_package_categories`.`cat_id`', 'LEFT');
        $this->db->where('`view_shipment_item_details`.`shipment_id`', $id);
        //$this->db->where('is_deleted', '0');
		$this->db->group_by('`view_shipment_item_details`.id');
        $query_tb = $this->db->get('`view_shipment_item_details`');
        // echo $this->db->last_query();die;
        if ($query_tb) {
            return $query_tb->result_array();
        } else {
            return false;
        }
    }

    public function orderItemTotal($order_id){
        $this->db->select('SUM(line_total) AS line_total_all');
        $this->db->from('view_shipment_item_details');
        $this->db->where('shipment_id', $order_id);
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }   
    }
	
	public function getShipmentDetails($param = null, $many = FALSE)
    {
        $this->db->select('*');
        $this->db->where('status', '1');
        if ($param != null) {
            $this->db->where($param);
        }
        // $this->db->order_by('id', 'DESC');
        $query = $this->db->get('shipment_master');
        //echo $this->db->last_query();die;
        if ($query) {
            if ($many == FALSE) {
                return $query->row_array();
            } else {
                return $query->result_array();
            }
        } else {
            return false;
        }
    }

    public function getPriceDetails($param = null, $many = FALSE)
    {
        $this->db->select('*');        
        if ($param != null) {
            $this->db->where($param);
        }
        // $this->db->order_by('id', 'DESC');
        $query = $this->db->get('shipment_price_details');
        //echo $this->db->last_query();die;
        if ($query) {
            if ($many == FALSE) {
                return $query->row_array();
            } else {
                return $query->result_array();
            }
        } else {
            return false;
        }
    }    

    
	public function getTax($param = null)
    {
        $this->db->select('*');
        $this->db->where('status', '1');
        if ($param != null) {
            $this->db->where($param);
        }
        // $this->db->order_by('id', 'DESC');
        $query = $this->db->get('tax');
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
  
	
	

    
	
	
	
	/********************************VIEW QUOTE ****************************************/
	
	public function quotationDetails($id)
    {
        $this->db->select('*');
        $this->db->from('quotation_master');
        if ($id != '') {
            $this->db->where('id', $id);
        }
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	public function quotationFromDetails($id)
    {
        $this->db->select('*');
        $this->db->from('quotation_from_address');
        if ($id != '') {
            $this->db->where('quotation_id', $id);
        } 

        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	public function quotationToDetails($id)
    {
        $this->db->select('*');
        $this->db->from('quotation_to_address');
        if ($id != '') {
            $this->db->where('quotation_id', $id);
        } 

        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	public function quotationItemDetails($id)
    {
        $this->db->select('*');
        $this->db->from('view_item_details');
        if ($id != '') {
            $this->db->where('quotation_id', $id);
        } 
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
	public function getOrderStatusList($order_id)
    {
        $this->db->select('ss.*,sm.status_name');
        $this->db->from('shipment_status ss');
        $this->db->where('ss.shipment_id', $order_id);
		$this->db->join('status_master sm', 'ss.status_id = sm.id');
		//$this->db->join('week_days wd', 'psa.day = wd.id');
		
		/*$this->db->select('*');
		$this->db->from('pd_shift_allocation');*/
        $query  =   $this->db->get();
		//$query = $this->db->last_query();
        //echo $query; die;
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
	
	public function getStatusList()
    {
		$this->db->select('*');
		$this->db->from('status_master');
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
	
	public function checkExistOrderStatus($shipment_id,$status_id)
    {
        $query  =   $this->db->get_where('shipment_status', array('shipment_id' => $shipment_id, 'status_id' => $status_id));
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
	
	
	public function insert_order_status($data)
    {
        $this->db->insert('shipment_status', $data);
        return $this->db->insert_id();
    }
	
	public function insert_order_custom_status($data)
    {
        $this->db->insert('shipment_custom_status', $data);
        return $this->db->insert_id();
    }
	
	public function deleteOrderStatus($id)
    {
        $this->db->delete('shipment_status', array('id' => $id));
        return $this->db->affected_rows();
    }
	
	public function deleteCustomOrderStatus($id)
    {
        $this->db->delete('shipment_custom_status', array('id' => $id));
        return $this->db->affected_rows();
    }
	
	public function upadte_pdboy_order_status($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('pd_boy_order_tagging', $data);

        /*$query = $this->db->last_query();
        echo $query;*/

        return $this->db->affected_rows();
    }
	
	public function upadte_pdboy_quote_request_status($quotation_id, $data)
    {
        $this->db->set($data);
        $this->db->where('quotation_id', $quotation_id);
        $this->db->update('pd_boy_quotation_req_tagging', $data);
        return $this->db->affected_rows();
    }
	
	public function upadte_order_status_closed($order_id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $order_id);
        $this->db->update('shipment_master', $data);
        return $this->db->affected_rows();
    }
	
	public function updateShipOrderStatus($shipment_id, $order_type, $data)
    {
        $this->db->set($data);
		if($order_type == '1'){
			$this->db->where('shipment_id', $shipment_id);
			$this->db->where('order_type', '1');
		} else {
        	$this->db->where('shipment_id', $shipment_id);
		}
        $this->db->update('pd_boy_order_tagging', $data);
        return $this->db->affected_rows();
    }
	
	public function upadte_invoice_status($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('shipment_master', $data);

        return $this->db->affected_rows();
    }
	
	public function getShipmentIDby_id($tagging_id)
    {
        $this->db->select('pbot.shipment_id');
        $this->db->from('pd_boy_order_tagging pbot');
        $this->db->where('pbot.id', $tagging_id);
		//$this->db->join('status_master sm', 'ss.status_id = sm.id');
        $query  =   $this->db->get();
		//$query = $this->db->last_query();
        //echo $query; die;
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

    public function getUsersList($id=''){
        $this->db->select('*');
        $this->db->from('users');
        if($id !=''){
            $this->db->where('user_id', $id);    
        }
        $this->db->order_by('firstname','ASC');
        $this->db->order_by('lastname','ASC');
        $query  =   $this->db->get();
        //$query = $this->db->last_query();
        //echo $query; die;
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

    public function deleteTrackingLink($shipmentId)
    {
       $this->db->delete('shipmemt_tracking_link', array('shipment_id' => $shipmentId)); 

    }
    public function addTrackingLink($data)
    {
        $this->db->insert('shipmemt_tracking_link', $data);
        return $this->db->insert_id();
    }
    public function getTrackingLink($shipmentId)
    {
        $this->db->where('shipment_id',$shipmentId);
        $this->db->from('shipmemt_tracking_link');
        $query = $this->db->get();
        if ($query->num_rows()>1) {
            return $query->result();
        }
        return false;
    }
    public function getAllTrackingLink($shipmentId)
    {
        $this->db->where('shipment_id',$shipmentId);
        $this->db->from('shipmemt_tracking_link');
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }
}