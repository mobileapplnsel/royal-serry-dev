<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Login_model extends CI_Model
{
    public function __construct()
    {		
		parent::__construct();
	}
    
    public function registerUser($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
	}
    
    public function login($data){
        $this->db->select('t1.*,t2.id AS userType,t2.accounttype');
        $this->db->from('users t1');
        $this->db->join('accounttype t2','t1.user_type = t2.user_type','left');
        $this->db->where($data);
		$where = "(t1.user_type='MO' OR t1.user_type='BO' OR t1.user_type='PDB')";
		$this->db->where($where);
        $query  =   $this->db->get();
        //echo $this->db->last_query(); die;
        //echo '===>>>>>>'.$row = $query->num_rows();die();
        if($query->num_rows()>0) {
            $row = $query->result();
            return $row;            
        }
        else
        {
            return false;
        }
    }
	
	public function get_login_user_branch_id($data){
        $this->db->select('*');
        $this->db->from('branch_users');
        $this->db->where(array('user_id' => $data));
        $query  =   $this->db->get();
        //echo $this->db->last_query(); die();
        //echo '===>>>>>>'.$row = $query->num_rows();
        if($query->num_rows()>0) {
            $row = $query->result();
            return $row;            
        }
        else
        {
            return false;
        }
    }
}