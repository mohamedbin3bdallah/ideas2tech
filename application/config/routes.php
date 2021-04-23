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
$route['default_controller'] = 'frontend/index-en';
$route['404_override'] = 'frontend/errorpage';
$route['404'] = 'frontend/errorpage';
$route['translate_uri_dashes'] = FALSE;
$route['index-en'] = 'frontend/index/en';
$route['index-ar'] = 'frontend/index/ar';
$route['contact-en'] = 'frontend/contact/en';
$route['contact-ar'] = 'frontend/contact/ar';
$route['about-en'] = 'frontend/about/en';
$route['about-ar'] = 'frontend/about/ar';
$route['message'] = 'frontend/message';
$route['news'] = 'frontend/news';
$route['new/(:any)'] = 'frontend/newd/$1';
$route['active/(:any)'] = 'frontend/active/$1/$2';
$route['services-en'] = 'frontend/services/en';
$route['services-ar'] = 'frontend/services/ar';
$route['faqs-en'] = 'frontend/faqs/en';
$route['faqs-ar'] = 'frontend/faqs/ar';
$route['projects-en'] = 'frontend/projects/en';
$route['projects-ar'] = 'frontend/projects/ar';
$route['login-en'] = 'frontend/login/en';
$route['login-ar'] = 'frontend/login/ar';
$route['logout-en'] = 'frontend/logout/en';
$route['logout-ar'] = 'frontend/logout/ar';
$route['plans-en/(:any)'] = 'frontend/plans/en/$1';
$route['plans-ar/(:any)'] = 'frontend/plans/ar/$1';
$route['orders-en'] = 'frontend/orders/en';
$route['orders-ar'] = 'frontend/orders/ar';
$route['pay-en'] = 'frontend/pay/en';
$route['pay-ar'] = 'frontend/pay/ar';
$route['pay_cancel-en'] = 'frontend/pay_cancel/en';
$route['pay_cancel-ar'] = 'frontend/pay_cancel/ar';
$route['pay_success-en/(:any)'] = 'frontend/pay_success/en/$1';
$route['pay_success-ar/(:any)'] = 'frontend/pay_success/ar/$1';
$route['registration-en'] = 'frontend/registration/en';
$route['registration-ar'] = 'frontend/registration/ar';
$route['sendmessage-en'] = 'frontend/sendmessage/en';
$route['sendmessage-ar'] = 'frontend/sendmessage/ar';
$route['reservation'] = 'frontend/reservation';
$route['reservationlog'] = 'frontend/reservationlog';
$route['register-en'] = 'frontend/register/en';
$route['register-ar'] = 'frontend/register/ar';
$route['userlog-en'] = 'frontend/userlog/en';
$route['userlog-ar'] = 'frontend/userlog/ar';
$route['email'] = 'frontend/email';
$route['saveemail'] = 'frontend/saveemail';
$route['forgotpassword-en'] = 'frontend/forgotpassword/en';
$route['forgotpassword-ar'] = 'frontend/forgotpassword/ar';
$route['newpassword-en'] = 'frontend/newpassword/en';
$route['newpassword-ar'] = 'frontend/newpassword/ar';