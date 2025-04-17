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
$route['default_controller'] = 'welcome';  // Halaman default saat aplikasi pertama kali diakses
$route['404_override'] = '';  // Menentukan halaman error 404
$route['translate_uri_dashes'] = FALSE;  // Menentukan apakah menggunakan dash dalam URL

// Rute untuk login, registrasi, dan logout
$route['auth/login'] = 'auth/login';  // Rute login
$route['auth/register'] = 'auth/register';  // Rute registrasi
$route['auth/logout'] = 'auth/logout';  // Rute logout

// Rute untuk dashboard
$route['dashboard'] = 'dashboard/index';  // Rute untuk admin dashboard
$route['dashboard/user_dashboard'] = 'dashboard/user_dashboard';  // Rute untuk user dashboard
$route['dashboard/vote_stats'] = 'dashboard/vote_stats';  // Rute untuk melihat statistik voting (hanya untuk user)

$route['dashboard/add_candidate'] = 'dashboard/add_candidate';
$route['dashboard/edit_candidate/(:num)'] = 'dashboard/edit_candidate/$1';
$route['dashboard/delete_candidate/(:num)'] = 'dashboard/delete_candidate/$1';
// Rute untuk halaman-halaman admin
$route['dashboard/admin_dashboard'] = 'dashboard/index';  // Admin masuk ke admin dashboard
$route['auth/login'] = 'auth/login';
$route['auth/register'] = 'auth/register';
$route['dashboard'] = 'dashboard';
$route['dashboard/user_dashboard'] = 'dashboard/user_dashboard';
// Rute lainnya sesuai kebutuhan
// (Tambahkan rute sesuai dengan controller dan metode yang diperlukan dalam aplikasi)