<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Change Size
function vnit_order($url,$name) { 
    $CI = get_instance();
    $field = $CI->request->get['f'];
    $order = $CI->request->get['o'];
    
    $s_url = explode('?',$url);
    $f = get_params('f',$s_url[1]);
    $o = get_params('o',$s_url[1]);
    if($field == $f){
        if($order == $o){
            $select = ($order=='asc')?'desc':'asc';
            if($o == 'asc'){
                $url = str_replace('asc','desc',$url);
            }else{
                $url = str_replace('desc','asc',$url);
            }
            
            return '<a class="'.$select.'" href="'.base_url().$url.'">'.$name.'</a>';
        }else{
            return '<a class="desc" href="'.base_url().$url.'">'.$name.'</a>'; 
        }
        
                
    }else{
        return '<a href="'.base_url().$url.'">'.$name.'</a>';
    }
    
    /*
    // Phan tich url truyen vao
    $url_page = explode('/',$url);
    $field = $url_page[count($url_page)-2];
    if(strpos('asc', end(explode('/',$url))) === false){
        $order = 'desc';
    }else{
        $order = 'asc';
    }
    //echo $order;
    
    
    // Phan tich Url page
    
    $url_site = explode('/',uri_string());
    $field_url = $url_site[count($url_site)-2];
    //$order_url = end(explode('/',uri_string())); 
    if(strpos('asc', end(explode('/',uri_string()))) === false){
        $order_url = 'desc';
    }else{
        $order_url = 'asc';
    }
    //echo '='.$order_url;
    if($field == $field_url){
        if($order != $order_url){
            $class_order = $order_url;  
            $order_new = ($order_url == 'asc')?'desc':'asc';
            $url =  str_replace($order_url,$order_new,$url);
            $select = ($order_url=='asc')?'asc':'desc';

            return '<a class="'.$select.'" href="'.base_url().$url.'">'.$name.'</a>';
        }else{
            
          return '<a class="desc" href="'.base_url().$url.'">'.$name.'</a>';    
        }
    }else{
        return '<a href="'.base_url().$url.'">'.$name.'</a>';
    }
    */
    //return '<a class="'.$select.'" href="'.base_url().$url.'">'.$name.'</a>';
    //return '<a class="desc" href="'.base_url().$url.'">'.$name.'</a>';    
    
}
?>