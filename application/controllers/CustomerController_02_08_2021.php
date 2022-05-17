<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('prohibited_model');
        $this->load->model('customer_model');
        //$this->load->model('User_model', 'OveModel', 'OuthModel');
    }

    public function index()
    {
        $this->load->view('frontend/index', []);
    }

    public function login()
    {
        $this->load->view('frontend/login', []);
    }

    public function logout()
    {
        $this->session->unset_userdata('Customer');
        //$this->session->sess_destroy();
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
        //$this->form_valisdation->set_rules('tc', 'terms & conditions', 'required');
        // echo '<pre>';
        // print_r($_POST);die;
        if ($this->form_validation->run() == false) {
            $response = ['status' => 0, 'message' => '<span style="color:#fff;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {

            $post = $this->input->post();

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
                    'add_date'    => date('Y-m-d H:i:s'),
                ];
                $user_id = $this->User_model->AddMember($this->OuthModel->xss_clean($user_data));

                if ($user_id != false) {

                    $messageString = "Your are registerd successfully !";

                    $user = $this->OveModel->Read_User_Information($user_id);

                    $from_email = "royalserry@lnsel.com";
                    $replyemail = "royalserry@lnsel.com";
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
                        'smtp_host' => 'tethys.safeukdns.net',
                        'smtp_port' => 465,
                        'smtp_user' => ADMIN_EMAIL,
                        'smtp_pass' => ADMIN_EMAIL_PASS,
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
                        'message'                  => 'Faild to register, Please try again !',
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
        $res     = $this->User_model->EmailVerifyStatusUpdate($user_id);

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
                        'message'            => 'You are now successfully Login !',
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

        $ifexists = $this->User_model->IfExistEmail($email);
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
                    'status' => 1, 'message' => 'Your new password has been sent to your email address. !',
                    'redirectUrl'        => base_url('/'),
                ];
            } else {

                $message = [
                    'status' => 0,
                    'message'            => 'Faild to password updated, Please try again !',
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
            $states = $this->User_model->statesSelect($country_id);
        }
        echo json_encode($states);
    }

    public function getCity()
    {
        $states     = array();
        $country_id = $this->input->post('state_id');
        if ($country_id) {
            $states = $this->User_model->citiesSelect($country_id);
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
            redirect(base_url('/'));
        }
        $sessionData             = $this->session->userdata('Customer');
        $id                      = $sessionData['id'];
        $data['profile_details'] = $this->OveModel->Read_User_Information($id);
        $data['prohibitedList']  = $this->prohibited_model->getProhibitedList();
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
            $response = ['status' => 0, 'message' => '<span style="color:#900;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {

            $post = $this->input->post();

            $user_data = [
                'firstname'   => $post['firstname'],
                'lastname'    => $post['lastname'],
                'user_type'   => $post['user_type'],
                'companyname' => $post['companyname'],
                'website'     => $post['website'],
                'telephone'   => $post['telephone'],
                'address'     => $post['address'],
                'address2'    => $post['address2'],
                'country'     => $post['country'],
                'state'       => $post['state'],
                'city'        => $post['city'],
                'zip'         => $post['zip'],
                'add_date'    => date('Y-m-d H:i:s'),
            ];

            $user_id = $this->OuthModel->UpdateQuery('users', $this->OuthModel->xss_clean($user_data), 'user_id', $id);
            if ($user_id != false) {
                $messageString = 'Data has been successfully Updated';
                echo json_encode(['status' => 1, 'message' => $messageString, 'redirectUrl' => base_url('home')]);
            } else {
                echo json_encode(['status' => 0, 'message' => "Faild to Update, Please try again !", 'redirectUrl' => base_url('profile')]);
            }
        }
    }

    public function getDocumentCategory()
    {
        $items     = array();
        $category_id = $this->input->post('category_id');
        if ($category_id) {
            $items = $this->User_model->documentItemSelect($category_id);
        }
        echo json_encode($items);
    }

    public function getPackageCategory()
    {
        $items     = array();
        $category_id = $this->input->post('category_id');
        if ($category_id) {
            $items = $this->User_model->packageItemSelect($category_id);
        }
        echo json_encode($items);
    }

    public function getShipmentChanges()
    {
        $ship_cat_id        = $this->input->post('ship_cat_id');
        $ship_subcat_id     = $this->input->post('ship_subcat_id');
        $rate_type          = $this->input->post('rate_type');
        $location_from      = $this->input->post('location_from');
        $location_to        = $this->input->post('location_to');

        $rates = $this->User_model->shipmentRate($ship_cat_id, $ship_subcat_id, $rate_type, $location_from, $location_to);

        echo json_encode($rates);
    }

    public function saveQuote()
    {
        // echo '<pre>';
        // print_r($_POST); die;

        $shipment_type_option   = $this->input->post('shipment_type_option');
        $document_other         = $this->input->post('document_other');
        $parcel_other           = $this->input->post('parcel_other');
        $quote_type    = ($this->input->post('quote_type') != '')?$this->input->post('quote_type'):0;
        

        $this->form_validation->set_rules('location_type', 'Location Type', 'required');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'Address From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address2', 'Address From 2nd', 'trim|required|xss_clean');
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|xss_clean');
        $this->form_validation->set_rules('zip', 'Zip', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_type', 'Address Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('firstname_to', 'First Name To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname_to', 'Last Name To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address_to', 'Address To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address2_to', 'Address To 2nd', 'trim|required|xss_clean');
        $this->form_validation->set_rules('company_name_to', 'Company Name To', 'trim|xss_clean');
        $this->form_validation->set_rules('country_to', 'Country To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('state_to', 'State To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('city_to', 'City To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('zip_to', 'Zip To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email_to', 'Email To', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('address_type', 'Address Type To', 'trim|xss_clean');
        $this->form_validation->set_rules('telephone_to[]', 'Telephone To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('shipment_type_option', 'Shipment Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address_type', 'Address Type', 'trim|required|xss_clean');


        if ($shipment_type_option == 1) {
            // IF Document Selected
            $this->form_validation->set_rules('document_category[]', 'Document Category', 'trim|required|xss_clean');
            $this->form_validation->set_rules('document_item[]', 'Document Item', 'trim|required|xss_clean');

            if ($document_other == 1) {
                // IF Other Selected
                $this->form_validation->set_rules('document_other[]', 'Other Details', 'trim|xss_clean');
                $this->form_validation->set_rules('other_details_document[]', 'Other Details', 'trim|xss_clean');
                // IF Other Selected End    
            }

            $this->form_validation->set_rules('value_of_shipment_document[]', 'Value Of Shipment', 'trim|required|xss_clean');
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
            $item_id              = $this->input->post('document_item');
            $desc                 = $this->input->post('other_details_document');
            $other_details_parcel = $this->input->post('other_details_parcel');
            $value_shipment       = $this->input->post('value_of_shipment_document');
            $insur                = $this->input->post('protect_shipment_document');
            $quantity             = $this->input->post('quantity');
            $line_total           = (int)$quantity * (int)$road_input;
            
            //Document End 
        } else {
            //Parcel Selected
            $this->form_validation->set_rules('package_category[]', 'package_category', 'trim|required|xss_clean');
            $this->form_validation->set_rules('package_item[]', 'package_item', 'trim|required|xss_clean');

            if ($parcel_other == 1) {
                // IF Other Selected
                $this->form_validation->set_rules('parcel_other[]', 'Parcel Other', 'trim|required|xss_clean');
                $this->form_validation->set_rules('other_details_parcel[]', 'Other Details', 'trim|xss_clean');
                // IF Other Selected End
            }

            $this->form_validation->set_rules('shipment_description_parcel[]', 'shipment_description_parcel', 'trim|required|xss_clean');
            $this->form_validation->set_rules('value_of_shipment_parcel[]', 'Value Of Shipment', 'trim|required|xss_clean');
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
            $item_id              = $this->input->post('package_item');
            $desc                 = $this->input->post('shipment_description_parcel');
            $other_details_parcel = $this->input->post('other_details_parcel');
            $value_shipment       = $this->input->post('value_of_shipment_parcel');
            $insur                = $this->input->post('protect_parcel');
            $quantity             = $this->input->post('quantity');
            $line_total           = (int)$quantity * (int)$road_input;
        }
        

        if ($this->form_validation->run() == false) {
            $response = ['status' => 0, 'message' => '<span style="color:#fff;">' . validation_errors() . '</span>'];
            echo json_encode($response);
            die;
        } else {
            //die;
            $post = $this->input->post();

            //Quotation Master
            $session_id = $this->session->userdata('Customer');
            $customer_id = $session_id['id'];
            $quot_data = [
                'quote_no'       => ($quote_type == 0)?getSLNo(1):getSLNo(2),
                'customer_id'    => $customer_id,
                'shipment_type'  => $post['shipment_type_option'],
                'location_type'  => $post['location_type'],
                'road'           => $road_input,
                'rail'           => $rail_input,
                'air'            => $air_input,
                'ship'           => $ship_input,
                'status'         => '1',
                'platform'       => '1',
                'quote_type'       => ($quote_type != 0)?$quote_type:0,
                'created_by'     => $customer_id,
                'created_date'   => date('Y-m-d H:i:s'),
            ];
            $ins_id   = $this->OuthModel->insertQuery('quotation_master', $this->OuthModel->xss_clean($quot_data));
            //Quotation Master End 

            // Quotation From Address
            $quot_from_address = [
                'quotation_id'  => $ins_id,
                'customer_id'   => $customer_id,
                'firstname'     => $post['firstname'],
                'lastname'      => $post['lastname'],
                'address'       => $post['address'],
                'address2'      => $post['address2'],
                'company_name'  => $post['company_name'],
                'country'       => $post['country'],
                'state'         => $post['state'],
                'city'          => $post['city'],
                'zip'           => $post['zip'],
                'email'         => $post['email'],
                'telephone'     => $post['telephone'],
                'address_type'  => $post['user_type'],
            ];

            $ins_from_id   = $this->OuthModel->insertQuery('quotation_from_address', $this->OuthModel->xss_clean($quot_from_address));
            // Quotation From Address End   

            // Quotation To Address
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
            ];

            $ins_to_id   = $this->OuthModel->insertQuery('quotation_to_address', $this->OuthModel->xss_clean($quot_to_address));
            // Quotation To Address End

            // Items
            
            foreach ($category_id as $categorykey => $categoryvalue) {
                $quot_line = [
                    'quotation_id'  => $ins_id,
                    'category_id'   => $category_id[$categorykey],
                    'item_id'     => $item_id[$categorykey],
                    'desc'      => $desc[$categorykey],
                    'other_details_parcel'       => $other_details_parcel[$categorykey],
                    'value_shipment'      => $value_shipment[$categorykey],
                    'insur'      => (!empty($insur))?$insur[$categorykey]:'',
                    'quantity'      => $quantity[$categorykey],
                    'line_total'      => $line_total,
                ];

                $ins_to_id   = $this->OuthModel->insertQuery('quotation_item_details', $this->OuthModel->xss_clean($quot_line));
            }


            ///die;
            if($quote_type == 1){
                if ($ins_id != false) {

                    $messageString = [
                        'status' => 1, 'message' => 'Order has been successfully created.',
                        'redirectUrl'              => base_url('/home'),
                    ];
                    echo json_encode($messageString);
                } else {
                    $messageString = [
                        'status' => 1,
                        'message'                  => 'Faild to Create Order, Please try again !',
                        'redirectUrl'              => base_url('home'),
                    ];
                    echo json_encode($messageString);
                }
            }else{
                if ($ins_id != false) {

                    $messageString = [
                        'status' => 1, 'message' => 'Quotation has been successfully created.',
                        'redirectUrl'              => base_url('/quotation'),
                    ];
                    echo json_encode($messageString);
                } else {
                    $messageString = [
                        'status' => 1,
                        'message'                  => 'Faild to Create Quotation, Please try again !',
                        'redirectUrl'              => base_url('home'),
                    ];
                    echo json_encode($messageString);
                }
            }
            
        }
    }
    

    public function viewQuotePrint()
    {
        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        if ($sessionData['logged_in'] != 'TRUE') {
            redirect(base_url('/'));
        }
        $data        = array();
        $sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];

        $quote_id    = $this->OuthModel->Encryptor('decrypt', $this->uri->segment(2));

        $data['quote_details']          = $this->User_model->quotationDetails($quote_id);
        $data['quote_from_details']     = $this->User_model->quotationFromDetails($quote_id);
        $data['quote_to_details']       = $this->User_model->quotationToDetails($quote_id);
        $data['quote_item_details']     = $this->User_model->quotationItemDetails($quote_id);
        //print_r($data);die;
        $this->parser->parse('frontend/view-quote-print', $data);
    }
}
