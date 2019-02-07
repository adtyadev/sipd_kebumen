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
$route['default_controller'] = 'login_controller';
//$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login/(:any)'] = 'login_controller/$1';
$route['dashboard/(:any)'] = 'dashboard_controller/$1';
$route['pegawai/(:any)'] = 'pegawai_controller/$1';
$route['pegawai/(:any)/(:any)'] = 'pegawai_controller/$1/$2';
$route['perjalanan_dinas/(:any)'] = 'perjalanan_dinas_controller/$1';
$route['perjalanan_dinas/(:any)/(:any)'] = 'perjalanan_dinas_controller/$1/$2';
$route['surat_tugas/(:any)'] = 'surat_tugas_controller/$1';
$route['surat_tugas/(:any)/(:any)'] = 'surat_tugas_controller/$1/$2';
$route['surat_perintah_perjalanan_dinas/(:any)'] = 'surat_perintah_perjalanan_dinas_controller/$1';
$route['surat_perintah_perjalanan_dinas/(:any)/(:any)'] = 'surat_perintah_perjalanan_dinas_controller/$1/$2';
$route['biaya_perjalanan_pegawai/(:any)']='biaya_perjalanan_pegawai_controller/$1';
$route['biaya_perjalanan_pegawai/(:any)/(:any)']='biaya_perjalanan_pegawai_controller/$1/$2';
$route['biaya_harian/(:any)']='biaya_harian_controller/$1';
$route['biaya_harian/(:any)/(:any)']='biaya_harian_controller/$1/$2';
$route['biaya_penginapan/(:any)']='biaya_penginapan_controller/$1';
$route['biaya_penginapan/(:any)/(:any)']='biaya_penginapan_controller/$1/$2';
$route['biaya_transportasi_mobil/(:any)']='biaya_transportasi_mobil_controller/$1';
$route['biaya_transportasi_mobil/(:any)/(:any)']='biaya_transportasi_mobil_controller/$1/$2';
$route['welcome'] = 'welcome';
$route['golongan/(:any)'] = 'golongan_controller/$1';
$route['golongan/(:any)/(:any)'] = 'golongan_controller/$1/$2';
$route['transportasi/(:any)'] = 'transportasi_controller/$1';
$route['transportasi/(:any)/(:any)'] = 'transportasi_controller/$1/$2';

// http://localhost/[nama_folder]/index.php/[controller]/[method dalam controller]/[parameter controtller], 