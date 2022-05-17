<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends CI_Controller {

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
        $this->load->library(array('form_validation','encryption', 'encrypt','session','javascript'));
        $this->load->helper(array('url', 'form', 'date'));
        $this->load->helper('admin_helper');
        $this->encryption->create_key(16);
        $this->load->model('subscription_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   Subscription Functions   ********************************************/
    
    public function index($page = 'list-subscription')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/subscription/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['subscriptionList']  =   $this->subscription_model->getSubscriptionList();
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/subscription/' . $page, $data);
            }
        }
    }

    public function addSubscription($page = 'add-subscription')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/subscription/' . $page . '.php'))
            {
                show_404();
            }
            else{
                if(!$this->session->userdata('logged_in'))
                {
                    return redirect('admin/login');
                }
                else{
                    $data['title']          =   ucfirst($page);
                    $this->load->view('admin/subscription/' . $page, $data);
                }
            }
        }
    }
    
    public function insertSubscription()
    {
        $this->form_validation->set_rules('subscription_name', 'Subscription Name', 'trim|required');
        $this->form_validation->set_rules('subscription_price', 'Subscription Price', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('subscription/addSubscription');
            echo redirectPreviousPage();
        }
        else
        {
            $data   =   $_POST;

            $insertSubscription   =   $this->subscription_model->addNewSubscription($data);

            if($insertSubscription > 0){
                $this->session->set_flashdata('success', 'Subscription Successfully Added');
                echo redirectPreviousPage();
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                echo redirectPreviousPage();
            }
        }
    }    
    
    public function editSubscription($id)
    {
        //echo $id;
        $data['editSubscription']   =   $this->subscription_model->editSubscription($id);
        $this->load->view('admin/subscription/edit-subscription', $data);
    }
    
    public function updateSubscription($id)
    {
        $this->form_validation->set_rules('subscription_name', 'Subscription Name', 'trim|required');
        $this->form_validation->set_rules('subscription_status', 'Status', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/editsubscription/'.$id);
        }
        else
        {
            $data                   =       $_POST;
            $updateSubscription     =       $this->subscription_model->updateSubscription($id, $data);

            if($updateSubscription == 1){
                $this->session->set_flashdata('success', 'Subscription updated successfully');
                return redirect('admin/editsubscription/'.$id);
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                return redirect('admin/editsubscription/'.$id);
            }
        }
    }

    public function deleteSubscription($id)
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
        
        $deleteSubscription   =   $this->subscription_model->deleteSubscription($id);
        
        if($deleteSubscription == 1){
            $this->session->set_flashdata('success', 'Subscription deleted successfully');
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