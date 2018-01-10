<?php
class contact_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_contact($limit, $offset){
        $sql = "
            SELECT 
                *
            FROM
                contact
            ORDER BY is_read ASC, contactid DESC
            LIMIT $limit OFFSET $offset
        ";
        return $this->db->result($sql);
    }
    
    function get_num_contact(){
        return $this->db->num_rows("SELECT contactid FROM contact");
    }
}
