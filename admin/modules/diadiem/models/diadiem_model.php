<?php
class diadiem_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all($limit, $offset, $s = '', $c = 0){
        $sql = "SELECT * FROM diadiem WHERE d_id != 0";
        if($c != 0){
            $sql .= " AND catid = $c";
        }else{
            $ar_id = $this->get_ar_city($s);
            $sql .= " AND catid IN ($ar_id)";
        }
        $sql .=" ORDER BY catid ASC, d_order ASC LIMIT $limit OFFSET $offset";
        return $this->db->result($sql);
    }
    
    function get_num($s = '', $c = 0){
        $sql = "SELECT d_id FROM diadiem WHERE d_id != 0";
        if($c != 0){
            $sql .= " AND catid = $c";
        }else{
            $ar_id = $this->get_ar_city($s);
            $sql .= " AND catid IN ($ar_id)";
        }
        return $this->db->num_rows($sql);
    }
    
    function total_hotel($id){
        return $this->db->num_rows("SELECT hotel_id FROM hotel WHERE vitri_id = $id");
    }
    
    function get_all_quocgia(){
        return $this->db->result("SELECT * FROM country ORDER BY ct_name ASC");
    }
    
    function get_all_city($ct_id){
        return $this->db->result("SELECT * FROM city WHERE parentid = 0 AND ct_id = '$ct_id' ORDER BY ordering asc");
    }
    
    function get_item_quocgia($ct_id){
        return $this->db->row("SELECT * FROM country WHERE ct_id = '$ct_id'");
    }
    
    function get_item_city($city_id){
        return $this->db->row("SELECT city_id, city_name FROM city WHERE city_id = $city_id");
    }
    
    function get_ar_city($c){
        $list = $this->get_all_city($c);
        $str = '';
        foreach($list as $rs):
            $str .=','.$rs->city_id;
        endforeach;
        $str = ltrim($str,',');

        return $str;
    }
}
