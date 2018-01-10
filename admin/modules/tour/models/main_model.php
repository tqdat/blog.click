<?php
class main_model extends model{
    function __construct(){
        parent::__construct();
    }
    public function get_all_main($parent_id = 0){
        $sql = "
            SELECT 
                m.*, d.*
            FROM 
                main as m, main_des as d
            WHERE m.mainid = d.mainid
            AND d.lang_id = ".$this->lang_default."
            AND m.parent_id = $parent_id
            ORDER BY m.ordering ASC
        ";
        return $this->db->result($sql);
    }
    
    public function get_cat_by_id($mainid){
        return $this->db->row("SELECT * FROM main WHERE mainid = $mainid");
    }
    
    function get_category_by_lang($cat_id){
        $sql = "
            SELECT 
                l.*, d.*
            FROM 
                language as l, main_des as d
            WHERE l.lang_id = d.lang_id
            AND d.mainid = $cat_id
            ORDER BY l.lang_default DESC
        ";
        return $this->db->result($sql);
    }
    
    function get_num_tour($mainid){
        return $this->db->num_rows("SELECT id FROM tour WHERE mainid = $mainid");
    }
    
    function get_num_cat($catid){
        return $this->db->num_rows("SELECT mainid FROM ticker_cat WHERE parent_id = $catid");
    }

    
    function get_list_cat(){
        $sql = "
            SELECT 
                m.*, d.*
            FROM
                main as m, main_des as d
            WHERE 
                m.mainid = d.mainid
            AND published = 1
            ORDER BY m.ordering ASC
        ";
        return $this->db->result($sql);
        
    }
}
