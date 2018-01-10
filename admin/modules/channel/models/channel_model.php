<?php
class channel_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_num_channel($catid = 0){
        $sql = "
            SELECT 
             c.cat_id, ch.cat_id
            FROM 
                channel as ch, category as c
            WHERE c.cat_id = ch.cat_id
        ";
        if($catid != 0){
            $sql .=" AND ch.cat_id = $catid";
        }
        return $this->db->num_rows($sql);
    }
    
    function get_all_channel($limit, $offset,$catid = 0){
        $sql = "
            SELECT 
             c.cat_id, c.cat_name, ch.*
            FROM 
                channel as ch, category as c
            WHERE c.cat_id = ch.cat_id
        ";
        if($catid != 0){
            $sql .=" AND ch.cat_id = $catid";
        }
        $sql .=" ORDER BY channel_date DESC";
        return $this->db->result($sql);
    }
    
    function get_all_cat(){
        return $this->db->result("SELECT cat_id, cat_name FROM category WHERE parent_id = 0 ORDER BY cat_order ASC");
    }
}
