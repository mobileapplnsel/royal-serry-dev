<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Admin_model class.
 *
 * @extends CI_Model
 */
class Customer_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getQuotationByUser($id)
    {
		$where = "(quote_type='0' OR quote_type='2')";
        $this->db->select('*');
        $this->db->from('quotation_master');
        $this->db->where('customer_id', $id);
		$this->db->where('status', 1);
		$this->db->where($where);
        //$this->db->where('quote_type', 0);;
        //$this->db->or_where('quote_type', 2);
        $this->db->order_by('id', 'DESC');
        $this->db->group_by('quote_no ');
        //$this->db->where('is_deleted', '0');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getOrderByUser($id, $many = TRUE)
    {
        //snigdho
        $this->db->select('*');
        $this->db->from('quotation_master');
        $this->db->where('customer_id', $id);
        $this->db->where('quote_type', 1);
        $this->db->order_by('id', 'DESC');
        //$this->db->where('is_deleted', '0');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        if ($query) {
            if ($many == TRUE) {
                return $query->result_array();
            } else {
                return $query->row_array();
            }
        } else {
            return false;
        }
    }
	
	public function cms_details_by_id($id) {
		$this->db->select('*');
		$this->db->from('cms');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->row();
		if(!empty($result)) {			
			return $result;
		} else {
			return false;	
		}
	}

        	
	public function cms_images_by_id($id) {
		$this->db->select('*');
		$this->db->from('cms_images');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->row();
		if(!empty($result)) {			
			return $result;
		} else {
			return false;	
		}
	}

    
    public function getCmsImageList()
    {
		$this->db->select('cms_images.*');
        $this->db->from('cms_images');
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
	
	public function get_news_list_homepage() {
		$this->db->select('n.*, nc.category_name');
		$this->db->from('news n');
		$this->db->join('news_categories nc','n.category_id = nc.cat_id' , 'left');
		$this->db->where('n.status', '1');
		$query = $this->db->get();
		$result = $query->result_array();
		if(!empty($result)) {			
			return $result;
		} else {
			return false;	
		}
	}
	
	public function get_banner_list_homepage() {
		$this->db->select('*');
		$this->db->from('banner');
		//$this->db->join('news_categories nc','n.category_id = nc.cat_id' , 'left');
		//$this->db->where('n.status', '1');
        $this->db->limit(5);  
		$query = $this->db->get();
		$result = $query->result_array();
		if(!empty($result)) {			
			return $result;
		} else {
			return false;	
		}
	}

    public function saveOrder($id = null, $shipment_no = null, $quote_id = null, $payment_mode = 1, $payment_status = 1, $priceData = null, $transaction_id=0)
    {
		if(!empty($transaction_id)){
			$transaction_id = $transaction_id;
		} else {
			$transaction_id = 0;
		}
        //snigdho
        if ($id != null && $quote_id != null && $shipment_no != null) {

            //get from address
            $this->db->select('*');
            $this->db->where('quotation_id', $quote_id);
            $query_fz = $this->db->get('quotation_from_address');
            $quotationFromAddress = $query_fz->row_array();

            $from_zip = null;
            $from_city = $quotationFromAddress['city'];

            //get to address
            $this->db->select('*');
            $this->db->where('quotation_id', $quote_id);
            $query_tz = $this->db->get('quotation_to_address');
            $quotationToAddress = $query_tz->row_array();

            $to_zip = null;
            $to_city = $quotationToAddress['city'];


            //get branch_id by city
            if (!empty($from_zip)) {
                $this->db->select('`branch_area`.`branch_id` AS fbranch_id');
                $this->db->join('`branch_area`', '`postal_codes_data_master`.`id` = `branch_area`.`area_id`', 'INNER');
                $this->db->where('postal_code', $from_zip['zip']);
                $query_fb = $this->db->get('postal_codes_data_master');
                if ($query_fb->num_rows()) {
                    $from_branchid = $query_fb->row_array();
                } else {
                    $from_branchid = false;
                }
            }else if(empty($from_zip) && $from_city) {

                $this->db->select('*');
                $this->db->where('city_id',$from_city);
                $query_fb = $this->db->get('branch_area');
                if ($query_fb->num_rows()) {
                    $from_branchid = $query_fb->row_array();
                } else {
                    $from_branchid = false;
                }
            } else {
                $from_branchid = false;
            }

            //get branch_id by city
            if (!empty($to_zip)) {
                $this->db->select('`branch_area`.`branch_id` AS tbranch_id');
                $this->db->join('`branch_area`', '`postal_codes_data_master`.`id` = `branch_area`.`area_id`', 'INNER');
                $this->db->where('postal_code', $to_zip['zip']);
                $query_tb = $this->db->get('postal_codes_data_master');
                if ($query_tb->num_rows()) {
                    $to_branchid = $query_tb->row_array();
                } else {
                    $to_branchid = false;
                }
            } else if(empty($to_zip) && $to_city) {
                $this->db->select('*');
                $this->db->where('city_id',$to_city);
                $query_fb = $this->db->get('branch_area');

                if ($query_fb->num_rows()) {
                    $to_branchid = $query_fb->row_array();
                } else {
                    $to_branchid = false;
                }
            }
            else {
                $to_branchid = false;
            }
            
            if ($from_branchid == false || $to_branchid == false) {
                return false;
            } else {
                //shipment master
                $sql_sm = 'INSERT INTO `shipment_master` (`shipment_no`, `quotation_id`, `parent_id`, `customer_id`, `shipment_type`, `location_type`, `transport_type`,`delivery_mode_id`,`road`, `rail`, `air`, `ship`, `status`, `platform`, `created_by`, `created_date`, `payment_mode`, `payment_status`, `transaction_id`,`pickup_date`) SELECT  "' . $shipment_no . '", `id`, `parent_id`, `customer_id`, `shipment_type`, `location_type`, `transport_type`,`delivery_mode_id`, `road`, `rail`, `air`, `ship`, `status`, `platform`, `created_by`, `created_date`, ' . $payment_mode . ', ' . $payment_status . ', ' . $transaction_id . ',`pickup_date` FROM `quotation_master` WHERE id =' . $quote_id;

                $query_sm = $this->db->query($sql_sm);
                $shipment_id = $this->db->insert_id();

                 //price_details
                 if($priceData != null){
                    $priceData['shipment_id'] = $shipment_id;
                    // echo '<pre>';print_r($priceData);die;
                    $this->db->insert('shipment_price_details', $priceData);
                    $price_details_id = $this->db->insert_id();
                 }

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
                $this->db->where('quotation_id',$quote_id);
                $query_quot_items   = $this->db->get('quotation_item_details');
                $rs_ship_items      = $query_quot_items->result_array();
                //print_r($rs_ship_items); //die;
                //charges

                $this->db->select('*');
                $this->db->where('quotation_id',$quote_id);
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
                    'from_branch_id' => ($from_branchid['branch_id'] != '') ? $from_branchid['branch_id'] : 0,
                    'to_branch_id' => ($to_branchid['branch_id'] != '') ? $to_branchid['branch_id'] : 0,
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
					//$this->db->join('postal_codes_data_master pcdm', 'pdba.area_id = pcdm.id');
					$this->db->where('bu.branch_id', $from_branchid['branch_id']);
					//$this->db->where('pcdm.postal_code', $from_zip['zip']);
					$query  =   $this->db->get();
					$row = $query->num_rows();
					if ($row > 0)
					{
						$pdBoyList = $query->result();
						foreach($pdBoyList as $val){
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
                if (empty($to_zip) && !empty($to_branchid)) {
                    $this->db->select('*');
                    $this->db->from('pickup_delivery_boy_area');
                    $this->db->where('area_id', $to_branchid['city_id']);
                    $query  =  $this->db->get();
                    $row = $query->num_rows();
                    if ($row > 0)
                    {
                        $pdBoyList = $query->result();
                        foreach($pdBoyList as $val){
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
                    'branch_id' => ($to_branchid['branch_id'] != '') ? $to_branchid['branch_id'] : 0,
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
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function assignQuoteReq($id = null, $quote_id = null)
    {
        //snigdho
        if ($id != null && $quote_id != null) {

            //get from address
            $this->db->select('zip');
            $this->db->where('quotation_id', $quote_id);
            //$this->db->where('is_deleted', '0');
            $query_fz = $this->db->get('quotation_from_address');
            // echo $this->db->last_query();die;
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
                //$this->db->where('is_deleted', '0');
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

            //echo $from_branchid['fbranch_id'] . ' <> ' . $to_branchid['tbranch_id'].'<br>';die;

            if ($from_branchid == false || $to_branchid == false) {
                return false;
            } else {
               
                //branch starts
                $branchData = array(
                    'quotation_id' => $quote_id,
                    'from_branch_id' => ($from_branchid['fbranch_id'] != '') ? $from_branchid['fbranch_id'] : 0,
                    'to_branch_id' => ($to_branchid['tbranch_id'] != '') ? $to_branchid['tbranch_id'] : 0,
                    'created_by' => $id,
                    'created_date' => DTIME
                );

                $this->db->insert('quotation_req_branch_tagging', $branchData);
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
					if ($row > 0)
					{
						$pdBoyList = $query->result();
						foreach($pdBoyList as $val){
							$pdBoyData = array(
								'quotation_id' => $quote_id,
								'user_id' => $val->user_id,
								'order_type' => 1,
								'status' => 0,
								'created_date' => DTIME
							);
							$this->db->insert('pd_boy_quotation_req_tagging', $pdBoyData);
							$pdboy_insert_id = $this->db->insert_id();
						}
					}
				}
				// End assign order to P/D boy by area

            }
        } else {
            return false;
        }
    }

    public function getShipmentByUser($id)
    {
        $this->db->select('*');
        $this->db->from('shipment_master');
        $this->db->where('customer_id', $id);
        $this->db->order_by('id', 'DESC');
        //$this->db->where('is_deleted', '0');
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getTax($param = null)
    {
        $this->db->select('*');
        $this->db->where('status', '1');
        if ($param != null) {
            $this->db->where($param);
        }
        // $this->db->order_by('id', 'DESC');
        $query = $this->db->get('tax');
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getShipmentDetails($param = null, $many = FALSE)
    {
        $this->db->select('*');
        $this->db->where('status', '1');
        if ($param != null) {
            $this->db->where($param);
        }
        
        $query = $this->db->get('shipment_master');
        
        if ($query) {
            if ($many == FALSE) {
                return $query->row_array();
            } else {
                return $query->result_array();
            }
        } else {
            return false;
        }
    }

    public function getShipmentDetailsWithStatus($shipment_no)
    {
       
        $this->db->select('`shipment_master` .*, max(shipment_status.status_id) AS shipment_status_id');
        $this->db->from('shipment_master');
        $this->db->join('shipment_status','shipment_master.id = shipment_status.shipment_id' , 'left');
        $this->db->where('shipment_master.quotation_id', $shipment_no);
        $this->db->where('shipment_master.status', '1');
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function getShipmentFromAddress($shipment_master_id)
    {
        
        $this->db->select('sfa.*, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
        $this->db->from('shipment_from_address sfa');
        $this->db->where('sfa.shipment_id',$shipment_master_id);
        $this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
        $this->db->join('states_master sm', 'sfa.state = sm.id', 'left');
        $this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');
        $query = $this->db->get();
        return $data = $query->row_array();

    }

    public function getShipmentToAddress($shipment_master_id)
    {
        $this->db->select('sfa.*, cm.name as country_name, sm.name as state_name, ctm.name as city_name');
        $this->db->from('shipment_to_address sfa');
        $this->db->where('sfa.shipment_id',$shipment_master_id);
        $this->db->join('countries_master cm', 'sfa.country = cm.id', 'left');
        $this->db->join('states_master sm', 'sfa.state = sm.id', 'left');
        $this->db->join('cities_master ctm', 'sfa.city = ctm.id', 'left');
        $query = $this->db->get();
        return $data = $query->row_array();
    }


    public function getOrderStatus($shipment_no){
        $this->db->select('*,t1.`id` AS shipment_id,t2.`created_date` AS status_date,t1.`created_date` AS order_date');
        $this->db->from('shipment_master t1');
        $this->db->join('shipment_status t2','t1.id = t2.shipment_id' , 'left');
        $this->db->where('t1.shipment_no', $shipment_no);   
        $query = $this->db->get();

        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getDeliveryModeList($param = null)
    {
        $this->db->select('*');
        $this->db->where('status', '1');
        if ($param != null) {
            $this->db->where($param);
        }
        // $this->db->order_by('id', 'DESC');
        $query = $this->db->get('delivery_mode');
        //echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getRateFactor($param = null)
    {
        $this->db->select('amount');
        $this->db->where('id', '1');
        if ($param != null) {
            $this->db->where($param);
        }
        // $this->db->order_by('id', 'DESC');
        $query = $this->db->get('rate_factor');
        // echo $this->db->last_query();die;
        if ($query) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function getShipmentByUserWithStatus($id)
    {
        //snigdho
        $this->db->select('`shipment_master` .*, max(shipment_status.id) AS shipment_status_id');
        $this->db->join('shipment_status','shipment_master.id = shipment_status.shipment_id' , 'left');
        $this->db->where('shipment_master.customer_id', $id);

        $this->db->group_by('shipment_master.id');
        $this->db->order_by('shipment_master.id', 'DESC');
        $this->db->where('shipment_master.status', '1');
        $query = $this->db->get('shipment_master');
        // echo $this->db->last_query();die;
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getShipmentStatusName($id)
    {
        //snigdho
        $this->db->select('`status_master`.status_name AS status_name');
        $this->db->join('status_master','status_master.id = shipment_status.status_id' , 'left');
        $this->db->where('shipment_status.id', $id);

        $this->db->group_by('shipment_status.id');
        //$this->db->where('is_deleted', '0');
        $query = $this->db->get('shipment_status');
        // echo $this->db->last_query();die;
        if ($query) {
            return $query->row_array();
        } else {
            return false;
        }
    }
	
	public function updateOutstandinAmount($user_id, $data)
    {
        $this->db->set($data);
        $this->db->where('user_id',$user_id);
        $this->db->update('users',$data);
        return $this->db->affected_rows();
    }
	
	public function getFromAddressByQuoteID($QuoteID)
    {
        /*$this->db->select('amount');
        $this->db->where('id', '1');
        $query = $this->db->get('rate_factor');
        if ($query) {
            return $query->row_array();
        } else {
            return false;
        }*/
		
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
}



