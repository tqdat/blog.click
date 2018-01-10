<?php
class khachsan_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_hotel($limit, $offset){
        $sql = "
            SELECT 
                *
            FROM 
                hotel
            WHERE published = 1";
        $sql .=" ORDER BY id DESC LIMIT $limit OFFSET $offset";
        
        return $this->db->result($sql);
    }
	
	function get_num_hotel(){
        $sql = "
            SELECT 
                id
            FROM 
                hotel
            WHERE published = 1";
        
        return $this->db->num_rows($sql);
    }
    function get_all_hotel_cat($limit, $offset, $catid){
        $sql = "
            SELECT 
                *
            FROM 
                hotel
            WHERE published = 1 AND catid = $catid ";
        $sql .=" ORDER BY id DESC LIMIT $limit";
        
        return $this->db->result($sql);
    }
	
	function get_num_hotel_cat($catid){
        $sql = "
            SELECT 
                id
            FROM 
                hotel
            WHERE published = 1 catid = $catid ";
        
        return $this->db->num_rows($sql);
    }
	function get_chitiet_hotel($id){
		$sql = "SELECT * FROM hotel WHERE id = '$id'";
	}
	
	function get_cat_by_slug($slug){
        $sql = "
            SELECT *
            FROM hotel_chanel WHERE cat_slug = '$slug'
        ";
        return $this->db->row($sql);
    }
	function get_cat_hotel($cat_id) {
		$sql = "SELECT * FROM hotel WHERE catid = $cat_id AND published = '1' ORDER BY ASC";
	}
}
