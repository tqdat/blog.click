<?php
require_once ROOT.'vcore/library/Mobile_Detect.php';
class imobile{
    function __construct(){
        $this->V =& get_instance();
        $this->check_mobile();
        
    }
    
    function check_mobile(){
        $detect = new Mobile_Detect;
        $check = ($detect->isMobile())?'phone':'computer';
        $session_mobile = $this->V->session->data['phone'];
        $uri_string = uri_string(); 
        $uri =  str_replace($this->V->config->item('suff'),'',$uri_string);
        if($session_mobile == ''){
            $this->V->session->data['phone'] = $check;
            if($check == 'phone'){
                header('Location: http://m.danangxanh.vn/'.$uri);
                exit;
            }            
        }else{
            if($session_mobile == 'phone'){
                header('Location: http://m.danangxanh.vn/'.$uri);
                exit;
            }
        }
    }
}
