<?php
class chude_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    
    function get_all_chude($limit, $offset){
        $sql = "
            SELECT * FROM dl_tour_chude, dl_tour_chude_des
            WHERE cdt_id = tour_chude_id
            AND lang_id = 1
            ORDER BY cdt_order ASC  
            lIMIT $limit OFFSET $offset
        ";
        return $this->db->result($sql);
    }
    
    
    function get_num_chude(){
        $sql = "
            SELECT cdt_id FROM dl_tour_chude, dl_tour_chude_des
            WHERE cdt_id = tour_chude_id
            AND lang_id = 1
        ";
        return $this->db->num_rows($sql);
    }
    
    function get_chude_vi($id){
        $sql = "
            SELECT * FROM dl_tour_chude, dl_tour_chude_des
            WHERE cdt_id = tour_chude_id
            AND cdt_id = $id
            AND lang_id = 1
        ";
        return $this->db->row($sql);
    }
    
    function get_chude_en($id){
        $sql = "
        SELECT name FROM dl_tour_chude_des WHERE tour_chude_id = $id AND lang_id = 2
        ";
        return $this->db->row($sql);
    }
}
