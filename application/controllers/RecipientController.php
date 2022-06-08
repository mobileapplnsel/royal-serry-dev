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
        $session_id = $this->session->userdata('Customer');
        $customer_id = $session_id['id'];
        $datas = $this->recipients_model->serach($postData,$customer_id);
        

        $newdata = array();
        foreach($datas as $data){
            $data['label']= $data['firstname'].' '.$data['lastname'].' '.$data['address'];
            if (!empty($data['telephone']) && is_serialized_string($data['telephone'])) {
                $telephone = repairSerializeString($data['telephone']);
                $telephone = unserialize($telephone);
            } else {
                $telephones = $quote_to_details[0]['telephone'];
            }

            $data['telephone'] = $telephone;
            $newdata[] = $data;
        }
        echo json_encode($newdata);
    }

    
}