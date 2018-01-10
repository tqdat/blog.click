<?php
class hotro_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_num_hotro(){
        return $this->db->num_rows("SELECT * FROM support");
    }
    
    function get_all_hotro($limit, $offset){
        return $this->db->result("SELECT * FROM support ORDER BY ordering ASC LIMIT $limit OFFSET $offset");
    }
    
    function get_list_hotro($type){
        return $this->db->result("SELECT * FROM support WHERE type = $type ORDER BY type ASC");
    }
}
