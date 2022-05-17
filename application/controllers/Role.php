<?php
if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Role extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();        
        $this->load->model('OuthModel');
        $this->load->model('role_model');
    }
    public function index()
    {
        $this->isLoggedIn();
    }

    public function roleList()
    {        
        if (!get_permission('ROLE', 'is_view')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        $resp_arr            = array();
        $data                = array();
        $results             = array();
        $status              = '';
        $title_head          = 'Role List';
        $data['title_head']  = $title_head;
        $data['all_roles']   = $this->role_model->roleList();        
        $resp_arr['result']  = (object) $data;
        if ($this->input->post('view_type') == '') {
            $this->load->view("admin/role/role-list", $data);
        } else {
            header("Content-Type: application/json");
            $ret = json_encode($resp_arr);
            echo $ret;
            exit;
        }
    }

    public function roleEdit()
    {
        if ( (!get_permission('ROLE', 'is_edit')) and (!get_permission('ROLE', 'is_add'))){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }

        $resp_arr           = array();
        $data               = array();
        $results            = array();
        $status             = '';
        $title_head         = 'Edit Role';
        $data['title_head'] = $title_head;
        if ($this->uri->segment(3) !== null) {
            $role_id = $this->OuthModel->Encryptor('decrypt',$this->uri->segment(3));
            $data['role_list']         = $this->role_model->roleList($role_id); 
        } else {
            $role_id = '';
            $data['role_list']         = ''; 
        }

        $name           = $this->input->post('name');
        $id             = $this->OuthModel->Encryptor('decrypt',$this->input->post('id'));        
        $user_id        = $this->session->userdata('userId');
        $operation      = $this->input->post('operation');
        if ($operation == 'add') {
            $saveArr = array(
                'name'         => $name,            
                'created_by'    => $user_id,
            );
            $insertBlock = $this->OuthModel->insertQuery('roles', $saveArr);
            $this->session->set_flashdata('success', 'Record succesfully added.');
            redirect(base_url() . 'admin/role-list', 'refresh');
        } else if ($operation == 'edit') {            
            $updateArr = array(
                'name'         => $name,               
            );

            $update_ticket = $this->OuthModel->UpdateQuery('roles', $updateArr, 'id', $id);
            $this->session->set_flashdata('success', 'Record succesfully updated.');
            redirect(base_url() . 'admin/role-list', 'refresh');
        }

        $resp_arr['result'] = (object) $data;
        if ($this->input->post('view_type') == '') {
            $this->load->view("admin/role/role-edit", $data);
        } else {
            header("Content-Type: application/json");
            $ret = json_encode($resp_arr);
            echo $ret;
            exit;
        }
    }

    public function rolePermission()
    {
        if (!get_permission('ROLE', 'is_view')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        $resp_arr            = array();
        $data                = array();
        $results             = array();
        $status              = '';
        $title_head          = 'Role Permission';
        $data['title_head']  = $title_head;
        $role_id = $this->OuthModel->Encryptor('decrypt',$this->uri->segment(3));
        $data['role_id'] = $role_id;
        $data['role_list']   = $this->role_model->roleList($role_id);
        $data['modules']   = $this->role_model->moduleList();        
        $resp_arr['result']  = (object) $data;
        if ($this->input->post('view_type') == '') {
            $this->load->view("admin/role/role-permission", $data);
        } else {
            header("Content-Type: application/json");
            $ret = json_encode($resp_arr);
            echo $ret;
            exit;
        }
    }

    public function addEditPermission()
    {

        if ( (!get_permission('ROLE', 'is_edit')) and (!get_permission('ROLE', 'is_add'))){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }

        $role_id = $this->input->post('role_id');
        $privileges = $this->input->post('privileges');
        if (isset($_POST['save'])) {
            $role_id = $this->input->post('role_id');
            $privileges = $this->input->post('privileges');
            foreach ($privileges as $key => $value) {
                $is_add     = (isset($value['add']) ? 1 : 0);
                $is_edit    = (isset($value['edit']) ? 1 : 0);
                $is_view    = (isset($value['view']) ? 1 : 0);
                $is_delete  = (isset($value['delete']) ? 1 : 0);
                $arrayData  = array(
                    'role_id'       => $role_id,
                    'permission_id' => $key,
                    'is_add'        => $is_add,
                    'is_edit'       => $is_edit,
                    'is_view'       => $is_view,
                    'is_delete'     => $is_delete,
                );
                $exist_privileges = $this->db->select('id')->limit(1)->where(array('role_id' => $role_id, 'permission_id' => $key))->get('staff_privileges')->num_rows();
                if ($exist_privileges > 0) {
                    $this->db->update('staff_privileges', $arrayData, array('role_id' => $role_id, 'permission_id' => $key));
                } else {
                    $this->db->insert('staff_privileges', $arrayData);
                }
            }
            $this->session->set_flashdata('success', 'Record succesfully updated.');
            redirect(base_url('admin/role-permission/' . $this->OuthModel->Encryptor('encrypt',$role_id)));
        }
    }

    public function sharingRules(){
        if (!get_permission('SHARINGRULES', 'is_view')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        $resp_arr            = array();
        $data                = array();
        $results             = array();
        $status              = '';
        $title_head          = 'Sharing Roles';
        $data['title_head']  = $title_head;
        $role_id = $this->OuthModel->Encryptor('decrypt',$this->uri->segment(3));
        $data['role_id'] = $role_id;
        $data['role_user']   = $this->role_model->roleToUser();
        $resp_arr['result']  = (object) $data;
        if ($this->input->post('view_type') == '') {
            $this->load->view("admin/role/sharing-rules", $data);
        } else {
            header("Content-Type: application/json");
            $ret = json_encode($resp_arr);
            echo $ret;
            exit;
        }
    }

    public function sharingRulesEdit(){
        if ( (!get_permission('SHARINGRULES', 'is_edit')) and (!get_permission('SHARINGRULES', 'is_add'))){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        $resp_arr            = array();
        $data                = array();
        $results             = array();
        $status              = '';
        $title_head          = 'Sharing Roles Edit';
        $data['title_head']  = $title_head;
        $user_id = $this->OuthModel->Encryptor('decrypt',$this->uri->segment(3));
        $data['user_id'] = $user_id;
        $data['role_user']   = $this->role_model->roleToUser($user_id);
        $resp_arr['result']  = (object) $data;
        if ($this->input->post('view_type') == '') {
            $this->load->view("admin/role/sharing-rule-edit", $data);
        } else {
            header("Content-Type: application/json");
            $ret = json_encode($resp_arr);
            echo $ret;
            exit;
        }
    }

    public function sharingRulesUpdate()
    {
        if ( (!get_permission('SHARINGRULES', 'is_edit')) and (!get_permission('SHARINGRULES', 'is_add'))){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }        
        $resp_arr           = array();
        $data               = array();
        $results            = array();
        $status             = '';
        $title_head         = 'Edit Role Update';
        $data['title_head'] = $title_head;
         
        // echo '<pre>';    
        // print_r($_POST); die;
        $role_id        = $this->input->post('role_id');
        $id             = $this->OuthModel->Encryptor('decrypt',$this->input->post('id'));
        $operation      = $this->input->post('operation');
        if ($operation == 'add') {
            $saveArr = array(
                'name'         => $name,            
                'created_by'    => $user_id,
            );
            //$insertBlock = $this->OuthModel->insertQuery('roles', $saveArr);
            $this->session->set_flashdata('success', 'Record succesfully added.');
            redirect(base_url() . 'admin/role-list', 'refresh');
        } else if ($operation == 'edit') {
            $updateArr = array(
                'role'         => $role_id,               
            );
            $update_ticket = $this->OuthModel->UpdateQuery('users', $updateArr, 'user_id', $id);
            $this->session->set_flashdata('success', 'Record succesfully updated.');
            redirect(base_url() . 'admin/sharing-rules', 'refresh');
        }
    }

}