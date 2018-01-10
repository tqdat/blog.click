<?php
class khachhang_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_khachhang($limit, $offset){
        $sql = "
            SELECT * FROM khachhang ORDER BY id DESC LIMIT $limit OFFSET $offset
        ";
        return $this->db->result($sql);
    }
    
    function get_num_khachhang(){
        return $this->db->num_rows("SELECT id FROM khachhang");
    }
    
    function get_all_img_tam(){
        $session_id = $this->session->sessionid();
        return $this->db->result("SELECT * FROM tam WHERE session_id = '$session_id' AND module='KH' ORDER BY time ASC");
    }
    
    function get_all_img($id){
        return $this->db->result("SELECT * FROM khachhang_img WHERE id = $id ORDER BY img_id ASC");
    }
}
