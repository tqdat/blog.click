<?php
class hotel_chanel_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    public function get_all_hotel_chanel($parent_id = 0){
        return $this->db->result("SElECT * FROM hotel_chanel WHERE parent_id = $parent_id ORDER BY cat_order ASC");

    }
    
    public function get_cat_by_id($cat_id){
        return $this->db->row("SELECT * FROM hotel_chanel WHERE cat_id = $cat_id");
    }
    
    function get_num_new($cat_id){
        return $this->db->num_rows("SELECT id FROM news WHERE catid = $cat_id");
    }
    
    function get_num_cat($catid){
        return $this->db->num_rows("SELECT cat_id FROM hotel_chanel WHERE parent_id = $catid");
    }
    
    /*****************
    * Cache
    */
    function get_main_router($catid = 0){
        return $this->db->result("SELECT cat_id, cat_name, parent_id, cat_slug FROM hotel_chanel WHERE parent_id = $catid  ORDER BY cat_order ASC");
    }
}
