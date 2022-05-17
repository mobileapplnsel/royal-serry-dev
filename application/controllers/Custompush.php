<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custompush extends CI_Controller {

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
        $this->load->model('custompush_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   Subscription Functions   ********************************************/
    
    public function index($page = 'list-custompush')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/custompush/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['pushList']   =   $this->custompush_model->getPushList();
                $data['title']          =   ucfirst($page);
                $this->load->view('admin/custompush/' . $page, $data);
            }
        }
    }

    public function sendnewpush($page = 'send-push')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/custompush/' . $page . '.php'))
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
                    $this->load->view('admin/custompush/' . $page, $data);
                }
            }
        }
    }
    
    public function insertcustompush()
    {
        $this->form_validation->set_rules('push_type', 'Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('castcrew/addcastcrew');
            echo redirectPreviousPage();
            exit;
        }
        else
        {
            //$data   =   $_POST;
            $data   =   [];
            $data['push_type']  =   $this->input->post('push_type', TRUE);
            $data['message']    =   $this->input->post('description', TRUE);

                
			$insertPush   =   $this->custompush_model->insertpush($data);

			if($insertPush > 0){
				$this->session->set_flashdata('success', 'Push Notification Send Successfully');
				echo redirectPreviousPage();
				exit;
			}
			else{
				$this->session->set_flashdata('error', 'Something went wrong');
				echo redirectPreviousPage();
				exit;
			}
            
        }
    }    
    

    public function deletepush($id)
    {   
        $deleteCastcrew   =   $this->custompush_model->deletepush($id);
        
        if($deleteCastcrew == 1){
            $this->session->set_flashdata('success', 'Push Notification deleted successfully');
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