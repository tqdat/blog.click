<?php
class thuexe_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_thuexe($limit, $offset){
        $sql = "
            SELECT * FROM thuexe ORDER BY id DESC LIMIT $limit OFFSET $offset
        ";
        return $this->db->result($sql);
    }
    
    function get_num_thuexe(){
        return $this->db->num_rows("SELECT id FROM thuexe");
    }
    
    function get_all_img_tam(){
        $session_id = $this->session->sessionid();
        return $this->db->result("SELECT * FROM tam WHERE session_id = '$session_id' AND module='XE' ORDER BY time ASC");
    }
    
    function get_all_img($id){
        return $this->db->result("SELECT * FROM thuexe_img WHERE id = $id ORDER BY img_id ASC");
    }
}
