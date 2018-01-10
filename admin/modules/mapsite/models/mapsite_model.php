<?php
class mapsite_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_hotel(){
        $sql = "
            SELECT * FROM hotel WHERE published = 1 ORDER BY noibat, hotel_id DESC
        ";
        return $this->db->result($sql);
    }
    
    function get_all_diadiem(){
        $sql = "
            SELECT * FROM diadanh WHERE published = 1 ORDER BY local_id DESC 
        ";
        return $this->db->result($sql);
    }
    
    function get_all_dichvu(){
        $sql = "
            SELECT id, slug, cat_slug, created FROM news WHERE catid = 29 ORDER BY created DESC 
        ";
        return $this->db->result($sql);
    }
    
}
