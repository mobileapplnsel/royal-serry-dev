<?php
class Api_model extends CI_Model
{
	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
		$this->load->helper('admin_helper');
	}

	//============================== Function to fetch Table Data ==============================
	public function fetchData($tableName, $fieldsAdmin, $mWhere, $groupBy = "", $orderBy = "", $asc_desc = "")
	{
		$returnedArray	=	array();
		if ($groupBy != "") {
			$this->db->group_by($groupBy);
		}
		if ($orderBy != "" && $asc_desc != "") {
			$this->db->order_by($orderBy, $asc_desc);
		}
		if (!empty($mWhere))
			$this->db->where($mWhere);

		$this->db->select($fieldsAdmin);
		$this->db->from($tableName);
		if ($query = $this->db->get()) {
			//echo $this->db->last_query();
			$returnedArray 	=	$query->result();
			//print_r($returnedArray);die;
		}
		return $returnedArray;
	}

	//============================== Function to fetch Table Data ==============================
	public  function  fetchDataAsArray($tableName, $fieldsAdmin, $mWhere, $groupBy = "", $orderBy = "", $asc_desc = "")
	{
		$returnedArray	=	array();
		if ($groupBy != "") {
			$this->db->group_by($groupBy);
		}
		if ($orderBy != "" && $asc_desc != "") {
			$this->db->order_by($orderBy, $asc_desc);
		}
		if (!empty($mWhere))
			$this->db->where($mWhere);

		$this->db->select($fieldsAdmin);
		$this->db->from($tableName);
		if ($query = $this->db->get()) {
			//echo $this->db->last_query();
			$returnedArray 	=	$query->result_array();
			//print_r($returnedArray);die;
		}
		return $returnedArray;
	}

	//================= Function to update data into Table =================
	public function updateData($tableName, $mWhere, $dataArray)
	{
		$returnedRows	= 0;
		$this->db->where($mWhere);
		if ($this->db->update($tableName, $dataArray)) {
			$returnedRows 	=	$this->db->affected_rows();
		}
		//echo $this->db->last_query();
		return $returnedRows;
	}

	//================= Function to insert data into Table =================
	public  function  insertData($tableName, $dataArray)
	{
		$returnedValue	=	0;

		if ($this->db->insert($tableName, $dataArray)) {
			$returnedValue	=	 $this->db->insert_id();
		}
		return $returnedValue;
	}

	public function validate_login($username, $password, $login_ip, $login_time, $user_type = null)
	{
		$this->db->select('*');
		$this->db->from('users');
		//$this->db->where('email', $username);
		$where = '(email="' . $username . '" or telephone = "' . $username . '")';
		$this->db->where($where);

		if ($user_type != null) {
			$this->db->where('user_type', $user_type);
		} else {
			// $this->db->where('user_type', 'NU');
		}

		$query = $this->db->get();
		$result = $query->row();
		if (!empty($result)) {
			$this->db->select('u.*, bu.branch_id, cm.name as country_name, stm.name as state_name, ctm.name as city_name');
			$this->db->from('users u');
			$this->db->join('branch_users bu', 'u.user_id = bu.user_id', 'left');

			$this->db->join('countries_master cm', 'u.country = cm.id', 'left');
			$this->db->join('states_master stm', 'u.state = stm.id', 'left');
			$this->db->join('cities_master ctm', 'u.city = ctm.id', 'left');
			$where = '((u.email="' . $username . '" AND u.password = "' . md5($password) . '") OR (u.telephone="' . $username . '" AND u.password = "' . md5($password) . '")) AND (u.user_type="BU" OR u.user_type="NU" OR u.user_type="PDB")';
			//$this->db->where(array('email' => $username, 'password' => md5($password)));
			$this->db->where($where);
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			$result = $query->row();
			if (!empty($result)) {
				if ($result->status == 1) {
					return $result;
				} else {
					return 'inactive';
				}
			} else {
				return 'password_incorrect';
			}
		} else {
			return 'not_found';
		}
	}
	public function quotationToDetails($id)
	{
		$this->db->select('*');
		$this->db->from('quotation_to_address');
		if ($id != '') {
			$this->db->where('quotation_id', $id);
		}

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
		$this->db->select('*');
		$this->db->from('quotation_from_address');
		if ($id != '') {
			$this->db->where('quotation_id', $id);
		}

		$query = $this->db->get();
		//echo $this->db->last_query();die;
		if ($query) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	public function countryList()
	{
		$data = array();
		$this->db->select('id, name, sortname');
		$this->db->from('countries_master');
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function stateList($countryID)
	{
		$data = array();
		$this->db->select('id, name');
		$this->db->from('states_master');
		$this->db->where('country_id', $countryID);
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function cityList($stateID)
	{
		$data = array();
		$this->db->select('id, name');
		$this->db->from('cities_master');
		$this->db->where('state_id', $stateID);
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function ShippingmodeList()
	{
		$data = array();
		$this->db->select('id, name');
		$this->db->from('shipping_mode');
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function DeliverymodeList()
	{
		$data = array();
		$this->db->select('id, name');
		$this->db->from('delivery_mode');
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function ShippingcategoryList()
	{
		$data = array();
		$this->db->select('id, name');
		$this->db->from('shipping_category');
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function itemcategoryList($type)
	{
		$data = array();
		$this->db->select('cat_id, category_name');
		$this->db->from('document_package_categories');
		$this->db->where('type', $type);
		$this->db->where('status', '1');
		$this->db->where('parent_cat_id', '0');
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getQuotationByUser($id)
	{
		$this->db->select('*');
		$this->db->from('quotation_master');
		$this->db->where('customer_id', $id);
		$this->db->where_in('quote_type', array(0, 2));
		//$this->db->or_where('quote_type', 2);
		$this->db->where('status', 1);
		$this->db->order_by('id', 'DESC');
		$this->db->group_by('quote_no ');
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			$array_out = array();
			$result = $query->result_array();
			foreach ($result as $key => $results) {
				$array_out[] =
					array(
						"id" => $results['id'],
						"quote_no" => $results['quote_no'],
						"parent_id" => $results['parent_id'],
						"customer_id" => $results['customer_id'],
						"shipment_type" => $results['shipment_type'],
						"location_type" => $results['location_type'],
						"transport_type" => $results['transport_type'],
						"delivery_mode_id" => $results['delivery_mode_id'],
						"road" => $results['road'],
						"rail" => $results['rail'],
						"air" => $results['air'],
						"ship" => $results['ship'],
						"status" => $results['status'],
						"platform" => $results['platform'],
						"created_by" => $results['created_by'],
						"created_date" => $results['created_date'],
						"quote_type" => $results['quote_type'] == 2 ? 'Requested' : 'Created',
						"order_created" => $results['order_created'],
						"order_created_dtime" => is_null($results['order_created_dtime']) ? '' : $results['order_created_dtime'],
					);
			}
			return $array_out;
			//return $result;
		} else {
			return 'not_found';
		}
	}

	public function getpdBoyRequestQuotationList($user_id)
	{
		$this->db->select('pdbqr.*, qm.*, qfa.firstname as from_firstname, qfa.lastname as from_lastname, qfa.address as from_address, qfa.address2 from_address2, qfa.telephone from_telephone, cm.name as country_name, stm.name as state_name, ctm.name as city_name, qfa.zip from_zip, qfa.latitude, qfa.longitude');
		$this->db->from('pd_boy_quotation_req_tagging pdbqr');
		$this->db->join('quotation_master qm', 'pdbqr.quotation_id = qm.id');
		$this->db->join('quotation_from_address qfa', 'qm.id = qfa.quotation_id');
		$this->db->join('countries_master cm', 'qfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'qfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'qfa.city = ctm.id', 'left');
		$this->db->where('pdbqr.user_id', $user_id);
		$this->db->where('pdbqr.status', '0');
		$this->db->where('qm.status', 1);
		$this->db->order_by('pdbqr.id', 'DESC');
		$this->db->group_by('pdbqr.quotation_id ');
		$query  = $this->db->get();
		$result = $query->result_array();
		// echo $this->db->last_query();die;
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getOrderByUser($id)
	{
		$this->db->select('*');
		$this->db->from('shipment_master');
		$this->db->where('customer_id', $id);

		$this->db->order_by('id', 'DESC');
		$this->db->group_by('shipment_no ');
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getPaylaterByUser($id)
	{
		$this->db->select('pay_later');
		$this->db->from('users');
		$this->db->where('user_id', $id);
		/* $this->db->where('quote_type', 0);;
        $this->db->or_where('quote_type', 2);
        $this->db->order_by('id', 'DESC');
        $this->db->group_by('quote_no ');*/
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getHolidaysByBranch($branch_id)
	{
		$this->db->select('*');
		$this->db->from('branch_holiday');
		$this->db->where('branch_id', $branch_id);
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getDutyListByUser($user_id)
	{
		$this->db->select('sm.*, wd.day, pda.from_date, pda.to_date');
		$this->db->from('pd_shift_allocation psa');
		$this->db->join('shift_master sm', 'psa.shift_id = sm.id', 'left');
		$this->db->join('week_days wd', 'psa.day = wd.id', 'left');
		$this->db->join('pd_duty_allocation pda', 'psa.pd_id = pda.pd_id', 'left');
		$this->db->where('psa.pd_id', $user_id);
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getDutyAreaListByUser($user_id)
	{
		$this->db->select('pcdm.*');
		$this->db->from('postal_codes_data_master pcdm');
		$this->db->join('pickup_delivery_boy_area pdba', 'pcdm.id = pdba.area_id', 'left');
		//$this->db->join('week_days wd', 'psa.day = wd.id', 'left');
		//$this->db->join('pd_duty_allocation pda', 'psa.pd_id = pda.pd_id', 'left');
		$this->db->where('pdba.user_id', $user_id);
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getlocationIdByName($name, $key)
	{
		//$this->db->select('*');
		if ($key == 'country') {
			$this->db->select('*');
			$this->db->from('countries_master');
			$this->db->where('name', $name);
		} elseif ($key == 'state') {
			$this->db->select('sm.*, cm.sortname AS country_sortname, cm.phonecode AS country_phonecode');
			$this->db->from('states_master sm');
			$this->db->join('countries_master cm', 'sm.country_id = cm.id', 'left');
			$this->db->where('sm.name', $name);
		} elseif ($key == 'city') {
			$this->db->select('*');
			$this->db->from('cities_master');
			$this->db->where('name', $name);
		}
		//$this->db->where('name', $name);
		$query  = $this->db->get();
		$result = $query->row();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getProhibitedItems($params = null)
	{
		$this->db->select('prohibited.*');
		$this->db->from('prohibited');

		$this->db->where('status', '1');
		$this->db->where('is_deleted', '0');
		if ($params != null) {
			$this->db->where($params);
		}
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}


	public function quotationDetails($id)
	{
		$this->db->select('*');
		$this->db->from('quotation_master');
		if ($id != '') {
			$this->db->where('id', $id);
		}
		$this->db->order_by('id', 'DESC');
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getOrderDetails($id)
	{
		$this->db->select('*');
		$this->db->from('shipment_master');
		if ($id != '') {
			$this->db->where('id', $id);
		}
		$this->db->order_by('id', 'DESC');
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function quotationFromDetailsNew($id)
	{
		$this->db->select('quotation_from_address.*, countries_master.name AS country_name, states_master.name AS state_name, cities_master.name AS city_name');
		$this->db->join('`countries_master`', '`quotation_from_address`.`country` = `countries_master`.`id`', 'INNER');
		$this->db->join('`states_master`', '`quotation_from_address`.`state` = `states_master`.`id`', 'INNER');
		$this->db->join('`cities_master`', '`quotation_from_address`.`city` = `cities_master`.`id`', 'INNER');
		$this->db->where('`quotation_from_address`.`quotation_id`', $id);
		//$this->db->where('is_deleted', '0');
		$query_tb = $this->db->get('`quotation_from_address`');
		// echo $this->db->last_query();die;
		if ($query_tb) {
			return $query_tb->result_array();
		} else {
			return false;
		}
	}

	public function orderFromDetailsNew($id)
	{
		$this->db->select('shipment_from_address.*, countries_master.name AS country_name, states_master.name AS state_name, cities_master.name AS city_name');
		$this->db->join('`countries_master`', '`shipment_from_address`.`country` = `countries_master`.`id`', 'INNER');
		$this->db->join('`states_master`', '`shipment_from_address`.`state` = `states_master`.`id`', 'INNER');
		$this->db->join('`cities_master`', '`shipment_from_address`.`city` = `cities_master`.`id`', 'INNER');
		$this->db->where('`shipment_from_address`.`shipment_id`', $id);
		//$this->db->where('is_deleted', '0');
		$query_tb = $this->db->get('`shipment_from_address`');
		// echo $this->db->last_query();die;
		if ($query_tb) {
			return $query_tb->result_array();
		} else {
			return false;
		}
	}

	public function quotationToDetailsNew($id)
	{
		$this->db->select('quotation_to_address.*, countries_master.name AS country_name, states_master.name AS state_name, cities_master.name AS city_name');
		$this->db->join('`countries_master`', '`quotation_to_address`.`country` = `countries_master`.`id`', 'INNER');
		$this->db->join('`states_master`', '`quotation_to_address`.`state` = `states_master`.`id`', 'INNER');
		$this->db->join('`cities_master`', '`quotation_to_address`.`city` = `cities_master`.`id`', 'INNER');
		$this->db->where('`quotation_to_address`.`quotation_id`', $id);
		//$this->db->where('is_deleted', '0');
		$query_tb = $this->db->get('`quotation_to_address`');
		// echo $this->db->last_query();die;
		if ($query_tb) {
			return $query_tb->result_array();
		} else {
			return false;
		}
	}

	public function orderToDetailsNew($id)
	{
		$this->db->select('shipment_to_address.*, countries_master.name AS country_name, states_master.name AS state_name, cities_master.name AS city_name');
		$this->db->join('`countries_master`', '`shipment_to_address`.`country` = `countries_master`.`id`', 'INNER');
		$this->db->join('`states_master`', '`shipment_to_address`.`state` = `states_master`.`id`', 'INNER');
		$this->db->join('`cities_master`', '`shipment_to_address`.`city` = `cities_master`.`id`', 'INNER');
		$this->db->where('`shipment_to_address`.`shipment_id`', $id);
		//$this->db->where('is_deleted', '0');
		$query_tb = $this->db->get('`shipment_to_address`');
		// echo $this->db->last_query();die;
		if ($query_tb) {
			return $query_tb->result_array();
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
			$array_out = array();
			$result = $query_tb->result_array();
			foreach ($result as $key => $results) {

				if ($results['road'] != '0.00') {
					$rate = $results['road'];
				} else if ($results['rail'] != '0.00') {
					$rate = $results['rail'];
				} else if ($results['air'] != '0.00') {
					$rate = $results['air'];
				} else if ($results['ship'] != '0.00') {
					$rate = $results['ship'];
				} else {
					$rate = '0.00';
				}

				$array_out[] =
					array(
						"id" => $results['id'],
						"quotation_id" => $results['quotation_id'],
						"category_id" => $results['category_id'],
						"subcategory_id" => $results['subcategory_id'],
						"item_id" => $results['item_id'],
						"desc" => $results['desc'],
						"value_shipment" => $results['value_shipment'],
						"quantity" => $results['quantity'],
						"rate" => is_null($results['rate']) ? '' : $results['rate'],
						"insur" => $results['insur'],
						"line_total" => $rate,
						"rate" => is_null($results['rate']) ? '' : $results['rate'],
						"other_details_parcel" => is_null($results['other_details_parcel']) ? '' : $results['other_details_parcel'],
						"referance_parcel" => is_null($results['referance_parcel']) ? '' : $results['referance_parcel'],
						"length" => is_null($results['length']) ? '' : $results['length'],
						"length_dimen" => is_null($results['length_dimen']) ? '' : $results['length_dimen'],
						"height" => is_null($results['height']) ? '' : $results['height'],
						"height_dimen" => is_null($results['height_dimen']) ? '' : $results['height_dimen'],
						"weight" => is_null($results['weight']) ? '' : $results['weight'],
						"weight_dimen" => is_null($results['weight_dimen']) ? '' : $results['weight_dimen'],
						"breadth" => is_null($results['breadth']) ? '' : $results['breadth'],
						"breadth_dimen" => is_null($results['breadth_dimen']) ? '' : $results['breadth_dimen'],
						"protect_parcel" => is_null($results['protect_parcel']) ? '' : $results['protect_parcel'],
						"category_name" => is_null($results['category_name']) ? '' : $results['category_name'],
						"item_name" => is_null($results['item_name']) ? '' : $results['item_name'],
						"document" => is_null($results['document']) ? '' : $results['document'],
						"package" => is_null($results['package']) ? '' : $results['package'],
						"type" => is_null($results['type']) ? '' : $results['type'],
						"subcategory_name" => is_null($results['subcategory_name']) ? '' : $results['subcategory_name'],
						"road" => is_null($results['road']) ? '' : $results['road'],
						"rail" => is_null($results['rail']) ? '' : $results['rail'],
						"air" => is_null($results['air']) ? '' : $results['air'],
						"ship" => is_null($results['ship']) ? '' : $results['ship'],
					);
			}
			return $array_out;
		} else {
			return false;
		}
	}

	public function orderItemDetails($id)
	{
		$this->db->select('`view_shipment_item_details`.*, `document_package_categories`.`category_name` AS subcategory_name, `shipment_charges`.road,  `shipment_charges`.rail,  `shipment_charges`.air,  `shipment_charges`.ship');
		$this->db->join('`shipment_charges`', '`view_shipment_item_details`.`id` = `shipment_charges`.`shipment_item_details_id`', 'LEFT');
		$this->db->join('`document_package_categories`', '`view_shipment_item_details`.`subcategory_id` = `document_package_categories`.`cat_id`', 'LEFT');
		$this->db->where('`view_shipment_item_details`.`shipment_id`', $id);
		//$this->db->where('is_deleted', '0');
		$this->db->group_by('`view_shipment_item_details`.`id`');
		$query_tb = $this->db->get('`view_shipment_item_details`');
		// echo $this->db->last_query();die;
		if ($query_tb) {
			$result = $query_tb->result_array();
			$count = 1;
			foreach ($result as $key => $results) {
				// For barcode data
				$item_total = 0;
				$year = date("y");
				$itemsId = str_pad($count, 3, '0', STR_PAD_LEFT);
				$shipmentId = str_pad($results['shipment_id'], 7, '0', STR_PAD_LEFT);

				if ($results['road'] != 0.00) {
					$item_total = $results['road'];
				} elseif ($results['rail'] != 0.00) {
					$item_total = $results['rail'];
				} elseif ($results['air'] != 0.00) {
					$item_total = $results['air'];
				} elseif ($results['ship'] != 0.00) {
					$item_total = $results['ship'];
				}
				$array_out[] =
					array(
						"id" => $results['id'],
						"shipment_id" => $results['shipment_id'],
						"quotation_id" => $results['quotation_id'],
						"category_id" => $results['category_id'],
						"subcategory_id" => $results['subcategory_id'],
						"item_id" => $results['item_id'],
						"desc" => is_null($results['desc']) ? '' : $results['desc'],
						"value_shipment" => $results['value_shipment'],
						"quantity" => $results['quantity'],
						"rate" => is_null($results['rate']) ? '' : $results['rate'],
						"insur" => $results['insur'],
						"line_total" => $results['line_total'],
						"rate" => is_null($results['rate']) ? '' : $results['rate'],
						"other_details_parcel" => is_null($results['other_details_parcel']) ? '' : $results['other_details_parcel'],
						"referance_parcel" => is_null($results['referance_parcel']) ? '' : $results['referance_parcel'],
						"length" => is_null($results['length']) ? '' : $results['length'],
						"length_dimen" => is_null($results['length_dimen']) ? '' : $results['length_dimen'],
						"height" => is_null($results['height']) ? '' : $results['height'],
						"height_dimen" => is_null($results['height_dimen']) ? '' : $results['height_dimen'],
						"weight" => is_null($results['weight']) ? '' : $results['weight'],
						"weight_dimen" => is_null($results['weight_dimen']) ? '' : $results['weight_dimen'],
						"breadth" => is_null($results['breadth']) ? '' : $results['breadth'],
						"breadth_dimen" => is_null($results['breadth_dimen']) ? '' : $results['breadth_dimen'],
						"protect_parcel" => is_null($results['protect_parcel']) ? '' : $results['protect_parcel'],
						"additional_charge_comment" => is_null($results['additional_charge_comment']) ? '' : $results['additional_charge_comment'],
						"additional_charge" => is_null($results['additional_charge']) ? '' : $results['additional_charge'],
						"category_name" => is_null($results['category_name']) ? '' : $results['category_name'],
						"item_name" => is_null($results['item_name']) ? '' : $results['item_name'],
						"document" => is_null($results['document']) ? '' : $results['document'],
						"package" => is_null($results['package']) ? '' : $results['package'],
						"type" => is_null($results['type']) ? '' : $results['type'],
						"subcategory_name" => is_null($results['subcategory_name']) ? '' : $results['subcategory_name'],
						"road" => is_null($results['road']) ? '' : $results['road'],
						"rail" => is_null($results['rail']) ? '' : $results['rail'],
						"air" => is_null($results['air']) ? '' : $results['air'],
						"ship" => is_null($results['ship']) ? '' : $results['ship'],
						"item_total" => $item_total + $results['insur'] + $results['additional_charge'],
						"barcode_img" => base_url() . 'index.php/container/set_barcode/' . $year . $shipmentId . $itemsId,
					);
				$count++;
			}
			return $array_out;
		} else {
			return false;
		}
	}

	public function itemsubcategoryList($type, $parent_cat_id)
	{
		$data = array();
		$this->db->select('cat_id, category_name');
		$this->db->from('document_package_categories');
		$this->db->where('type', $type);
		$this->db->where('status', '1');
		$this->db->where('parent_cat_id', $parent_cat_id);
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function itemListbycatType($type, $cat_id)
	{
		$data = array();
		if ($type == '1') {
			$this->db->select('document_id as cat_id, name as category_name');
			$this->db->from('document');
		} else {
			$this->db->select('package_id as cat_id, name as category_name');
			$this->db->from('package');
		}

		//$this->db->where('type', $type);
		$this->db->where('status', '1');
		$this->db->where('category_id', $cat_id);
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getrateListbycat($ship_mode_id, $ship_cat_id, $delivery_mode_id, $ship_subcat_id, $ship_sub_subcat_id, $rate_type, $location_from, $location_to)
	{
		$data = array();
		$this->db->select('rm.id, rm.ship_mode_id, rm.delivery_mode_id, rm.rate, rm.insurance, sm.name as ship_mode_name, dm.name as delivery_mode_name');
		$this->db->from('rate_master rm');
		$this->db->join('shipping_mode sm', 'rm.ship_mode_id = sm.id');
		$this->db->join('delivery_mode dm', 'rm.delivery_mode_id = dm.id');
		$array = array('rm.ship_mode_id' => $ship_mode_id, 'rm.ship_cat_id' => $ship_cat_id, 'rm.delivery_mode_id' => $delivery_mode_id, 'rm.ship_subcat_id' => $ship_subcat_id, 'rm.ship_sub_subcat_id' => $ship_sub_subcat_id, 'rm.rate_type' => $rate_type, 'rm.location_from' => $location_from, 'rm.location_to' => $location_to, 'rm.status' => '1');
		$this->db->where($array);
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getrateFactor()
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('rate_factor');
		$this->db->where('id', '1');
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getTaxRate()
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('tax');
		//$this->db->where('id', '1');
		$query  = $this->db->get();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function validatepostcode_by_tozip($postal_code)
	{
		$this->db->select('ba.*');
		$this->db->from('branch_area ba');
		$this->db->join('postal_codes_data_master pcdm', 'ba.area_id = pcdm.id');
		$this->db->where('pcdm.postal_code', $postal_code);
		$query  =   $this->db->get();

		//$row = $query->num_rows();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function email_id_check($email_id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			if ($result->status == 1) {
				return $result;
			} else {
				return 'user_inactive';
			}
		} else {
			return 'doesnt_exists';
		}
	}

	public function checkEmailAvailablity_byID($email, $user_id)
	{
		$array = array('email' => $email);
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($array);
		$this->db->where_not_in('user_id', $user_id);
		$query  =   $this->db->get();

		$row = $query->num_rows();
		if ($row > 0) {
			return $row;
		} else {
			return $row;
		}
	}

	public function checkPhoneAvailablity_byID($telephone, $user_id)
	{
		$array = array('telephone' => $telephone);
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($array);
		$this->db->where_not_in('user_id', $user_id);
		$query  =   $this->db->get();

		$row = $query->num_rows();
		if ($row > 0) {
			return $row;
		} else {
			return $row;
		}
	}

	public function edit_profile($user_id, $data)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		$result = $query->row();
		if (!empty($result)) {
			if ($result->status == 1) {
				$this->db->where('user_id', $user_id);
				if ($this->db->update('users', $data)) {
					//return 'ok';
					$this->db->select('u.*, cm.name as country_name, stm.name as state_name, ctm.name as city_name');
					$this->db->from('users u');
					$this->db->join('countries_master cm', 'u.country = cm.id', 'left');
					$this->db->join('states_master stm', 'u.state = stm.id', 'left');
					$this->db->join('cities_master ctm', 'u.city = ctm.id', 'left');
					$this->db->where('u.user_id', $user_id);
					$query = $this->db->get();
					return $query->row();
				} else {
					return 'cannot_update';
				}
			} else {
				return 'user_inactive';
			}
		} else {
			return 'user_not_found';
		}
	}

	public function validate_user_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		$result = $query->row();
		if (!empty($result)) {
			if ($result->status == 1) {
				return 'ok';
			} else {
				return 'user_inactive';
			}
		} else {
			return 'user_not_found';
		}
	}

	public function update_profile_picture($user_id, $image_name)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		$user_details = $query->row();
		if (isset($user_details->profile_image) && $user_details->profile_image != '') {
			$user_old_dp = 'uploads/profile_img/' . $user_details->profile_image;
			unlink($user_old_dp);
		}

		$data['profile_image'] = $image_name;
		$this->db->where('user_id', $user_id);
		if ($this->db->update('users', $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function user_change_password($user_id, $old_password, $new_password)
	{
		$user_details = $this->validate_user_id($user_id);
		if ($user_details == 'user_not_found') {
			return 'user_not_found';
		} elseif ($user_details == 'user_inactive') {
			return 'user_inactive';
		} else {
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where(array('user_id' => $user_id, 'password' => md5($old_password)));
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				$data['password'] = md5($new_password);
				//$data['txt_password'] = $new_password;
				$this->db->where('user_id', $user_id);
				if ($this->db->update('users', $data)) {
					return 'ok';
				} else {
					return 'cannot_update';
				}
			} else {
				return 'old_password_incorrect';
			}
		}
	}


	public function common($table_name = '', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '', $where_in_array = array())
	{
		if (trim($table_name)) {
			if (count($field) > 0) {
				$field = implode(',', $field);
			} else {
				$field = '*';
			}

			$this->db->select($field);
			$this->db->from($table_name);

			if (count($where) > 0) {
				foreach ($where as $key => $val) {
					if (trim($val)) {
						$this->db->where($key, $val);
					}
				}
			}


			if (count($where_or) > 0) {
				foreach ($where_or as $key => $val) {
					if (trim($val)) {
						$this->db->or_where($key, $val);
					}
				}
			}

			if (count($order) > 0) {
				foreach ($order as $key => $val) {
					if (trim($val)) {
						$this->db->order_by($key, $val);
					}
				}
			}

			if (count($like) > 0) {
				foreach ($like as $key => $val) {
					if (trim($val)) {
						$this->db->like($key, $val);
					}
				}
			}


			if ($end) {
				$this->db->limit($end, $start);
			}

			if (count($where_in_array) > 0) {
				$this->db->where_in('user_id', $where_in_array);
			}

			$query = $this->db->get();
			$resultResponse = $query->result();
			return $resultResponse;
		} else {
			echo 'Table name should not be empty';
			exit;
		}
	}

	public function getcategories()
	{
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('status', '1');
		$query = $this->db->get();
		$result = $query->result_array();
		foreach ($result as $key => $results) {
			$catid = $results['parent_id'];
			if ($catid > 0) {
				$this->db->select('*');
				$this->db->from('category');
				$this->db->where('cat_id', $catid);
				$res = $this->db->get();
				$re = $res->row();
				$parentcatname = $re->name;
			} else {
				$parentcatname = $results["name"];
			}
			$result[$key]['parentcatname'] = $parentcatname;
			$result[$key]['categoryimgstat'] = $this->config->item('base_url') . "uploads/" . $results['category_image'];
		}

		if (!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}
	}

	public function getproducts()
	{
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('status', '1');
		$query = $this->db->get();
		$result = $query->result_array();
		foreach ($result as $key => $results) {
			$productid = $results['product_id'];
			if ($productid > 0) {
				$this->db->select('pc.category_id, c.name as cat_name, c.description as cat_description');
				$this->db->from('product_category pc');
				$this->db->join('category c', 'pc.category_id = c.cat_id');
				$this->db->where('pc.product_id', $productid);
				$res = $this->db->get();
				$re = $res->result_array();
				$parentcatid = $re;
			} else {
				$parentcatid = '';
			}
			if ($results['brand_id'] > 0) {
				$this->db->select('b.brand_id, b.name as brand_name, b.description as brand_description');
				$this->db->from('brand b');
				//$this->db->join('category c', 'b.category_id = c.cat_id');
				$this->db->where('b.brand_id', $results['brand_id']);
				$res_brand = $this->db->get();
				$re_brand = $res_brand->result_array();

				$brandDetails = $re_brand;
			} else {
				$brandDetails = '';
			}

			$this->db->select('*');
			$this->db->from('product_gallery_image');
			$this->db->where('product_id', $productid);
			$query = $this->db->get();
			$result_gallery = $query->result_array();

			$arrGalleryImages = array();
			if (!empty($result_gallery)) {
				foreach ($result_gallery as $k => $res) {
					array_push($arrGalleryImages, $this->config->item('base_url') . "uploads/product/" . $res['product_image']);
				}
			}

			if ($results['product_type'] == 'variable') {
				$this->db->select('pv.*, pa.name');
				$this->db->from('product_variable_attribute pv');
				$this->db->join('product_attribute pa', 'pv.variation_id = pa.product_attribute_id');
				$this->db->where('pv.product_id', $productid);
				$res_attribute = $this->db->get();
				$re_attribute = $res_attribute->result_array();

				$attributeDetails = $re_attribute;
			} else {
				$attributeDetails = '';
			}


			$result[$key]['brand_details'] = $brandDetails;
			$result[$key]['cat_details'] = $parentcatid;
			$result[$key]['productcatimg'] = $this->config->item('base_url') . "uploads/product/" . $results['product_image'];
			$result[$key]['gallery_images'] = $arrGalleryImages;
			$result[$key]['product_attribute'] = $attributeDetails;
		}

		if (!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}
	}

	public function getproducts_by_keyword($keyword)
	{
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('status', '1');
		if ($keyword != 'all') {
			$this->db->where("product_title LIKE '$keyword%'");
		}
		$query = $this->db->get();
		$result = $query->result_array();
		foreach ($result as $key => $results) {
			$productid = $results['product_id'];
			if ($productid > 0) {
				$this->db->select('pc.category_id, c.name as cat_name, c.description as cat_description');
				$this->db->from('product_category pc');
				$this->db->join('category c', 'pc.category_id = c.cat_id');
				$this->db->where('pc.product_id', $productid);
				$res = $this->db->get();
				$re = $res->result_array();
				$parentcatid = $re;
			} else {
				$parentcatid = array();
			}
			if ($results['brand_id'] > 0) {
				$this->db->select('b.brand_id, b.name as brand_name, b.description as brand_description');
				$this->db->from('brand b');
				//$this->db->join('category c', 'b.category_id = c.cat_id');
				$this->db->where('b.brand_id', $results['brand_id']);
				$res_brand = $this->db->get();
				$re_brand = $res_brand->result_array();

				$brandDetails = $re_brand;
			} else {
				$brandDetails = array();
			}

			$this->db->select('*');
			$this->db->from('product_gallery_image');
			$this->db->where('product_id', $productid);
			$query = $this->db->get();
			$result_gallery = $query->result_array();

			$arrGalleryImages = array();
			if (!empty($result_gallery)) {
				foreach ($result_gallery as $k => $res) {
					array_push($arrGalleryImages, $this->config->item('base_url') . "uploads/product/" . $res['product_image']);
				}
			}

			if ($results['product_type'] == 'variable') {
				$this->db->select('pv.*, pa.name');
				$this->db->from('product_variable_attribute pv');
				$this->db->join('product_attribute pa', 'pv.variation_id = pa.product_attribute_id');
				$this->db->where('pv.product_id', $productid);
				$res_attribute = $this->db->get();
				$re_attribute = $res_attribute->result_array();

				$attributeDetails = $re_attribute;
			} else {
				$attributeDetails = array();
			}


			$result[$key]['brand_details'] = $brandDetails;
			$result[$key]['cat_details'] = $parentcatid;
			$result[$key]['productcatimg'] = $this->config->item('base_url') . "uploads/product/" . $results['product_image'];
			$result[$key]['gallery_images'] = $arrGalleryImages;
			$result[$key]['product_attribute'] = $attributeDetails;
		}

		if (!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}
	}

	public function search_productlist_by_keyword($keyword)
	{
		$this->db->select('*');
		$this->db->from('product');
		$this->db->like('product_title', $keyword);
		$this->db->or_like('product_description', $keyword);
		$this->db->where('status', '1');
		$query = $this->db->get();
		$result = $query->result_array();
		foreach ($result as $key => $results) {
			$productid = $results['product_id'];
			if ($productid > 0) {
				$this->db->select('pc.category_id, c.name as cat_name, c.description as cat_description');
				$this->db->from('product_category pc');
				$this->db->join('category c', 'pc.category_id = c.cat_id');
				$this->db->where('pc.product_id', $productid);
				$res = $this->db->get();
				$re = $res->result_array();
				$parentcatid = $re;
			} else {
				$parentcatid = array();
			}
			if ($results['brand_id'] > 0) {
				$this->db->select('b.brand_id, b.name as brand_name, b.description as brand_description');
				$this->db->from('brand b');
				//$this->db->join('category c', 'b.category_id = c.cat_id');
				$this->db->where('b.brand_id', $results['brand_id']);
				$res_brand = $this->db->get();
				$re_brand = $res_brand->result_array();

				$brandDetails = $re_brand;
			} else {
				$brandDetails = array();
			}

			$this->db->select('*');
			$this->db->from('product_gallery_image');
			$this->db->where('product_id', $productid);
			$query = $this->db->get();
			$result_gallery = $query->result_array();

			$arrGalleryImages = array();
			if (!empty($result_gallery)) {
				foreach ($result_gallery as $k => $res) {
					array_push($arrGalleryImages, $this->config->item('base_url') . "uploads/product/" . $res['product_image']);
				}
			}

			if ($results['product_type'] == 'variable') {
				$this->db->select('pv.*, pa.name');
				$this->db->from('product_variable_attribute pv');
				$this->db->join('product_attribute pa', 'pv.variation_id = pa.product_attribute_id');
				$this->db->where('pv.product_id', $productid);
				$res_attribute = $this->db->get();
				$re_attribute = $res_attribute->result_array();

				$attributeDetails = $re_attribute;
			} else {
				$attributeDetails = array();
			}


			$result[$key]['brand_details'] = $brandDetails;
			$result[$key]['cat_details'] = $parentcatid;
			$result[$key]['productcatimg'] = $this->config->item('base_url') . "uploads/product/" . $results['product_image'];
			$result[$key]['gallery_images'] = $arrGalleryImages;
			$result[$key]['product_attribute'] = $attributeDetails;
		}

		if (!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}
	}

	public function getproducts_by_cat($catId)
	{

		$this->db->select('pc.category_id, pc.product_id, c.name as cat_name, p.*');
		$this->db->from('product_category pc');
		$this->db->join('category c', 'pc.category_id = c.cat_id');
		$this->db->join('product p', 'pc.product_id = p.product_id');
		$this->db->where('pc.category_id', $catId);
		$query = $this->db->get();
		$result = $query->result_array();

		foreach ($result as $key => $results) {
			$productid = $results['product_id'];
			if ($productid > 0) {
				$this->db->select('*');
				$this->db->from('product');
				//$this->db->join('category c', 'pc.category_id = c.cat_id');
				$this->db->where('product_id', $productid);
				$res = $this->db->get();
				$re = $res->row();
				$productDetails = $re;
			} else {
				$productDetails = array();
			}
			if ($productDetails->brand_id > 0) {
				$this->db->select('b.brand_id, b.name as brand_name, b.description as brand_description');
				$this->db->from('brand b');
				$this->db->where('b.brand_id', $productDetails->brand_id);
				$res_brand = $this->db->get();
				$re_brand = $res_brand->row();

				$brandDetails = $re_brand;
			} else {
				$brandDetails = array();
			}

			$this->db->select('*');
			$this->db->from('product_gallery_image');
			$this->db->where('product_id', $productid);
			$query = $this->db->get();
			$result_gallery = $query->result_array();

			$arrGalleryImages = array();
			if (!empty($result_gallery)) {
				foreach ($result_gallery as $k => $res) {
					array_push($arrGalleryImages, $this->config->item('base_url') . "uploads/product/" . $res['product_image']);
				}
			}

			if ($productDetails->product_type == 'variable') {
				$this->db->select('pv.*, pa.name');
				$this->db->from('product_variable_attribute pv');
				$this->db->join('product_attribute pa', 'pv.variation_id = pa.product_attribute_id');
				$this->db->where('pv.product_id', $productid);
				$res_attribute = $this->db->get();
				$re_attribute = $res_attribute->result_array();

				$attributeDetails = $re_attribute;
			} else {
				$attributeDetails = array();
			}

			$result[$key]['brand_details'] = $brandDetails;
			//$result[$key]['productDetails'] = $productDetails;
			$result[$key]['productcatimg'] = $this->config->item('base_url') . "uploads/product/" . $productDetails->product_image;
			$result[$key]['gallery_images'] = $arrGalleryImages;
			$result[$key]['product_attribute'] = $attributeDetails;
		}


		if (!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}
	}

	public function getproducts_details_by_id($product_id)
	{

		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get();
		$result = $query->result_array();
		foreach ($result as $key => $results) {
			$productid = $results['product_id'];
			if ($productid > 0) {
				$this->db->select('pc.category_id, c.name as cat_name, c.description as cat_description');
				$this->db->from('product_category pc');
				$this->db->join('category c', 'pc.category_id = c.cat_id');
				$this->db->where('pc.product_id', $productid);
				$res = $this->db->get();
				$re = $res->result_array();
				$parentcatid = $re;
			} else {
				$parentcatid = '';
			}
			if ($results['brand_id'] > 0) {
				$this->db->select('b.brand_id, b.name as brand_name, b.description as brand_description');
				$this->db->from('brand b');
				//$this->db->join('category c', 'b.category_id = c.cat_id');
				$this->db->where('b.brand_id', $results['brand_id']);
				$res_brand = $this->db->get();
				$re_brand = $res_brand->result_array();

				$brandDetails = $re_brand;
			} else {
				$brandDetails = '';
			}

			$this->db->select('*');
			$this->db->from('product_gallery_image');
			$this->db->where('product_id', $productid);
			$query = $this->db->get();
			$result_gallery = $query->result_array();

			$arrGalleryImages = array();
			if (!empty($result_gallery)) {
				foreach ($result_gallery as $k => $res) {
					array_push($arrGalleryImages, $this->config->item('base_url') . "uploads/product/" . $res['product_image']);
				}
			}
			$attributeDetails = array();
			if ($results['product_type'] == 'variable') {
				$this->db->select('pv.*, pa.name');
				$this->db->from('product_variable_attribute pv');
				$this->db->join('product_attribute pa', 'pv.variation_id = pa.product_attribute_id');
				$this->db->where('pv.product_id', $productid);
				$res_attribute = $this->db->get();
				$re_attribute = $res_attribute->result_array();

				$attributeDetails = $re_attribute;
			}


			$result[$key]['brand_details'] = $brandDetails;
			$result[$key]['cat_details'] = $parentcatid;
			$result[$key]['productcatimg'] = $this->config->item('base_url') . "uploads/product/" . $results['product_image'];
			$result[$key]['gallery_images'] = $arrGalleryImages;
			$result[$key]['product_attribute'] = $attributeDetails;
		}

		if (!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}
	}

	public function update_cart_info($row_id, $quantity)
	{
		$this->db->select('*');
		$this->db->from('users_cart');
		$this->db->where('row_id', $row_id);
		$query = $this->db->get();
		$result = $query->row();
		if (!empty($result)) {
			if (!empty($quantity))
				$data['qty'] = $quantity;
			$this->db->where('row_id', $row_id);
			if ($this->db->update('users_cart', $data)) {
				return 'ok';
			} else {
				return 'cannot_update';
			}
		} else {
			return 'record_not_found';
		}
	}

	public function remove_cart_info_by_row($row_id)
	{
		$this->db->select('*');
		$this->db->from('users_cart');
		$this->db->where('row_id', $row_id);
		$query = $this->db->get();
		$result = $query->row();
		if (!empty($result)) {
			$this->db->where('row_id', $row_id);
			if ($this->db->delete('users_cart')) {
				return 'ok';
			} else {
				return 'cannot_update';
			}
		} else {
			return 'record_not_found';
		}
	}

	public function getcartdata_by_userid($user_id)
	{
		$this->db->select('uc.*,p.product_image');
		$this->db->from('users_cart uc');
		$this->db->join('product p', 'uc.product_id = p.product_id');
		$this->db->where('uc.user_id', $user_id);
		$query = $this->db->get();
		//$result = $query->result_array();
		$result = $query->result();

		if (!empty($result)) {
			foreach ($result as $key => $res) {
				$result[$key]->product_image = base_url() . 'uploads/product/' . $res->product_image;
			}
		}
		if (!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}
	}

	public function remove_wishlist($user_id, $product_id)
	{
		$this->db->select('*');
		$this->db->from('wishlist');
		$this->db->where('user_id', $user_id);
		$this->db->where('product_id', $product_id);
		$query = $this->db->get();
		$result = $query->row();
		if (!empty($result)) {
			$this->db->where('user_id', $user_id);
			$this->db->where('product_id', $product_id);
			if ($this->db->delete('wishlist')) {
				return 'ok';
			} else {
				return 'cannot_update';
			}
		} else {
			return 'record_not_found';
		}
	}

	public function get_wishlist_products_by_uid($user_id)
	{

		$this->db->select('w.product_id');
		$this->db->from('wishlist w');
		//$this->db->join('category c', 'pc.category_id = c.cat_id');
		$this->db->where('w.user_id', $user_id);
		$query = $this->db->get();
		$result = $query->result_array();

		foreach ($result as $key => $results) {
			$productid = $results['product_id'];
			if ($productid > 0) {
				$this->db->select('*');
				$this->db->from('product');
				//$this->db->join('category c', 'pc.category_id = c.cat_id');
				$this->db->where('product_id', $productid);
				$res = $this->db->get();
				$re = $res->row();
				$productDetails = $re;
			} else {
				$productDetails = '';
			}
			if ($productDetails->brand_id > 0) {
				$this->db->select('b.brand_id, b.name as brand_name, b.description as brand_description');
				$this->db->from('brand b');
				$this->db->where('b.brand_id', $productDetails->brand_id);
				$res_brand = $this->db->get();
				$re_brand = $res_brand->row();

				$brandDetails = $re_brand;
			} else {
				$brandDetails = '';
			}

			$this->db->select('*');
			$this->db->from('product_gallery_image');
			$this->db->where('product_id', $productid);
			$query = $this->db->get();
			$result_gallery = $query->result_array();

			$arrGalleryImages = array();
			if (!empty($result_gallery)) {
				foreach ($result_gallery as $k => $res) {
					array_push($arrGalleryImages, $this->config->item('base_url') . "uploads/product/" . $res['product_image']);
				}
			}

			$attributeDetails = array();
			if ($productDetails->product_type == 'variable') {
				$this->db->select('pv.*, pa.name');
				$this->db->from('product_variable_attribute pv');
				$this->db->join('product_attribute pa', 'pv.variation_id = pa.product_attribute_id');
				$this->db->where('pv.product_id', $productid);
				$res_attribute = $this->db->get();
				$re_attribute = $res_attribute->result_array();

				$attributeDetails = $re_attribute;
			}

			$result[$key]['brand_details'] = $brandDetails;
			$result[$key]['productDetails'] = $productDetails;
			$result[$key]['productcatimg'] = $this->config->item('base_url') . "uploads/product/" . $productDetails->product_image;
			$result[$key]['gallery_images'] = $arrGalleryImages;
			$result[$key]['product_attribute'] = $attributeDetails;
		}


		if (!empty($result)) {
			return $result;
		} else {
			return 'no data found';
		}
	}

	public function getaddress_by_userid($user_id)
	{
		$this->db->select('*');
		$this->db->from('user_billing_address');
		$this->db->where('user_id', $user_id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		$result = $query->result();
		if (!empty($result)) {
			return $result;
		} else {
			return 'record_not_found';
		}
	}

	public function deleteAddress($addressId, $userId)
	{
		$returnedRows    = 0;
		$this->db->where('id', $addressId);
		$this->db->where('user_id', $userId);



		if ($this->db->delete("user_billing_address")) {
			$returnedRows     =    $this->db->affected_rows();
		}
		return $returnedRows;
	}


	/************************ PD Boy API List ****************************/
	public function getpickupOrderListUser($user_id, $todayDate)
	{
		$this->db->select('pbot.*, sm.shipment_no,`sm`.`created_date` AS shipment_date, sfa.firstname as from_firstname, sfa.lastname as from_lastname, sfa.address as from_address, sfa.address2 from_address2, sfa.telephone from_telephone, cm.name as country_name, stm.name as state_name, ctm.name as city_name, sfa.zip from_zip, sfa.latitude, sfa.longitude');
		$this->db->from('pd_boy_order_tagging pbot');
		$this->db->join('shipment_master sm', 'pbot.shipment_id = sm.id', 'left');
		$this->db->join('shipment_from_address sfa', 'pbot.shipment_id = sfa.shipment_id', 'left');

		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'sfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');

		$this->db->where('pbot.user_id', $user_id);
		$this->db->where('pbot.order_type', '1');

		$this->db->where('pbot.status', '0');
		$this->db->where('sm.status', 1);
		$this->db->where('sm.created_date <=', $todayDate);
		$this->db->group_by('sm.shipment_no');
		$this->db->order_by("sm.id", "DESC");
		$query  =   $this->db->get();
		$row = $query->num_rows();
		if ($row > 0) {
			$row = $query->result();
			/*if(!empty($row)) {
				foreach($row as $key => $res) {
					$row[$key]->latlong = getLatLongbyAddress($res->from_address.','.$res->city_name.','.$res->state_name.','.$res->country_name);
				}
			}*/
			return $row;
		} else {
			return 'not_found';
		}
	}

	public function getPickupRules($id)
	{
		$this->db->select('bpdr.*');
		$this->db->from('branch_pickup_delivery_rules bpdr');
		$this->db->where('bpdr.branch_id', $id);
		$query  =   $this->db->get();
		$row = $query->num_rows();
		if ($row > 0) {
			$row = $query->row();
			return $row;
		} else {
			return $row;
		}
	}

	public function getuserDeliveryOrderList($user_id, $todayDate)
	{
		$this->db->select('pbot.*, sm.shipment_no, sm.payment_mode, sm.customer_id, `sm`.`created_date` AS shipment_date, sfa.firstname as from_firstname, sfa.lastname as from_lastname, sfa.address as from_address, sfa.address2 from_address2, sfa.telephone from_telephone, cm.name as country_name, stm.name as state_name, ctm.name as city_name, sfa.zip from_zip, u.firstname, u.email, u.telephone, sfa.latitude, sfa.longitude');
		$this->db->from('pd_boy_order_tagging pbot');
		$this->db->join('shipment_master sm', 'pbot.shipment_id = sm.id', 'left');
		$this->db->join('shipment_to_address sfa', 'pbot.shipment_id = sfa.shipment_id', 'left');
		$this->db->join('users u', 'sm.customer_id = u.user_id', 'left');
		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'sfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');
		$this->db->where('pbot.user_id', $user_id);
		$this->db->where('pbot.order_type', '2');

		$this->db->where('pbot.status', '0');
		$this->db->where('sm.status', 1);
		$this->db->where('pbot.created_date <=', $todayDate);
		$this->db->group_by('sm.shipment_no');
		$this->db->order_by("sm.id", "DESC");
		$query  =   $this->db->get();
		//echo $this->db->last_query(); die;
		$row = $query->num_rows();
		if ($row > 0) {
			$row = $query->result();
			/*if(!empty($row)) {
				foreach($row as $key => $res) {
					$row[$key]->latlong = getLatLongbyAddress($res->from_address.','.$res->city_name.','.$res->state_name.','.$res->country_name);
				}
			}*/
			return $row;
		} else {
			return 'not_found';
		}
	}

	public function orderStatusDetails($shipment_id)
	{
		$this->db->select('shs.*, sm.status_name');
		$this->db->from('shipment_status shs');
		$this->db->join('status_master sm', 'shs.status_id = sm.id', 'left');
		$this->db->where('shs.shipment_id', $shipment_id);
		$this->db->order_by("shs.id", "asc");
		$query  =   $this->db->get();
		$row = $query->num_rows();
		if ($row > 0) {
			$row = $query->result();
			return $row;
		} else {
			return 'not_found';
		}
	}

	public function orderPriceDetails($shipment_id)
	{
		$this->db->select('spd.*');
		$this->db->from('shipment_price_details spd');
		//$this->db->join('status_master sm', 'shs.status_id = sm.id', 'left');
		$this->db->where('spd.shipment_id', $shipment_id);
		//$this->db->order_by("shs.id", "asc");
		$query  =   $this->db->get();
		$row = $query->num_rows();
		if ($row > 0) {
			//$row = $query->result();
			$result = $query->result_array();
			foreach ($result as $key => $results) {
				$array_out[] =
					array(
						"id" => $results['id'],
						"shipment_id" => $results['shipment_id'],
						"subtotal" => $results['subtotal'],
						"discount" => $results['discount'],
						"ga_percentage" => $results['ga_percentage'],
						"ga_tax_amt" => $results['ga_tax_amt'],
						"ra_percentage" => $results['ra_percentage'],
						"ra_tax_amt" => $results['ra_tax_amt'],
						"additional_charge_gross" => $results['additional_charge_gross'],
						"grand_total" => $results['grand_total'] - ($results['ga_tax_amt'] + $results['ra_tax_amt']),
						"grand_total_with_tax" => number_format((float)$results['grand_total'], 2, '.', ''),
					);
			}
			//return $row;   
			return $array_out;
		} else {
			return 'not_found';
		}
	}

	public function getuserPickupOrderHistoryList($user_id)
	{
		$this->db->select('pbot.id, pbot.shipment_id, pbot.user_id, pbot.order_type, pbot.status, pbot.created_date AS created_date_tagging, sm.shipment_no,`sm`.`created_date` AS shipment_date, sfa.firstname as from_firstname, sfa.lastname as from_lastname, sfa.address as from_address, sfa.address2 from_address2, sfa.telephone from_telephone, cm.name as country_name, stm.name as state_name, ctm.name as city_name, sfa.zip from_zip,shipment_status.`created_date` AS created_date');
		$this->db->from('pd_boy_order_tagging pbot');
		$this->db->join('shipment_master sm', 'pbot.shipment_id = sm.id', 'left');
		$this->db->join('shipment_from_address sfa', 'pbot.shipment_id = sfa.shipment_id', 'left');

		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'sfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');
		$this->db->join('shipment_status', 'sm.id = shipment_status.shipment_id', 'left');

		$this->db->where('pbot.user_id', $user_id);
		$this->db->where('pbot.order_type', '1');

		$this->db->where('pbot.status', '1');
		$this->db->where('sm.created_date <', date('Y-m-d'));
		$this->db->where('shipment_status.status_id', '2');
		$this->db->group_by("sm.id");
		$this->db->order_by("sm.id", "DESC");
		$query  =   $this->db->get();

		// echo $this->db->last_query();die();
		$row = $query->num_rows();
		if ($row > 0) {
			$row = $query->result();
			return $row;
		} else {
			return 'not_found';
		}
	}

	public function getuserDeliveryOrderHistoryList($user_id)
	{
		$this->db->select('pbot.*, sm.shipment_no,`sm`.`created_date` AS shipment_date, sfa.firstname as from_firstname, sfa.lastname as from_lastname, sfa.address as from_address, sfa.address2 from_address2, sfa.telephone from_telephone, cm.name as country_name, stm.name as state_name, ctm.name as city_name, sfa.zip from_zip');
		$this->db->from('pd_boy_order_tagging pbot');
		$this->db->join('shipment_master sm', 'pbot.shipment_id = sm.id', 'left');
		$this->db->join('shipment_to_address sfa', 'pbot.shipment_id = sfa.shipment_id', 'left');

		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'sfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');
		$this->db->where('pbot.user_id', $user_id);
		$this->db->where('pbot.order_type', '2');


		$this->db->where('pbot.status', '1');
		//$this->db->where('pbot.created_date <',date('Y-m-d'));
		$this->db->order_by("sm.id", "DESC");
		$query  =   $this->db->get();
		$row = $query->num_rows();
		if ($row > 0) {
			$row = $query->result();
			return $row;
		} else {
			return 'not_found';
		}
	}

	public function shipmentRate($ship_cat_id, $ship_subcat_id, $ship_sub_subcat_id, $rate_type, $location_from, $location_to, $charges_mode, $delivery_mode_id)
	{
		$data = array();
		$this->db->select('ship_mode_id, rate, insurance');
		$this->db->where('ship_cat_id', $ship_cat_id);
		$this->db->where('ship_subcat_id', $ship_subcat_id);
		$this->db->where('ship_sub_subcat_id', $ship_sub_subcat_id);
		$this->db->where('rate_type', $rate_type);
		$this->db->where('location_from', $location_from);
		$this->db->where('location_to', $location_to);
		$this->db->where('ship_mode_id', $charges_mode);
		$this->db->where('delivery_mode_id', $delivery_mode_id);
		$this->db->from('rate_master');
		$query  = $this->db->get();
		//echo $this->db->last_query();die();
		$result = $query->result_array();
		return $result;
	}

	public function getshipmentFromLocation($shipment_id)
	{
		$data = array();
		$this->db->select('state');
		$this->db->from('shipment_from_address');
		$this->db->where('shipment_id', $shipment_id);
		$query  = $this->db->get();
		$result = $query->result_array();
		// echo $query = $this->db->last_query();die();
		return $result;
	}

	public function getshipmentToLocation($shipment_id)
	{
		$data = array();
		$this->db->select('state');
		$this->db->from('shipment_to_address');
		$this->db->where('shipment_id', $shipment_id);
		$query  = $this->db->get();
		$result = $query->result_array();
		// echo $query = $this->db->last_query();die();
		return $result;
	}

	public function getshipmentModeSpeed($shipment_id)
	{
		$data = array();
		$this->db->select('shipment_type, delivery_mode_id');
		$this->db->from('shipment_master');
		$this->db->where('id', $shipment_id);
		$query  = $this->db->get();
		$result = $query->result_array();
		// echo $query = $this->db->last_query();die();
		return $result;
	}

	public function getallOrderListUser($user_id, $todayDate)
	{
		$this->db->select('pbot.*, sm.shipment_no,`sm`.`created_date` AS shipment_date, sfa.firstname as from_firstname, sfa.lastname as from_lastname, sfa.address as from_address, sfa.address2 from_address2, sfa.telephone from_telephone, cm.name as country_name, stm.name as state_name, ctm.name as city_name, sfa.zip from_zip, sfa.latitude, sfa.longitude');
		$this->db->from('pd_boy_order_tagging pbot');
		$this->db->join('shipment_master sm', 'pbot.shipment_id = sm.id');
		$this->db->join('shipment_from_address sfa', 'pbot.shipment_id = sfa.shipment_id');

		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'sfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');

		$this->db->where('pbot.user_id', $user_id);
		//$this->db->where('pbot.order_type', '1');

		$this->db->where('pbot.status', '0');
		$this->db->where('sm.status', 1);
		$this->db->where('sm.created_date <=', $todayDate);
		$this->db->where('sfa.latitude is NOT NULL', NULL, FALSE);
		$this->db->where('sfa.latitude != ""', NULL, FALSE);
		$this->db->where('sfa.longitude is NOT NULL', NULL, FALSE);
		$this->db->where('sfa.longitude != ""', NULL, FALSE);
		$this->db->group_by('sm.shipment_no');
		$this->db->order_by("sm.id", "DESC");
		$query  =   $this->db->get();
		$row = $query->num_rows();
		if ($row > 0) {
			$row = $query->result();
			/*if(!empty($row)) {
				foreach($row as $key => $res) {
					$row[$key]->latlong = getLatLongbyAddress($res->from_address.','.$res->city_name.','.$res->state_name.','.$res->country_name);
				}
			}*/
			return $row;
		} else {
			return 'not_found';
		}
	}

	public function getallOrderLatLongListUser($user_id, $todayDate)
	{
		$this->db->select('sm.shipment_no, sfa.address as from_address, sfa.address2 from_address2, cm.name as country_name, stm.name as state_name, ctm.name as city_name, sfa.zip from_zip, sfa.latitude, sfa.longitude');
		$this->db->from('pd_boy_order_tagging pbot');
		$this->db->join('shipment_master sm', 'pbot.shipment_id = sm.id');
		$this->db->join('shipment_from_address sfa', 'pbot.shipment_id = sfa.shipment_id');

		$this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
		$this->db->join('states_master stm', 'sfa.state = stm.id', 'left');
		$this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');

		$this->db->where('pbot.user_id', $user_id);
		//$this->db->where('pbot.order_type', '1');

		$this->db->where('pbot.status', '0');
		$this->db->where('sm.created_date <=', $todayDate);
		$query  =   $this->db->get();
		$row = $query->num_rows();
		if ($row > 0) {
			$row = $query->result();
			/*if(!empty($row)) {
				foreach($row as $key => $res) {
					$row[$key]->latlong = getLatLongbyAddress($res->from_address.','.$res->city_name.','.$res->state_name.','.$res->country_name);
				}
			}*/
			return $row;
		} else {
			return 'not_found';
		}
	}

	public function assignQuotationRequest($quotation_id, $zip, $zip_to, $user_id)
	{
		if ($quotation_id != null && $zip != null && $zip_to != null) {
			//get from branch_id by pincode
			if (!empty($zip)) {
				$this->db->select('`branch_area`.`branch_id` AS fbranch_id');
				$this->db->join('`branch_area`', '`postal_codes_data_master`.`id` = `branch_area`.`area_id`', 'INNER');
				$this->db->where('postal_code', $zip);
				$query_fb = $this->db->get('postal_codes_data_master');
				// echo $this->db->last_query();
				if ($query_fb) {
					$from_branchid = $query_fb->row_array();
				} else {
					$from_branchid = false;
				}
			} else {
				$from_branchid = false;
			}

			//get to branch_id by pincode
			if (!empty($zip_to)) {
				$this->db->select('`branch_area`.`branch_id` AS tbranch_id');
				$this->db->join('`branch_area`', '`postal_codes_data_master`.`id` = `branch_area`.`area_id`', 'INNER');
				$this->db->where('postal_code', $zip_to);
				$query_tb = $this->db->get('postal_codes_data_master');
				// echo $this->db->last_query();
				if ($query_tb) {
					$to_branchid = $query_tb->row_array();
				} else {
					$to_branchid = false;
				}
			} else {
				$to_branchid = false;
			}
			//echo  $quotation_id.'++++++'.$from_branchid['fbranch_id'].'<<<===>>>'.$to_branchid['tbranch_id']; die;
			if ($from_branchid == false || $to_branchid == false) {
				return false;
			} else {
				//Order tagging to branch
				$branchData = array(
					'quotation_id' => $quotation_id,
					'from_branch_id' => ($from_branchid['fbranch_id'] != '') ? $from_branchid['fbranch_id'] : 0,
					'to_branch_id' => ($to_branchid['tbranch_id'] != '') ? $to_branchid['tbranch_id'] : 0,
					'created_by' => $user_id,
					'created_date' => date('Y-m-d H:i:s')
				);

				$this->db->insert('quotation_req_branch_tagging', $branchData);
				$branch_insert_id = $this->db->insert_id();
				//echo $zip.'<<<===>>>'.$from_branchid; die;
				// Start assign order to P/D boy by area
				if (!empty($zip) && !empty($from_branchid)) {
					$this->db->select('pdba.*');
					$this->db->from('pickup_delivery_boy_area pdba');
					$this->db->join('branch_users bu', 'pdba.user_id = bu.user_id');
					$this->db->join('postal_codes_data_master pcdm', 'pdba.area_id = pcdm.id');
					$this->db->where('bu.branch_id', $from_branchid['fbranch_id']);
					$this->db->where('pcdm.postal_code', $zip);
					$query  =   $this->db->get();
					//echo $this->db->last_query();die();
					$row = $query->num_rows();
					if ($row > 0) {
						$pdBoyList = $query->result();
						foreach ($pdBoyList as $val) {
							$pdBoyData = array(
								'quotation_id' => $quotation_id,
								'user_id' => $val->user_id,
								'order_type' => 1,
								'status' => 0,
								'created_date' => date('Y-m-d H:i:s')
							);
							$this->db->insert('pd_boy_quotation_req_tagging', $pdBoyData);
							$pdboy_insert_id = $this->db->insert_id();
						}

						return 'assinged';
					} else {
						return false;
					}
				} else {
					return false;
				}
				// End assign order to P/D boy by area
			}
		} else {
			return false;
		}
	}

	public function saveOrder($id = null, $shipment_no = null, $quote_id = null, $payment_mode = 1, $payment_status = 1, $priceData = null, $transaction_id = null)
	{
		if (!empty($transaction_id)) {
			$transaction_id = $transaction_id;
		} else {
			$transaction_id = '0';
		}
		//snigdho
		if ($id != null && $quote_id != null && $shipment_no != null) {

			//get from address
			$this->db->select('zip');
			$this->db->where('quotation_id', $quote_id);
			$query_fz = $this->db->get('quotation_from_address');
			if ($query_fz) {
				$from_zip = $query_fz->row_array();
			} else {
				$from_zip = false;
			}

			//get to address
			$this->db->select('zip');
			$this->db->where('quotation_id', $quote_id);
			$query_tz = $this->db->get('quotation_to_address');
			if ($query_tz) {
				$to_zip = $query_tz->row_array();
			} else {
				$to_zip = false;
			}

			//get from branch_id by pincode
			if (!empty($from_zip)) {
				$this->db->select('`branch_area`.`branch_id` AS fbranch_id');
				$this->db->join('`branch_area`', '`postal_codes_data_master`.`id` = `branch_area`.`area_id`', 'INNER');
				$this->db->where('postal_code', $from_zip['zip']);
				$query_fb = $this->db->get('postal_codes_data_master');
				// echo $this->db->last_query();
				if ($query_fb) {
					$from_branchid = $query_fb->row_array();
				} else {
					$from_branchid = false;
				}
			} else {
				$from_branchid = false;
			}

			//get to branch_id by pincode
			if (!empty($to_zip)) {
				$this->db->select('`branch_area`.`branch_id` AS tbranch_id');
				$this->db->join('`branch_area`', '`postal_codes_data_master`.`id` = `branch_area`.`area_id`', 'INNER');
				$this->db->where('postal_code', $to_zip['zip']);
				$query_tb = $this->db->get('postal_codes_data_master');
				// echo $this->db->last_query();
				if ($query_tb) {
					$to_branchid = $query_tb->row_array();
				} else {
					$to_branchid = false;
				}
			} else {
				$to_branchid = false;
			}

			//echo $from_branchid['fbranch_id'] . ' <> ' . $to_branchid['tbranch_id'].'<br>';die;

			if ($from_branchid == false || $to_branchid == false) {
				return false;
			} else {
				//shipment master
				$sql_sm = 'INSERT INTO `shipment_master` (`shipment_no`, `quotation_id`, `parent_id`, `customer_id`, `shipment_type`, `location_type`, `transport_type`, `road`, `rail`, `air`, `ship`, `status`, `platform`, `created_by`, `created_date`, `payment_mode`, `payment_status`, `transaction_id`) SELECT  "' . $shipment_no . '", `id`, `parent_id`, `customer_id`, `shipment_type`, `location_type`, `transport_type`, `road`, `rail`, `air`, `ship`, `status`, `platform`, `created_by`, "' . DTIME . '", ' . $payment_mode . ', ' . $payment_status . ', ' . $transaction_id . ' FROM `quotation_master` WHERE id =' . $quote_id;
				//echo $sql_sm; die;
				$query_sm = $this->db->query($sql_sm);
				$shipment_id = $this->db->insert_id();

				//price_details
				if ($priceData != null) {
					$priceData['shipment_id'] = $shipment_id;
					// echo '<pre>';print_r($priceData);die;
					$this->db->insert('shipment_price_details', $priceData);
					$price_details_id = $this->db->insert_id();
				}


				//charges 
				// $sql_c = 'INSERT INTO `shipment_charges` (`shipment_id`,`shipment_item_details_id`, `road`, `rail`, `air`, `ship`) SELECT  "' . $shipment_id . '", `quotation_item_details_id`, `road`, `rail`, `air`, `ship` FROM `quotation_charges` WHERE quotation_id =' . $quote_id;

				// $query_c = $this->db->query($sql_c);
				// $charges_id = $this->db->insert_id();

				// from address
				$sql_from_add = 'INSERT INTO `shipment_from_address` (`shipment_id`, `quotation_id`, `customer_id`, `firstname`, `lastname`, `address`, `address2`, `company_name`, `country`, `state`, `city`, `zip`, `email`, `telephone`, `address_type`, `latitude`, `longitude`) SELECT ' . $shipment_id . ',  `quotation_id`, `customer_id`, `firstname`, `lastname`, `address`, `address2`, `company_name`, `country`, `state`, `city`, `zip`, `email`, `telephone`, `address_type`, `latitude`, `longitude` FROM `quotation_from_address` WHERE quotation_id =' . $quote_id;

				$query_from_add = $this->db->query($sql_from_add);
				$from_addr_insert_id = $this->db->insert_id();

				//to address
				$sql_to_add = 'INSERT INTO shipment_to_address (`shipment_id`, `quotation_id`, `customer_id`, `firstname`, `lastname`, `address`, `address2`, `company_name`, `country`, `state`, `city`, `zip`, `email`, `telephone`, `address_type`, `latitude`, `longitude`) SELECT ' . $shipment_id . ',  `quotation_id`, `customer_id`, `firstname`, `lastname`, `address`, `address2`, `company_name`, `country`, `state`, `city`, `zip`, `email`, `telephone`, `address_type`, `latitude`, `longitude` FROM `quotation_to_address` WHERE quotation_id =' . $quote_id;

				$query_to_add = $this->db->query($sql_to_add);
				$to_addr_insert_id = $this->db->insert_id();

				//items

				$this->db->select('*');
				$this->db->where('quotation_id', $quote_id);
				$query_quot_items   = $this->db->get('quotation_item_details');
				$rs_ship_items      = $query_quot_items->result_array();
				//print_r($rs_ship_items); //die;
				//charges

				$this->db->select('*');
				$this->db->where('quotation_id', $quote_id);
				$query_quot_charges = $this->db->get('quotation_charges');
				$rs_ship_charge     = $query_quot_charges->result_array();

				foreach ($rs_ship_items as $key => $value) {
					//print_r($value);
					$save_ship_iem = array(
						'shipment_id'           => $shipment_id,
						'quotation_id'          => $value['quotation_id'],
						'category_id'           => $value['category_id'],
						'subcategory_id'        => $value['subcategory_id'],
						'item_id'               => $value['item_id'],
						'desc'                  => $value['desc'],
						'value_shipment'        => $value['value_shipment'],
						'quantity'              => $value['quantity'],
						'rate'                  => $value['rate'],
						'insur'                 => $value['insur'],
						'line_total'            => $value['line_total'],
						'other_details_parcel'  => $value['other_details_parcel'],
						'protect_parcel'        => $value['protect_parcel'],
						'referance_parcel'      => $value['referance_parcel'],
						'length'                => $value['length'],
						'length_dimen'          => $value['length_dimen'],
						'breadth'               => $value['breadth'],
						'breadth_dimen'         => $value['breadth_dimen'],
						'height'                => $value['height'],
						'height_dimen'          => $value['height_dimen'],
						'weight'                => $value['weight'],
						'weight_dimen'          => $value['weight_dimen'],
					);
					//print_r($save_ship_iem); die;
					$this->db->insert('shipment_item_details', $save_ship_iem);
					$item_insert_id = $this->db->insert_id();

					$ship_charge_arr = array(
						'shipment_id'               => $shipment_id,
						'shipment_item_details_id'  => $item_insert_id,
						'road'                      => $rs_ship_charge[$key]['road'],
						'rail'                      => $rs_ship_charge[$key]['rail'],
						'air'                       => $rs_ship_charge[$key]['air'],
						'ship'                      => $rs_ship_charge[$key]['ship'],
					);
					$this->db->insert('shipment_charges', $ship_charge_arr);
					$ship_charge_insert_id = $this->db->insert_id();
				}

				// $sql_item = 'INSERT INTO `shipment_item_details` (`shipment_id`, `quotation_id`, `category_id`, `subcategory_id`, `item_id`, `desc`, `value_shipment`, `quantity`, `rate`, `insur`, `line_total`, `other_details_parcel`) SELECT ' . $shipment_id . ',  `quotation_id`, `category_id`, `subcategory_id`, `item_id`, `desc`, `value_shipment`, `quantity`, `rate`, `insur`, `line_total`, `other_details_parcel` FROM `quotation_item_details` WHERE quotation_id =' . $quote_id;

				// $query_item = $this->db->query($sql_item);
				// $item_insert_id = $this->db->insert_id();

				//branch starts
				$branchData = array(
					'shipment_id' => $shipment_id,
					'from_branch_id' => ($from_branchid['fbranch_id'] != '') ? $from_branchid['fbranch_id'] : 0,
					'to_branch_id' => ($to_branchid['tbranch_id'] != '') ? $to_branchid['tbranch_id'] : 0,
					'created_by' => $id,
					'created_date' => DTIME
				);

				$this->db->insert('shipment_order_branch_tagging', $branchData);
				$branch_insert_id = $this->db->insert_id();

				//branch ends

				// Start assign order to P/D boy by area
				if (!empty($from_zip) && !empty($from_branchid)) {
					$this->db->select('pdba.*');
					$this->db->from('pickup_delivery_boy_area pdba');
					$this->db->join('branch_users bu', 'pdba.user_id = bu.user_id');
					$this->db->join('postal_codes_data_master pcdm', 'pdba.area_id = pcdm.id');
					$this->db->where('bu.branch_id', $from_branchid['fbranch_id']);
					$this->db->where('pcdm.postal_code', $from_zip['zip']);
					$query  =   $this->db->get();
					$row = $query->num_rows();
					if ($row > 0) {
						$pdBoyList = $query->result();
						foreach ($pdBoyList as $val) {
							$pdBoyData = array(
								'shipment_id' => $shipment_id,
								'user_id' => $val->user_id,
								'order_type' => 1,
								'status' => 0,
								'created_date' => DTIME
							);
							$this->db->insert('pd_boy_order_tagging', $pdBoyData);
							$pdboy_insert_id = $this->db->insert_id();
						}
					}
				}
				// End assign order to P/D boy by area

				//status
				$statusData = array(
					'shipment_id' => $shipment_id,
					'status_id' => 1,
					'branch_id' => ($to_branchid['tbranch_id'] != '') ? $to_branchid['tbranch_id'] : 0,
					'status_text' => '',
					'created_by' => $id,
					'created_date' => DTIME
				);

				$this->db->insert('shipment_status', $statusData);
				$status_insert_id = $this->db->insert_id();

				//echo $shipment_id .' '. $from_addr_insert_id  .' '.  $to_addr_insert_id  .' '.  $item_insert_id  .' '.  $branch_insert_id  .' '.  $status_insert_id;die;

				if ($shipment_id && $from_addr_insert_id && $to_addr_insert_id && $item_insert_id && $branch_insert_id && $status_insert_id && $price_details_id) {
					$upData = array(
						'order_created' => 1,
						'quote_type' => 1,
						'order_created_dtime' => DTIME
					);

					$this->db->where('id', $quote_id);
					$this->db->update('quotation_master', $upData);
					//return $this->db->affected_rows();
					return $shipment_id;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}

	public function updateOutstandinAmount($user_id, $data)
	{
		$this->db->set($data);
		$this->db->where('user_id', $user_id);
		$this->db->update('users', $data);
		return $this->db->affected_rows();
	}

	public function getOrderStatus($order_id)
	{
		$this->db->select('ss.status_id, ss.created_date, sm.status_name');
		$this->db->from('shipment_status ss');
		$this->db->join('status_master sm', 'ss.status_id = sm.id');
		$this->db->where('ss.shipment_id', $order_id);
		$this->db->order_by('ss.id', 'DESC');
		$query  =   $this->db->get();

		//$row = $query->num_rows();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	/*public function getOrderTrackingStatus($order_no)
    {
        $this->db->select('ss.status_id, ss.created_date, sm.status_name');
		$this->db->from('shipment_status ss');
		$this->db->join('status_master sm', 'ss.status_id = sm.id');
		$this->db->join('shipment_master shm', 'ss.shipment_id = shm.id');
		$this->db->where('shm.shipment_no', $order_no);
		$this->db->order_by('ss.id', 'DESC');
        $query  =   $this->db->get();
		
        //$row = $query->num_rows();
        $result = $query->result_array();
		if(!empty($result)) {
        	return $result;
		} else {
			return 'not_found';
		}
    }*/

	public function getpdUserIDByOrderID($shipment_id, $order_type)
	{
		$this->db->select('pdot.user_id');
		$this->db->from('pd_boy_order_tagging pdot');
		$this->db->where('pdot.shipment_id', $shipment_id);
		$this->db->where('pdot.order_type', $order_type);
		//$this->db->order_by('ss.id', 'DESC');
		$query  =   $this->db->get();

		//$row = $query->num_rows();
		$result = $query->result();
		if (!empty($result)) {
			foreach ($result as $key => $res) {
				$row[] = $result[$key]->user_id;
			}
			return $row;
		} else {
			return 'not_found';
		}
	}

	public function getCustomStatusList($shipment_id)
	{
		$this->db->select('scs.*');
		$this->db->from('shipment_custom_status scs');
		$this->db->where('scs.shipment_id', $shipment_id);
		$this->db->where('scs.status_type', '2');
		$this->db->where('scs.status_id', '5');
		$this->db->order_by('scs.id', 'DESC');
		$query  =   $this->db->get();

		//$row = $query->num_rows();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function checkExistOrderStatus($shipment_id, $status_id)
	{
		$query  =   $this->db->get_where('shipment_status', array('shipment_id' => $shipment_id, 'status_id' => $status_id));
		$row = $query->num_rows();
		if ($row > 0) {
			return $row;
		} else {
			return $row;
		}
	}

	public function getOrderTrackingStatus($order_no)
	{
		$this->db->select('id');
		$this->db->from('shipment_master');
		$this->db->where('shipment_no', $order_no);
		$query1  =   $this->db->get();
		$result1 = $query1->row();
		if (!empty($result1)) {
			$shipment_id = $result1->id;
		} else {
			return 'not_found';
			die;
		}

		$this->db->select('sm.id, sm.status_name');
		$this->db->from('status_master sm');
		//$this->db->join('status_master sm', 'ss.status_id = sm.id');
		//$this->db->join('shipment_master shm', 'ss.shipment_id = shm.id');
		$this->db->where('sm.id !=', '7');
		$this->db->order_by('sm.display_order', 'ASC');
		$query  =   $this->db->get();

		//$row = $query->num_rows();
		$result = $query->result();
		if (!empty($result)) {
			foreach ($result as $key => $res) {
				$statusid = $result[$key]->id;
				$this->db->select('ss.created_date');
				$this->db->from('shipment_status ss');
				$this->db->where('ss.status_id', $statusid);
				$this->db->where('ss.shipment_id', $shipment_id);
				$querycheck = $this->db->get();
				$resultrow = $querycheck->row();
				if (!empty($resultrow)) {
					$result[$key]->created_date = date("m-d-Y", strtotime($resultrow->created_date));
				} else {
					$result[$key]->created_date = '';
				}
			}
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function upadte_pdboy_order_status($shipment_id, $user_id, $data)
	{
		$this->db->set($data);
		$this->db->where('shipment_id', $shipment_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('order_type', '1');
		$this->db->update('pd_boy_order_tagging', $data);
		return $this->db->affected_rows();
	}

	public function upadte_pdboy_delivery_order_status($shipment_id, $user_id, $data)
	{
		$this->db->set($data);
		$this->db->where('shipment_id', $shipment_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('order_type', '2');
		$this->db->update('pd_boy_order_tagging', $data);
		return $this->db->affected_rows();
	}

	public function getContainerByshipmentId($shipment_id)
	{
		$this->db->select('cs.id');
		$this->db->from('container_shipment cs');
		$this->db->join('shipment_order_branch_tagging sobt', 'cs.from_branch_id = sobt.from_branch_id AND cs.to_branch_id = sobt.to_branch_id');
		//$this->db->join('shipment_master shm', 'ss.shipment_id = shm.id');
		$this->db->where('cs.full_status', 0);
		$this->db->where('sobt.shipment_id', $shipment_id);
		$this->db->order_by('cs.id', 'DESC');
		$query  =   $this->db->get();

		//$row = $query->num_rows();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function UpdateContainerItemStatus($data, $shipment_id)
	{
		//get to address
		$this->db->select('zip');
		$this->db->where('shipment_id', $shipment_id);
		$query_tz = $this->db->get('shipment_to_address');
		// echo $this->db->last_query();die;
		if ($query_tz) {
			$to_zip = $query_tz->row_array();
		} else {
			$to_zip = false;
		}

		//get to branch_id by pincode
		if (!empty($to_zip)) {
			$this->db->select('`branch_area`.`branch_id` AS tbranch_id');
			$this->db->join('`branch_area`', '`postal_codes_data_master`.`id` = `branch_area`.`area_id`', 'INNER');
			$this->db->where('postal_code', $to_zip['zip']);
			//$this->db->where('is_deleted', '0');
			$query_tb = $this->db->get('postal_codes_data_master');
			// echo $this->db->last_query();
			if ($query_tb) {
				$to_branchid = $query_tb->row_array();
			} else {
				$to_branchid = false;
			}
		} else {
			$to_branchid = false;
		}
		//echo '<pre>'; print_r($to_zip); print_r($to_branchid); echo '</pre>';	//die;
		// Start assign order to P/D boy by area
		if (!empty($to_zip) && !empty($to_branchid)) {
			$this->db->select('pdba.*');
			$this->db->from('pickup_delivery_boy_area pdba');
			$this->db->join('branch_users bu', 'pdba.user_id = bu.user_id');
			$this->db->join('postal_codes_data_master pcdm', 'pdba.area_id = pcdm.id');
			$this->db->where('bu.branch_id', $to_branchid['tbranch_id']);
			$this->db->where('pcdm.postal_code', $to_zip['zip']);
			$query  =   $this->db->get();
			//echo $this->db->last_query(); die;
			$row = $query->num_rows();
			if ($row > 0) {
				$pdBoyList = $query->result();
				foreach ($pdBoyList as $val) {
					$pdBoyData = array(
						'shipment_id' => $shipment_id,
						'user_id' => $val->user_id,
						'order_type' => 2,
						'status' => 0,
						'created_date' => date('Y-m-d H:i:s')
					);
					//echo '<pre>'; print_r($pdBoyData);  echo '</pre>';
					$this->db->insert('pd_boy_order_tagging', $pdBoyData);
					$pdboy_insert_id = $this->db->insert_id();
				}
			}
		}
		// End assign order to P/D boy by area

		//status
		/*$statusData = array(
			'shipment_id' => $shipment_id,
			'status_id' => 8,
			'branch_id' => ($to_branchid['tbranch_id'] != '') ? $to_branchid['tbranch_id'] : 0,
			'status_text' => '',
			'created_by' => $this->session->userdata('user_id'),
			'created_date' => DTIME
		);
		//echo '<pre>'; print_r($statusData);  echo '</pre>';die;
		$this->db->insert('shipment_status', $statusData);
		$status_insert_id = $this->db->insert_id();*/

		$this->db->set($data);
		$this->db->where('order_id', $shipment_id);
		$this->db->update('container_shipment_items', $data);
		return $this->db->affected_rows();
	}

	public function getcustomersList()
	{
		$wherecond = "(u.user_type ='NU' OR u.user_type='BU')";
		$this->db->select('u.user_id,u.firstname,u.lastname,u.email');
		$this->db->from('users u');
		$this->db->where('u.status', '1');
		$this->db->where($wherecond);
		$this->db->order_by('u.user_id', 'DESC');
		$query  =   $this->db->get();
		//echo $this->db->last_query();die();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getAreaWiseCustomersList($ArearListarr)
	{
		$wherecond = "(u.user_type ='NU' OR u.user_type='BU')";
		$this->db->select('u.user_id,u.firstname,u.lastname,u.email');
		$this->db->from('users u');
		$this->db->where('u.status', '1');
		$this->db->where($wherecond);
		$this->db->where_in('u.zip', $ArearListarr);
		$this->db->order_by('u.user_id', 'DESC');
		$query  =   $this->db->get();
		//echo $this->db->last_query();die();
		$result = $query->result_array();
		if (!empty($result)) {
			return $result;
		} else {
			return 'not_found';
		}
	}

	public function getpdBoyAreaList($pdboy_id)
	{
		$this->db->select('pcdm.postal_code');
		$this->db->from('pickup_delivery_boy_area pdba');
		$this->db->join('postal_codes_data_master pcdm', 'pdba.area_id = pcdm.id', 'left');
		$this->db->where('pdba.user_id', $pdboy_id);
		$query = $this->db->get();
		//echo $this->db->last_query();die();
		$row = $query->num_rows();
		if ($row > 0) {
			//return true;
			$row = $query->result();
			return $row;
		} else {
			//return false;
			return 'not_found';
		}
	}

	public function getcustomersDetails($user_id)
	{
		$this->db->select('u.*, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
		$this->db->from('users u');
		$this->db->where('`user_id`', $user_id);
		$this->db->join('countries_master cm', 'u.country = cm.id', 'left');
		$this->db->join('states_master sm', 'u.state = sm.id', 'left');
		$this->db->join('cities_master ctm', 'u.city = ctm.id', 'left');
		//$this->db->join('users_info uf', 'u.user_id = uf.user_id');
		$query = $this->db->get();
		//echo $this->db->last_query();die();
		$row = $query->num_rows();
		if ($row > 0) {
			//return true;
			$row = $query->result();
			return $row;
		} else {
			//return false;
			return 'not_found';
		}
	}

	public function getFromAddressByQuoteID($QuoteID)
	{
		$this->db->select('sfa.*, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
		$this->db->from('quotation_from_address sfa');
		$this->db->where('sfa.quotation_id',  $QuoteID);
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

	public function upadte_pdboy_quote_request_status($quotation_id, $data)
	{
		$this->db->set($data);
		$this->db->where('quotation_id', $quotation_id);
		$this->db->update('pd_boy_quotation_req_tagging', $data);
		return $this->db->affected_rows();
	}
}
