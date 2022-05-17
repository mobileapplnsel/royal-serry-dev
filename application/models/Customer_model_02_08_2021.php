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
        //$this->db->where('is_deleted', '0');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
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
}
