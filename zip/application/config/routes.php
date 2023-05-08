<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// echo "hiiiiiii";exit();
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
|	https://codeigniter.com/userguide3/general/routing.html
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



$front_prefix												= 'classifieds_admin/';
$route['default_controller'] = 'classifieds_admin/user';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['classifieds_admin'] 										= 'classifieds_admin/user';
// $route['classifieds_admin/signup'] 									= $front_prefix.'user/signup';
// $route['classifieds_admin/email_exist'] 							= $front_prefix.'user/email_exist';
// $route['classifieds_admin/login'] 									= $front_prefix.'user/login';
// $route['classifieds_admin/dashboard'] 								= $front_prefix.'user/dashboard';
// $route['classifieds_admin/logout'] 									= $front_prefix.'user/logout';
// $route['classifieds_admin/register'] 								= $front_prefix.'registration';
$route['classifieds_admin/(:any)'] 										= 'classifieds_admin/$1';
$route['classifieds_admin/(:any)/(:any)'] 						    = 'classifieds_admin/$1/$2';
$route['classifieds_admin/(:any)/(:any)/(:any)'] 					= 'classifieds_admin/$1/$2/$3';
$route['classifieds_admin/(:any)/(:any)/(:any)/(:any)'] 			= 'classifieds_admin/$1/$2/$3/$4';
