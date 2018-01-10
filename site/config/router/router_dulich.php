<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* File router_dulich 
* Date: 07/04/13 10:15:40.
**/
$route['thong-tin-du-lich'] = 'dulich/index';
$route['thong-tin-du-lich/(:num)'] = 'dulich/index/$1';
$route['thong-tin-du-lich/danh-lam-thang-canh'] = 'dulich/cat';
$route['thong-tin-du-lich/danh-lam-thang-canh/(:num)'] = 'dulich/cat/$1';
$route['thong-tin-du-lich/danh-lam-thang-canh/(:num)/(:any)'] = 'dulich/cat/$1/$2';
$route['thong-tin-du-lich/van-hoa-am-thuc'] = 'dulich/cat';
$route['thong-tin-du-lich/van-hoa-am-thuc/(:num)'] = 'dulich/cat/$1';
$route['thong-tin-du-lich/van-hoa-am-thuc/(:num)/(:any)'] = 'dulich/cat/$1/$2';
$route['thong-tin-du-lich/kham-pha'] = 'dulich/cat';
$route['thong-tin-du-lich/kham-pha/(:num)'] = 'dulich/cat/$1';
$route['thong-tin-du-lich/kham-pha/(:num)/(:any)'] = 'dulich/cat/$1/$2';
$route['thong-tin-du-lich/(:any)'] = 'dulich/detail/$1';