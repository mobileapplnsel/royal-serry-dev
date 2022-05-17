<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Subscription_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    /********************************************Subscription Module********************************************/
    
    public function addNewSubscription($data)
    {
        $this->db->insert('subscription_packages', $data);
        return $this->db->insert_id();
    }

    public function getSubscriptionList()
    {
        $query = $this->db->get('subscription_packages');
        
        //$query  =   $this->db->get();
        //$query = $this->db->last_query();
        //echo $query;
        //die();
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row = $query->result();
            return $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }

    public function editSubscription($id)
    {
        $query  =   $this->db->get_where('subscription_packages', array('subscription_id' => $id));
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            //return true;
            //$row['id']  =   $id;
            $row        =   $query->result();
            return  $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }
    
    public function updateSubscription($id, $data)
    {
        $this->db->set($data);
        $this->db->where('subscription_id',$id);
        $this->db->update('subscription_packages',$data);
        
        /*$query = $this->db->last_query();
        echo $query;*/
        
        return $this->db->affected_rows();
    }

    public function deleteSubscription($id)
    {
        $this->db->delete('subscription_packages', array('subscription_id' => $id));
        //$this->db->delete('international_days_iternary', array('package_id' => $id));
        //$this->db->delete('international_related_images', array('package_id' => $id));        
        return $this->db->affected_rows();
    }

    /********************************************Subscription Module********************************************/
    
    public function editPackageMultiImg($id)
    {
        $this->db->select('`int_img_id`, `file_name`');
        $this->db->from('international_related_images');
        $this->db->where('package_id', $id);
        $query  =   $this->db->get();
        
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            //return true;
            $row        =   $query->result();
            return  $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }
    
    public function addMultiplePackagesImages($data)
    {
        foreach($data as $infoData){
            $this->db->insert('international_related_images', $infoData);
        }
        /*$this->db->insert('package_related_images', $data);*/
        return $this->db->insert_id();
        //die();
    }
    
    public function addDomesticDaysIternary($data)
    {
        foreach($data as $infoData){
            $this->db->insert('international_days_iternary', $infoData);
        }
        return $this->db->insert_id();
    }
    
    public function editPackageDaysIternary($id)
    {
        $this->db->select('*');
        $this->db->from('international_days_iternary');
        $this->db->where('package_id', $id);
        $query  =   $this->db->get();
        
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            $row        =   $query->result();
            return  $row;            
        }
        else
        {
            return $row;
        }
    }   
    
    public function updateIternaryDays($data)
    {
        foreach($data as $existingDays){
            $data = ['days' => $existingDays['days']];
            $this->db->set($data);
            $this->db->where('inerItrNo', $existingDays['inerItrNo']);
            $this->db->update('international_days_iternary', $data);
        }
    }
    
    public function getSelectedSingleMultiImgName($id)
    {
        $this->db->select('`file_name`');
        $this->db->from('international_related_images');
        $this->db->where('`int_img_id`', $id);
        $query  =   $this->db->get();
        
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row    =   $query->result();
            $row    =   $row[0]->file_name;
            return $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }
    
    public function getReplacedSingleImgName($id)
    {
        $this->db->select('`package_image`');
        $this->db->from('international_package');
        $this->db->where('`id`', $id);
        $query  =   $this->db->get();
        
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row    =   $query->result();
            $row    =   $row[0]->package_image;
            return $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }
    
    public function deleteSingleDay($id)
    {
        $this->db->delete('international_days_iternary', array('inerItrNo' => $id));
        return $this->db->affected_rows();
    }
    
    public function deleteMultipleSingleImg($id)
    {
        $this->db->delete('international_related_images', array('int_img_id' => $id));
        return $this->db->affected_rows();
    }
    
    public function deletePackage($id)
    {
        $this->db->delete('international_package', array('id' => $id));
        $this->db->delete('international_days_iternary', array('package_id' => $id));
        $this->db->delete('international_related_images', array('package_id' => $id));        
        return $this->db->affected_rows();
    }    
    
    /********************************************Tourism Module********************************************/
    
    public function getTourismList()
    {
        //$query = $this->db->get('tourisms', ['tourCategory' => '1']);
        $this->db->select('*');
        $this->db->from('tourisms');
        $this->db->where('tourCategory', 1);
        $query  =   $this->db->get();
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row = $query->result();
            return $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }
    
    /********************************************Include Module********************************************/
    
    public function getIncludeList()
    {
        //$query = $this->db->get('tourisms', ['tourCategory' => '0']);
        
        $this->db->select('*');
        $this->db->from('package_features');
        $this->db->where('featureMode', 1);
        $query  =   $this->db->get();
        
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row = $query->result();
            return $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }
    
    /********************************************Exclude Module********************************************/
    
    public function getExcludeList()
    {
        //$query = $this->db->get('tourisms', ['tourCategory' => '0']);
        
        $this->db->select('*');
        $this->db->from('package_features');
        $this->db->where('featureMode', 0);
        $query  =   $this->db->get();
        
        $row = $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row = $query->result();
            return $row;            
        }
        else
        {
            //return false;
            return $row;
        }
    }
}