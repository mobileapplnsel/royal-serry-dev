<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Invoices_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************View Order********************************************/
 

    public function getList($from_date ='', $to_date='')
    {
		$this->db->select('*');
        $this->db->from('invoices');
        if($from_date != ''){
            $this->db->where('created_at >=',date('Y-m-d',strtotime($from_date)));
        }
        if($to_date != ''){
            $this->db->where('created_at <=',date('Y-m-d',strtotime($to_date)));
        }
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        $row = $query->result();
        
    }

    public function lastInvoice()
    {
        $this->db->select('*');
        $this->db->from('invoices');
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        $row = $query->row();
        return $row;
        
    }
	
	public function checkExist($orderId,$orderType)
    {
        $query  =   $this->db->get_where('invoices', array('order_id' => $orderId, 'order_type' => $orderType));
        $rows =  $query->num_rows();
        if ($rows) {
            return true;
        }
        return false;
    }

	public function create($data)
    {
        $this->db->insert('invoices', $data);
        return $this->db->insert_id();
    }
	
	
	public function delete($id)
    {
        $this->db->delete('invoices', array('id' => $id));
        return $this->db->affected_rows();
    }
	
	public function upadte($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('invoices', $data);
        return $this->db->affected_rows();
    }
}