<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RecipientController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('recipients_model');
    }

    function autocomplete(){
        $postData = $this->input->post('search');
        $data = $this->recipients_model->getLists(['firstname'=>$postData]);
        echo json_encode($data);
    }

    
}
