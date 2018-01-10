<?php
$route['(:num)-(:any)'] = 'tour/detail';
$route['tour'] = 'tour/index'; 
$route['tour/(:num)'] = 'tour/index/$1';
$route['dat-tour/(:any)'] = 'tour/booking/$1'; 
