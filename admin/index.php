<?php 
@session_start();
define('CORE','../');
define('SITE','../');
define('ROOT','../');
define('EXT','.php');
define('DS',DIRECTORY_SEPARATOR);
$system_path = ROOT.'vcore';
$system_path = realpath($system_path).'/';
$app_path = 'pghadmin';
$app_path = realpath($app_path).'/';
define('BASEPATH', str_replace("\\", "/", $system_path));
define('APPPATH', ROOT.'admin/');
define('ADMIN_NAME', 'admin');
define('APP_ROOT', str_replace("\\", "/", $app_path));
require ROOT.'vcore/startup.php';

