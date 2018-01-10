<?php
class api_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_city($city_id){
        return $this->db->row("SELECT city_name FROM city WHERE city_id = $city_id");
    }
}