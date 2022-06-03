<?php

defined('BASEPATH') or exit('No direct script access allowed');



/*

| -------------------------------------------------------------------------

| URI ROUTING

| -------------------------------------------------------------------------

| This file lets you re-map URI requests to specific controller functions.

|

| Typically there is a one-to-one relationship between a URL string

| and its corresponding controller class/method. The segments in a

| URL normally follow this pattern:

|

|    example.com/class/method/id/

|

| In some instances, however, you may want to remap this relationship

| so that a different class/function is called than the one

| corresponding to the URL.

|

| Please see the user guide for complete details:

|

|    https://codeigniter.com/user_guide/general/routing.html

|

| -------------------------------------------------------------------------

| RESERVED ROUTES

| -------------------------------------------------------------------------

|

| There are three reserved routes:

|

|    $route['default_controller'] = 'welcome';

|

| This route indicates which controller class should be loaded if the

| URI contains no data. In the above example, the "welcome" class

| would be loaded.

|

|    $route['404_override'] = 'errors/page_missing';

|

| This route will tell the Router which controller/method to use if those

| provided in the URL cannot be matched to a valid route.

|

|    $route['translate_uri_dashes'] = FALSE;

|

| This is not exactly a route, but allows you to automatically route

| controller and method names that contain dashes. '-' isn't a valid

| class or method name character, so it requires translation.

| When you set this option to TRUE, it will replace ALL dashes in the

| controller and method URI segments.

|

| Examples:    my-controller/index    -> my_controller/index

|        my-controller/my-method    -> my_controller/my_method

 */



//$route['default_controller'] = 'admin';
$route['default_controller']   = 'CustomerController';
//$route['default_controller'] = $this->set_directory('').'CustomerController/index';
$route['404_override']         = '';
$route['translate_uri_dashes'] = false;

$route['deleteRecordAjax']     = "admin/deleteRecordAjax";
$route['admin/login'] = "admin/login";
//admin routes
// Category routes
$route['admin/addpackagecategory']         = "packagecategories/addcategory";
$route['admin/package-categories-list']     = "packagecategories";
$route['admin/editpackagecategory/(:any)'] = "packagecategories/editcategory/$1";



// Category routes
$route['admin/addcategory']         = "categories/addcategory";
$route['admin/categories-list']     = "categories";
$route['admin/editcategory/(:any)'] = "categories/editcategory/$1";

// News Category routes
$route['admin/add-news-category']         = "newscategories/addcategory";
$route['admin/news-categories-list']     = "newscategories";
$route['admin/edit-news-category/(:any)'] = "newscategories/editcategory/$1";

// News routes
$route['admin/add-news']             = "news/addnews";
$route['admin/news-list']             = "news";
$route['admin/edit-news/(:any)']     = "news/editnews/$1";


// container routes

$route['admin/addcontainer']         = "container/addcontainer";
$route['admin/container-list']     = "container";
$route['admin/editcontainer/(:any)'] = "container/editcontainer/$1";
$route['admin/add-item-to-container/(:any)'] = "container/additemtocontainer/$1";
$route['admin/view-item-to-container/(:any)'] = "container/viewitemtocontainer/$1";
$route['admin/insertitemtocontainer/(:any)/(:any)/(:any)'] = "container/insertitemtocontainer/$1/$2/$3";
$route['admin/editcontainertofull/(:any)/(:any)'] = "container/editcontainertofull/$1/$2";
$route['admin/branch-container-item/(:any)'] = "container/branchitemtocontainer/$1";


// Branch routes

$route['admin/addbranch']         = "branch/addbranch";
$route['admin/branch-list']       = "branch";
$route['admin/editbranch/(:any)'] = "branch/editbranch/$1";
$route['admin/addbrancharea/(:any)'] = "branch/addbrancharea/$1";
$route['admin/addbranchshift/(:any)']      = "branch/addbranchshift/$1";
$route['admin/addbranchholiday/(:any)']  = "branch/addbranchholiday/$1";
$route['admin/addbranchcalendar/(:any)']  = "branch/addbranchcalendar/$1";
$route['admin/addpickuprules/(:any)']  = "branch/addpickuprules/$1";


// Tax routes
$route['admin/tax-list']               = "tax";
$route['admin/edittax/(:any)']         = "tax/edittax/$1";


// Document routes
$route['admin/adddocument']         = "document/adddocument";
$route['admin/document-list']       = "document";
$route['admin/editdocument/(:any)'] = "document/editdocument/$1";



// Quotation routes
$route['admin/addquotation']          = "quotation/addquotation";
$route['admin/quotation-list']        = "quotation";
$route['admin/editquotation/(:any)']  = "quotation/editquotation/$1";
$route['admin/viewquotation/(:any)']  = "quotation/viewquotation/$1";
$route['admin/quotationorderclosed/(:any)/(:any)']     = "quotation/quotationorderclosed/$1/$2";


// Order routes
$route['admin/addorder']                  = "order/addorder";
$route['admin/creditors-order-list']    = "order/creditors_order_list";
$route['admin/editorder/(:any)']          = "order/editorder/$1";
$route['admin/vieworder/(:any)']          = "order/vieworder/$1";
$route['admin/edit-order-details/(:any)'] = "order/editOrderDetails/$1";
$route['admin/updateOrderDetails']      = "order/updateOrderDetails";
$route['admin/updateAditionalCharge']   = "order/updateAditionalCharge";

$route['admin/createQuote']             = "order/createQuote";
$route['admin/createQuote/(:any)']      = "order/createQuote";
$route['admin/startQuote']              = "order/startQuote";
$route['admin/saveQuoteItems']          = "order/saveQuoteItems";
$route['admin/deleteQuoteItem/(:any)']  = "order/deleteQuoteItem";
$route['admin/quote-request-list']      = "order/quoteRequestList";

$route['admin/pickup-order-list']         = "order/pickuporderlist";
$route['admin/delivery-order-list']     = "order/deliveryorderlist";
$route['admin/add-order-status/(:any)'] = "order/add_order_status/$1";
$route['admin/pdboy-pickup-order-list'] = "order/pdboypickuporderlist";
$route['admin/pdboy-pickup-image-upload/(:any)']  = "order/pdboyPickupImageUpload";
$route['admin/pdboy-delivery-image-upload/(:any)']  = "order/pdboyDeliveryImageUpload";
$route['admin/saveImageComments']       = "order/saveImageComments";
$route['admin/deleteImageComments']     = "order/deleteImageComments";
$route['admin/order-list']                = "order";

$route['admin/pdboy-pickup-order-history-list']     = "order/pdboypickuporderhistorylist";
$route['admin/pdboy-delivery-order-history-list']    = "order/pdboydeliveryorderhistorylist";

$route['admin/processImage']            = "order/processImage";
$route['admin/pdboy-delivery-order-list']    = "order/pdboydeliveryorderlist";
$route['admin/pdboyorderstatuschange/(:any)/(:any)']     = "order/pdboyorderstatuschange/$1/$2";
$route['admin/pdboydeliveryorderstatuschange/(:any)/(:any)']     = "order/pdboydeliveryorderstatuschange/$1/$2";
$route['admin/print-barcode/(:any)/(:any)']         = "order/barcodePrint";
$route['admin/order-tracking-list']                  = "order/order_tracking";
$route['admin/print-invoice/(:any)']          = "order/print_invoice/$1";
$route['admin/invoice-list']                  = "order/invoice_list";
$route['admin/google-map-direction']        = "order/google_map_direction";
$route['admin/delivery-google-map-direction'] = "order/delivery_google_map_direction";
$route['admin/pdboyquotereqcompleted/(:any)/(:any)']     = "order/pdboyquotereqcompleted/$1/$2";
$route['admin/orderclosed/(:any)/(:any)']     = "order/orderclosed/$1/$2";
$route['admin/addordercustomstatus/(:any)/(:any)/(:any)']     = "order/addordercustomstatus/$1/$2/$3";



// rate routes
$route['admin/addrate']             = "rate/addrate";
$route['admin/rate-list']           = "rate";
$route['admin/editrate/(:any)']     = "rate/editrate/$1";
$route['admin/rate-factor']         = "rate/ratefactor";


// shift routes
$route['admin/addshift']             = "shift/addshift";
$route['admin/shift-list']           = "shift";
$route['admin/editshift/(:any)']     = "shift/editshift/$1";


// CMS routes
$route['admin/cms-list']               = "cms";
$route['admin/editcms/(:any)']         = "cms/editcms/$1";



// CMS images
$route['admin/cms-images']                   = "cms/images_list";
$route['admin/editcmsimages/(:any)']         = "cms/editcms/$1";



// package routes
$route['admin/addpackage']         = "package/addpackage";
$route['admin/package-list']       = "package";
$route['admin/editpackage/(:any)'] = "package/editpackage/$1";


// banner routes
$route['admin/addbanner']         = "banner/addbanner";
$route['admin/banner-list']       = "banner";
$route['admin/editbanner/(:any)'] = "banner/editbanner/$1";
$route['admin/banner-update/(:any)']     = "banner/updateBanner/$1";

// Prohibited routes 
$route['admin/addprohibited']       = "prohibited/addprohibited";
$route['admin/prohibited-list']     = "prohibited";
$route['admin/editprohibited/(:any)'] = "prohibited/editprohibited/$1";

// Payment Option routes
//$route['admin/addpaymentoption']       = "paymentoption/addprohibited";
$route['admin/paymentoption-list']       = "paymentoption";
$route['admin/editpaymentoption/(:any)'] = "paymentoption/editpaymentoption/$1";



// User routes
$route['admin/users-list']               = "users";
$route['admin/edituser/(:any)']          = "users/edituser/$1";
$route['admin/editbranchuser/(:any)']    = "users/editbranchuser/$1";
$route['admin/adduser']                  = "users/adduser";
$route['admin/business-users-list']      = "users/business_users_list";
$route['admin/branch-users-list']        = "users/branch_users_list";
$route['admin/pickup-delivery-boy-list'] = "users/delivery_users_list";
$route['admin/adduserarea/(:any)']           = "users/adduserarea/$1";
$route['admin/addusershift/(:any)']      = "users/addusershift/$1";
$route['admin/addcredit/(:any)']           = "users/addcredit/$1";
$route['admin/addorderpickup/(:any)']      = "users/addorderpickup/$1";
$route['admin/addorderdelivery/(:any)']  = "users/addorderdelivery/$1";
$route['admin/pdboy-holiday-list']       = "users/pdboyholidaylist";
$route['admin/addpaylater/(:any)']           = "users/addpaylater/$1";
$route['admin/adduserduty/(:any)']           = "users/adduserduty/$1";
$route['admin/pdboy-duty-list']           = "users/pdboydutylist";
$route['admin/edituserduty/(:any)/(:any)']           = "users/edituserduty/$1/$2";



// Push Notification routes

$route['admin/send-newpush'] = "custompush/sendnewpush";

$route['admin/push-list']    = "custompush";

//$route['admin/edituser/(:any)']        =   "users/edituser/$1";



//$route['packagedetails/(:any)/(:any)']  =   "frontend/packagedetails/$1/$2";



////////////////////////////////Customer/////////////////////////////////////////////////
$route['about-us'] = 'CustomerController/about_us';
$route['contact-us'] = 'CustomerController/contact_us';
$route['terms-and-condition'] = 'CustomerController/terms_condition';
$route['privacy-policy'] = 'CustomerController/privacy_policy';
$route['industry-sectors'] = 'CustomerController/industry_sectors';
$route['use-services'] = 'CustomerController/use_services';
$route['branch-list'] = 'CustomerController/branchList';


$route['air-freight'] = 'CustomerController/air_freight';
$route['sea-freight'] = 'CustomerController/sea_freight';
$route['land-transport'] = 'CustomerController/land_transport';
$route['delivery'] = 'CustomerController/groupage';
$route['consultancy'] = 'CustomerController/consultancy';
$route['value-added-services'] = 'CustomerController/value_added_services';


$route['login']                 = "CustomerController/login";

$route['registration']          = "CustomerController/registration";

$route['register-user']         = "CustomerController/register_user";

$route['verify-mail']           = "CustomerController/verify-mail";

$route['userlogin']             = "CustomerController/userlogin";

$route['forgot-password']       = "CustomerController/forgot_password";

$route['forgot-password-email'] = "CustomerController/forgot_password_email";

$route['getStates']             = "CustomerController/getStates";

$route['getCity']               = "CustomerController/getCity";

$route['profile']               = "CustomerController/profile";

$route['profile-update']        = "CustomerController/profileUpdate";

$route['profile-password-update'] = 'CustomerController/change_user_profile_password_update';
$route['credit-amount-update']    = 'CustomerController/credit_amount_pay';

$route['logout']                = "CustomerController/logout";

$route['home']                  = "CustomerController/home";

$route['order-shipment']        = "CustomerController/home";

$route['quotation']             = "CustomerController/quotation";

$route['getDocumentCategory']   = "CustomerController/getDocumentCategory";

$route['getPackageCategory']    = "CustomerController/getPackageCategory";

$route['getShipmentChanges']    = "CustomerController/getShipmentChanges";

$route['save-quote']            = "CustomerController/saveQuote";

$route['getglocation']          = "CustomerController/getGLocation";
$route['save_quote_request']    = "CustomerController/saveQuoteReq";
$route['send-quote-email']      = "CustomerController/sendQuoteEmail";
$route['send-get-in-touch']     = "CustomerController/sendGetinTouch";



$route['view-quote-print/(:any)']   = "CustomerController/viewQuotePrint";

$route['place-order/(:any)']    = "CustomerController/onPlaceOrder";

$route['orders']             = "CustomerController/onGetOrders";

$route['save-order']             = "CustomerController/onSaveOrder";

$route['order-tracking']        = "CustomerController/trackOrder";

$route['order-tracking-search'] = "CustomerController/getOrderTrackDetails";

$route['tracking-details/(:any)'] = "CustomerController/trackingDetails";

$route['admin/role-list']        = 'Role/roleList';
$route['admin/role-add']         = 'Role/RoleEdit';
$route['admin/role-edit']        = 'Role/RoleEdit';
$route['admin/role-edit/(:any)'] = 'Role/RoleEdit/$1';
$route['admin/role-permission/(:any)']  = 'Role/rolePermission';
$route['admin/addEditPermission'] = 'Role/addEditPermission';

$route['admin/sharing-rules'] = 'Role/sharingRules';
$route['admin/sharing-rule-edit/(:any)']  = 'Role/sharingRulesEdit';
$route['admin/sharing-rule-update'] = 'Role/sharingRulesUpdate';



$route['view-news/(:any)']     = "CustomerController/onGetNewsDetails/$1";
$route['recipients/list'] = 'RecipientController/autocomplete';