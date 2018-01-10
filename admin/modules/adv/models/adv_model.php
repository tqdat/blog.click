<?php
class adv_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_list_home(){
        return $this->db->result("SELECT * FROM adv_home ORDER BY date_begin DESC");
    }
    
    
    function get_list_product(){
        return $this->db->result("SELECT * FROM adv_product ORDER BY date_begin DESC");
    }
    
    function get_all_cat_product(){
        return $this->db->result("SELECT catid, name FROM pcat WHERE parent_id = 0 ORDER BY ordering ASC");
    }
    function check_item_cat($catid, $id){
        return $this->db->row("SELECT id FROM adv_product_cat WHERE id = $id AND catid = $catid");
    }
    
    //// News
    function get_list_newshome(){
        return $this->db->result("SELECT * FROM adv_news_home ORDER BY date_begin DESC");
    }    
    
    function get_list_news(){
        return $this->db->result("SELECT * FROM adv_news ORDER BY date_begin DESC");
    }
    
    function get_all_cat_news(){
        return $this->db->result("SELECT cat_id, cat_name FROM category WHERE parent_id = 0 ORDER BY cat_order ASC");
    }
    
    function get_all_news_vitri(){
        return $this->db->result("SELECT * FROM adv_news_vitri ORDER BY ordering ASC");
    }
    
    function get_item_vitri($vitri){
        return $this->db->row("SELECT * FROM adv_news_vitri WHERE vitri = $vitri");
    }
    
    function check_item_cat_news($catid, $id){
        return $this->db->row("SELECT id FROM adv_news_cat WHERE id = $id AND catid = $catid");
    }
        

    
    
    function get_is_home($vitri){
        $date = time();
        $sql = "
            SELECT 
                *
            FROM 
                adv_home
            WHERE published = 1
            AND vitri = $vitri
            AND date_begin > $date
            ORDER BY date_begin ASC
        ";
        return $this->db->result($sql);
    }
    
    function get_list_adv_didanh(){
        //return $Th
    }
}     
