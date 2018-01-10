<?php
$route['default_controller'] = "home";
$route['404_override'] = '';
require_once(ROOT."site/config/router/router_tour.php");
require_once(ROOT."site/config/router/router_chude.php");
require_once(ROOT."site/config/router/route_news.php");
if ($handle = opendir(APPPATH."modules")) {
    /* This is the correct way to loop over the directory. */
    while (false !== ($modules = readdir($handle))) {
        if ($modules != "." && $modules != "..") {
            if(file_exists(APPPATH."modules/".$modules.'/config/routes.php')){
                require APPPATH."modules/".$modules."/config/routes.php";
            }
        }        
    }
    closedir($handle);
}