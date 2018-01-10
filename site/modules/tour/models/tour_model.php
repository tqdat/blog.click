<?php
class tour_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_index($limit, $offset){
        $sql = "
            SELECT * FROM tour WHERE published = 1
        ";
        $sql .=" ORDER BY id DESC, noibat, khuyenmai DESC LIMIT $limit OFFSET $offset";
        return $this->db->result($sql);
    }
    
    function get_num_index(){
        $sql = "SELECT id FROM tour WHERE published = 1";
        return $this->db->num_rows($sql);
    }
    function get_comment($idtour){
         return $this->db->result("SELECT * FROM tour_comment WHERE tour_id = $idtour AND published=1");
    }
    function get_comment_total($idtour){
        $sql = "SELECT * FROM tour_comment WHERE tour_id = $idtour AND published=1";
        return $this->db->num_rows($sql);
    }
    function get_sum_rating($idtour) {
        $sql = "select sum(star) as value from tour_comment where tour_id = $idtour AND published=1";
        return $this->db->row($sql)->value;
    }
    //Home cat
    function get_all_catindex($limit, $offset, $catid){
        $sql = "
            SELECT * FROM tour WHERE published = 1
        ";
        if($catid != ''){
           $catid_ = explode(',',$catid);
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
        }
        $sql .=" ORDER BY id DESC, noibat, khuyenmai DESC LIMIT $limit OFFSET $offset";
       
        return $this->db->result($sql);
    }

    function get_num_catindex($catid){
         $sql = "
            SELECT * FROM tour WHERE published = 1
        ";
        if($catid != ''){
           $catid_ = explode(',',$catid);
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
        }
        return $this->db->num_rows($sql);
    }
    
    
    function get_cat_by_slug($slug){
        $sql = "SELECT * FROM tour_cat WHERE slug = '$slug'";
        return $this->db->row($sql);
    }
    
    function get_list_cat($parent_id = 0){
        $sql = "SELECT * FROM tour_cat WHERE parent_id = $parent_id AND published =1 ORDER BY ordering";
        return $this->db->result($sql);
    }
    
    function get_cat_by_id($cat_id){
        $sql = "SELECT * FROM tour_cat WHERE cat_id = $cat_id";
        return $this->db->row($sql);
    }
    
    function get_str_ar_cat($cat_id){
        $str_cat = $cat_id.',';
        $list = $this->get_list_cat($cat_id);
        foreach($list as $rs):
            $str_cat .=$rs->cat_id.',';
        endforeach;
        return rtrim($str_cat,',');
    }
    
    function get_tour_by_id($id){
        $sql = "SELECT * FROM tour, tour_des WHERE tour.id = tour_des.id AND tour.id = $id";
        return $this->db->row($sql);
    }
    
    function get_city_by_id($city_id){
        return $this->db->row("SELECT city_name FROM city WHERE city_id = $city_id");
    }
    
    function get_list_img($id){
        return $this->db->result("SELECT * FROM tour_img WHERE id = $id");
    }
    
    function get_price_min_by_tour($id){
        $row = $this->db->row("SELECT price FROM tour_price WHERE id = $id ORDER BY price ASC");
        return $row->price;
    }
    
    function get_tour_lien_quan($id, $catid){
        $sql = "
            SELECT * FROM tour WHERE published = 1 AND id != $id
        ";
        if($catid != ''){
           $catid_ = explode(',',$catid);
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
        }
        $sql .= "ORDER BY id, noibat, khuyenmai DESC LIMIT 6";
        return $this->db->result($sql);
    }
    
    // Chu de Tour
    function get_chude_by_slug($slug){
        return $this->db->row("SELECT * FROM chude WHERE slug_chude = '$slug'");
    }
    
    //Home cat
    function get_all_chude($limit, $id_chude){
        $sql = "
            SELECT * FROM tour WHERE published = 1
        ";
        $sql .=" AND id_chude = $id_chude";
        $sql .=" ORDER BY id, noibat, khuyenmai DESC LIMIT $limit";
        return $this->db->result($sql);
    }
    
    function get_num_chude($id_chude){
        $sql = "SELECT id FROM tour WHERE published = 1";
        $sql .=" AND id_chude = $id_chude";
        return $this->db->num_rows($sql);
    }
    
    function get_list_banggia($id){
        $sql = "SELECT * FROM tour_price WHERE id = $id";
        return $this->db->result($sql);
    }
    function create_barcode($scode){
        $row = $this->db->row("SELECT scode, code FROM booking WHERE scode = '$scode' ORDER BY code DESC");
        if($row){
              return barcode($scode,$row->code,6);
        }else{
            return $scode.'000001';
        }
    }
    
    function get_all_bank(){
        return $this->db->result("SELECT * FROM bank");
    }
}
