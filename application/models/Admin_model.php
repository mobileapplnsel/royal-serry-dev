<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Admin_model extends CI_Model
{
    public function __construct()
    {		
		parent::__construct();
	}
    
    /********************************************Packages Module********************************************/
    
    public function getAllPackages()
    {
        $query = $this->db->get('packageinfo');
        
        //$query  =   $this->db->get();
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
	
	public function CheckEmailIDExist($id, $email)
    {
		
		$array = array('email' => $email);
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($array);
		$this->db->where_not_in('user_id', $id);
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
	
	public function totalQuotationCount()
    {
		$this->db->select('*');
		$this->db->from('quotation_master');
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
	
	public function totalOrderCount()
    {
		$this->db->select('*');
		$this->db->from('shipment_master');
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
	
	public function totalUsersCount()
    {
		$this->db->select('*');
		$this->db->from('users');
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
	
	public function totalBranchUsersCount($branch_id)
    {
		$this->db->select('*');
		$this->db->from('branch_users');
		$this->db->where('branch_id', $branch_id);
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
	
	public function totalBranchPickedUpOrders($branch_id)
    {
		$this->db->select('sm.*');
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
		$this->db->where('sobt.from_branch_id', $branch_id);
		$this->db->group_by('sm.id');
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
	
	public function totalBranchDeliverdOrders($branch_id)
    {
		$this->db->select('sm.*');
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
		$this->db->where('sobt.to_branch_id', $branch_id);
		$this->db->group_by('sm.id'); 
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
	
	public function totalTotalPickedUpOrders($user_id)
    {
		$this->db->select('*');
		$this->db->from('pd_boy_order_tagging');
		$this->db->where('order_type', "1");
		$this->db->where('status', "1");
		$this->db->where('user_id', $user_id);
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
	
	public function CurrentTotalPickedUpOrders($user_id)
    {
		$this->db->select('*');
		$this->db->from('pd_boy_order_tagging');
		$this->db->where('order_type', "1");
		$this->db->where('status', "0");
		$this->db->where('user_id', $user_id);
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
	
	public function totalTotalDeliverdOrders($user_id)
    {
		$this->db->select('*');
		$this->db->from('pd_boy_order_tagging');
		$this->db->where('order_type', "2");
		$this->db->where('status', "1");
		$this->db->where('user_id', $user_id);
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
	
	public function CurrentTotalDeliverdOrders($user_id)
    {
		$this->db->select('*');
		$this->db->from('pd_boy_order_tagging');
		$this->db->where('order_type', "2");
		$this->db->where('status', "0");
		$this->db->where('user_id', $user_id);
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
	
	public function getrecentOrderList()
    {
        //$query = $this->db->get('branch');
        //$query  =   $this->db->get_where('document', array('is_deleted' => '0'));
		$this->db->select('sm.*, u.firstname, u.lastname, spd.grand_total');
        $this->db->from('shipment_master sm');
		$this->db->join('users u', 'sm.customer_id = u.user_id');
		$this->db->join('shipment_price_details spd', 'sm.id = spd.shipment_id');

		//$this->db->where('sm.quote_type', "0");
        $this->db->order_by("sm.id", "DESC");
		$this->db->group_by('sm.id'); 
		$this->db->limit(7, 0);
        $query  =   $this->db->get();
        //$query = $this->db->last_query();
        //echo $query;
        //die();
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
	
	public function getrecentpickupdeliveryList($branchID)
    {
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
		$this->db->where('sobt.from_branch_id', $branchID);
		$this->db->or_where('sobt.to_branch_id', $branchID);
		$this->db->group_by('sm.id');
        $this->db->order_by("sm.id", "DESC");
		$this->db->limit(7, 0);
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
	
	public function getuserPickupdeliveryOrderList($user_id)
    {
		$this->db->select('pbot.*, sm.shipment_no,`sm`.`created_date` AS shipment_date, sfa.firstname as firstname, sfa.lastname as lastname, sfa.address as from_address, sfa.address2 from_address2, sfa.telephone from_telephone, cm.name as country_name, stm.name as state_name, ctm.name as city_name, sfa.zip from_zip, pbot.shipment_id as id');
		$this->db->from('pd_boy_order_tagging pbot');
		$this->db->join('shipment_master sm', 'pbot.shipment_id = sm.id');
		$this->db->join('shipment_from_address sfa', 'pbot.shipment_id = sfa.shipment_id');
		
		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'sfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');
		
		$this->db->where('pbot.user_id', $user_id);
		$this->db->where("(pbot.order_type = '1' or pbot.order_type = '2')");
		//$this->db->where('pbot.order_type', '1');
        //$this->db->or_where('pbot.order_type', '2');
		$this->db->where('pbot.status', '0');
		$this->db->order_by("pbot.id", "DESC");
		$this->db->limit(7, 0);
		//$this->db->where('sm.created_date <',date('Y-m-d'));
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
    
    public function getActiveTourType()
    {
        $this->db->select('`tourId`,`tourName`');
        $this->db->from('tour_type');
        $this->db->where('status', 1);
        $query  =   $this->db->get();
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            $row        =   $query->result();
            return  $row;            
        }
        else
        {
            return $row;
        }
    }
    
    public function getActiveDestination()
    {
        $this->db->select('`destinationId`,`destinationName`');
        $this->db->from('destination');
        $this->db->where('status', 1);
        $query  =   $this->db->get();
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            $row        =   $query->result();
            return  $row;            
        }
        else
        {
            return $row;
        }
    }
    
    public function addPackage($data)
    {
        $this->db->insert('packageinfo', $data);
        return $this->db->insert_id();
	}
    
    public function editPackageMultiImg($id)
    {
        $this->db->select('file_name');
        $this->db->from('package_related_images');
        $this->db->where('package_id', $id);
        $query  =   $this->db->get();
       
        //$query  =   $this->db->get_where('package_related_images', array('package_id' => $id));
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
    
    public function addMultiplePackagesImages($data)
    {
        foreach($data as $infoData){
            $this->db->insert('package_related_images', $infoData);
        }
        /*$this->db->insert('package_related_images', $data);*/
        return $this->db->insert_id();
        //die();
    }
    
    public function editPackage($id)
    {
        $query  =   $this->db->get_where('packageinfo', array('id' => $id));
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
    
    public function updatePackage($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('packageinfo',$data);
        
        /*$query = $this->db->last_query();
        echo $query;*/
        
        return $this->db->affected_rows();
    }
	
	public function updateUserEmail($id, $data)
    {
        $this->db->set($data);
        $this->db->where('user_id',$id);
        $this->db->update('users',$data);
        
        return $this->db->affected_rows();
    }
    
    public function deletePackage($id)
    {
        $this->db->delete('packageinfo', array('id' => $id));
        return $this->db->affected_rows();
    }
    
    /********************************************Packages Module********************************************/

    public function get_profile_data($email)
    {
        $query  =   $this->db->get_where('users', array('email' => $email));
		/*$query = $this->db->last_query();
        echo $query;die;*/
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            $row        =   $query->result();
            return  $row;            
        }
        else
        {
            return $row;
        }
    }
    
    public function updateprofile($email,$data)
    {
        $this->db->set($data);
        $this->db->where('email',$email);
        $this->db->update('users',$data);
        
        /*$query = $this->db->last_query();
        echo $query;*/
        
        return $this->db->affected_rows();
    }

    public function changePassword($data,$confirmPassword)
    {
        $query     =   $this->db->get_where('users', $data);
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            $email  =   $data['email'];
            unset($data['email']);
            $data['password']      =       md5($confirmPassword);
            $this->db->set($data);
            $this->db->where('email',$email);
            $this->db->update('users',$data);
            return $this->db->affected_rows();
        }
        else
        {
            return false;
        }
    }
	
	public function RandomPassword($pw_length = 8, $use_caps = true, $use_numeric = true, $use_specials = true)
    {
        /*$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;*/
        $caps         = array();
        $numbers      = array();
        $num_specials = 0;
        $reg_length   = $pw_length;
        $pws          = array();
        for ($ch = 97; $ch <= 122; $ch++) {
            $chars[] = $ch;
        }
        // create a-z
        if ($use_caps) {
            for ($ca = 65; $ca <= 90; $ca++) {
                $caps[] = $ca;
            }
        }

        // create A-Z
        if ($use_numeric) {
            for ($nu = 48; $nu <= 57; $nu++) {
                $numbers[] = $nu;
            }
        }

        // create 0-9
        $all = array_merge($chars, $caps, $numbers);
        if ($use_specials) {
            $reg_length   = ceil($pw_length * 0.75);
            $num_specials = $pw_length - $reg_length;
            if ($num_specials > 5) {
                $num_specials = 5;
            }

            for ($si = 33; $si <= 47; $si++) {
                $signs[] = $si;
            }

            $rs_keys = array_rand($signs, $num_specials);
            foreach ($rs_keys as $rs) {
                $pws[] = chr($signs[$rs]);
            }
        }
        $rand_keys = array_rand($all, $reg_length);
        foreach ($rand_keys as $rand) {
            $pw[] = chr($all[$rand]);
        }
        $compl = array_merge($pw, $pws);
        shuffle($compl);
        return implode('', $compl);
    }
	
	public function IfExistEmail($email)
    {

        $this->db->select('user_id, email');
        $this->db->from('users');
        $this->db->where('email', $email);
		//$this->db->where('user_id', '');
		$where = "(user_type='MO' OR user_type='BO' OR user_type='PDB')";
		$this->db->where($where);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query->num_rows() != 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
	
	public function UpdatePassword($user_id, $newpassword)
    {

        $res = $this->db->update('users', ['password' => $newpassword], ['user_id' => $user_id]);

        if ($res == 1) {
            return true;
        } else {
            return false;
        }

    }

    public function getReplacedSingleImgName($email)
    {
        $this->db->select('`profile_image`');
        $this->db->from('users');
        $this->db->where('`email`', $email);
        $query  =   $this->db->get();
        
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row    =   $query->result();
            $row    =   $row[0]->profile_image;
            return $row;
        }
        else
        {
            //return false;
            return $row;
        }
    }

    /********************************************Video Tag Module********************************************/
    
    public function videotagslist()
    {
        $query = $this->db->get('video_tag_defination');
        
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
    
    public function insertVideoTag($data)
    {
        $query          =   $this->db->get_where('video_tag_defination', array('tag_name' => $data['tag_name']));
        //$resultArray    =   $query->result_array();        
        if($query->num_rows() >= 1){
            return  false;
        }
        else{
            $this->db->insert('video_tag_defination', $data);
            return $this->db->insert_id();
        }
        
    }
    
    public function editVideoTag($id)
    {
        $query  =   $this->db->get_where('video_tag_defination', array('tag_id' => $id));
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            $row        =   $query->result();
            return  $row;            
        }
        else
        {
            return $row;
        }
    }
    
    public function updateVideoTag($id, $data)
    {
        $query          =   $this->db->get_where('video_tag_defination', array('tag_name' => $data['tag_name']));
        if($query->num_rows() >= 1){
            return  false;
        }
        else{
            $this->db->set($data);
            $this->db->where('tag_id',$id);
            $this->db->update('video_tag_defination',$data);
            
            return $this->db->affected_rows();
        }
    }

    public function deleteVideoTag($id)
    {
        $this->db->delete('video_tag_defination', array('tag_id' => $id));       
        return $this->db->affected_rows();
    }
    
    /********************************************Video Tag Module********************************************/    
    
}