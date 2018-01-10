<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* File Router_Tour 
* Date: 20/12/13 02:25:28.
**/
$route['dia-danh'] = 'diadanh/index';
$route['dia-danh/(:num)'] = 'diadanh/index/$1';
$route['dia-danh/khu-du-lich'] = 'diadanh/cat';
$route['dia-danh/khu-du-lich/(:num)'] = 'diadanh/cat/$1';
$route['dia-danh/du-lich-bien'] = 'diadanh/cat';
$route['dia-danh/du-lich-bien/(:num)'] = 'diadanh/cat/$1';
$route['dia-danh/di-tich'] = 'diadanh/cat';
$route['dia-danh/di-tich/(:num)'] = 'diadanh/cat/$1';
$route['dia-danh/nha-tho'] = 'diadanh/cat';
$route['dia-danh/nha-tho/(:num)'] = 'diadanh/cat/$1';
$route['dia-danh/den-chua'] = 'diadanh/cat';
$route['dia-danh/den-chua/(:num)'] = 'diadanh/cat/$1';
$route['dia-danh/le-hoi'] = 'diadanh/cat';
$route['dia-danh/le-hoi/(:num)'] = 'diadanh/cat/$1';
$route['dia-danh/truong-hoc'] = 'diadanh/cat';
$route['dia-danh/truong-hoc/(:num)'] = 'diadanh/cat/$1';
$route['dia-danh/sieu-thi-cho-lon'] = 'diadanh/cat';
$route['dia-danh/sieu-thi-cho-lon/(:num)'] = 'diadanh/cat/$1';
$route['dia-danh/khu-pho-lang-nghe'] = 'diadanh/cat';
$route['dia-danh/khu-pho-lang-nghe/(:num)'] = 'diadanh/cat/$1';
$route['dia-danh/san-bay-ben-xe-ga-tau'] = 'diadanh/cat';
$route['dia-danh/san-bay-ben-xe-ga-tau/(:num)'] = 'diadanh/cat/$1';
$route['dia-danh/dia-danh-khac'] = 'diadanh/cat';
$route['dia-danh/dia-danh-khac/(:num)'] = 'diadanh/cat/$1';
$route['dia-danh/(:any)'] = 'diadanh/detail/$1';