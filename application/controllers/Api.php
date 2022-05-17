<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('admin_helper');
		$this->load->model('api_model');
		$this->load->library('email');
	}

	public function user_login()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		if (!empty($this->input->post('email'))) {
			$username = $this->input->post('email');
			$arrWhere['email'] = $username;
		} else {
			$username = $this->input->post('telephone');
			$arrWhere['telephone'] = $username;
		}
		$push_token = $this->input->post('push_token');
		$password = $this->input->post('password');
		$login_ip = $this->input->ip_address();
		$login_time = DTIME;
		if (!empty($username) && !empty($password)) {
			$return = $this->api_model->validate_login($username, $password, $login_ip, $login_time, 'NU');
			if ($return == 'not_found') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'user not found';
				$data['userdata'] = '';
			} elseif ($return == 'password_incorrect') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'password incorrect';
				$data['userdata'] = '';
			} elseif ($return == 'inactive') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'user inactive';
				$data['userdata'] = '';
			} elseif ($return == 'cannot_validate') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'cannot login now';
				$data['userdata'] = '';
			} else {
				if (!empty($push_token)) {
					$push_token_data = [
						'push_token'              => $push_token,
					];
					$this->api_model->updateData('users', $arrWhere, $push_token_data);
				}
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = '';
				$data['userdata'] = $return;
			}
			$json = json_encode($data);
			echo $json;
		}
	}



	public function pdboy_login()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		if (!empty($this->input->post('email'))) {
			$username = $this->input->post('email');
			$arrWhere['email'] = $username;
		} else {
			$username = $this->input->post('telephone');
			$arrWhere['telephone'] = $username;
		}
		$push_token = $this->input->post('push_token');
		$password = $this->input->post('password');
		$login_ip = $this->input->ip_address();
		$login_time = DTIME;
		if (!empty($username) && !empty($password)) {
			$return = $this->api_model->validate_login($username, $password, $login_ip, $login_time, 'PDB');
			if ($return == 'not_found') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'user not found';
				$data['userdata'] = '';
			} elseif ($return == 'password_incorrect') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'password incorrect';
				$data['userdata'] = '';
			} elseif ($return == 'inactive') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'user inactive';
				$data['userdata'] = '';
			} elseif ($return == 'cannot_validate') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'cannot login now';
				$data['userdata'] = '';
			} else {
				if (!empty($push_token)) {
					$push_token_data = [
						'push_token'              => $push_token,
					];
					$this->api_model->updateData('users', $arrWhere, $push_token_data);
				}
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = '';
				$data['userdata'] = $return;
			}
			$json = json_encode($data);
			echo $json;
		}
	}

	public function user_registration()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$data   =   array();
		$user_type		= $this->input->post('user_type');
		$firstname		= $this->input->post('firstname');
		$lastname		= $this->input->post('lastname');
		$telephone		= $this->input->post('telephone');
		$email			= $this->input->post('email');

		//$branch_id		= $this->input->post('branch_id');
		$companyname	= $this->input->post('companyname');
		$companydetails	= $this->input->post('companydetails');

		$address		= $this->input->post('address');
		$address2		= $this->input->post('address2');
		$country		= $this->input->post('country');
		$state			= $this->input->post('state');
		$city			= $this->input->post('city');
		$zip			= $this->input->post('zip');
		$push_token		= $this->input->post('push_token');
		$online_status	= '1';
		$status			= '1';
		$password		= md5($this->input->post('password'));
		$add_date		= DTIME;
		$latitude       = $this->input->post('latitude');
		$longitude      = $this->input->post('longitude');

		$mobile_check = array();
		$email_check = $this->api_model->common($table_name = 'users', $field = array(), $where = array('email' => $email), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		if (isset($phone) && $phone != '') {
			$mobile_check = $this->api_model->common($table_name = 'users', $field = array(), $where = array('telephone' => $telephone), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		}

		if (count($email_check) > 0) {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Your Email Is Already Used.';
			$data['user_data'] = $email_check;
		} elseif (count($mobile_check) > 0 && !empty($mobile_check)) {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Your Phone no is Already Used.';
			$data['user_data'] = $mobile_check;
		} else {
			if ($user_type == 'NU') {
				$data = array(
					'user_type' => $user_type,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'telephone' => $telephone,
					'email' => $email,
					'address' => $address,
					'address2' => $address2,
					'country' => $country,
					'state' => $state,
					'city' => $city,
					'zip' => $zip,
					'online_status' => $online_status,
					'status' => $status,
					'push_token' => $push_token,
					'password' => $password,
					'latitude'  	=> $latitude,
					'longitude'  	=> $longitude
				);
			}
			if ($user_type == 'BU') {
				$data = array(
					'user_type' => $user_type,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'telephone' => $telephone,
					'companyname' => $companyname,
					'companydetails' => $companydetails,
					'email' => $email,
					'address' => $address,
					'address2' => $address2,
					'country' => $country,
					'state' => $state,
					'city' => $city,
					'zip' => $zip,
					'online_status' => $online_status,
					'status' => $status,
					'push_token' => $push_token,
					'password' => $password,
					'latitude'  	=> $latitude,
					'longitude'  	=> $longitude
				);
			}

			$this->db->insert('users', $data);
			$data['user_id'] = strval($this->db->insert_id());
			if ($email != '') {
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = 'Registration Done Successfully...Please Login';
			}
		}

		$json = json_encode($data);
		echo $json;
	}

	public function countryList()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$return = $this->api_model->countryList();
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Country List not found';
			$data['countryList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['countryList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function stateListByCountry()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$countryID		= $this->input->post('countryID');
		$return = $this->api_model->stateList($countryID);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'State List not found';
			$data['stateList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['stateList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function cityListBystate()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$stateID		= $this->input->post('stateID');
		$return = $this->api_model->cityList($stateID);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'City List not found';
			$data['cityList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['cityList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function forget_password()
	{
		$this->load->library('email');
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$email_id = $this->input->post('email_id');
		if (!empty($email_id)) {
			$return = $this->api_model->email_id_check($email_id);
			if ($return == 'doesnt_exists') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'User does not exist';
			} elseif ($return == 'user_inactive') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'user inactive';
			} else {
				// Send an email with password reset link
				$message = 'Dear ' . $return->firstname . ',' . "\n\n";
				$message .= 'A Password Reset Request has been received for your Royal Serry account. However, if this is not initiated by you then please ingore this mail. You can reset your password by clicking on the link below.' . "\n";
				$message .= 'Your Password Reset Link:: ' . base_url() . 'password-reset/' . base64_encode($return->user_id) . "\n\n";
				$message .= 'Best Regards,' . "\n";
				$message .= 'Royal Serry';

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
				$this->email->from('no-reply@royalserry.co.in', 'Royal Serry Forget Password');
				$this->email->to($email_id);
				$this->email->reply_to('no-reply@royalserry.co.in', 'Royal Serry');
				$this->email->subject('Your Royal Serry Account Password Reset Link');
				$this->email->message($message);
				if ($this->email->send()) {
					$data['code'] = '200';
					$data['status'] = 'success';
					$data['message'] = 'An email has been sent to your email address. Follow the instruction in the email to reset your password.';
				} else {
					$data['code'] = '201';
					$data['status'] = 'failed';
					$data['message'] = 'mail cannot be sent';
				}
			}
			$json = json_encode($data);
			echo $json;
		}
	}

	public function edit_profile()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$user_id = $this->input->post('user_id');
		$user_type		= $this->input->post('user_type');

		$firstname		= $this->input->post('firstname');
		$lastname		= $this->input->post('lastname');
		/*$telephone		= $this->input->post('telephone');
		$email			= $this->input->post('email');*/

		//$branch_id		= $this->input->post('branch_id');
		$companyname	= $this->input->post('companyname');
		$companydetails	= $this->input->post('companydetails');

		$address		= $this->input->post('address');
		$address2		= $this->input->post('address2');
		$country		= $this->input->post('country');
		$state			= $this->input->post('state');
		$city			= $this->input->post('city');
		$zip			= $this->input->post('zip');
		$latitude       = $this->input->post('latitude');
		$longitude      = $this->input->post('longitude');

		/*$checkEmailAvailablity       =   $this->api_model->checkEmailAvailablity_byID($email, $user_id);
		if($checkEmailAvailablity > 0)
		{
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Your Email Is Already Used.';
			$json = json_encode($data);
			echo $json; die;
		}
		
		$checkPhoneAvailablity       =   $this->api_model->checkPhoneAvailablity_byID($telephone, $user_id);
		if($checkPhoneAvailablity > 0)
		{
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Your Phone no is Already Used.';
			$json = json_encode($data);
			echo $json; die;
		}*/
		if (!empty($user_id)) {
			if ($user_type == 'NU') {
				$data = array(
					'user_type' => $user_type,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'address' => $address,
					'address2' => $address2,
					'country' => $country,
					'state' => $state,
					'city' => $city,
					'zip' => $zip,
					'latitude'  	=> $latitude,
					'longitude'  	=> $longitude
				);
			}
			if ($user_type == 'BU') {
				$data = array(
					'user_type' => $user_type,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'companyname' => $companyname,
					'companydetails' => $companydetails,
					'address' => $address,
					'address2' => $address2,
					'country' => $country,
					'state' => $state,
					'city' => $city,
					'zip' => $zip,
					'latitude'  	=> $latitude,
					'longitude'  	=> $longitude
				);
			}
			if ($user_type == 'PDB') {
				$data = array(
					'user_type' => $user_type,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'address' => $address,
					'address2' => $address2,
					'country' => $country,
					'state' => $state,
					'city' => $city,
					'zip' => $zip,
					'latitude'  	=> $latitude,
					'longitude'  	=> $longitude
				);
			}

			$return = $this->api_model->edit_profile($user_id, $data);
			//$data1['userdata']['user_id'] = $user_id;
			if ($return == 'user_not_found') {
				$data1['status'] = 'failed';
				$data1['message'] = 'user not found';
				$data1['userdata'] = '';
			} elseif ($return == 'user_inactive') {
				$data1['status'] = 'failed';
				$data1['message'] = 'user inactive';
				$data1['userdata'] = '';
			} elseif ($return == 'cannot_update') {
				$data1['status'] = 'failed';
				$data1['message'] = 'cannot edit now';
				$data1['userdata'] = '';
			} else {
				$data1['status'] = 'success';
				$data1['message'] = 'Profile updated successfully';
				$data1['userdata'] = $return;
			}
			$json = json_encode($data1);
			echo $json;
		}
	}

	public function change_profile_picture()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id = $this->input->post('user_id');
		if (!empty($user_id)) {
			if ($this->api_model->validate_user_id($user_id) == 'ok') {
				$image = $this->input->post('profile_picture');
				$image_name = time() . rand(1000, 9999999999) . $user_id . '.png';
				$path = 'uploads/profile_img/' . $image_name;
				if (file_put_contents($path, base64_decode($image))) {
					if ($this->api_model->update_profile_picture($user_id, $image_name)) {
						$data['code'] = '200';
						$data['status'] = 'success';
						$data['image_url'] = base_url() . 'uploads/profile_img/' . $image_name;
						$data['message'] = '';
					} else {
						$data['code'] = '201';
						$data['status'] = 'failed';
						$data['image_url'] = '';
						$data['message'] = 'cannot update profile picture now';
					}
				} else {
					$data['code'] = '201';
					$data['status'] = 'failed';
					$data['image_url'] = '';
					$data['message'] = 'file write failed';
				}
			} elseif ($this->api_model->validate_user_id($user_id) == 'user_inactive') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['image_url'] = '';
				$data['message'] = 'user inactive';
			} elseif ($this->api_model->validate_user_id($user_id) == 'user_not_found') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['image_url'] = '';
				$data['message'] = 'user not found';
			}
			$json = json_encode($data);
			echo $json;
		}
	}

	public function user_change_password()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id = $this->input->post('user_id');
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		if (!empty($user_id) && !empty($old_password) && !empty($new_password)) {
			$return = $this->api_model->user_change_password($user_id, $old_password, $new_password);
			if ($return == 'user_not_found') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'user not found';
			} elseif ($return == 'user_inactive') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'user inactive';
			} elseif ($return == 'old_password_incorrect') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'old password incorrect';
			} elseif ($return == 'cannot_update') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'cannot update';
			} else {
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = 'Password changed successfully.';
			}
			$json = json_encode($data);
			echo $json;
		}
	}

	public function shipping_mode_list()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$return = $this->api_model->ShippingmodeList();
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Shipping mode not found';
			$data['shippingmodeList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['shippingmodeList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function delivery_mode_list()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$return = $this->api_model->DeliverymodeList();
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Delivery mode not found';
			$data['deliverymodeList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['deliverymodeList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function shipping_category_list()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$return = $this->api_model->ShippingcategoryList();
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Shipping category not found';
			$data['shippingcategoryList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['shippingcategoryList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function item_cat_list_by_shipping_cat()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$type		= $this->input->post('type');
		$return = $this->api_model->itemcategoryList($type);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Item category List not found';
			$data['ItemCatList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['ItemCatList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function item_subcat_list_by_shipping_cat_itemcat()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$type			= $this->input->post('type');
		$parent_cat_id	= $this->input->post('item_cat_id');
		$return = $this->api_model->itemsubcategoryList($type, $parent_cat_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Item Sub-category List not found';
			$data['ItemSubCatList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['ItemSubCatList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function item_list_by_cat_type()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$type			= $this->input->post('type');
		$cat_id	= $this->input->post('item_cat_id');
		$return = $this->api_model->itemListbycatType($type, $cat_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Item List not found';
			$data['ItemList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['ItemList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function ratelist_by_catsubcat()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$ship_mode_id			= $this->input->post('ship_mode_id');
		$ship_cat_id			= $this->input->post('ship_cat_id');
		$delivery_mode_id		= $this->input->post('delivery_mode_id');
		$ship_subcat_id			= $this->input->post('ship_subcat_id');
		$ship_sub_subcat_id		= $this->input->post('ship_sub_subcat_id');
		$rate_type				= $this->input->post('rate_type');
		$location_from			= $this->input->post('location_from');
		$location_to			= $this->input->post('location_to');
		$return = $this->api_model->getrateListbycat($ship_mode_id, $ship_cat_id, $delivery_mode_id, $ship_subcat_id, $ship_sub_subcat_id, $rate_type, $location_from, $location_to);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Rate List not found';
			$data['rateList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['rateList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function rate_factor()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$return = $this->api_model->getrateFactor();
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Rate Factor not found';
			$data['rateFactor'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['rateFactor'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function tax_rate()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$return = $this->api_model->getTaxRate();
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Tax Rate not found';
			$data['rateFactor'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['rateFactor'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function validateTozipcode()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$postal_code   			=   $this->input->post('postal_code', TRUE);
		$return = $this->api_model->validatepostcode_by_tozip($postal_code);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'We do not cover your area!';
			$data['rateFactor'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['rateFactor'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function creatQuote()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$quoteno = getSLNo(1);
		$location_type        = $this->input->post('location_type'); // Domestic or International
		$shipment_type_option = $this->input->post('shipment_type_option'); // document or package
		$delivery_speed       = $this->input->post('delivery_speed'); // normal/express etc
		$customer_id          = $this->input->post('customer_id');
		$charges_final        = $this->input->post('charges_final'); // road/rail/air/ship
		$user_id              = $this->input->post('user_id');
		$latitude_from              = $this->input->post('latitude_from');
		$longitude_from              = $this->input->post('longitude_from');
		$latitude_to              = $this->input->post('latitude_to');
		$longitude_to              = $this->input->post('longitude_to');
		// Quotation From Address
		$firstname             = $this->input->post('firstname');
		$lastname              = $this->input->post('lastname');
		$address_from          = $this->input->post('address_from');
		$address2              = $this->input->post('address2');
		$company_name          = $this->input->post('company_name');
		$country               = $this->input->post('country');
		$state                 = $this->input->post('state');
		$city                  = $this->input->post('city');
		$zip                   = $this->input->post('zip');
		$email                 = $this->input->post('email');
		$telephone             = $this->input->post('telephone');
		$address_type          = $this->input->post('address_type');


		// Quotation To Address
		$firstname_to             = $this->input->post('firstname_to');
		$lastname_to              = $this->input->post('lastname_to');
		$address_to          	  = $this->input->post('address_to');
		$address2_to              = $this->input->post('address2_to');
		$company_name_to          = $this->input->post('company_name_to');
		$country_to               = $this->input->post('country_to');
		$state_to                 = $this->input->post('state_to');
		$city_to                  = $this->input->post('city_to');
		$zip_to                   = $this->input->post('zip_to');
		$email_to                 = $this->input->post('email_to');
		$telephone_to             = $this->input->post('telephone_to');
		$address_type_to          = $this->input->post('address_type_to');

		if ($shipment_type_option == 1) { // For Document
			$ship_subcat_id                 = $this->input->post('document_category');
			$ship_sub_subcat_id             = $this->input->post('document_sub_cat');
			$item                           = $this->input->post('document_item');
			$other_details                  = $this->input->post('other_details_document');
			$value_of_shipment              = $this->input->post('value_of_shipment_parcel_document');
			$protect_parcel                 = $this->input->post('protect_parcel_document');
			$shipment_description_parcel    = $this->input->post('shipment_description_parcel_document');
		} else { // For Package
			$ship_subcat_id                 = $this->input->post('package_category');
			$ship_sub_subcat_id             = $this->input->post('package_sub_cat');
			$item                           = $this->input->post('package_item');
			$other_details                  = $this->input->post('other_details_parcel');
			$shipment_description_parcel    = $this->input->post('shipment_description_parcel_package');
			$value_of_shipment              = $this->input->post('value_of_shipment_parcel_package');
			$protect_parcel                 = $this->input->post('protect_parcel_package');
			$referance_parcel               = $this->input->post('referance_parcel');
			$length                         = $this->input->post('length');
			$length_dimen                   = $this->input->post('length_dimen');
			$breadth                        = $this->input->post('breadth');
			$breadth_dimen                  = $this->input->post('breadth_dimen');
			$height                         = $this->input->post('height');
			$height_dimen                   = $this->input->post('height_dimen');
			$weight                         = $this->input->post('weight');
			$weight_dimen                   = $this->input->post('weight_dimen');
		}

		$quot_data = [
			'quote_no'           => $quoteno,
			'customer_id'        => $customer_id,
			'shipment_type'      => $shipment_type_option,
			'location_type'      => $location_type,
			'transport_type'     => $charges_final,
			'status'             => '1',
			'platform'           => '2',
			'quote_type'         => '0',
			'created_by'         => $user_id,
			'delivery_mode_id'   => $delivery_speed,
			'created_date'       => DTIME,
		];

		$this->db->insert('quotation_master', $quot_data);
		$quotation_id = strval($this->db->insert_id());
		$quot_data['quotation_id'] = $quotation_id;
		if ($quotation_id != '') {

			// Quotation From Address
			// $latlong_from_address_arr = getLatLongbyAddress($zip);
			$quot_from_address = [
				'quotation_id'  => $quotation_id,
				'customer_id'   => $customer_id,
				'firstname'     => $firstname,
				'lastname'      => $lastname,
				'address'       => $address_from,
				'address2'      => $address2,
				'company_name'  => $company_name,
				'country'       => $country,
				'state'         => $state,
				'city'          => $city,
				'zip'           => $zip,
				'email'         => $email,
				'telephone'     => $telephone,
				'address_type'  => $address_type,
				'latitude'  	=> $latitude_from,
				'longitude'  	=> $longitude_from
			];
			$from_address = $this->api_model->quotationFromDetails($quotation_id);
			if (count($from_address) < 1) {
				$this->db->insert('quotation_from_address', $quot_from_address);
			}

			// Quotation To Address
			// $latlong_to_address_arr = getLatLongbyAddress($zip_to);
			$quot_to_address = [
				'quotation_id'  => $quotation_id,
				'customer_id'   => $customer_id,
				'firstname'     => $firstname_to,
				'lastname'      => $lastname_to,
				'address'       => $address_to,
				'address2'      => $address2_to,
				'company_name'  => $company_name_to,
				'country'       => $country_to,
				'state'         => $state_to,
				'city'          => $city_to,
				'zip'           => $zip_to,
				'email'         => $email_to,
				'telephone'     => $telephone_to,
				'address_type'  => $address_type_to,
				'latitude'  	=> $latitude_to,
				'longitude'  	=> $longitude_to
			];
			$to_address = $this->api_model->quotationToDetails($quotation_id);
			if (count($to_address) < 1) {
				$this->db->insert('quotation_to_address', $quot_to_address);
			}

			// Quotation Item details
			$quantity               = $this->input->post('quantity');
			if ($quantity == '') {
				$quantity = 1;
			}
			$rates               	= $this->input->post('rates');
			$insurance              = $this->input->post('insurance') * $quantity;
			//$finalRate 				= $rates * $quantity;
			// rate calculation
			/*if ($shipment_type_option == 1) { // For Document
				$rates               	= $this->input->post('rates');
				$insurance              = $this->input->post('insurance');
			} else {
				$rates              = $this->input->post('rates');
				$insurance              = $this->input->post('insurance');
				$rate_factor = 1.25;
				$rate_tot = ((((($length * $breadth * $height) / 5000) * $rate_factor) + $rates_val) * $quantity);
				
				$insur_withqty = ($insurance * $quantity);
				//$insur_withqty = number_format((float)$insur_withqty, 2, '.', '');
				//$rates = $rate_tot + $insur_withqty;
				$insurance = $insur_withqty;
			}*/

			$shipItemDet = [
				'quotation_id'           => $quotation_id,
				'category_id'            => $ship_subcat_id,
				'subcategory_id'         => $ship_sub_subcat_id,
				'item_id'                => $item,
				'desc'                   => $shipment_description_parcel,
				'value_shipment'         => $value_of_shipment,
				'quantity'               => $quantity,
				'rate'                   => $rates,
				'insur'                  => $insurance,
				'line_total'             => $rates,
				'other_details_parcel'   => $other_details,
				'protect_parcel'         => $protect_parcel,
				'referance_parcel'       => ((isset($referance_parcel)) ? $referance_parcel : ''),
				'length'                 => ((isset($length)) ? $length : ''),
				'length_dimen'           => ((isset($length_dimen)) ? $length_dimen : ''),
				'breadth'                => ((isset($breadth)) ? $breadth : ''),
				'breadth_dimen'          => ((isset($breadth_dimen)) ? $breadth_dimen : ''),
				'height'                 => ((isset($height)) ? $height : ''),
				'height_dimen'           => ((isset($height_dimen)) ? $height_dimen : ''),
				'weight'                 => ((isset($weight)) ? $weight : ''),
				'weight_dimen'           => ((isset($weight_dimen)) ? $weight_dimen : ''),
			];
			$quote_items_insert = $this->db->insert('quotation_item_details', $shipItemDet);
			$quote_items_insert = strval($this->db->insert_id());
			// Insert Quotation Charges
			if ($charges_final == 1) {
				$quoteCharges = [
					'quotation_id'              => $quotation_id,
					'quotation_item_details_id' => $quote_items_insert,
					'road'                      => $rates,
					'rail'                      => '0.00',
					'air'                       => '0.00',
					'ship'                      => '0.00',
				];
			} else if ($charges_final == 2) {
				$quoteCharges = [
					'quotation_id'              => $quotation_id,
					'quotation_item_details_id' => $quote_items_insert,
					'road'                      => '0.00',
					'rail'                      => $rates,
					'air'                       => '0.00',
					'ship'                      => '0.00',
				];
			} else if ($charges_final == 3) {
				$quoteCharges = [
					'quotation_id'              => $quotation_id,
					'quotation_item_details_id' => $quote_items_insert,
					'road'                      => '0.00',
					'rail'                      => '0.00',
					'air'                       => $rates,
					'ship'                      => '0.00',
				];
			} else {
				$quoteCharges = [
					'quotation_id'              => $quotation_id,
					'quotation_item_details_id' => $quote_items_insert,
					'road'                      => '0.00',
					'rail'                      => '0.00',
					'air'                       => '0.00',
					'ship'                      => $rates,
				];
			}

			$quote_charges_insert = $this->db->insert('quotation_charges', $quoteCharges);

			// For multiple item loop
			$loopkey = $this->input->post('loopkey');
			if ($loopkey > 0) {
				for ($i = 1; $i <= $loopkey; $i++) {
					$shipment_type_option = $this->input->post('shipment_type_option_' . $i);
					if ($shipment_type_option == 1) { // For Document
						$ship_subcat_id                 = $this->input->post('document_category_' . $i);
						$ship_sub_subcat_id             = $this->input->post('document_sub_cat_' . $i);
						$item                           = $this->input->post('document_item_' . $i);
						$other_details                  = $this->input->post('other_details_document_' . $i);
						$value_of_shipment              = $this->input->post('value_of_shipment_parcel_document_' . $i);
						$protect_parcel                 = $this->input->post('protect_parcel_document_' . $i);
						$shipment_description_parcel    = $this->input->post('shipment_description_parcel_document_' . $i);
					} else { // For Package
						$ship_subcat_id                 = $this->input->post('package_category_' . $i);
						$ship_sub_subcat_id             = $this->input->post('package_sub_cat_' . $i);
						$item                           = $this->input->post('package_item_' . $i);
						$other_details                  = $this->input->post('other_details_parcel_' . $i);
						$shipment_description_parcel    = $this->input->post('shipment_description_parcel_package_' . $i);
						$value_of_shipment              = $this->input->post('value_of_shipment_parcel_package_' . $i);
						$protect_parcel                 = $this->input->post('protect_parcel_package_' . $i);
						$referance_parcel               = $this->input->post('referance_parcel_' . $i);
						$length                         = $this->input->post('length_' . $i);
						$length_dimen                   = $this->input->post('length_dimen_' . $i);
						$breadth                        = $this->input->post('breadth_' . $i);
						$breadth_dimen                  = $this->input->post('breadth_dimen_' . $i);
						$height                         = $this->input->post('height_' . $i);
						$height_dimen                   = $this->input->post('height_dimen_' . $i);
						$weight                         = $this->input->post('weight_' . $i);
						$weight_dimen                   = $this->input->post('weight_dimen_' . $i);
					}

					// Quotation Item details
					$quantity               = $this->input->post('quantity_' . $i);
					if ($quantity == '') {
						$quantity = 1;
					}
					$rates               	= $this->input->post('rates_' . $i);
					$insurance              = $this->input->post('insurance_' . $i) * $quantity;
					//$finalRate 				= $rates * $quantity;

					// rate calculation
					/*if ($shipment_type_option == 1) { // For Document
						$rates               	= $this->input->post('rates_'.$i);
						$insurance              = $this->input->post('insurance_'.$i);
					} else {
						$rates_val              	= $this->input->post('rates_'.$i);
						$rate_factor = 1.25;
						$rate_tot = ((((($length * $breadth * $height) / 5000) * $rate_factor) + $rates_val) * $quantity);
						
						$insur_withqty = ($insurance * $quantity);
						//$insur_withqty = number_format((float)$insur_withqty, 2, '.', '');
						$rates = $rate_tot + $insur_withqty;
						$insurance = $insur_withqty;
					}*/

					$shipItemDet = [
						'quotation_id'           => $quotation_id,
						'category_id'            => $ship_subcat_id,
						'subcategory_id'         => $ship_sub_subcat_id,
						'item_id'                => $item,
						'desc'                   => $shipment_description_parcel,
						'value_shipment'         => $value_of_shipment,
						'quantity'               => $quantity,
						'rate'                   => $rates,
						'insur'                  => $insurance,
						'line_total'             => $rates,
						'other_details_parcel'   => $other_details,
						'protect_parcel'         => $protect_parcel,
						'referance_parcel'       => ((isset($referance_parcel)) ? $referance_parcel : ''),
						'length'                 => ((isset($length)) ? $length : ''),
						'length_dimen'           => ((isset($length_dimen)) ? $length_dimen : ''),
						'breadth'                => ((isset($breadth)) ? $breadth : ''),
						'breadth_dimen'          => ((isset($breadth_dimen)) ? $breadth_dimen : ''),
						'height'                 => ((isset($height)) ? $height : ''),
						'height_dimen'           => ((isset($height_dimen)) ? $height_dimen : ''),
						'weight'                 => ((isset($weight)) ? $weight : ''),
						'weight_dimen'           => ((isset($weight_dimen)) ? $weight_dimen : ''),
					];
					$quote_items_insert = $this->db->insert('quotation_item_details', $shipItemDet);
					$quote_items_insert = strval($this->db->insert_id());
					// Insert Quotation Charges
					if ($charges_final == 1) {
						$quoteCharges = [
							'quotation_id'              => $quotation_id,
							'quotation_item_details_id' => $quote_items_insert,
							'road'                      => $rates,
							'rail'                      => '0.00',
							'air'                       => '0.00',
							'ship'                      => '0.00',
						];
					} else if ($charges_final == 2) {
						$quoteCharges = [
							'quotation_id'              => $quotation_id,
							'quotation_item_details_id' => $quote_items_insert,
							'road'                      => '0.00',
							'rail'                      => $rates,
							'air'                       => '0.00',
							'ship'                      => '0.00',
						];
					} else if ($charges_final == 3) {
						$quoteCharges = [
							'quotation_id'              => $quotation_id,
							'quotation_item_details_id' => $quote_items_insert,
							'road'                      => '0.00',
							'rail'                      => '0.00',
							'air'                       => $rates,
							'ship'                      => '0.00',
						];
					} else {
						$quoteCharges = [
							'quotation_id'              => $quotation_id,
							'quotation_item_details_id' => $quote_items_insert,
							'road'                      => '0.00',
							'rail'                      => '0.00',
							'air'                       => '0.00',
							'ship'                      => $rates,
						];
					}

					$quote_charges_insert = $this->db->insert('quotation_charges', $quoteCharges);
					// End item loop
				}
			}

			if ($quote_items_insert > 0) {
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = 'Your Quotation successfully created.';
				$data['quotation_data'] = $quot_data;
			}
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Quotation cannot created!!';
		}

		$json = json_encode($data);
		echo $json;
	}

	public function creatQuoteRequest()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$quoteno = getSLNo(1);
		$location_type        = $this->input->post('location_type'); // Domestic or International

		if ($this->input->post('shipment_type_option') == '') {
			$shipment_type_option = '1';
		} else {
			$shipment_type_option = $this->input->post('shipment_type_option'); // document or package
		}
		if ($this->input->post('delivery_speed') == '') {
			$delivery_speed       = '1';
		} else {
			$delivery_speed       = $this->input->post('delivery_speed'); // normal/express etc
		}
		$customer_id          = $this->input->post('customer_id');

		if ($this->input->post('charges_final') == '') {
			$charges_final        = '1';
		} else {
			$charges_final        = $this->input->post('charges_final'); // road/rail/air/ship
		}
		$user_id              = $this->input->post('user_id');
		// Quotation From Address
		$firstname             = $this->input->post('firstname');
		$lastname              = $this->input->post('lastname');
		$address_from          = $this->input->post('address_from');
		$address2              = $this->input->post('address2');
		$company_name          = $this->input->post('company_name');
		$country               = $this->input->post('country');
		$state                 = $this->input->post('state');
		$city                  = $this->input->post('city');
		$zip                   = $this->input->post('zip');
		$email                 = $this->input->post('email');
		$telephone             = $this->input->post('telephone');
		$address_type          = $this->input->post('address_type');


		// Quotation To Address
		$firstname_to             = $this->input->post('firstname_to');
		$lastname_to              = $this->input->post('lastname_to');
		$address_to          	  = $this->input->post('address_to');
		$address2_to              = $this->input->post('address2_to');
		$company_name_to          = $this->input->post('company_name_to');
		$country_to               = $this->input->post('country_to');
		$state_to                 = $this->input->post('state_to');
		$city_to                  = $this->input->post('city_to');
		$zip_to                   = $this->input->post('zip_to');
		$email_to                 = $this->input->post('email_to');
		$telephone_to             = $this->input->post('telephone_to');
		$address_type_to          = $this->input->post('address_type_to');
		$latitude_from              = $this->input->post('latitude_from');
		$longitude_from              = $this->input->post('longitude_from');
		$latitude_to              = $this->input->post('latitude_to');
		$longitude_to              = $this->input->post('longitude_to');

		$quot_data = [
			'quote_no'           => $quoteno,
			'customer_id'        => $customer_id,
			'shipment_type'      => $shipment_type_option,
			'location_type'      => $location_type,
			'transport_type'     => $charges_final,
			'status'             => '1',
			'platform'           => '2',
			'quote_type'         => '2',
			'created_by'         => $user_id,
			'delivery_mode_id'   => $delivery_speed,
			'created_date'       => DTIME,
		];

		$this->db->insert('quotation_master', $quot_data);
		$quotation_id = strval($this->db->insert_id());
		$quot_data['quotation_id'] = $quotation_id;
		if ($quotation_id != '') {
			// Quotation From Address
			// $latlong_from_address_arr = getLatLongbyAddress($post['zip']);
			$quot_from_address = [
				'quotation_id'  => $quotation_id,
				'customer_id'   => $customer_id,
				'firstname'     => $firstname,
				'lastname'      => $lastname,
				'address'       => $address_from,
				'address2'      => $address2,
				'company_name'  => $company_name,
				'country'       => $country,
				'state'         => $state,
				'city'          => $city,
				'zip'           => $zip,
				'email'         => $email,
				'telephone'     => $telephone,
				'address_type'  => $address_type,
				'latitude'  	=> $latitude_from,
				'longitude'  	=> $longitude_from
			];
			$from_address = $this->api_model->quotationFromDetails($quotation_id);
			if (count($from_address) < 1) {
				$this->db->insert('quotation_from_address', $quot_from_address);
			}

			// Quotation To Address
			// $latlong_to_address_arr = getLatLongbyAddress($post['zip_to']);
			$quot_to_address = [
				'quotation_id'  => $quotation_id,
				'customer_id'   => $customer_id,
				'firstname'     => $firstname_to,
				'lastname'      => $lastname_to,
				'address'       => $address_to,
				'address2'      => $address2_to,
				'company_name'  => $company_name_to,
				'country'       => $country_to,
				'state'         => $state_to,
				'city'          => $city_to,
				'zip'           => $zip_to,
				'email'         => $email_to,
				'telephone'     => $telephone_to,
				'address_type'  => $address_type_to,
				'latitude'  	=> $latitude_to,
				'longitude'  	=> $longitude_to
			];
			$to_address = $this->api_model->quotationToDetails($quotation_id);
			if (count($to_address) < 1) {
				$this->db->insert('quotation_to_address', $quot_to_address);
			}

			$return = $this->api_model->assignQuotationRequest($quotation_id, $zip, $zip_to, $user_id);

			if ($return == 'assinged') {
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = 'Your Quotation Request successfully created. PD boy will contact soon.';
				$data['quotation_data'] = $quot_data;

				// send mail to Customer
				$body = '';
				$body .= '<p>Quotation ' . $quoteno . ' Date ' . DTIME . ' received from ' . getCustomerNameByQuoteId($quotation_id) . '.</p>';
				$body .= '<p>Thank You</p>';
				$body .= '<p>Team Royal Serry.</p>';

				$replyemail = 'no-reply@royalserry.com';
				$from_email = 'no-reply@royalserry.com';
				$name = 'Royal Serry';
				$to_email = getCustomerEmailByQuoteId($quotation_id);
				$subject = 'Royal Serry Customer Quotation request received.';

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
			} else {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'Quotation request cannot created, due to PD boy not found.';
			}
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Quotation request cannot created!!';
		}

		$json = json_encode($data);
		echo $json;
	}

	public function quoteList()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id		= $this->input->post('user_id');
		$return = $this->api_model->getQuotationByUser($user_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Quotetion List not found';
			$data['quoteList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['quoteList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}


	public function pdboyRequsetquoteList()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id		= $this->input->post('pdboy_user_id');
		$return = $this->api_model->getpdBoyRequestQuotationList($user_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Request Quotetion List not found';
			$data['quoteList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['quoteList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function viewQuoteDetails()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$quote_id		= $this->input->post('quote_id');
		$return = $this->api_model->quotationDetails($quote_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Quotetion Details not found';
			$data['quotationDetails'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['quotationDetails']['quote_details'] 		= $return;
			$quote_from_details = $this->api_model->quotationFromDetailsNew($quote_id);

			if (isset($quote_from_details[0]['telephone'])) {
				if (!empty($quote_from_details[0]['telephone']) && is_serialized_string($quote_from_details[0]['telephone'])) {
					$telephone = repairSerializeString($quote_from_details[0]['telephone']);
					$telephone = unserialize($telephone);
					//print_r($telephone);
					$quote_from_details[0]['telephone'] = implode(', ', $telephone);
				} else {
					// $quote_from_details[0]['telephone'] = $quote_from_details[0]['telephone'];
				}
			}

			$data['quotationDetails']['quote_from_details'] = $quote_from_details;

			$quote_to_details   = $this->api_model->quotationToDetailsNew($quote_id);

			if (isset($quote_to_details[0]['telephone'])) {
				if (!empty($quote_to_details[0]['telephone']) && is_serialized_string($quote_to_details[0]['telephone'])) {
					$telephone = repairSerializeString($quote_to_details[0]['telephone']);
					$telephone = unserialize($telephone);
					//print_r($telephone);
					$quote_to_details[0]['telephone'] = implode(', ', $telephone);
				} else {
					$quote_to_details[0]['telephone'] = $quote_to_details[0]['telephone'];
				}
			}
			$data['quotationDetails']['quote_to_details'] = $quote_to_details;

			$data['quotationDetails']['quote_item_details'] = $this->api_model->quotationItemDetails($quote_id);
		}
		$json = json_encode($data);
		echo $json;
	}

	public function getlocationId()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$name		= $this->input->post('name');
		$key		= $this->input->post('key');
		$return = $this->api_model->getlocationIdByName($name, $key);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Location ID not found';
			$data['locatioID'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['locatioID'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	/************************ PD Boy API List ****************************/

	public function pickupOrderList()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id		= $this->input->post('user_id');
		$branch_id		= $this->input->post('branch_id');

		$PickupRules   	 =   $this->api_model->getPickupRules($branch_id);
		if (!empty($PickupRules)) {
			if ($PickupRules->rule_id == '1') { // For next day
				$todayDate = date('Y-m-d 23:59:59', strtotime("-1 days"));
			} elseif ($PickupRules->rule_id == '2') { // For next shift
				$todayDate = date("Y-m-d H:i:s", strtotime('-8 hours'));
			} elseif ($PickupRules->rule_id == '3') { // For x hours
				$todayDate = date("Y-m-d H:i:s", strtotime('-' . $PickupRules->hours . ' hours'));
			} else {
				$todayDate = date('Y-m-d 23:59:59', strtotime("-1 days"));
			}
		} else {
			$todayDate = date('Y-m-d 23:59:59', strtotime("-1 days"));
		}
		$return = $this->api_model->getpickupOrderListUser($user_id, $todayDate);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Pickup Order List not found';
			$data['pickupList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['pickupList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function deliveryOrderList()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id		= $this->input->post('user_id');
		$branch_id		= $this->input->post('branch_id');

		$PickupRules   	 =   $this->api_model->getPickupRules($branch_id);
		if (!empty($PickupRules)) {
			if ($PickupRules->rule_id == '1') { // For next day
				$todayDate = date('Y-m-d 23:59:59', strtotime("-1 days"));
			} elseif ($PickupRules->rule_id == '2') { // For next shift
				$todayDate = date("Y-m-d H:i:s", strtotime('-8 hours'));
			} elseif ($PickupRules->rule_id == '3') { // For x hours
				$todayDate = date("Y-m-d H:i:s", strtotime('-' . $PickupRules->hours . ' hours'));
			} else {
				$todayDate = date('Y-m-d 23:59:59', strtotime("-1 days"));
			}
		} else {
			$todayDate = date('Y-m-d 23:59:59', strtotime("-1 days"));
		}
		$return = $this->api_model->getuserDeliveryOrderList($user_id, $todayDate);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Delivery Order List not found';
			$data['deliveryList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['deliveryList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function viewOrderDetails()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$order_id		= $this->input->post('order_id');
		$return = $this->api_model->getOrderDetails($order_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Order Details not found';
			$data['orderDetails'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['orderDetails']['order_details'] 		= $return;
			$order_from_details = $this->api_model->orderFromDetailsNew($order_id);

			if (!empty($order_from_details[0]['telephone']) && is_serialized_string($order_from_details[0]['telephone'])) {
				$telephone = repairSerializeString($order_from_details[0]['telephone']);
				$telephone = unserialize($telephone);
				//print_r($telephone);
				$order_from_details[0]['telephone'] = implode(', ', $telephone);
			} else {
				$order_from_details[0]['telephone'] = $order_from_details[0]['telephone'];
			}
			$data['orderDetails']['order_from_details'] = $order_from_details;

			$order_to_details   = $this->api_model->orderToDetailsNew($order_id);

			if (!empty($order_to_details[0]['telephone']) && is_serialized_string($order_to_details[0]['telephone'])) {
				$telephone = repairSerializeString($order_to_details[0]['telephone']);
				$telephone = unserialize($telephone);
				//print_r($telephone);
				$order_to_details[0]['telephone'] = implode(', ', $telephone);
			} else {
				$order_to_details[0]['telephone'] = $order_to_details[0]['telephone'];
			}
			$data['orderDetails']['order_to_details'] = $order_to_details;
			$data['orderDetails']['order_item_details'] = $this->api_model->orderItemDetails($order_id);
			$data['orderDetails']['order_price_details'] = $this->api_model->orderPriceDetails($order_id);
			$data['orderDetails']['order_status'] = $this->api_model->orderStatusDetails($order_id);
		}
		$json = json_encode($data);
		echo $json;
	}

	public function holidayList()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$branch_id		= $this->input->post('branch_id');
		$return = $this->api_model->getHolidaysByBranch($branch_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Holiday List not found';
			$data['holidayList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['holidayList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function duty_allocation()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id		= $this->input->post('user_id');
		$return = $this->api_model->getDutyListByUser($user_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Duty List not found';
			$data['dutyList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['dutyList'] = $return;
			$data['dutyAreaList'] = $this->api_model->getDutyAreaListByUser($user_id);
		}
		$json = json_encode($data);
		echo $json;
	}

	public function pickup_history()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id		= $this->input->post('user_id');
		$return = $this->api_model->getuserPickupOrderHistoryList($user_id);


		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Picked-up Order List not found';
			$data['pickupHistoryList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['pickupHistoryList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function delivery_history()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id		= $this->input->post('user_id');
		$return = $this->api_model->getuserDeliveryOrderHistoryList($user_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Delivered Order List not found';
			$data['deliveryHistoryList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['deliveryHistoryList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function updateOrderItemDetails()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$quantity               = $this->input->post('quantity');
		if ($quantity == '') {
			$quantity = 1;
		}

		// Rate Calculation 
		$type                   = $this->input->post('type');
		$ship_cat_id            = $type;
		if ($type == 1) {
			$ship_subcat_id         = $this->input->post('document_category');
			$ship_sub_subcat_id     = $this->input->post('document_sub_cat');
			$item                   = $this->input->post('document_item');
			$other_details          = $this->input->post('other_details_document');
			$value_of_shipment      = $this->input->post('value_of_shipment_parcel_doc');
			$protect_parcel         = $this->input->post('protect_parcel_doc');
			$shipment_description_parcel       = $this->input->post('shipment_description_parcel');
		} else {
			$ship_subcat_id                    = $this->input->post('package_category');
			$ship_sub_subcat_id                = $this->input->post('package_sub_cat');
			$item                              = $this->input->post('package_item');
			$other_details                     = $this->input->post('other_details_parcel');
			$shipment_description_parcel       = $this->input->post('shipment_description_parcel');
			$value_of_shipment                 = $this->input->post('value_of_shipment_parcel_pack');
			$protect_parcel                    = $this->input->post('protect_parcel_pack');
			$referance_parcel                  = $this->input->post('referance_parcel');
			$length                            = $this->input->post('length');
			$length_dimen                      = $this->input->post('length_dimen');
			$breadth                           = $this->input->post('breadth');
			$breadth_dimen                     = $this->input->post('breadth_dimen');
			$height                            = $this->input->post('height');
			$height_dimen                      = $this->input->post('height_dimen');
			$weight                            = $this->input->post('weight');
			$weight_dimen                      = $this->input->post('weight_dimen');
		}
		$additional_charge_comment = $this->input->post('additional_charge_comment');
		$additional_charge        = $this->input->post('additional_charge');

		$item_id                = $this->input->post('item_id');
		$shipment_id            = $this->input->post('shipment_id');

		$rate_type              = 'L';
		$location_from_arr 		= $this->api_model->getshipmentFromLocation($shipment_id);
		$location_from          = $location_from_arr[0]['state'];

		$location_to_arr 		= $this->api_model->getshipmentToLocation($shipment_id);
		$location_to            = $location_to_arr[0]['state'];

		$shipment_type_arr 		= $this->api_model->getshipmentModeSpeed($shipment_id);
		$charges_mode           = $shipment_type_arr[0]['shipment_type'];
		$delivery_mode_id       = $shipment_type_arr[0]['delivery_mode_id'];

		$data['rates'] = $this->api_model->shipmentRate($ship_cat_id, $ship_subcat_id, $ship_sub_subcat_id, $rate_type, $location_from, $location_to, $charges_mode, $delivery_mode_id);
		if (!empty($data['rates'])) {
			$data['tax'] = $this->api_model->getTaxRate();

			/*$finalRate = $data['rates'][0]['rate'] * $quantity;
			$insurance = $data['rates'][0]['insurance'];
			$finalRate = $finalRate + $additional_charge;*/
			// Add additional charges
			if ($type == 2) {
				$rate_dimen = number_format(((($length * $breadth * $height) / 5000) * 9.99), 2);
			} else {
				$rate_dimen = 0.00;
			}
			$finalRate = $data['rates'][0]['rate'] * $quantity;
			$insurance = $data['rates'][0]['insurance'];
			$finalRate = number_format($finalRate + $insurance + $additional_charge + $rate_dimen, 2);

			if ($charges_mode == 1) {
				$shipCharges = [
					'road'              => $finalRate,
					'rail'              => '0.00',
					'air'               => '0.00',
					'ship'              => '0.00',
				];
			} else if ($charges_mode == 2) {
				$shipCharges = [
					'road'              => '0.00',
					'rail'              => $finalRate,
					'air'               => '0.00',
					'ship'              => '0.00',
				];
			} else if ($charges_mode == 3) {
				$shipCharges = [
					'road'              => '0.00',
					'rail'              => '0.00',
					'air'               => $finalRate,
					'ship'              => '0.00',
				];
			} else {
				$shipCharges = [
					'road'              => '0.00',
					'rail'              => '0.00',
					'air'               => '0.00',
					'ship'              => $finalRate,
				];
			}
			$arrWhere['shipment_item_details_id'] = $item_id;
			$shipment_charges_up = $this->api_model->updateData('shipment_charges', $arrWhere, $shipCharges);

			$shipItemDet = [
				'category_id'               => $ship_subcat_id,
				'subcategory_id'            => $ship_sub_subcat_id,
				'item_id'                   => $item,
				'desc'                      => $shipment_description_parcel,
				'value_shipment'            => $value_of_shipment,
				'quantity'                  => $quantity,
				'rate'                      => $data['rates'][0]['rate'],
				'insur'                     => $insurance,
				'line_total'                => $finalRate,
				'other_details_parcel'      => $other_details,
				'protect_parcel'            => $protect_parcel,
				'referance_parcel'          => ((isset($referance_parcel)) ? $referance_parcel : ''),
				'length'                    => ((isset($length)) ? $length : ''),
				'length_dimen'              => ((isset($length_dimen)) ? $length_dimen : ''),
				'breadth'                   => ((isset($breadth)) ? $breadth : ''),
				'breadth_dimen'             => ((isset($breadth_dimen)) ? $breadth_dimen : ''),
				'height'                    => ((isset($height)) ? $height : ''),
				'height_dimen'              => ((isset($height_dimen)) ? $height_dimen : ''),
				'weight'                    => ((isset($weight)) ? $weight : ''),
				'weight_dimen'              => ((isset($weight_dimen)) ? $weight_dimen : ''),
				'additional_charge_comment' => $additional_charge_comment,
				'additional_charge'         => $additional_charge,
			];
			$arrDataWhere['id'] = $item_id;
			$shipment_charges_up = $this->api_model->updateData('shipment_item_details', $arrDataWhere, $shipItemDet);
			// print_r($shipment_charges_up); 
			if ($shipment_charges_up > 0) {
				$data1['code'] = '200';
				$data1['status'] = 'success';
				$data1['message'] = 'Order Item Details updated';
				$data1['OrderItemDetails']['ItemDetails'] = $shipItemDet;
				$data1['OrderItemDetails']['ChargesDetails'] = $shipCharges;
			} else {
				$data1['code'] = '201';
				$data1['status'] = 'failed';
				$data1['message'] = 'Order Item Details cannot updated!!';
				$data1['OrderItemDetails'] = '';
			}
		} else {
			$data1['code'] = '201';
			$data1['status'] = 'failed';
			$data1['message'] = 'Order Item rate details cannot found!!';
			$data1['OrderItemDetails'] = '';
		}
		echo json_encode($data1);
	}

	public function pdboyallorderlist()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id		= $this->input->post('user_id');
		$branch_id		= $this->input->post('branch_id');

		$PickupRules   	 =   $this->api_model->getPickupRules($branch_id);
		if (!empty($PickupRules)) {
			if ($PickupRules->rule_id == '1') { // For next day
				$todayDate = date('Y-m-d 23:59:59', strtotime("-1 days"));
			} elseif ($PickupRules->rule_id == '2') { // For next shift
				$todayDate = date("Y-m-d H:i:s", strtotime('-8 hours'));
			} elseif ($PickupRules->rule_id == '3') { // For x hours
				$todayDate = date("Y-m-d H:i:s", strtotime('-' . $PickupRules->hours . ' hours'));
			} else {
				$todayDate = date('Y-m-d 23:59:59', strtotime("-1 days"));
			}
		} else {
			$todayDate = date('Y-m-d 23:59:59', strtotime("-1 days"));
		}
		$return = $this->api_model->getallOrderListUser($user_id, $todayDate);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Order List not found';
			$data['allOrderList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['allOrderList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function pdboyallorderLatLonglist()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id		= $this->input->post('user_id');
		$branch_id		= $this->input->post('branch_id');

		$PickupRules   	 =   $this->api_model->getPickupRules($branch_id);
		if (!empty($PickupRules)) {
			if ($PickupRules->rule_id == '1') { // For next day
				$todayDate = date('Y-m-d 23:59:59', strtotime("-1 days"));
			} elseif ($PickupRules->rule_id == '2') { // For next shift
				$todayDate = date("Y-m-d H:i:s", strtotime('-8 hours'));
			} elseif ($PickupRules->rule_id == '3') { // For x hours
				$todayDate = date("Y-m-d H:i:s", strtotime('-' . $PickupRules->hours . ' hours'));
			} else {
				$todayDate = date('Y-m-d 23:59:59', strtotime("-1 days"));
			}
		} else {
			$todayDate = date('Y-m-d 23:59:59', strtotime("-1 days"));
		}
		$return = $this->api_model->getallOrderLatLongListUser($user_id, $todayDate);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Order List not found';
			$data['allOrderList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['allOrderList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function getlatlong()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$address		= $this->input->post('address');
		$return = getLatLongbyAddress($address);
		/*if($return == 'not_found') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'Delivered Order List not found';
				$data['deliveryHistoryList'] = '';
			} else {
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = '';
				$data['deliveryHistoryList'] = $return;
			}*/
		$json = json_encode($return);
		echo $json;
	}

	public function paylater()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id		= $this->input->post('user_id');
		$return = $this->api_model->getPaylaterByUser($user_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'User not found';
			$data['payLater'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['payLater'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function onSaveOrder()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		/*$sessionData = $this->session->userdata('Customer');
        $id          = $sessionData['id'];
        if ($sessionData['logged_in'] != 'TRUE') {
            redirect(base_url('/'));
        }*/
		$data        = array();

		$orderno = getSLNo(2);
		$quote_from_details     = $this->api_model->getFromAddressByQuoteID($this->input->post('quote_id'));
		//print_r($data);die;
		if ($orderno != '') {
			$user_id       = $this->input->post('user_id');
			$pay_later     = $this->input->post('pay_later');
			$credit_outstanding_amount     = $this->input->post('credit_outstanding_amount');

			$payment_mode       = $this->input->post('payment_mode');
			$quote_id      = $this->input->post('quote_id');

			//price details
			$subtotal      = $this->input->post('subtotal');
			$discount      = $this->input->post('discount');
			$ga_percentage      = $this->input->post('ga_percentage');
			$ga_tax_amt      = $this->input->post('ga_tax_amt');
			$ra_percentage      = $this->input->post('ra_percentage');
			$ra_tax_amt      = $this->input->post('ra_tax_amt');
			$grand_total      = $this->input->post('grand_total');

			if ($payment_mode == '1') {
				$payment_text = 'Paylater';
			} else if ($payment_mode == '2') {
				$payment_text = 'Credit card';
			} else if ($payment_mode == '3') {
				$payment_text = 'Credit amount';
			}

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
			// Start For Authorize net payment gateway
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
				$amount = $grand_total;
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
				$this->authorize_net->add_x_field('x_card_num', $ccno);

				$this->authorize_net->add_x_field('x_amount', $amount);
				$this->authorize_net->add_x_field('x_exp_date', $card_exp_month . $card_exp_year); // MMYY
				$this->authorize_net->add_x_field('x_card_code', $cvv);

				$this->authorize_net->process_payment();
				$authnetreponse = $this->authorize_net->get_all_response_codes();
				//echo '<pre>'; print_r($authnetreponse);die;
				if ($authnetreponse['Response_Code'] == '1') {

					/*$data['authresponse'] = $authnetreponse;
				$this->load->view('auth_success', $data);*/
					$transaction_id = $authnetreponse['Transaction_ID'];
				} elseif ($authnetreponse['Response_Code'] == '2') {
					$data['code'] = '201';
					$data['status'] = 'failed';
					$data['message'] = 'Payment failed! ' . $authnetreponse['Response_Reason_Text'];
					$data['paymentReponse'] = $authnetreponse;
					$data['payment_mode'] = $payment_text;
					echo json_encode($data);
					die;
				} elseif ($authnetreponse['Response_Code'] == '3') {
					$data['code'] = '201';
					$data['status'] = 'failed';
					$data['message'] = 'Payment failed! ' . $authnetreponse['Response_Reason_Text'];
					$data['paymentReponse'] = $authnetreponse;
					$data['payment_mode'] = $payment_text;
					echo json_encode($data);
					die;
				}
			}
			// End For Authorize net payment gateway

			//$quote_id    = $this->OuthModel->Encryptor('decrypt', $quote_id_enc);
			// echo $orderno. ' '. $quote_id.' '.$payment_mode;die;
			$add_order = $this->api_model->saveOrder($user_id, $orderno, $quote_id, $payment_mode, 1, $priceData, $transaction_id);

			// Update user outstanding amount
			if ($payment_mode == '3') {
				$outstanding_amount = $credit_outstanding_amount - $grand_total;
				$creditAmount = array(
					'credit_outstanding_amount' => $outstanding_amount
				);
				$this->api_model->updateOutstandinAmount($user_id, $creditAmount);
			}
			// send push notification
			$pushToken = getUserPushToken($user_id);
			if (!empty($pushToken)) {
				$title = "Royal Sherry Order";
				$message = "Your Order has been successfully created";

				$notification['to'] = $pushToken;
				$notification['notification']['title'] = $title;
				$notification['notification']['body'] = $message;
				$notification['notification']['badge'] = "1";
				$notification['notification']['sound'] = "default";
				$notification['notification']['icon'] = "";
				$notification['notification']['image'] = "";
				$notification['notification']['type'] = "";
				$notification['notification']['data'] = "";

				sendPushNotificationToMobileDevice($notification);
			}

			if ($add_order > 0) {
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = 'Order has been successfully created.';
				$data['OrderId'] = $add_order;
				$data['OrderNumber'] = $orderno;
				$data['payment_mode'] = $payment_text;
				if ($payment_mode == '2') {
					$data['paymentReponse'] = $authnetreponse;
				} else {
					$data['paymentReponse'] = '';
				}
				if ($payment_mode == '3') {
					$data['credit_outstanding_amount'] = $outstanding_amount;
				} else {
					$data['credit_outstanding_amount'] = $credit_outstanding_amount;
				}
			} else {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'Order cannot created!';
				$data['OrderId'] = '';
				$data['OrderNumber'] = '';
			}
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'quotation not found!';
			$data['OrderId'] = '';
			$data['OrderNumber'] = '';
		}

		echo json_encode($data);
	}

	public function orderList()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id		= $this->input->post('user_id');
		$return = $this->api_model->getOrderByUser($user_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Order List not found';
			$data['orderList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['orderList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function viewUserOrderDetails()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$order_id		= $this->input->post('order_id');
		$return = $this->api_model->getOrderDetails($order_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Order Details not found';
			$data['orderDetails'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['orderDetails']['order_details'] 		= $return;
			$data['orderDetails']['order_from_details'] = $this->api_model->orderFromDetailsNew($order_id);
			$data['orderDetails']['order_to_details']   = $this->api_model->orderToDetailsNew($order_id);
			$data['orderDetails']['order_item_details'] = $this->api_model->orderItemDetails($order_id);
			//$data['orderDetails']['charges_details'] 	= $this->api_model->orderChargesDetails($order_id);
		}
		$json = json_encode($data);
		echo $json;
	}

	public function viewOrderStatus()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$order_id		= $this->input->post('order_id');
		$return = $this->api_model->getOrderStatus($order_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Order Status not found';
			$data['orderStatus'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['orderStatus'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function addOrderItem()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$quantity               = $this->input->post('quantity');
		if ($quantity == '') {
			$quantity = 1;
		}

		// Rate Calculation 
		$type                   = $this->input->post('type');
		$ship_cat_id            = $type;
		if ($type == 1) {
			$ship_subcat_id         = $this->input->post('document_category');
			$ship_sub_subcat_id     = $this->input->post('document_sub_cat');
			$item                   = $this->input->post('document_item');
			$other_details          = $this->input->post('other_details_document');
			$value_of_shipment      = $this->input->post('value_of_shipment_parcel_doc');
			$protect_parcel         = $this->input->post('protect_parcel_doc');
			$shipment_description_parcel       = $this->input->post('shipment_description_parcel_doc');
		} else {
			$ship_subcat_id                    = $this->input->post('package_category');
			$ship_sub_subcat_id                = $this->input->post('package_sub_cat');
			$item                              = $this->input->post('package_item');
			$other_details                     = $this->input->post('other_details_parcel');
			$shipment_description_parcel       = $this->input->post('shipment_description_parcel_pack');
			$value_of_shipment                 = $this->input->post('value_of_shipment_parcel_pack');
			$protect_parcel                    = $this->input->post('protect_parcel_pack');
			$referance_parcel                  = $this->input->post('referance_parcel');
			$length                            = $this->input->post('length');
			$length_dimen                      = $this->input->post('length_dimen');
			$breadth                           = $this->input->post('breadth');
			$breadth_dimen                     = $this->input->post('breadth_dimen');
			$height                            = $this->input->post('height');
			$height_dimen                      = $this->input->post('height_dimen');
			$weight                            = $this->input->post('weight');
			$weight_dimen                      = $this->input->post('weight_dimen');
		}
		$additional_charge_comment = $this->input->post('additional_charge_comment');
		$additional_charge        = $this->input->post('additional_charge');

		//$item_id                = $this->input->post('item_id');
		$shipment_id            = $this->input->post('shipment_id');

		$rate_type              = 'L';
		$location_from_arr 		= $this->api_model->getshipmentFromLocation($shipment_id);
		$location_from          = $location_from_arr[0]['state'];

		$location_to_arr 		= $this->api_model->getshipmentToLocation($shipment_id);
		$location_to            = $location_to_arr[0]['state'];

		$shipment_type_arr 		= $this->api_model->getshipmentModeSpeed($shipment_id);
		//print_r($shipment_type_arr); die;
		$charges_mode           = $shipment_type_arr[0]['shipment_type'];
		$delivery_mode_id       = $shipment_type_arr[0]['delivery_mode_id'];

		$data['rates'] = $this->api_model->shipmentRate($ship_cat_id, $ship_subcat_id, $ship_sub_subcat_id, $rate_type, $location_from, $location_to, $charges_mode, $delivery_mode_id);
		//print_r($data['rates']); die;
		if (!empty($data['rates'])) {
			$data['tax'] = $this->api_model->getTaxRate();
			$finalRate = $data['rates'][0]['rate'] * $quantity;
			$insurance = $data['rates'][0]['insurance'];
			$finalRate = $finalRate + $additional_charge;

			$shipItemDet = [
				'shipment_id'               => $shipment_id,
				'category_id'               => $ship_subcat_id,
				'subcategory_id'            => $ship_sub_subcat_id,
				'item_id'                   => $item,
				'desc'                      => $shipment_description_parcel,
				'value_shipment'            => $value_of_shipment,
				'quantity'                  => $quantity,
				'rate'                      => $data['rates'][0]['rate'],
				'insur'                     => $insurance,
				'line_total'                => $finalRate,
				'other_details_parcel'      => $other_details,
				'protect_parcel'            => $protect_parcel,
				'referance_parcel'          => ((isset($referance_parcel)) ? $referance_parcel : ''),
				'length'                    => ((isset($length)) ? $length : ''),
				'length_dimen'              => ((isset($length_dimen)) ? $length_dimen : ''),
				'breadth'                   => ((isset($breadth)) ? $breadth : ''),
				'breadth_dimen'             => ((isset($breadth_dimen)) ? $breadth_dimen : ''),
				'height'                    => ((isset($height)) ? $height : ''),
				'height_dimen'              => ((isset($height_dimen)) ? $height_dimen : ''),
				'weight'                    => ((isset($weight)) ? $weight : ''),
				'weight_dimen'              => ((isset($weight_dimen)) ? $weight_dimen : ''),
				'additional_charge_comment' => $additional_charge_comment,
				'additional_charge'         => $additional_charge,
			];
			//$arrDataWhere['id'] = $item_id;
			$shipment_item_details_id = $this->api_model->insertData('shipment_item_details', $shipItemDet);
			//print_r($shipment_item_details_id);
			if ($charges_mode == 1) {
				$shipCharges = [
					'shipment_id'       => $shipment_id,
					'road'              => $finalRate,
					'rail'              => '0.00',
					'air'               => '0.00',
					'ship'              => '0.00',
					'shipment_item_details_id'              => $shipment_item_details_id,
				];
			} else if ($charges_mode == 2) {
				$shipCharges = [
					'shipment_id'       => $shipment_id,
					'road'              => '0.00',
					'rail'              => $finalRate,
					'air'               => '0.00',
					'ship'              => '0.00',
					'shipment_item_details_id'              => $shipment_item_details_id,
				];
			} else if ($charges_mode == 3) {
				$shipCharges = [
					'shipment_id'       => $shipment_id,
					'road'              => '0.00',
					'rail'              => '0.00',
					'air'               => $finalRate,
					'ship'              => '0.00',
					'shipment_item_details_id'              => $shipment_item_details_id,
				];
			} else {
				$shipCharges = [
					'shipment_id'       => $shipment_id,
					'road'              => '0.00',
					'rail'              => '0.00',
					'air'               => '0.00',
					'ship'              => $finalRate,
					'shipment_item_details_id'              => $shipment_item_details_id,
				];
			}
			//$arrWhere['shipment_item_details_id'] = $item_id;
			$shipment_charges_up = $this->api_model->insertData('shipment_charges', $shipCharges);
			//print_r($shipment_charges_up); die; 
			if ($shipment_charges_up > 0) {
				$data1['code'] = '200';
				$data1['status'] = 'success';
				$data1['message'] = 'Order Item added successfully.';
				$data1['OrderItemDetails']['ItemDetails'] = $shipItemDet;
				$data1['OrderItemDetails']['ChargesDetails'] = $shipCharges;
			} else {
				$data1['code'] = '201';
				$data1['status'] = 'failed';
				$data1['message'] = 'Order Item cannot added!!';
				$data1['OrderItemDetails'] = '';
			}
		} else {
			$data1['code'] = '201';
			$data1['status'] = 'failed';
			$data1['message'] = 'Order Item rate details not found!!';
			$data1['OrderItemDetails'] = '';
		}
		echo json_encode($data1);
	}

	public function services_contact()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$fname        	= $this->input->post('fname');
		$lname 			= $this->input->post('lname');
		$email       	= $this->input->post('email');
		$telephone      = $this->input->post('telephone');
		$mesg        	= $this->input->post('mesg');
		$user_id        = $this->input->post('user_id');

		if ($email != '' || $telephone != '') {
			$service_req = [
				'user_id'   => $user_id,
				'fname' 	=> $fname,
				'lname'     => $lname,
				'email'     => $email,
				'telephone' => $telephone,
				'mesg'      => $mesg,
				'add_date'  => DTIME,
			];

			$service_request_insert = $this->db->insert('service_request', $service_req);

			if ($service_request_insert > 0) {
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = 'Service request successfully created.';
			} else {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'Service request cannot created!!';
			}
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'parameter missing!';
		}
		$json = json_encode($data);
		echo $json;
	}

	public function orderTracking()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$order_no		= $this->input->post('order_no');
		$return = $this->api_model->getOrderTrackingStatus($order_no);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Order tracking Status not found';
			$data['orderTrackingStatus'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['orderTrackingStatus'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function orderItemBarcodeScan()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$visited_order_id		= ltrim($this->input->post('visited_order_id'), '0');
		$order_id		= ltrim($this->input->post('order_id'), '0');
		$item_id		= ltrim($this->input->post('item_id'), '0');
		$user_id		= $this->input->post('user_id');
		$branch_id		= $this->input->post('branch_id');
		if ($visited_order_id == $order_id) {
			if (!empty($order_id) || !empty($item_id)) {
				if ($item_id == '1') {
					$OrderLastStatus = getStatusNameByShipment($order_id);
				} else {
					$OrderLastStatus = 'Custom Status';
				}
				//echo $OrderLastStatus; 
				if ($OrderLastStatus == 'Ready for Pickup') {
					$status = '2';
				} else if ($OrderLastStatus == 'Picked Up') {
					$status = '3';
				} else if ($OrderLastStatus == 'Warehouse') {
					$status = '4';
				} else if ($OrderLastStatus == 'In Transit') {
					$status = '8';
				} else if ($OrderLastStatus == 'Destination Warehouse') {
					$status = '5';
				} else if ($OrderLastStatus == 'Out for Delivery') {
					$status = '6';
				} else {
					$status = '9';
				}
				//echo '===>>'.$status;
				// for PD boy pickup scan
				if ($status == '2') {
					$UserID = $this->api_model->getpdUserIDByOrderID($order_id, '1');
					//print_r($UserID); die;
					if (in_array($user_id, $UserID)) {
						if ($item_id == 1) {
							$shipmentStatus = array(
								'shipment_id' => $order_id,
								'status_id' => '2',
								'branch_id' => $branch_id,
								'created_by' => $user_id,
								'created_date' => DTIME
							);
							$data1 = array(
								'status' => '1'
							);
							$UpdateOrderStatus   =   $this->api_model->upadte_pdboy_order_status($order_id, $user_id, $data1);
							if ($UpdateOrderStatus > 0) {
								$this->api_model->insertData('shipment_status', $shipmentStatus);
								$data['code'] = '200';
								$data['status'] = 'success';
								$data['message'] = 'Shipment order item ' . $item_id . ' picked-up successfully.';
								$data['orderStatus'] = $shipmentStatus;

								// send push notification to customer
								$pushToken = getCustomerPushTokenByOrderId($order_id);
								if (!empty($pushToken)) {
									$title = "Royal Sherry Order Tracking";
									$message = 'Pickup ' . getOrdernoByOrderId($order_id) . ' from ' . DTIME . ' received from ' . getCustomerNameByOrderId($order_id) . ' at ' . getBranchNameByBranchId($branch_id) . ' Regards, Staqo';

									$notification['to'] = $pushToken;
									$notification['notification']['title'] = $title;
									$notification['notification']['body'] = $message;
									$notification['notification']['badge'] = "1";
									$notification['notification']['sound'] = "default";
									$notification['notification']['icon'] = "";
									$notification['notification']['image'] = "";
									$notification['notification']['type'] = "";
									$notification['notification']['data'] = "";

									sendPushNotificationToMobileDevice($notification);
								}

								// send SMS to customer
								$CustomerTelephone = getCustomerTelephoneByOrderId($order_id);
								sendSMS($CustomerTelephone, 'Pickup ' . getOrdernoByOrderId($order_id) . ' from ' . DTIME . ' received from ' . getCustomerNameByOrderId($order_id) . ' at ' . getBranchNameByBranchId($branch_id) . ' Regards, Staqo');

								// send mail to customer
								$body = '';
								$body .= '<p>Pickup ' . getOrdernoByOrderId($order_id) . ' from ' . DTIME . ' received from ' . getCustomerNameByOrderId($order_id) . ' at ' . getBranchNameByBranchId($branch_id) . '</p>';
								$body .= '<p>Thank You</p>';
								$body .= '<p>Team Royal Serry.</p>';

								$replyemail = 'no-reply@royalserry.com';
								$from_email = 'no-reply@royalserry.com';
								$name = 'Royal Serry';
								$to_email = getCustomerEmailByOrderId($order_id);
								$subject = 'Royal Serry Order picked-up.';

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

								// send mail to Branch
								$body = '';
								$body .= '<p>Pickup ' . getOrdernoByOrderId($order_id) . ' from ' . DTIME . ' received from ' . getCustomerNameByOrderId($order_id) . ' at ' . getBranchNameByBranchId($branch_id) . '</p>';
								$body .= '<p>Thank You</p>';
								$body .= '<p>Team Royal Serry.</p>';

								$replyemail = 'no-reply@royalserry.com';
								$from_email = 'no-reply@royalserry.com';
								$name = 'Royal Serry';
								$to_email = getBranchEmailByBranchId($branch_id);
								$subject = 'Royal Serry Order picked-up.';

								$config1 = array(
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
								$this->email->initialize($config1);

								$this->email->set_newline("\r\n");
								$this->email->set_mailtype("html");
								$this->email->from($from_email, $name);
								$this->email->to($to_email);
								$this->email->reply_to($replyemail);
								$this->email->subject($subject);
								$this->email->message($body);
								$this->email->send();

								// send mail to PD boy
								$body = '';
								$body .= '<p>Pickup ' . getOrdernoByOrderId($order_id) . ' from ' . DTIME . ' received from ' . getCustomerNameByOrderId($order_id) . ' at ' . getBranchNameByBranchId($branch_id) . '</p>';
								$body .= '<p>Thank You</p>';
								$body .= '<p>Team Royal Serry.</p>';

								$replyemail = 'no-reply@royalserry.com';
								$from_email = 'no-reply@royalserry.com';
								$name = 'Royal Serry';
								$to_email = getUserEmailByUserId($user_id);
								$subject = 'Royal Serry Order picked-up.';

								$config2 = array(
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
								$this->email->initialize($config2);

								$this->email->set_newline("\r\n");
								$this->email->set_mailtype("html");
								$this->email->from($from_email, $name);
								$this->email->to($to_email);
								$this->email->reply_to($replyemail);
								$this->email->subject($subject);
								$this->email->message($body);
								$this->email->send();
							}
						} else {
							$data['code'] = '200';
							$data['status'] = 'success';
							$data['message'] = 'Shipment order item ' . $item_id . ' picked-up successfully.';
						}
					} else {
						$data['code'] = '201';
						$data['status'] = 'failed';
						$data['message'] = 'You cannot Pickup this Shipment order!!  This is not your order.';
					}
				}
				// Branch pickup scan
				if ($status == '3') {
					if ($item_id == 1) {
						$shipmentStatus = array(
							'shipment_id' => $order_id,
							'status_id' => '3',
							'branch_id' => $branch_id,
							'created_by' => $user_id,
							'created_date' => DTIME
						);
						$this->api_model->insertData('shipment_status', $shipmentStatus);

						$data['code'] = '200';
						$data['status'] = 'success';
						$data['message'] = 'Shipment order item ' . $item_id . ' picked-up by Warehouse.';

						// send push notification to customer
						$pushToken = getCustomerPushTokenByOrderId($order_id);
						if (!empty($pushToken)) {
							$title = "Royal Sherry Order Tracking";
							$message = 'Parcel ' . getOrdernoByOrderId($order_id) . ' on ' . getOrderDateByOrderId($order_id) . ' received from ' . getCustomerNameByOrderId($order_id) . ' at ' . getBranchNameByBranchId($branch_id) . ' reached warehouse.';

							$notification['to'] = $pushToken;
							$notification['notification']['title'] = $title;
							$notification['notification']['body'] = $message;
							$notification['notification']['badge'] = "1";
							$notification['notification']['sound'] = "default";
							$notification['notification']['icon'] = "";
							$notification['notification']['image'] = "";
							$notification['notification']['type'] = "";
							$notification['notification']['data'] = "";

							sendPushNotificationToMobileDevice($notification);
						}

						// send mail to customer
						$body = '';
						$body .= '<p>Parcel ' . getOrdernoByOrderId($order_id) . ' on ' . getOrderDateByOrderId($order_id) . ' received from ' . getCustomerNameByOrderId($order_id) . ' at ' . getBranchNameByBranchId($branch_id) . ' reached warehouse</p>';
						$body .= '<p>Thank You</p>';
						$body .= '<p>Team Royal Serry.</p>';

						$replyemail = 'no-reply@royalserry.com';
						$from_email = 'no-reply@royalserry.com';
						$name = 'Royal Serry';
						$to_email = getCustomerEmailByOrderId($order_id);
						$subject = 'Royal Serry Order Reached Warehouse.';

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
					} else {
						$data['code'] = '200';
						$data['status'] = 'success';
						$data['message'] = 'Shipment order item ' . $item_id . ' picked-up by Warehouse.';
					}
				}

				// Insert order item to container via scan
				if ($status == '4') {
					if ($item_id == 1) {
						$ContainerID = $this->api_model->getContainerByshipmentId($order_id);
						$container_id = $ContainerID[0]['id'];
						$contdata = array(
							'container_id' => $container_id,
							'order_id' => $order_id,
							'item_id' => $item_id,
							'created_by' => $user_id,
							'date_time' => date('Y-m-d'),
							'status' => '1'
						);
						$this->api_model->insertData('container_shipment_items', $contdata);

						$shipmentStatus = array(
							'shipment_id' => $order_id,
							'status_id' => '4',
							'branch_id' => $branch_id,
							'created_by' => $user_id,
							'created_date' => DTIME
						);
						$this->api_model->insertData('shipment_status', $shipmentStatus);

						$data['code'] = '200';
						$data['status'] = 'success';
						$data['message'] = 'Shipment order item ' . $item_id . ' added to container.';

						// send push notification to customer
						$pushToken = getCustomerPushTokenByOrderId($order_id);
						if (!empty($pushToken)) {
							$title = "Royal Sherry Order Tracking";
							$message = 'Parcel ' . getOrdernoByOrderId($order_id) . ' on ' . getOrderDateByOrderId($order_id) . ' received from ' . getCustomerNameByOrderId($order_id) . ' at ' . getBranchNameByBranchId($branch_id) . ' is in transit.';

							$notification['to'] = $pushToken;
							$notification['notification']['title'] = $title;
							$notification['notification']['body'] = $message;
							$notification['notification']['badge'] = "1";
							$notification['notification']['sound'] = "default";
							$notification['notification']['icon'] = "";
							$notification['notification']['image'] = "";
							$notification['notification']['type'] = "";
							$notification['notification']['data'] = "";

							sendPushNotificationToMobileDevice($notification);
						}

						// send mail to customer
						$body = '';
						$body .= '<p>Parcel ' . getOrdernoByOrderId($order_id) . ' on ' . getOrderDateByOrderId($order_id) . ' received from ' . getCustomerNameByOrderId($order_id) . ' at ' . getBranchNameByBranchId($branch_id) . ' is in transit.</p>';
						$body .= '<p>Thank You</p>';
						$body .= '<p>Team Royal Serry.</p>';

						$replyemail = 'no-reply@royalserry.com';
						$from_email = 'no-reply@royalserry.com';
						$name = 'Royal Serry';
						$to_email = getCustomerEmailByOrderId($order_id);
						$subject = 'Royal Serry Order in transit.';

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
					} else {
						$data['code'] = '200';
						$data['status'] = 'success';
						$data['message'] = 'Shipment order item ' . $item_id . ' added to container.';
					}
				}

				//warehouse scan when container received by branch
				if ($status == '8') {
					if ($item_id == 1) {

						$constatus = array(
							'status' => '3'
						);
						$ontainerItemStatus   =   $this->api_model->UpdateContainerItemStatus($constatus, $order_id);
						if ($ontainerItemStatus > 0) {
							$shipmentStatus = array(
								'shipment_id' => $order_id,
								'status_id' => '8',
								'branch_id' => $branch_id,
								'created_by' => $user_id,
								'created_date' => DTIME
							);
							$this->api_model->insertData('shipment_status', $shipmentStatus);

							$data['code'] = '200';
							$data['status'] = 'success';
							$data['message'] = 'Shipment order item ' . $item_id . ' received by destination Warehouse.';
						}
					} else {
						$data['code'] = '200';
						$data['status'] = 'success';
						$data['message'] = 'Shipment order item ' . $item_id . ' received by destination Warehouse.';
					}
				}

				// PD boy scan for out for delivery
				if ($status == '5') {
					if ($item_id == 1) {
						$shipmentStatus = array(
							'shipment_id' => $order_id,
							'status_id' => '5',
							'branch_id' => $branch_id,
							'created_by' => $user_id,
							'created_date' => DTIME
						);
						$this->api_model->insertData('shipment_status', $shipmentStatus);

						$data['code'] = '200';
						$data['status'] = 'success';
						$data['message'] = 'Shipment order item ' . $item_id . ' out for delivery.';

						// send push notification to customer
						$pushToken = getCustomerPushTokenByOrderId($order_id);
						if (!empty($pushToken)) {
							$title = "Royal Sherry Order Tracking";
							$message = 'Parcel ' . getOrdernoByOrderId($order_id) . ' on ' . getOrderDateByOrderId($order_id) . ' received from ' . getCustomerNameByOrderId($order_id) . ' at ' . getBranchNameByBranchId($branch_id) . ' is out for delivery from warehouse.';

							$notification['to'] = $pushToken;
							$notification['notification']['title'] = $title;
							$notification['notification']['body'] = $message;
							$notification['notification']['badge'] = "1";
							$notification['notification']['sound'] = "default";
							$notification['notification']['icon'] = "";
							$notification['notification']['image'] = "";
							$notification['notification']['type'] = "";
							$notification['notification']['data'] = "";

							sendPushNotificationToMobileDevice($notification);
						}

						// send mail to customer
						$body = '';
						$body .= '<p>Parcel ' . getOrdernoByOrderId($order_id) . ' on ' . getOrderDateByOrderId($order_id) . ' received from ' . getCustomerNameByOrderId($order_id) . ' at ' . getBranchNameByBranchId($branch_id) . ' is out for delivery from warehouse</p>';
						$body .= '<p>Thank You</p>';
						$body .= '<p>Team Royal Serry.</p>';

						$replyemail = 'no-reply@royalserry.com';
						$from_email = 'no-reply@royalserry.com';
						$name = 'Royal Serry';
						$to_email = getCustomerEmailByOrderId($order_id);
						$subject = 'Royal Serry Order in Warehouse out for delivery.';

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
					} else {
						$data['code'] = '200';
						$data['status'] = 'success';
						$data['message'] = 'Shipment order item ' . $item_id . ' out for delivery.';
					}
				}

				// PD boy scan before delivery
				if ($status == '6') {
					$UserID = $this->api_model->getpdUserIDByOrderID($order_id, '2');
					if (in_array($user_id, $UserID)) {
						if ($item_id == 1) {
							$shipmentStatus = array(
								'shipment_id' => $order_id,
								'status_id' => '6',
								'branch_id' => $branch_id,
								'created_by' => $user_id,
								'created_date' => DTIME
							);
							$data1 = array(
								'status' => '1'
							);
							$UpdateOrderStatus   =   $this->api_model->upadte_pdboy_delivery_order_status($order_id, $user_id, $data1);
							if ($UpdateOrderStatus > 0) {
								$this->api_model->insertData('shipment_status', $shipmentStatus);
								$data['code'] = '200';
								$data['status'] = 'success';
								$data['message'] = 'Shipment order item ' . $item_id . ' delivered successfully.';

								// send push notification to customer
								$pushToken = getCustomerPushTokenByOrderId($order_id);
								if (!empty($pushToken)) {
									$title = "Royal Sherry Order Tracking";
									$message = 'Dear Customer, <br> Your parcel with ' . getOrdernoByOrderId($order_id) . ' with ' . getCustomerNameByOrderId($order_id) . ' is delivered at from ' . getBranchNameByBranchId($branch_id) . '  with RoyalSerry shipping.';

									$notification['to'] = $pushToken;
									$notification['notification']['title'] = $title;
									$notification['notification']['body'] = $message;
									$notification['notification']['badge'] = "1";
									$notification['notification']['sound'] = "default";
									$notification['notification']['icon'] = "";
									$notification['notification']['image'] = "";
									$notification['notification']['type'] = "";
									$notification['notification']['data'] = "";

									sendPushNotificationToMobileDevice($notification);
								}

								// send mail to customer
								$body = '';
								$body .= '<p>"Dear Customer, <br> Your parcel with ' . getOrdernoByOrderId($order_id) . ' with ' . getCustomerNameByOrderId($order_id) . ' is delivered at from ' . getBranchNameByBranchId($branch_id) . '  with RoyalSerry shipping ."</p>';
								$body .= '<p>Thank You</p>';
								$body .= '<p>Team Royal Serry.</p>';

								$replyemail = 'no-reply@royalserry.com';
								$from_email = 'no-reply@royalserry.com';
								$name = 'Royal Serry';
								$to_email = getCustomerEmailByOrderId($order_id);
								$subject = 'Royal Serry Order delivered.';

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
							} else {
								$data['code'] = '201';
								$data['status'] = 'failed';
								$data['message'] = 'You cannot delivered this Shipment order.';
							}
						} else {
							$data['code'] = '200';
							$data['status'] = 'success';
							$data['message'] = 'Shipment order item ' . $item_id . ' delivered successfully.';
						}
					} else {
						$data['code'] = '201';
						$data['status'] = 'failed';
						$data['message'] = 'You cannot delivered this Shipment order!!  This is not your order.';
					}
				}

				if ($status == '9') {
					$data['code'] = '200';
					$data['status'] = 'success';
					$data['message'] = 'Shipment order item ' . $item_id . ' scan successfully.';
				}
			} else {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'Shipment order not found';
			}
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Invalid Order scaning!!';
		}
		$json = json_encode($data);
		echo $json;
	}

	public function testpush()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$title = "Test push. Liked Your Video";
		$message = "You have received 1 more like on your video";

		$notification['to'] = 'cokbBzfVSB-n8gDYofIz-P:APA91bHfvq4ryE8m5DpMoJFwGQ1GuHg2RCyyhmiVIaRdNfe_z9zKDnUwQn8wu9B0693SVg9NBJmKWSDI8FNf_ZDWRlp9hjxUDNeNRcugA3eitgbWCNL-OF60lYLUjyL9NnKrNNk8DjaF';
		$notification['notification']['title'] = $title;
		$notification['notification']['body'] = $message;
		// $notification['notification']['text'] = $sender_details['User']['username'].' has sent you a friend request';
		$notification['notification']['badge'] = "1";
		$notification['notification']['sound'] = "default";
		$notification['notification']['icon'] = "";
		$notification['notification']['image'] = "";
		$notification['notification']['type'] = "";
		$notification['notification']['data'] = "";

		sendPushNotificationToMobileDevice($notification);
	}

	public function pdboy_createQuote()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$quoteno = getSLNo(1);
		$location_type        = $this->input->post('location_type');
		$shipment_type_option = $this->input->post('shipment_type_option');
		$delivery_speed       = $this->input->post('delivery_speed');
		$customer_id          = $this->input->post('customer_id');
		$charges_final        = $this->input->post('charges_final');
		$user_id              = $this->input->post('user_id');

		// Quotation From Address
		$firstname             = $this->input->post('firstname');
		$lastname              = $this->input->post('lastname');
		$address_from          = $this->input->post('address_from');
		$address2              = $this->input->post('address2');
		$company_name          = $this->input->post('company_name');
		$country               = $this->input->post('country');
		$state                 = $this->input->post('state');
		$city                  = $this->input->post('city');
		$zip                   = $this->input->post('zip');
		$email                 = $this->input->post('email');
		$telephone             = $this->input->post('telephone');
		$address_type          = $this->input->post('address_type');


		// Quotation To Address
		$firstname_to             = $this->input->post('firstname_to');
		$lastname_to              = $this->input->post('lastname_to');
		$address_to          	  = $this->input->post('address_to');
		$address2_to              = $this->input->post('address2_to');
		$company_name_to          = $this->input->post('company_name_to');
		$country_to               = $this->input->post('country_to');
		$state_to                 = $this->input->post('state_to');
		$city_to                  = $this->input->post('city_to');
		$zip_to                   = $this->input->post('zip_to');
		$email_to                 = $this->input->post('email_to');
		$telephone_to             = $this->input->post('telephone_to');
		$address_type_to          = $this->input->post('address_type_to');

		$quot_data = [
			'quote_no'           => $quoteno,
			'customer_id'        => $customer_id,
			'shipment_type'      => $shipment_type_option,
			'location_type'      => $location_type,
			'transport_type'     => $charges_final,
			'status'             => '1',
			'platform'           => '2',
			'quote_type'         => '0',
			'created_by'         => $user_id,
			'delivery_mode_id'   => $delivery_speed,
			'created_date'       => DTIME,
		];

		//$ins_id   = $this->OuthModel->insertQuery('quotation_master', $this->OuthModel->xss_clean($quot_data));
		$this->db->insert('quotation_master', $quot_data);
		$quotation_id = strval($this->db->insert_id());
		$quot_data['quotation_id'] = $quotation_id;

		if ($quotation_id != '') {
			// Quotation From Address
			$quot_from_address = [
				'quotation_id'  => $quotation_id,
				'customer_id'   => $customer_id,
				'firstname'     => $firstname,
				'lastname'      => $lastname,
				'address'       => $address_from,
				'address2'      => $address2,
				'company_name'  => $company_name,
				'country'       => $country,
				'state'         => $state,
				'city'          => $city,
				'zip'           => $zip,
				'email'         => $email,
				'telephone'     => $telephone,
				'address_type'  => $address_type
			];
			$from_address = $this->api_model->quotationFromDetails($quotation_id);
			if (count($from_address) < 1) {
				$this->db->insert('quotation_from_address', $quot_from_address);
			}

			// Quotation To Address
			$quot_to_address = [
				'quotation_id'  => $quotation_id,
				'customer_id'   => $customer_id,
				'firstname'     => $firstname_to,
				'lastname'      => $lastname_to,
				'address'       => $address_to,
				'address2'      => $address2_to,
				'company_name'  => $company_name_to,
				'country'       => $country_to,
				'state'         => $state_to,
				'city'          => $city_to,
				'zip'           => $zip_to,
				'email'         => $email_to,
				'telephone'     => $telephone_to,
				'address_type'  => $address_type_to
			];
			$to_address = $this->api_model->quotationToDetails($quotation_id);
			if (count($to_address) < 1) {
				$this->db->insert('quotation_to_address', $quot_to_address);
			}

			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = 'Your Quotation successfully created. Please add item to Quotation.';
			$data['quotation_data'] = $quot_data;
			$data['quotation_from_address'] = $quot_from_address;
			$data['quotation_to_address'] = $quot_to_address;
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Quotation cannot created!!';
		}

		$json = json_encode($data);
		echo $json;
	}

	public function AddItemToQuote()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$quotation_id           = $this->input->post('quotation_id');
		$rate_type              = 'L';
		$location_from          = $this->input->post('location_state_from');
		$location_to            = $this->input->post('location_state_to');
		$charges_mode           = $this->input->post('charges_final');
		$delivery_mode_id       = $this->input->post('delivery_speed');
		$quantity               = $this->input->post('quantity');
		if ($quantity == '') {
			$quantity = 1;
		}

		$type                   = $this->input->post('parcel_type');
		$ship_cat_id            = $type;

		if ($type == 1) {
			$ship_subcat_id                 = $this->input->post('document_category');
			$ship_sub_subcat_id             = $this->input->post('document_sub_cat');
			$item                           = $this->input->post('document_item');
			$other_details                  = $this->input->post('other_details_document');
			$value_of_shipment              = $this->input->post('value_of_shipment_parcel');
			$protect_parcel                 = $this->input->post('protect_parcel');
			$shipment_description_parcel    = $this->input->post('shipment_description_parcel');
		} else {
			$ship_subcat_id                 = $this->input->post('package_category');
			$ship_sub_subcat_id             = $this->input->post('package_sub_cat');
			$item                           = $this->input->post('package_item');
			$other_details                  = $this->input->post('other_details_parcel');
			$shipment_description_parcel    = $this->input->post('shipment_description_parcel');
			$value_of_shipment              = $this->input->post('value_of_shipment_parcel');
			$protect_parcel                 = $this->input->post('protect_parcel');
			$referance_parcel               = $this->input->post('referance_parcel');
			$length                         = $this->input->post('length');
			$length_dimen                   = $this->input->post('length_dimen');
			$breadth                        = $this->input->post('breadth');
			$breadth_dimen                  = $this->input->post('breadth_dimen');
			$height                         = $this->input->post('height');
			$height_dimen                   = $this->input->post('height_dimen');
			$weight                         = $this->input->post('weight');
			$weight_dimen                   = $this->input->post('weight_dimen');
		}

		$data['rates'] = $this->api_model->shipmentRate($ship_cat_id, $ship_subcat_id, $ship_sub_subcat_id, $rate_type, $location_from, $location_to, $charges_mode, $delivery_mode_id);
		if (!empty($data['rates'])) {
			$data['tax'] = $this->api_model->getTaxRate();

			$finalRate = $data['rates'][0]['rate'] * $quantity;
			$insurance = $data['rates'][0]['insurance'];

			$shipItemDet = [
				'quotation_id'           => $quotation_id,
				'category_id'            => $ship_subcat_id,
				'subcategory_id'         => $ship_sub_subcat_id,
				'item_id'                => $item,
				'desc'                   => $shipment_description_parcel,
				'value_shipment'         => $value_of_shipment,
				'quantity'               => $quantity,
				'rate'                   => $data['rates'][0]['rate'],
				'insur'                  => $insurance,
				'line_total'             => $finalRate,
				'other_details_parcel'   => $other_details,
				'protect_parcel'         => $protect_parcel,
				'referance_parcel'       => ((isset($referance_parcel)) ? $referance_parcel : ''),
				'length'                 => ((isset($length)) ? $length : ''),
				'length_dimen'           => ((isset($length_dimen)) ? $length_dimen : ''),
				'breadth'                => ((isset($breadth)) ? $breadth : ''),
				'breadth_dimen'          => ((isset($breadth_dimen)) ? $breadth_dimen : ''),
				'height'                 => ((isset($height)) ? $height : ''),
				'height_dimen'           => ((isset($height_dimen)) ? $height_dimen : ''),
				'weight'                 => ((isset($weight)) ? $weight : ''),
				'weight_dimen'           => ((isset($weight_dimen)) ? $weight_dimen : ''),
			];

			//$quote_items_insert = $this->OuthModel->insertQuery('quotation_item_details', $this->OuthModel->xss_clean($shipItemDet));
			$this->db->insert('quotation_item_details', $shipItemDet);
			$quote_items_insert = strval($this->db->insert_id());

			if ($charges_mode == 1) {
				$quoteCharges = [
					'quotation_id'              => $quotation_id,
					'quotation_item_details_id' => $quote_items_insert,
					'road'                      => $finalRate,
					'rail'                      => '0.00',
					'air'                       => '0.00',
					'ship'                      => '0.00',
				];
			} else if ($charges_mode == 2) {
				$quoteCharges = [
					'quotation_id'              => $quotation_id,
					'quotation_item_details_id' => $quote_items_insert,
					'road'                      => '0.00',
					'rail'                      => $finalRate,
					'air'                       => '0.00',
					'ship'                      => '0.00',
				];
			} else if ($charges_mode == 3) {
				$quoteCharges = [
					'quotation_id'              => $quotation_id,
					'quotation_item_details_id' => $quote_items_insert,
					'road'                      => '0.00',
					'rail'                      => '0.00',
					'air'                       => $finalRate,
					'ship'                      => '0.00',
				];
			} else {
				$quoteCharges = [
					'quotation_id'              => $quotation_id,
					'quotation_item_details_id' => $quote_items_insert,
					'road'                      => '0.00',
					'rail'                      => '0.00',
					'air'                       => '0.00',
					'ship'                      => $finalRate,
				];
			}

			$this->db->insert('quotation_charges', $quoteCharges);
			$quote_charges_insert = strval($this->db->insert_id());
			if ($quote_items_insert > 0) {
				$data1['code'] = '200';
				$data1['status'] = 'success';
				$data1['message'] = 'Your Quotation Items added Successfully.';
				$data1['quotation_Item'] = $shipItemDet;
			} else {
				$data1['code'] = '201';
				$data1['status'] = 'failed';
				$data1['message'] = 'Quotation Items cannot added!!';
			}
		} else {
			$data1['code'] = '201';
			$data1['status'] = 'failed';
			$data1['message'] = 'Quote Item rate details not found!!';
			$data1['QuoteItemDetails'] = '';
		}

		$json = json_encode($data1);
		echo $json;
	}

	public function sendzipcodeQuery()
	{
		$this->load->library('email');
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		//$name = $this->input->get('name');
		$email = $this->input->post('email');
		//$phone_get = $this->input->get('phone');
		/*if(!empty($phone_get))
			$phone = $phone_get;
		else
			$phone = '';*/
		$msg_get = $this->input->post('note');
		/*if(!empty($msg_get))
			$msg = $msg_get;
		else
			$msg = '';*/

		// Email
		$message = '';
		$message .= 'Email ID: ' . $email . "\n";
		//$message .= 'Phone Number: ' . $phone . "\n";
		$message .= 'Message: ' . $msg_get . "\n";

		$this->email->from('no-reply@royalsherry.com', 'Royal Serry');
		$this->email->to('debasis@lnsel.net');
		$this->email->subject('Royal Serry - user zip code query');
		$this->email->message($message);

		if ($this->email->send()) {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = 'Your Query send successfully.';
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'mail not sent';
		}
		$json = json_encode($data);
		echo $json;
	}

	public function customStatusList()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$shipment_id		= $this->input->post('order_id');
		$return = $this->api_model->getCustomStatusList($shipment_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Delivery Custom Status not found';
			$data['customStatusList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['customStatusList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function addCustomStatus()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$shipment_id		= 	$this->input->post('order_id');
		$status_id          =   '5';
		$branch_id          =   $this->input->post('branch_id');
		$created_by         =   $this->input->post('user_id');
		$created_date       =   DTIME;

		$status_text        =   $this->input->post('status_text');
		$comment            =   $this->input->post('comment');
		$status_type        =   '2';

		$checkAvailablity   =   $this->api_model->checkExistOrderStatus($shipment_id, $status_id);
		if ($checkAvailablity == 0) {
			$shipmentStatus = array(
				'shipment_id' => $shipment_id,
				'status_id' => '5',
				'branch_id' => $branch_id,
				'created_by' => $created_by,
				'created_date' => $created_date
			);

			$this->api_model->insertData('shipment_status', $shipmentStatus);
		}
		// insert custom order status table
		$customStatus = array(
			'shipment_id' => $shipment_id,
			'status_id' => '5',
			'status_type' => $status_type,
			'status_text' => $status_text,
			'comment' => $comment,
			'branch_id' => $branch_id,
			'created_by' => $created_by,
			'created_date' => DTIME
		);
		$UpdateCustomOrderStatus = $this->api_model->insertData('shipment_custom_status', $customStatus);

		if ($UpdateCustomOrderStatus > 0) {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = 'Delivery Custom Status added successfully.';
			$data['customStatus'] = $customStatus;
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Delivery Custom Status not added!!';
			$data['customStatus'] = '';
		}
		$json = json_encode($data);
		echo $json;
	}

	public function customersList()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		//$shipment_id		= $this->input->post('order_id');
		$return = $this->api_model->getcustomersList();
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Customer not found';
			$data['customersList'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['customersList'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function areaWiseCustomersList()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$pdboy_id		= $this->input->post('pdboy_id');
		$pdareaList = $this->api_model->getpdBoyAreaList($pdboy_id);
		if ($pdareaList == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Customer not found';
			$data['customersList'] = '';
		} else {
			//print_r($pdareaList);
			$ArearListarr = array();
			$ac = count($pdareaList);
			for ($i = 0; $i < $ac; $i++) {
				array_push($ArearListarr, $pdareaList[$i]->postal_code);
			}
			$return = $this->api_model->getAreaWiseCustomersList($ArearListarr);
			if ($return == 'not_found') {
				$data['code'] = '201';
				$data['status'] = 'failed';
				$data['message'] = 'Customer not found';
				$data['customersList'] = '';
			} else {
				$data['code'] = '200';
				$data['status'] = 'success';
				$data['message'] = '';
				$data['customersList'] = $return;
			}
		}
		$json = json_encode($data);
		echo $json;
	}

	public function customersDetails()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$user_id		= $this->input->post('user_id');
		$return = $this->api_model->getcustomersDetails($user_id);
		if ($return == 'not_found') {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Customer Details not found';
			$data['customersDetails'] = '';
		} else {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = '';
			$data['customersDetails'] = $return;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function requestQuoteCompleted()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$quotation_id		= 	$this->input->post('quotation_id');
		$status          =   '1';

		// insert custom order status table
		$customStatus = array(
			'status' => $status
		);
		$UpdateCustomOrderStatus = $this->api_model->upadte_pdboy_quote_request_status($quotation_id, $customStatus);

		if ($UpdateCustomOrderStatus > 0) {
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = 'Quotation request completed Successfully';
			$data['quotation_id'] = $quotation_id;
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Quotation request cannot changed!!';
			$data['quotation_id'] = $quotation_id;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function manualpickup()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$order_id			= 	$this->input->post('order_id');
		$branch_id			= 	$this->input->post('branch_id');
		$user_id			= 	$this->input->post('user_id');
		$status          	=   '1';

		$shipmentStatus = array(
			'shipment_id' => $order_id,
			'status_id' => '2',
			'branch_id' => $branch_id,
			'created_by' => $user_id,
			'created_date' => DTIME
		);

		// insert custom order status table
		$data1 = array(
			'status' => $status
		);

		$UpdateOrderStatus   =   $this->api_model->upadte_pdboy_order_status($order_id, $user_id, $data1);
		if ($UpdateOrderStatus > 0) {
			$this->api_model->insertData('shipment_status', $shipmentStatus);
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = 'Shipment order item picked-up successfully.';
			$data['orderStatus'] = $shipmentStatus;

			// send push notification to customer
			$pushToken = getCustomerPushTokenByOrderId($order_id);
			if (!empty($pushToken)) {
				$title = "Royal Sherry Order Tracking";
				$message = 'Pickup ' . getOrdernoByOrderId($order_id) . ' from ' . DTIME . ' received from ' . getCustomerNameByOrderId($order_id) . ' at ' . getBranchNameByBranchId($branch_id) . ' Regards, Staqo';

				$notification['to'] = $pushToken;
				$notification['notification']['title'] = $title;
				$notification['notification']['body'] = $message;
				$notification['notification']['badge'] = "1";
				$notification['notification']['sound'] = "default";
				$notification['notification']['icon'] = "";
				$notification['notification']['image'] = "";
				$notification['notification']['type'] = "";
				$notification['notification']['data'] = "";

				sendPushNotificationToMobileDevice($notification);
			}
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Shipment order item already picked-up.';
			$data['orderStatus'] = $shipmentStatus;
		}
		$json = json_encode($data);
		echo $json;
	}

	public function manualdelivery()
	{
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		$order_id			= 	$this->input->post('order_id');
		$branch_id			= 	$this->input->post('branch_id');
		$user_id			= 	$this->input->post('user_id');
		$status          	=   '1';

		$shipmentStatus = array(
			'shipment_id' => $order_id,
			'status_id' => '6',
			'branch_id' => $branch_id,
			'created_by' => $user_id,
			'created_date' => DTIME
		);

		// insert custom order status table
		$data1 = array(
			'status' => $status
		);

		$UpdateOrderStatus   =   $this->api_model->upadte_pdboy_delivery_order_status($order_id, $user_id, $data1);
		if ($UpdateOrderStatus > 0) {
			$this->api_model->insertData('shipment_status', $shipmentStatus);
			$data['code'] = '200';
			$data['status'] = 'success';
			$data['message'] = 'Shipment order item delivered successfully.';

			// send push notification to customer
			$pushToken = getCustomerPushTokenByOrderId($order_id);
			if (!empty($pushToken)) {
				$title = "Royal Sherry Order Tracking";
				$message = 'Dear Customer, <br> Your parcel with ' . getOrdernoByOrderId($order_id) . ' with ' . getCustomerNameByOrderId($order_id) . ' is delivered at from ' . getBranchNameByBranchId($branch_id) . '  with RoyalSerry shipping.';

				$notification['to'] = $pushToken;
				$notification['notification']['title'] = $title;
				$notification['notification']['body'] = $message;
				$notification['notification']['badge'] = "1";
				$notification['notification']['sound'] = "default";
				$notification['notification']['icon'] = "";
				$notification['notification']['image'] = "";
				$notification['notification']['type'] = "";
				$notification['notification']['data'] = "";

				sendPushNotificationToMobileDevice($notification);
			}
		} else {
			$data['code'] = '201';
			$data['status'] = 'failed';
			$data['message'] = 'Shipment order item already delivered.';
			$data['orderStatus'] = $shipmentStatus;
		}
		$json = json_encode($data);
		echo $json;
	}
}
