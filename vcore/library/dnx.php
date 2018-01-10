<?php
class dnx{
    function __construct(){
        $this->V =& get_instance();
        $ngaydi = $this->V->session->data['ngaydi'];
        $ngayden = $this->V->session->data['ngayden'];
        if($ngayden == 0 || $ngaydi == 0){
            $time = time();
            $time_end = $time + 86400;
            $_SESSION['ngayden'] = time();
            $_SESSION['ngaydi'] = $time_end;
        }
    }
    
    function get_tour_menu(){
        $sql = "SELECT cat_id, name, slug FROM tour_cat WHERE published = 1 AND parent_id = 0 AND is_menu = 1 ORDER BY ordering ASC";
        return $this->V->db->result($sql);
    } 
    function get_tour_menu1(){
        $sql = "SELECT cat_id, name, slug FROM tour_cat WHERE published = 1 AND parent_id = 0 ORDER BY ordering ASC";
        return $this->V->db->result($sql);
    } 
    
    function get_tin_menu($parent_id=0){
        $sql = "
            SELECT cat_id, cat_name, cat_slug FROM category WHERE parent_id = $parent_id AND published = 1 AND cat_is_menu=1 ORDER BY cat_order ASC
        ";                     
        return $this->V->db->result($sql);
    }
    
    function get_tour_cat($parent_id = 0){
        $sql = "SELECT cat_id, parent_id, name, slug FROM tour_cat WHERE published = 1 AND parent_id = $parent_id";
        if($parent_id == 0){
            $sql .=" AND is_menu = 1";
        }
        $sql .=" ORDER BY ordering ASC";
        return $this->V->db->result($sql);
    }
    function get_tour_cat1($parent_id = 0){
        $sql = "SELECT cat_id, parent_id, name, slug FROM tour_cat WHERE published = 1 AND parent_id = $parent_id";
       
        $sql .=" ORDER BY ordering ASC";
        return $this->V->db->result($sql);
    }
    
    function get_cat_local(){
        $sql = "SELECT catid, catname, catslug FROM danhmuc_diadanh WHERE module = 'LOCAL' ORDER BY ordering ASC";
        return $this->V->db->result($sql);
    }
    
    function get_all_city($parentid = 0){
        $sql = "SELECT city_id, city_name, city_url FROM city WHERE parentid = $parentid ORDER BY ordering ASC";
        return $this->V->db->result($sql);
    }
    
    function get_min_price($id){
        $sql = "SELECT MIN(price) as price FROM tour_price WHERE id = $id ORDER BY price ASC";
        return $this->V->db->row($sql)->price;
    }
    
    function get_min_price_book($id){
        $sql = "SELECT  price FROM tour_price WHERE id = $id ORDER BY begin ASC";
        return $this->V->db->row($sql)->price;
    }
    
    function getPriceBook($id, $qty){
        $sql = "SELECT * FROM tour_price WHERE id = $id AND begin <= $qty ORDER BY begin DESC";        
        return $this->V->db->row($sql);
    }
    
    function get_all_cat($parent_id){
        $sql = "
            SELECT cat_id, cat_name, cat_slug FROM category WHERE parent_id = $parent_id AND published = 1 ORDER BY cat_order ASC
        ";                     
        return $this->V->db->result($sql);
    }
    
	function get_all_hotel($parent_id){
        $sql = "
            SELECT cat_id, cat_name, cat_slug FROM hotel_chanel WHERE parent_id = $parent_id AND published = 1 ORDER BY cat_order ASC
        ";                     
        return $this->V->db->result($sql);
    }
	
    function get_cat_by_id($catid){
        $sql = "SELECT * FROM category WHERE cat_id = $catid";
        return $this->V->db->row($sql);
    }
    
    function get_all_diemden(){
        $sql = "
            SELECT c.city_name, c.city_id, t.ketthuc
            FROM city as c, tour as t
            WHERE c.city_id = t.ketthuc
            group by t.ketthuc
            order by c.ordering ASC
        ";
        return $this->V->db->result($sql);
    }
}
