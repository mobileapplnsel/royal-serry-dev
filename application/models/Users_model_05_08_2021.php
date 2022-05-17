<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Category_model class.
 *
 * @extends CI_Model
 */
class Users_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsersList()
    {
        $this->db->select('u.*, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
        $this->db->from('users u');
        $this->db->where('`user_type`', "NU");
		$this->db->join('countries_master cm', 'u.country = cm.id', 'left');
		$this->db->join('states_master sm', 'u.state = sm.id', 'left');
		$this->db->join('cities_master ctm', 'u.city = ctm.id', 'left');
        //$this->db->join('users_info uf', 'u.user_id = uf.user_id');
        $query = $this->db->get();
        //$query = $this->db->last_query();
        //echo $query;
        //die();
        $row = $query->num_rows();
        if ($row > 0) {
            //return true;
            $row = $query->result();
            return $row;
        } else {
            //return false;
            return $row;
        }
    }

    public function getBusinessUsersList()
    {
        $this->db->select('u.*, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
        $this->db->from('users u');
        $this->db->where('`user_type`', "BU");
		$this->db->join('countries_master cm', 'u.country = cm.id', 'left');
		$this->db->join('states_master sm', 'u.state = sm.id', 'left');
		$this->db->join('cities_master ctm', 'u.city = ctm.id', 'left');
        //$this->db->join('users_info uf', 'u.user_id = uf.user_id');
        $query = $this->db->get();
        //$query = $this->db->last_query();
        //echo $query;
        //die();
        $row = $query->num_rows();
        if ($row > 0) {
            //return true;
            $row = $query->result();
            return $row;
        } else {
            //return false;
            return $row;
        }
    }

    public function getBranchUsersList()
    {
        $this->db->select('u.*, bu.branch_id, b.name as branch_name, b.email as branch_email, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
        $this->db->from('users u');
        $this->db->where('`user_type`', "BO");
        $this->db->join('branch_users bu', 'u.user_id = bu.user_id');
        $this->db->join('branch b', 'bu.branch_id = b.branch_id');
		$this->db->join('countries_master cm', 'u.country = cm.id', 'left');
		$this->db->join('states_master sm', 'u.state = sm.id', 'left');
		$this->db->join('cities_master ctm', 'u.city = ctm.id', 'left');
        $query = $this->db->get();
        //$query = $this->db->last_query();
        //echo $query;
        //die();
        $row = $query->num_rows();
        if ($row > 0) {
            //return true;
            $row = $query->result();
            return $row;
        } else {
            //return false;
            return $row;
        }
    }

    public function getDeliveryUsersList()
    {
        $this->db->select('u.*, bu.branch_id, b.name as branch_name, b.email as branch_email, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
        $this->db->from('users u');
        $this->db->where('`user_type`', "PDB");
        $this->db->join('branch_users bu', 'u.user_id = bu.user_id');
        $this->db->join('branch b', 'bu.branch_id = b.branch_id');
		$this->db->join('countries_master cm', 'u.country = cm.id', 'left');
		$this->db->join('states_master sm', 'u.state = sm.id', 'left');
		$this->db->join('cities_master ctm', 'u.city = ctm.id', 'left');
        $query = $this->db->get();
        //$query = $this->db->last_query();
        //echo $query;
        //die();
        $row = $query->num_rows();
        if ($row > 0) {
            //return true;
            $row = $query->result();
            return $row;
        } else {
            //return false;
            return $row;
        }
    }

    public function editBranchUser($id)
    {
        //$query  =   $this->db->get_where('branch', array('branch_id' => $id));
        $this->db->select('u.*, bu.branch_id');
        $this->db->from('users u');
        $this->db->where('u.user_id', $id);
        $this->db->join('branch_users bu', 'u.user_id = bu.user_id');
        //$this->db->join('branch b', 'bu.branch_id = b.branch_id');
        $query = $this->db->get();

        $row = $query->num_rows();
        if ($row > 0) {
            //return true;
            //$row['id']  =   $id;
            $row = $query->result();
            return $row;
        } else {
            //return false;
            return $row;
        }
    }

    public function editUser($id)
    {
        //$query  =   $this->db->get_where('branch', array('branch_id' => $id));
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->where('u.user_id', $id);
        //$this->db->join('branch_users bu', 'u.user_id = bu.user_id');
        //$this->db->join('branch b', 'bu.branch_id = b.branch_id');
        $query = $this->db->get();

        $row = $query->num_rows();
        if ($row > 0) {
            //return true;
            //$row['id']  =   $id;
            $row = $query->result();
            return $row;
        } else {
            //return false;
            return $row;
        }
    }

    public function getBranchList()
    {
        $this->db->select('*');
        $this->db->from('branch');
        $this->db->where('`is_main_office`', '0');
        $query = $this->db->get();
        //$query = $this->db->last_query();
        //echo $query;
        //die();
        $row = $query->num_rows();
        if ($row > 0) {
            //return true;
            $row = $query->result();
            return $row;
        } else {
            //return false;
            return $row;
        }
    }

    public function checkExistUser($email)
    {
        $query = $this->db->get_where('users', array('email' => $email));
        $row   = $query->num_rows();
        if ($row > 0) {
            //return true;
            // $row = $query->result();
            return $row;
        } else {
            //return false;
            return $row;
        }
    }
	
	public function checkExistUserTelephone($telephone)
    {
        $query = $this->db->get_where('users', array('telephone' => $telephone));
        $row   = $query->num_rows();
        if ($row > 0) {
            //return true;
            // $row = $query->result();
            return $row;
        } else {
            //return false;
            return $row;
        }
    }
	
	public function CheckusersAreaExist($area)
    {
        $query = $this->db->get_where('pickup_delivery_boy_area', array('area_id' => $area));
        $row   = $query->num_rows();
        if ($row > 0) {
            //return true;
            // $row = $query->result();
            return $row;
        } else {
            //return false;
            return $row;
        }
    }

    public function addNewuser($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function adduserToBranch($data)
    {
        $this->db->insert('branch_users', $data);
        return $this->db->insert_id();
    }

    public function deleteuserFromBranch($id)
    {
        $this->db->delete('branch_users', array('user_id' => $id));
        return $this->db->affected_rows();
    }

    /*public function insertcategory($data)
    {
    $this->db->insert('categories', $data);
    return $this->db->insert_id();
    }*/

    public function editCategory($id)
    {
        $query = $this->db->get_where('categories', array('cat_id' => $id));
        $row   = $query->num_rows();
        if ($row > 0) {
            $row = $query->result();
            return $row;
        } else {
            return $row;
        }
    }

    public function getReplacedSingleImgName($id)
    {
        $this->db->select('`category_image`');
        $this->db->from('categories');
        $this->db->where('`cat_id`', $id);
        $query = $this->db->get();

        $row = $query->num_rows();
        if ($row > 0) {
            $row = $query->result();
            $row = $row[0]->category_image;
            return $row;
        } else {
            return $row;
        }
    }

    public function updateCategory($id, $data)
    {
        $this->db->set($data);
        $this->db->where('cat_id', $id);
        $this->db->update('categories', $data);

        /*$query = $this->db->last_query();
        echo $query;*/

        return $this->db->affected_rows();
    }

    public function is_parent_category($id)
    {
        $query = $this->db->get_where('categories', array('parent_cat_id' => $id));
        $row   = $query->num_rows();
        if ($row > 0) {
            $row = $query->result();
            return $row;
        } else {
            return $row;
        }
    }

    public function deleteCategory($id)
    {
        $this->db->delete('categories', array('cat_id' => $id));
        return $this->db->affected_rows();
    }

    public function change_status($id, $status)
    {

        $data = array(
            'status' => $status,
        );

        $this->db->where('user_id', $id);
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }

    }

    public function AddMember($data)
    {

        $res = $this->db->insert('users', $data);

        if ($res == 1) {
            return $this->db->insert_id();
        } else {
            return false;
        }

    }

    public function updateUser($id, $data)
    {
        $this->db->set($data);
        $this->db->where('user_id', $id);
        $this->db->update('users', $data);

        /*$query = $this->db->last_query();
        echo $query;*/

        return $this->db->affected_rows();
    }

    public function deleteUser($id)
    {
        $this->db->delete('users', array('user_id' => $id));
        return $this->db->affected_rows();
    }

    public function UserdeleteFromBranch($id)
    {
        $this->db->delete('branch_users', array('user_id' => $id));
        return $this->db->affected_rows();
    }

    public function IfExistEmail($email)
    {

        $this->db->select('user_id, email');
        $this->db->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query->num_rows() != 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function citiesSelect($stateId)
    {
        $data = array();
        $this->db->select('*');
        $this->db->where('state_id', $stateId);
        $this->db->from('cities_master');
        $query  = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function statesSelect($countryId)
    {
        $data = array();
        $this->db->select('*');
        if ($countryId != '') {
            $this->db->where('country_id', $countryId);
        }
        $this->db->from('states_master');
        $query  = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function documentItemSelect($category_id)
    {
        $data = array();
        $this->db->select('*');
        if ($category_id != '') {
            $this->db->where('category_id', $category_id);
        }
        $this->db->where('status','1');
        $this->db->from('document');
        $query  = $this->db->get();
        $result = $query->result_array();
        //echo $query = $this->db->last_query();die();
        return $result;
    }

    public function packageItemSelect($category_id)
    {
        $data = array();
        $this->db->select('*');
        if ($category_id != '') {
            $this->db->where('category_id', $category_id);
        }
        $this->db->where('status','1');
        $this->db->from('package');
        $query  = $this->db->get();
        $result = $query->result_array();
        //echo $query = $this->db->last_query();die();
        return $result;
    }

    public function shipmentRate($ship_cat_id,$ship_subcat_id,$rate_type,$location_from,$location_to)
    {
        $data = array();
        $this->db->select('ship_mode_id,rate');   
        $this->db->where('ship_cat_id', $ship_cat_id);
        $this->db->where('ship_subcat_id', $ship_subcat_id);
        $this->db->where('rate_type', $rate_type);
        $this->db->where('location_from', $location_from);
        $this->db->where('location_to', $location_to);
        $this->db->from('rate_master');
        $query  = $this->db->get();
        $result = $query->result_array();
        //echo $query = $this->db->last_query();die();
        return $result;
    }


	/********************************************get User Area List Module********************************************/
    
    public function getUserAreaList($id)
    {
        //$query = $this->db->get('tourisms', ['tourCategory' => '1']);
        $this->db->select('pda.id as pd_boy_areaID, pc.*, u.firstname, u.lastname');
        $this->db->from('pickup_delivery_boy_area pda');
        $this->db->where('pda.user_id', $id);
		$this->db->join('postal_codes_data_master pc', 'pda.area_id = pc.id');
		$this->db->join('users u', 'pda.user_id = u.user_id');
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
	
	public function insert_users_area($data)
    {
        $this->db->insert('pickup_delivery_boy_area', $data);
        return $this->db->insert_id();
    }
	
	public function deleteUserArea($id)
    {
        $this->db->delete('pickup_delivery_boy_area', array('id' => $id));
		//$query = $this->db->last_query();
       // echo $query; die;
        return $this->db->affected_rows();
    }
	
	/********************************************get User SHift List Module********************************************/
    
    public function getUserShiftList($id)
    {
        $this->db->select('psa.*, sm.shift_name, sm.shift_type, sm.time_from, sm.time_to, wd.day');
        $this->db->from('pd_shift_allocation psa');
        $this->db->where('psa.pd_id', $id);
		$this->db->join('shift_master sm', 'psa.shift_id = sm.id');
		$this->db->join('week_days wd', 'psa.day = wd.id');
		
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
	
	public function getShiftList()
    {
		$this->db->select('*');
		$this->db->from('shift_master');
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
	
	public function getDaysList()
    {
		$this->db->select('*');
		$this->db->from('week_days');
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
	
	public function insert_users_shift($data)
    {
        $this->db->insert('pd_shift_allocation', $data);
        return $this->db->insert_id();
    }
	
	
	public function checkExistShift($shift_id,$pd_id,$day)
    {
        $query  =   $this->db->get_where('pd_shift_allocation', array('shift_id' => $shift_id, 'pd_id' => $pd_id, 'day' => $day));
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
	
	public function deleteShiftallocation($id)
    {
        $this->db->delete('pd_shift_allocation', array('id' => $id));
        return $this->db->affected_rows();
    }
	
	
	public function getuserCreditList($id)
    {
		$this->db->select('user_id, credit_outstanding_amount, credit_limit');
		$this->db->from('users');
		$this->db->where('user_id', $id);
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
	
	public function insert_users_credit($data, $user_id)
    {
        $this->db->set($data);
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);

        /*$query = $this->db->last_query();
        echo $query;*/

        return $this->db->affected_rows();
    }
	
	public function deleteCreditAmount($data, $user_id)
    {
        $this->db->set($data);
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);

        /*$query = $this->db->last_query();
        echo $query;*/

        return $this->db->affected_rows();
    }


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

}
