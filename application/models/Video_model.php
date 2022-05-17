<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Category_model class.
 * 
 * @extends CI_Model
 */
class Video_model extends CI_Model
{
    public function __construct()
    {		
		parent::__construct();
    }

    public function getVideosList()
    {
        $this->db->select('*');
        $this->db->from('video_info');

        $query  =   $this->db->get();
        /*$query = $this->db->last_query();
        echo $query; die();*/
        $row    =   $query->num_rows();
        if ($row > 0)
        {           
            $row    =   $query->result();
            return $row;
        }
        else
        {
            return $row;
        }
    }

    public function getCastCrewList()
    {
        $query  =   $this->db->get_where('cast_crew', array('status' => 1));
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

    public function getVideoTags()
    {
        $query  =   $this->db->get_where('video_tag_defination', array('status' => 1));
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
    
    public function getParentCategory($id)
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('`status`', 1);
        $this->db->where('`parent_cat_id`', 0);
        /*if($id != 0){
            $this->db->where_not_in('parent_cat_id', $id);
        }*/

        $query  =   $this->db->get();
        /*$query = $this->db->last_query();
        echo $query; die();*/
        $row    =   $query->num_rows();
        if ($row > 0)
        {           
            $row    =   $query->result();
            return $row;
        }
        else
        {
            return $row;
        }
    }

    public function getChildCategory($id)
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('`status`', 1);
        if($id == 0){
            $this->db->where_not_in('parent_cat_id', $id);
        }

        $query  =   $this->db->get();
        /*$query = $this->db->last_query();
        echo $query; die();*/
        $row    =   $query->num_rows();
        if ($row > 0)
        {           
            $row    =   $query->result();
            return $row;
        }
        else
        {
            return $row;
        }
    }

    public function insertcategory($data)
    {
        $this->db->insert('categories', $data);
        return $this->db->insert_id();
    }

    public function insert_video($data)
    {
        $this->db->insert('video_info', $data);
        return $this->db->insert_id();
    }
	
	public function insert_series_video($data)
    {
        $this->db->insert('video_web_series', $data);
        return $this->db->insert_id();
    }

    public function insertcast_crew($data)
    {
        $this->db->insert('video_cast_crew', $data);
        return $this->db->insert_id();
    }

    public function insert_video_tag($data)
    {
        $this->db->insert('video_tag', $data);
        return $this->db->insert_id();
    }

    public function insert_resolution($data)
    {
        $this->db->insert('video_upload_resolution_info', $data);
        return $this->db->insert_id();
    }

    public function insert_category_video($data)
    {
        $this->db->insert('video_category', $data);
        return $this->db->insert_id();
    }  

    public function editVideo($id)
    {
        $query  =   $this->db->get_where('video_info', array('video_id' => $id));
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
	
	public function video_series_details_by_id($id)
    {
        $query  =   $this->db->get_where('video_web_series', array('vid_web_id' => $id));
        $row    =   $query->num_rows();
        if ($row > 0)
        {
            $row        =  $query->row();
            return  $row;            
        }
        else
        {
            return $row;
        }
    }   

    public function editVideoCastCrew($id)
    {
        //$query  =   $this->db->get_where('video_cast_crew', array('video_id' => $id));
        $this->db->select('`cast_crews_id`');
        $this->db->from('video_cast_crew');
        $this->db->where('`video_id`', $id);
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

    public function editVideoCategory($id)
    {
        //$query  =   $this->db->get_where('video_category', array('video_id' => $id));
        $this->db->select('`category_id`');
        $this->db->from('video_category');
        $this->db->where('`video_id`', $id);
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

    public function editVideoTags($id)
    {
        //$query  =   $this->db->get_where('video_tag', array('video_id' => $id));
        $this->db->select('`tag_id`');
        $this->db->from('video_tag');
        $this->db->where('`video_id`', $id);
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

    public function editVideoResolution($id)
    {
        $this->db->select('`trailer_video_resize`,`main_video_resize`');
        $this->db->from('video_upload_resolution_info');
        $this->db->where('`video_id`', $id);
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
	
	public function getSeriesVideoResolution($video_id,$series_id)
    {
        $this->db->select('`trailer_video_resize`,`main_video_resize`');
        $this->db->from('video_upload_resolution_info');
        $this->db->where('`video_id`', $video_id);
		$this->db->where('`series_id`', $series_id);
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

    public function update_video($id, $data)
    {
        $this->db->set($data);
        $this->db->where('video_id',$id);
        $this->db->update('video_info',$data);        
        /*$query = $this->db->last_query();
        echo $query;*/        
        return $this->db->affected_rows();
    }
	
	public function update_series_video($video_id,$series_id, $data)
    {
        $this->db->set($data);
        $this->db->where('video_id',$video_id);
		$this->db->where('vid_web_id',$series_id);
        $this->db->update('video_web_series',$data);        
        /*$query = $this->db->last_query();
        echo $query;*/        
        //return $this->db->affected_rows();
		return true;
    }

    public function getReplacedSingleImgName($id)
    {
        $this->db->select('`category_image`');
        $this->db->from('categories');
        $this->db->where('`cat_id`', $id);
        $query  =   $this->db->get();
        
        $row    =   $query->num_rows();
        if ($row > 0)
        {           
            $row    =   $query->result();
            $row    =   $row[0]->category_image;
            return $row;
        }
        else
        {
            return $row;
        }
    }

    public function updateCategory($id, $data)
    {
        $this->db->set($data);
        $this->db->where('cat_id',$id);
        $this->db->update('categories',$data);
        
        /*$query = $this->db->last_query();
        echo $query;*/
        
        return $this->db->affected_rows();
    }

    public function is_parent_category($id)
    {
        $query  =   $this->db->get_where('categories', array('parent_cat_id' => $id));
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

    public function get_trailer_file_name($id)
    {
        $this->db->select('`trailer_video`');
        $this->db->from('video_info');
        $this->db->where('`video_id`', $id);
        $query  =   $this->db->get();
        
        $row    =   $query->num_rows();
        if ($row > 0)
        {           
            $row    =   $query->result();
            $row    =   $row[0]->trailer_video;
            return $row;
        }
        else
        {
            return $row;
        }
    }

    public function get_video_file_name($id)
    {
        $this->db->select('`main_video`');
        $this->db->from('video_info');
        $this->db->where('`video_id`', $id);
        $query  =   $this->db->get();
        
        $row    =   $query->num_rows();
        if ($row > 0)
        {           
            $row    =   $query->result();
            $row    =   $row[0]->main_video;
            return $row;
        }
        else
        {
            return $row;
        }
    }
	
	public function get_series_video_file_name($id)
    {
        $this->db->select('`series_video_name`');
        $this->db->from('video_web_series');
        $this->db->where('`vid_web_id`', $id);
        $query  =   $this->db->get();
        
        $row    =   $query->num_rows();
        if ($row > 0)
        {           
            $row    =   $query->result();
            $row    =   $row[0]->series_video_name;
            return $row;
        }
        else
        {
            return $row;
        }
    }

    public function get_video_directory($id)
    {
        $this->db->select('`video_directory_path`');
        $this->db->from('video_info');
        $this->db->where('`video_id`', $id);
        $query  =   $this->db->get();
        
        $row    =   $query->num_rows();
        if ($row > 0)
        {           
            $row    =   $query->result();
            $row    =   $row[0]->video_directory_path;
            return $row;
        }
        else
        {
            return $row;
        }
    }

    public function delete_uncheck_video($data){
        $this->db->delete('video_upload_resolution_info', $data);      
        return $this->db->affected_rows();
    }

    public function delete_cast_crew($id)
    {
        $this->db->delete('video_cast_crew', array('video_id' => $id));
        return $this->db->affected_rows();
    }

    public function delete_video_tag($id)
    {
        $this->db->delete('video_tag', array('video_id' => $id));
        return $this->db->affected_rows();
    }

    public function delete_category_video($id)
    {
        $this->db->delete('video_category', array('video_id' => $id));
        return $this->db->affected_rows();
    }

    public function delete_video($id)
    {
        $this->db->delete('video_cast_crew', array('video_id' => $id));
        $this->db->delete('video_tag', array('video_id' => $id));
        $this->db->delete('video_category', array('video_id' => $id));
        $this->db->delete('video_upload_resolution_info', array('video_id' => $id));
        $this->db->delete('video_info', array('video_id' => $id));
        return $this->db->affected_rows();
    }
	
	public function delete_video_series($series_id)
    {
        $this->db->delete('video_upload_resolution_info', array('series_id' => $series_id));
        $this->db->delete('video_web_series', array('vid_web_id' => $series_id));
        return $this->db->affected_rows();
    }
	
	/*************************** FOR SERIES VIDEO ***************************/
	public function getVideoSeriesList($id)
    {
        $this->db->select('*');
        $this->db->from('video_web_series');
        $this->db->where('`video_id`', $id);
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
	
	public function getVideoIdBySeriesId($id)
    {
        $this->db->select('video_id,series_video_name');
        $this->db->from('video_web_series');
        $this->db->where('`vid_web_id`', $id);
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
}