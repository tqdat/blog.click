<?php
class category_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    public function get_all_category($parent_id = 0){
        $sql = "
            SELECT 
                *
            FROM 
                tour_cat
            WHERE parent_id = $parent_id
            ORDER BY ordering ASC
        ";
        return $this->db->result($sql);
    }
    
    public function get_cat_by_id($cat_id){
        return $this->db->row("SELECT * FROM tour_cat WHERE cat_id = $cat_id");
    }
    
    function get_category_by_lang($cat_id){
        $sql = "
            SELECT 
                l.*, c.*
            FROM 
                language as l, tour_cat_des as c
            WHERE l.lang_id = c.lang_id
            AND c.cat_id = $cat_id
            ORDER BY l.lang_default DESC
        ";
        return $this->db->result($sql);
    }
    
    function get_num_new($cat_id){
        return $this->db->num_rows("SELECT id FROM tour WHERE cat_id = $cat_id");
    }
    
    function get_num_cat($catid){
        return $this->db->num_rows("SELECT cat_id FROM ticker_cat WHERE parent_id = $catid");
    }

    
    function get_list_cat($parent_id = 0){
        $sql = "
            SELECT 
                *
            FROM
                tour_cat
            WHERE parent_id = $parent_id 
            ORDER BY ordering ASC
        ";
        return $this->db->result($sql);
        
    }
}
