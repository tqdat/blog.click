<?php
class banner_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_banner(){
        return $this->db->result("SELECT * FROM banner ORDER BY ordering DESC");
    }
    
    function find_max(){
        $row = $this->db->row("SELECT ordering FROM banner ORDER BY ordering DESC");
        if(!$row){
            return 0;
        }else{
            return $row->ordering + 1;
        }
    }
    
    function get_list_cache(){
        return $this->db->result("SELECT * FROM banner WHERE published = 1 ORDER BY ordering DESC");
    }
}
