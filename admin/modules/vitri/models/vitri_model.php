<?php
class vitri_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all($c, $d){
        $sql = "
            SELECT 
                * 
            FROM 
                vitri
            WHERE vitri_id != 0
        ";
        if($c != 0){
            $sql .=" AND catid = $c";
        }
        if($d != 0){
            $sql .=" AND d_id = $d";
        }
        $sql .= " ORDER BY vitri_id desc";
        return $this->db->result($sql);
    }
    
    function total_hotel($id){
        return $this->db->num_rows("SELECT hotel_id FROM hotel WHERE vitri_id = $id");
    }
    
    function get_all_city(){
        return $this->db->result("SELECT catid, name FROM pcat where parent_id = 0 ORDER BY ordering ASC");
    }
    
    function get_diadiem($c){
        return $this->db->result("SELECT * FROM diadiem WHERE catid = $c");
    }
}
