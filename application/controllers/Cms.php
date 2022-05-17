<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cms extends CI_Controller
{

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
        $this->load->library(array('form_validation', 'encryption', 'session', 'javascript'));
        $this->load->helper(array('url', 'form', 'date'));
        $this->load->helper('admin_helper');
        $this->encryption->create_key(16);
        $this->load->model('cms_model');
        $this->load->model('category_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   document Functions   ********************************************/
    public function index($page = 'list-cms')
    {
        if (!get_permission('CMSLIST', 'is_view')) {
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        if (!$this->session->userdata('logged_in')) {
            return redirect('admin/login');
        } else {
            if (!file_exists(APPPATH . 'views/admin/cms/' . $page . '.php')) {
                show_404();
            } else {
                $data   =   [];
                $data['cmsList']  =   $this->cms_model->getCmsList();
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/cms/' . $page, $data);
            }
        }
    }


    /*public function adddocument($page = 'add-document')
    {
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			if(!file_exists(APPPATH . 'views/admin/document/' . $page . '.php'))
			{
				show_404();
			}
			else{
				$data['title'] = ucfirst($page);
				$data['categoryList']     =   $this->category_model->getdocumentCategoriesList();
				$this->load->view('admin/document/' . $page, $data);
			}
		}
    }*/

    /*public function insertdocument()
    {
        $this->form_validation->set_rules('name', 'Document Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Document description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('subscription/addSubscription');
            echo redirectPreviousPage();
        }
        else
        {
            $data   =   $_POST;
			$checkAvailablity       =   $this->document_model->checkExistDocument($_POST['name']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Document Already exists!');
                echo redirectPreviousPage();
                exit;
            }
			
			//print_r($data); die;
            $insertDocument   =   $this->document_model->addNewdocument($data);

            if($insertDocument > 0){
                $this->session->set_flashdata('success', 'Document Successfully Added');
                echo redirectPreviousPage();
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                echo redirectPreviousPage();
            }
        }
    }*/







    public function editcms($id)
    {
        if (!get_permission('CMSLIST', 'is_view')) {
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        //echo $id;
        $data['editCms']   =   $this->cms_model->editCms($id);
        $this->load->view('admin/cms/edit-cms', $data);
    }

    public function updateCms($id)
    {
        $this->form_validation->set_rules('name', 'Page Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Content description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/editcms/' . $id);
        } else {
            $data                   =       $_POST;

            $updateCms                 =       $this->cms_model->updateCms($id, $data);

            if ($updateCms == 1) {
                $this->session->set_flashdata('success', 'CMS updated successfully');
                return redirect('admin/editcms/' . $id);
            } else {
                $this->session->set_flashdata('error', 'Nothing to update!!');
                return redirect('admin/editcms/' . $id);
            }
        }
    }

    public function deleteDocument($id)
    {

        $deleteDocument   =   $this->document_model->deleteDocument($id);

        if ($deleteDocument == 1) {
            $this->session->set_flashdata('success', 'Document deleted successfully');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        } else {
            $this->session->set_flashdata('error', 'Something went wrong');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
    }

    /********************************************   Subscription Functions   ********************************************/

    /********************************************   cms images   ********************************************/
    public function images_list($page = 'list-cms-images')
    {
        if (!get_permission('CMSLIST', 'is_view')) {
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        if (!$this->session->userdata('logged_in')) {
            return redirect('admin/login');
        } else {
            if (!file_exists(APPPATH . 'views/admin/cms-images/' . $page . '.php')) {
                show_404();
            } else {
                $data   =   [];
                $data['cmsList']  =   $this->customer_model->getCmsImageList();
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/cms-images/' . $page, $data);
            }
        }
    }
}
