<?php
class quanhuyen_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_quanhuyen($city_id){
        return $this->db->result("SELECT * FROM city WHERE parentid = $city_id ORDER BY city_id ASC");
    }
    function get_tinhthanh($id){
        return $this->db->row("SELECT * FROM city WHERE city_id = $id");
    }
}
