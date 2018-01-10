<?php
class cpanel extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('admincp_model','admincp');
    }
    
    function index(){
        $data['title'] = "Bảng điều khiển";
        $this->load->templates('index',$data);
        $begin = strtotime('2013-03-12');
        //var_dump($begin);
        //die();
        /*$end = strtotime('2014-03-19');
        for ($i = $begin; $i<= $end; $i = $i+86400) {  
                $ngay = date('Y-m-d',$i);
                $nam = explode('-',$ngay);
                //echo date("Y-m-d", $i).'<br />';
                $vdata['ngay_full'] = $ngay;
                $vdata['ngay'] = $nam[2];
                $vdata['thang'] = $nam[1];
                $vdata['nam'] = $nam[0];
                $this->db->insert('ngay',$vdata);
        }         
        /*
        
        $ar_thu2 = $this->thu_ngay_nam("Today", "+1 year", 1);
        for($i = 0 ; $i < sizeof($ar_thu2);$i++){
            if(!$this->kiemtra_thu_ngay(2,$ar_thu2[$i])){
                $nam = explode('-',$ar_thu2[$i]);
                $vdata['thu'] = 2;
                $vdata['ngay_full'] = $ar_thu2[$i];
                $vdata['ngay'] = $nam[2];
                $vdata['thang'] = $nam[1];
                $vdata['nam'] = $nam[0];
                $this->db->insert('ngay',$vdata);
            }

        } 
        $ar_thu3 = $this->thu_ngay_nam("Today", "+1 year", 2);
        for($i = 0 ; $i < sizeof($ar_thu3);$i++){
            if(!$this->kiemtra_thu_ngay(3,$ar_thu3[$i])){
                $nam = explode('-',$ar_thu3[$i]);
                $vdata['thu'] = 3;
                $vdata['ngay_full'] = $ar_thu3[$i];
                $vdata['ngay'] = $nam[2];
                $vdata['thang'] = $nam[1];
                $vdata['nam'] = $nam[0];
                $this->db->insert('ngay',$vdata);
            }

        } 
        $ar_thu4 = $this->thu_ngay_nam("Today", "+1 year", 3);
        for($i = 0 ; $i < sizeof($ar_thu4);$i++){
            if(!$this->kiemtra_thu_ngay(4,$ar_thu4[$i])){
                $nam = explode('-',$ar_thu4[$i]);
                $vdata['thu'] = 4;
                $vdata['ngay_full'] = $ar_thu4[$i];
                $vdata['ngay'] = $nam[2];
                $vdata['thang'] = $nam[1];
                $vdata['nam'] = $nam[0];
                $this->db->insert('ngay',$vdata);
            }

        } 
        $ar_thu5 = $this->thu_ngay_nam("Today", "+1 year", 4);
        for($i = 0 ; $i < sizeof($ar_thu5);$i++){
            if(!$this->kiemtra_thu_ngay(5,$ar_thu5[$i])){
                $nam = explode('-',$ar_thu5[$i]);
                $vdata['thu'] = 5;
                $vdata['ngay_full'] = $ar_thu5[$i];
                $vdata['ngay'] = $nam[2];
                $vdata['thang'] = $nam[1];
                $vdata['nam'] = $nam[0];
                $this->db->insert('ngay',$vdata);
            }

        }  
        $ar_thu6 = $this->thu_ngay_nam("Today", "+1 year", 5);
        for($i = 0 ; $i < sizeof($ar_thu6);$i++){
            if(!$this->kiemtra_thu_ngay(6,$ar_thu6[$i])){
                $nam = explode('-',$ar_thu6[$i]);
                $vdata['thu'] = 6;
                $vdata['ngay_full'] = $ar_thu6[$i];
                $vdata['ngay'] = $nam[2];
                $vdata['thang'] = $nam[1];
                $vdata['nam'] = $nam[0];
                $this->db->insert('ngay',$vdata);
            }

        } 
        $ar_thu7 = $this->thu_ngay_nam("Today", "+1 year", 6);
        for($i = 0 ; $i < sizeof($ar_thu7);$i++){
            if(!$this->kiemtra_thu_ngay(7,$ar_thu7[$i])){
                $nam = explode('-',$ar_thu7[$i]);
                $vdata['thu'] = 7;
                $vdata['ngay_full'] = $ar_thu7[$i];
                $vdata['ngay'] = $nam[2];
                $vdata['thang'] = $nam[1];
                $vdata['nam'] = $nam[0];
                $this->db->insert('ngay',$vdata);
            }
        } 
        $ar_cn = $this->thu_ngay_nam("Today", "+1 year", 0);
        for($i = 0 ; $i < sizeof($ar_cn);$i++){
            if(!$this->kiemtra_thu_ngay(8,$ar_cn[$i])){
                $nam = explode('-',$ar_cn[$i]);
                $vdata['thu'] = 8;
                $vdata['ngay_full'] = $ar_cn[$i];
                $vdata['ngay'] = $nam[2];
                $vdata['thang'] = $nam[1];
                $vdata['nam'] = $nam[0];
                $this->db->insert('ngay',$vdata);
            }
        }   */
        
    }
    
    function thu_ngay_nam($start, $end, $weekday = 0){

        $weekdays="Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday";
        $arr_weekdays=split(",", $weekdays);
        $weekday = $arr_weekdays[$weekday];
        if(!$weekday)
            die("Invalid Weekday!");

        $start= strtotime("+0 day", strtotime($start) );
        $end= strtotime($end);

        $dateArr = array();
        $friday = strtotime($weekday, $start);
        while($friday <= $end)
        {
            $dateArr[] = date("Y-m-d", $friday);
            $friday = strtotime("+1 weeks", $friday);
        }
        $dateArr[] = date("Y-m-d", $friday);
        return $dateArr;

    }
    
    function kiemtra_thu_ngay($thu,$ngay){
        $sql = "
            SELECT id FROM ngay WHERE ngay_full = '$ngay'
        ";
        $row = $this->db->row($sql);
        if($row){
            return true;
        }else{
            return false;
        }
        /*
        $this->db->where('ngay_full',$ngay);
        $row = $this->db->get('cc_ngay')->row();
        if($row){
            return true;
        }else{
            return false;
        }*/
    }
}
