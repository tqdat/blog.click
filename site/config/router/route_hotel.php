<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* File route_news 
* Date: 13/06/17 14:55:06.
**/
$route['khach-san'] = 'khachsan/index';
$route['khach-san/(:num)'] = 'khachsan/index/$1';
$route['khach-san/khach-san-da-nang'] = 'khachsan/cat';
$route['khach-san/khach-san-da-nang/(:num)'] = 'khachsan/cat/$1';
$route['khach-san/khach-san-hoi-an'] = 'khachsan/cat';
$route['khach-san/khach-san-hoi-an/(:num)'] = 'khachsan/cat/$1';
$route['khach-san/khach-san-nha-trang'] = 'khachsan/cat';
$route['khach-san/khach-san-nha-trang/(:num)'] = 'khachsan/cat/$1';
$route['khach-san/khach-san-phu-quoc'] = 'khachsan/cat';
$route['khach-san/khach-san-phu-quoc/(:num)'] = 'khachsan/cat/$1';
$route['khach-san/khach-san-quy-nhon'] = 'khachsan/cat';
$route['khach-san/khach-san-quy-nhon/(:num)'] = 'khachsan/cat/$1';
$route['khach-san/khach-san-hue'] = 'khachsan/cat';
$route['khach-san/khach-san-hue/(:num)'] = 'khachsan/cat/$1';
$route['khach-san/(:any)'] = 'khachsan/detail/$1';