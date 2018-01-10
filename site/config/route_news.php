<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* File route_news 
* Date: 23/12/13 14:39:44.
**/
$route['thong-tin-du-lich/tin-tuc-su-kien'] = 'news/cat';
$route['thong-tin-du-lich/tin-tuc-su-kien/(:num)'] = 'news/cat/$1';
$route['thong-tin-du-lich/tin-tuc-su-kien/(:any)'] = 'news/detail/$1';
$route['thong-tin-du-lich/thong-tin-khuyen-mai'] = 'news/cat';
$route['thong-tin-du-lich/thong-tin-khuyen-mai/(:num)'] = 'news/cat/$1';
$route['thong-tin-du-lich/thong-tin-khuyen-mai/(:any)'] = 'news/detail/$1';