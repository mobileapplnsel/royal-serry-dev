<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation','encryption', 'session','javascript'));
        $this->load->helper(array('url', 'form', 'date'));
        $this->load->helper('admin_helper');
        $this->encryption->create_key(16);
        $this->load->model('branch_model');
		$this->load->model('user_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->load->model('city_model');
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   Subscription Functions   ********************************************/
    public function addbranch($page = 'add-branch')
    {
		if (!get_permission('ADDBRANCH', 'is_add')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			if(!file_exists(APPPATH . 'views/admin/branch/' . $page . '.php'))
			{
				show_404();
			}
			else{
				$data['title'] = ucfirst($page);
				$this->load->view('admin/branch/' . $page);
			}
		}
    }
	
	public function insertbranch()
    {
        $this->form_validation->set_rules('name', 'Branch Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Branch Email', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('subscription/addSubscription');
            echo redirectPreviousPage();
        }
        else
        {
            $data   =   $_POST;
			$checkAvailablity       =   $this->branch_model->checkExistBranch($_POST['email']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Email-ID Already exists!');
                echo redirectPreviousPage();
                exit;
            }
			
			$checkPhoneAvailablity       =   $this->branch_model->checkExistBranchTelephone($_POST['telephone']);
			
            if($checkPhoneAvailablity>0){
                $this->session->set_flashdata('error', 'Telephone no Already exists!');
                echo redirectPreviousPage();
                exit;
            }
			
			$postal_code = $data['zip'];
			$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($postal_code)."&sensor=false&key=googleapi";
			$result_string = file_get_contents($url);
			$result = json_decode($result_string, true);
			//print_r($result);
			if(!empty($result['results'])){
				$data['latitude'] = $result['results'][0]['geometry']['location']['lat'];
				$data['longitude'] = $result['results'][0]['geometry']['location']['lng'];
			} else {
				$data['latitude'] = '23.5204';
				$data['longitude'] = '87.3119';
			}
	
			//echo '===>>>'.$checkAvailablity; 
			//print_r($data); die;
            $insertBranch   =   $this->branch_model->addNewbranch($data);

            if($insertBranch > 0){
                $this->session->set_flashdata('success', 'Branch Successfully Added');
                echo redirectPreviousPage();
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                echo redirectPreviousPage();
            }
        }
    }
	
    public function index($page = 'list-branch')
    {
		if (!get_permission('ALLBRANCHLIST', 'is_view')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/branch/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['branchList']  =   $this->branch_model->getBranchList();
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/branch/' . $page, $data);
            }
        }
    }

    
    
       
    
    public function editbranch($id)
    {
		if (!get_permission('ADDBRANCH', 'is_add')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        //echo $id;
        $data['editBranch']   =   $this->branch_model->editBranch($id);
        $this->load->view('admin/branch/edit-branch', $data);
    }
    
    public function updateBranch($id)
    {
        $this->form_validation->set_rules('name', 'Branch Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Branch Email', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/editbranch/'.$id);
        }
        else
        {
            $data                   =       $_POST;
			
			$checkAvailablity       =   $this->branch_model->checkExistBranch_ByID($_POST['email'], $id);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Branch Email-ID Already exists!');
                echo redirectPreviousPage();
                exit;
            }
			
			$checkPhoneAvailablity       =   $this->branch_model->checkExistBranchTelephone_ByID($_POST['telephone'], $id);
			
            if($checkPhoneAvailablity>0){
                $this->session->set_flashdata('error', 'Branch Telephone Already exists!');
                echo redirectPreviousPage();
                exit;
            }
			
			$postal_code = $data['zip'];
			$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($postal_code)."&sensor=false&key=googleapi";
			$result_string = file_get_contents($url);
			$result = json_decode($result_string, true);
			//print_r($result);
			if(!empty($result['results'])){
				$data['latitude'] = $result['results'][0]['geometry']['location']['lat'];
				$data['longitude'] = $result['results'][0]['geometry']['location']['lng'];
			} else {
				$data['latitude'] = '23.5204';
				$data['longitude'] = '87.3119';
			}
	
			//echo '===>>>'.$checkAvailablity; 
			//print_r($data); die;
            $updateBranch     		=       $this->branch_model->updateBranch($id, $data);

            if($updateBranch == 1){
                $this->session->set_flashdata('success', 'Branch updated successfully');
                return redirect('admin/editbranch/'.$id);
            }
            else{
                $this->session->set_flashdata('error', 'Nothing to update!!');
                return redirect('admin/editbranch/'.$id);
            }
        }
    }

    public function deleteBranch($id)
    {   
        /*$getImageName           =   $this->international_model->getReplacedSingleImgName($id);
        $getMultipleImages      =   $this->international_model->editPackageMultiImg($id);
        
        if(!empty($getImageName) && !empty($getMultipleImages)){
            $deleteFile     =   './uploads/international/'.$getImageName;            
                unlink($deleteFile);
            foreach($getMultipleImages as $getMultipleImage){
                $deleteFiles     =   './uploads/international/'.$getMultipleImage->file_name;
                unlink($deleteFiles);
            }
        }*/
        $CheckBranchShipment   =   $this->branch_model->CheckBranchShipment($id);
		$CheckBranchShipmentStop   =   $this->branch_model->CheckBranchShipmentStop($id);
		
		if($CheckBranchShipment == 1 || $CheckBranchShipmentStop == 1){
            $this->session->set_flashdata('error', 'Branch Cannot deleted!! Because assign to other module.');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
		
        $deleteBranch   =   $this->branch_model->deleteBranch($id);
        
        if($deleteBranch == 1){
            $this->session->set_flashdata('success', 'Branch deleted successfully');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Something went wrong');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
    }
	
	public function deleteBranchArea($id)
    { 
	
	$areaDetails   =   $this->branch_model->getAreadetails($id);
	$PDareaDetails   =   $this->branch_model->checkAreaExisttoPD($areaDetails[0]->branch_id,$areaDetails[0]->area_id);
	if($PDareaDetails > 0){
		$this->session->set_flashdata('error', 'Cannot delete Area!!! Please ensure you have untag from P/D boy Area.');
		echo redirectPreviousPage();
		exit;
	}
	
	//die;
	  
        $deleteBranchArea   =   $this->branch_model->deleteBranchArea($id);
        
        if($deleteBranchArea == 1){
            $this->session->set_flashdata('success', 'Branch Area deleted successfully');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Something went wrong');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
    }
    
    /********************************************   Subscription Functions   ********************************************/
	
	/*********************** ADD BRANCH AREA ***********************/
	public function addbrancharea($id)
    {
        $page = 'add-branch-area';
        $branchDetails =  $this->branch_model->getBranch($id);
        $cityList = $this->city_model->getCityListByState($branchDetails->state);
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/branch/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                   =   [];
                $data['branchAreaList']     =   $this->branch_model->getBranchAreaList($id);
                $data['title']          =   ucfirst($page);
                $data['cities'] = $cityList; 
                $data['branchDetails'] = $branchDetails;               
                $this->load->view('admin/branch/' . $page, $data);
            }
        }
    }
	
	
	public function getallareaListbysearchkey()
    {
		//print_r($_REQUEST); die;
        $q        = $this->input->get('text');
        $field    = $this->input->get('field');        
        $tbl_name = $this->input->get('tbl_name');

        echo json_encode($this->branch_model->selectQueryAjax(strtoupper($q), $tbl_name, $field));
    }
	
	public function getallBranchListbysearchkey()
    {
		//print_r($_REQUEST); die;
        $q        = $this->input->get('q');
        $field    = $this->input->get('field');        
        $tbl_name = $this->input->get('tbl_name');
		$from_branch_id = $this->input->get('from_branch_id');
		$to_branch_id = $this->input->get('to_branch_id');

        echo json_encode($this->branch_model->selectQueryAjaxBranchList(strtoupper($q), $tbl_name, $field, $from_branch_id, $to_branch_id));
    }
	
	public function insertbrancharea()
    {
        
		$cityIds  =   $this->input->post('city_id', TRUE);
		$branch_id  =   $this->input->post('branch_id', TRUE);
		$branch_area   =   [];
		foreach($cityIds as $city){
            $branch_area['city_id']     =  $city;
            $branch_area['branch_id']   =  $branch_id;
			$BranchAreacheck   =   $this->branch_model->CheckBranchAreaExist($city, $branch_id);
			//$BranchAreacheck   =   $this->branch_model->CheckBranchAreaExist($area);
			if($BranchAreacheck == 0){
				$insertBranchArea   =   $this->branch_model->insert_branch_area($branch_area);
			}
        }

        if($insertBranchArea > 0){
            $this->session->set_flashdata('success', 'Branch Area Successfully Added');
            echo redirectPreviousPage();
        }
        else{
            $this->session->set_flashdata('error', 'Area Cannot be added!! Already assign to branch.');
            echo redirectPreviousPage();
        }
        
    }
	
	
	/*********************** ADD branch SHIFT ***********************/
	public function addbranchshift($id)
    {
		$page = 'add-branch-shift';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/branch/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $data['branchShiftList']   =   $this->branch_model->getBranchShiftList($id);
                
				$data['ShiftList']   	 =   $this->user_model->getShiftList();
				$data['DaysList']   	 =   $this->user_model->getDaysList();
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/branch/' . $page, $data);
            }
        }
    }
	
	
	public function insertbranchshift()
    {
		$data                           =   [];
		$data['shift_id']                       =   $this->input->post('shift_id', TRUE);
		$data['branch_id']                      =   $this->input->post('branch_id', TRUE);
		//$data['day']                   			=   $this->input->post('day', TRUE);
		
		$checkAvailablity       =   $this->branch_model->checkExistShift($data['shift_id'],$data['branch_id']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Shift allocation Already exists!');
                echo redirectPreviousPage();
                exit;
            }
		//print_r($data); die;
		$insertShift   =   $this->branch_model->insert_branch_shift($data);

		if($insertShift > 0){
			$this->session->set_flashdata('success', 'Shift allocation Successfully Added');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Something went wrong');
			echo redirectPreviousPage();
		}
    }
	
	public function deleteShiftallocation($id)
    { 
	
	$shiftDetails   =   $this->branch_model->getShiftdetails($id);
	/*print_r($shiftDetails);
	echo '===>>'.$shiftDetails[0]->branch_id;
	echo '===>>'.$shiftDetails[0]->shift_id;
	echo '===>>'.$shiftDetails[0]->day;*/
	$PDshiftDetails   =   $this->branch_model->checkShiftExisttoPD($shiftDetails[0]->branch_id,$shiftDetails[0]->shift_id,$shiftDetails[0]->day);
	if($PDshiftDetails > 0){
		$this->session->set_flashdata('error', 'Cannot delete shift!!! Please ensure you have untag from P/D boy.');
		echo redirectPreviousPage();
		exit;
	}
	 // die;
        $deleteShiftallocation   =   $this->branch_model->deleteShiftallocation($id);
        
        if($deleteShiftallocation == 1){
            $this->session->set_flashdata('success', 'Branch Shift Allocation deleted successfully');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Something went wrong');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
    }
	
	/*********************** ADD branch Holiday ***********************/
	public function addbranchholiday($id)
    {
		$page = 'add-branch-holiday';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/branch/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $data['branchHolidayList']   =   $this->branch_model->getBranchHolidayList($id);
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/branch/' . $page, $data);
            }
        }
    }
	
	public function insertbranchHoliday()
    {
		$data                           =   [];
		$data['name']                   =   $this->input->post('name', TRUE);
		$data['branch_id']              =   $this->input->post('branch_id', TRUE);
		$data['from_date']              =   $this->input->post('from_date', TRUE);
		$data['to_date']                =   $this->input->post('to_date', TRUE);
		
		$Date = getDatesFromRange($data['from_date'], $data['to_date']);
		foreach ($Date as $key => $value) {
			$holidays['branch_id']  =  $data['branch_id'];  
			$holidays['name']     	=  $data['name']; 
			$holidays['from_date']  =  $value; 
			$holidays['to_date']    =  $value;
			$checkAvailablity       =   $this->branch_model->checkExistHoliday($holidays['branch_id'],$holidays['from_date'],$holidays['to_date']);
			if($checkAvailablity>0){
			} else {
				$insertHoliday   =   $this->branch_model->insert_branch_holidays($holidays);
			}
		}
		if($insertHoliday > 0){
			$this->session->set_flashdata('success', 'Holiday Successfully Added');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Holiday cannot added!!');
			echo redirectPreviousPage();
		}
    }
	
	public function deleteHoliday($id)
    {   
        $deleteHoliday   =   $this->branch_model->deleteHoliday($id);
        
        if($deleteHoliday == 1){
            $this->session->set_flashdata('success', 'Branch Holiday deleted successfully');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Holiday cannot deleted!!');
            echo redirectPreviousPage();
            exit;
        }
    }
	
	/*********************** ADD branch Pickup delivery rules ***********************/
	public function addpickuprules($id)
    {
		$page = 'add-branch-pickup-rules';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/branch/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
				$data['RulesList']   	 =   $this->branch_model->getRulesList();
                $data['branchPickupRules']   =   $this->branch_model->getBranchPickupRulesList($id);
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/branch/' . $page, $data);
            }
        }
    }
	
	public function insertbranchPickuprules()
    {
		$data                           =   [];
		$data['rule_id']                       =   $this->input->post('rule_id', TRUE);
		$data['branch_id']                      =   $this->input->post('branch_id', TRUE);
		$data['hours']                   		=   $this->input->post('hours', TRUE);
		//print_r($data); die;
		$checkAvailablity       =   $this->branch_model->checkExistRules($data['branch_id']);
		//echo $checkAvailablity; die;	
		if($checkAvailablity>0){
			$updateDate = array(
				'rule_id'=> $data['rule_id'],
				'hours'=> $data['hours']
			);
			$this->branch_model->update_branch_rules($updateDate, $data['branch_id']);
		} else {
			$this->branch_model->insert_branch_rules($data);
		}
		$this->session->set_flashdata('success', 'Branch Pickup/Delivery Rules Successfully updated.');
		echo redirectPreviousPage();
    }
	
	/*********************** ADD branch Calendar ***********************/
	public function addbranchcalendar($id)
    {
		$page = 'add-branch-calendar';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/branch/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                //$data['branchHolidayList']   =   $this->branch_model->getBranchHolidayList($id);
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/branch/' . $page, $data);
            }
        }
    }
	
	public function calHolidays(){
	 	$branch_id = $this->uri->segment(3);
		//$empid = $this->session->userdata('id');
		//$type =($this->input->post('calType') == '' ? '' : $this->input->post('calType') );
		//$data = array();
	   //if($employee_id!='0' || $employee_id !='') {  $employee_id =  $employee_id ; } else { $employee_id = $empid; } //echo 'fff'.$employee_id;    die;
		$event_datas = $this->branch_model->getBranchHolidays($branch_id);
	}
	
}