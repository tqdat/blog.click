<?php
class account_model extends model{
    function __construct(){
        parent::__construct();
    }
    function get_all_account($limit, $offset){
        $sql = "
            SELECT 
                u.*, g.* 
            FROM 
                user as u, user_group as g 
            WHERE u.group_id = g.group_id 
            ORDER BY u.group_id DESC 
            LIMIT $limit OFFSET $offset        
        ";
        return $this->db->result($sql);
    }
    
    function get_num_account(){
        return $this->db->num_rows("SELECT u.user_id, g.group_id FROM user as u, user_group as g WHERE u.group_id = g.group_id");

    }
    
    function get_list_group(){
        return $this->db->result("SElECT * FROM `user_group` ORDER BY `group_id` DESC");
    }
}