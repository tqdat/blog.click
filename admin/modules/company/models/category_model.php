<?php
class category_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_maincat(){
        return $this->db->result("SELECT * FROM company_cat WHERE parent_id = 0 ORDER BY ordering ASC");
    }
    
    function get_list_cat($parentid){
        return $this->db->result("SELECT * FROM company_cat WHERE parent_id = $parentid ORDER BY ordering ASC");
    }
    
    function get_maincat_is_menu(){
        return $this->db->result("SELECT * FROM company_cat WHERE parent_id = 0 AND is_menu = 1 ORDER BY ordering ASC");
    }
    
    function itemcat($parentid = 0){
        return $this->db->result("SELECT * FROM company_cat WHERE parent_id = $parentid AND published = 1 ORDER BY ordering ASC");
    }
    
    function get_total_company($catid){
        return $this->db->num_rows("SElECT id FROM company WHERE catid1 = $catid");
    }
    
    function get_total_company_sub($catid){
        return $this->db->num_rows("SElECT id FROM company WHERE catid2 = $catid");
    }
    
    function get_cache_main(){
        return $this->db->result("SELECT catid, catname, alias FROM company_cat WHERE parent_id = 0 AND published = 1 ORDER BY ordering ASC");
    }
    
    function get_cache_sub($catid){
        return $this->db->result("SELECT catid, catname, alias FROM company_cat WHERE parent_id = $catid AND parent_id != 0 AND published = 1 ORDER BY ordering ASC");
    }
}
