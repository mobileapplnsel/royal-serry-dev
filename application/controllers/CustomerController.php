<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('prohibited_model');
        $this->load->model('customer_model');
        $this->load->model('branch_model');
        $this->load->model('news_model');
        $this->load->model('api_model');
        //$this->load->model('Users_model', 'OveModel', 'OuthModel');
        $this->load->helper('admin_helper');
    }

    public function index()
    {
        $data['newsList'] = $this->customer_model->get_news_list_homepage();
        $data['bannerList'] = $this->customer_model->get_banner_list_homepage();
        $data['SectionOne'] = $this->customer_model->cms_details_by_id(13);
        $data['SectionOne2'] = $this->customer_model->cms_details_by_id(18);
        $data['SectionTwo'] = $this->customer_model->cms_details_by_id(14);
        $data['SectionThree'] = $this->customer_model->cms_details_by_id(15);
        $data['SectioncallCentre'] = $this->customer_model->cms_details_by_id(16);
        $data['SectionLocation'] = $this->customer_model->cms_details_by_id(17);
        $data['SectionImg1'] = $this->customer_model->cms_images_by_id(1);
        $data['SectionImg2'] = $this->customer_model->cms_images_by_id(2);
        $this->load->view('frontend/index', $data);
    }

    public function login()
    {
        $this->load->view('frontend/login', []);
    }

    public function about_us()
    {
        $data = array();
        $data['title'] = "About Us";
        $data['description'] = "Royal Sherry - About Us";
        $data['keyword'] = "About Us";
        $data['AboutMsg'] = $this->customer_model->cms_details_by_id(1);
        $this->load->view('frontend/about-us', $data);
    }

    public function terms_condition()
    {
        $data = array();
        $data['title'] = "Terms & Condition";
        $data['description'] = "Royal Sherry - Terms & Condition";
        $data['keyword'] = "Terms & Condition";
        $data['termsMsg'] = $this->customer_model->cms_details_by_id(3);
        $this->load->view('frontend/terms-and-condition', $data);
    }

    public function contact_us()
    {
        $data = array();
        $data['title'] = "Contact Us";
        $data['description'] = "Royal Sherry - Contact Us";
        $data['keyword'] = "Contact Us";
        $data['contactMsg'] = $this->customer_model->cms_details_by_id(2);
        $this->load->view('frontend/contact-us', $data);
    }

    public function privacy_policy()
    {
        $data = array();
        $data['title'] = "Privacy & Policy";
        $data['description'] = "Royal Sherry - Privacy & Policy";
        $data['keyword'] = "Privacy & Policy";
        $data['privacyMsg'] = $this->customer_model->cms_details_by_id(4);
        $this->load->view('frontend/privacy-policy', $data);
    }

    public function industry_sectors()
    {
        $data = array();
        $data['title'] = "Industry Sectors";
        $data['description'] = "Royal Sherry - Industry Sectors";
        $data['keyword'] = "Industry Sectors";
        $data['industryMsg'] = $this->customer_model->cms_details_by_id(5);
        $this->load->view('frontend/industry-sectors', $data);
    }

    public function use_services()
    {
        $data = array();
        $data['title'] = "Use Services";
        $data['description'] = "Royal Sherry - Use Services";
        $data['keyword'] = "Use Services";
        $data['servicesMsg'] = $this->customer_model->cms_details_by_id(6);
        $this->load->view('frontend/use-services', $data);
    }

    public function air_freight()
    {
        $data = array();
        $data['title'] = "Air Freight";
        $data['description'] = "Royal Sherry - Air Freight";
        $data['keyword'] = "Air Freight";
        $data['airMsg'] = $this->customer_model->cms_details_by_id(12);
        $this->load->view('frontend/air-freight', $data);
    }

    public function sea_freight()
    {
        $data = array();
        $data['title'] = "Sea Freight";
        $data['description'] = "Royal Sherry - Sea Freight";
        $data['keyword'] = "Sea Freight";
        $data['seaMsg'] = $this->customer_model->cms_details_by_id(11);
        $this->load->view('frontend/sea-freight', $data);
    }

    public function land_transport()
    {
        $data = array();
        $data['title'] = "Land Transport";
        $data['description'] = "Royal Sherry - Land Transport";
        $data['keyword'] = "Land Transport";
        $data['landMsg'] = $this->customer_model->cms_details_by_id(10);
        $this->load->view('frontend/land-transport', $data);
    }

    public function groupage()
    {
        $data = array();
        $data['title'] = "groupage";
        $data['description'] = "Royal Sherry - groupage";
        $data['keyword'] = "groupage";
        $data['groupageMsg'] = $this->customer_model->cms_details_by_id(9);
        $this->load->view('frontend/groupage', $data);
    }

    public function consultancy()
    {
        $data = array();
        $data['title'] = "consultancy";
        $data['description'] = "Royal Sherry - consultancy";
        $data['keyword'] = "consultancy";
        $data['consultancyMsg'] = $this->customer_model->cms_details_by_id(8);
        $this->load->view('frontend/consultancy', $data);
    }

    public function value_added_services()
    {
        $data = array();
        $data['title'] = "Value Added Services";
        $data['description'] = "Royal Sherry - Value Added Services";
        $data['keyword'] = "Value Added Services";
        $data['valueMsg'] = $this->customer_model->cms_details_by_id(7);
        $this->load->view('frontend/value-added-services', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata('Customer');
        //$this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Logged out successfully.');
        redirect(base_url());
    }

    public function registration()
    {
        $this->load->view('frontend/registration', []);
    }

    public function register_user()
    {
        //$this->OuthModel->CSRFVerify();
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|is_unique[users.email]',
            array(
                'required'  => 'You have not provided %s.',
                'is_unique' => 'This %s already exists.',
            )
        );
        if ($this->input->post('user_type') == 'BU') {
            $this->form_validation->set_rules('companyname', 'Company Name', 'required');
        }
        //$this->form_validation->set_rules('website', 'Website', '');
        $this->form_validation->set_rules('telephone', 'Phone', 'required');
        // $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('zip', 'Zip Code', 'required');
        $this->form_validation->set_rules('user_type', 'User Type', 'required');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
        $this->form_validation->set_rules('conf_password', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('address', 'Address', 'required');
        //$this->form_valisdation->set_rules('tc', 'terms & conditions', 'required');
        // echo '<pre>';
        // print_r($_POST);die;
        if ($this->form_validation->run() == false) {
            $response = ['status' => 0, 'message' => '<span style="color:#fff;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {

            $post = $this->input->post();

            if (strlen($post['telephone']) < 10) {
                $messageString = ['status' => 0, 'message' => '<span style="color:#fff;">Phone No. should be greater than 9 digits.</span>'];
                echo json_encode($messageString);
                die;
            }

            $data = [
                'email' => $post['email'],
                'telephone' => $post['telephone']
            ];
            $getCheckUser = $this->OveModel->checkUser($data);

            if (empty($getCheckUser)) {
                $user_data = [
                    'firstname'   => $post['firstname'],
                    'lastname'    => $post['lastname'],
                    //'password'    => $this->OuthModel->HashPassword($post['password']),
                    'password'    => md5($post['password']),
                    'user_type'   => $post['user_type'],
                    'companyname' => $post['companyname'],
                    'website'     => $post['website'],
                    'email'       => $post['email'],
                    'telephone'   => $post['telephone'],
                    'address'     => (isset($post['address'])) ? $post['address'] : '',
                    'address2'    => $post['address2'],
                    'country'     => $post['country'],
                    'state'       => $post['state'],
                    'city'        => $post['city'],
                    'zip'         => $post['zip'],
                    //'ip_address' => $this->input->ip_address(),
                    'add_date'    => DTIME,
                    'latitude'    => $post['lat'],
                    'longitude'   => $post['lng']

                ];
                $user_id = $this->Users_model->AddMember($this->OuthModel->xss_clean($user_data));

                if ($user_id != false) {

                    $messageString = "Your are registerd successfully !";

                    $user = $this->OveModel->Read_User_Information($user_id);

                    $from_email = ADMIN_EMAIL;
                    $replyemail = ADMIN_EMAIL;
                    $to_email   = $user['email'];
                    $name       = $user['firstname'];
                    $subject    = "Mail From Royal Sherry";

                    $txtdomain = '&txtdomain=' . $this->OuthModel->Encryptor('encrypt', $user['user_id']) . '&is_email_verify=' . $this->OuthModel->Encryptor('encrypt', $user['firstname']);

                    $verifyLink = base_url('verify-mail?action=verify' . $txtdomain);

                    $body = '';
                    $body .= '<p>Name : ' . $user['firstname'] . '</p>';
                    $body .= '<p>Username : ' . $user['email'] . '</p>';
                    $body .= '<p>Click to below Verify link and Activate Your account !</p>';
                    $body .= '<p><a href="' . $verifyLink . '">' . $verifyLink . '</a></p>';

                    // $this->OveModel->SMTP_Config();

                    $this->load->library('email');
                    $config = array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'smtp.googlemail.com',
                        'smtp_port' => 465,
                        'smtp_user' => 'noreply@staqo.com',
                        'smtp_pass' => 'Welcome@123',
                        'mailtype' => 'html',
                        'smtp_crypto' => 'ssl',
                        'smtp_timeout' => '4',
                        'charset' => 'utf-8',
                        'wordwrap' => TRUE
                    );
                    $this->email->initialize($config);


                    $this->email->set_newline("\r\n");
                    $this->email->set_mailtype("html");
                    $this->email->from($from_email, $name);
                    $this->email->to($to_email);
                    $this->email->reply_to($replyemail);
                    $this->email->subject($subject);
                    $this->email->message($body);
                    $this->email->send();
                    //echo $this->email->print_debugger();die;
                    //$messageString = 'Your account has been successfully created. An email has been sent to you with detailed instructions on how to activate it.';
                    $messageString = [
                        'status' => 1, 'message' => 'Your account has been successfully created. An email has been sent to you with detailed instructions on how to activate it.',
                        'redirectUrl'              => base_url('/'),
                    ];
                    echo json_encode($messageString);
                } else {
                    $messageString = [
                        'status' => 1,
                        'message'                  => 'Failed to register, Please try again !',
                        'redirectUrl'              => base_url('registration'),
                    ];

                    echo json_encode($messageString);
                }
            } else {
                $messageString = [
                    'status' => 0,
                    'message'                  => 'Email / Phone already exists!',
                    //'redirectUrl'              => base_url('registration'),
                ];
                echo json_encode($messageString);
                //die;
            }
        }
    }

    public function verify_mail()
    {

        $get     = $this->input->get();
        $name    = $this->OuthModel->Encryptor('decrypt', $get['is_email_verify']);
        $user_id = $this->OuthModel->Encryptor('decrypt', $get['txtdomain']);
        $res     = $this->Users_model->EmailVerifyStatusUpdate($user_id);

        if (!empty($res)) {
            if ($res[0]['is_email_verify'] == 0) {
                $r = $this->db->update('users', ['is_email_verify' => 1, 'status' => 1], ['user_id' => $user_id]);
                //echo $this->db->last_query();die;
                if ($r == 1) {
                    $data['title'] = 'Thank you your account has been activated successfully';
                    $this->session->set_flashdata('success', 'Thank you your account has been activated successfully');
                    $this->parser->parse('login/index_login', $data);
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }

    public function userlogin()
    {
        //$this->OuthModel->CSRFVerify();

        $post = $this->input->post();
        $data = [
            'email' => $post['email'],
        ];
        $result = $this->OveModel->Authentication_Check($data);
        if ($result != false) {
            $login_user_id = $result['user_id'];
            $user          = $this->OveModel->Read_User_Information($login_user_id);
            $hashed        = $user['password'];
            //if ($this->OuthModel->VerifyPassword($post['password'], $hashed) == 1) {
            if ($user['status'] == 1) {
                if (md5($post['password']) == $hashed) {
                    if ($user['user_type'] == 'NU' || $user['user_type'] == 'BU') {
                        //&& $user['status'] == 1
                        $userdata = [
                            'id'          => $user['user_id'],
                            'username'    => $user['email'],
                            'email'       => $user['email'],
                            'name'        => $user['firstname'],
                            'role'        => $user['user_type'],
                            'last_logged' => $user['lastlogged'],
                            'created'     => $user['add_date'],
                            'logged_in'   => 'TRUE',
                        ];

                        $this->session->set_userdata('Customer', $userdata);
                        if (!empty($post["remember"])) {
                            setcookie("member_email", $post['email'], time() + (10 * 365 * 24 * 60 * 60));
                            setcookie("member_password", $post['password'], time() + (10 * 365 * 24 * 60 * 60));
                        } else {
                            if (isset($_COOKIE["member_email"])) {
                                setcookie("member_email", "");
                                setcookie("member_password", "");
                            }
                        }

                        $redirect = base_url('home');

                        $message = [
                            'status' => 1,
                            'message'            => 'You are now successfully Logged In',
                            'userDataDB'         => $userdata,
                            'redirectUrl'        => $redirect,
                        ];
                    } else {
                        $message = ['status' => 0, 'message' => 'Unauthorized access !'];
                    }
                } else {
                    $message = ['status' => 0, 'message' => 'Your password is Incorrect  !'];
                }
            } else {
                $message = ['status' => 0, 'message' => 'User inactive!'];
            }
        } else {
            $message = ['status' => 0, 'message' => 'Your username is Incorrect  !'];
        }
        echo json_encode($message);
    }

    public function forgot_password()
    {
        $this->parser->parse('frontend/forgot-password', []);
    }
    public function forgot_password_email()
    {
        $this->OuthModel->CSRFVerify();
        $post  = $this->input->post();
        $email = $post['email'];

        $ifexists = $this->Users_model->IfExistEmail($email);
        if ($ifexists != false) {
            $new_password = $this->OuthModel->RandomPassword();
            $user_id      = $ifexists['user_id'];
            $update       = $this->OveModel->UpdatePassword($user_id, md5($new_password));
            if ($update == true) {
                $from_email = ADMIN_EMAIL;
                $replyemail = ADMIN_EMAIL;
                $to_email   = $email;
                $name       = ''; //$user['name'];
                $subject = "Mail From Royal Sherry";

                //$txtdomain = '&txtdomain=' . $this->OuthModel->Encryptor('encrypt', $user['id']) . '&is_email_verify=' . $this->OuthModel->Encryptor('encrypt', $user['name']);

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
                $this->email->send();
                //echo $this->email->print_debugger();
                //$messageString = 'Your account has been successfully created. An email has been sent to you with detailed instructions on how to activate it.';
                $message = [
                    'status' => 1, 'message' => 'Your new password has been sent to your email address. !' . $new_password,
                    'redirectUrl'        => base_url('/'),
                ];
            } else {

                $message = [
                    'status' => 0,
                    'message'            => 'Failed to password updated, Please try again !',
                    'redirectUrl'        => base_url('forgot-password'),
                ];
            }
        } else {

            $message = [
                'status' => 0,
                'message'            => 'Sorry your email does not exist in our database.<br>Please enter correct email !',
                'redirectUrl'        => base_url('forgot-password'),
            ];
        }
        echo json_encode($message);
    }

    public function getStates()
    {
        $states     = array();
        $country_id = $this->input->post('country_id');
        if ($country_id) {
            $states = $this->Users_model->statesSelect($country_id);
        }
        echo json_encode($states);
    }

    public function getCity()
    {
        $states     = array();
        $country_id = $this->input->post('state_id');
        if ($country_id) {
            $states = $this->Users_model->citiesSelect($country_id);
        }
        echo json_encode($states);
    }

    public function quotation()
    {
        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        if ($sessionData['logged_in'] != 'TRUE') {
            redirect(base_url('/'));
        }
        $sessionData             = $this->session->userdata('Customer');
        $id                      = $sessionData['id'];
        $data['profile_details'] = $this->OveModel->Read_User_Information($id);
        $data['quotation_list']  = $this->customer_model->getQuotationByUser($id);
        //echo '<pre>';print_r($data['quotation_list']);die;
        $this->parser->parse('frontend/quotation', $data);
    }

    public function quptationDetails()
    {
        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        if ($sessionData['logged_in'] != 'TRUE') {
            redirect(base_url('/'));
        }
        $sessionData             = $this->session->userdata('Customer');
        $id                      = $sessionData['id'];
        $data['profile_details'] = $this->OveModel->Read_User_Information($id);
        $data['quotation_list']  = $this->customer_model->getQuotationByUser($id);
        $this->parser->parse('frontend/quotation', $data);
    }

    public function home()
    {
        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        if ($sessionData['logged_in'] != 'TRUE') {
            redirect(base_url('/login'));
        }
        $sessionData             = $this->session->userdata('Customer');
        $id                      = $sessionData['id'];
        $data['profile_details'] = $this->OveModel->Read_User_Information($id);
        $data['prohibitedList']  = $this->prohibited_model->getProhibitedList();
        $data['prohibited_document'] = $this->api_model->getProhibitedItems(['shipping_category_id' => 1]);
		$data['prohibited_parcel'] = $this->api_model->getProhibitedItems(['shipping_category_id' => 2]);
        $data['deliveryModeList']  = $this->customer_model->getDeliveryModeList();
        $rateFactor  = $this->customer_model->getRateFactor();
        $data['rateFactor']  = $rateFactor['amount'];
        $this->parser->parse('frontend/home', $data);
    }

    public function profile()
    {
        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        if ($sessionData['logged_in'] != 'TRUE') {
            redirect(base_url('/'));
        }
        $data        = array();
        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];

        $data['profile_details'] = $this->OveModel->Read_User_Information($id);
        //print_r($data);die;
        $this->parser->parse('frontend/profile', $data);
    }

    public function profileUpdate()
    {

        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        if ($sessionData['logged_in'] != 'TRUE') {
            redirect(base_url('/'));
        }
        //$this->OuthModel->CSRFVerify();
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        if ($this->input->post('user_type') == 'BU') {
            $this->form_validation->set_rules('companyname', 'Company Name', 'required');
        }
        //$this->form_validation->set_rules('website', 'Website', '');
        $this->form_validation->set_rules('telephone', 'Phone', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('zip', 'Zip Code', 'required');
        $this->form_validation->set_rules('user_type', 'User Type', 'required');

        if ($this->form_validation->run() == false) {
            $response = ['status' => 0, 'message' => '<span style="color:#fff;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {

            $post = $this->input->post();

            if (strlen($post['telephone']) < 10) {
                $response = ['status' => 0, 'message' => '<span style="color:#fff;">Phone No. should be greater than 9 digits.</span>'];
                echo json_encode($response);
                die;
            }

            $user_data = [
                'firstname'   => $post['firstname'],
                'lastname'    => $post['lastname'],
                'user_type'   => $post['user_type'],
                'companyname' => $post['companyname'],
                'website'     => $post['website'],
                'country_code'   => $post['country_code'],
                'telephone'   => $post['telephone'],
                'address'     => $post['address'],
                'address2'    => $post['address2'],
                'country'     => $post['country'],
                'state'       => $post['state'],
                'city'        => $post['city'],
                'zip'         => $post['zip'],
                'add_date'    => DTIME,
                'latitude'    => $post['lat'],
                'longitude'   => $post['lng']
            ];

            $user_id = $this->OuthModel->UpdateQuery('users', $this->OuthModel->xss_clean($user_data), 'user_id', $id);
            if ($user_id != false) {
                $messageString = 'Data has been successfully Updated';
                echo json_encode(['status' => 1, 'message' => $messageString, 'redirectUrl' => base_url('home')]);
            } else {
                echo json_encode(['status' => 0, 'message' => "Failed to Update, Please try again !", 'redirectUrl' => base_url('profile')]);
            }
        }
    }

    public function change_user_profile_password_update()
    {
        //$this->OuthModel->CSRFVerify();
        $post = $this->input->post();

        if (empty($post['Old'])) {
            echo json_encode(['status' => 0, 'message' => 'Old Password is Required !']);
        } else if (empty($post['New'])) {
            echo json_encode(['status' => 0, 'message' => 'Password is required fields !']);
        } else if (strlen($post['Confirm']) < 4) {
            echo json_encode(['status' => 0, 'message' => 'Password must contain at least 4 characters ! ']);
        } else if ($post['New'] != $post['Confirm']) {
            echo json_encode(['status' => 0, 'message' => "password and confirm password don't match"]);
        } else {

            $checkOldPasswordInDB = $this->OveModel->checkOldPasswordInDB();
            $hashed               = $checkOldPasswordInDB['password'];

            if (md5($post['Old']) == $hashed) {

                $user_id = $checkOldPasswordInDB['user_id'];
                $update  = $this->OveModel->UpdatePassword($user_id, md5($post['New']));
                if ($update == true) {
                    echo json_encode(['status' => 1, 'message' => "Password Changed !"]);
                } else {
                    echo json_encode(['status' => 0, 'message' => "Failed to password updated, Please try again !"]);
                }
            } else {
                echo json_encode(['status' => 0, 'message' => "Your old password do not match in databases, please enter correct password !"]);
            }
        }
    }

    public function getDocumentCategory()
    {
        $items     = array();
        $category_id = $this->input->post('category_id');
        $ship_sub_subcat_id = $this->input->post('ship_sub_subcat_id');
        if ($category_id) {
            $data['subcat'] = $this->Users_model->documentSubcatSelect($category_id);
            $data['items'] = $this->Users_model->documentItemSelect($category_id);
        }
        echo json_encode($data);
    }

    public function getPackageCategory()
    {
        $items     = array();
        $category_id = $this->input->post('category_id');
        $ship_sub_subcat_id = $this->input->post('ship_sub_subcat_id');
        if ($category_id) {
            $data['subcat'] = $this->Users_model->documentSubcatSelect($category_id);
            $data['items'] = $this->Users_model->packageItemSelect($category_id, $ship_sub_subcat_id);
        }
        echo json_encode($data);
    }

    public function credit_amount_pay()
    {
        $post = $this->input->post();
        //print_r($post); die;
        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        if ($sessionData['logged_in'] != 'TRUE') {
            redirect(base_url('/'));
        }

        $user_data = [
            'credit_outstanding_amount'   => $post['credit_outstanding_amount'],
        ];

        $user_id = $this->OuthModel->UpdateQuery('users', $this->OuthModel->xss_clean($user_data), 'user_id', $id);
        if ($user_id != false) {
            $credit_data = [
                'user_id'           => $id,
                'payable_amount'    => $post['payable_amount'],
                'pay_type'           => $post['pay_type'],
                'add_date'            => DTIME,
            ];
            $this->OuthModel->insertQuery('credit_amount_pay_history', $this->OuthModel->xss_clean($credit_data));
            $messageString = 'Credit amount paid successfully.';
            echo json_encode(['status' => 1, 'message' => $messageString, 'redirectUrl' => base_url('profile')]);
        } else {
            echo json_encode(['status' => 0, 'message' => "Faild to Update, Please try again !", 'redirectUrl' => base_url('profile')]);
        }
    }

    public function getShipmentChanges()
    {
        $ship_cat_id            = $this->input->post('ship_cat_id');
        $ship_subcat_id         = $this->input->post('ship_subcat_id');
        $ship_sub_subcat_id     = $this->input->post('ship_sub_subcat_id');
        $rate_type              = $this->input->post('rate_type');
        $location_from          = $this->input->post('location_from');
        $location_to            = $this->input->post('location_to');
        $charges_mode           = $this->input->post('charges_mode');
        $delivery_mode_id       = $this->input->post('delivery_speed');

        $data['rates'] = $this->Users_model->shipmentRate($ship_cat_id, $ship_subcat_id, $ship_sub_subcat_id, $rate_type, $location_from, $location_to, $charges_mode, $delivery_mode_id);
        $data['tax'] = $this->customer_model->getTax();

        //echo '<pre>';print_r($data);die;
        echo json_encode($data);
    }

    public function saveQuote()
    {
        // echo '<pre>';print_r($_POST);die;
        $post = $this->input->post();
        $shipment_type_option   = $this->input->post('shipment_type_option');
        $document_other         = $this->input->post('document_other');
        $parcel_other           = $this->input->post('parcel_other');
        $payment_mode           = $this->input->post('payment_mode');
        $quote_type             = ($this->input->post('quote_type') != '') ? $this->input->post('quote_type') : 0;
        $delivery_mode_id       = $this->input->post('delivery_speed');
        $this->form_validation->set_rules('location_type', 'Location Type', 'required');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address_from', 'Address From', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('address2', 'Address From 2nd', 'trim|required|xss_clean');
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|xss_clean');
        
        if ($post['country_to']!=='195') {
           $this->form_validation->set_rules('zip', 'Zip', 'trim|required|xss_clean');
        }
        // $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_type', 'Address Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('firstname_to', 'First Name To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname_to', 'Last Name To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address_to', 'Address To', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('address2_to', 'Address To 2nd', 'trim|required|xss_clean');
        $this->form_validation->set_rules('company_name_to', 'Company Name To', 'trim|xss_clean');
        $this->form_validation->set_rules('country_to', 'Country To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('state_to', 'State To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('city_to', 'City To', 'trim|required|xss_clean');
        if ($post['country_to']!=='195') {
            $this->form_validation->set_rules('zip_to', 'Zip To', 'trim|required|xss_clean');
        }
        

        // $this->form_validation->set_rules('email_to', 'Email To', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('address_type', 'Address Type To', 'trim|xss_clean');
        $this->form_validation->set_rules('telephone_to[]', 'Telephone To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('shipment_type_option', 'Shipment Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address_type', 'Address Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('charges_final', 'Charges', 'trim|required|xss_clean');


        if ($shipment_type_option == 1) {
            // IF Document Selected

            $_POST['document_category'] = array_filter($this->input->post('document_category'));
            //$this->form_validation->set_rules('document_category[]', 'Document Category', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('document_item[]', 'Document Item', 'trim|required|xss_clean');

            if ($document_other == 1) {
                // IF Other Selected
                $this->form_validation->set_rules('document_other[]', 'Other Details', 'trim|xss_clean');
                $this->form_validation->set_rules('other_details_document[]', 'Other Details', 'trim|xss_clean');
                // IF Other Selected End    
            }

            //$this->form_validation->set_rules('value_of_shipment_document[]', 'Value Of Shipment', 'trim|required|xss_clean');
            $this->form_validation->set_rules('protect_shipment_document[]', 'Protect Document Shipment', 'trim|xss_clean');
            $this->form_validation->set_rules('road_document', 'Road Document', 'trim|xss_clean');
            $this->form_validation->set_rules('rail_document', 'rail Document', 'trim|xss_clean');
            $this->form_validation->set_rules('air_document', 'air Document', 'trim|xss_clean');
            $this->form_validation->set_rules('ship_document', 'ship Document', 'trim|xss_clean');

            $road_input    = $this->input->post('road_document_input');
            $rail_input    = $this->input->post('rail_document_input');
            $air_input     = $this->input->post('air_document_input');
            $ship_input    = $this->input->post('ship_document_input');

            $category_id          = $this->input->post('document_category');

            $category_id    =  array_filter($category_id);
            $package_cat    =  array_filter($this->input->post('package_category'));
            $category_id    =  array_merge($category_id, $package_cat);


            $sub_cat          = $this->input->post('document_sub_cat');
            $sub_cat    =  array_filter($sub_cat);
            $package_sub_cat    =  array_filter($this->input->post('package_sub_cat'));
            $sub_cat    =  array_merge($sub_cat, $package_sub_cat);

            $item_id              = $this->input->post('document_item');
            $item_id    =  array_filter($item_id);
            $package_item    =  array_filter($this->input->post('package_item'));
            $item_id    =  array_merge($item_id, $package_item);
            $desc                 = $this->input->post('other_details_document');
            if (empty($desc)) {
                $desc[0] = 'NA';
            }
            $desc    =  array_filter($desc);
            $shipment_description_parcel    =  array_filter($this->input->post('shipment_description_parcel'));
            $desc    =  array_merge($desc, $shipment_description_parcel);
            $other_details_parcel = $this->input->post('other_details_parcel');
            $value_shipment       = $this->input->post('value_of_shipment_document');
            $insur                = $this->input->post('protect_shipment_document');
            $quantity             = $this->input->post('quantity');
            $quantity    =  array_filter($quantity);

            $quantity    =  array_filter($this->input->post('quantity'));
            $quantity    =  array_merge($quantity, $quantity);
            $quantity = 1;
            $line_total           = (int)$quantity * (int)$road_input;

            //Document End 
        } else {
            //Parcel Selected
            $_POST['package_item'] = array_filter($this->input->post('package_item'));
            $_POST['shipment_description_parcel'] = array_filter($this->input->post('shipment_description_parcel'));
            $_POST['referance_parcel'] = array_filter($this->input->post('referance_parcel'));
            $_POST['length'] = array_filter($this->input->post('length'));
            $_POST['length_dimen'] = array_filter($this->input->post('length_dimen'));
            $_POST['height'] = array_filter($this->input->post('height'));
            $_POST['height_dimen'] = array_filter($this->input->post('height_dimen'));
            $_POST['weight'] = array_filter($this->input->post('weight'));
            $_POST['weight_dimen'] = array_filter($this->input->post('weight_dimen'));
            $_POST['quantity'] = array_filter($this->input->post('quantity'));
            $_POST['breadth'] = array_filter($this->input->post('breadth'));
            $_POST['breadth_dimen'] = array_filter($this->input->post('breadth_dimen'));

            //$this->form_validation->set_rules('package_category[]', 'package_category', 'trim|required|xss_clean');
            $this->form_validation->set_rules('package_item[]', 'package_item', 'trim|required|xss_clean');

            if ($parcel_other == 1) {
                // IF Other Selected

                $_POST['parcel_other'] = array_filter($this->input->post('parcel_other'));
                $_POST['other_details_parcel'] = array_filter($this->input->post('other_details_parcel'));
                $this->form_validation->set_rules('parcel_other[]', 'Parcel Other', 'trim|required|xss_clean');
                $this->form_validation->set_rules('other_details_parcel[]', 'Other Details', 'trim|xss_clean');
                // IF Other Selected End
            }

            $this->form_validation->set_rules('shipment_description_parcel[]', 'shipment_description_parcel', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('value_of_shipment_parcel[]', 'Value Of Shipment', 'trim|required|xss_clean');
            $this->form_validation->set_rules('referance_parcel[]', 'referance_parcel', 'trim|required|xss_clean');
            $this->form_validation->set_rules('length[]', 'length', 'trim|required|xss_clean');
            $this->form_validation->set_rules('length_dimen[]', 'length_dimen', 'trim|required|xss_clean');
            $this->form_validation->set_rules('height[]', 'height', 'trim|required|xss_clean');
            $this->form_validation->set_rules('height_dimen[]', 'height_dimen', 'trim|required|xss_clean');
            $this->form_validation->set_rules('weight[]', 'weight', 'trim|required|xss_clean');
            $this->form_validation->set_rules('weight_dimen[]', 'weight_dimen', 'trim|required|xss_clean');
            $this->form_validation->set_rules('quantity[]', 'quantity', 'trim|required|xss_clean');
            $this->form_validation->set_rules('breadth[]', 'breadth', 'trim|required|xss_clean');
            $this->form_validation->set_rules('breadth_dimen[]', 'breadth_dimen', 'trim|required|xss_clean');


            $road_input    = $this->input->post('road_parcel_input');
            $rail_input    = $this->input->post('rail_parcel_input');
            $air_input     = $this->input->post('air_parcel_input');
            $ship_input    = $this->input->post('ship_parcel_input');

            $category_id          = $this->input->post('package_category');

            $category_id    =  array_filter($category_id);
            $package_cat    =  array_filter($this->input->post('document_category'));
            $category_id    =  array_merge($category_id, $package_cat);


            $sub_cat              = $this->input->post('package_sub_cat');

            $sub_cat    =  array_filter($sub_cat);
            $document_sub_cat    =  array_filter($this->input->post('document_sub_cat'));
            $sub_cat    =  array_merge($sub_cat, $document_sub_cat);

            $item_id              = $this->input->post('package_item');

            $item_id    =  array_filter($item_id);
            $document_item    =  array_filter($this->input->post('document_item'));
            $item_id    =  array_merge($item_id, $document_item);

            $desc                 = $this->input->post('shipment_description_parcel');
            $desc    =  array_filter($desc);
            $other_details_document    =  array_filter($this->input->post('other_details_document'));
            $desc    =  array_merge($desc, $other_details_document);

            $other_details_parcel = $this->input->post('other_details_parcel');
            $value_shipment       = $this->input->post('value_of_shipment_parcel');
            $insur                = $this->input->post('protect_parcel');
            $quantity             = $this->input->post('quantity');
            $quantity    =  array_filter($quantity);
            $quantity    =  array_filter($this->input->post('quantity'));
            $quantity    =  array_merge($quantity, $quantity);

            $referance_parcel     = $this->input->post('referance_parcel');
            $length               = $this->input->post('length');
            $length_dimen         = $this->input->post('length_dimen');
            $height               = $this->input->post('height');
            $height_dimen         = $this->input->post('height_dimen');
            $weight               = $this->input->post('weight');
            $weight_dimen         = $this->input->post('weight_dimen');
            $breadth              = $this->input->post('breadth');
            $breadth_dimen        = $this->input->post('breadth_dimen');
            $line_total           = (int)$quantity * (int)$road_input;
        }


        $ids = ($this->input->post('ids') != '') ? $this->input->post('ids') : '';


        if ($this->form_validation->run() == false) {
            $response = ['status' => 0, 'message' => '<span style="color:#fff;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {
            //die;
            $post = $this->input->post();

            // echo (int)$quantity .'<>'. (int)$road_input;
            // echo '<pre>';print_r($line_total);die;

            // if(strlen($post['telephone']) < 10){
            //     $response = ['status' => 0, 'message' => '<span style="color:#fff;">Phone No. should be greater than 9 digits.</span>'];
            //     echo json_encode($response);
            //     die;
            // }

            // if(strlen($post['telephone_to']) < 10){
            //     $response = ['status' => 0, 'message' => '<span style="color:#fff;">Phone No (To) should be greater than 9 digits.</span>'];
            //     echo json_encode($response);
            //     die;
            // }

            //Quotation Master
            $session_id = $this->session->userdata('Customer');
            $customer_id = $session_id['id'];
            $quoteno = getSLNo(1);
            $orderno = getSLNo(2);

            $quot_data = [
                'quote_no'           => $quoteno,
                'customer_id'        => $customer_id,
                'shipment_type'      => $post['shipment_type_option'],
                'location_type'      => $post['location_type'],
                'transport_type'     => $post['charges_final'],
                // 'road'           => $road_input,
                // 'rail'           => $rail_input,
                // 'air'            => $air_input,
                // 'ship'           => $ship_input,
                'status'            => '1',
                'platform'          => '1',
                'quote_type'        => $quote_type,
                'created_by'        => $customer_id,
                'delivery_mode_id'  => $delivery_mode_id,
                'created_date'      => DTIME,
            ];

            $ins_id   = $this->OuthModel->insertQuery('quotation_master', $this->OuthModel->xss_clean($quot_data));



            //Quotation Master End 
            // $latlong_from_address_arr = getLatLongbyAddress($post['zip']);

            // Quotation From Address
            $quot_from_address = [
                'quotation_id'  => $ins_id,
                'customer_id'   => $customer_id,
                'firstname'     => $post['firstname'],
                'lastname'      => $post['lastname'],
                'address'       => $post['address_from'],
                'address2'      => $post['address2'],
                'company_name'  => $post['company_name'],
                'country'       => $post['country'],
                'state'         => $post['state'],
                'city'          => $post['city'],
                'zip'           => $post['zip'],
                'email'         => $post['email'],
                'telephone'     => $post['telephone'],
                'address_type'  => $post['user_type'],
                'latitude'      => $post['lat_from'],
                'longitude'      => $post['lng_from'],
                // 'latitude'  	=> $latlong_from_address_arr['lat'],
                // 'longitude'  	=> $latlong_from_address_arr['long'],
            ];

            $ins_from_id   = $this->OuthModel->insertQuery('quotation_from_address', $this->OuthModel->xss_clean($quot_from_address));
            // Quotation From Address End   

            // Quotation To Address
            // $latlong_to_address_arr = getLatLongbyAddress($post['zip_to']);

            $quot_to_address = [
                'quotation_id'  => $ins_id,
                'customer_id'   => $customer_id,
                'firstname'     => $post['firstname_to'],
                'lastname'      => $post['lastname_to'],
                'address'       => $post['address_to'],
                'address2'      => $post['address2_to'],
                'company_name'  => $post['company_name_to'],
                'country'       => $post['country_to'],
                'state'         => $post['state_to'],
                'city'          => $post['city_to'],
                'zip'           => $post['zip_to'],
                'email'         => $post['email_to'],
                'telephone'     => serialize($post['telephone_to']),
                'address_type'  => $post['address_type'],
                'latitude'      => $post['lat_to'],
                'longitude'      => $post['lng_to'],
                // 'latitude'  	=> $latlong_to_address_arr['lat'],
                // 'longitude'  	=> $latlong_to_address_arr['long'],
            ];
            //echo '<pre>'; print_r($quot_from_address); print_r($quot_to_address);echo '</pre>'; die;
            $ins_to_id   = $this->OuthModel->insertQuery('quotation_to_address', $this->OuthModel->xss_clean($quot_to_address));
            // Quotation To Address End

            // Items

            if (!empty($ids)) {
                $insur_multi = array();
                foreach ($ids as $key => $value) {
                    // echo $value;
                    $shipment_type_option_    = $this->input->post('shipment_type_option_' . $value);
                    if ($shipment_type_option_ == 1) {
                        $insur_multi[] = $this->input->post('protect_shipment_document' . $value);
                    } else {
                        $insur_multi[] = $this->input->post('protect_parcel' . $value);
                    }
                }
                //print_r($insur_multi);
            } else {
                $insur_multi = array();
            }




            //print_r($desc);
            foreach ($category_id as $categorykey => $categoryvalue) {

                if (!empty($insur[$categorykey]) && $categorykey == 0) {
                    $insur_v = $insur[$categorykey];
                } else {
                    $insur_v = (!empty($insur_multi)) ? $insur_multi[$categorykey - 1] : '0.00';
                }

                $catid = ($category_id[$categorykey] != '') ? $category_id[$categorykey] : '0';
                //echo '$catid' . $catid;
                $subcatid = ($sub_cat[$categorykey] != '') ? $sub_cat[$categorykey] : '0';
                $itemid = ($item_id[$categorykey] != '') ? $item_id[$categorykey] : '0';
                $description = (isset($desc[$categorykey]) && $desc[$categorykey] != '') ? $desc[$categorykey] : 'NA';
                $quantity = (isset($quantity[$categorykey]) && $quantity[$categorykey] != '') ? $quantity[$categorykey] : '1';

                //echo '$itemid' . $itemid;

                $referance_parcel = (isset($referance_parcel[$categorykey]) && $referance_parcel[$categorykey] != '') ? $referance_parcel[$categorykey] : '0';
                $length = (isset($length[$categorykey]) && $length[$categorykey] != '') ? $length[$categorykey] : '0';
                $length_dimen = (isset($length_dimen[$categorykey]) && $length_dimen[$categorykey] != '') ? $length_dimen[$categorykey] : '0';
                $height = (isset($height[$categorykey]) && $height[$categorykey] != '') ? $height[$categorykey] : '0';
                $height_dimen = (isset($height_dimen[$categorykey]) && $height_dimen[$categorykey] != '') ? $height_dimen[$categorykey] : '0';
                $weight = (isset($weight[$categorykey]) && $weight[$categorykey] != '') ? $weight[$categorykey] : '0';
                $weight_dimen = (isset($weight_dimen[$categorykey]) && $weight_dimen[$categorykey] != '') ? $weight_dimen[$categorykey] : '0';
                $breadth = (isset($breadth[$categorykey]) && $breadth[$categorykey] != '') ? $breadth[$categorykey] : '0';
                $breadth_dimen = (isset($breadth_dimen[$categorykey]) && $breadth_dimen[$categorykey] != '') ? $breadth_dimen[$categorykey] : '0';



                $quot_line = [
                    'quotation_id'          => $ins_id,
                    'category_id'           => $catid,
                    'subcategory_id'        => $subcatid,
                    'item_id'               => $itemid,
                    'desc'                  => $description,
                    'other_details_parcel'  => $other_details_parcel[$categorykey],
                    'value_shipment'        => $value_shipment[$categorykey],
                    'insur'                 => $insur_v,
                    'quantity'              => $quantity,
                    'referance_parcel'      => $referance_parcel,
                    'length'                => $length,
                    'length_dimen'          => $length_dimen,
                    'height'                => $height,
                    'height_dimen'          => $height_dimen,
                    'weight'                => $weight,
                    'weight_dimen'          => $weight_dimen,
                    'breadth'               => $breadth,
                    'breadth_dimen'         => $breadth_dimen,
                    'line_total'            => $line_total,
                    'protect_parcel'        => $insur_v,
                ];
                //echo '<pre>';print_r($quot_line);
                $ins_item_id[]   = $this->OuthModel->insertQuery('quotation_item_details', $this->OuthModel->xss_clean($quot_line));
            }
            //echo '<pre>';print_r($ins_item_id);die;
            //die;
            $charges_data = [
                'quotation_id'   => $ins_id,
                'quotation_item_details_id'   => $ins_item_id[0],
                'road'           => $road_input,
                'rail'           => $rail_input,
                'air'            => $air_input,
                'ship'           => $ship_input,
            ];
            $charges_insid = $this->OuthModel->insertQuery('quotation_charges', $this->OuthModel->xss_clean($charges_data));

            if (!empty($ids)) {
                foreach ($ids as $key => $value) {
                    // echo $value;
                    //echo $post['rail_document_input_'.$value];
                    $shipment_type_option_    = $this->input->post('shipment_type_option_' . $value);
                    if ($shipment_type_option_ == 1) {
                        $road_input_    = $this->input->post('road_document_input_' . $value);
                        $rail_input_    = $this->input->post('rail_document_input_' . $value);
                        $air_input_    = $this->input->post('air_document_input_' . $value);
                        $ship_input_    = $this->input->post('ship_document_input_' . $value);
                    } else {
                        $road_input_    = $this->input->post('road_parcel_input_' . $value);
                        $rail_input_    = $this->input->post('rail_parcel_input_' . $value);
                        $air_input_     = $this->input->post('air_parcel_input_' . $value);
                        $ship_input_    = $this->input->post('ship_parcel_input_' . $value);
                    }


                    $charges_data_ = [
                        'quotation_id'   => $ins_id,
                        'quotation_item_details_id'   => $ins_item_id[$key + 1],
                        'road'           => $road_input_,
                        'rail'           => $rail_input_,
                        'air'            => $air_input_,
                        'ship'           => $ship_input_,
                    ];

                    //print_r($charges_data_);
                    $charges_insid_ = $this->OuthModel->insertQuery('quotation_charges', $this->OuthModel->xss_clean($charges_data_));
                }
            }

            //die;
            if ($quote_type == 1) {
                //create order / shipment
                if ($ins_id != false) {

                    $quote_id_enc    = $this->OuthModel->Encryptor('encrypt', $ins_id);

                    // $sessionData = $this->session->userdata('Customer');
                    // $id          = $sessionData['id'];

                    // $add_order = $this->customer_model->saveOrder($id, $orderno, $ins_id, $payment_mode, 1);

                    // if ($add_order == true) {
                    $messageString = [
                        'status' => 1, 'message' => 'Thank you for choosing. Please proceed with payment.',
                        'redirectUrl'              => base_url('/place-order/' . $quote_id_enc),
                    ];
                    // } else {
                    //     $messageString = [
                    //         'status' => 0, 'message' => 'Error in order creation!',
                    //         'redirectUrl'              => base_url('/home'),
                    //     ];
                    // }
                    echo json_encode($messageString);
                } else {
                    $messageString = [
                        'status' => 0,
                        'message'                  => 'Failed to Create Order, Please try again !',
                        'redirectUrl'              => base_url('home'),
                    ];
                    echo json_encode($messageString);
                }
            } else {
                if ($ins_id != false) {

                    $messageString = [
                        'status' => 1, 'message' => 'Quotation has been successfully created.',
                        'redirectUrl'              => base_url('/quotation'),
                    ];
                    echo json_encode($messageString);
                } else {
                    $messageString = [
                        'status' => 0,
                        'message'                  => 'Failed to Create Quotation, Please try again !',
                        'redirectUrl'              => base_url('home'),
                    ];
                    echo json_encode($messageString);
                }
            }
        }
    }

    public function onSaveOrder()
    {
        // $this->saveQuote();

        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        if ($sessionData['logged_in'] != 'TRUE') {
            redirect(base_url('/'));
        }
        $data        = array();

        $orderno = getSLNo(2);
        $quote_id    = $this->OuthModel->Encryptor('decrypt', $this->input->post('quote_id_enc'));
        $quote_from_details     = $this->customer_model->getFromAddressByQuoteID($quote_id);
        //echo '<pre>'; print_r($quote_from_details); print_r($_REQUEST);die;
        if ($orderno != '') {
            $payment_mode       = $this->input->post('payment_mode');
            $quote_id_enc      = $this->input->post('quote_id_enc');
            $credit_outstanding_amount     = $this->input->post('credit_outstanding_amount');

            //price details
            $subtotal      = $this->input->post('subtotal');
            $discount      = $this->input->post('discount');
            $ga_percentage      = $this->input->post('ga_percentage');
            $ga_tax_amt      = $this->input->post('ga_tax_amt');
            $ra_percentage      = $this->input->post('ra_percentage');
            $ra_tax_amt      = $this->input->post('ra_tax_amt');
            $grand_total      = $this->input->post('grand_total');

            $priceData = array(
                'shipment_id' => '',
                'subtotal' => $subtotal,
                'discount' => $discount,
                'ga_percentage' => $ga_percentage,
                'ga_tax_amt' => $ga_tax_amt,
                'ra_percentage' => $ra_percentage,
                'ra_tax_amt' => $ra_tax_amt,
                'grand_total' => $grand_total
            );
            // For Authorize net payment gateway
            $transaction_id = '';
            if ($payment_mode == '2') {
                $this->load->library('authorize_net');

                $fname = $quote_from_details[0]['firstname'];
                $lname = $quote_from_details[0]['lastname'];
                $address = $quote_from_details[0]['address'];
                $city = $quote_from_details[0]['city_name'];
                $state = $quote_from_details[0]['state_name'];
                $country = $quote_from_details[0]['country_name'];
                $zip = $quote_from_details[0]['zip'];
                $email = $quote_from_details[0]['email'];
                $telephone = $quote_from_details[0]['telephone'];

                $ccno = $this->input->post('card_number');
                $amount = $this->input->post('grand_total');
                $card_exp_month = $this->input->post('card_exp_month');
                $card_exp_year = $this->input->post('card_exp_year');
                $cvv = $this->input->post('card_cvc');

                // Lets do a test transaction
                $this->authorize_net->add_x_field('x_first_name', $fname);
                $this->authorize_net->add_x_field('x_last_name', $lname);
                $this->authorize_net->add_x_field('x_address', $address);
                $this->authorize_net->add_x_field('x_city', $city);
                $this->authorize_net->add_x_field('x_state', $state);
                $this->authorize_net->add_x_field('x_zip', $zip);
                $this->authorize_net->add_x_field('x_country', $country);
                $this->authorize_net->add_x_field('x_email', $email);
                $this->authorize_net->add_x_field('x_phone', $telephone);

                /**
                 * Use credit card number 4111111111111111 for a god transaction
                 * Use credit card number 4111111111111122 for a bad card
                 */
                $this->authorize_net->add_x_field('x_card_num', "$ccno");

                $this->authorize_net->add_x_field('x_amount', "$amount");
                $this->authorize_net->add_x_field('x_exp_date', $card_exp_month . $card_exp_year); // MMYY
                $this->authorize_net->add_x_field('x_card_code', $cvv);

                $this->authorize_net->process_payment();
                $authnetreponse = $this->authorize_net->get_all_response_codes();
                //echo '<pre>'; print_r($authnetreponse);die;
                if ($authnetreponse['Response_Code'] == '1') {

                    /*$data['authresponse'] = $authnetreponse;Transaction_ID
				$this->load->view('auth_success', $data);*/
                    $transaction_id = $authnetreponse['Transaction_ID'];
                } elseif ($authnetreponse['Response_Code'] == '2') {
                    $messageString = [
                        'status' => 0, 'message' => $authnetreponse['Response_Reason_Text'],
                        'redirectUrl'  => base_url('/place-order/' . $quote_id_enc),
                    ];
                    echo json_encode($messageString);
                    die;
                } elseif ($authnetreponse['Response_Code'] == '3') {
                    $messageString = [
                        'status' => 0, 'message' => $authnetreponse['Response_Reason_Text'],
                        'redirectUrl'  => base_url('/place-order/' . $quote_id_enc),
                    ];
                    echo json_encode($messageString);
                    die;
                }
            }

            // Update user outstanding amount
            if ($payment_mode == '3') {
                $outstanding_amount = $credit_outstanding_amount - $grand_total;
                $creditAmount = array(
                    'credit_outstanding_amount' => $outstanding_amount
                );
                $this->customer_model->updateOutstandinAmount($id, $creditAmount);
            }
            $quote_id    = $this->OuthModel->Encryptor('decrypt', $quote_id_enc);
            // echo $orderno. ' '. $quote_id.' '.$payment_mode;die;
            $add_order = $this->customer_model->saveOrder($id, $orderno, $quote_id, $payment_mode, 1, $priceData, $transaction_id);

            if ($add_order == true) {
                $messageString = [
                    'status' => 1, 'message' => 'Order has been successfully created.',
                    'redirectUrl'   => base_url('/place-order/' . $quote_id_enc),
                ];
            } else {
                $messageString = [
                    'status' => 0, 'message' => 'Pincode is not linked to any branch! Order Cannot be placed!',
                    'redirectUrl'  => base_url('/place-order/' . $quote_id_enc),
                ];
            }
        } else {
            $messageString = [
                'status' => 0, 'message' => 'quotation not found!',
                'redirectUrl'  => base_url('/home'),
            ];
        }

        echo json_encode($messageString);
    }


    public function viewQuotePrint()
    {
        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        if ($sessionData['logged_in'] != 'TRUE') {
            redirect(base_url('/'));
        }
        $data        = array();

        $quote_id    = $this->OuthModel->Encryptor('decrypt', $this->uri->segment(2));

        $data['quote_details']          = $this->Users_model->quotationDetails($quote_id);
        $data['quote_from_details']     = $this->Users_model->quotationFromDetails($quote_id);
        $data['quote_to_details']       = $this->Users_model->quotationToDetails($quote_id);
        $data['quote_item_details']     = $this->Users_model->quotationItemDetails($quote_id);
        $data['tax'] = $this->customer_model->getTax();
        //print_r($data);die;
        $this->parser->parse('frontend/view-quote-print', $data);
    }

    public function sendQuoteMail()
    {
        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        if ($sessionData['logged_in'] != 'TRUE') {
            redirect(base_url('/'));
        }
        $data        = array();

        $quote_id    = $this->OuthModel->Encryptor('decrypt', $this->uri->segment(2));

        $data['quote_details']          = $this->Users_model->quotationDetails($quote_id);
        $data['quote_from_details']     = $this->Users_model->quotationFromDetails($quote_id);
        $data['quote_to_details']       = $this->Users_model->quotationToDetails($quote_id);
        $data['quote_item_details']     = $this->Users_model->quotationItemDetails($quote_id);
        //print_r($data);die;
        $this->parser->parse('frontend/view-quote-print', $data);
    }

    public function getGLocation()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/place/autocomplete/json?key=AIzaSyAAt4LSIfqh9KL_w3a9aQffOTrQ5n5neX0&input=kolkata');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Accept: */*';
        $headers[] = 'User-Agent: Thunder Client (https://www.thunderclient.io)';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        //echo '<pre>'; print_r($result);die;


        // $url = "https://maps.googleapis.com/maps/api/place/details/json?key=AIzaSyAAt4LSIfqh9KL_w3a9aQffOTrQ5n5neX0&placeid=ChIJZ_YISduC-DkRvCxsj-Yw40M";

        // $curl = curl_init($url);
        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // $headers = array(
        //     "Accept: */*",
        //     "User-Agent: Thunder Client (https://www.thunderclient.io)",
        // );
        // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        // //for debug only!
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        // $resp = curl_exec($curl);
        // curl_close($curl);
        // var_dump($resp);



        echo json_encode($result);
    }

    public function onPlaceOrder()
    {
        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        if ($sessionData['logged_in'] != 'TRUE') {
            redirect(base_url('/'));
        }

        $quote_id_enc    = $this->uri->segment(2);
        $quote_id    = $this->OuthModel->Encryptor('decrypt', $quote_id_enc);

        $data['quote_details']          = $this->Users_model->quotationDetails($quote_id);
        $data['quote_from_details']     = $this->Users_model->quotationFromDetailsNew($quote_id);
        $data['quote_to_details']       = $this->Users_model->quotationToDetailsNew($quote_id);
       
        $data['quote_item_details']     = $this->Users_model->quotationItemDetails($quote_id);
        $data['shipment_details']     = $this->customer_model->getShipmentDetails(array('quotation_id' => $quote_id));
         die('==');
        $data['profile_details'] = $this->OveModel->Read_User_Information($id);
        $data['prohibitedList']  = $this->prohibited_model->getProhibitedList();
        $data['quote_id_enc'] = $quote_id_enc;
        $data['tax'] = $this->customer_model->getTax();

        $this->parser->parse('frontend/place_order', $data);
    }

    public function onGetOrders()
    {
        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        if ($sessionData['logged_in'] != 'TRUE') {
            redirect(base_url('/'));
        }

        $data['profile_details'] = $this->OveModel->Read_User_Information($id);
        $data['orders_list']  = $this->customer_model->getShipmentByUserWithStatus($id);
        //echo '<pre>';print_r($data['quotation_list']);die;
        $this->parser->parse('frontend/orders', $data);
    }

    public function trackOrder()
    {
        // if ($sessionData['logged_in'] != 'TRUE') {
        //     redirect(base_url('/'));
        // }
        $data        = array();
        // $sessionData = $this->session->userdata('Customer');
        // $id          = $sessionData['id'];
        // $data['sessionData'] = $sessionData;
        //$data['all_orders'] = $this->Users_model->getCustomerOrdersNo($id,TRUE);
        $this->parser->parse('frontend/tracking', $data);
    }

    public function getOrderTrackDetails()
    {
        $this->form_validation->set_rules('shipment_no', 'Tracking No', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $response = ['status' => 0, 'message' => '<span style="color:#fff;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {

            $this->form_validation->set_rules(
                'shipment_no',
                'Tracking No',
                'trim|required|xss_clean|is_unique[shipment_master.shipment_no]',
                array(
                    'is_unique' => 'Tracking No %s Found.',
                )
            );

            if ($this->form_validation->run() == false) {
                $post = $this->input->post();
                $shipment_no = $post['shipment_no'];
                $data['shipment_list']  = $this->customer_model->getOrderStatus($shipment_no);

                $response = [
                    'status' => 1, 'message' => 'Shipment Found',
                    'redirectUrl'   => base_url('/tracking-details/' . $this->OuthModel->Encryptor('encrypt', $data['shipment_list'][0]['shipment_no'])),
                ];

                echo json_encode($response);
                die;
            } else {
                $response = ['status' => 0, 'message' => '<span style="color:#fff;">Tracking No. not Found.</span>'];
                echo json_encode($response);
                die;
            }
        }
    }

    public function trackingDetails()
    {
        $shipment_no    = $this->uri->segment(2);
        $shipment_number = $this->OuthModel->Encryptor('decrypt', $shipment_no);
        $sessionData = $this->session->userdata('Customer');
        //$id          = $sessionData['id'];
        $data['sessionData'] = $sessionData;
        if ($shipment_number == '') {
            $this->session->set_flashdata('error', 'Not a valid Tracking No.');
            $data['shipment_list'] = '';
            redirect(base_url('/order-tracking'));
            die;
        } else {
            $data['shipment_list']  = $this->customer_model->getOrderStatus($shipment_number);
        }
        $this->parser->parse('frontend/tracking-details', $data);
    }

    public function saveQuoteReq()
    {
        //echo '<pre>';print_r($_POST);

        $quote_type    = ($this->input->post('quote_type') != '') ? $this->input->post('quote_type') : 0;

        $this->form_validation->set_rules('location_type', 'Location Type', 'required');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address_from', 'Address From', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('address2', 'Address From 2nd', 'trim|required|xss_clean');
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|xss_clean');
        $this->form_validation->set_rules('zip', 'Zip', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_type', 'Address Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('firstname_to', 'First Name To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname_to', 'Last Name To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address_to', 'Address To', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('address2_to', 'Address To 2nd', 'trim|required|xss_clean');
        $this->form_validation->set_rules('company_name_to', 'Company Name To', 'trim|xss_clean');
        $this->form_validation->set_rules('country_to', 'Country To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('state_to', 'State To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('city_to', 'City To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('zip_to', 'Zip To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email_to', 'Email To', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('address_type', 'Address Type To', 'trim|xss_clean');
        $this->form_validation->set_rules('telephone_to[]', 'Telephone To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address_type', 'Address Type', 'trim|required|xss_clean');


        if ($this->form_validation->run() == false) {
            $response = ['status' => 0, 'message' => '<span style="color:#fff;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {
            //die;
            $post = $this->input->post();
            $latitude_from              = $this->input->post('latitude_from');
            $longitude_from              = $this->input->post('longitude_from');
            $latitude_to              = $this->input->post('latitude_to');
            $longitude_to              = $this->input->post('longitude_to');

            //echo '<pre>'; print_r($post);echo '</pre>';die;
            //Quotation Master
            $session_id = $this->session->userdata('Customer');
            $customer_id = $session_id['id'];
            $quoteno = getSLNo(1);

            $quot_data = [
                'quote_no'           => $quoteno,
                'customer_id'        => $customer_id,
                'shipment_type'      => $post['shipment_type_option'],
                'location_type'      => $post['location_type'],
                'delivery_mode_id'  => $post['delivery_speed'],
                // 'transport_type'  	=> $post['charges_final'],
                'status'             => '1',
                'platform'           => '1',
                'quote_type'         => $quote_type,
                'created_by'         => $customer_id,
                'created_date'       => DTIME,
            ];

            $ins_id   = $this->OuthModel->insertQuery('quotation_master', $this->OuthModel->xss_clean($quot_data));



            //Quotation Master End 

            // Quotation From Address
            // $latlong_from_address_arr = getLatLongbyAddress($post['zip']);
            $quot_from_address = [
                'quotation_id'  => $ins_id,
                'customer_id'   => $customer_id,
                'firstname'     => $post['firstname'],
                'lastname'      => $post['lastname'],
                'address'       => $post['address_from'],
                'address2'      => $post['address2'],
                'company_name'  => $post['company_name'],
                'country'       => $post['country'],
                'state'         => $post['state'],
                'city'          => $post['city'],
                'zip'           => $post['zip'],
                'email'         => $post['email'],
                'telephone'     => $post['telephone'],
                'address_type'  => $post['user_type'],
                'latitude'      => $latitude_from,
                'longitude'      => $longitude_from
            ];

            $ins_from_id   = $this->OuthModel->insertQuery('quotation_from_address', $this->OuthModel->xss_clean($quot_from_address));
            // Quotation From Address End   

            // Quotation To Address
            // $latlong_to_address_arr = getLatLongbyAddress($post['zip_to']);
            $quot_to_address = [
                'quotation_id'  => $ins_id,
                'customer_id'   => $customer_id,
                'firstname'     => $post['firstname_to'],
                'lastname'      => $post['lastname_to'],
                'address'       => $post['address_to'],
                'address2'      => $post['address2_to'],
                'company_name'  => $post['company_name_to'],
                'country'       => $post['country_to'],
                'state'         => $post['state_to'],
                'city'          => $post['city_to'],
                'zip'           => $post['zip_to'],
                'email'         => $post['email_to'],
                'telephone'     => serialize($post['telephone_to']),
                'address_type'  => $post['address_type'],
                'latitude'      => $latitude_to,
                'longitude'      => $longitude_to
            ];

            $ins_to_id   = $this->OuthModel->insertQuery('quotation_to_address', $this->OuthModel->xss_clean($quot_to_address));
            // Quotation To Address End


            if ($ins_id != false) {

                //branch allocation and pd boy assign

                $setData   = $this->customer_model->assignQuoteReq($customer_id, $ins_id);

                $email_to = ADMIN_EMAIL;
                $name = $post['firstname'] . ' ' . $post['lastname'];

                $email_body = '';
                $email_body .= '<p>Dear Admin,</p>';
                $email_body .= '<p>A new quotation request has come.</p>';
                $email_body .= '<p>Here are the details:</p>';
                $email_body .= '<p>Quotation No: ' . $quoteno . '</p>';

                $email_body .= '<p>From details:</p>';
                $email_body .= '<p>Name: ' . $name . '</p>';
                $email_body .= '<p>Address: ' . $post['address_from'] . '</p>';
                $email_body .= '<p>ZIP: ' . $post['zip'] . '</p>';

                $email_body .= '<p>To details:</p>';
                $email_body .= '<p>Name: ' . $post['firstname_to'] . ' ' . $post['lastname_to'] . '</p>';
                $email_body .= '<p>Address: ' . $post['address_to'] . '</p>';
                $email_body .= '<p>ZIP: ' . $post['zip_to'] . '</p>';

                if ($email_to != '' && $email_body != '' && $name != '') {

                    //echo $email_body;die;

                    $from_email = ADMIN_EMAIL;
                    $replyemail = ADMIN_EMAIL;
                    $subject    = "Mail From Royal Sherry";

                    // $body = '';
                    // $body .= '<p>Name : ' . $name . '</p>';

                    $this->load->library('email');

                    $config = array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'smtp.googlemail.com',
                        'smtp_port' => 465,
                        'smtp_user' => 'noreply@staqo.com',
                        'smtp_pass' => 'Welcome@123',
                        'mailtype' => 'html',
                        'smtp_crypto' => 'ssl',
                        'smtp_timeout' => '4',
                        'charset' => 'utf-8',
                        'wordwrap' => TRUE
                    );
                    $this->email->initialize($config);

                    //$email_body = '<p>test</p>';


                    $this->email->set_newline("\r\n");
                    $this->email->set_mailtype("html");
                    $this->email->from($from_email, $name);
                    $this->email->to($email_to);
                    $this->email->reply_to($replyemail);
                    $this->email->subject($subject);
                    $this->email->message($email_body);
                    if ($this->email->send()) {
                        // $return['mailsent'] = '1';
                        // $return['message'] = 'Email Sent!';
                    } else {
                        // echo $this->email->print_debugger();die;
                        // $return['mailsent'] = '0';
                        // $return['message'] = 'SMTP Error: Email Not Sent!';
                    }
                } else {
                    // $return['mailsent'] = '0';
                    // $return['message'] = 'Required fields missing!';
                }

                $messageString = [
                    'status' => 1, 'message' => 'Quotation request submitted successfully, PD Boy will contact you soon.',
                    'redirectUrl'              => base_url('/quotation'),
                ];
                echo json_encode($messageString);
            } else {
                $messageString = [
                    'status' => 0,
                    'message'                  => 'Failed to Create Quotation request, Please try again !',
                    'redirectUrl'              => base_url('home'),
                ];
                echo json_encode($messageString);
            }
        }
    }

    public function sendQuoteEmail()
    {
        $email_to = $this->input->post('email_to');
        $email_body = $this->input->post('email_body');
        $name = $this->input->post('name');
        if ($email_to != '' && $email_body != '' && $name != '') {

            //echo $email_body;die;

            $from_email = ADMIN_EMAIL;
            $replyemail = ADMIN_EMAIL;
            $subject    = "Mail From Royal Sherry";

            // $body = '';
            // $body .= '<p>Name : ' . $name . '</p>';

            $this->load->library('email');

            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'noreply@staqo.com',
                'smtp_pass' => 'Welcome@123',
                'mailtype' => 'html',
                'smtp_crypto' => 'ssl',
                'smtp_timeout' => '4',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );
            $this->email->initialize($config);

            //$email_body = '<p>test</p>';


            $this->email->set_newline("\r\n");
            $this->email->set_mailtype("html");
            $this->email->from($from_email, $name);
            $this->email->to($email_to);
            $this->email->reply_to($replyemail);
            $this->email->subject($subject);
            $this->email->message($email_body);
            if ($this->email->send()) {
                $return['mailsent'] = '1';
                $return['message'] = 'Email Sent!';
            } else {
                // echo $this->email->print_debugger();die;
                $return['mailsent'] = '0';
                $return['message'] = 'SMTP Error: Email Not Sent!';
            }
        } else {
            $return['mailsent'] = '0';
            $return['message'] = 'Required fields missing!';
        }
        echo json_encode($return);
    }

    public function sendGetinTouch()
    {
        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        $profile_details = $this->OveModel->Read_User_Information($id);
        //print_r($profile_details);die;
        if (!empty($profile_details)) {
            $name          = $profile_details['firstname'] . ' ' . $profile_details['lastname'];
            $phone          = $profile_details['telephone'];
            $email          = $profile_details['email'];
        } else {
            $name          = '';
            $phone          = '';
            $email          = '';
        }

        $email_to = 'noreply@staqo.com';
        $zip_code = $this->input->post('zip_code');
        $comment = $this->input->post('comment');
        if ($comment != '' && $zip_code != '') {

            $from_email = ADMIN_EMAIL;
            $replyemail = ADMIN_EMAIL;
            $subject    = "Mail From Royal Sherry";

            $body = '';
            $body .= '<p>Name : ' . $name . '</p>';
            $body .= '<p>Registered Email : ' . $email . '</p>';
            $body .= '<p>Registered Phone : ' . $phone . '</p>';
            $body .= '<p>Entered Zip Code : ' . $zip_code . '</p>';
            $body .= '<p>Comment : ' . $comment . '</p>';

            // echo $body;die;

            $this->load->library('email');
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'noreply@staqo.com',
                'smtp_pass' => 'Welcome@123',
                'mailtype' => 'html',
                'smtp_crypto' => 'ssl',
                'smtp_timeout' => '4',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );
            $this->email->initialize($config);


            $this->email->set_newline("\r\n");
            $this->email->set_mailtype("html");
            $this->email->from($from_email, $name);
            $this->email->to($email_to);
            $this->email->reply_to($replyemail);
            $this->email->subject($subject);
            $this->email->message($body);
            if ($this->email->send()) {
                $return['mailsent'] = '1';
                $return['message'] = 'Email Sent!';
            } else {
                // echo $this->email->print_debugger();die;
                $return['mailsent'] = '0';
                $return['message'] = 'SMTP Error: Email Not Sent!';
            }
        } else {
            $return['mailsent'] = '0';
            $return['message'] = 'Required fields missing!';
        }
        echo json_encode($return);
    }

    public function branchList()
    {
        $data = array();
        $data['title'] = "Branch List";
        $data['description'] = "Royal Sherry - Branch List";
        $data['keyword'] = "Branch List";
        $data['branchList']  =   $this->branch_model->getBranchList('1');
        $this->load->view('frontend/branch-list', $data);
    }

    public function onGetNewsDetails()
    {
        $news_id = xss_clean($this->uri->segment(2));
        $data = array();
        $data['title'] = "News Details";
        $data['description'] = "Royal Sherry - News Details";
        $data['keyword'] = "News";

        if ($news_id != '') {
            $newsData = $this->news_model->getNews(array('id' => $news_id));
            // echo '<pre>';print_r($newsData);die;
            if (!empty($newsData)) {
                $newsData = $newsData;
            } else {
                $newsData = [];
            }
        } else {
            $newsData = [];
        }
        $data['newsData'] = $newsData;
        $this->load->view('frontend/news_details', $data);
    }
}
