<?php if (!defined('BASEPATH')) {

    exit('No direct script access allowed');

}

if (!function_exists('repairSerializeString')) {

function repairSerializeString($value)
  {

    $regex = '/s:([0-9]+):"(.*?)"/';

    return preg_replace_callback(
      $regex,
      function ($match) {
        return "s:" . mb_strlen($match[2]) . ":\"" . $match[2] . "\"";
      },
      $value
    );
  }
}

function is_serialized_string($string)
{
    return ($string == 'b:0;' || @unserialize($string) !== false);
}
if (!function_exists('redirectPreviousPage')) {

    function redirectPreviousPage()

    {

        if (isset($_SERVER['HTTP_REFERER'])) {

            header('Location: ' . $_SERVER['HTTP_REFERER']);

        } else {

            header('Location: http://' . $_SERVER['SERVER_NAME']);

        }



        exit;

    }

}



function fillCombo_frontend($table, $value, $text, $selected, $condition, $order, $class, $name, $id, $is_disable = '', $dataattr = null, $dataid = null)
{
    $msg     = '';
    $str     = '';
    $disable = '';
    $ci      = &get_instance();
    $ci->load->database();
    $fetch = "`" . $value . "`,`" . $text . "`";
    $ci->db->select($fetch);
    $ci->db->from($table);
    if ($condition != '') {
        $ci->db->where($condition);
    }
    $ci->db->order_by($order, 'ASC');
    $query = $ci->db->get();
    if ($is_disable == 1) {
        $disable = 'disabled';
    }
    //echo $ci->db->last_query(); //die;
    $data = $query->result_array();

    if (count($data) > 0) {
        if ($dataattr != '') {
          $msg .= '<select name="' . $name . '" id="' . $id . '" class="' . $class . '" ' . $disable . ' ' .$dataattr.'="' . $dataid . '" >';
        } else {
           $msg .= '<select name="' . $name . '" id="' . $id . '" class="' . $class . '" ' . $disable . '>';
        }        

        $numbers = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        $selname = str_replace($numbers, '', $name);
        $selname = preg_replace('/[0-9]+/', '', $selname);
        $selname = preg_replace('/\d+/', '', $selname );
        $selname = ucwords(str_replace(array('_', '[]'), ' ', $selname));

        $msg .= '<option value="">Select ' . $selname . '</option>';
        foreach ($data as $resKey => $resValue) {
            if ($selected == $resValue[$value]) {
                $str = 'selected';
            } else {
                $str = '';
            }
            $msg .= '<option value="' . $resValue[$value] . '" ' . $str . '>' . $resValue[$text] . '';
            $msg .= '</option>';
        }
        $msg .= '</select>';
    }
    return $msg;
}



function fillCombo($table, $value, $text, $selected, $condition, $order, $class, $name, $id, $is_disable = '')

{

    $msg     = '';

    $str     = '';

    $disable = '';

    $ci      = &get_instance();

    $ci->load->database();

    $fetch = "`" . $value . "`,`" . $text . "`";

    $ci->db->select($fetch);

    $ci->db->from($table);

    if ($condition != '') {

        $ci->db->where($condition);

    }

    $ci->db->order_by($order, 'ASC');

    $query = $ci->db->get();

    if ($is_disable == 1) {

        $disable = 'disabled';

    }



    //echo $ci->db->last_query(); die;

    $data = $query->result_array();

    if (count($data) > 0) {

        $selname = preg_replace('/[0-9]+/', '', $name);

        $msg .= '<select name="' . $name . '" id="' . $id . '" class="' . $class . '" .' . $disable . ' >';

        $msg .= '<option value="">Select ' . ucwords(str_replace(array('_', '[]'), ' ', $selname)) . '</option>';

        foreach ($data as $resKey => $resValue) {

            if ($selected == $resValue[$value]) {

                $str = 'selected';

            } else {

                $str = '';

            }

            $msg .= '<option value="' . $resValue[$value] . '" ' . $str . '>' . $resValue[$text] . '';

            $msg .= '</option>';

        }

        $msg .= '</select>';

    }

    return $msg;

}





function getSLNo($module)

{

    $value2 = '';

    $value  = '';

    $ci     = &get_instance();

    $ci->load->database();

    $ql = $ci->db->select('prefix')->from('module_prefix')->where('module_id = "' . $module . '"', null, false)->get();

    //echo $ci->db->last_query(); die;

    $data   = $ql->result_array();

    $prefix = $data[0]['prefix'];

    switch ($module) {

        case '1':

            $query  = $ci->db->query("SELECT id AS result FROM quotation_master ORDER BY id DESC LIMIT 1");

            $result = $query->result_array();

            if (count($result) > 0) {

                $value2       = $result[0]['result'];

                $value2       = $value2 + 1; //Incrementing numeric part

                $value2       = $prefix . "/" . date('Y') . "/" . sprintf('%03s', $value2); //concatenating incremented value

                return $value = $value2;

            } else {

                $value2       = $prefix . "/" . date('Y') . "/001"; //concatenating incremented value

                return $value = $value2;

            }

            break;



        case '2':

            $query  = $ci->db->query("SELECT id AS result FROM shipment_master ORDER BY id DESC LIMIT 1");

            $result = $query->result_array();

            if (count($result) > 0) {

                $value2       = $result[0]['result'];

                $value2       = $value2 + 1; //Incrementing numeric part

                $value2       = $prefix . "/" . date('Y') . "/" . sprintf('%03s', $value2); //concatenating incremented value

                return $value = $value2;

            } else {

                $value2       = $prefix . "/" . date('Y') . "/001"; //concatenating incremented value

                return $value = $value2;

            }

            break;



        case '3':

            $query  = $ci->db->query("SELECT id AS result FROM container_shipment ORDER BY id DESC LIMIT 1");

            $result = $query->result_array();

            if (count($result) > 0) {

                $value2       = $result[0]['result'];

                $value2       = $value2 + 1; //Incrementing numeric part

                $value2       = $prefix . "/" . date('Y') . "/" . sprintf('%03s', $value2); //concatenating incremented value

                return $value = $value2;

            } else {

                $value2       = $prefix . "/" . date('Y') . "/001"; //concatenating incremented value

                return $value = $value2;

            }

            break;

        case '4':

            $query  = $ci->db->query("SELECT id AS result FROM container_shipment ORDER BY id DESC LIMIT 1");

            $result = $query->result_array();

            if (count($result) > 0) {

                $value2       = $result[0]['result'];

                $value2       = $value2 + 1; //Incrementing numeric part

                $value2       = $prefix . "/" . date('Y') . "/" . sprintf('%03s', $value2); //concatenating incremented value

                return $value = $value2;

            } else {

                $value2       = $prefix . "/" . date('Y') . "/001"; //concatenating incremented value

                return $value = $value2;

            }

            break;



        default:

            $value2       = "RS/" . date('Y') . "/001"; //concatenating incremented value

            return $value = $value2;

    }

}


function checkExistRecord($table, $params, $cols, $groupBy)
{
    $ci = &get_instance();
    $ci->load->database();
    $data           = array();
    $cols_format    = '';
    $groupBy_format = '';
    // For other Params
    if (!empty($cols)) {
        $cols_format = implode(',', $cols) . ', ';
    }

    // For Group By
    if (!empty($groupBy)) {
        $ci->db->group_by($groupBy);
    }

    $ci->db->select($cols_format . 'COUNT(*) AS total_records');
    $ci->db->from($table);
    foreach ($params as $key => $value) {
        $ci->db->where($key . '=', $value);
    }
    $query = $ci->db->get();
    //echo $ci->db->last_query();// die;
    $data = $query->result_array();
    return $data;
}


function getStatusName($id)
{
    $ci = &get_instance();
    $ci->load->database();
    $sql   = "SELECT status_name FROM status_master WHERE id = '" . $id . "'";
    $query = $ci->db->query($sql);
    $row   = $query->result_array();
    return $row[0]['status_name'];
}

function getUserPushToken($user_id)
{
    $ci = &get_instance();
    $ci->load->database();
    $sql   = "SELECT push_token FROM users WHERE user_id = '" . $user_id . "'";
    $query = $ci->db->query($sql);
    $row   = $query->result_array();
    return $row[0]['push_token'];
}

function getCheckPoint($user_id, $checkpoint_id)
{
    $ci = &get_instance();
    $ci->load->database();
    $sql   = "SELECT * FROM users_paylater_checkpoint WHERE user_id = '" . $user_id . "' AND checkpoint_id = '" . $checkpoint_id . "'";
    $query = $ci->db->query($sql);
    //$row   = $query->result_array();
	$row = $query->num_rows();
    return $row;
}

function getStatusNameByShipment($shipment_id)
{
    $ci = &get_instance();
    $ci->load->database();
    //$sql   = "SELECT status_name FROM status_master WHERE shipment_id = '" . $shipment_id . "' ORDER BY `id` DESC limit 0,1";
	
	$sql   = "SELECT status_master.status_name FROM status_master INNER JOIN shipment_status ON status_master.id=shipment_status.status_id WHERE shipment_status.shipment_id = '" . $shipment_id . "' ORDER BY shipment_status.id DESC limit 0,1";
    $query = $ci->db->query($sql);
    $row   = $query->result_array();
    return $row[0]['status_name'];
}


function getLatLongbyAddress($address){
	//echo $address; 
    $prepAddr = str_replace(' ','+',$address);
    $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyDmUohDE70gjqrjgFEbhtyjPOhn9WBghuo&address='.$prepAddr.'&sensor=false');
    $output= json_decode($geocode);
	//print_r($output); die;
	if(!empty($output->results[0]->geometry->location->lat) && !empty($output->results[0]->geometry->location->lng)){
		$latitude = $output->results[0]->geometry->location->lat;
		$longitude = $output->results[0]->geometry->location->lng;
	} else {
		$latitude = '8.482050';
		$longitude = '-13.213670';
	}
    return array('lat' => $latitude,'long'=> $longitude);
}

function formatPhoneTo($phoneNo){
    $phone_arr = unserialize($phoneNo);
    return implode(",",$phone_arr);
}

function getLastUrl(){
    //$lastUrl = $_SERVER['HTTP_REFERER'];
    if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != ''){
        return $_SERVER['HTTP_REFERER'];
    } else {
        return $_SESSION['current_url'];
    }
} 

function getDatesFromRange($start, $end, $format = 'Y-m-d') {
      
		// Declare an empty array
		$array = array();
		  
		// Variable that store the date interval
		// of period 1 day
		$interval = new DateInterval('P1D');
	  
		$realEnd = new DateTime($end);
		$realEnd->add($interval);
	  
		$period = new DatePeriod(new DateTime($start), $interval, $realEnd);
	  
		// Use loop to store date into array
		foreach($period as $date) {                 
			$array[] = $date->format($format); 
		}
	  
		// Return the array elements
		return $array;
	}
	
	function sendSMS($ToMobile, $message)
	{

		$mobileNo = $ToMobile;
		$sms_text = $message;

		/*$url = env('SMS_API_URL', '/');
		$userName = env('SMS_USERNAME', '');
		$password = env('SMS_PASSWORD', '');
		$senderID = env('SMS_SENDER_ID', '');
		$bearerToken = env('SMS_BEARER_TOKEN', '');*/
		
		$url = 'https://http.myvfirst.com/smpp/sendsms';
		
		$userName = 'staqoltdhtptran';
		$password = 'hlq`-\uB9]';
		$senderID = 'STAQOP';
		
		

		// Replace special charactor
        $frm = array("#", "$", "&", "*", "<| ", ">| ", "?", "@", "[", "\\", "]", "{", "|", "}", "~", "\n");
        $to = array("&#35;", "&#36;", "&#38;", "&#42;", "&#60;", "&#62;", "&#63;", "&#64;", "&#91;", "&#92;", "&#93;", "&#123;", "&#124;", "&#125;", "&#126;", "&#10;");

        // For English encode the URL
        $sms_text = str_replace($frm, $to, $sms_text);
        $sms_text = str_replace("\"", "&#34;", $sms_text);
		
		/*$queryString = urlencode('<?xml version="1.0" encoding="ISO-8859-1"?><!DOCTYPE MESSAGE SYSTEM "http://127.0.0.1/psms/dtd/message.dtd" ><MESSAGE><USER USERNAME="' . $userName . '" PASSWORD="' . $password . '"/><SMS UDH="0" CODING="1" TEXT="' . $sms_text . '" PROPERTY="0" ID="2864"><ADDRESS FROM="' . $senderID . '" TO="91' . $mobileNo . '" SEQ="1" TAG="some customer end random data" /></SMS></MESSAGE>');

		$url .=  '?data=' . $queryString . '&action=send';*/

		if(isset($dataSet['sha']) && $dataSet['sha']) {
			$frm = array("+", "-");
			$to = array("%2B", "%2D");
	
			// For English encode the URL
			$sha = str_replace($frm, $to, $dataSet['sha']);
			$sms_text .= $sha;
		}

		//value fisrt start 
		// &#60;&#35;&#62; 

		$postData=  'to='.$mobileNo.'&from='.$senderID.'&text='.$sms_text.'&dlr-mask=19&dlr-url';


		$curllogin = curl_init();

		curl_setopt_array($curllogin, array(
		  CURLOPT_URL => "https://http.myvfirst.com/smpp/api/sendsms/token?action=generate",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS=>$postData,
		  CURLOPT_HTTPHEADER => array(
			'Authorization: Basic '. base64_encode("$userName:$password")
		  ),
		));
		$outputLogin = json_decode(curl_exec($curllogin));
		////print_r($outputLogin);
		$errLogin = curl_error($curllogin);
		//dd($outputLogin->token);
		curl_close($curllogin);




		$curl = curl_init();

//die($url .'?'.$postData);

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url.'?',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS=>$postData,
		  CURLOPT_HTTPHEADER => array(
		    'Access-Control-Allow-Credentials: true',
		    'Authorization: Bearer '.$outputLogin->token
		  ),
		));
		$output = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		/*$smsLog = new SmsLog();
		$smsLog->mobile = $mobileNo;
		$smsLog->content = array($postData);
		$smsLog->response = array('output' => $output, 'error' => $err);
		$smsLog->save();*/
		
		return array('output' => $output, 'error' => $err);
	}

// get table name by type and id
function get_type_name_by_id($table, $type_id = '', $field = 'name')
{
    $CI = &get_instance();
    $get = $CI->db->select($field)->from($table)->where('id', $type_id)->limit(1)->get()->row_array();
    return $get[$field];
}

function get_permission($permission, $can = '')
{
    $ci = &get_instance();
    $role_id = $ci->session->userdata('role');
    if ($role_id == 1) {
        return true;
    }
    $permissions = get_staff_permissions($role_id);
    foreach ($permissions as $permObject) {
        if ($permObject->permission_prefix == $permission && $permObject->$can == '1') {
            return true;
        }
    }
    return false;
}

function get_staff_permissions($id)
{
    $ci = &get_instance();
    $sql = "SELECT `staff_privileges`.*,`tab`.`tabid` AS `permission_id`, `tab`.`name` AS `permission_prefix`  FROM `staff_privileges` JOIN `tab` ON `tab`.`tabid`=`staff_privileges`.`permission_id` WHERE `staff_privileges`.`role_id` = " . $ci->db->escape($id);
    $result = $ci->db->query($sql)->result();
    return $result;
}

// is superadmin logged in @return boolean
function is_superadmin_loggedin()
{
    $CI = &get_instance();
    if ($CI->session->userdata('role') == 1) {
        return true;
    }
    return false;
}

// get logged in user id - login credential DB id
function get_loggedin_id()
{
    $ci = &get_instance();
    return $ci->session->userdata('user_id');
}

// get session loggedin
function is_loggedin()
{
    $CI = &get_instance();
    if ($CI->session->has_userdata('logged_in')) {
        return true;
    }
    return false;
}

// get loggedin role name
function loggedin_role_name()
{
    $CI = &get_instance();
    $roleID = $CI->session->userdata('role');
    return $CI->db->select('name')->where('id', $roleID)->get('roles')->row()->name;
}

function loggedin_role_id()
{
    $ci = &get_instance();
    return $ci->session->userdata('role');
}

function getModuleRole($role_id)
{
    $ci = &get_instance();
    $ci->load->database();
    $data = array();
    $ci->db->select('tp.*');
    $ci->db->from('staff_privileges sp');
    $ci->db->join('tab tb','`tb`.`tabid` = `sp`.`permission_id`','left');
    $ci->db->join('tab_parent tp','tb.`parent` = tp.`parent_id`','left');

    $ci->db->where('sp.`role_id` =', $role_id);
    $ci->db->where('sp.`is_view` !=','0');    
    $ci->db->where('tp.status =', '1');
    $ci->db->group_by('tp.`parent_id`');
    $ci->db->order_by('parent_sequence', 'ASC');
    $query = $ci->db->get();
    //echo $ci->db->last_query(); die;
    $data = $query->result_array();
    return $data;
}

function getModule()
{
    $ci = &get_instance();
    $ci->load->database();
    $data = array();
    $ci->db->select('*');
    $ci->db->from('tab_parent');
    $ci->db->where('status =', '1');
    $ci->db->where('show_admin ', '1');
    $ci->db->order_by('parent_sequence', 'ASC');
    $query = $ci->db->get();
    //echo $ci->db->last_query(); die;
    $data = $query->result_array();
    return $data;
}

function getSideBarMenu($menu_id, $sub_parent)
{
    $ci = &get_instance();
    $ci->load->database();
    $data = array();
    $ci->db->select('*');
    $ci->db->from('tab');
    $ci->db->where('status =', '1');
    $ci->db->where('parent =', $menu_id);
    $ci->db->order_by('tabsequence', 'ASC');
    $ci->db->where('show_admin ', '1');
    $query = $ci->db->get();
    //echo $ci->db->last_query(); die;
    $data = $query->result_array();
    return $data;
}

function getSideBarMenuRole($menu_id, $sub_parent,$role_id)
{
    $ci = &get_instance();
    $ci->load->database();
    $data = array();
    $ci->db->select('tb.*');
    $ci->db->from('staff_privileges sp');
    $ci->db->join('tab tb','`tb`.`tabid` = `sp`.`permission_id`','left');
    $ci->db->join('tab_parent tp','tb.`parent` = tp.`parent_id`','left');

    $ci->db->where('sp.`role_id` =', $role_id);
    $ci->db->where('parent =', $menu_id);
    $ci->db->where('sp.`is_view` !=','0');    
    $ci->db->where('tp.status =', '1');
    $ci->db->group_by('tp.`parent_id`');
    $ci->db->group_by('tb.`tabid`');
    $ci->db->order_by('tabsequence', 'ASC');
    $query = $ci->db->get();
    //echo $ci->db->last_query(); //die;
    $data = $query->result_array();
    return $data;
}

function sendPushNotificationToMobileDevice($data)
{
	$key='AAAAQcVs1IM:APA91bEYV0N-C7jFUWG4mvyb9PLJk-52oGb6wXRORf03PflJlGFNfSdOg9cqsjIGa8LroUq6aThSj0E1Yxu9EGLM_LAuTcseNrGYPgW9RuSA648UGiIwbs6OiLShmLLNdiYEI5VpJ-Xx';
  
	$headers = array
		(
			'Authorization: key=' . $key,
			'Content-Type: application/json'
		);
	
	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
	curl_setopt( $ch,CURLOPT_POST, true );
	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $data ) );
	
	$result = curl_exec($ch);
	$err = curl_error($ch);
	curl_close($ch);

	if ($err) 
	{
	    //print_r($err);
	} 
	else 
	{
		//print_r($result);
	}

}

function getOrdernoByOrderId($order_id)
{
    $ci = &get_instance();
    $ci->load->database();
    $sql   = "SELECT shipment_no FROM shipment_master WHERE id = '" . $order_id . "'";
    $query = $ci->db->query($sql);
    $row   = $query->result_array();
    return $row[0]['shipment_no'];
}

function getOrderDateByOrderId($order_id)
{
    $ci = &get_instance();
    $ci->load->database();
    $sql   = "SELECT created_date FROM shipment_master WHERE id = '" . $order_id . "'";
    $query = $ci->db->query($sql);
    $row   = $query->result_array();
    return $row[0]['created_date'];
}

function getBranchNameByBranchId($branch_id)
{
    $ci = &get_instance();
    $ci->load->database();
    $sql   = "SELECT name FROM branch WHERE branch_id = '" . $branch_id . "'";
    $query = $ci->db->query($sql);
    $row   = $query->result_array();
    return $row[0]['name'];
}

function getBranchEmailByBranchId($branch_id)
{
    $ci = &get_instance();
    $ci->load->database();
    $sql   = "SELECT email FROM branch WHERE branch_id = '" . $branch_id . "'";
    $query = $ci->db->query($sql);
    $row   = $query->result_array();
    return $row[0]['email'];
}

function getCustomerNameByOrderId($order_id)
{
    $ci = &get_instance();
    $ci->load->database();
	$ci->db->select('u.firstname, u.lastname');
    $ci->db->from('users u');
    $ci->db->join('shipment_master sm','`sm`.`customer_id` = `u`.`user_id`','left');
    $ci->db->where('sm.`id` =', $order_id);
    $query = $ci->db->get();
    //echo $ci->db->last_query(); //die;
    $row = $query->result_array();
    return $row[0]['firstname'].' '.$row[0]['lastname'];
}

function getCustomerEmailByOrderId($order_id)
{
    $ci = &get_instance();
    $ci->load->database();
	$ci->db->select('u.email');
    $ci->db->from('users u');
    $ci->db->join('shipment_master sm','`sm`.`customer_id` = `u`.`user_id`','left');
    $ci->db->where('sm.`id` =', $order_id);
    $query = $ci->db->get();
    //echo $ci->db->last_query(); //die;
    $row = $query->result_array();
    return $row[0]['email'];
}

function getCustomerTelephoneByOrderId($order_id)
{
    $ci = &get_instance();
    $ci->load->database();
	$ci->db->select('u.telephone');
    $ci->db->from('users u');
    $ci->db->join('shipment_master sm','`sm`.`customer_id` = `u`.`user_id`','left');
    $ci->db->where('sm.`id` =', $order_id);
    $query = $ci->db->get();
    //echo $ci->db->last_query(); //die;
    $row = $query->result_array();
    return $row[0]['telephone'];
}

function getCustomerPushTokenByOrderId($order_id)
{
    $ci = &get_instance();
    $ci->load->database();
	$ci->db->select('u.push_token');
    $ci->db->from('users u');
    $ci->db->join('shipment_master sm','`sm`.`customer_id` = `u`.`user_id`','left');
    $ci->db->where('sm.`id` =', $order_id);
    $query = $ci->db->get();
    //echo $ci->db->last_query(); //die;
    $row = $query->result_array();
    return $row[0]['push_token'];
}

function getCustomerNameByQuoteId($quotation_id)
{
    $ci = &get_instance();
    $ci->load->database();
	$ci->db->select('u.firstname, u.lastname');
    $ci->db->from('users u');
    $ci->db->join('quotation_master qm','`qm`.`customer_id` = `u`.`user_id`','left');
    $ci->db->where('qm.`id` =', $quotation_id);
    $query = $ci->db->get();
    //echo $ci->db->last_query(); //die;
    $row = $query->result_array();
    return $row[0]['firstname'].' '.$row[0]['lastname'];
}

function getCustomerEmailByQuoteId($quotation_id)
{
    $ci = &get_instance();
    $ci->load->database();
	$ci->db->select('u.email');
    $ci->db->from('users u');
    $ci->db->join('quotation_master qm','`qm`.`customer_id` = `u`.`user_id`','left');
    $ci->db->where('qm.`id` =', $quotation_id);
    $query = $ci->db->get();
    //echo $ci->db->last_query(); //die;
    $row = $query->result_array();
    return $row[0]['email'];
}

function getUserEmailByUserId($user_id)
{
    $ci = &get_instance();
    $ci->load->database();
    $sql   = "SELECT email FROM users WHERE user_id = '" . $user_id . "'";
    $query = $ci->db->query($sql);
    $row   = $query->result_array();
    return $row[0]['email'];
}

/*if ( ! function_exists('get_seo_single_page_info'))

{

function get_seo_single_page_info($id)

{

$ci =& get_instance();

$ci->load->database();



$where = ['id' => $id];

//SELECT QUERY

$ci->db->select('*');

$ci->db->from('seo_details');

$ci->db->where($where);



$query = $ci->db->get();



$row = $query->num_rows();

if($row > 0)

{

$row = $query->result();

return $row;

}

exit;

}

}*/

