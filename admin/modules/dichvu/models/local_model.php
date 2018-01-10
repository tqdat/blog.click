<?php
class local_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    
    function get_all_local($num, $offset, $catid, $city_id, $district_id, $key){
        $sql ="
            SELECT 
                * 
            FROM 
                dichvu
            WHERE id != 0
        ";
        if($catid != 0){
            $sql .=" AND catid = $catid";
        }
        if($city_id != 0){
            $sql .=" AND city_id = $city_id";
        }
        if($district_id != 0){
            $sql .=" AND district_id = $district_id";
        }
        if($key != ''){
            $sql .=" AND title LIKE '%$key%'";
        }        
        $sql .=" ORDER BY id DESC LIMIT $num OFFSET $offset";
        return $this->db->result($sql);
    }
    
    function get_num_local($catid, $city_id, $district_id, $key){
        $sql ="
            SELECT 
                id 
            FROM 
                dichvu
            WHERE id != 0
        ";
        if($catid != 0){
            $sql .=" AND catid = $catid";
        }
        if($city_id != 0){
            $sql .=" AND city_id = $city_id";
        }
        if($district_id != 0){
            $sql .=" AND district_id = $district_id";
        }
        if($key != ''){
            $sql .=" AND title LIKE '%$key%'";
        }
        return $this->db->num_rows($sql);
    }
    
    function get_all_cat(){
        return $this->db->result("SELECT * FROM danhmuc_dichvu ORDER BY ordering ASC");
    }
    
    function get_all_city(){
        return $this->db->result("SELECT * FROM city WHERE parentid = 0 ORDER BY ordering ASC");
    }
    
    function get_all_district($city_id){
        return $this->db->result("SELECT city_id, city_name FROM city WHERE parentid = $city_id AND parentid !=0 ORDER BY ordering ASC");
    }
    
    function get_url_city($city_id){
        return $this->db->row("SELECT city_url FROM city WHERE city_id = $city_id")->city_url;
    }
    
    function get_item_cat($catid){
        return $this->db->row("SELECT catid, catname FROM danhmuc_dichvu WHERE catid = $catid");
    }
    
    function get_item_city($city_id){
        return $this->db->row("SELECT city_id, city_name FROM city WHERE city_id = $city_id");
    }
    
}
