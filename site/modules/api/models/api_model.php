<?php
class api_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function check_last_rating($session_id, $tour_id){
        $sql = "SELECT * FROM rating WHERE tour_id = $tour_id AND session_id = '$session_id'";
        return $this->db->row($sql);
    }
    function check_rating($session_id, $tour_id){
        $sql = "SELECT * FROM rating WHERE tour_id = $tour_id AND session_id = '$session_id'";
        $row = $this->db->row($sql);
        if($row){
            return false;
        }else{
            return true;
        }
    }
    
    function total_row($tour_id){
        return $this->db->num_rows("SELECT rate_id FROM rating WHERE tour_id = $tour_id");
    }
    
    function total_score($tour_id){
        $row = $this->db->row("SELECT SUM(total) as total FROM rating WHERE tour_id = $tour_id");
        return $row->total;
    }
    
    
    function get_num_catindex($catid) {
         $sql = "
            SELECT * FROM tour WHERE published = 1";
        
        if ($catid != '') {
            $catid_ = explode(',', $catid);
            if (sizeof($catid_) > 0) {

                $sql .= " AND ( ";
                $i = 0;
                foreach ($catid_ as $catids) {
                    $sql .=" (cat_id like '%,$catids' OR cat_id like '$catids,%' OR cat_id like '%,$catids,%' OR cat_id = '$catids') ";
                    $i++;
                    if ($i < count($catid_))
                        $sql .= " OR  ";
                }
                $sql .= " ) ";
            }
        }
        return $this->db->num_rows($sql);
    }
    function get_all_catindex($catid, $limit, $offset){
        $sql = "
            SELECT * FROM tour WHERE published = 1";
        
        if ($catid != '') {
            $catid_ = explode(',', $catid);
            if (sizeof($catid_) > 0) {

                $sql .= " AND ( ";
                $i = 0;
                foreach ($catid_ as $catids) {
                    $sql .=" (cat_id like '%,$catids' OR cat_id like '$catids,%' OR cat_id like '%,$catids,%' OR cat_id = '$catids') ";
                    $i++;
                    if ($i < count($catid_))
                        $sql .= " OR  ";
                }
                $sql .= " ) ";
            }
        }
        $sql .=" order by id desc";
        if($limit !=0){
            $sql .=" limit $limit offset $offset";
        }
        return $this->db->result($sql);
    }
    function get_num_chude($id_chude){
        $sql = "SELECT id FROM tour WHERE published = 1";
        $sql .=" AND id_chude = $id_chude";
        return $this->db->num_rows($sql);
    }
    
}
