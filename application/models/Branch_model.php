<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Branch_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************branch Module********************************************/
    
    public function addNewbranch($data)
    {
        $this->db->insert('branch', $data);
        return $this->db->insert_id();
    }

    public function getBranchList($status='',$city='')
    {
        //$query = $this->db->get('branch');
        //$query  =   $this->db->get_where('branch', array('is_main_office' => '0'));
		$this->db->select('b.*, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
		$this->db->from('branch b');
		$this->db->where('b.is_main_office', "0");
		$this->db->join('countries_master cm', 'b.country = cm.id', 'left');
		$this->db->join('states_master sm', 'b.state = sm.id', 'left');
		$this->db->join('cities_master ctm', 'b.city = ctm.id', 'left');
        if($status !=''){
            $this->db->where('b.status',$status);
        }
        if($city !=''){
            $this->db->where('b.city',$city);
        }
        $query  =   $this->db->get();
        //echo $this->db->last_query();
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
	
	public function checkExistBranch($email)
    {
        $query  =   $this->db->get_where('branch', array('email' => $email));
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
	
	public function checkExistBranchTelephone($telephone)
    {
        $query  =   $this->db->get_where('branch', array('telephone' => $telephone));
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
	
	public function CheckBranchAreaExist($area)
    {
        //$query = $this->db->get_where('branch_area', array('area_id' => $area, 'branch_id' => $branch_id));
		$query = $this->db->get_where('branch_area', array('area_id' => $area));
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
	
	public function CheckBranchShipment($id)
    {
		$where = "from_branch_id='".$id."' OR to_branch_id='".$id."'";
		$this->db->select('*');
		$this->db->from('container_shipment');
		$this->db->where($where);
		$query  =   $this->db->get();
        //$query  =   $this->db->get_where('container_shipment', array('telephone' => $telephone));
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
	
	public function CheckBranchShipmentStop($id)
    {
        $query  =   $this->db->get_where('container_shipment_stops', array('branch_id' => $id));
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
	
	public function checkExistBranch_ByID($email,$id)
    {
		
		$array = array('email' => $email);
		$this->db->select('*');
		$this->db->from('branch');
		$this->db->where($array);
		$this->db->where_not_in('branch_id', $id);
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
	
	public function checkExistBranchTelephone_ByID($telephone,$id)
    {
		
		$array = array('telephone' => $telephone);
		$this->db->select('*');
		$this->db->from('branch');
		$this->db->where($array);
		$this->db->where_not_in('branch_id', $id);
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

    public function editBranch($id)
    {
        $query  =   $this->db->get_where('branch', array('branch_id' => $id));
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
    
    public function updateBranch($id, $data)
    {
        $this->db->set($data);
        $this->db->where('branch_id',$id);
        $this->db->update('branch',$data);
        
        /*$query = $this->db->last_query();
        echo $query;*/
        
        return $this->db->affected_rows();
    }
	
	public function update_branch_rules($data, $branch_id)
    {
        $this->db->set($data);
        $this->db->where('branch_id',$branch_id);
        $this->db->update('branch_pickup_delivery_rules',$data);
        
        /*$query = $this->db->last_query();
        echo $query;*/
        
        return $this->db->affected_rows();
    }

    public function deleteBranch($id)
    {
        $this->db->delete('branch', array('branch_id' => $id));
        //$this->db->delete('international_days_iternary', array('package_id' => $id));
        //$this->db->delete('international_related_images', array('package_id' => $id));        
        return $this->db->affected_rows();
    }
	
	
	public function deleteBranchArea($id)
    {
        $this->db->delete('branch_area', array('id' => $id));
        return $this->db->affected_rows();
    }

    /********************************************Subscription Module********************************************/
    
    public function editPackageMultiImg($id)
    {
        $this->db->select('`int_img_id`, `file_name`');
        $this->db->from('international_related_images');
        $this->db->where('package_id', $id);
        $query  =   $this->db->get();
        
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            //return true;
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
            $this->db->insert('international_related_images', $infoData);
        }
        /*$this->db->insert('package_related_images', $data);*/
        return $this->db->insert_id();
        //die();
    }
    
    public function addDomesticDaysIternary($data)
    {
        foreach($data as $infoData){
            $this->db->insert('international_days_iternary', $infoData);
        }
        return $this->db->insert_id();
    }
    
    public function editPackageDaysIternary($id)
    {
        $this->db->select('*');
        $this->db->from('international_days_iternary');
        $this->db->where('package_id', $id);
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
	
	public function getShiftdetails($id)
    {
        $this->db->select('*');
        $this->db->from('branch_shift_allocation');
        $this->db->where('id', $id);
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
	
	public function getAreadetails($id)
    {
        $this->db->select('*');
        $this->db->from('branch_area');
        $this->db->where('id', $id);
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
	
	public function checkShiftExisttoPD($branch_id,$shift_id,$day)
    {
		$this->db->select('psa.*');
        $this->db->from('pd_shift_allocation psa');
		$this->db->join('branch_users bu', 'psa.pd_id = bu.user_id');
		$this->db->join('branch_shift_allocation bsa', 'bu.branch_id = bsa.branch_id');
        $this->db->where('bu.branch_id', $branch_id);
		$this->db->where('psa.shift_id', $shift_id);
		$this->db->where('psa.day', $day);
		$this->db->group_by('psa.id'); 
		$query  =   $this->db->get();
		//echo $this->db->last_query();
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
	
	public function checkAreaExisttoPD($branch_id,$area_id)
    {
		$this->db->select('pdba.*');
        $this->db->from('pickup_delivery_boy_area pdba');
		$this->db->join('branch_users bu', 'pdba.user_id = bu.user_id');
		$this->db->join('branch_area ba', 'bu.branch_id = ba.branch_id');
        $this->db->where('bu.branch_id', $branch_id);
		$this->db->where('pdba.area_id', $area_id);
		$this->db->group_by('pdba.id'); 
		$query  =   $this->db->get();
		//echo $this->db->last_query();
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
    
    public function updateIternaryDays($data)
    {
        foreach($data as $existingDays){
            $data = ['days' => $existingDays['days']];
            $this->db->set($data);
            $this->db->where('inerItrNo', $existingDays['inerItrNo']);
            $this->db->update('international_days_iternary', $data);
        }
    }
    
    public function getSelectedSingleMultiImgName($id)
    {
        $this->db->select('`file_name`');
        $this->db->from('international_related_images');
        $this->db->where('`int_img_id`', $id);
        $query  =   $this->db->get();
        
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row    =   $query->result();
            $row    =   $row[0]->file_name;
            return $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }
    
    public function getReplacedSingleImgName($id)
    {
        $this->db->select('`package_image`');
        $this->db->from('international_package');
        $this->db->where('`id`', $id);
        $query  =   $this->db->get();
        
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row    =   $query->result();
            $row    =   $row[0]->package_image;
            return $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }
    
    public function deleteSingleDay($id)
    {
        $this->db->delete('international_days_iternary', array('inerItrNo' => $id));
        return $this->db->affected_rows();
    }
    
    public function deleteMultipleSingleImg($id)
    {
        $this->db->delete('international_related_images', array('int_img_id' => $id));
        return $this->db->affected_rows();
    }
    
    public function deletePackage($id)
    {
        $this->db->delete('international_package', array('id' => $id));
        $this->db->delete('international_days_iternary', array('package_id' => $id));
        $this->db->delete('international_related_images', array('package_id' => $id));        
        return $this->db->affected_rows();
    }    
    
    /********************************************get Branch Area List Module********************************************/
    
    public function getBranchAreaList($id)
    {
        //$query = $this->db->get('tourisms', ['tourCategory' => '1']);
        $this->db->select('ba.id as branch_areaID, pc.*, b.name as branch_name, b.email as branch_email');
        $this->db->from('branch_area ba');
        $this->db->where('ba.branch_id', $id);
		$this->db->join('postal_codes_data_master pc', 'ba.area_id = pc.id');
		$this->db->join('branch b', 'ba.branch_id = b.branch_id');
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
    
    /********************************************Include Module********************************************/
    
    public function getIncludeList()
    {
        //$query = $this->db->get('tourisms', ['tourCategory' => '0']);
        
        $this->db->select('*');
        $this->db->from('package_features');
        $this->db->where('featureMode', 1);
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
    
    /********************************************Exclude Module********************************************/
    
    public function getExcludeList()
    {
        //$query = $this->db->get('tourisms', ['tourCategory' => '0']);
        
        $this->db->select('*');
        $this->db->from('package_features');
        $this->db->where('featureMode', 0);
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
	
	public function getRulesList()
    {
        $this->db->select('*');
        $this->db->from('pickup_delivery_rules');
        //$this->db->where('featureMode', 0);
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
	
	public function selectQueryAjax($q, $table_name = '', $field = '')
    {
        $this->db->select('id,' . $field . ' as text');
        $this->db->like($field, $q);
        $query = $this->db->get($table_name);
        //echo $this->db->last_query(); die;
        return $query->result();
    }
	
	public function selectQueryAjaxBranchList($q, $table_name = '', $field = '', $from_branch_id, $to_branch_id)
    {
        $this->db->select('branch_id as id, ' . $field . ' as text');
        $this->db->like($field, $q);
		$this->db->where('is_main_office', '0');
		$this->db->where_not_in('branch_id', array($from_branch_id, $to_branch_id));
        $query = $this->db->get($table_name);
        //echo $this->db->last_query(); //die;
        return $query->result();
    }
	
	public function insert_branch_area($data)
    {
        $this->db->insert('branch_area', $data);
        return $this->db->insert_id();
    }
	
	/********************************************get User SHift List Module********************************************/
    
    public function getBranchShiftList($id)
    {
        $this->db->select('bsa.*, sm.shift_name, sm.shift_type, sm.time_from, sm.time_to, wd.day');
        $this->db->from('branch_shift_allocation bsa');
        $this->db->where('bsa.branch_id', $id);
		$this->db->join('shift_master sm', 'bsa.shift_id = sm.id');
		$this->db->join('week_days wd', 'bsa.day = wd.id');
		
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
	
	public function checkExistShift($shift_id,$branch_id,$day)
    {
        $query  =   $this->db->get_where('branch_shift_allocation', array('shift_id' => $shift_id, 'branch_id' => $branch_id, 'day' => $day));
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
	
	public function checkExistRules($branch_id)
    {
        $query  =   $this->db->get_where('branch_pickup_delivery_rules', array('branch_id' => $branch_id));
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
	
	public function insert_branch_shift($data)
    {
        $this->db->insert('branch_shift_allocation', $data);
        return $this->db->insert_id();
    }
	
	public function insert_branch_rules($data)
    {
        $this->db->insert('branch_pickup_delivery_rules', $data);
		//echo $this->db->last_query(); die;
        return $this->db->insert_id();
    }
	
	public function deleteShiftallocation($id)
    {
        $this->db->delete('branch_shift_allocation', array('id' => $id));
        return $this->db->affected_rows();
    }
	
	
	public function getBranchHolidayList($id)
    {
        $this->db->select('bh.*');
        $this->db->from('branch_holiday bh');
        $this->db->where('bh.branch_id', $id);
		//$this->db->join('shift_master sm', 'bsa.shift_id = sm.id');
		//$this->db->join('week_days wd', 'bsa.day = wd.id');
		
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
	
	public function getPickupRules($id)
    {
        $this->db->select('bpdr.*');
        $this->db->from('branch_pickup_delivery_rules bpdr');
        $this->db->where('bpdr.branch_id', $id);
        $query  =   $this->db->get();
		//$query = $this->db->last_query();
        //echo $query; die;
        $row = $query->num_rows();
        if ($row > 0)
        {
            $row = $query->row();
            return $row;            
        }
        else
        {
            return $row;
        }
    }
	
	public function getBranchPickupRulesList($id)
    {
        $this->db->select('bpdr.*, pdr.name as rules_name');
        $this->db->from('branch_pickup_delivery_rules bpdr');
        $this->db->where('bpdr.branch_id', $id);
		$this->db->join('pickup_delivery_rules pdr', 'bpdr.rule_id = pdr.id');
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
	
	public function checkExistHoliday($branch_id,$from_date,$to_date)
    {
        $query  =   $this->db->get_where('branch_holiday', array('branch_id' => $branch_id, 'from_date' => $from_date, 'to_date' => $to_date));
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
	
	public function insert_branch_holidays($data)
    {
        $this->db->insert('branch_holiday', $data);
        return $this->db->insert_id();
    }
	
	public function deleteHoliday($id)
    {
        $this->db->delete('branch_holiday', array('id' => $id));
        return $this->db->affected_rows();
    }
	
	function getBranchHolidays($branch_id) {
        $data = array();
        $this->db->select('*');
        $this->db->from('branch_holiday');
        $this->db->where('branch_id', $branch_id);

        $query = $this->db->get();
        $datas = $query->result_array();
        //echo $this->db->last_query();
        //die;
        $data_events = array();
        foreach ($datas as $data) {
            $data_events[] = array(
                "id"            => $data['id'],
                "title"         => $data['name'],
                "start"   		=> $data['from_date'],
                "branch_id"     => $data['branch_id'],
                "end"     		=> $data['to_date'],
            );
        }
	
        echo json_encode(array("events" => $data_events));

    }
}