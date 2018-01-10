<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* File router_product 
* Date: 08/05/15 06:21:41.
**/
$route['khach-san'] = 'khachsan/index';
$route['khach-san/(:num)'] = 'khachsan/index/$1';
$route['khach-san/san-pham/(:any)'] = 'khachsan/cat/$1';
$route['khach-san/tuyen-dung/(:any)'] = 'khachsan/cat/$1';
$route['khach-san/hoat-dong-cong-ty/(:any)'] = 'khachsan/cat/$1';
$route['khach-san/kinh-nghiem/(:any)'] = 'khachsan/cat/$1';
$route['hosting'] = 'khachsan/index';
$route['hosting/(:num)'] = 'khachsan/index/$1';
$route['gioi-thieu'] = 'khachsan/index';
$route['gioi-thieu/(:num)'] = 'khachsan/index/$1';
$route['domain'] = 'khachsan/index';
$route['domain/(:num)'] = 'khachsan/index/$1';
$route['dich-vu'] = 'khachsan/index';
$route['dich-vu/(:num)'] = 'khachsan/index/$1';
$route['khach-san/(:any)'] = 'khachsan/detail/$1';
$route['hosting/(:any)'] = 'khachsan/detail/$1';
$route['gioi-thieu/(:any)'] = 'khachsan/detail/$1';
$route['domain/(:any)'] = 'khachsan/detail/$1';
$route['dich-vu/(:any)'] = 'khachsan/detail/$1';