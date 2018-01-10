<?php
class tuychon_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_chauluc(){
        return $this->db->result("SELECT * FROM dc_continent ORDER BY id ASC");
    }
    
    function get_num_quocgia($id){
        return $this->db->num_rows("SELECT ct_id FROM dc_country WHERE ct_continent_id = $id");
    }
    
    function get_num_thanhpho($ct_id){
        return $this->db->num_rows("SELECT st_id FROM dc_state WHERE st_ct_id = '$ct_id'");
    }
    
    function get_num_quanhuyen($id){
        return $this->db->num_rows("SELECT dt_id FROM dc_district WHERE dt_state_id = $id");
    }
    
    function get_all_quocgia($id){
        return $this->db->result("SELECT * FROM dc_country WHERE ct_continent_id = $id");
    }
    
    
}
