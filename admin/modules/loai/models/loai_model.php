<?php
class loai_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_loai(){
        return $this->db->result("SELECT * FROM loai ORDER BY ordering ASC");
    }
    
    function check_total_hotel($id_loai){
        return $this->db->num_rows("SELECT id FROM hotel WHERE id_loai = $id_loai");
    }
}
