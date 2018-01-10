<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* File router_product 
* Date: 01/04/13 15:38:58.
**/
$route['san-pham/salat'] = 'product/cat';
$route['san-pham/salat/(:any)'] = 'product/cat/$1';
$route['san-pham/bao-ngu'] = 'product/cat';
$route['san-pham/bao-ngu/(:any)'] = 'product/cat/$1';
$route['san-pham/nom'] = 'product/cat';
$route['san-pham/nom/(:any)'] = 'product/cat/$1';
$route['san-pham/thuc-don-trong-ngay'] = 'product/cat';
$route['san-pham/thuc-don-trong-ngay/(:any)'] = 'product/cat/$1';
$route['san-pham/(:any)'] = 'product/detail/$1';