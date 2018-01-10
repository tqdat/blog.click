<?php
class tienich_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function getmain($parent_id = 0){
        return $this->db->result("SELECT * FROM tienich WHERE parent_id = $parent_id");
    }
    
    function maxorder(){
        $row =  $this->db->row("SELECT stt FROM tienich ORDER BY stt DESC");
        if($row){
            return $row->stt + 1;
        }else{
            return 1;
        }
    }
    
    function get_all_roomtype(){
        return $this->db->result("SELECT * FROM room_type");
    }
    
    function get_total_type($id){
        return $this->db->num_rows("SELECT type_id FROM room_detail WHERE type_id = $id");
    }
}
