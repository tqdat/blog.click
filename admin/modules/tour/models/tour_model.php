<?php
class tour_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_tour($limit, $offset, $key = '', $catid = 0){
        if($catid != 0){
            $ar = $this->ar_cat($catid);
        }
        $sql = "
            SELECT 
                t.*, d.*
            FROM 
                tour as t, tour_des as d
            WHERE t.id = d.id ";
        if($key != ''){
            $sql .=" AND (t.title LIKE '%$key%')";
        }
        if($catid != 0){
            $sql .=' AND t.cat_id IN ('.implode(',',$ar).')';
        }
        $sql .= " ORDER BY t.id DESC LIMIT $limit OFFSET $offset";
        return $this->db->result($sql);
    }
    
    function get_num_tour($key = '', $catid = 0){
        if($catid != 0){
            $ar = $this->ar_cat($catid);
        }
        $sql = "
            SELECT 
                t.id, d.id
            FROM 
                tour as t, tour_des as d
            WHERE t.id = d.id";
        if($key != ''){
            $sql .=" AND (d.title LIKE '%$key%')";
        }
        if($catid != 0){
            $sql .=' AND t.cat_id IN ('.implode(',',$ar).')';
        }
        return $this->db->num_rows($sql);
    }
    
    function get_all_cat($parent_id = 0){
        $sql = "
            SELECT 
                *
            FROM
                tour_cat";
        $sql .=" WHERE parent_id = $parent_id";
        $sql .=" ORDER BY ordering ASC";
        return $this->db->result($sql);
        
    }
    
    function get_tour_by_lang($id){
        $sql = "
            SELECT 
                l.*, d.*
            FROM language as l, tour_des as d
            WHERE l.lang_id = d.lang_id
            AND d.id = $id
            ORDER BY l.lang_default DESC
        ";
        return $this->db->result($sql);
    }
    

    function get_main_slug($lang_id , $cat_id){
        $row = $this->db->row("SELECT cat_id, parent_id FROM tour_cat WHERE cat_id = $cat_id");
        if($row->parent_id == 0){
            return $this->db->row("SELECT slug FROM tour_cat_des WHERE cat_id = ".$row->cat_id." AND lang_id = $lang_id")->slug;
        }else{
            return $this->db->row("SELECT slug FROM tour_cat_des WHERE cat_id = ".$row->parent_id." AND lang_id = $lang_id")->slug;    
        }
    }
    
    function get_list_price($id){
        return $this->db->result("SELECT * FROM tour_price WHERE id = $id ORDER BY begin ASC");
    }
    
    function get_tour_by_id($id){
        $sql = "
            SELECT * FROM tour, tour_des WHERE tour.id = tour_des.id AND tour.id = $id
        ";
        return $this->db->row($sql);
    }
    
    function get_item_cat($cat_id){
        $sql = "
            SELECT 
                name
            FROM
                tour_cat
            WHERE cat_id = $cat_id";

        return $this->db->row($sql);
    }
    
    function get_min_price($id){
        return $this->db->row("SELECT * FROM tour_price WHERE id = $id ORDER BY price ASC");
    }
    
    function ar_cat($cat_id){
         $ar_id[] = $cat_id;
         $list = $this->db->result("SELECT * FROM tour_cat WHERE cat_id = $cat_id OR parent_id = $cat_id");
         foreach($list as $rs):
            $ar_id[] = $rs->cat_id;
         endforeach;
         return $ar_id;
    }
    
    function get_all_img_tam(){
        $session_id = $this->session->sessionid();
        return $this->db->result("SELECT * FROM tam WHERE session_id = '$session_id' AND module='TOUR' ORDER BY time ASC");
    }
    
    function get_all_img($id){
        return $this->db->result("SELECT * FROM tour_img WHERE id = $id ORDER BY img_id ASC");
    }
    
    function get_all_city(){
        return $this->db->result("SELECT city_id, city_name FROM city WHERE parentid = 0 ORDER BY ordering ASC");
    }
    
    function get_all_chude(){
        return $this->db->result("SELECT * FROM chude ORDER BY ordering ASC");
    }
    
    function get_all_local($limit, $offset, $city_id){
        $sql = "
            SELECT 
                local_id, title, images
            FROM  diadanh
            WHERE city_id = $city_id
            ORDER BY local_id DESC limit $limit OFFSET $offset
        ";
        return $this->db->result($sql);
    }
    function get_num_local($city_id){
        $sql = "
            SELECT local_id
            FROM diadanh
            WHERE city_id = $city_id
        ";
        return $this->db->num_rows($sql);
    }
    
    function get_tour_local($id){
       $sql = "
            SELECT t.*, d.title
            FROM tour_local as t, diadanh as d
            WHERE t.local_id = d.local_id
            AND t.id = $id
       ";
       return $this->db->result($sql);
    }
    
    function get_all_lich($id){
        return $this->db->result("SELECT * FROM tour_lich WHERE id = $id ORDER BY ngaydi ASC");
    }
    
    function get_all_main(){
        $sql = "
            SELECT 
                m.mainid,d.name_small, d.slug
            FROM
                main as m, main_des as d
            WHERE m.mainid = d.mainid
            AND d.lang_id = ".$this->lang_default;
        $sql .=" ORDER BY m.ordering ASC";
        return $this->db->result($sql);
    }

    
    function get_cat_by_id($catid){
        return $this->db->row("SELECT * FROM tour_cat WHERE cat_id = $catid");
    }
}
