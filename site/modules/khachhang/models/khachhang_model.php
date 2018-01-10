<?php

class khachhang_model extends model {

    function __construct() {
        parent::__construct();
    }

    function get_chitiet_khachhang($id) {
        $sql = "SELECT * FROM khachhang 
				WHERE id = '$id' AND published = '1'";
        return $this->db->row($sql);
    }

    function get_khachhang($id) {
        $sql = "SELECT * FROM khachhang 
				WHERE id != $id AND published = '1' LIMIT 10";
        return $this->db->result($sql);
    }

    function get_khachhang_img($id) {
        $sql = "SELECT * FROM khachhang_img WHERE id = $id";
        return $this->db->result($sql);
    }
    
    function get_all_img() {
        $sql = "SELECT * FROM khachhang WHERE published = 1 ORDER BY id DESC";
        return $this->db->result($sql);
    }

}
