<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
        $this->load->library(array('form_validation','encryption','session','javascript'));
        $this->load->helper(array('url', 'form', 'date'));
        $this->load->helper('admin_helper');
        $this->encryption->create_key(16);
        $this->load->model('user_model');
		$this->load->model('order_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        $this->load->model('branch_model');
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   Users Functions   ********************************************/

    public function index($page = 'list-users')
    {
		if (!get_permission('NORMALUSER', 'is_view')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['usersList']     =   $this->user_model->getUsersList();
                $data['title']              =   ucfirst($page);
                /*echo '<pre>';
                print_r($data);
                die();*/
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	public function business_users_list($page = 'business-list-users')
    {
		if (!get_permission('BUSINESSUSER', 'is_view')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $data['usersList']     =   $this->user_model->getBusinessUsersList();
                $data['title']              =   ucfirst($page);
                /*echo '<pre>';
                print_r($data);
                die();*/
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	public function pdboyholidaylist($page = 'users-holiday-list')
    {
		if (!get_permission('HOLIDAYLIST', 'is_view')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                //$data['usersList']     =   $this->user_model->getBusinessUsersList();
                $data['title']              =   ucfirst($page);
                /*echo '<pre>';
                print_r($data);
                die();*/
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	public function branch_users_list($page = 'list-users-branch')
    {
		if (!get_permission('BRANCHUSER', 'is_view')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
				if($this->session->userdata('user_type') == 'MO'){
                	$data['usersList']     =   $this->user_model->getBranchUsersList();
				} else {
					$data['usersList']     =   $this->user_model->getBranchUsersListbyBranch($this->session->userdata('branch_id'));
				}
                $data['title']              =   ucfirst($page);
                /*echo '<pre>';
                print_r($data);
                die();*/
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	public function delivery_users_list($page = 'list-users-delivery')
    {
		if (!get_permission('PDLIST', 'is_view')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
				$branch_id   = $this->input->post('branch_id');
				if($this->session->userdata('user_type') == 'MO'){
                	$data['usersList']     =   $this->user_model->getDeliveryUsersList($branch_id);
				} else {
					$data['usersList']     =   $this->user_model->getDeliveryUsersListbyBranch($this->session->userdata('branch_id'));
				}
                $data['title']              =   ucfirst($page);
				$data['branch_id']          =   $branch_id;
                /*echo '<pre>';
                print_r($data);
                die();*/
				$data['branchList']     =   $this->user_model->getBranchList();
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	public function adduser($page = 'add-user')
    {
		if (!get_permission('ADDUSER', 'is_add')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
			{
				show_404();
			}
			else{
				$data['title'] = ucfirst($page);
				if($this->session->userdata('user_type') == 'MO'){
					$data['branchList']     =   $this->user_model->getBranchList();
				} else {
					$data['branchList']     =   $this->user_model->getBranchListbyBranchID($this->session->userdata('branch_id'));
				}
				$this->load->view('admin/users/' . $page, $data);
			}
		}
    }
	
	public function insertuser()
    {
        $this->form_validation->set_rules('firstname', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('telephone', 'Telephone', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('subscription/addSubscription');
            echo redirectPreviousPage();
        }
        else
        {
            $data   =   array();
			$user_type		= $this->input->post('user_type');
			$firstname		= $this->input->post('firstname');		
			$lastname		= $this->input->post('lastname');
			$country_code	= $this->input->post('country_code');
			$telephone		= $this->input->post('telephone');
			$email			= $this->input->post('email');
			
			$branch_id		= $this->input->post('branch_id');
			$companyname	= $this->input->post('companyname');
			$companydetails	= $this->input->post('companydetails');
			
			$address		= $this->input->post('address');
			$country		= $this->input->post('country');
			$state			= $this->input->post('state');
			$city			= $this->input->post('city');
			$zip			= $this->input->post('zip');
			$online_status	= $this->input->post('online_status');
			$status			= $this->input->post('status');
			$password 		= md5('royal@12345');
			
			$checkAvailablity       =   $this->user_model->checkExistUser($email);
			
            if($checkAvailablity>0){
				$this->session->set_flashdata('userType', $user_type);
				$this->session->set_flashdata('firstname', $firstname);
				$this->session->set_flashdata('lastname', $lastname);
				$this->session->set_flashdata('telephone', $telephone);
				$this->session->set_flashdata('email', $email);
				$this->session->set_flashdata('address', $address);
				$this->session->set_flashdata('zip', $zip);
                $this->session->set_flashdata('error', 'User Email Already exists!');
                echo redirectPreviousPage();
                exit;
            }
			$checkAvailablityPhone       =   $this->user_model->checkExistUserTelephone($telephone);
			if($checkAvailablityPhone>0){
				$this->session->set_flashdata('userType', $user_type);
				$this->session->set_flashdata('firstname', $firstname);
				$this->session->set_flashdata('lastname', $lastname);
				$this->session->set_flashdata('telephone', $telephone);
				$this->session->set_flashdata('email', $email);
				$this->session->set_flashdata('address', $address);
				$this->session->set_flashdata('zip', $zip);
                $this->session->set_flashdata('error', 'Telephone Number Already exists!');
                echo redirectPreviousPage();
                exit;
            }
			if($user_type=='NU'){
				$data=array(
						'user_type'=>$user_type,
						'firstname'=>$firstname,
						'lastname'=>$lastname,
						'country_code'=>$country_code,
						'telephone'=>$telephone,
						'email'=>$email,
						'address'=>$address,
						'country'=>$country,
						'state'=>$state,
						'city'=>$city,
						'zip'=>$zip,
						'online_status'=>$online_status,
						'status'=>$status,
						'password'=>$password
					);

			}
			if($user_type=='BU'){
				$data=array(
						'user_type'=>$user_type,
						'firstname'=>$firstname,
						'lastname'=>$lastname,
						'country_code'=>$country_code,
						'telephone'=>$telephone,
						'companyname'=>$companyname,
						'companydetails'=>$companydetails,
						'email'=>$email,
						'address'=>$address,
						'country'=>$country,
						'state'=>$state,
						'city'=>$city,
						'zip'=>$zip,
						'online_status'=>$online_status,
						'status'=>$status,
						'password'=>$password
					);

			}
			if($user_type=='PDB'){
				$data=array(
						'user_type'=>$user_type,
						'firstname'=>$firstname,
						'lastname'=>$lastname,
						'country_code'=>$country_code,
						'telephone'=>$telephone,
						'email'=>$email,
						'address'=>$address,
						'country'=>$country,
						'state'=>$state,
						'city'=>$city,
						'zip'=>$zip,
						'online_status'=>$online_status,
						'status'=>$status,
						'password'=>$password
					);

			}
			if($user_type=='BO'){
				$data=array(
						'user_type'=>$user_type,
						'firstname'=>$firstname,
						'lastname'=>$lastname,
						'country_code'=>$country_code,
						'telephone'=>$telephone,
						'email'=>$email,
						'address'=>$address,
						'country'=>$country,
						'state'=>$state,
						'city'=>$city,
						'zip'=>$zip,
						'online_status'=>$online_status,
						'status'=>$status,
						'password'=>$password
					);

			}
			//$postal_code = $data['zip'];
			$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&sensor=false&key=AIzaSyAjVAq71rsWUSruhdpUF62519bXHza50bA";
			$result_string = file_get_contents($url);
			$result = json_decode($result_string, true);
			//print_r($result);
			if(!empty($result['results'])){
				$data['latitude'] = $result['results'][0]['geometry']['location']['lat'];
				$data['longitude'] = $result['results'][0]['geometry']['location']['lng'];
			} else {
				$data['latitude'] = '23.5204';
				$data['longitude'] = '87.3119';
			}
	
			//echo '===>>>'.$checkAvailablity; 
			//print_r($data); die;
            $insertUserID   =   $this->user_model->addNewuser($data);

            if($insertUserID > 0){
				if($user_type=='BO' || $user_type=='PDB'){
					$user_data=array(
						'branch_id'=>$branch_id,
						'user_id'=>$insertUserID
						);
					$this->user_model->adduserToBranch($user_data);
				}
                $this->session->set_flashdata('success', 'User Successfully Added');
				if($user_type=='NU'){
					redirect('admin/users-list');
				} elseif($user_type=='BU'){
					redirect('admin/business-users-list');
				} elseif($user_type=='BO'){
					redirect('admin/branch-users-list');
				} elseif($user_type=='PDB'){
					redirect('admin/pickup-delivery-boy-list');
				} else {
					redirect('admin/users-list');
				}
                //echo redirectPreviousPage();
            }
            else{
                $this->session->set_flashdata('error', 'User cannot added!!');
                echo redirectPreviousPage();
            }
        }
    }
	
	public function editbranchuser($id)
    {
		if (!get_permission('BRANCHUSER', 'is_edit')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        //echo $id;
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
        $data['editUser']   =   $this->user_model->editBranchUser($id);
		$data['branchList']     =   $this->user_model->getBranchList();
        $this->load->view('admin/users/edit-user', $data);
		}
    }
	
	public function edituser($id)
    {
		if (!get_permission('NORMALUSER', 'is_edit')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			$data['editUser']   =   $this->user_model->editUser($id);
			$data['branchList']     =   $this->user_model->getBranchList();
			$this->load->view('admin/users/edit-user', $data);
		}
    }
	
	public function updateUser($id)
    {
        $this->form_validation->set_rules('firstname', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('telephone', 'Telephone', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/edituser/'.$id);
        }
        else
        {
            $data   =   array();
			$user_type		= $this->input->post('user_type');
			$firstname		= $this->input->post('firstname');		
			$lastname		= $this->input->post('lastname');
			$country_code	= $this->input->post('country_code');
			$telephone		= $this->input->post('telephone');
			$email			= $this->input->post('email');
			
			$branch_id		= $this->input->post('branch_id');
			$companyname	= $this->input->post('companyname');
			$companydetails	= $this->input->post('companydetails');
			
			$address		= $this->input->post('address');
			$country		= $this->input->post('country');
			$state			= $this->input->post('state');
			$city			= $this->input->post('city');
			$zip			= $this->input->post('zip');
			$online_status	= $this->input->post('online_status');
			$status			= $this->input->post('status');
			//$password 		= md5('royal@12345');
			
			
			if($user_type=='NU'){
				$data=array(
						'user_type'=>$user_type,
						'firstname'=>$firstname,
						'lastname'=>$lastname,
						'country_code'=>$country_code,
						'telephone'=>$telephone,
						'email'=>$email,
						'address'=>$address,
						'country'=>$country,
						'state'=>$state,
						'city'=>$city,
						'zip'=>$zip,
						'online_status'=>$online_status,
						'status'=>$status
					);

			}
			if($user_type=='BU'){
				$data=array(
						'user_type'=>$user_type,
						'firstname'=>$firstname,
						'lastname'=>$lastname,
						'country_code'=>$country_code,
						'telephone'=>$telephone,
						'companyname'=>$companyname,
						'companydetails'=>$companydetails,
						'email'=>$email,
						'address'=>$address,
						'country'=>$country,
						'state'=>$state,
						'city'=>$city,
						'zip'=>$zip,
						'online_status'=>$online_status,
						'status'=>$status
					);

			}
			if($user_type=='PDB'){
				$data=array(
						'user_type'=>$user_type,
						'firstname'=>$firstname,
						'lastname'=>$lastname,
						'country_code'=>$country_code,
						'telephone'=>$telephone,
						'email'=>$email,
						'address'=>$address,
						'country'=>$country,
						'state'=>$state,
						'city'=>$city,
						'zip'=>$zip,
						'online_status'=>$online_status,
						'status'=>$status
					);

			}
			if($user_type=='BO'){
				$data=array(
						'user_type'=>$user_type,
						'firstname'=>$firstname,
						'lastname'=>$lastname,
						'country_code'=>$country_code,
						'telephone'=>$telephone,
						'email'=>$email,
						'address'=>$address,
						'country'=>$country,
						'state'=>$state,
						'city'=>$city,
						'zip'=>$zip,
						'online_status'=>$online_status,
						'status'=>$status
					);

			}
			
			$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&sensor=false&key=AIzaSyAjVAq71rsWUSruhdpUF62519bXHza50bA";
			$result_string = file_get_contents($url);
			$result = json_decode($result_string, true);
			//print_r($result); die;
			if(!empty($result['results'])){
				$data['latitude'] = $result['results'][0]['geometry']['location']['lat'];
				$data['longitude'] = $result['results'][0]['geometry']['location']['lng'];
			} else {
				$data['latitude'] = '23.5204';
				$data['longitude'] = '87.3119';
			} 
			
			//print_r($data); die;
            $updateUser     		=       $this->user_model->updateUser($id, $data);
			//print_r($updateUser); die;
            if($updateUser == 1 || $updateUser == 0){
				if($user_type=='BO' || $user_type=='PDB'){
					$user_data=array(
						'branch_id'=>$branch_id,
						'user_id'=>$id
						);
						//print_r($user_data); die;
					$this->user_model->deleteuserFromBranch($id);
					$this->user_model->adduserToBranch($user_data);
				}
                $this->session->set_flashdata('success', 'User updated successfully');
				if($user_type=='NU'){
					redirect('admin/users-list');
				} elseif($user_type=='BU'){
					redirect('admin/business-users-list');
				} elseif($user_type=='BO'){
					redirect('admin/branch-users-list');
				} elseif($user_type=='PDB'){
					redirect('admin/pickup-delivery-boy-list');
				} else {
					redirect('admin/users-list');
				}
				
                //return redirect('admin/edituser/'.$id);
				//echo redirectPreviousPage();
            }
            else{
                $this->session->set_flashdata('error', 'User cannot updated!');
                //return redirect('admin/edituser/'.$id);
				echo redirectPreviousPage();
            }
        }
    }
	
	public function deleteUser($id)
    {   
        $deleteUser   =   $this->user_model->deleteUser($id);
		$FromBranchdeleteUser   =   $this->user_model->UserdeleteFromBranch($id);
        
        if($deleteUser == 1 || $FromBranchdeleteUser == 1){
            $this->session->set_flashdata('success', 'User deleted successfully');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'User Cannot be deleted!!!');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
    }
	
	
	
	

    public function addcategory($page = 'add-category')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/categories/' . $page . '.php'))
            {
                show_404();
            }
            else{
                if(!$this->session->userdata('logged_in'))
                {
                    return redirect('admin/login');
                }
                else{
                    $id = 0;
                    $data['parentCategory']     =   $this->category_model->getParentCategory($id);
                    $data['title']              =   ucfirst($page);
                    $this->load->view('admin/categories/' . $page, $data);
                }
            }
        }
    }
	
	public function change_status($id, $status){
		
		if($this->user_model->change_status($id, $status)){
			$this->session->set_flashdata('success', 'Status changed successfully !!!!');
			redirect('admin/users-list');
			exit();
		}
		
	}

    public function insertcategory()
    {
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('category_description', 'Category Description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            // return redirect('categories/addcategories');
            echo redirectPreviousPage();
        }
        else
        {
            $data                           =   [];
            if($this->input->post('parent_cat_id', TRUE)){
                $data['parent_cat_id']      =   $this->input->post('parent_cat_id', TRUE);
            }
            $data['is_series']              =   $this->input->post('is_series', TRUE);
            $data['category_name']          =   $this->input->post('category_name', TRUE);
            $data['status']                 =   $this->input->post('status', TRUE);
            $data['category_description']   =   $this->input->post('category_description', TRUE);
            $data['category_image']         =	time().'-'.$_FILES["category_image"]['name'];

            if(!is_dir('./uploads/category'))
            mkdir('./uploads/category');
            
            $this->load->library('image_lib');
            
            $config['upload_path']       =   './uploads/category/';
            $config['allowed_types']     =   'gif|jpg|png';
            $config['file_name']         =    $data['category_image'];

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('category_image'))
            {
                $error = array('error' => $this->upload->display_errors());

                $this->session->set_flashdata('error', 'Image format not supported');
                //redirect('admin/addresidentialpropertyimages');
                echo redirectPreviousPage();
                exit;
            }
            else{
                
                $image_data = $this->upload->data();
                // Resize image to the given format
                $imageResize =  [
                                    'image_library'   => 'gd2',
                                    'source_image'    =>  $image_data['full_path'],
                                    'maintain_ratio'  =>  TRUE,
                                    'width'           =>  250,
                                    'height'          =>  250,
                                ];
                
                $this->image_lib->clear();
                $this->image_lib->initialize($imageResize);
                $this->image_lib->resize();
                
                $insertCategory   =   $this->category_model->insertcategory($data);

                if($insertCategory > 0){
                    $this->session->set_flashdata('success', 'Category added Successfully');
                    //return redirect('domestic/addpackage');
                    echo redirectPreviousPage();
                    exit;
                }
                else{
                    $this->session->set_flashdata('error', 'Something went wrong');
                    //return redirect('domestic/addpackage');
                    echo redirectPreviousPage();
                    exit;
                }
            }            
        }
    }

    public function editcategory($id)
    {
        $data['parentCategory']     =   $this->category_model->getParentCategory($id);
        $data['editCategory']       =   $this->category_model->editCategory($id);
        /*print_r($data);
        die();*/
        $this->load->view('admin/categories/edit-category', $data);
    }
    
    public function updatecategory($id)
    {
        $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('category_description', 'Category Description', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/editcategory/'.$id);
        }
        else
        {
            $data                           =   [];
            $data['parent_cat_id']          =   $this->input->post('parent_cat_id', TRUE);
            $data['is_series']              =   $this->input->post('is_series', TRUE);
            $data['category_name']          =   $this->input->post('category_name', TRUE);
            $data['status']                 =   $this->input->post('status', TRUE);
            $data['category_description']   =   $this->input->post('category_description', TRUE);

            /****************************** Single Image Upload ******************************/
            
            if(!empty($_FILES["category_image"]['name'])){
                $data['category_image']       =      time().'-'.$_FILES["category_image"]['name'];
                
                $getImageName   =   $this->category_model->getReplacedSingleImgName($id);
                if(!empty($getImageName)){
                    $deleteFile     =   './uploads/category/'.$getImageName;
                    if(is_readable($deleteFile) && unlink($deleteFile)){
                        //echo "The file has been deleted";
                    }
                }
                
                $this->load->library('image_lib');
            
                $config['upload_path']       =   './uploads/category/';
                $config['allowed_types']     =   'gif|jpg|png';
                $config['file_name']         =    $data['category_image'];
                
                $this->load->library('upload', $config);
                $this->upload->do_upload('category_image');
                $image_data = $this->upload->data();
                
                // Resize image to the given format
                $imageResize =  [
                                    'image_library'   => 'gd2',
                                    'source_image'    =>  $image_data['full_path'],
                                    'maintain_ratio'  =>  TRUE,
                                    'width'           =>  250,
                                    'height'          =>  250,
                                ];

                $this->image_lib->clear();
                $this->image_lib->initialize($imageResize);
                $this->image_lib->resize();
            }
            
            /****************************** Single Image Upload ******************************/

            $updateCategory     =   $this->category_model->updateCategory($id, $data);

            if($updateCategory == 1){
                $this->session->set_flashdata('success', 'Category updated successfully');
                return redirect('admin/editcategory/'.$id);
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                return redirect('admin/editcategory/'.$id);
            }
        }
    }

    public function deletecategory($id)
    {   
        $checkParentCat         =   $this->category_model->is_parent_category($id);
        if($checkParentCat){
            $this->session->set_flashdata('error', 'This a Parent Category!!! Please ensure you have untag from its sub categories.');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $getImageName           =   $this->category_model->getReplacedSingleImgName($id);
            
            if(!empty($getImageName)){
                $deleteFile     =   './uploads/category/'.$getImageName;            
                unlink($deleteFile);
            }
            
            $deleteCategory   =   $this->category_model->deleteCategory($id);
            
            if($deleteCategory == 1){
                $this->session->set_flashdata('success', 'Category deleted successfully');
                echo redirectPreviousPage();
                exit;
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                echo redirectPreviousPage();
                exit;
            }
        }
    }
	
	/*********************** ADD User AREA ***********************/
	public function adduserarea($id)
    {
		$page = 'add-user-area';
		$userBranch = $this->user_model->getUserBranch($id);
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                   =   [];
                $data['branchAreaList'] =   $this->branch_model->getBranchAreaList($userBranch->branch_id);
                $data['userAreaList']   =   $this->user_model->getUserAreaList($id);
                $data['title']          =   ucfirst($page);
                                
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	public function insertuserarea()
    {
		$area_id =   $this->input->post('area_id', TRUE);
		$user_id =   $this->input->post('user_id', TRUE);
		$branch_area   =   [];
		foreach($area_id as $area){
				$branch_area['area_id']     =  $area;
				$branch_area['user_id']   	=  $user_id;
				$UserAreacheck   =   $this->user_model->CheckusersAreaExist($area,$user_id);
				if($UserAreacheck == 0){
					$insertBranchArea   =   $this->user_model->insert_users_area($branch_area);
				}
			}

		if($insertBranchArea > 0){
			$this->session->set_flashdata('success', 'Users Area Successfully Added');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Area Cannot be added!!');
			echo redirectPreviousPage();
		}
    }
	
	public function deleteUserArea($id)
    {   
        $deleteUserArea   =   $this->user_model->deleteUserArea($id);
        
        if($deleteUserArea == 1){
            $this->session->set_flashdata('success', 'User Area deleted successfully');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Something went wrong');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
    }
	/*********************** ADD User DUTY ***********************/
	public function adduserduty($id)
    {
		$page = 'add-user-duty';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $data['userShiftList']   =   $this->user_model->getUserDutyList($id);
				$data['ShiftList']   	 =   $this->user_model->getShiftListbyUserId($id);
				//$data['DaysList']   	 =   $this->user_model->getDaysList();
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	public function insertuserduty()
    {
		$data                           =   [];
		$data['shift_id']                       =   $this->input->post('shift_id', TRUE);
		$data['pd_id']                      	=   $this->input->post('pd_id', TRUE);
		$data['from_date']                   	=   $this->input->post('from_date', TRUE);
		$data['to_date']                   		=   $this->input->post('to_date', TRUE);
		
		$checkAvailablity       =   $this->user_model->checkExistDuty($data['shift_id'],$data['pd_id']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Duty allocation Already exists!');
                echo redirectPreviousPage();
                exit;
            }
		//print_r($data); die;
		$insertDuty   =   $this->user_model->insert_users_duty($data);

		if($insertDuty > 0){
			$this->session->set_flashdata('success', 'Duty allocation Successfully Added');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Duty allocation not added!!');
			echo redirectPreviousPage();
		}
    }
	
	public function edituserduty()
    {
		$user_id = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$page = 'edit-user-duty';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $data['userDutyDetails']   =   $this->user_model->getUserDutyDetails($id);
				$data['ShiftList']   	 =   $this->user_model->getShiftListbyUserId($user_id);
				//$data['DaysList']   	 =   $this->user_model->getDaysList();
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	public function updateuserduty()
    {
		$user_id = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		
		$data                           =   [];
		$data['from_date']              =   $this->input->post('from_date', TRUE);
		$data['to_date']   				=   $this->input->post('to_date', TRUE);
		
		$updateDuty     =   $this->user_model->updateDuty($id, $data);
		if($updateDuty == 1){
			$this->session->set_flashdata('success', 'Duty date updated successfully');
			return redirect('admin/adduserduty/'.$user_id);
		}
		else{
			$this->session->set_flashdata('error', 'Duty date not updated!!');
			return redirect('admin/adduserduty/'.$user_id);
		}
	}
	
	public function deleteDutyallocation($id)
    {   
        $deleteDutyallocation   =   $this->user_model->deleteDutyallocation($id);
        
        if($deleteDutyallocation == 1){
            $this->session->set_flashdata('success', 'User Duty Allocation deleted successfully');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Something went wrong');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
    }
	
	public function pdboydutylist()
    {
		if (!get_permission('DUTYALLOCATIONLIST', 'is_view')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
		$page = 'pdboy-duty-list';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $data['userShiftList']   =   $this->user_model->getUserDutyList($this->session->userdata('user_id'));
				//$data['ShiftList']   	 =   $this->user_model->getShiftListbyUserId($id);
				//$data['DaysList']   	 =   $this->user_model->getDaysList();
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	/*********************** ADD User SHIFT ***********************/
	public function addusershift($id)
    {
		if (!get_permission('ADDSHIFT', 'is_add')){ 
            $this->session->set_flashdata('error', 'Unauthorised Access.');
            redirect(base_url('admin'), 'refresh');
        }
		$page = 'add-user-shift';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $data['userShiftList']   =   $this->user_model->getUserShiftList($id);
				$data['ShiftList']   	 =   $this->user_model->getShiftListbyUserId($id);
				$data['DaysList']   	 =   $this->user_model->getDaysList();
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	public function getAllDaysListByShift(){
		$shift_id   			=   $this->input->post('shift_id', TRUE);
		$user_id   				=   $this->input->post('user_id', TRUE);
		$ShiftDaysList     		=   $this->user_model->getDaysListByshiftID($shift_id, $user_id);
		echo $ShiftDaysList;
		
	}
	
	public function validateTozipcode(){
		$postal_code   			=   $this->input->post('postal_code', TRUE);
		$AreaCountVal     		=   $this->user_model->validatepostcode_by_tozip($postal_code);
		if($AreaCountVal == 0){
			echo '<span style="color:red;">We do not cover your area!</span>';
		}
		
	}
	
	public function getUserAreaListbyBranch()
    {
        $q        = $this->input->get('q');
        $field    = $this->input->get('field');        
        $tbl_name = $this->input->get('tbl_name');
		$user_id = $this->input->get('user_id');

        echo json_encode($this->user_model->UserAreaselectQueryAjax(strtoupper($q), $tbl_name, $field, $user_id));
    }
	
	public function insertusershift()
    {
		$data =   [];
		$data['shift_id'] = $this->input->post('shift_id', TRUE);
		$data['pd_id'] = $this->input->post('pd_id', TRUE);
		$data['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date', TRUE)));
		$data['to_date'] = date('Y-m-d',strtotime($this->input->post('to_date', TRUE)));
		//$data['day']                   			=   $this->input->post('day', TRUE);
		
		$checkAvailablity =   $this->user_model->checkExistShift($data['shift_id'],$data['pd_id']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Shift already assigned');
                echo redirectPreviousPage();
                exit;
            }
		//print_r($data); die;
		$insertShift   =   $this->user_model->insert_users_shift($data);

		if($insertShift > 0){
			$this->session->set_flashdata('success', 'Shift allocation Successfully Added');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Something went wrong');
			echo redirectPreviousPage();
		}
    }
	
	public function deleteShiftallocation($id)
    {   
        $deleteShiftallocation   =   $this->user_model->deleteShiftallocation($id);
        
        if($deleteShiftallocation == 1){
            $this->session->set_flashdata('success', 'User Shift Allocation deleted successfully');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Something went wrong');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
    }
	
	
	/*********************** ADD Credit Amount ***********************/
	public function addcredit($id)
    {
		$page = 'add-user-credit';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $data['userCreditList']   =   $this->user_model->getuserCreditList($id);
				//$data['ShiftList']   	 =   $this->user_model->getShiftList();
				//$data['DaysList']   	 =   $this->user_model->getDaysList();
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	public function insertusercredit()
    {
		$credit_limit           =   $this->input->post('credit_limit', TRUE);
		$user_id                =   $this->input->post('user_id', TRUE);
		
		$userCreditamount   =   $this->user_model->getuserCreditList($user_id);
		$old_creditLimit = $userCreditamount[0]->credit_limit;
		$old_outstanding = $userCreditamount[0]->credit_outstanding_amount;
		$extraAmount = $credit_limit - $old_creditLimit;
		$new_outstanding = $extraAmount + $old_outstanding;
		//print_r($userCreditamount); die;
		//$NewCreditamount = $old_creditLimit + $credit_limit;
		if($credit_limit == $old_creditLimit){
			$this->session->set_flashdata('error', 'Some credit limit already exist!!! Please increase or decrease credit limit.');
			echo redirectPreviousPage();
			exit();
		}
		$data=array(
			'credit_limit'=>$credit_limit,
			'credit_outstanding_amount'=>$new_outstanding
		);
		
		/*$checkAvailablity       =   $this->user_model->checkExistShift($data['shift_id'],$data['pd_id'],$data['day']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Shift allocation Already exists!');
                echo redirectPreviousPage();
                exit;
            }*/
		//print_r($data); die;
		$insertCredit   =   $this->user_model->insert_users_credit($data, $user_id);

		if($insertCredit > 0){
			$this->session->set_flashdata('success', 'Credit Limit Successfully Added');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Something went wrong');
			echo redirectPreviousPage();
		}
    }
	
	
	public function deleteCreditAmount($id)
    {  
		$credit_limit = 0; 
		$outstanding = 0; 
		$data=array(
			'credit_limit'=>$credit_limit,
			'credit_outstanding_amount'=>$outstanding
		);
		
        $deleteCreditAmount   =   $this->user_model->deleteCreditAmount($data, $id);
        
        if($deleteCreditAmount == 1){
            $this->session->set_flashdata('success', 'Credit Amount deleted successfully');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Nothing to delete!!');
            //return redirect('admin/international/');
            echo redirectPreviousPage();
            exit;
        }
    }
	
	/*********************** ADD Pay Later ***********************/
	public function addpaylater($id)
    {
		$page = 'add-user-paylater';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $data['userPayLater']   =   $this->user_model->getuserPayLater($id);
				$data['UserCheckPointList']   	 =   $this->user_model->getUserCheckPointList($id);
				$data['CheckPointList']   	 =   $this->user_model->getCheckPointList();
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	public function insertuserpaylater()
    {
		
		$user_id             =   $this->input->post('user_id', TRUE);
		$pay_later           =   $this->input->post('pay_later', TRUE);
		$have_checkpoint     =   $this->input->post('have_checkpoint', TRUE);
		$checkpoint     	 =   $this->input->post('checkpoint', TRUE);
		
		if($have_checkpoint == '1'){
			if(!empty($checkpoint)){
				//print_r($_REQUEST);
				$data=array(
					'pay_later'=>$pay_later
				);
				$this->user_model->insert_users_credit($data, $user_id);
				$this->user_model->deletecheckpoint($user_id);
				
				$user_checkpoint   =   [];
				foreach($checkpoint as $point){
					$user_checkpoint['checkpoint_id']   =  $point;
					$user_checkpoint['user_id']   		=  $user_id;
					$insertCheckpoint   =   $this->user_model->insert_users_checkpoint($user_checkpoint);
				}
				
				if($insertCheckpoint > 0){
					$this->session->set_flashdata('success', 'Users Check Point Successfully Added');
					echo redirectPreviousPage();
				}
				else{
					$this->session->set_flashdata('error', 'Check Point Cannot be added!!');
					echo redirectPreviousPage();
				}
				
			} else {
				$this->session->set_flashdata('error', 'Please select some check point!!');
				echo redirectPreviousPage();
				exit();
			}
		} else {
			$data=array(
				'pay_later'=>$pay_later
			);
			$insertPaylater   =   $this->user_model->insert_users_credit($data, $user_id);
			$this->user_model->deletecheckpoint($user_id);
			
			$this->session->set_flashdata('success', 'User Pay Later Option Updated Successfully.');
			echo redirectPreviousPage();
			exit();
		
		}
    }
	
	/*********************** ADD Pickup Orders ***********************/
	public function addorderpickup($user_id)
    {
		$page = 'add-pickup-order';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $data['userPickupOrderList']   =   $this->user_model->getuserPickupOrderList($user_id);
				$data['PickupOrderList']   	 =   $this->order_model->getpickupOrderList($this->session->userdata('branch_id'));
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	
	public function insertuserpickuporder()
    {
		$data                           =   [];
		$data['shipment_id']                    =   $this->input->post('shipment_id', TRUE);
		$data['user_id']                      	=   $this->input->post('user_id', TRUE);
		$data['order_type']                   	=   '1';
		$data['created_date']                   =   date('Y-m-d H:i:s');
		
		$checkAvailablity       =   $this->user_model->checkExistPickupOrder($data['shipment_id'],$data['order_type']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Pickup Order Already Assigned!');
                echo redirectPreviousPage();
                exit;
            }
		//print_r($data); die;
		$insertPickupOrder   =   $this->user_model->insert_pickup_order($data);

		if($insertPickupOrder > 0){
			$this->session->set_flashdata('success', 'Pickup Order Successfully Added');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Pickup Order cannot added!!');
			echo redirectPreviousPage();
		}
    }
	
	public function deleteUserPickupOrder($id)
    {   
        $deleteUserPickupOrder   =   $this->user_model->deleteUserPickupOrder($id);
        
        if($deleteUserPickupOrder == 1){
            $this->session->set_flashdata('success', 'User Order deleted successfully');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'User Order cannot deleted!!');
            echo redirectPreviousPage();
            exit;
        }
    }
	
	/*********************** ADD Delivery Orders ***********************/
	public function addorderdelivery($user_id)
    {
		$page = 'add-delivery-order';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/users/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $data['userDeliveryOrderList']   =   $this->user_model->getuserDeliveryOrderList($user_id);
				$data['DeliveryOrderList']   	 =   $this->order_model->getdeliveryOrderList($this->session->userdata('branch_id'));
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/users/' . $page, $data);
            }
        }
    }
	
	public function insertuserdeliveryorder()
    {
		$data                           =   [];
		$data['shipment_id']                    =   $this->input->post('shipment_id', TRUE);
		$data['user_id']                      	=   $this->input->post('user_id', TRUE);
		$data['order_type']                   	=   '2';
		$data['created_date']                   =   date('Y-m-d H:i:s');
		
		$checkAvailablity       =   $this->user_model->checkExistPickupOrder($data['shipment_id'],$data['order_type']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Delivery Order Already Assigned!');
                echo redirectPreviousPage();
                exit;
            }
		//print_r($data); die;
		$insertDeliveryOrder   =   $this->user_model->insert_delivery_order($data);

		if($insertDeliveryOrder > 0){
			$this->session->set_flashdata('success', 'Delivery Order Successfully Added');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Delivery Order cannot added!!');
			echo redirectPreviousPage();
		}
    }
}