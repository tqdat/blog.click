<?php
class help_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_cat(){
        return $this->db->result("SELECT * FROM help_cat ORDER BY ordering ASC");
    }
    
    function check_total_help($catid){
        return $this->db->num_rows("SELECT id FROM help WHERE catid  = $catid");
    }
    
    function get_all_help($limit, $offset, $catid = 0){
        $sql = "
            SELECT * FROM help
        ";
        if($catid != 0){
            $sql .=" WHERE catid = $catid";
        }
        $sql .=" ORDER BY ordering, catid ASC LIMIT $limit OFFSET $offset";
        return $this->db->result($sql);
    }
    
    
    function get_num_help($catid = 0){
        $sql = "
            SELECT id FROM help
        ";
        if($catid != 0){
            $sql .=" WHERE catid = $catid";
        }
        return $this->db->num_rows($sql);
    }
}
