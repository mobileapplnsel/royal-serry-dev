<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

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
        $this->load->library(array('form_validation','encryption', 'session','javascript'));
        $this->load->helper(array('url', 'form', 'date'));
        $this->load->helper('admin_helper');
        $this->encryption->create_key(16);
        $this->load->model('order_model');
		$this->load->model('user_model');
		$this->load->model('rate_model');
		$this->load->model('branch_model');
		$this->load->model('category_model');
        $this->load->model('OuthModel');   
        $this->load->model('customer_model');
        $this->load->model('quotation_model');        
        $this->load->library('image_lib');
        $this->load->library("pagination");
		$this->load->library("email");
        $this->gallery_path = realpath(APPPATH . '../uploads');
    }

    /********************************************   quotation Functions   ********************************************/
	public function index($page = 'list-order')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $from_date = $this->input->post('from_date');
                $to_date   = $this->input->post('to_date');
				$ship_cat_id   = $this->input->post('ship_cat_id');
				$category_id   = $this->input->post('category_id');
				$status_id   = $this->input->post('status_id');
				if(isset($ship_cat_id) && $ship_cat_id != ''){
					$data['ShippingDocumentCatList']    =   $this->rate_model->getShippingDocumentCatList_byId($ship_cat_id);
				}
                $data['from_date'] = $from_date;
                $data['to_date']   = $to_date;
				$data['ship_cat_id']   = $ship_cat_id;
				$data['category_id']   = $category_id;
				$data['status_id']   = $status_id;
                $data['orderList']  =   $this->order_model->getOrderList($from_date,$to_date,$category_id,$status_id);
				$data['ShippingCatList']     		=   $this->rate_model->getShippingCatList();
				$data['StatusList']   	 =   $this->order_model->getStatusList();
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }
	
	public function creditors_order_list($page = 'creditors-list-order')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $from_date = $this->input->post('from_date');
                $to_date   = $this->input->post('to_date');
				/*$ship_cat_id   = $this->input->post('ship_cat_id');
				$category_id   = $this->input->post('category_id');
				if(isset($ship_cat_id) && $ship_cat_id != ''){
					$data['ShippingDocumentCatList']    =   $this->rate_model->getShippingDocumentCatList_byId($ship_cat_id);
				}*/
                $data['from_date'] = $from_date;
                $data['to_date']   = $to_date;
				//$data['ship_cat_id']   = $ship_cat_id;
				//$data['category_id']   = $category_id;
                $data['orderList']  =   $this->order_model->getCreditorsOrderList($from_date,$to_date);
				//$data['ShippingCatList']     		=   $this->rate_model->getShippingCatList();
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }
	
	public function invoice_list($page = 'invoice-list-order')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $from_date = $this->input->post('from_date');
                $to_date   = $this->input->post('to_date');
                $data['from_date'] = $from_date;
                $data['to_date']   = $to_date;
                $data['orderList']  =   $this->order_model->getInvoiceOrderList($from_date,$to_date);
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }
	
	public function quoteRequestList($page = 'request-quote-list')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $from_date = $this->input->post('from_date');
                $to_date   = $this->input->post('to_date');
                $data['from_date'] = $from_date;
                $data['to_date']   = $to_date;
                $data['requestQuoteList']  =   $this->order_model->getPDBoyRequestQuotationList($this->session->userdata('user_id'), $from_date,$to_date);
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }
	
	public function pickuporderlist($page = 'list-order-pickup')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $from_date = $this->input->post('from_date');
                $to_date   = $this->input->post('to_date');
                $data['from_date'] = $from_date;
                $data['to_date']   = $to_date;
                $data['orderList']  =   $this->order_model->getpickupOrderList($this->session->userdata('branch_id'),$from_date,$to_date);
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }
	
	public function deliveryorderlist($page = 'list-order-delivery')
    {
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data   =   [];
                $from_date = $this->input->post('from_date');
                $to_date   = $this->input->post('to_date');
                $data['from_date'] = $from_date;
                $data['to_date']   = $to_date;
                $data['orderList']  =   $this->order_model->getdeliveryOrderList($this->session->userdata('branch_id'),$from_date,$to_date);
                $data['title']              =   ucfirst($page);
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }
	
	public function vieworder($order_id)
    {
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			$data['quote_details']          = $this->order_model->orderDetails($order_id);
			$data['quote_from_details']     = $this->order_model->orderFromDetails($order_id);
			$data['quote_to_details']       = $this->order_model->orderToDetails($order_id);
			$data['quote_item_details']     = $this->order_model->orderItemDetails($order_id);
			$data['shipment_details']       = $this->order_model->getShipmentDetails(array('id' => $order_id));
	
			/*$data['profile_details'] = $this->OveModel->Read_User_Information($id);
			$data['prohibitedList']  = $this->prohibited_model->getProhibitedList();
			$data['quote_id_enc'] = $quote_id_enc;*/
			$data['tax'] = $this->order_model->getTax();
			
			$this->load->view('admin/order/view-order', $data);
		}
    }
	
	public function print_invoice($order_id)
    {
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			$data=array('is_invoice'=>'1');
			$UpdateInvoiceStatus   			= $this->order_model->upadte_invoice_status($order_id, $data);
			$data['quote_details']          = $this->order_model->orderDetails($order_id);
			$data['quote_from_details']     = $this->order_model->orderFromDetails($order_id);
			$data['quote_to_details']       = $this->order_model->orderToDetails($order_id);
			$data['quote_item_details']     = $this->order_model->orderItemDetails($order_id);
			$data['shipment_details']       = $this->order_model->getShipmentDetails(array('id' => $order_id));
			$data['tax'] = $this->order_model->getTax();
			
			$this->load->view('admin/order/invoice-print', $data);
		}
    }
	
    public function editOrderDetails($order_id)
    {
        $data['quote_details']          = $this->order_model->orderDetails($order_id);
        $data['quote_from_details']     = $this->order_model->orderFromDetails($order_id);
        $data['quote_to_details']       = $this->order_model->orderToDetails($order_id);
        $data['quote_item_details']     = $this->order_model->orderItemDetails($order_id);
        $data['shipment_details']       = $this->order_model->getShipmentDetails(array('id' => $order_id));
        $data['shipment_price_details']       = $this->order_model->getPriceDetails(array('shipment_id' => $order_id));        
        $data['deliveryModeList']       = $this->customer_model->getDeliveryModeList();
        /*$data['profile_details'] = $this->OveModel->Read_User_Information($id);
        $data['prohibitedList']  = $this->prohibited_model->getProhibitedList();
        $data['quote_id_enc'] = $quote_id_enc;*/
        // echo '<pre>';
        // print_r($data);
        // die;
        $data['tax'] = $this->order_model->getTax();
        
        $this->load->view('admin/order/edit-order-details', $data);
    }

    public function updateOrderDetails(){

        // echo '<pre>';
        // print_r($_POST);
        // die;


        $quantity               = $this->input->post('quantity');
        if($quantity == ''){
            $quantity = 1;
        }

        // Rate Calculation 
        $type                   = $this->input->post('type');
        $ship_cat_id            = $type;
        if($type == 1){
            $ship_subcat_id         = $this->input->post('document_category');
            $ship_sub_subcat_id     = $this->input->post('document_sub_cat');
            $item                   = $this->input->post('document_item');
            $other_details          = $this->input->post('other_details_document');
            $value_of_shipment      = $this->input->post('value_of_shipment_parcel');
            $protect_parcel         = $this->input->post('protect_parcel');
            $shipment_description_parcel       = $this->input->post('shipment_description_parcel');
        } else {
            $ship_subcat_id                    = $this->input->post('package_category');
            $ship_sub_subcat_id                = $this->input->post('package_sub_cat');
            $item                              = $this->input->post('package_item');
            $other_details                     = $this->input->post('other_details_parcel');
            $shipment_description_parcel       = $this->input->post('shipment_description_parcel');
            $value_of_shipment                 = $this->input->post('value_of_shipment_parcel');
            $protect_parcel                    = $this->input->post('protect_parcel');
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
        $additional_charge_comment= $this->input->post('additional_charge_comment');
        $additional_charge        = $this->input->post('additional_charge');
        
        $item_id                = $this->input->post('item_id');
        $shipment_id            = $this->input->post('shipment_id');
        $rate_type              = $this->input->post('rate_type');
        $location_from          = $this->input->post('location_from');
        $location_to            = $this->input->post('location_to');
        $charges_mode           = $this->input->post('charges_mode');
        $delivery_mode_id       = $this->input->post('delivery_speed');

        $additional_charge_gross =  $this->input->post('additional_charge_gross');
        $subtotal                =  $this->input->post('subtotal');
        $discount                =  $this->input->post('discount');
        $tax_ga_pur              =  $this->input->post('tax_ga_pur');
        $tax_ga_amu              =  $this->input->post('tax_ga_amu');
        $tax_ra_pur              =  $this->input->post('tax_ra_pur');
        $tax_ra_amu              =  $this->input->post('tax_ra_amu');
        $grand_total             =  $this->input->post('grand_total');

        $data['rates'] = $this->Users_model->shipmentRate($ship_cat_id, $ship_subcat_id, $ship_sub_subcat_id, $rate_type, $location_from, $location_to, $charges_mode, $delivery_mode_id);
        $data['tax'] = $this->customer_model->getTax();

        if($type == 2){
            $rate_dimen = number_format(((($length * $breadth * $height) / 5000) * 9.99),2);
        } else {
            $rate_dimen = 0.00;
        }
        $finalRate = $data['rates'][0]['rate'] * $quantity;
        $insurance = $data['rates'][0]['insurance'];
        $finalRate = number_format($finalRate + $insurance + $additional_charge + $rate_dimen,2);
        
        if($charges_mode ==1){
            $shipCharges = [
                        'road'              => $finalRate,
                        'rail'              => '0.00',
                        'air'               => '0.00',
                        'ship'              => '0.00',
                    ];
        } else if ($charges_mode ==2) {
            $shipCharges = [                        
                        'road'              => '0.00',
                        'rail'              => $finalRate,
                        'air'               => '0.00',
                        'ship'              => '0.00',
                    ];
        } else if ($charges_mode ==3) {
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

        $shipment_charges_up = $this->OuthModel->UpdateQuery('shipment_charges', $this->OuthModel->xss_clean($shipCharges), 'shipment_item_details_id', $item_id);
        
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
        $shipment_charges_up = $this->OuthModel->UpdateQuery('shipment_item_details', $this->OuthModel->xss_clean($shipItemDet), 'id', $item_id);
        
        $shipment_item_total  = $this->order_model->orderItemTotal($shipment_id);

        $sub = $shipment_item_total[0]['line_total_all'];

        $sub2 = $sub - $discount;
        $after_tax =  number_format($sub2 + $tax_ga_amu + $tax_ra_amu + $additional_charge_gross + $rate_dimen,2);         

        $shipGrossPriceDet = [
                    'additional_charge_gross'=> number_format($additional_charge_gross,2),
                    'subtotal'              => number_format($sub,2),
                    'discount'              => number_format($discount,2),
                    'ga_percentage'         => $tax_ga_pur,
                    'ga_tax_amt'            => $tax_ga_amu,  
                    'ra_percentage'         => $tax_ra_pur,
                    'ra_tax_amt'            => $tax_ra_amu,
                    'grand_total'           => $after_tax,                     
                    ];
        //print_r($shipGrossPriceDet); die;
        $shipment_gross_charges_up = $this->OuthModel->UpdateQuery('shipment_price_details', $this->OuthModel->xss_clean($shipGrossPriceDet), 'shipment_id', $shipment_id);

       // print_r($shipment_charges_up); 
        if ($shipment_charges_up > 0) {
            $messageString = [
                'status' => 1, 'message' => 'Shipment Details are Update Successfully.',
                'redirectUrl'              => base_url('admin/edit-order-details/' . $shipment_id),
            ];
        } else {
            $messageString = [
                'status' => 0,
                'message'                  => 'Faild to Update Order, Please try again !',
                'redirectUrl'              => '',
            ];           
        }    
        echo json_encode($messageString);
    }

    public function updateAditionalCharge(){        
        $additional_charge_gross =  $this->input->post('additional_charge_gross');
        $subtotal                =  $this->input->post('subtotal');
        $discount                =  $this->input->post('discount');
        $tax_ga_pur              =  $this->input->post('tax_ga_pur');
        $tax_ga_amu              =  $this->input->post('tax_ga_amu');
        $tax_ra_pur              =  $this->input->post('tax_ra_pur');
        $tax_ra_amu              =  $this->input->post('tax_ra_amu');
        $grand_total             =  $this->input->post('grand_total');
        $shipment_id             =  $this->input->post('shipment_id');
        
        $grand_total = $grand_total + $additional_charge_gross;
        
        $shipPriceDet = [
                    'additional_charge_gross'=>$additional_charge_gross,
                    'subtotal'              => $subtotal,
                    'discount'              => $discount,
                    'ga_percentage'         => $tax_ga_pur,
                    'ga_tax_amt'            => $tax_ga_amu,  
                    'ra_percentage'         => $tax_ra_pur,
                    'ra_tax_amt'            => $tax_ra_amu,
                    'grand_total'           => $grand_total,                     
                    ];
        //print_r($shipPriceDet);
        $shipment_charges_up = $this->OuthModel->UpdateQuery('shipment_price_details', $this->OuthModel->xss_clean($shipPriceDet), 'shipment_id', $shipment_id);
        if ($shipment_charges_up > 0) {
            $messageString = [
                'status' => 1, 'message' => 'Shipment Details are Update Successfully.',
                'redirectUrl'              => base_url('admin/edit-order-details/' . $shipment_id),
            ];
        } else {
            $messageString = [
                'status' => 0,
                'message'                  => 'Faild to Update Order, Please try again !',
                'redirectUrl'              => '',
            ];           
        }    
        echo json_encode($messageString);
    }

    public function createQuote(){
        $data = array();
        $quote_id = $this->uri->segment(3);
        $data['deliveryModeList']       = $this->customer_model->getDeliveryModeList();
        $data['userList']               = $this->order_model->getUsersList();
        if($quote_id > 0){
            //echo 'Hi'; 
            //echo $quote_id;
            $data['quote_data']             = $this->order_model->quotationDetails($quote_id);
            $data['quoteUser']              = $this->order_model->getUsersList($data['quote_data'][0]['customer_id']);
            $data['quote_to_details']       = $this->Users_model->quotationToDetails($quote_id);
            $data['quote_item_details']     = $this->quotation_model->quotationItemDetails($quote_id);
        } else {
            //echo 'Hi21'; die;
            $data['quote_data']             = '';
            $data['quoteUser']              = '';
            $data['quote_to_details']       = '';
            $data['quote_item_details']     = '';
        }

        $this->load->view('admin/order/add-quote', $data);
    }

    public function startQuote(){
        $quoteno = getSLNo(1);
        $location_type        = $this->input->post('location_type');
        $shipment_type_option = $this->input->post('shipment_type_option');
        $delivery_speed       = $this->input->post('delivery_speed');
        $customer_id          = $this->input->post('customer_id');
        $charges_final        = $this->input->post('charges_final');
        $user_id              = $this->session->userdata('user_id');
        $quot_data = [
                'quote_no'           => $quoteno,
                'customer_id'        => $customer_id,
                'shipment_type'      => $shipment_type_option,
                'location_type'      => $location_type,
                'transport_type'     => $charges_final,
                'status'             => '1',
                'platform'           => '1',
                'quote_type'         => '0',
                'created_by'         => $user_id,
                'delivery_mode_id'   => $delivery_speed,
                'created_date'       => date('Y-m-d H:i:s'),
            ];

            $ins_id   = $this->OuthModel->insertQuery('quotation_master', $this->OuthModel->xss_clean($quot_data));
            redirect('admin/createQuote/'.$ins_id);
    }

    public function saveQuoteItems(){
         //echo '<pre>';
       // print_r($_POST);
        // $telephone_to[]                     = $this->input->post('telephone_to');
        // print_r(serialize($telephone_to));
        // die;

        $quantity               = $this->input->post('quantity');
        if($quantity == ''){
            $quantity = 1;
        }

        // Rate Calculation 
        $type                   = $this->input->post('type');
        $ship_cat_id            = $type;
        if($type == 1){
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
		
		$customer_id            = $this->input->post('customer_id');
        $rate_type              = 'L';
        $item_id                = $this->input->post('item_id');
        $quotation_id           = $this->input->post('quotation_id');
        //$rate_type              = $this->input->post('rate_type');
        $location_from          = $this->input->post('location_from');
        $location_to            = $this->input->post('location_to');
        $charges_mode           = $this->input->post('charges_final');
        $delivery_mode_id       = $this->input->post('delivery_speed');
		
		
		$firstname                       = $this->input->post('firstname');
        $lastname                        = $this->input->post('lastname');
        $address                         = $this->input->post('address');
        $address2                        = $this->input->post('address2');
        $company_name                    = $this->input->post('company_name');
        $country                         = $this->input->post('country');
        $state                           = $this->input->post('state');
        $city                            = $this->input->post('city');
        $zip                             = $this->input->post('zip');
        $email                           = $this->input->post('email');
        $telephone                     	 = $this->input->post('telephone');
        $address_type                    = $this->input->post('address_type');
		
		$latlong_from_address_arr = getLatLongbyAddress($zip);
		$quot_from_address = [
                'quotation_id'  => $quotation_id,
                'customer_id'   => $customer_id,
                'firstname'     => $firstname,
                'lastname'      => $lastname,
                'address'       => $address,
                'address2'      => $address2,
                'company_name'  => $company_name,
                'country'       => $country,
                'state'         => $state,
                'city'          => $city,
                'zip'           => $zip,
                'email'         => $email,
                'telephone'     => $telephone,
                'address_type'  => $address_type,
				'latitude'  	=> $latlong_from_address_arr['lat'],
				'longitude'  	=> $latlong_from_address_arr['long']
            ];
        $from_address = $this->Users_model->quotationFromDetails($quotation_id);
		 if(count($from_address) < 1){
            $ins_from_id   = $this->OuthModel->insertQuery('quotation_from_address', $this->OuthModel->xss_clean($quot_from_address));
        }

        $firstname_to                       = $this->input->post('firstname_to');
        $lastname_to                        = $this->input->post('lastname_to');
        $address_to                         = $this->input->post('address_to');
        $address2_to                        = $this->input->post('address2_to');
        $company_name_to                    = $this->input->post('company_name_to');
        $country_to                         = $this->input->post('country_to');
        $state_to                           = $this->input->post('state_to');
        $city_to                            = $this->input->post('city_to');
        $zip_to                             = $this->input->post('zip_to');
        $email_to                           = $this->input->post('email_to');
        $telephone_to[]                     = $this->input->post('telephone_to');
        $address_type_to                    = $this->input->post('address_type_to');
        
		$latlong_to_address_arr = getLatLongbyAddress($zip_to);
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
                'telephone'     => serialize($telephone_to),
                'address_type'  => $address_type_to,
				'latitude'  	=> $latlong_to_address_arr['lat'],
				'longitude'  	=> $latlong_to_address_arr['long']
            ];
        $to_address = $this->Users_model->quotationToDetails($quotation_id);
        if(count($to_address) < 1){
            $ins_to_id   = $this->OuthModel->insertQuery('quotation_to_address', $this->OuthModel->xss_clean($quot_to_address));
        }

        $data['rates'] = $this->Users_model->shipmentRate($ship_cat_id, $ship_subcat_id, $ship_sub_subcat_id, $rate_type, $location_from, $location_to, $charges_mode, $delivery_mode_id);
        $data['tax'] = $this->customer_model->getTax();

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
        $quote_items_insert = $this->OuthModel->insertQuery('quotation_item_details', $this->OuthModel->xss_clean($shipItemDet));

        //print_r($data);
        if($charges_mode ==1){
            $quoteCharges = [
                        'quotation_id'              => $quotation_id,
                        'quotation_item_details_id' => $quote_items_insert,
                        'road'                      => $finalRate,
                        'rail'                      => '0.00',
                        'air'                       => '0.00',
                        'ship'                      => '0.00',
                    ];
        } else if ($charges_mode ==2) {
            $quoteCharges = [
                        'quotation_id'              => $quotation_id,
                        'quotation_item_details_id' => $quote_items_insert,
                        'road'                      => '0.00',
                        'rail'                      => $finalRate,
                        'air'                       => '0.00',
                        'ship'                      => '0.00',
                    ];
        } else if ($charges_mode ==3) {
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

        $quote_charges_insert = $this->OuthModel->insertQuery('quotation_charges', $this->OuthModel->xss_clean($quoteCharges));
		// Update quote status
		$update = array('quote_type' => '0');
        $query = $this->OuthModel->UpdateQuery('quotation_master', $update, 'id', $quotation_id);
        
        if ($quote_items_insert > 0) {
            $messageString = [
                'status'                   => 1,
                'message'                  => 'Items added Successfully.',
                //'items'                    => $itemStr,
                'redirectUrl'              => base_url('admin/createQuote/' . $quotation_id),
            ];
        } else {
            $messageString = [
                'status'                   => 0,
                'message'                  => 'Faild to Add item, Please try again !',
                //'items'                    => '', 
                'redirectUrl'              => '',
            ];            
        }    
        echo json_encode($messageString);
    }

    public function deleteQuoteItem(){
        $item_id = $this->uri->segment(3);
        
        $this->OuthModel->deleteQuery('quotation_item_details','id',$item_id);
        echo redirectPreviousPage();
        exit;
    }
	
	public function google_map_direction()
    {
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			/*$data=array('is_invoice'=>'1');
			$UpdateInvoiceStatus   			= $this->order_model->upadte_invoice_status($order_id, $data);
			$data['quote_details']          = $this->order_model->orderDetails($order_id);
			$data['quote_from_details']     = $this->order_model->orderFromDetails($order_id);
			$data['quote_to_details']       = $this->order_model->orderToDetails($order_id);
			$data['quote_item_details']     = $this->order_model->orderItemDetails($order_id);
			$data['shipment_details']       = $this->order_model->getShipmentDetails(array('id' => $order_id));
			$data['tax'] = $this->order_model->getTax();*/
			$PickupRules   	 =   $this->branch_model->getPickupRules($this->session->userdata('branch_id'));
			if(!empty($PickupRules)){
				if($PickupRules->rule_id == '1'){ // For next day
					$todayDate = date('Y-m-d 23:59:59',strtotime("-1 days"));
				} elseif($PickupRules->rule_id == '2'){ // For next shift
					$todayDate = date("Y-m-d H:i:s", strtotime('-8 hours'));
				} elseif($PickupRules->rule_id == '3'){ // For x hours
					$todayDate = date("Y-m-d H:i:s", strtotime('-'.$PickupRules->hours.' hours'));
				} else {
					$todayDate = date('Y-m-d 23:59:59',strtotime("-1 days"));
				}
			} else {
				$todayDate = date('Y-m-d 23:59:59',strtotime("-1 days"));
			}
			$data['userPickupOrderList']   =   $this->user_model->getuserPickupOrderList($this->session->userdata('user_id'),$from_date='',$to_date='', $todayDate);
			
			$data['title'] = "Google map direction";
			
			$this->load->view('admin/order/google-map-direction', $data);
		}
    }
	
	public function delivery_google_map_direction()
    {
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			$PickupRules   	 =   $this->branch_model->getPickupRules($this->session->userdata('branch_id'));
			if(!empty($PickupRules)){
				if($PickupRules->rule_id == '1'){ // For next day
					$todayDate = date('Y-m-d 23:59:59',strtotime("-1 days"));
				} elseif($PickupRules->rule_id == '2'){ // For next shift
					$todayDate = date("Y-m-d H:i:s", strtotime('-8 hours'));
				} elseif($PickupRules->rule_id == '3'){ // For x hours
					$todayDate = date("Y-m-d H:i:s", strtotime('-'.$PickupRules->hours.' hours'));
				} else {
					$todayDate = date('Y-m-d 23:59:59',strtotime("-1 days"));
				}
			} else {
				$todayDate = date('Y-m-d 23:59:59',strtotime("-1 days"));
			}
			$data['userPickupOrderList']   =   $this->user_model->getuserDeliveryOrderList($this->session->userdata('user_id'),$from_date='',$to_date='', $todayDate);
			
			$data['title'] = "Google map direction";
			
			$this->load->view('admin/order/google-map-direction', $data);
		}
    }
	
	
    public function addquotation($page = 'add-quotation')
    {
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			if(!file_exists(APPPATH . 'views/admin/quotation/' . $page . '.php'))
			{
				show_404();
			}
			else{
				$data['title'] = ucfirst($page);
				$data['usersList']     =   $this->quotation_model->getNormalBusinessUserList();
				$this->load->view('admin/quotation/' . $page, $data);
			}
		}
    }
	
	public function order_tracking($page = 'order-tracking')
    {
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
			if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
			{
				show_404();
			}
			else{
				$data['title'] = ucfirst($page);
				$shipment_no = $this->input->post('shipment_no', TRUE);
				if(isset($shipment_no) && $shipment_no != ''){
					$data['shipment_list']     =   $this->order_model->getOrderStatus($shipment_no);
				}
				$this->load->view('admin/order/' . $page, $data);
			}
		}
    }
	

    public function deleteQuotation($id)
    {   
        $deleteQuotationFromAddress   =   $this->quotation_model->deleteQuotationFromAddress($id);
		$deleteQuotationToAddress     =   $this->quotation_model->deleteQuotationToAddress($id);
		$deleteQuotationItems   	  =   $this->quotation_model->deleteQuotationItems($id);
        $deleteQuotation   			  =   $this->quotation_model->deleteQuotation($id);
        
        if($deleteQuotation == 1){
            $this->session->set_flashdata('success', 'Quotation deleted successfully');
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
    
    /********************************************   Subscription Functions   ********************************************/
	
	public function getAllStateListbyCountry(){
		$countryId   				=   $this->input->post('countryId', TRUE);
		$StateList     =   $this->quotation_model->getStateListbyOption($countryId);
		echo $StateList;
		
	}
	
	public function getAllCityListbyState(){
		$stateId   				=   $this->input->post('stateId', TRUE);
		$CityList     =   $this->quotation_model->getCityListbyOption($stateId);
		echo $CityList;
		
	}
	
	
	public function add_order_status($order_id)
    { 
		$page = 'add-order-status';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $data['OrderStatusList']   =   $this->order_model->getOrderStatusList($order_id);
				//$data['ShiftList']   	 =   $this->user_model->getShiftListbyUserId($id);
				$data['StatusList']   	 =   $this->order_model->getStatusList();
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }
	
	public function insertorderstatus()
    {
		$data                           =   [];
		$data['shipment_id']                    =   $this->input->post('shipment_id', TRUE);
		$data['status_id']                      =   $this->input->post('status_id', TRUE);
		$data['branch_id']                   	=   $this->input->post('branch_id', TRUE);
		$data['created_by']                   	=   $this->input->post('created_by', TRUE);
		$data['created_date']                   =   date('Y-m-d H:i:s');
		
		$checkAvailablity       =   $this->order_model->checkExistOrderStatus($data['shipment_id'],$data['status_id']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Order Status Already exists!');
                echo redirectPreviousPage();
                exit;
            }
		//print_r($data); die;
		if($data['status_id'] == '6'){
			$statusData = array(
				'status'=> '1'
			);
			$this->order_model->updateShipOrderStatus($data['shipment_id'], $order_type='', $statusData);
		} else {
			$statusData = array(
				'status'=> '1'
			);
			 $this->order_model->updateShipOrderStatus($data['shipment_id'], $order_type='1', $statusData);
		}
		$insertOrderStatus   =   $this->order_model->insert_order_status($data);

		if($insertOrderStatus > 0){
			$this->session->set_flashdata('success', 'Order Status Successfully Added');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Order Status cannot added!!');
			echo redirectPreviousPage();
		}
    }
	
	public function deleteOrderStatus($id)
    {   
        $deleteOrderStatus   =   $this->order_model->deleteOrderStatus($id);
        
        if($deleteOrderStatus == 1){
            $this->session->set_flashdata('success', 'Order Status deleted successfully');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Order Status cannot deleted!!');
            echo redirectPreviousPage();
            exit;
        }
    }
	
	public function deleteCustomStatus($id)
    {   
        $deleteOrderStatus   =   $this->order_model->deleteCustomOrderStatus($id);
        
        if($deleteOrderStatus == 1){
            $this->session->set_flashdata('success', 'Custom Order Status deleted successfully');
            echo redirectPreviousPage();
            exit;
        }
        else{
            $this->session->set_flashdata('error', 'Custom Order Status cannot deleted!!');
            echo redirectPreviousPage();
            exit;
        }
    }
	
	/*********************** PD Boy Pickup Orders ***********************/
	public function pdboypickuporderlist()
    {
		$page = 'pdboy-pickup-order-list';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $from_date = $this->input->post('from_date');
                $to_date   = $this->input->post('to_date');
                $data['from_date'] = $from_date;
                $data['to_date']   = $to_date;
				$PickupRules   	 =   $this->branch_model->getPickupRules($this->session->userdata('branch_id'));
				if(!empty($PickupRules)){
					if($PickupRules->rule_id == '1'){ // For next day
						$todayDate = date('Y-m-d 23:59:59',strtotime("-1 days"));
					} elseif($PickupRules->rule_id == '2'){ // For next shift
						$todayDate = date("Y-m-d H:i:s", strtotime('-8 hours'));
					} elseif($PickupRules->rule_id == '3'){ // For x hours
						$todayDate = date("Y-m-d H:i:s", strtotime('-'.$PickupRules->hours.' hours'));
					} else {
						$todayDate = date('Y-m-d 23:59:59',strtotime("-1 days"));
					}
				} else {
					$todayDate = date('Y-m-d 23:59:59',strtotime("-1 days"));
				}
                $data['userPickupOrderList']   =   $this->user_model->getuserPickupOrderList($this->session->userdata('user_id'),$from_date,$to_date, $todayDate);
				$data['HolidayList']   	 =   $this->branch_model->getBranchHolidayList($this->session->userdata('branch_id'));
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }
	
	public function pdboypickuporderhistorylist()
    {
		$page = 'pdboy-pickup-order-history-list';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $from_date = $this->input->post('from_date');
                $to_date   = $this->input->post('to_date');
                $data['from_date'] = $from_date;
                $data['to_date']   = $to_date;
                $data['userPickupOrderList']   =   $this->user_model->getuserPickupOrderHistoryList($this->session->userdata('user_id'),$from_date,$to_date);
				//$data['HolidayList']   	 =   $this->branch_model->getBranchHolidayList($this->session->userdata('branch_id'));
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }

    public function pdboyPickupImageUpload()
    {
        $page = 'pdboy-pickup-image-upload';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $order_id = $this->uri->segment(3);
                //$data['userPickupOrderList']   =   $this->user_model->getuserPickupOrderList($this->session->userdata('user_id'));
                $data['uploadedImageList']       =   $this->user_model->getUploadedImages($order_id,'1');                
                $data['title']           =   ucfirst($page);    
                //print_r($data); die;
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }

    public function pdboyDeliveryImageUpload()
    {
        $page = 'pdboy-delivery-image-upload';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $order_id = $this->uri->segment(3);
                //$data['userPickupOrderList']   =   $this->user_model->getuserPickupOrderList($this->session->userdata('user_id'));
                $data['uploadedImageList']       =   $this->user_model->getUploadedImages($order_id,'2');                
                $data['title']           =   ucfirst($page);    
                //print_r($data); die;
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }

    public function processImage()
    {
        $F = array();
        $count_uploaded_files = count( $_FILES['images']['name'] );
        $files = $_FILES;                
        $shipment_id = $this->input->post('shipment_id');
        $type        = $this->input->post('type');
        for( $i = 0; $i < $count_uploaded_files; $i++ )
        {
            $_FILES['userfile'] = [
                'name'     => $files['images']['name'][$i],
                'type'     => $files['images']['type'][$i],
                'tmp_name' => $files['images']['tmp_name'][$i],
                'error'    => $files['images']['error'][$i],
                'size'     => $files['images']['size'][$i]
            ];
            $F[] = $_FILES['userfile'];    
            if($type == 1){
                $config['upload_path']   = './uploads/pick_up';    
            } else {
                $config['upload_path']   = './uploads/delivery';    
            }            
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 500;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('userfile')) {
                echo json_encode(['status' => 0, 'message' => $this->upload->display_errors()]);die;
            } else {
                $file_data = $this->upload->data();
                $imgName[$i] = $this->upload->data();
                //print_r($imgName[$i]); die;
                $imageData = array(
                                'image'       => $imgName[$i]['file_name'],
                                'shipment_id' => $this->input->post('shipment_id'),
                                'type'        => $type,
                                'created_date'=> date('Y-m-d H:i:s'),
                                'created_by'  => $this->session->userdata('user_id'),
                            );
                $query     = $this->OuthModel->insertQuery('pick_delivery_images',$imageData);
                if ($query == true) {
                    //$picture_url = base_url('/uploads/profiles/' . $file_data['file_name']);
                    $resonse     = ['status' => 1, 'message' => 'Image Upload Successfully !'];
                } else {
                    $resonse = ['status' => 0, 'message' => 'false'];
                }

            }            
           // print_r($imageData);
            // Here is where you do your CodeIgniter upload ...
        }
        echo json_encode($resonse);
    }

    public function saveImageComments(){
        $id      = $this->input->post('id');
        $comment = $this->input->post('comment');
        $update = array('comment' => $comment);
        $query = $this->OuthModel->UpdateQuery('pick_delivery_images', $update, 'id', $id);
        if ($query == true) {
            $resonse     = ['status' => 1, 'message' => 'Comment Updated Successfully !'];
        } else {
            $resonse = ['status' => 0, 'message' => 'No Change in Comment.'];
        }
        echo json_encode($resonse);
    }

    public function deleteImageComments($id){
        //$id         = $this->input->post('id');        
        $query_old  = $this->OuthModel->selectQuery($id,'pick_delivery_images');
        $image_name = $query_old[0]['image'];
        if($query_old[0]['type'] == 1){
            $folder     = 'uploads/pick_up/';      
        } else {
            $folder     = 'uploads/delivery/'; 
        }    
        
        unlink($folder.$image_name); 
        $query = $this->OuthModel->deleteQuery('pick_delivery_images', 'id', $id);
        
        if ($query == true) {
            //$resonse     = ['status' => 1, 'message' => 'Image Deleted Successfully !'];
			$this->session->set_flashdata('success', 'Image Deleted Successfully !');
        } else {
            //$resonse = ['status' => 0, 'message' => 'Somthing went wrong, Please try again later.'];
			$this->session->set_flashdata('success', 'Image cannot deleted, please try again later.');
        }
        //echo json_encode($resonse);
		echo redirectPreviousPage();
        exit;
    }

	public function pdboydeliveryorderlist()
    {
		$page = 'pdboy-delivery-order-list';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $from_date = $this->input->post('from_date');
                $to_date   = $this->input->post('to_date');
                $data['from_date'] = $from_date;
                $data['to_date']   = $to_date;
				$PickupRules   	 =   $this->branch_model->getPickupRules($this->session->userdata('branch_id'));
				if(!empty($PickupRules)){
					if($PickupRules->rule_id == '1'){ // For next day
						$todayDate = date('Y-m-d 23:59:59',strtotime("-1 days"));
					} elseif($PickupRules->rule_id == '2'){ // For next shift
						$todayDate = date("Y-m-d H:i:s", strtotime('-8 hours'));
					} elseif($PickupRules->rule_id == '3'){ // For x hours
						$todayDate = date("Y-m-d H:i:s", strtotime('-'.$PickupRules->hours.' hours'));
					} else {
						$todayDate = date('Y-m-d 23:59:59',strtotime("-1 days"));
					}
				} else {
					$todayDate = date('Y-m-d 23:59:59',strtotime("-1 days"));
				}
                $data['userDeliveryOrderList']   =   $this->user_model->getuserDeliveryOrderList($this->session->userdata('user_id'),$from_date,$to_date, $todayDate);
				// SEND mail to paylater user
				if(!empty($data['userDeliveryOrderList'])){
                	foreach($data['userDeliveryOrderList'] as $userDelivery){
						$checkPoint = 0;
						if($userDelivery->payment_mode == '3'){
							$checkPoint = getCheckPoint($userDelivery->customer_id, '4');
							if($checkPoint == '1'){
								$from_email = 'noreply@staqo.com';
								$replyemail = 'noreply@staqo.com';
								$to_email   = $userDelivery->email;
								$name       = $userDelivery->firstname;
								$subject = "Required payment for order delivery From Royal Sherry";
				
								$body = '';
								$body .= '<p>Dear, ' . $name . '</p>';
								$body .= '<p>You have to pay total amount before order delivery. please pay required amount. </p>';
								$body .= '<p>Royal Sherry team</p>';
				
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
								if ($this->email->send()) {
									$return['mailsent'] = '1';
									$return['message'] = 'Email Sent!';
								} else {
									// echo $this->email->print_debugger();die;
									$return['mailsent'] = '0';
									$return['message'] = 'SMTP Error: Email Not Sent!';
								}
							}
						}
					}
				}
				$data['HolidayList']   	 =   $this->branch_model->getBranchHolidayList($this->session->userdata('branch_id'));
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }
	
	public function pdboydeliveryorderhistorylist()
    {
		$page = 'pdboy-delivery-order-history-list';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $data                    =   [];
                $from_date = $this->input->post('from_date');
                $to_date   = $this->input->post('to_date');
                $data['from_date'] = $from_date;
                $data['to_date']   = $to_date;
                $data['userDeliveryOrderList']   =   $this->user_model->getuserDeliveryOrderHistoryList($this->session->userdata('user_id'),$from_date,$to_date);
				//$data['HolidayList']   	 =   $this->branch_model->getBranchHolidayList($this->session->userdata('branch_id'));
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }
	
	public function pdboyorderstatuschange($tagging_id, $status)
    {
		$ShipmentID = $this->order_model->getShipmentIDby_id($tagging_id);
		$shipment_id = $ShipmentID[0]->shipment_id;
		$shipmentStatus = array(
							'shipment_id'=>$shipment_id,
							'status_id'=>'2',
							'branch_id'=>$this->session->userdata('branch_id'),
							'created_by'=>$this->session->userdata('user_id'),
							'created_date'=>date('Y-m-d H:i:s')
						);
		//echo $branch_id = $this->session->userdata('branch_id').'<==>'.$tagging_id.'<==>'.$status; 
		$data=array(
					'status'=>$status
				);
		$UpdateOrderStatus   =   $this->order_model->upadte_pdboy_order_status($tagging_id, $data);
		
		if($UpdateOrderStatus > 0){
			
			$checkAvailablity       =   $this->order_model->checkExistOrderStatus($shipment_id, '2');
            if($checkAvailablity == 0){
				$this->order_model->insert_order_status($shipmentStatus);
			}
			
			// Start send push notification to customer
			$pushToken = getCustomerPushTokenByOrderId($shipment_id);
			if(!empty($pushToken)){
				$title="Royal Sherry Order Tracking";
				$message='Pickup '.getOrdernoByOrderId($shipment_id).' from '.date('Y-m-d H:i:s').' received from '.getCustomerNameByOrderId($shipment_id).' at '.getBranchNameByBranchId($this->session->userdata('branch_id')).' Regards, Staqo';
				
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
			// End send push notification to customer
			
			$this->session->set_flashdata('success', 'Order Status Changed Successfully');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Order Status cannot Changed!!');
			echo redirectPreviousPage();
		}
		
	}
	
	public function pdboyquotereqcompleted($quotation_id, $status)
    {
		$data=array(
					'status'=>$status
				);
		$UpdateOrderStatus   =   $this->order_model->upadte_pdboy_quote_request_status($quotation_id, $data);
		
		if($UpdateOrderStatus > 0){
			$this->session->set_flashdata('success', 'Quotation request completed Successfully');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Quotation request cannot changed!!');
			echo redirectPreviousPage();
		}
		
	}
	
	public function orderclosed($order_id, $status)
    {
		$data=array(
					'status'=>$status
				);
		$UpdateOrderStatus   =   $this->order_model->upadte_order_status_closed($order_id, $data);
		
		if($UpdateOrderStatus > 0){
			$this->session->set_flashdata('success', 'Order closed successfully.');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Order cannot closed!!');
			echo redirectPreviousPage();
		}
		
	}
	
	public function pdboydeliveryorderstatuschange($tagging_id, $status)
    {
		$ShipmentID = $this->order_model->getShipmentIDby_id($tagging_id);
		$shipment_id = $ShipmentID[0]->shipment_id;
		$shipmentStatus = array(
							'shipment_id'=>$shipment_id,
							'status_id'=>'6',
							'branch_id'=>$this->session->userdata('branch_id'),
							'created_by'=>$this->session->userdata('user_id'),
							'created_date'=>date('Y-m-d H:i:s')
						);
		//echo $branch_id = $this->session->userdata('branch_id').'<==>'.$tagging_id.'<==>'.$status; 
		$data=array(
					'status'=>$status
				);
		$UpdateOrderStatus   =   $this->order_model->upadte_pdboy_order_status($tagging_id, $data);
		
		if($UpdateOrderStatus > 0){
			
			$checkAvailablity       =   $this->order_model->checkExistOrderStatus($shipment_id, '6');
            if($checkAvailablity == 0){
				$this->order_model->insert_order_status($shipmentStatus);
			}
			
			// Start send push notification to customer
			$pushToken = getCustomerPushTokenByOrderId($shipment_id);
			if(!empty($pushToken)){
				$title="Royal Sherry Order Tracking";
				$message='Dear Customer, <br> Your parcel with '.getOrdernoByOrderId($shipment_id).' with '.getCustomerNameByOrderId($shipment_id).' is delivered at from '.getBranchNameByBranchId($this->session->userdata('branch_id')).'  with RoyalSerry shipping.';
				
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
			// End send push notification to customer
							
			$this->session->set_flashdata('success', 'Order Status Changed Successfully');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Order Status cannot Changed!!');
			echo redirectPreviousPage();
		}
		
	}
	
	public function addordercustomstatus($shipment_id, $custom_statusID, $type)
    {
		//$ShipmentID = $this->order_model->getShipmentIDby_id($tagging_id);
		//$shipment_id = $ShipmentID[0]->shipment_id;
		/*$shipmentStatus = array(
							'shipment_id'=>$shipment_id,
							'status_id'=>'7',
							'branch_id'=>$this->session->userdata('branch_id'),
							'created_by'=>$this->session->userdata('user_id'),
							'created_date'=>date('Y-m-d H:i:s')
						);*/
		//echo $branch_id = $this->session->userdata('branch_id').'<==>'.$tagging_id.'<==>'.$status; 
		/*$data=array(
					'status'=>$status
				);
		$UpdateOrderStatus   =   $this->order_model->upadte_pdboy_order_status($tagging_id, $data);
		
		if($UpdateOrderStatus > 0){
			
			$checkAvailablity       =   $this->order_model->checkExistOrderStatus($shipment_id, '6');
            if($checkAvailablity == 0){
				$this->order_model->insert_order_status($shipmentStatus);
			}
			
			$this->session->set_flashdata('success', 'Order Status Changed Successfully');
			echo redirectPreviousPage();
		}
		else{
			$this->session->set_flashdata('error', 'Order Status cannot Changed!!');
			echo redirectPreviousPage();
		}*/
		$page = 'order-custom-status';
		if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                //$order_id = $this->uri->segment(3);
                $data                          =   [];
                $data['custom_status_details']     = $this->order_model->getCustomOrderStatus($shipment_id, $custom_statusID, $type);
                $data['title']           =   ucfirst($page);
				$data['shipment_id']     =   $shipment_id;
				$data['status_id']       =   $custom_statusID;
				$data['status_type']     =   $type;                
                $this->load->view('admin/order/' . $page, $data);
            }
        }
		
	}
	
	public function insertcustomorderstatus()
    {
		$data                           =   array();
		$shipment_id                    =   $this->input->post('shipment_id', TRUE);
		$status_id                      =   $this->input->post('status_id', TRUE);
		$branch_id                   	=   $this->input->post('branch_id', TRUE);
		$created_by                   	=   $this->input->post('created_by', TRUE);
		$created_date                   =   date('Y-m-d H:i:s');
		
		$status_text                    =   $this->input->post('status_text', TRUE);
		$comment                    	=   $this->input->post('comment', TRUE);
		$status_type                    =   $this->input->post('status_type', TRUE);
		
		$shipmentStatus = array(
			'shipment_id'=>$shipment_id,
			'status_id'=>'5',
			'branch_id'=>$this->session->userdata('branch_id'),
			'created_by'=>$this->session->userdata('user_id'),
			'created_date'=>$created_date
		);
		//print_r($shipmentStatus);
		$checkAvailablity       =   $this->order_model->checkExistOrderStatus($shipment_id,$status_id);
		//echo '==>>'.$checkAvailablity; 
		if($checkAvailablity == 0){
			$this->order_model->insert_order_status($shipmentStatus);
		}
		
		// insert custom order status table
		$customStatus = array(
			'shipment_id'=>$shipment_id,
			'status_id'=>'5',
			'status_type'=>$status_type,
			'status_text'=>$status_text,
			'comment'=>$comment,
			'branch_id'=>$this->session->userdata('branch_id'),
			'created_by'=>$this->session->userdata('user_id'),
			'created_date'=>$created_date
		);
		//print_r($customStatus);die;
		$UpdateCustomOrderStatus = $this->order_model->insert_order_custom_status($customStatus);
		if($UpdateCustomOrderStatus > 0){
			$this->session->set_flashdata('success', 'Custom Order Status added Successfully');
			echo redirectPreviousPage();
		} else {
			$this->session->set_flashdata('error', 'Custom Order Status cannot added!!');
			echo redirectPreviousPage();
		}
	}

    public function barcodePrint()
    {
        $page = 'barcode-print';
        if(!$this->session->userdata('logged_in'))
        {
            return redirect('admin/login');
        }
        else
        {
            if(!file_exists(APPPATH . 'views/admin/order/' . $page . '.php'))
            {
                show_404();
            }
            else{
                $order_id = $this->uri->segment(3);
                $data                          =   [];
                $data['quote_from_details']     = $this->order_model->orderFromDetails($order_id);
                $data['quote_to_details']       = $this->order_model->orderToDetails($order_id);
                $data['shipment_details']       = $this->order_model->getShipmentDetails(array('id' => $order_id));                 
                $data['title']           =   ucfirst($page);                
                $this->load->view('admin/order/' . $page, $data);
            }
        }
    }
}