<?php
class about_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_about(){
        return $this->db->row("SELECT * FROM about WHERE id = 1");
    }
}
