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

// container routes
$route['admin/addcontainer']         = "container/addcontainer";
$route['admin/container-list']     = "container";
$route['admin/editcontainer/(:any)'] = "container/editcontainer/$1";

// Branch routes
$route['admin/addbranch']         = "branch/addbranch";
$route['admin/branch-list']       = "branch";
$route['admin/editbranch/(:any)'] = "branch/editbranch/$1";
$route['admin/addbrancharea/(:any)'] = "branch/addbrancharea/$1";
$route['admin/addbranchshift/(:any)'] 	 = "branch/addbranchshift/$1";

// Tax routes
$route['admin/tax-list']       		= "tax";
$route['admin/edittax/(:any)'] 		= "tax/edittax/$1";

// Document routes
$route['admin/adddocument']         = "document/adddocument";
$route['admin/document-list']       = "document";
$route['admin/editdocument/(:any)'] = "document/editdocument/$1";

// Quotation routes
$route['admin/addquotation']          = "quotation/addquotation";
$route['admin/quotation-list']        = "quotation";
$route['admin/editquotation/(:any)']  = "quotation/editquotation/$1";

// rate routes
$route['admin/addrate']         	= "rate/addrate";
$route['admin/rate-list']       	= "rate";
$route['admin/editrate/(:any)'] 	= "rate/editrate/$1";

// shift routes
$route['admin/addshift']         	= "shift/addshift";
$route['admin/shift-list']       	= "shift";
$route['admin/editshift/(:any)'] 	= "shift/editshift/$1";

// CMS routes
$route['admin/cms-list']       		= "cms";
$route['admin/editcms/(:any)'] 		= "cms/editcms/$1";


// package routes
$route['admin/addpackage']         = "package/addpackage";
$route['admin/package-list']       = "package";
$route['admin/editpackage/(:any)'] = "package/editpackage/$1";


// banner routes
$route['admin/addbanner']         = "banner/addbanner";
$route['admin/banner-list']       = "banner";
$route['admin/editbanner/(:any)'] = "banner/editbanner/$1";

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
$route['admin/adduserarea/(:any)'] 	 	 = "users/adduserarea/$1";
$route['admin/addusershift/(:any)'] 	 = "users/addusershift/$1";
$route['admin/addcredit/(:any)'] 	 = "users/addcredit/$1";

// Push Notification routes
$route['admin/send-newpush'] = "custompush/sendnewpush";
$route['admin/push-list']    = "custompush";
//$route['admin/edituser/(:any)']        =   "users/edituser/$1";

//$route['packagedetails/(:any)/(:any)']  =   "frontend/packagedetails/$1/$2";

////////////////////////////////Customer/////////////////////////////////////////////////

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
$route['logout']                = "CustomerController/logout";
$route['home']                  = "CustomerController/home";
$route['quotation']             = "CustomerController/quotation";
$route['getDocumentCategory']   = "CustomerController/getDocumentCategory";
$route['getPackageCategory']    = "CustomerController/getPackageCategory";
$route['getShipmentChanges']    = "CustomerController/getShipmentChanges";
$route['save-quote']            = "CustomerController/saveQuote";

$route['view-quote-print/(:any)']= "CustomerController/viewQuotePrint"; 