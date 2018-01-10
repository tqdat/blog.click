<?php
class linhvuc_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_loailinhvuc($limit, $offset){
        $sql = "
            SELECT * FROM dl_loai_linhvuc, dl_loai_linhvuc_des
            WHERE llv_id = loai_linhvuc_id
            AND lang_id = 1
            ORDER BY llv_order ASC  
            lIMIT $limit OFFSET $offset
        ";
        return $this->db->result($sql);
    }
    
    
    function get_num_loailinhvuc(){
        $sql = "
            SELECT llv_id FROM dl_loai_linhvuc, dl_loai_linhvuc_des
            WHERE llv_id = loai_linhvuc_id
            AND lang_id = 1
        ";
        return $this->db->num_rows($sql);
    }
    
    function get_llv_vi($id){
        $sql = "
            SELECT * FROM dl_loai_linhvuc, dl_loai_linhvuc_des
            WHERE llv_id = loai_linhvuc_id
            AND llv_id = $id
            AND lang_id = 1
        ";
        return $this->db->row($sql);
    }
    
    function get_llv_en($id){
        $sql = "
        SELECT name FROM dl_loai_linhvuc_des WHERE loai_linhvuc_id = $id AND lang_id = 2
        ";
        return $this->db->row($sql);
    }
    
    function get_list_loailinhvuc($lg = 1){
        $sql = "
            SELECT * FROM dl_loai_linhvuc, dl_loai_linhvuc_des
            WHERE llv_id = loai_linhvuc_id
            AND lang_id = $lg
            ORDER BY llv_order ASC  
        ";
        return $this->db->result($sql);
    }
}
