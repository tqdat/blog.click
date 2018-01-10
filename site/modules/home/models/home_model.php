<?php
class home_model extends model{
    function __construct(){
        parent::__construct();
    }

    function get_news_hot(){
        return $this->db->result("SELECT * FROM news WHERE published = 1 AND noibat = 1 ORDER BY id DESC LIMIT 3");
    }
    
	function get_tour_noibat(){
         $sql = "SELECT * FROM tour WHERE published = '1' AND noibat = '1' ORDER BY id DESC LIMIT 8";
         return $this->db->result($sql);
    }
	
	function get_tour_khuyenmai(){
         $sql = "SELECT * FROM tour WHERE published = '1' AND khuyenmai = '1' ORDER BY id DESC LIMIT 8";
         return $this->db->result($sql);
    }
	
	function get_hotel_noibat(){
         $sql = "SELECT * FROM hotel WHERE published = '1' AND noibat = '1' ORDER BY id DESC LIMIT 3";
         return $this->db->result($sql);
    }
	
    function get_tour_banchay($top_tour){
         $sql = "SELECT * FROM tour WHERE id IN ($top_tour)";
         return $this->db->result($sql);
    }
    function get_list_cat($parent_id = 0){
        $sql = "SELECT cat_id, parent_id FROM tour_cat WHERE parent_id = $parent_id";
        return $this->db->result($sql);
    }
    function get_str_ar_cat($cat_id){
        $str_cat = $cat_id.',';
        $list = $this->get_list_cat($cat_id);
        foreach($list as $rs):
            $str_cat .=$rs->cat_id.',';
        endforeach;
        return rtrim($str_cat,',');
    }
    function get_last_tour(){
        $sql = "SELECT * FROM tour ORDER BY id DESC LIMIT 9";
        return $this->db->result($sql);
    }
    function getTourByCatID($catid){
        
        $sql = "SELECT * FROM tour WHERE published=1";
        //$sql .= " AND ";
        $catid_ = explode(',',$this->get_str_ar_cat($catid));
           if(sizeof($catid_) > 0){
                
                $sql .= " AND ( ";
                $i=0;
                foreach($catid_ as $catids){
                $sql .=" (cat_id like '%,$catids' OR cat_id like '$catids,%' OR cat_id like '%,$catids,%' OR cat_id = '$catids') ";    
                $i++;
                if($i<count($catid_))
                    $sql .= " OR  ";
                }                      
                $sql .= " ) ";
            }
       // $sql .=" (cat_id like '%,$catid' OR cat_id like '$catid,%' OR cat_id like '%,$catid,%' OR cat_id = '$catid') ";            
        $sql .= "ORDER BY created DESC, noibat DESC LIMIT 8";
       // die($sql);
        return $this->db->result($sql);
    }
    function getHomeCat($parentid=0){
        $sql = "SELECT cat_id, parent_id, name, name_small, slug, des FROM tour_cat WHERE published = 1 AND parent_id = $parentid";       
        $sql .=" AND is_homepage = 1";    
        $sql .=" ORDER BY ordering ASC";
        return $this->db->result($sql);
    }
    function get_city_by_id($city_id){
        return $this->db->row("SELECT city_name FROM city WHERE city_id = $city_id");
    }

}
