<?php
class tuyendiem_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    
    function get_all_tuyendiem($limit, $offset, $loaihinh, $tinh = '', $key = ''){
        $sql = "
            SELECT * FROM dl_tour_tuyendiem, dl_tour_tuyendiem_des
            WHERE td_id = tuyendiem_id
            AND lang_id = 1";
        $sql .=" AND td_inbound = '$loaihinh'";
        if($key != ''){
            $sql .=" AND name LIKE '%$key%'";
        }
        if($tinh != ''){
            $sql .=" AND td_state_id = '$tinh'";
        }
        $sql .=" ORDER BY td_inbound ASC  
            lIMIT $limit OFFSET $offset
        ";
        return $this->db->result($sql);
    }
    
    
    function get_num_tuyendiem($loaihinh, $tinh = '', $key = ''){
        $sql = "
            SELECT td_id FROM dl_tour_tuyendiem, dl_tour_tuyendiem_des
            WHERE td_id = tuyendiem_id
            AND lang_id = 1
        ";
        $sql .=" AND td_inbound = '$loaihinh'";
        if($key != ''){
            $sql .=" AND name LIKE '%$key%'";
        }
        if($tinh != ''){
            $sql .=" AND td_state_id = '$tinh'";
        }
        return $this->db->num_rows($sql);
    }
    
    function get_tuyendiem_vi($td_id){
        $sql = "
            SELECT * FROM dl_tour_tuyendiem, dl_tour_tuyendiem_des
            WHERE td_id = tuyendiem_id
            AND lang_id = 1 AND td_id = $td_id";

        return $this->db->row($sql);
    }
    
    function get_tuyendiem_en($td_id){
        $sql = "
            SELECT name FROM dl_tour_tuyendiem_des
            WHERE lang_id = 2
            AND tuyendiem_id = $td_id
        ";
        return $this->db->row($sql);
    }
    
    function get_dc_state($st_id){
        return $this->db->row("SELECT st_name FROM dc_state WHERE st_id = $st_id");
    }
    
    function get_dc_country($ct_id){
         return $this->db->row("SELECT ct_name FROM dc_country WHERE ct_id = '$ct_id'");
    }
    
    function get_all_quocgia(){
        return $this->db->result("SELECT * FROM dc_country");
    }
    
    function get_all_tinhthanh($st_id){
        return $this->db->result("SELECT st_id, st_name FROM dc_state WHERE st_ct_id = '$st_id' ORDER BY st_order ASC");
    }
    
}
