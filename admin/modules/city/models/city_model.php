<?php
class city_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_city($num, $offset, $parent_id = 0){
        return $this->db->result("SELECT * FROM city where parentid = $parent_id ORDER BY ordering ASC LIMIT $num OFFSET $offset");
    }
    
    function get_num_city($parent_id = 0){
        return $this->db->num_rows("SELECT city_id FROM city where parentid = $parent_id");
    }
    
    function check_total_district($city_id){
        return $this->db->num_rows("SELECT city_id FROM city WHERE parentid = $city_id");
    }
    
    function get_list_city(){
        return $this->db->result("SELECT * FROM city WHERE parentid = 0 ORDER BY ordering ASC");
    }
    
    
    function get_all_district($num, $offset, $parent_id = 0){
        return $this->db->result("SELECT * FROM city where parentid = $parent_id ORDER BY ordering ASC LIMIT $num OFFSET $offset");
    }
    
    
    function get_list_district($parent_id = 0){
        return $this->db->result("SELECT * FROM city WHERE parentid = $parent_id");
    }
    
    function get_num_district($parent_id = 0){
        return $this->db->num_rows("SELECT city_id FROM city where parentid = $parent_id");
    }
}