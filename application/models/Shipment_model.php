<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Shipment_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }

    
	public function getShipmentItems($shipmentid)
    {
        
        $this->db->select('`view_shipment_item_details`.*, `document_package_categories`.`category_name` AS subcategory_name, `shipment_charges`.road,  `shipment_charges`.rail,  `shipment_charges`.air,  `shipment_charges`.ship');
        $this->db->join('`shipment_charges`', '`view_shipment_item_details`.`id` = `shipment_charges`.`shipment_item_details_id`', 'LEFT');
        $this->db->join('`document_package_categories`', '`view_shipment_item_details`.`subcategory_id` = `document_package_categories`.`cat_id`', 'LEFT');
        $this->db->where('`view_shipment_item_details`.`shipment_id`', $shipmentid);
        $this->db->group_by('`view_shipment_item_details`.id');
        $query = $this->db->get('`view_shipment_item_details`');
        return $query->result();
    }

    public function getShipmentPriceDetails($shipmentid)
    {
        $this->db->select('*');
        $this->db->where('shipment_id', $shipmentid);
        $query = $this->db->get('shipment_price_details');
        return $query->row();
    }

    public function getShipmentStatus($shipmentid,$last=0){
        $this->db->select('*');
        $this->db->where('shipment_id',$shipmentid);   
        $query = $this->db->get('shipment_status');
        if ($last) {
           return $query->row();
        }else{
            return $query->result();
        }   
    }

    public function shipmentRates($ship_cat_id, $ship_subcat_id, $ship_sub_subcat_id, $rate_type, $location_from, $location_to, $charges_mode, $delivery_mode_id)
    {
        
        $this->db->select('ship_mode_id, rate, insurance');
        $this->db->where('ship_cat_id', $ship_cat_id);
        $this->db->where('ship_subcat_id', $ship_subcat_id);
        $this->db->where('ship_sub_subcat_id', $ship_sub_subcat_id);
        $this->db->where('rate_type', $rate_type);
        $this->db->where('location_from', $location_from);
        $this->db->where('location_to', $location_to);
        $this->db->where('ship_mode_id', $charges_mode);
        $this->db->where('delivery_mode_id', $delivery_mode_id);
        $this->db->from('rate_master');
        $query  = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query->num_rows()) {
           return $result = $query->row();
        }
        
        return false;
    }

    public function addRescheduled($data){
        $this->db->insert('shipment_rescheduled', $data);
        return $this->db->insert_id();   
    }

    public function updateShipmentMaster($data,$id){
        $this->db->where('id', $id);
        $this->db->update('shipment_master', $data);   
    }

    
	
    
}