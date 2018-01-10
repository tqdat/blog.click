<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* File route_news 
* Date: 10/01/18 11:13:28.
**/
$route['tin-tuc'] = 'news/index';
$route['tin-tuc/(:num)'] = 'news/index/$1';
$route['am-thuc'] = 'news/index';
$route['am-thuc/(:num)'] = 'news/index/$1';
$route['diem-den'] = 'news/index';
$route['diem-den/(:num)'] = 'news/index/$1';
$route['kinh-nghiem'] = 'news/index';
$route['kinh-nghiem/(:num)'] = 'news/index/$1';
$route['le-hoi'] = 'news/index';
$route['le-hoi/(:num)'] = 'news/index/$1';
$route['khuyen-mai'] = 'news/index';
$route['khuyen-mai/(:num)'] = 'news/index/$1';
$route['hoi-dap'] = 'news/index';
$route['hoi-dap/(:num)'] = 'news/index/$1';
$route['tin-tuc/(:any)'] = 'news/detail/$1';
$route['am-thuc/(:any)'] = 'news/detail/$1';
$route['diem-den/(:any)'] = 'news/detail/$1';
$route['kinh-nghiem/(:any)'] = 'news/detail/$1';
$route['le-hoi/(:any)'] = 'news/detail/$1';
$route['khuyen-mai/(:any)'] = 'news/detail/$1';
$route['hoi-dap/(:any)'] = 'news/detail/$1';