<?php 
@session_start();
define('ROOT','');
define('EXT','.php');
define('DS',DIRECTORY_SEPARATOR);
$system_path = 'vcore';
$system_path = realpath($system_path).'/';
$app_path = 'site';
$app_path = realpath($app_path).'/';
define('BASEPATH', str_replace("\\", "/", $system_path));
define('APPPATH', 'site/');
define('APP_ROOT', str_replace("\\", "/", $app_path));
define('URL_NEWS', 'http://localhost/2013/congdulich/tintuc/');
define('SERVER_UPLOAD_IMG', 'http://localhost/2013/congdulich/common/');
require ROOT.'vcore/startup.php';
?>
