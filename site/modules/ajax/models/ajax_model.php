<?php
class ajax_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_city($ct_id){
        $sql = "SELECT city_id, city_name FROM city WHERE parentid = 0 AND ct_id ='$ct_id' ORDER BY ordering ASC";
        return $this->db->result($sql);
    }
    
    function get_tour_by_id($id){
        return $this->db->row("SELECT * FROM tour WHERE id = $id");
    }
    
    function get_book_id($id){
        $sql = "
            SELECT * FROM booking WHERE id = $id
        ";
        return $this->db->row($sql);
    }
    
    function get_city_by_id($city_id){
        return $this->db->row("SELECT city_name FROM city WHERE city_id = $city_id");
    }
}
