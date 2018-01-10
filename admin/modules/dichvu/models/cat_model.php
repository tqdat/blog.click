<?php
class cat_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_cat(){
        return $this->db->result("SELECT * FROM danhmuc_dichvu ORDER BY ordering ASC");
    }
    
    function check_total_diadanh($catid){
        return $this->db->num_rows("SELECT id FROM dichvu WHERE catid = $catid");
    }
}
