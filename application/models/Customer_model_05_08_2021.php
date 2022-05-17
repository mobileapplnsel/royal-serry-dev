<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Admin_model class.
 *
 * @extends CI_Model
 */
class Customer_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getQuotationByUser($id)
    {
        $this->db->select('*');
        $this->db->from('quotation_master');
        $this->db->where('customer_id', $id);
        $this->db->where('quote_type', 0);
        $this->db->order_by('id','DESC');
        $this->db->group_by('quote_no ');
        //$this->db->where('is_deleted', '0');
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getOrderByUser($id, $many = TRUE)
    {
        //snigdho
        $this->db->select('*');
        $this->db->from('quotation_master');
        $this->db->where('customer_id', $id);
        $this->db->where('quote_type', 1);
        $this->db->order_by('id','DESC');
        //$this->db->where('is_deleted', '0');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query) {
            if($many == TRUE){
                return $query->result_array();
            }else{
                return $query->row_array();
            }
            
        } else {
            return false;
        }
    }

    public function saveOrder($shipment_no = null, $quote_id = null, $payment_mode = 1, $payment_status = 1){
        if($quote_id != null && $shipment_no != null){
            //shipment master
            $sql_sm = 'INSERT INTO `shipment_master` (`shipment_no`, `quotation_id`, `parent_id`, `customer_id`, `shipment_type`, `location_type`, `transport_type`, `road`, `rail`, `air`, `ship`, `status`, `platform`, `created_by`, `created_date`, `payment_mode`, `payment_status`) SELECT  "'.$shipment_no.'", `id`, `parent_id`, `customer_id`, `shipment_type`, `location_type`, `transport_type`, `road`, `rail`, `air`, `ship`, `status`, `platform`, `created_by`, `created_date`, '.$payment_mode.', '.$payment_status.' FROM `quotation_master` WHERE id ='.$quote_id;

            $query_sm = $this->db->query($sql_sm);
            $shipment_id = $this->db->insert_id();

            // from address
            $sql_from_add = 'INSERT INTO `shipment_from_address` (`shipment_id`, `quotation_id`, `customer_id`, `firstname`, `lastname`, `address`, `address2`, `company_name`, `country`, `state`, `city`, `zip`, `email`, `telephone`, `address_type`) SELECT '.$shipment_id.',  `quotation_id`, `customer_id`, `firstname`, `lastname`, `address`, `address2`, `company_name`, `country`, `state`, `city`, `zip`, `email`, `telephone`, `address_type` FROM `quotation_from_address` WHERE quotation_id ='.$quote_id;

            $query_from_add = $this->db->query($sql_from_add);
            $from_addr_insert_id = $this->db->insert_id();

            //to address
            $sql_to_add = 'INSERT INTO shipment_to_address (`shipment_id`, `quotation_id`, `customer_id`, `firstname`, `lastname`, `address`, `address2`, `company_name`, `country`, `state`, `city`, `zip`, `email`, `telephone`, `address_type`) SELECT '.$shipment_id.',  `quotation_id`, `customer_id`, `firstname`, `lastname`, `address`, `address2`, `company_name`, `country`, `state`, `city`, `zip`, `email`, `telephone`, `address_type` FROM `quotation_to_address` WHERE quotation_id ='.$quote_id;

            $query_to_add = $this->db->query($sql_to_add);
            $to_addr_insert_id = $this->db->insert_id();

            //to address
            $sql_item = 'INSERT INTO `shipment_item_details` (`shipment_id`, `quotation_id`, `category_id`, `item_id`, `desc`, `value_shipment`, `quantity`, `rate`, `insur`, `line_total`, `other_details_parcel`) SELECT '.$shipment_id.',  `quotation_id`, `category_id`, `item_id`, `desc`, `value_shipment`, `quantity`, `rate`, `insur`, `line_total`, `other_details_parcel` FROM `quotation_item_details` WHERE quotation_id ='.$quote_id;

            $query_item = $this->db->query($sql_item);
            $item_insert_id = $this->db->insert_id();

            if($shipment_id && $from_addr_insert_id && $to_addr_insert_id && $item_insert_id){
                $upData= array(
                    'order_created' => 1
                );
                
                $this->db->where('id',$quote_id);
                $this->db->update('quotation_master',$upData);
                //return $this->db->affected_rows();
                return true;
            }else{
                return false;
            }

        }
        
    }

    public function getShipmentByUser($id)
    {
        $this->db->select('*');
        $this->db->from('shipment_master');
        $this->db->where('customer_id', $id);
        $this->db->order_by('id','DESC');
        //$this->db->where('is_deleted', '0');
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}
