<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quotation extends CI_Controller
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
        $this->load->model('quotation_model');
        $this->load->model('order_model');
        $this->load->model('category_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   quotation Functions   ********************************************/
    public function index($page = 'list-quotation')
    {
        if (!$this->session->userdata('logged_in')) {
            return redirect('admin/login');
        } else {
            if (!file_exists(APPPATH . 'views/admin/quotation/' . $page . '.php')) {
                show_404();
            } else {
                $data   =   [];
                $from_date = $this->input->post('from_date');
                $to_date   = $this->input->post('to_date');
                // print_r($this->session->userdata());die;
                if (($this->session->userdata('user_type') == 'BO')) {
                    //branch user
                    $usersBranch  =   $this->quotation_model->getBranchUser(array('user_id' => $this->session->userdata('user_id')));
                    
                    if (!empty($usersBranch)) {
                        $data['from_date'] = $from_date;
                        $data['to_date']   = $to_date;
                        $data['quotationList']  =   $this->quotation_model->getQuotationListByBranch($from_date, $to_date, $usersBranch['branch_id']);
                    } else {
                        $data['quotationList']  = [];
                    }
                } else {
                    $data['from_date'] = $from_date;
                    $data['to_date']   = $to_date;
                    $data['quotationList']  =   $this->quotation_model->getQuotationList($from_date, $to_date);
                }

                $data['title']              =   ucfirst($page);
                $this->load->view('admin/quotation/' . $page, $data);
            }
        }
    }

    public function viewquotation($id)
    {
        //echo $id;
        $data['quote_details']          = $this->quotation_model->quotationDetails($id);
        $data['quote_from_details']     = $this->quotation_model->quotationFromDetails($id);
        $data['quote_to_details']       = $this->quotation_model->quotationToDetails($id);
        $data['quote_item_details']     = $this->quotation_model->quotationItemDetails($id);
        $data['tax'] = $this->order_model->getTax();

        $this->load->view('admin/quotation/view-quotation', $data);
    }

    public function quotationorderclosed($quotation_id, $status)
    {
        $data = array(
            'status' => $status
        );
        $UpdateQuoteStatus   =   $this->quotation_model->upadte_quotation_status_closed($quotation_id, $data);

        if ($UpdateQuoteStatus > 0) {
            $this->session->set_flashdata('success', 'Quotation closed successfully');
            echo redirectPreviousPage();
        } else {
            $this->session->set_flashdata('error', 'Quotation cannot closed!!');
            echo redirectPreviousPage();
        }
    }


    public function addquotation($page = 'add-quotation')
    {
        if (!$this->session->userdata('logged_in')) {
            return redirect('admin/login');
        } else {
            if (!file_exists(APPPATH . 'views/admin/quotation/' . $page . '.php')) {
                show_404();
            } else {
                $data['title'] = ucfirst($page);
                $data['usersList']     =   $this->quotation_model->getNormalBusinessUserList();
                $this->load->view('admin/quotation/' . $page, $data);
            }
        }
    }

    public function insertdocument()
    {
        $this->form_validation->set_rules('name', 'Document Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Document description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('subscription/addSubscription');
            echo redirectPreviousPage();
        } else {
            $data   =   $_POST;
            $checkAvailablity       =   $this->document_model->checkExistDocument($_POST['name']);

            if ($checkAvailablity > 0) {
                $this->session->set_flashdata('error', 'Document Already exists!');
                echo redirectPreviousPage();
                exit;
            }

            //print_r($data); die;
            $insertDocument   =   $this->document_model->addNewdocument($data);

            if ($insertDocument > 0) {
                $this->session->set_flashdata('success', 'Document Successfully Added');
                echo redirectPreviousPage();
            } else {
                $this->session->set_flashdata('error', 'Something went wrong');
                echo redirectPreviousPage();
            }
        }
    }







    public function editdocument($id)
    {
        //echo $id;
        $data['editDocument']   =   $this->document_model->editDocument($id);
        $data['categoryList']     =   $this->document_model->getdocumentCategoriesList();
        $this->load->view('admin/document/edit-document', $data);
    }

    public function updateDocument($id)
    {
        $this->form_validation->set_rules('name', 'Document Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Document description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/editdocument/' . $id);
        } else {
            $data                   =       $_POST;

            $updateBranch             =       $this->document_model->updateDocument($id, $data);

            if ($updateBranch == 1) {
                $this->session->set_flashdata('success', 'Document updated successfully');
                return redirect('admin/editdocument/' . $id);
            } else {
                $this->session->set_flashdata('error', 'Nothing to update!!');
                return redirect('admin/editdocument/' . $id);
            }
        }
    }

    public function deleteQuotation($id)
    {
        $deleteQuotationFromAddress   =   $this->quotation_model->deleteQuotationFromAddress($id);
        $deleteQuotationToAddress     =   $this->quotation_model->deleteQuotationToAddress($id);
        $deleteQuotationItems         =   $this->quotation_model->deleteQuotationItems($id);
        $deleteQuotation                 =   $this->quotation_model->deleteQuotation($id);

        if ($deleteQuotation == 1) {
            $this->session->set_flashdata('success', 'Quotation deleted successfully');
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

    public function getAllStateListbyCountry()
    {
        $countryId                   =   $this->input->post('countryId', TRUE);
        $StateList     =   $this->quotation_model->getStateListbyOption($countryId);
        echo $StateList;
    }

    public function getAllCityListbyState()
    {
        $stateId                   =   $this->input->post('stateId', TRUE);
        $CityList     =   $this->quotation_model->getCityListbyOption($stateId);
        echo $CityList;
    }
}
