<?php
class price_search_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_price_search(){
        return $this->db->result("SELECT * FROM price_search");
    }
}
