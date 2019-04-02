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
|	http://codeigniter.com/user_guide/general/routing.html
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

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['schedules/(:any)'] = "schedules/index/$1";
$route['schedules/(:any)/ajax_page'] = "schedules/ajax_page";
$route['schedules/ajax_add_schedules'] = "schedules/ajax_add_schedules";
$route['schedules/ajax_enable_activity'] = "schedules/ajax_enable_activity";
$route['schedules/ajax_add_multi_schedules'] = "schedules/ajax_add_multi_schedules";
$route['schedules/ajax_action_multiple'] = "schedules/ajax_action_multiple";
$route['schedules/ajax_action_all_activity'] = "schedules/ajax_action_all_activity";
$route['schedules/save_schedules'] = "schedules/save_schedules";
$route['language'] = "blocks/language";

$route['save/(:any)'] = "save/index/$1";
$route['save/ajax_save'] = "save/ajax_save";
$route['save/ajax_get_save'] = "save/ajax_get_save";
$route['save/ajax_action_multiple'] = "save/ajax_action_multiple";
$route['save/ajax_action_item'] = "save/ajax_action_item";

$route['login'] = "home/login";
$route['forgot_password'] = "home/forgot_password";
$route['reset_password'] = "home/reset_password";
$route['contact'] = "home/contact";
$route['timezone'] = "home/timezone";
$route['add_account'] = "home/add_account";
$route['register'] = "home/register";
$route['logout'] = "home/logout";
$route['profile'] = "user_management/profile";
$route['openid/(:any)'] = 'user_management/openid/$1';
$route['oauth/facebook'] = "home/facebook";
$route['oauth/google'] = "home/google";
$route['oauth/twitter'] = "home/twitter";
$route['payments/notify_payment_recurring.php'] = "payments/notify_payment_recurring";

$route['dashboard'] = "activity";
