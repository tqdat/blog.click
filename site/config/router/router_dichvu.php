<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* File router_dulich 
* Date: 18/07/13 23:24:37.
**/
$route['dich-vu'] = 'dichvu/index';
$route['dich-vu/(:num)'] = 'dichvu/index/$1';
$route['dich-vu/van-chuyen'] = 'dichvu/cat';
$route['dich-vu/van-chuyen/(:num)'] = 'dichvu/cat/$1';
$route['dich-vu/van-chuyen/(:num)/(:any)'] = 'dichvu/cat/$1/$2';
$route['dich-vu/dia-diem-vui-choi'] = 'dichvu/cat';
$route['dich-vu/dia-diem-vui-choi/(:num)'] = 'dichvu/cat/$1';
$route['dich-vu/dia-diem-vui-choi/(:num)/(:any)'] = 'dichvu/cat/$1/$2';
$route['dich-vu/dia-diem-an-uong'] = 'dichvu/cat';
$route['dich-vu/dia-diem-an-uong/(:num)'] = 'dichvu/cat/$1';
$route['dich-vu/dia-diem-an-uong/(:num)/(:any)'] = 'dichvu/cat/$1/$2';
$route['dich-vu/diem-mua-sam-luu-niem'] = 'dichvu/cat';
$route['dich-vu/diem-mua-sam-luu-niem/(:num)'] = 'dichvu/cat/$1';
$route['dich-vu/diem-mua-sam-luu-niem/(:num)/(:any)'] = 'dichvu/cat/$1/$2';
$route['dich-vu/(:any)'] = 'dichvu/detail/$1';