<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        /*$this->load->library('javascript');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));*/
        $this->load->library(array('form_validation','encryption','session','javascript'));
        $this->load->helper(array('url', 'form', 'date'));
        $this->load->helper('admin_helper');
        //$this->encryption->create_key(16);
        $this->load->model('OuthModel');
        $this->load->model('admin_model');
        $this->load->model('login_model');
        $this->load->library('image_lib');
        $this->load->library("pagination");
        //$this->gallery_path = realpath(APPPATH . '../uploads');
    }
    
    /********************************************   View Functions  ********************************************/
    
    public function index($page = 'dashboard')
    {
        //print_r($_SESSION);
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data['title'] = ucfirst($page);
				if($this->session->userdata('user_type') == 'MO'){
					$data['orderList']  =   $this->admin_model->getrecentOrderList();
					$data['TotalQuotation'] = $this->admin_model->totalQuotationCount();
					$data['TotalOrders'] = $this->admin_model->totalOrderCount();
					$data['TotalUsers'] = $this->admin_model->totalUsersCount();
				} elseif($this->session->userdata('user_type') == 'BO') {
					$data['orderList']  =   $this->admin_model->getrecentpickupdeliveryList($this->session->userdata('branch_id'));
					$data['TotalUsers'] = $this->admin_model->totalBranchUsersCount($this->session->userdata('branch_id'));
					$data['TotalPickedUp'] = $this->admin_model->totalBranchPickedUpOrders($this->session->userdata('branch_id'));
					$data['TotalDeliverd'] = $this->admin_model->totalBranchDeliverdOrders($this->session->userdata('branch_id'));
				} else {
					$data['orderList']  =   $this->admin_model->getuserPickupdeliveryOrderList($this->session->userdata('user_id'));
					$data['TotalPickedUp'] = $this->admin_model->totalTotalPickedUpOrders($this->session->userdata('user_id'));
					$data['TotalDeliverd'] = $this->admin_model->totalTotalDeliverdOrders($this->session->userdata('user_id'));
					$data['CurrentTotalPickedUp'] = $this->admin_model->CurrentTotalPickedUpOrders($this->session->userdata('user_id'));
					$data['CurrentTotalDeliverd'] = $this->admin_model->CurrentTotalDeliverdOrders($this->session->userdata('user_id'));
				}
                $this->load->view('admin/' . $page, $data);
            }
        }
    }
    public function testmesg()
    {
		$testmesg = sendSMS('9831278951', 'DO NOT SHARE: 123456 is the OTP for your invoice updation, valid for 15 minutes only. Regards, Staqo');
		print_r($testmesg); die;
	}
    public function login($page = 'login')
    {        
        if(!file_exists(APPPATH . 'views/admin/' . $page . '.php'))
        {
            show_404();
        }
        else{
            $data['title'] = ucfirst($page);
            //$this->load->view('admin/login');
            $this->load->view('admin/' . $page, $data);
        }
    }
	
	public function forgotpassword($page = 'forgot-password')
    {        
        if(!file_exists(APPPATH . 'views/admin/' . $page . '.php'))
        {
            show_404();
        }
        else{
            $data['title'] = ucfirst($page);
            //$this->load->view('admin/login');
            $this->load->view('admin/' . $page, $data);
        }
    }
	
	public function forgot_password_email()
    {
        $post  = $this->input->post();
        $email = $post['email_address'];

        $ifexists = $this->admin_model->IfExistEmail($email);
        if ($ifexists != false) {
           $new_password = $this->admin_model->RandomPassword();
            $user_id      = $ifexists['user_id'];
            /*$update       = $this->admin_model->UpdatePassword($user_id, md5($new_password));
            if ($update == true) {*/
                $from_email = ADMIN_EMAIL;
                $replyemail = ADMIN_EMAIL;
                $to_email   = $email;
                $name       = ''; //$user['name'];
                $subject = "Forgot password Mail From Royal Sherry";


                $verifyLink = base_url();

                $body = '';
                //$body .= '<p>Name : ' . $user['name'] . '</p>';
                $body .= '<p>Username : ' . $email . '</p>';
                $body .= '<p>Password : ' . $new_password . '</p>';
                $body .= '<p>Click to below to login</p>';
                $body .= '<p><a href="' . $verifyLink . '">' . $verifyLink . '</a></p>';

                $this->OveModel->SMTP_Config();
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                $this->email->from($from_email, $name);
                $this->email->to($to_email);
                $this->email->reply_to($replyemail);
                $this->email->subject($subject);
                $this->email->message($body);
				//echo $this->email->send(); die;
                if($this->email->send()){
					$update       = $this->admin_model->UpdatePassword($user_id, md5($new_password));
					if ($update == true) {
						$this->session->set_flashdata('success', 'Your new password has been sent to your email address. !');
            			return redirect('admin/forgotpassword');
					}
				} else {
					$this->session->set_flashdata('error', 'Faild to send Email, Please try again !');
            		return redirect('admin/forgotpassword');
				}
                
        } else {

            $this->session->set_flashdata('error', 'Sorry your email does not exist in our database.<br>Please enter correct email !');
            return redirect('admin/forgotpassword');
        }
    }
    
    public function register($page = 'register')
    {
        if(!file_exists(APPPATH . 'views/admin/' . $page . '.php'))
        {
            show_404();
        }
        else{
            //$this->load->view('admin/register');
            $data['title'] = ucfirst($page);
            $this->load->view('admin/' . $page, $data);
        }        
    }

    public function profile()
    {
        $sessionEmail   =   $this->session->userdata('logged_in');
        $data['profileData']   =   $this->admin_model->get_profile_data($sessionEmail);
        $this->load->view('admin/profile', $data);
    }

    public function updateprofile()
    {
        $data   =   [];
        $sessionEmail          =   $this->session->userdata('logged_in');
		$sessionUserID         =   $this->session->userdata('user_id');
        $data['firstname']     =   $this->input->post('firstname', TRUE);
        $data['lastname']      =   $this->input->post('lastname', TRUE);        
        $data['country_code']  =   $this->input->post('country_code', TRUE);
		$data['telephone']     =   $this->input->post('telephone', TRUE);
		$data['address']       =   $this->input->post('address', TRUE);
		$data['country']       =   $this->input->post('country', TRUE);
		$data['state']         =   $this->input->post('state', TRUE);
		$data['city']          =   $this->input->post('city', TRUE);
		$data['zip']           =   $this->input->post('zip', TRUE);
		//print_r($data); die;
        /****************************** Single Image Upload ******************************/
            
        if(!empty($_FILES["profile_image"]['name'])){
            $data['profile_image']       =      time().'-'.$_FILES["profile_image"]['name'];
            $getImageName   =   $this->admin_model->getReplacedSingleImgName($sessionEmail);
            //echo $getImageName; die();
            if(!empty($getImageName)){
                $deleteFile     =   './uploads/profile_img/'.$getImageName;
                if(is_readable($deleteFile) && unlink($deleteFile)){
                    //echo "The file has been deleted";                    
                    $this->session->set_userdata('prof_img', $data['profile_image']);
                }
            }
            
            $this->load->library('image_lib');
        
            $config['upload_path']       =   './uploads/profile_img/';
            $config['allowed_types']     =   'gif|jpg|png';
            $config['file_name']         =    $data['profile_image'];
            
            $this->load->library('upload', $config);
            $this->upload->do_upload('profile_image');
            $image_data = $this->upload->data();
            
            // Resize image to the given format
            $imageResize =  [
                                'image_library'   => 'gd2',
                                'source_image'    =>  $image_data['full_path'],
                                'maintain_ratio'  =>  TRUE,
                                'width'           =>  160,
                                'height'          =>  160,
                            ];

            $this->image_lib->clear();
            $this->image_lib->initialize($imageResize);
            $this->image_lib->resize();
        }
        
        /****************************** Single Image Upload ******************************/



        $updateProfile     =   $this->admin_model->updateprofile($sessionEmail, $data);

        if($updateProfile == 1){
            $this->session->set_userdata('firstName', $data['firstName']);
            $this->session->set_userdata('lastName', $data['firstName']);
            $this->session->set_flashdata('success', 'Profile updated successfully');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Nothing to update!!');
            echo redirectPreviousPage();
            exit;
        }
    }

    public function changepassword()
    {
        $this->load->view('admin/change-password');
    }
	
	public function changeemail()
    {
        $this->load->view('admin/change-email');
    }

    public function changepass()
    {
        $data                       =   [];        
        $data['email']      		=   $this->session->userdata('logged_in');
        $data['password']           =   md5($this->input->post('old_password'));
        $password                   =   $this->input->post('new_password', TRUE);
        $confirmPassword            =   $this->input->post('confirm_password', TRUE);
        if($password == $confirmPassword){
            $changePassword     =   $this->admin_model->changePassword($data,$confirmPassword);
            if($changePassword){
                $this->session->set_flashdata('success', 'Password changed successfully');
                echo redirectPreviousPage();
                exit;
            }
            else{
                $this->session->set_flashdata('error', 'Incorrect Old Password');
                echo redirectPreviousPage();
                exit;
            }            
        }
        else{            
            $this->session->set_flashdata('error', 'Password Mismatch');
            echo redirectPreviousPage();
            exit;
        }

    }
	
	public function emailchange()
    {
        $data                       =   [];   
		$sessionUserID         =   $this->session->userdata('user_id');  
		$email                 =   $this->input->post('email', TRUE);   
        $data['email']         =   $email;
        $checkAvailablity = $this->admin_model->CheckEmailIDExist($sessionUserID, $email);
		if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Email-ID Already exists!');
                echo redirectPreviousPage();
                exit;
         } else {
			 $updateEmail     		=       $this->admin_model->updateUserEmail($sessionUserID, $data);
            if($updateEmail == 1){
                $this->session->set_flashdata('success', 'Email updated successfully');
                return redirect('admin/logout/');
            } else {
				$this->session->set_flashdata('error', 'Nothing to update!!');
                echo redirectPreviousPage();
                exit;
			}
		 }
			die;
    }
    
    /********************************************   View Functions  ********************************************/
    
    public function adminlogin()
    {        
        $this->form_validation->set_rules('email_address', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
            
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/login');
        }
        else{
            $data = [
                        'email' 		=>  $this->input->post('email_address'),
                        'password'      =>  md5($this->input->post('password', false)),
                        'status'        =>  '1'
                    ];
            
            $loginUser   =   $this->login_model->login($data);
            //echo '<pre>'; print_r($loginUser); die;
			//echo '===>>'.count($loginUser);
            //if(count($loginUser) > 0){
			if(!empty($loginUser)) {
                $this->session->set_userdata('logged_in', $loginUser[0]->email);
                $this->session->set_userdata('name', $loginUser[0]->firstname.' '.$loginUser[0]->lastname);
                $this->session->set_userdata('user_type', $loginUser[0]->user_type);
                $this->session->set_userdata('role', $loginUser[0]->role);
                $this->session->set_userdata('accounttype', $loginUser[0]->accounttype);               
                $this->session->set_userdata('user_id', $loginUser[0]->user_id);
                $this->session->set_userdata('add_date', $loginUser[0]->add_date);
				$BranchDetails   =   $this->login_model->get_login_user_branch_id($loginUser[0]->user_id);
				//echo '<pre>'; print_r($BranchDetails); die;
				$this->session->set_userdata('branch_id', $BranchDetails[0]->branch_id);
				$this->session->set_userdata('prof_img', $loginUser[0]->profile_image);
                $user_data = $this->session->userdata('logged_in');
                return redirect('admin');
            }

            else{
				$this->session->set_flashdata('email_address', $this->input->post('email_address'));
            	$this->session->set_flashdata('password', $this->input->post('password', false));
                $this->session->set_flashdata('error', 'Username or Password is incorrect!');
                return redirect('admin/login');
            }
            /*$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

            if (password_verify($loginUser[0]->password, $hash)){
                echo 'Password is valid!';
            } else {
                echo 'Invalid password.';
            }*/
        }
    }
    
    public function fileregister()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('conpassword', 'Confirm Password', 'required|matches[password]');
            
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/register');
        }
        else
        {            
            $data   =   [];
            
            $data['username']               =   $this->input->post('username', TRUE);
            //$data['password']               =   password_hash($this->input->post('password', false), PASSWORD_BCRYPT);
            $data['password']               =   md5($this->input->post('password', true));
            $data['is_admin']               =   1;
            $data['email_address']          =   $this->input->post('email_address', TRUE);
            $data['status']                 =   1;
                        
            $registerUser   =   $this->login_model->registerUser($data);
            
            if($registerUser > 0){
                $this->session->set_flashdata('success', 'Please Login!!!');
                return redirect('admin/login');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong');
                return redirect('admin/register');
            }
        }
    }
    
    /********************************************   Banner Functions   ********************************************/
    
    public function addbanner($page = 'add-new-banner')
    {
        if(!file_exists(APPPATH . 'views/admin/' . $page . '.php'))
        {
            show_404();
        }
        else{
            $data['title'] = ucfirst($page);
            $this->load->view('admin/' . $page);
        }
    }
    
    public function insertBanner()
    {
        $this->form_validation->set_rules('bannerPage', 'Banner Page Name', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            //return redirect('admin/adddestination');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $data['image']		=	time().$_FILES["image"]['name'];
		
            if(!is_dir('uploads/banners'))
            mkdir('uploads/banners');

            $this->load->library('image_lib');

            $config['upload_path']          = './uploads/banners/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']            =  $data['image'];

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')){
                $error = array('error' => $this->upload->display_errors());                
                $this->session->set_flashdata('error', 'Image format not supported');
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
                        'width'           =>  1600,
                        'height'          =>  600,
                    ];
                $this->image_lib->clear();
                $this->image_lib->initialize($imageResize);
                $this->image_lib->resize();

                $insertStatus		=	$this->admin_model->add_new_banner($data);

                if($insertStatus == 1){
                    $this->session->set_flashdata('success', 'Banner added Successfully');
                    echo redirectPreviousPage();
                    exit;
                }
                else{
                    $this->session->set_flashdata('error', 'Banner already Exists');
                    echo redirectPreviousPage();
                    exit;
                }
            }
        }
    }

    /********************************************   Banner Functions   ********************************************/
	
	
	
    
    /********************************************   Video Tag Functions   ********************************************/
    
    public function videotaglist($page = 'list-videotags')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/videotag/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data['videoTags']      =   $this->admin_model->videotagslist();
                $data['title']          =   ucfirst($page);
                
                $this->load->view('admin/videotag/' . $page, $data);
            }
        }
    }
    
    public function addvideotag($page = 'add-videotag')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/videotag/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data['title'] = ucfirst($page);
                $this->load->view('admin/videotag/' . $page);
            }
        }
    }
    
    public function insertVideoTag()
    {
        $this->form_validation->set_rules('tag_name', 'Tag Name', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/addvideotag');
        }
        else
        {
            $id         =   0;
            $data       =   $_POST;
            $checkAvailablity       =   $this->admin_model->checkExistTag($_POST['tag_name'],$id);
            if($checkAvailablity){
                $this->session->set_flashdata('error', 'Video Tag name exists');
                echo redirectPreviousPage();
                exit;
            }
            $insertTag  =   $this->admin_model->insertVideoTag($data);

            if($insertTag > 0){
                $this->session->set_flashdata('success', 'Tag Name Successfully');
                return redirect('admin/addvideotag');
            }
            else{
                $this->session->set_flashdata('error', 'Tag Name already Exists!');
                return redirect('admin/addvideotag');
            }
        }
    }    
    
    public function editVideoTag($id)
    {
        //echo $id;
        $data['editVideoTag']   =   $this->admin_model->editVideoTag($id);
        $this->load->view('admin/videotag/edit-videotag', $data);
    }
    
    public function updateVideoTag($id)
    {
        $this->form_validation->set_rules('tag_name', 'Tag Name', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', validation_errors());
            return redirect('admin/editVideoTag/'.$id);
        }
        else
        {
            $data                   =   $_POST;
            $checkAvailablity       =   $this->admin_model->checkExistTag($_POST['tag_name'],$id);
            if($checkAvailablity){
                $this->session->set_flashdata('error', 'Video Tag name exists');
                echo redirectPreviousPage();
                exit;
            }
            $updateVideoTag   =   $this->admin_model->updateVideoTag($id, $data);

            if($updateVideoTag == 1){
                $this->session->set_flashdata('success', 'Tag updated successfully!!!');
                return redirect('admin/editVideoTag/'.$id);
            }
            else{
                $this->session->set_flashdata('error', 'Tag Name already Exists!');
                return redirect('admin/editVideoTag/'.$id);
            }
        }
    }
    
    public function deleteVideoTag($id)
    {       
        $deleteVideoTag   =   $this->admin_model->deleteVideoTag($id);
        
        if($deleteVideoTag == 1){
            $this->session->set_flashdata('success', 'Video Tag Deleted Successfully');
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
    
    /********************************************   Video Tag Functions   ********************************************/

    // Logout from admin page
    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('firstName');
        $this->session->unset_userdata('lastName');
        $this->session->unset_userdata('prof_img');
        $data['message_display'] = 'Successfully Logout';
        redirect('admin/login');
    }

    public function deleteRecordAjax()
    {
        $id      = $this->input->post('id');
        $status  = $this->input->post('status');
        $table   = $this->input->post('table');
        $date    = $this->input->post('date');
        $saveArr = array(
            'id' => $id,
        );
        $updateStu = $this->OuthModel->deleteQuery($table, 'id', $id);
        echo $updateStu;
    }
}