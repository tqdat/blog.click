<?php
class quocgia_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_quocgia($num, $offset, $id = 0){
        $sql = "
            SELECT * FROM dc_country
        ";
        if($id != 0){
            $sql .=" WHERE ct_continent_id = $id";
        }
        $sql .=" ORDER BY ct_name ASC LIMIT $num OFFSET $offset";
        return $this->db->result($sql);
    }
    
    function get_num_quocgia($id = 0){
        $sql = "
            SELECT ct_id FROM dc_country
        ";
        if($id != 0){
            $sql .=" WHERE ct_continent_id = $id";
        }
        return $this->db->num_rows($sql);
    }
    
    function get_quocgia($id){
        return $this->db->row("SELECT * FROM dc_country WHERE ct_id = '$id'");
    }
    
    function get_list_quocgia(){
        $sql = "
            SELECT * FROM dc_country
        ";
        $sql .=" ORDER BY ct_name ASC";
        return $this->db->result($sql);
    }
}
