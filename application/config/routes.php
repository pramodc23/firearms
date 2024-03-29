<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = "login";
$route['404_override'] = 'error';


/*********** USER DEFINED ROUTES *******************/

$route['addNewUser'] = "user/addNewUser";
$route['editOld'] = "user/editOld";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editUser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";
$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";
$route['login-history'] = "user/loginHistoy";
$route['login-history/(:num)'] = "user/loginHistoy/$1";
$route['login-history/(:num)/(:num)'] = "user/loginHistoy/$1/$2";

$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

//Admin Routes
$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';
$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";
$route['allBids'] = 'listings/allBids';
$route['allBids/(:num)'] = "listings/allBids/$1";
$route['manageCategories'] = 'listings/manageCategories';
$route['manageCategories/(:num)'] = "listings/manageCategories/$1";


$route['view-buyer-listing'] = "listings/view_buyer_listing";
$route['view-buyer-listing/(:num)'] = 'listings/view_buyer_listing/$1';
$route['viewuserbid/(:num)/(:num)'] = 'listings/viewuserbid/$1/$2';

$route['userallListings/(:any)/(:num)'] = "listings/allListings/$1/$2";


$route['allFixed'] = "listings/allFixed";
$route['allListings'] = "listings/allListings";
$route['allListings/(:num)'] = "listings/allListings/$1";
$route['viewListings/(:num)'] = "listings/viewListings/$1";
$route['viewfixedListings/(:num)'] = "listings/viewfixedListings/$1";

$route['viewUser/(:num)'] = "listings/viewUser/$1";
$route['relist'] = "listings/relist";

$route['addNew'] = "user/addNew";
$route['Categories'] = "user/Category";
$route['Categories/(:num)'] = "user/Category/$1";
$route['addmanufacturer'] = 'user/addmanufacturer';
$route['allmanufacturers'] = 'user/allmanufacturers';
$route['allmanufacturers/(:num)'] = "user/allmanufacturers/$1";
$route['deleteList'] = "user/deleteList";
$route['deleteBid'] = "user/deleteBid";
$route['list-settings'] = "user/list_settings";
$route['allcontacts'] = "user/allcontacts";
$route['allcontacts/(:num)'] = "user/allcontacts/$1";
$route['viewContact/(:num)'] = "user/viewContact/$1";



/* End of file routes.php */
/* Location: ./application/config/routes.php */