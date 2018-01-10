<?php
class booking_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_all_booking($limit, $offset, $get){
        $key = $get['key'];
        $begin = $get['begin'];
        $end = $get['end'];
        $status = $get['status'];
        $pay = $get['pay'];
        $sql = "SELECT * FROM booking WHERE id != 0";
        if($key != ''){
            $sql .=" AND (code LIKE '%$key%' OR email LIKE '%$key%'  OR name LIKE '%$key%'  OR address LIKE '%$key%')";
        }
        if($begin != ''){
            if($end == ''){
                $date_end = time();
            }else{
                $date_end = strtotime($begin.' 23:59');
            }
            $begin = strtotime($begin.' 0:0');
            $sql .=" AND (date_to >= $begin AND date_to <= $date_end)";
        }
        if($status != 0){
            $sql .=" AND order_status = $status";
        }
        if($pay != 0){
            $sql .=" AND payment = $pay";
        }
        $sql .=" ORDER BY date_add DESC LIMIT $limit OFFSET $offset";

        return $this->db->result($sql);
    }                                  
    
    function get_num_booking($get){
        $key = $get['key'];
        $begin = $get['begin'];
        $end = $get['end'];
        $status = $get['status'];
        $pay = $get['pay'];
        $sql = "SELECT id FROM booking  WHERE id != 0";
        if($key != ''){
            $sql .=" AND (code LIKE '%$key%' OR email LIKE '%$key%'  OR name LIKE '%$key%'  OR address LIKE '%$key%')";
        }
        if($begin != ''){
            if($end == ''){
                $date_end = time();
            }else{
                $date_end = strtotime($begin.' 23:59');
            }
            $begin = strtotime($begin.' 0:0');
            $sql .=" AND (time_book >= $begin AND time_book <= $date_end)";
        }
        if($status != 0){
            $sql .=" AND order_status = $status";
        }
        if($pay != 0){
            $sql .=" AND pay_status = $pay";
        }
        return $this->db->num_rows($sql);
    }
    
    function get_tour_by_id($id){
        $sql = "SELECT * FROM tour WHERE id = $id";
        return $this->db->row($sql);
    }
    
    function getBookDetail($id, $type = 1){
        $sql = "SELECT * FROM booking_detail WHERE id = $id AND type = $type ORDER BY booking_id ASC";
        return $this->db->result($sql);
    }
}
