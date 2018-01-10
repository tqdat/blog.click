<?php
class news_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_cat_by_slug($slug, $parent_id = 0){
        $sql = "
            SELECT *
            FROM category WHERE parent_id = $parent_id AND cat_slug = '$slug'
        ";
        return $this->db->row($sql);
    }
    
    function get_cat_by_slug_sub($slug){
        $sql = "
            SELECT *
            FROM category WHERE parent_id != 0 AND cat_slug = '$slug'
        ";
        return $this->db->row($sql);
    }
    
    function get_all_news($limit, $offset, $cat_id = 0){
        $sql = "
            SELECT 
                id, main_slug, title, slug, introtext, images
            FROM 
                news
            WHERE published = 1";
        if($cat_id != 0){
            $ar_id = $this->get_ar_cat($cat_id);
            $sql .=" AND catid IN (".implode(',',$ar_id).")";
        }
        $sql .=" ORDER BY id DESC LIMIT $limit OFFSET $offset";
        
        return $this->db->result($sql);
    } 
    function get_num_news($cat_id = 0){
        $sql = "
            SELECT 
                id
            FROM 
                news
            WHERE published = 1";
        if($cat_id != 0){
            $ar_id = $this->get_ar_cat($cat_id);
            $sql .=" AND catid IN (".implode(',',$ar_id).")";
        }
        
        return $this->db->num_rows($sql);
    }
    
    function cat_by_slug($slug){
        return $this->db->row("SELECT * FROM category WHERE cat_slug = '$slug'");
    }
    
    
    function get_other_cat($limit, $offset, $catid){
        $ar_id = $this->get_ar_cat($catid);
        $sql = "
            SELECT 
                id, catid, cat_slug, title, slug, introtext, images
            FROM 
                news
            WHERE published = 1
            AND catid IN (".implode(',',$ar_id).")
            ORDER BY id DESC LIMIT $limit OFFSET $offset
        ";
        return $this->db->result($sql);
    }
    
    function get_ar_cat($catid){
        $ar = array($catid);
        $list = $this->get_all_category($catid);
        foreach($list as $rs):
            array_push($ar, $rs->cat_id);
        endforeach;
        return $ar;
    }
    
    function get_all_category($parent_id = 0){
        return $this->db->result("SELECT cat_id, cat_name FROM category WHERE parent_id = $parent_id AND parent_id != 0 ORDER BY cat_order ASC");
    }
     
    
    function get_cat_by_id($cat_id){
        return $this->db->row("SELECT * FROM category WHERE cat_id = $cat_id");
    }
    
    function get_news_id($id){
        return $this->db->row("SELECT * FROM news WHERE id = $id");
    }
    
    function get_other_tinmoi($id, $catid){
        $sql = "
            SELECT 
                *
            FROM 
                news
            WHERE published = 1
            AND id > $id
            AND catid = $catid
            ORDER BY id DESC LIMIT 5
        ";
        return $this->db->result($sql); 
    }
    
    function get_other_tincu($id, $catid){
        $sql = "
            SELECT 
                *
            FROM 
                news
            WHERE published = 1
            AND id < $id
            AND catid = $catid
            ORDER BY id DESC LIMIT 5
        ";
        return $this->db->result($sql); 
    }
    
}
