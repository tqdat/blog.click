<?php
class about_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_about(){
        return $this->db->result("SELECT * FROM about ORDER BY ordering ASc");
    }
}
