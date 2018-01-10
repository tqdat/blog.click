<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* File router_product 
* Date: 08/05/15 06:21:41.
**/
$route['tin-tuc'] = 'news/index';
$route['tin-tuc/(:num)'] = 'news/index/$1';
$route['tin-tuc/san-pham/(:any)'] = 'news/cat/$1';
$route['tin-tuc/tuyen-dung/(:any)'] = 'news/cat/$1';
$route['tin-tuc/hoat-dong-cong-ty/(:any)'] = 'news/cat/$1';
$route['tin-tuc/kinh-nghiem/(:any)'] = 'news/cat/$1';
$route['hosting'] = 'news/index';
$route['hosting/(:num)'] = 'news/index/$1';
$route['gioi-thieu'] = 'news/index';
$route['gioi-thieu/(:num)'] = 'news/index/$1';
$route['domain'] = 'news/index';
$route['domain/(:num)'] = 'news/index/$1';
$route['dich-vu'] = 'news/index';
$route['dich-vu/(:num)'] = 'news/index/$1';
$route['tin-tuc/(:any)'] = 'news/detail/$1';
$route['hosting/(:any)'] = 'news/detail/$1';
$route['gioi-thieu/(:any)'] = 'news/detail/$1';
$route['domain/(:any)'] = 'news/detail/$1';
$route['dich-vu/(:any)'] = 'news/detail/$1';