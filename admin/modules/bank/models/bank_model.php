<?php
class bank_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_bank(){
        return $this->db->result("SELECT * FROM bank");
    }
}
