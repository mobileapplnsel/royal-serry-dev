<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shift extends CI_Controller {

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
        $this->load->model('shift_model');
		$this->load->model('category_model');
        $this->load->model('branch_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   document Functions   ********************************************/
	public function index($page = 'list-shift')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/shift/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['shiftList']  =   $this->shift_model->getShiftList();
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/shift/' . $page, $data);
            }
        }
    }
	
	
    public function addshift($page = 'add-shift')
    {
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			if(!file_exists(APPPATH . 'views/admin/shift/' . $page . '.php'))
			{
				show_404();
			}
			else{
				$data['title'] = ucfirst($page);
				//$data['ShippingModeList']     		=   $this->rate_model->getShippingModeList();
				//$data['ShippingCatList']     		=   $this->rate_model->getShippingCatList();
				//$data['ShippingDocumentCatList']    =   $this->rate_model->getShippingDocumentCatList();
				//$data['ShippingPackageCatList']     =   $this->rate_model->getShippingPackageCatList();
				$this->load->view('admin/shift/' . $page, $data);
			}
		}
    }
	
	public function insertshift()
    {
        $this->form_validation->set_rules('shift_name', 'Shift name', 'trim|required');
        $this->form_validation->set_rules('time_from', 'Shift Time From', 'required');
		$this->form_validation->set_rules('time_to', 'Shift Time To', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('subscription/addSubscription');
            echo redirectPreviousPage();
        }
        else
        {
            $data   =   $_POST;
			/*$checkAvailablity       =   $this->rate_model->checkExistRate($_POST['ship_mode_id'],$_POST['ship_cat_id'],$_POST['ship_subcat_id'],$_POST['rate_type']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Rate Already exists!');
                echo redirectPreviousPage();
                exit;
            }*/
			
			//print_r($data); die;
			$time_from    =   strtotime($_POST['time_from']);
			$time_to   =   strtotime($_POST['time_to']);
			if($time_from > $time_to)
			{
			   $this->session->set_flashdata('error', 'To Time must be grater than From Time!!');
                echo redirectPreviousPage();
				exit;
			}
			
			//print_r($data); die;
            $insertRate   =   $this->shift_model->addNewshift($data);

            if($insertRate > 0){
                $this->session->set_flashdata('success', 'Shift Successfully Added');
                //echo redirectPreviousPage();
				redirect('admin/shift-list');
            }
            else{
                $this->session->set_flashdata('error', 'Shift cannot added!!');
                echo redirectPreviousPage();
            }
        }
    }
	
    /*public function getpackageCategories(){
		$ShippingPackageCatList     =   $this->rate_model->getShippingPackageCatList();
		echo $ShippingPackageCatList;
		
	}*/

     public function getdocumentCategories(){
		$type   				=   $this->input->post('type', TRUE);
		$ShippingDocumentCatList     =   $this->rate_model->getShippingDocumentCatListbyOption($type);
		echo $ShippingDocumentCatList;
		
	}
    
       
    
    public function editshift($id)
    {
        //echo $id;
        $data['editShift']   =   $this->shift_model->editShift($id);
		//echo $data['editRate'][0]->ship_cat_id; die;
		//$data['ShippingModeList']     		=   $this->rate_model->getShippingModeList();
		//$data['ShippingCatList']     		=   $this->rate_model->getShippingCatList();
		//$data['ShippingDocumentCatList']    =   $this->rate_model->getShippingDocumentCatList_byId($data['editRate'][0]->ship_cat_id);
        $this->load->view('admin/shift/edit-shift', $data);
    }
    
    public function updateShift($id)
    {
        $this->form_validation->set_rules('shift_name', 'Shift name', 'trim|required');
        $this->form_validation->set_rules('time_from', 'Shift Time From', 'required');
		$this->form_validation->set_rules('time_to', 'Shift Time To', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/editshift/'.$id);
        }
        else
        {
            $data                   =       $_POST;
			
			/*$checkAvailablity       =   $this->rate_model->checkExistRate_byID($_POST['ship_mode_id'],$_POST['ship_cat_id'],$_POST['ship_subcat_id'],$_POST['rate_type'],$id);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Rate Already exists!');
                echo redirectPreviousPage();
                exit;
            }*/
			//print_r($data); die;
			$time_from    =   strtotime($_POST['time_from']);
			$time_to   =   strtotime($_POST['time_to']);
			if($time_from > $time_to)
			{
			   $this->session->set_flashdata('error', 'To Time must be grater than From Time!!');
                echo redirectPreviousPage();
				exit;
			}
            $updateShift     		=       $this->shift_model->updateShift($id, $data);

            if($updateShift == 1){
                $this->session->set_flashdata('success', 'Shift updated successfully');
                //return redirect('admin/editshift/'.$id);
				redirect('admin/shift-list');
            }
            else{
                $this->session->set_flashdata('error', 'Nothing to update!!');
                return redirect('admin/editshift/'.$id);
            }
        }
    }

    public function deleteShift($id)
    {   
        
        //check assign to branch
        $shiftAssigned = $this->branch_model->checkShiftAssignToBranch($id);
        if ($shiftAssigned) {
            $this->session->set_flashdata('error', 'You can not delete this shift. this is assigned to branch');
            echo redirectPreviousPage();
            exit;
        }
        
        $deleteShift=$this->shift_model->deleteShift($id);
        if($deleteShift == 1){
            $this->session->set_flashdata('success', 'Shift deleted successfully');
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

}