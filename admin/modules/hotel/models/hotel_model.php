<?php
class hotel_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_hotel($limit, $offset, $field, $order, $key = '', $cat = 0){
        $sql ="
            SELECT 
                n.id,n.price,n.address, n.catid, n.title, n.slug, n.created, n.created_by, n.hits, n.published, c.cat_name
            FROM 
                hotel as n, hotel_chanel as c
            WHERE 
                n.catid = c.cat_id";
        if($cat != 0){
            $ar = $this->get_ar_cat($cat);
            $sql .=' AND c.cat_id IN ('.implode(',',$ar).')';
        }
        if($key != ''){
            $sql .=" AND (n.title LIKE '%$key%' OR n.introtext LIKE  '%$key%' OR n.fulltext LIKE '%$key%')";
        }
        $sql .=" ORDER BY $field $order LIMIT $limit OFFSET $offset";
        return $this->db->result($sql);
    }
    
    function get_num_hotel($key = '', $cat = 0){
        $sql ="
            SELECT 
                n.id, c.cat_id
            FROM 
                hotel as n, hotel_chanel as c
            WHERE 
                n.catid = c.cat_id 
        ";
        if($cat != 0){
            $ar = $this->get_ar_cat($cat);
            $sql .=' AND c.cat_id IN ('.implode(',',$ar).')';
        }
        if($key != ''){
            $sql .=" AND (n.title LIKE '%$key%' OR n.introtext LIKE  '%$key%' OR n.fulltext LIKE '%$key%')";
        }
        return $this->db->num_rows($sql);
    }
    
    
    function get_all_hotel_chanel($parent_id = 0){
        return $this->db->result("SELECT cat_id, cat_name FROM hotel_chanel WHERE parent_id = $parent_id ORDER BY cat_order ASC");
    }
    
    function get_ar_cat($catid){
        $ar = array($catid);
        $list = $this->get_all_hotel_chanel($catid);
        foreach($list as $rs):
            $list1 = $this->get_all_hotel_chanel($rs->cat_id);
            array_push($ar, $rs->cat_id);
            foreach($list1 as $rs1):
                array_push($ar, $rs1->cat_id);
            endforeach;
        endforeach;
        return $ar;
    }
    
    function get_cat_by_id($cat_id){
        return $this->db->row("SELECT * FROM hotel_chanel WHERE cat_id = $cat_id");
    }
    
    function get_hotel_by_id($id){
        return $this->db->row("SELECT * FROM hotel WHERE id = $id");
    }
    
    function get_list_channel($catid){
        return $this->db->result("SELECT * FROM channel WHERE cat_id = $catid ORDER BY channel_date DESC");
    }
    
    // Cache
    
    function get_list_maincat(){
         return $this->db->result("SELECT cat_id, cat_name, cat_slug FROM hotel_chanel WHERE parent_id = 0 AND published = 1 ORDER BY cat_order ASC");
    }
    
    function get_list_top($catid){
         $ar_id = $this->get_ar_cat($catid);
         $sql = "
            SELECT 
                id, catid, cat_slug, title, slug, introtext, images
            FROM 
                hotel
            WHERE published = 1
            AND catid IN (".implode(',',$ar_id).")
            ORDER BY id DESC LIMIT 9
         ";
         return $this->db->result($sql);
    }
    
    function get_tinmoi(){
         $sql = "
            SELECT 
                id, catid, cat_slug, title, slug, introtext, images
            FROM 
                hotel
            WHERE published = 1
            ORDER BY id DESC LIMIT 9
         ";
         return $this->db->result($sql); 
    }
    
    function get_noibat($limit = 4){
        return $this->db->result("SELECT id, catid, cat_slug, title, slug, introtext, images FROM hotel WHERE published = 1 AND noibat = 1 ORDER BY id DESC LIMIT $limit");
    }
    
    function get_docnhieu(){
        $time = time() - 604800;
        return $this->db->result("SELECT id, title, slug FROM hotel WHERE published = 1 AND created > $time ORDER BY hits DESC LIMIT 5");
    }    
}
