<?php
class tourcomment_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_comment($limit, $offset){
        return $this->db->result("SELECT * FROM tour_comment ORDER BY time desc LIMIT $limit OFFSET $offset");
    }
    
    function get_num_comment(){
        return $this->db->num_rows("SELECT id FROM tour_comment");
    }
    function get_tour($id_tour){
        return $this->db->row("SELECT * FROM tour WHERE id= $id_tour");
    } 
    
        function get_comment_by_id($id){
        return $this->db->row("SELECT * FROM news WHERE id = $id");
    }
}
