<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Role_model extends CI_Model
{
    public function roleList($id = '')
    {
        $data    = array();
        //$user_id = $this->session->userdata('support_id');
        $this->db->select('*');
        $this->db->from('roles');
        //$this->db->where('is_deleted', '0');
        if ($id != '') {
            $this->db->where('id', $id);
        }       
        $query  = $this->db->get();
        $result = $query->result_array();
        // echo $this->db->last_query(); die;
        return $result;
    }

    public function moduleList($id = '')
    {
        $data    = array();
        //$user_id = $this->session->userdata('support_id');
        $this->db->select('*');
        $this->db->from('tab_parent');
        //$this->db->where('is_deleted', '0');
        if ($id != '') {
            $this->db->where('id', $id);
        }
        $this->db->where('status','1');
        $query  = $this->db->get();
        $result = $query->result_array();
        // echo $this->db->last_query(); die;
        return $result;
    }

    public function check_permissions($module_id = '', $role_id = '')
    {
        $sql = "SELECT tab.*, staff_privileges.id as staff_privileges_id,staff_privileges.is_add,staff_privileges.is_edit,staff_privileges.is_view,staff_privileges.is_delete FROM tab LEFT JOIN staff_privileges ON staff_privileges.permission_id = tab.tabid and staff_privileges.role_id = " . $this->db->escape($role_id) . " WHERE tab.parent = " . $this->db->escape($module_id) . " and tab.status='1' ORDER BY tab.tabid ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function roleToUser($user_id =''){
        $this->db->select("`t1`.`user_id`,`t1`.`email`,`t1`.`user_type`,`t2`.`name` AS role_name,`t2`.`id` AS `role_id`,`t2`.`is_system`,CONCAT_WS(' ',`t1`.`firstname`,`t1`.`lastname`) AS user_name,t3.accounttype AS userType");
        $this->db->from('users t1');
        $this->db->join('roles t2','t1.role = t2.id','left');
        $this->db->join('accounttype t3','t1.user_type = t3.user_type','left');;
        if ($user_id != '') {
            $this->db->where('t1.user_id', $user_id);
        }
        $remove = array('NU', 'BU');
        $this->db->where_not_in('t1.user_type', $remove );
        $query  = $this->db->get();
        $result = $query->result_array();
        // echo $this->db->last_query(); die;
        return $result;
    }
}

?>