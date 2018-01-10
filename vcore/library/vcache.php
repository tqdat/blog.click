<?php
class vcache{
    function __construct(){
        $this->V =& get_instance();
    }
    
    
    function slider(){
        $html = '';
        $file      = ROOT."site/cache/slider/my.db" ;
        if(file_exists($file)){
            $html = @file_get_contents($file);
        }else{
            $list = $this->V->db->result("SELECT * FROM slideshow ORDER BY id_slide DESC");
            $html .='<link type="text/css" rel="stylesheet" href="'.base_url().'templates/css/skitter.styles.css" media="screen">';
            $html .='<script type="text/javascript" src="'.base_url().'templates/js/jquery.easing.1.3.js" charset="UTF-8"></script>';
            $html .='<script type="text/javascript" src="'.base_url().'templates/js/jquery.skitter.min.js" charset="UTF-8"></script>';
            $html .='<script type="text/javascript" language="javascript">';
            $html .='$(document).ready(function() {
                $(\'.box_skitter_large\').skitter({
                    theme: \'clean\',
                    numbers_align: \'center\',
                    progressbar: true, 
                    dots: true, 
                    interval: 9000,
                    preview: true
                });
            });';
            $html .='</script>';
            $html .='<div class="box_skitter box_skitter_large">';
            $html .='<ul>';
            $items = Array('cube','circlesInside','circlesRotate');
            $type = $items[array_rand($items)];
            foreach($list as $val):
                $html .='<li><a href="'.$val->links.'"><img src="'.base_url().$val->images.'" alt="'.$val->ten.'" class="'.$type.'"></a></li>';
                //<div class="label_text"><p>'.$val->ten.'</p></div>
            endforeach;
            $html .='</ul>';
            $html .='</div>';
            if(!empty($html)){
                @file_put_contents($file, $html);
            }
        }
        return $html;
    }
    
    function show_adv($name){
        $adv = $this->V->mem_cached->get('adv_'.$name);
        if(!$adv){
            $h_ad_1 = $this->V->config->item($name);
            $str = '';
            if($h_ad_1 != ''){
                $str .= '<script language="javascript">';
                $str .= "$name = new Banner('".$name."');";
                $ad = explode('|',$h_ad_1);
                for($i = 0; $i < sizeof($ad); $i++){
                $str .= $name.'.add('.$ad[$i].');';
                $str .= 'document.write('.$name.');';
                $str .= $name.'.start();';
                $str .= '</script>';
                }
            }
            $this->V->mem_cached->save('adv_'.$name,$str,360);
            $adv = $str;
        }
        return $adv;
    }
    
    function delcache($dir="")
    {
        if ($handle = opendir($dir)) {
                while (false !== ($file = readdir($handle))) {
                    if(strlen($file)>4 && file_exists($dir.'/'.$file)){
                        chmod($dir.'/'.$file,0777);
                        unlink($dir.'/'.$file);
                    }                
            }
        }
    }


    

}
