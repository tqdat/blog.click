<?php               
$route['khach-san'] = 'khachsan/index';
$route['khach-san/(:num)'] = 'khachsan/index/$1';
$route['khach-san/(:any)-(:num)'] = 'khachsan/detail/$1-$2'; 
$route['khach-san/(:any)'] = 'khachsan/cat/$1';     