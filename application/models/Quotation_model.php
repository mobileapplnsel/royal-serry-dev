<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Quotation_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /********************************************branch Module********************************************/
    public function getNormalBusinessUserList()
    {
        $this->db->select('u.user_id, u.firstname, u.lastname, u.email');
        $this->db->from('users u');
        $this->db->where('`user_type`', "NU");
        $this->db->or_where('`user_type`', "BU");
        $query = $this->db->get();
        //$query = $this->db->last_query();
        //echo $query;die();
        $row = $query->num_rows();
        if ($row > 0) {
            $row = $query->result();
            return $row;
        } else {
            return $row;
        }
    }

    public function addNewdocument($data)
    {
        $this->db->insert('document', $data);
        return $this->db->insert_id();
    }

    public function upadte_quotation_status_closed($quotation_id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $quotation_id);
        $this->db->update('quotation_master', $data);
        return $this->db->affected_rows();
    }

    public function getQuotationList($from_date = '', $to_date = '')
    {

        //$query = $this->db->get('branch');
        //$query  =   $this->db->get_where('document', array('is_deleted' => '0'));
        $where = "(qm.quote_type='0' OR qm.quote_type='2')";
        $this->db->select('qm.*, u.firstname, u.lastname');
        $this->db->from('quotation_master qm');
        $this->db->where('qm.parent_id', "0");
        $this->db->where($where);
        if ($from_date != '') {
            $this->db->where('qm.created_date >=', date('Y-m-d', strtotime($from_date)));
        }
        if ($to_date != '') {
            $this->db->where('qm.created_date <=', date('Y-m-d', strtotime($to_date)));
        }
        $this->db->join('users u', 'qm.customer_id = u.user_id');
        $this->db->order_by("qm.id", "DESC");
        $query  =   $this->db->get();

        //echo $this->db->last_query();
        //die();
        $row = $query->num_rows();
        if ($row > 0) {
            //return true;            
            $row = $query->result();
            //echo $query = $this->db->last_query();
            return $row;
        } else {
            //return false;
            //echo $query = $this->db->last_query();
            return $row;
        }
    }


    public function getQuotationListByBranch($from_date = '', $to_date = '', $branch_id = null)
    {

        //$query = $this->db->get('branch');
        //$query  =   $this->db->get_where('document', array('is_deleted' => '0'));
        $where = "(qm.quote_type='0' OR qm.quote_type='2')";
        $this->db->select('qm.*, u.firstname, u.lastname');
        $this->db->from('quotation_master qm');
        $this->db->join('users u', 'qm.customer_id = u.user_id');
        $this->db->join('quotation_req_branch_tagging', 'qm.id = quotation_req_branch_tagging.quotation_id');
        $this->db->where('qm.parent_id', "0");
        $this->db->where($where);

        if ($from_date != '') {
            $this->db->where('qm.created_date >=', date('Y-m-d', strtotime($from_date)));
        }
        if ($to_date != '') {
            $this->db->where('qm.created_date <=', date('Y-m-d', strtotime($to_date)));
        }

        if($branch_id != null){
            $whereBr = "(quotation_req_branch_tagging.from_branch_id=$branch_id OR quotation_req_branch_tagging.to_branch_id=$branch_id)";
            $this->db->where($whereBr);
        }
        

        $this->db->order_by("qm.id", "DESC");
        $query  =   $this->db->get();

        //echo $this->db->last_query();
        //die();
        $row = $query->num_rows();
        if ($row > 0) {
            //return true;            
            $row = $query->result();
            //echo $query = $this->db->last_query();
            return $row;
        } else {
            //return false;
            //echo $query = $this->db->last_query();
            return $row;
        }
    }

    public function checkExistDocument($name)
    {
        $query  =   $this->db->get_where('document', array('name' => $name));
        $row = $query->num_rows();
        if ($row > 0) {
            //return true;            
            // $row = $query->result();
            return $row;
        } else {
            //return false;
            return $row;
        }
    }

    public function editDocument($id)
    {
        $query  =   $this->db->get_where('document', array('document_id' => $id));
        $row    =   $query->num_rows();
        if ($row > 0) {
            //return true;
            //$row['id']  =   $id;
            $row        =   $query->result();
            return  $row;
        } else {
            //return false;
            return $row;
        }
    }

    public function updateDocument($id, $data)
    {
        $this->db->set($data);
        $this->db->where('document_id', $id);
        $this->db->update('document', $data);
        return $this->db->affected_rows();
    }

    public function deleteQuotation($id)
    {
        $this->db->delete('quotation_master', array('id' => $id));
        return $this->db->affected_rows();
    }

    public function deleteQuotationFromAddress($id)
    {
        $this->db->delete('quotation_from_address', array('quotation_id' => $id));
        return $this->db->affected_rows();
    }

    public function deleteQuotationToAddress($id)
    {
        $this->db->delete('quotation_to_address', array('quotation_id' => $id));
        return $this->db->affected_rows();
    }

    public function deleteQuotationItems($id)
    {
        $this->db->delete('quotation_item_details', array('quotation_id' => $id));
        return $this->db->affected_rows();
    }

    public function getdocumentCategoriesList()
    {
        $this->db->select('c.*');
        $this->db->from('document_package_categories c');
        $this->db->where('type', '1');
        $this->db->where('status', '1');
        $query  =   $this->db->get();
        //$query = $this->db->last_query();
        //echo $query;
        //die();
        $row = $query->num_rows();
        if ($row > 0) {
            //return true;            
            $row = $query->result();

            foreach ($row as $key => $res) {
                $pcatid = $row[$key]->parent_cat_id;
                if ($pcatid != 0) {
                    $this->db->select('category_name');
                    $this->db->from('document_package_categories');
                    $this->db->where('cat_id', $pcatid);
                    $querycheck = $this->db->get();
                    $resultrow = $querycheck->row();
                    $row[$key]->parent_cat_name = $resultrow->category_name;
                } else {
                    $row[$key]->parent_cat_name = '';
                }
            }
            return $row;
        } else {
            //return false;
            return $row;
        }
    }

    public function getStateListbyOption($countryId)
    {
        $query  =   $this->db->get_where('states_master', array('country_id' => $countryId));

        $row = $query->num_rows();
        if ($row > 0) {
            $output = '<option value="">Select State</option>';
            foreach ($query->result() as $row) {
                $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
            }
            return $output;
        } else {
            return $row;
        }
    }

    public function getCityListbyOption($stateId)
    {
        $query  =   $this->db->get_where('cities_master', array('state_id' => $stateId));

        $row = $query->num_rows();
        if ($row > 0) {
            $output = '<option value="">Select City</option>';
            foreach ($query->result() as $row) {
                $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
            }
            return $output;
        } else {
            return $row;
        }
    }


    /********************************VIEW QUOTE ****************************************/

    public function quotationDetails($id)
    {
        $this->db->select('*');
        $this->db->from('quotation_master');
        if ($id != '') {
            $this->db->where('id', $id);
        }
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function quotationFromDetails($id)
    {
        /*$this->db->select('*');
        $this->db->from('quotation_from_address');
        if ($id != '') {
            $this->db->where('quotation_id', $id);
        } */

        $this->db->select('sfa.*, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
        $this->db->from('quotation_from_address sfa');
        $this->db->where('sfa.quotation_id',  $id);
        $this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
        $this->db->join('states_master sm', 'sfa.state = sm.id', 'left');
        $this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');

        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function quotationToDetails($id)
    {
        /*$this->db->select('*');
        $this->db->from('quotation_to_address');
        if ($id != '') {
            $this->db->where('quotation_id', $id);
        }*/

        $this->db->select('sta.*, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
        $this->db->from('quotation_to_address sta');
        $this->db->where('sta.quotation_id',  $id);
        $this->db->join('countries_master cm', 'sta.country = cm.id', 'left');
        $this->db->join('states_master sm', 'sta.state = sm.id', 'left');
        $this->db->join('cities_master ctm', 'sta.city = ctm.id', 'left');

        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function quotationItemDetails($id)
    {
        $this->db->select('`view_item_details`.*, `document_package_categories`.`category_name` AS subcategory_name, `quotation_charges`.road,  `quotation_charges`.rail,  `quotation_charges`.air,  `quotation_charges`.ship');
        $this->db->join('`quotation_charges`', '`view_item_details`.`id` = `quotation_charges`.`quotation_item_details_id`', 'LEFT');
        $this->db->join('`document_package_categories`', '`view_item_details`.`subcategory_id` = `document_package_categories`.`cat_id`', 'LEFT');
        $this->db->where('`view_item_details`.`quotation_id`', $id);
        //$this->db->where('is_deleted', '0');
        $query_tb = $this->db->get('`view_item_details`');
        // echo $this->db->last_query();die;
        if ($query_tb) {
            return $query_tb->result_array();
        } else {
            return false;
        }
    }


    public function getBranchUser($params = null)
    {
        $this->db->select('branch_id');
        $this->db->from('branch_users');
        if ($params != null) {
            $this->db->where($params);
        }
        //$this->db->group_by('t2.status_id');     
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        if ($query) {
            return $query->row_array();
        } else {
            return false;
        }
    }
}
