<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Category_model class.
 *
 * @extends CI_Model
 */
class User_model extends CI_Model
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
	
	public function getBranchUsersListbyBranch($branch_id)
    {
        $this->db->select('u.*, bu.branch_id, b.name as branch_name, b.email as branch_email, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
        $this->db->from('users u');
        $this->db->where('`user_type`', "BO");
        $this->db->join('branch_users bu', 'u.user_id = bu.user_id');
        $this->db->join('branch b', 'bu.branch_id = b.branch_id');
		$this->db->join('countries_master cm', 'u.country = cm.id', 'left');
		$this->db->join('states_master sm', 'u.state = sm.id', 'left');
		$this->db->join('cities_master ctm', 'u.city = ctm.id', 'left');
		$this->db->where('bu.branch_id', $branch_id);
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

    public function getDeliveryUsersList($branch_id)
    {
        $this->db->select('u.*, bu.branch_id, b.name as branch_name, b.email as branch_email, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
        $this->db->from('users u');
        $this->db->where('`user_type`', "PDB");
        $this->db->join('branch_users bu', 'u.user_id = bu.user_id');
        $this->db->join('branch b', 'bu.branch_id = b.branch_id');
		$this->db->join('countries_master cm', 'u.country = cm.id', 'left');
		$this->db->join('states_master sm', 'u.state = sm.id', 'left');
		$this->db->join('cities_master ctm', 'u.city = ctm.id', 'left');
		if($branch_id != ''){
            $this->db->where('bu.branch_id', $branch_id);
        }
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
	
	public function getDeliveryUsersListbyBranch($branch_id)
    {
        $this->db->select('u.*, bu.branch_id, b.name as branch_name, b.email as branch_email, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
        $this->db->from('users u');
        $this->db->where('`user_type`', "PDB");
        $this->db->join('branch_users bu', 'u.user_id = bu.user_id');
        $this->db->join('branch b', 'bu.branch_id = b.branch_id');
		$this->db->join('countries_master cm', 'u.country = cm.id', 'left');
		$this->db->join('states_master sm', 'u.state = sm.id', 'left');
		$this->db->join('cities_master ctm', 'u.city = ctm.id', 'left');
		$this->db->where('bu.branch_id', $branch_id);
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
	
	public function getUserDutyDetails($id)
    {
        $this->db->select('pda.*');
        $this->db->from('pd_duty_allocation pda');
        $this->db->where('pda.id', $id);
        $query = $this->db->get();

        $row = $query->num_rows();
        if ($row > 0) {
            $row = $query->result();
            return $row;
        } else {
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
	
	public function getBranchListbyBranchID($branch_id)
    {
        $this->db->select('*');
        $this->db->from('branch');
        //$this->db->where('`is_main_office`', '0');
		$this->db->where('`branch_id`', $branch_id);
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
	
	public function CheckusersAreaExist($area,$user_id)
    {
        $query = $this->db->get_where('pickup_delivery_boy_area', array('area_id' => $area, 'user_id' => $user_id));
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
	
	public function updateDuty($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('pd_duty_allocation', $data);
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
	
	public function insert_users_checkpoint($data)
    {
        $this->db->insert('users_paylater_checkpoint', $data);
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
	
	public function getUserDutyList($id)
    {
        $this->db->select('psa.*, sm.shift_name, sm.shift_type, sm.time_from, sm.time_to');
        $this->db->from('pd_duty_allocation psa');
        $this->db->where('psa.pd_id', $id);
		$this->db->join('shift_master sm', 'psa.shift_id = sm.id');
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
	
	public function getShiftListbyUserId($id)
    {
		$this->db->select('sm.*');
		$this->db->from('shift_master sm');
		$this->db->join('branch_shift_allocation bsa', 'sm.id = bsa.shift_id');
		$this->db->join('branch_users bu', 'bsa.branch_id = bu.branch_id');
		$this->db->where('bu.user_id', $id);
		$this->db->group_by('sm.id'); 
		$this->db->order_by('sm.id', 'asc');
        $query  =   $this->db->get();
		//$query = $this->db->last_query();
        //echo $query; die;
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
	
	public function getCheckPointList()
    {
		$this->db->select('*');
		$this->db->from('credit_check_point_master');
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
	
	public function getDaysListByshiftID($shift_id, $user_id)
    {
		$this->db->select('wd.*');
		$this->db->from('week_days wd');
		$this->db->join('branch_shift_allocation bsa', 'wd.id = bsa.day');
		$this->db->join('branch_users bu', 'bsa.branch_id = bu.branch_id');
		$this->db->where('bu.user_id', $user_id);
		$this->db->where('bsa.shift_id', $shift_id);
		//$this->db->order_by('wd.id', 'asc');
        $query  =   $this->db->get();
		
		//$query = $this->db->last_query();
        //echo $query; die;
        $row = $query->num_rows();
        if ($row > 0)
        {
            /*$row = $query->result();
            return $row;*/    
			
			$output = '<option value="">Select Day</option>';
			foreach($query->result() as $row)
			{
			   $output .= '<option value="'.$row->id.'">'.$row->day.'</option>';
			}
			return $output;        
        }
        else
        {
            return $row;
        }
    }
	
	
	public function validatepostcode_by_tozip($postal_code)
    {
		$this->db->select('ba.*');
		$this->db->from('branch_area ba');
		$this->db->join('postal_codes_data_master pcdm', 'ba.area_id = pcdm.id');
		//$this->db->join('branch_users bu', 'bsa.branch_id = bu.branch_id');
		$this->db->where('pcdm.postal_code', $postal_code);
		//$this->db->where('bsa.shift_id', $shift_id);
		//$this->db->order_by('wd.id', 'asc');
        $query  =   $this->db->get();
		
		//$query = $this->db->last_query();
        //echo $query; die;
        $row = $query->num_rows();
        if ($row > 0)
        {
            /*$row = $query->result();*/
            return $row;    
        }
        else
        {
            return $row;
        }
    }
	
	public function UserAreaselectQueryAjax($q, $table_name = '', $field = '', $user_id)
    {
        /*$this->db->select('id,' . $field . ' as text');
        $this->db->like($field, $q);
        $query = $this->db->get($table_name);*/
		
		$this->db->select('pcdm.id, pcdm.'.$field.' as text');
		$this->db->from($table_name.' pcdm');
		$this->db->join('branch_area ba', 'pcdm.id = ba.area_id');
		$this->db->join('branch_users bu', 'ba.branch_id = bu.branch_id');
		$this->db->where('bu.user_id', $user_id);
		$query  =   $this->db->get();
        //echo $this->db->last_query(); die;
        return $query->result();
    }
	
	public function insert_users_shift($data)
    {
        $this->db->insert('pd_shift_allocation', $data);
        return $this->db->insert_id();
    }
	
	public function insert_users_duty($data)
    {
        $this->db->insert('pd_duty_allocation', $data);
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
	
	public function checkExistDuty($shift_id,$pd_id)
    {
        $query  =   $this->db->get_where('pd_duty_allocation', array('shift_id' => $shift_id, 'pd_id' => $pd_id));
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
	
	public function deleteDutyallocation($id)
    {
        $this->db->delete('pd_duty_allocation', array('id' => $id));
        return $this->db->affected_rows();
    }
	
	public function deletecheckpoint($user_id)
    {
        $this->db->delete('users_paylater_checkpoint', array('user_id' => $user_id));
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
	
	public function getuserPayLater($id)
    {
		$this->db->select('user_id, pay_later, user_type');
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
	
	public function getUserCheckPointList($id)
    {
		$this->db->select('upc.*, ccpm.name as checkpoint_name');
		$this->db->from('users_paylater_checkpoint upc');
		$this->db->join('credit_check_point_master ccpm', 'upc.checkpoint_id = ccpm.id');
		$this->db->where('upc.user_id', $id);
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
	
	public function getuserPickupOrderList($user_id,$from_date='',$to_date = '', $todayDate)
    {
		$this->db->select('pbot.*, sm.shipment_no,`sm`.`created_date` AS shipment_date, sfa.firstname as from_firstname, sfa.lastname as from_lastname, sfa.address as from_address, sfa.address2 from_address2, sfa.telephone from_telephone, cm.name as country_name, stm.name as state_name, ctm.name as city_name, sfa.zip from_zip');
		$this->db->from('pd_boy_order_tagging pbot');
		$this->db->join('shipment_master sm', 'pbot.shipment_id = sm.id');
		$this->db->join('shipment_from_address sfa', 'pbot.shipment_id = sfa.shipment_id');
		
		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'sfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');
		
		$this->db->where('pbot.user_id', $user_id);
		$this->db->where('pbot.order_type', '1');
        
        if($from_date != ''){
            $this->db->where('sm.created_date >=',date('Y-m-d',strtotime($from_date)));
        }

        if($to_date != ''){
            $this->db->where('sm.created_date <=',date('Y-m-d',strtotime($to_date)));
        }
		$this->db->where('pbot.status', '0');
		$this->db->where('sm.created_date <=',$todayDate);
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
	
	public function getuserPickupOrderHistoryList($user_id,$from_date='',$to_date = '')
    {
		$this->db->select('pbot.*, sm.shipment_no,`sm`.`created_date` AS shipment_date, sfa.firstname as from_firstname, sfa.lastname as from_lastname, sfa.address as from_address, sfa.address2 from_address2, sfa.telephone from_telephone, cm.name as country_name, stm.name as state_name, ctm.name as city_name, sfa.zip from_zip');
		$this->db->from('pd_boy_order_tagging pbot');
		$this->db->join('shipment_master sm', 'pbot.shipment_id = sm.id');
		$this->db->join('shipment_from_address sfa', 'pbot.shipment_id = sfa.shipment_id');
		
		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'sfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');
		
		$this->db->where('pbot.user_id', $user_id);
		$this->db->where('pbot.order_type', '1');
        
        if($from_date != ''){
            $this->db->where('sm.created_date >=',date('Y-m-d',strtotime($from_date)));
        }

        if($to_date != ''){
            $this->db->where('sm.created_date <=',date('Y-m-d',strtotime($to_date)));
        }
		$this->db->where('pbot.status', '1');
		//$this->db->where('sm.created_date <',date('Y-m-d'));
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
	
	public function getuserDeliveryOrderList($user_id,$from_date='',$to_date = '', $todayDate)
    {
		$this->db->select('pbot.*, sm.shipment_no, sm.payment_mode, sm.customer_id, `sm`.`created_date` AS shipment_date, sfa.firstname as from_firstname, sfa.lastname as from_lastname, sfa.address as from_address, sfa.address2 from_address2, sfa.telephone from_telephone, cm.name as country_name, stm.name as state_name, ctm.name as city_name, sfa.zip from_zip, u.firstname, u.email, u.telephone');
		$this->db->from('pd_boy_order_tagging pbot');
		$this->db->join('shipment_master sm', 'pbot.shipment_id = sm.id');
		$this->db->join('shipment_to_address sfa', 'pbot.shipment_id = sfa.shipment_id');
		$this->db->join('users u', 'sm.customer_id = u.user_id');
		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'sfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');		
		$this->db->where('pbot.user_id', $user_id);
		$this->db->where('pbot.order_type', '2');

        if($from_date != ''){
            $this->db->where('sm.created_date >=',date('Y-m-d',strtotime($from_date)));
        }

        if($to_date != ''){
            $this->db->where('sm.created_date <=',date('Y-m-d',strtotime($to_date)));
        }

		$this->db->where('pbot.status', '0');
		$this->db->where('pbot.created_date <',$todayDate);
		$this->db->group_by('pbot.shipment_id'); 
        $query  =   $this->db->get();
        $row = $query->num_rows();
        if ($row > 0)
        {
            $row = $query->result();
            //echo $query = $this->db->last_query();
            return $row;            
        }
        else
        {
            return $row;
        }
    }
	
	public function getuserDeliveryOrderHistoryList($user_id,$from_date='',$to_date = '')
    {
		$this->db->select('pbot.*, sm.shipment_no,`sm`.`created_date` AS shipment_date, sfa.firstname as from_firstname, sfa.lastname as from_lastname, sfa.address as from_address, sfa.address2 from_address2, sfa.telephone from_telephone, cm.name as country_name, stm.name as state_name, ctm.name as city_name, sfa.zip from_zip');
		$this->db->from('pd_boy_order_tagging pbot');
		$this->db->join('shipment_master sm', 'pbot.shipment_id = sm.id');
		$this->db->join('shipment_to_address sfa', 'pbot.shipment_id = sfa.shipment_id');
		
		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'sfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');		
		$this->db->where('pbot.user_id', $user_id);
		$this->db->where('pbot.order_type', '2');

        if($from_date != ''){
            $this->db->where('sm.created_date >=',date('Y-m-d',strtotime($from_date)));
        }

        if($to_date != ''){
            $this->db->where('sm.created_date <=',date('Y-m-d',strtotime($to_date)));
        }

		$this->db->where('pbot.status', '1');
		//$this->db->where('pbot.created_date <',date('Y-m-d'));
        $query  =   $this->db->get();
        $row = $query->num_rows();
        if ($row > 0)
        {
            $row = $query->result();
            //echo $query = $this->db->last_query();
            return $row;            
        }
        else
        {
            return $row;
        }
    }

    public function getUploadedImages($shipment_id,$type){
        $this->db->select('*');
        $this->db->from('pick_delivery_images');
        $this->db->where('shipment_id', $shipment_id);
        $this->db->where('type', $type);
        $query  =   $this->db->get();
        //echo $this->db->last_query();die;
        $row = $query->result();
        return $row;    
    }
	
	public function checkExistPickupOrder($shipment_id,$order_type)
    {
        $query  =   $this->db->get_where('pd_boy_order_tagging', array('shipment_id' => $shipment_id, 'order_type' => $order_type));
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
	
	public function insert_pickup_order($data)
    {
        $this->db->insert('pd_boy_order_tagging', $data);
        return $this->db->insert_id();
    }
	
	public function deleteUserPickupOrder($id)
    {
        $this->db->delete('pd_boy_order_tagging', array('id' => $id));
        return $this->db->affected_rows();
    }
	
	public function insert_delivery_order($data)
    {
        $this->db->insert('pd_boy_order_tagging', $data);
        return $this->db->insert_id();
    }

}
