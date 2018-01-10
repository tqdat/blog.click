<?php 
                
$route['w/(:any)'] = 'home/country/$1';
$route['c(:num)/(:any)'] = 'home/city/$1';
$route['d(:num)/(:any)'] = 'home/district/$1'; 