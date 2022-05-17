<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class News_model extends CI_Model
{
    public function __construct()
    {		
        parent::__construct();
    }
    
    public function insertnews($data)
    {
        $this->db->insert('news', $data);
        return $this->db->insert_id();
    }

    public function getNewsList()
    {
        $query = $this->db->get('news');
        
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

    public function getNews($param = null, $many = FALSE)
    {
        $this->db->select('*');
        if($param != null){
            $this->db->where($param);
        }
       
        //$this->db->where('is_deleted', '0');
        $query_tb = $this->db->get('`news`');
        // echo $this->db->last_query();die;

        if($many == TRUE){
            if ($query_tb) {
                return $query_tb->result_array();
            } else {
                return false;
            }
        }else{
            if ($query_tb) {
                return $query_tb->row_array();
            } else {
                return false;
            }
        }

    }

    public function editNews($id)
    {
        $query  =   $this->db->get_where('news', array('id' => $id));
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

    public function getReplacedSingleImgName($id)
    {
        $this->db->select('`image`');
        $this->db->from('news');
        $this->db->where('`id`', $id);
        $query  =   $this->db->get();
        
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            //return true;            
            $row    =   $query->result();
            $row    =   $row[0]->image;
            return $row;
        }
        else
        {
            //return false;
            return $row;
        }
    }

    public function updateNews($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('news',$data);
        
        /*$query = $this->db->last_query();
        echo $query;*/
        
        return $this->db->affected_rows();
    }

    public function deleteNews($id)
    {
        $this->db->delete('news', array('id' => $id));      
        return $this->db->affected_rows();
    }
	
	public function getNewsCategoriesList()
    {
		$this->db->select('*');
        $this->db->from('news_categories');
		$this->db->where('status', '1');
        $query  =   $this->db->get();
        $row = $query->num_rows();
        if ($row > 0)
        {
            $row = $query->result();
            return $row;            
        }
        else
        {
            return $row;
        }
    }

}