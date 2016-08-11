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
$route['default_controller'] = 'fraud/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['loginform'] = 'fraud/loginform';
$route['login'] = 'fraud/login';
$route['home'] = 'fraud/home';
$route['logout'] = 'fraud/logout';

//---------Admin------------
$route['userform'] = 'fraud/userform';
$route['edituserform'] = 'fraud/edituserform';
$route['paramform'] = 'fraud/paramform';
$route['user'] = 'fraud/user';
$route['register'] = 'fraud/register';
$route['edituser'] = 'fraud/edituser';
$route['addcaseparam'] = 'fraud/addcaseparam';
$route['addactparam'] = 'fraud/addactparam';
$route['changecaseparam/(:any)'] = 'fraud/changecaseparam/$1';
$route['changeactparam/(:any)'] = 'fraud/changeactparam/$1';
$route['editcaseparam'] = 'fraud/editcaseparam';
$route['editactparam'] = 'fraud/editactparam';
$route['admin'] = 'fraud/admin';

//---------User------------
$route['user'] = 'fraud/user';
$route['caseform'] = 'fraud/caseform';
$route['search'] = 'fraud/search';
$route['downloadsearch'] = 'fraud/downloadsearch';
$route['downloadsearchnumber/(:any)/(:any)'] = 'fraud/downloadsearchnumber/$1/$2';
$route['downloadsearchdate/(:any)/(:any)/(:any)'] = 'fraud/downloadsearchdate/$1/$2/$3';
$route['downloadsearchinputdate/(:any)/(:any)/(:any)'] = 'fraud/downloadsearchinputdate/$1/$2/$3';
$route['downloadsearchcustomer/(:any)/(:any)'] = 'fraud/downloadsearchcustomer/$1/$2';
$route['downloadsearcham/(:any)/(:any)'] = 'fraud/downloadsearcham/$1/$2';
$route['searchnumber'] = 'fraud/searchnumber';
$route['searchdate'] = 'fraud/searchdate';
$route['searchinputdate'] = 'fraud/searchinputdate';
$route['searcham'] = 'fraud/searcham';
$route['searchcustomer'] = 'fraud/searchcustomer';
$route['listprofile'] = 'fraud/listprofile';
$route['cases/(:any)'] = 'fraud/cases/$1';
$route['insertcase'] = 'fraud/insertcase';
$route['addactivity'] = 'fraud/addactivity';
$route['editingprofile/(:any)'] = 'fraud/editingprofile/$1';
$route['checkprofile'] = 'fraud/checkprofile';
$route['editingprofileprocess'] = 'fraud/editingprofileprocess';
$route['getact/(:any)'] = 'fraud/getact/$1';
$route['getcase/(:any)'] = 'fraud/getcase/$1';