<?php
class business_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_business($limit, $offset){
        return $this->db->result("SELECT * FROM company ORDER BY id DESC LIMIT $limit OFFSET $offset");
    }
    
    function get_num_business(){
        return $this->db->num_rows("SELECT id FROM company");
    }
    
    function get_all_district($city_id = 1){
        return $this->db->result("SELECT city_id, city_name FROM city WHERE parentid = $city_id");
    }
    
    function get_maincat(){
        return $this->db->result("SELECT * FROM company_cat WHERE parent_id = 0 ORDER BY ordering ASC");
    }
    
    function get_subcat($catid){
        return $this->db->result("SELECT * FROM company_cat WHERE parent_id = $catid AND parent_id != 0  ORDER BY ordering ASC");
    }
    
    function get_all_noibat(){
        return $this->db->result("SELECT * FROM company WHERE published = 1 AND noibat = 1 LIMIT 20");
    }
}
