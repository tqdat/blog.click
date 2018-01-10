<?php
class tinhthanh_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_tinhthanh($num, $offset){
        $sql = "
            SELECT * FROM city
        ";
        $sql .=" WHERE parentid = 0";
        $sql .=" ORDER BY ordering ASC LIMIT $num OFFSET $offset";
        return $this->db->result($sql);
    }
    
    function get_num_tinhthanh(){
        $sql = "
            SELECT city_id FROM city
        ";
        $sql .=" WHERE parentid = 0";
        return $this->db->num_rows($sql);
    }
    
    function get_tinhthanh($id){
        return $this->db->row("SELECT * FROM city WHERE city_id = $id");
    }
    
    function get_max_order(){
        return $this->db->row("SELECT ordering FROM city WHERE parentid = 0 ORDER BY ordering DESC")->ordering;
    }
    
    function get_num_quanhuyen($id){
        return $this->db->num_rows("SELECT city_id FROM city WHERE parentid = $id");
    }
}
