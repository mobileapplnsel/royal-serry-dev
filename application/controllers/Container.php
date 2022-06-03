<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Container extends CI_Controller
{

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
		$this->load->library(array('form_validation', 'encryption', 'session', 'javascript'));
		$this->load->helper(array('url', 'form', 'date'));
		$this->load->helper('admin_helper');
		$this->encryption->create_key(16);
		$this->load->model('container_model');
		$this->load->model('order_model');
		$this->load->model('rate_model');
		$this->load->model('user_model');
		$this->load->model('category_model');
		$this->load->library('image_lib');
		$this->load->library("pagination");
		$this->load->library("email");
		$this->gallery_path = realpath(APPPATH . '../uploads');
	}

	/********************************************   container Functions   ********************************************/
	public function index($page = 'list-container')
	{
		if (!$this->session->userdata('logged_in')) {
			return redirect('admin/login');
		} else {
			if (!file_exists(APPPATH . 'views/admin/container/' . $page . '.php')) {
				show_404();
			} else {
				$data   =   [];
				$from_branch_id   = $this->input->post('from_branch_id');
				$to_branch_id   = $this->input->post('to_branch_id');
				if ($this->session->userdata('user_type') == 'MO') {
					$data['containerList']  =   $this->container_model->getContainerList($from_branch_id, $to_branch_id);
				} else {
					$data['containerList']  =   $this->container_model->getContainerList_ByBranchId($this->session->userdata('branch_id'));
				}
				$data['from_branch_id']     =   $from_branch_id;
				$data['to_branch_id']       =   $to_branch_id;
				$data['title']              =   ucfirst($page);
				$data['branchList']     =   $this->user_model->getBranchList();
				$this->load->view('admin/container/' . $page, $data);
			}
		}
	}


	public function addcontainer($page = 'add-container')
	{
		if (!$this->session->userdata('logged_in')) {
			return redirect('admin/login');
		} else {
			if (!file_exists(APPPATH . 'views/admin/container/' . $page . '.php')) {
				show_404();
			} else {
				$data['title'] = ucfirst($page);
				$data['ShippingModeList']     		=   $this->rate_model->getShippingModeList();
				//$data['ShippingCatList']     		=   $this->rate_model->getShippingCatList();
				//$data['ShippingDocumentCatList']    =   $this->rate_model->getShippingDocumentCatList();
				//$data['ShippingPackageCatList']     =   $this->rate_model->getShippingPackageCatList();
				$this->load->view('admin/container/' . $page, $data);
			}
		}
	}

	public function additemtocontainer($id)
	{
		$getContainerLocation   =   $this->container_model->getContainerLocation_byId($id);
		$getContainerViaLocation   =   $this->container_model->getContainerViaLocation_byId($id);
		if ($this->session->userdata('user_type') == 'MO') {
			$FromBranchId = $getContainerLocation[0]->from_branch_id;
		} else {
			$FromBranchId = $this->session->userdata('branch_id');
		}
		$ToBranchId = $getContainerLocation[0]->to_branch_id;
		//print_r($getContainerLocation);
		$data['FromBranchName'] = $getContainerLocation[0]->from_branch_name;
		$data['ToBranchName'] = $getContainerLocation[0]->to_branch_name;
		$data['full_status'] = $getContainerLocation[0]->full_status;

		$shipment_mode = $getContainerLocation[0]->shipment_mode;

		if (!empty($getContainerViaLocation)) {
			foreach ($getContainerViaLocation as $location) {
				$vialocationArr[] = $location->branch_id;
				$viaBranchNameArr[] = $location->branch_name;
			}
			array_push($vialocationArr, $ToBranchId);
			$data['ViaBranchName'] = implode(", ", $viaBranchNameArr);

			$data['getShipmentDetails']   =   $this->container_model->getShipmentDetails_by_locationId($FromBranchId, $vialocationArr, $shipment_mode);

			// SEND mail to paylater user
			if (!empty($data['getShipmentDetails'])) {
				foreach ($data['getShipmentDetails'] as $shipment) {
					if ($shipment->payment_mode == '3') {
						$checkPoint = getCheckPoint($shipment->customer_id, '2');
						if ($checkPoint == '1') {
							$from_email = 'noreply@staqo.com';
							$replyemail = 'noreply@staqo.com';
							$to_email   = $shipment->email;
							$name       = $shipment->firstname;
							$subject = "Required payment for order shipment From Royal Sherry";

							$body = '';
							$body .= '<p>Dear, ' . $name . '</p>';
							$body .= '<p>You have to pay total amount before order shipment. please pay required amount. </p>';
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
								$return['mailsent'] = '0';
								$return['message'] = 'SMTP Error: Email Not Sent!';
							}
						}
					}
				}
			}
		}

		//echo '<pre>'; print_r($vialocationArr);  print_r($getShipmentDetails); echo '</pre>'; die;
		//$data['ShippingModeList']     		=   $this->rate_model->getShippingModeList();
		//$data['getViaBranchList']     		=   $this->container_model->getViaBranchList($id);

		/*$code = rand(10000, 99999);
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$code), array())->draw();
		imagepng($imageResource, 'barcodes/'.$code.'.png');

		$data['barcode'] = 'barcodes/'.$code.'.png';*/
		if ($this->session->userdata('user_type') == 'MO') {
			$data['getAddedItemShipmentDetails']   =   $this->container_model->getAddedItemShipmentDetails_ByContainerID($id);
		} else {
			$data['getAddedItemShipmentDetails']   =   $this->container_model->getAddedItemShipmentDetails_ByContainerID_byBranch($id, $this->session->userdata('branch_id'));
		}

		$this->load->view('admin/container/add-container-item', $data);
	}

	public function viewitemtocontainer($id)
	{
		/*$getContainerLocation   =   $this->container_model->getContainerLocation_byId($id);
		$getContainerViaLocation   =   $this->container_model->getContainerViaLocation_byId($id);
		if($this->session->userdata('user_type') == 'MO'){
			$FromBranchId = $getContainerLocation[0]->from_branch_id;
		} else {
			$FromBranchId = $this->session->userdata('branch_id');
		}
		$ToBranchId = $getContainerLocation[0]->to_branch_id;
		
		$data['FromBranchName'] = $getContainerLocation[0]->from_branch_name;
		$data['ToBranchName'] = $getContainerLocation[0]->to_branch_name;
		$data['full_status'] = $getContainerLocation[0]->full_status;
		
		foreach($getContainerViaLocation as $location)
		{
			$vialocationArr[] = $location->branch_id;
			$viaBranchNameArr[] = $location->branch_name;
		}
		array_push($vialocationArr, $ToBranchId);
		$data['ViaBranchName'] = implode(", ",$viaBranchNameArr);
		
		$data['getShipmentDetails']   =   $this->container_model->getShipmentDetails_by_locationId($FromBranchId, $vialocationArr);*/

		//echo '<pre>'; print_r($vialocationArr);  print_r($getShipmentDetails); echo '</pre>'; die;
		//$data['ShippingModeList']     		=   $this->rate_model->getShippingModeList();
		//$data['getViaBranchList']     		=   $this->container_model->getViaBranchList($id);

		/*$code = rand(10000, 99999);
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		$imageResource = Zend_Barcode::factory('code128', 'image', array('text'=>$code), array())->draw();
		imagepng($imageResource, 'barcodes/'.$code.'.png');

		$data['barcode'] = 'barcodes/'.$code.'.png';*/
		if ($this->session->userdata('user_type') == 'MO') {
			$data['getAddedItemShipmentDetails']   =   $this->container_model->getAddedItemShipmentDetails_ByContainerID($id);
		} else {
			$data['getAddedItemShipmentDetails']   =   $this->container_model->getAddedItemShipmentDetails_ByContainerID_byBranch($id, $this->session->userdata('branch_id'));
		}

		$this->load->view('admin/container/view-container-item', $data);
	}

	public function branchitemtocontainer($id)
	{
		if ($this->session->userdata('user_type') == 'MO') {
			$data['getAddedItemShipmentDetails']   =   $this->container_model->getAddedItemShipmentDetails_ByContainerID($id);
		} else {
			$data['getAddedItemShipmentDetails']   =   $this->container_model->getAddedItemShipmentDetails_ByContainerID_byDestinationBranch($id, $this->session->userdata('branch_id'));
		}

		$this->load->view('admin/container/branch-container-item', $data);
	}

	public function set_barcode($code)
	{
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		return Zend_Barcode::render('code128', 'image', array('text' => $code), array());
	}

	public function insertcontainer()
	{
		$this->form_validation->set_rules('shipment_mode', 'shipment mode', 'required');
		//$this->form_validation->set_rules('miles', 'Miles', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			//return redirect('subscription/addSubscription');
			echo redirectPreviousPage();
		} else {
			//$data   =   $_POST;
			/*$checkAvailablity       =   $this->rate_model->checkExistRate($_POST['ship_mode_id'],$_POST['ship_cat_id'],$_POST['ship_subcat_id'],$_POST['ship_sub_subcat_id'],$_POST['rate_type']);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Rate Already exists!');
                echo redirectPreviousPage();
                exit;
            }*/
			$data   =   array();
			$container_no		= $this->input->post('container_no');
			$shipment_mode		= $this->input->post('shipment_mode');
			$from_branch_id		= $this->input->post('from_branch_id');
			$to_branch_id		= $this->input->post('to_branch_id');

			$branch_id			= $this->input->post('branch_id');

			$shipment_details		= $this->input->post('shipment_details');
			$vehicle_number			= $this->input->post('vehicle_number');
			$status					= $this->input->post('status');
			$schedule_date			= $this->input->post('schedule_date');
			$date_of_arrival		= $this->input->post('date_of_arrival');
			$date_time				= $this->input->post('date_time');
			$remarks				= $this->input->post('remarks');

			$data = array(
				'shipment_no' => getSLNo(3),
				'container_no' => $container_no,
				'shipment_mode' => $shipment_mode,
				'from_branch_id' => $from_branch_id,
				'to_branch_id' => $to_branch_id,
				'shipment_details' => $shipment_details,
				'vehicle_number' => $vehicle_number,
				'status' => $status,
				'schedule_date' => $schedule_date,
				'date_of_arrival' => $date_of_arrival,
				'date_time' => $date_time,
				'remarks' => $remarks,
				'created_by' => $_SESSION['user_id'],
				'created_date' => date('Y-m-d')
			);

			//echo '<pre>'; print_r($data); print_r($_SESSION); print_r($branch_id); echo '<pre>';die;
			$insertContainerID   =   $this->container_model->addNewcontainer($data);

			if ($insertContainerID > 0) {
				$shipment_stops   =   array();

				if (isset($branch_id) && !empty($branch_id)) {
					foreach ($branch_id as $branch) {
						$shipment_stops['branch_id']     =  $branch;
						$shipment_stops['shipment_id']   =  $insertContainerID;
						$insertShipmentStops   =   $this->container_model->insert_shipment_stops($shipment_stops);
					}
				}


				$this->session->set_flashdata('success', 'Container Successfully Added');
				//echo redirectPreviousPage();
				redirect('admin/container-list');
			} else {
				$this->session->set_flashdata('error', 'Container cannot added!!');
				//echo redirectPreviousPage();
				redirect('admin/container-list');
			}
		}
	}


	public function insertitemtocontainer()
	{
		$container_id = $this->uri->segment(3);
		$order_id = $this->uri->segment(4);
		$item_id = $this->uri->segment(5);

		$data   =   array();

		$data = array(
			'container_id' => $container_id,
			'order_id' => $order_id,
			'item_id' => $item_id,
			'created_by' => $_SESSION['user_id'],
			'date_time' => date('Y-m-d'),
			'status' => '1'
		);
		$status = array(
			'status' => '2'
		);
		//echo '<pre>'; print_r($data); echo '<pre>';die;
		$insertItemID   =   $this->container_model->addNewItemTocontainer($data);

		$ChangeContainerStatus   =   $this->container_model->ChangeContainerStatus($container_id, $status);
		// Change order status
		$data1                           =   [];
		$data1['shipment_id']                    =   $order_id;
		$data1['status_id']                      =   3;
		$data1['branch_id']                   	=   $this->session->userdata('branch_id');
		$data1['created_by']                   	=   $this->session->userdata('user_id');
		$data1['created_date']                   =   date('Y-m-d H:i:s');

		$checkAvailablity       =   $this->order_model->checkExistOrderStatus($data1['shipment_id'], $data1['status_id']);

		if ($checkAvailablity > 0) {
		} else {
			$this->order_model->insert_order_status($data1);
		}

		if ($insertItemID > 0) {
			// Start send push notification to customer
			$pushToken = getCustomerPushTokenByOrderId($order_id);
			if (!empty($pushToken)) {
				$title = "Royal Sherry Order Tracking";
				$message = 'Parcel ' . getOrdernoByOrderId($order_id) . ' on ' . getOrderDateByOrderId($order_id) . ' received from ' . getCustomerNameByOrderId($order_id) . ' at ' . getBranchNameByBranchId($this->session->userdata('branch_id')) . ' is in transit.';

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

			$this->session->set_flashdata('success', 'Item Successfully Added To Container');
			echo redirectPreviousPage();
		} else {
			$this->session->set_flashdata('error', 'Item cannot added to container!!');
			echo redirectPreviousPage();
		}
	}
	public function changecontaineritemstatus($shipment_id, $item_id)
	{
		//echo '===>>'.$shipment_id.'==>>'.$item_id;
		$constatus = array(
			'status' => '3'
		);
		$ontainerItemStatus   =   $this->container_model->UpdateContainerItemStatus($item_id, $constatus, $shipment_id);
		if ($ontainerItemStatus > 0) {
			$this->session->set_flashdata('success', 'Container Item Status changed Successfully');
			echo redirectPreviousPage();
		} else {
			$this->session->set_flashdata('error', 'Container Item Status cannot changed!!');
			echo redirectPreviousPage();
		}
	}

	public function getdocumentCategories()
	{
		$type   				=   $this->input->post('type', TRUE);
		$ShippingDocumentCatList     =   $this->rate_model->getShippingDocumentCatListbyOption($type);
		echo $ShippingDocumentCatList;
	}

	public function getdocumentSubCategories()
	{
		$catId   						=   $this->input->post('catId', TRUE);
		$type   						=   $this->input->post('type', TRUE);
		$ShippingDocumentsubCatList     =   $this->rate_model->getShippingDocumentSubCatListbyOption($catId, $type);
		echo $ShippingDocumentsubCatList;
	}


	public function getToBranchList()
	{
		$BranchId   						=   $this->input->post('BranchId', TRUE);
		$getToBranchList     =   $this->container_model->getToBranchList($BranchId);
		echo $getToBranchList;
	}


	public function editcontainer($id)
	{
		$data['editContainer']   =   $this->container_model->editContainer($id);
		$data['ShippingModeList']     		=   $this->rate_model->getShippingModeList();
		$data['getViaBranchList']     		=   $this->container_model->getViaBranchList($id);
		$this->load->view('admin/container/edit-container', $data);
	}

	public function editcontainertofull($container_id, $full_status)
	{
		if ($full_status == 1) {
			$data = array(
				'full_status' => $full_status,
				'status' => 3
			);
		} else {
			$data = array(
				'full_status' => $full_status,
				'status' => 2
			);
		}
		//print_r($data); die;
		$UpdateContainerStatus   =   $this->container_model->upadte_container_full_status($container_id, $data);
		if ($UpdateContainerStatus > 0) {

			$this->session->set_flashdata('success', 'Container Status Changed Successfully');
			echo redirectPreviousPage();
		} else {
			$this->session->set_flashdata('error', 'Container Status cannot Changed!!');
			echo redirectPreviousPage();
		}
	}

	public function updateContainer($id)
	{
		$this->form_validation->set_rules('shipment_mode', 'shipment mode', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			return redirect('admin/editcontainer/' . $id);
		} else {
			/* $data                   =       $_POST;
			
			$checkAvailablity       =   $this->rate_model->checkExistRate_byID($_POST['ship_mode_id'],$_POST['ship_cat_id'],$_POST['ship_subcat_id'],$_POST['ship_sub_subcat_id'],$_POST['rate_type'],$id);
			
            if($checkAvailablity>0){
                $this->session->set_flashdata('error', 'Rate Already exists!');
                echo redirectPreviousPage();
                exit;
            }*/
			$data   =   array();
			$container_no		= $this->input->post('container_no');
			$shipment_mode		= $this->input->post('shipment_mode');
			$from_branch_id		= $this->input->post('from_branch_id');
			$to_branch_id		= $this->input->post('to_branch_id');

			$branch_id			= $this->input->post('branch_id');

			$shipment_details		= $this->input->post('shipment_details');
			$vehicle_number			= $this->input->post('vehicle_number');
			$status					= $this->input->post('status');
			$schedule_date			= $this->input->post('schedule_date');
			$date_of_arrival		= $this->input->post('date_of_arrival');
			$date_time				= $this->input->post('date_time');
			$remarks				= $this->input->post('remarks');

			$data = array(
				'container_no' => $container_no,
				'shipment_mode' => $shipment_mode,
				'from_branch_id' => $from_branch_id,
				'to_branch_id' => $to_branch_id,
				'shipment_details' => $shipment_details,
				'vehicle_number' => $vehicle_number,
				'status' => $status,
				'schedule_date' => $schedule_date,
				'date_of_arrival' => $date_of_arrival,
				'date_time' => $date_time,
				'remarks' => $remarks,
				'created_by' => $_SESSION['user_id'],
				'created_date' => date('Y-m-d')
			);

			//print_r($data); die;
			$updateContainer     		=       $this->container_model->updateContainer($id, $data);

			$deleteContainerStop   =   $this->container_model->deleteContainerStop($id);
			$shipment_stops   =   array();

			if (isset($branch_id) && !empty($branch_id)) {
				foreach ($branch_id as $branch) {
					$shipment_stops['branch_id']     =  $branch;
					$shipment_stops['shipment_id']   =  $id;
					$insertShipmentStops   =   $this->container_model->insert_shipment_stops($shipment_stops);
				}
			}


			if ($updateContainer == 1) {
				$this->session->set_flashdata('success', 'Shipment updated successfully');
				//return redirect('admin/editcontainer/'.$id);
				redirect('admin/container-list');
			} else {
				$this->session->set_flashdata('error', 'Nothing to update!!');
				//return redirect('admin/editcontainer/'.$id);
				redirect('admin/container-list');
			}
		}
	}

	public function deleteContainer($id)
	{

		$deleteContainer   =   $this->container_model->deleteContainer($id);

		if ($deleteContainer == 1) {
			$this->session->set_flashdata('success', 'Container deleted successfully');
			//return redirect('admin/international/');
			echo redirectPreviousPage();
			exit;
		} else {
			$this->session->set_flashdata('error', 'Something went wrong');
			//return redirect('admin/international/');
			echo redirectPreviousPage();
			exit;
		}
	}

	public function deleteaddedItemFromContainer()
	{
		$container_id = $this->uri->segment(3);
		$order_id = $this->uri->segment(4);
		$item_id = $this->uri->segment(5);

		$addedItamdeleteContainer   =   $this->container_model->addedItamdeleteContainer($container_id, $order_id, $item_id);

		if ($addedItamdeleteContainer == 1) {
			$this->session->set_flashdata('success', 'Item deleted successfully From Container.');
			//return redirect('admin/international/');
			echo redirectPreviousPage();
			exit;
		} else {
			$this->session->set_flashdata('error', 'Item cannot deleted!!');
			//return redirect('admin/international/');
			echo redirectPreviousPage();
			exit;
		}
	}

	/********************************************   Subscription Functions   ********************************************/
}
