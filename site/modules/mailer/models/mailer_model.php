<?php
class mailer_model extends model{
    function __construct(){
        parent::__construct();
    }
    
    function get_info_account($user_id){
        $sql = "
            select u.*, g.*
            FROM
                user as u, user_group as g
            WHERE u.group_id = g.group_id
            AND u.user_id = $user_id
        ";
        return $this->db->row($sql);
    }
    
    function get_info_book($id){
        $sql = "
            SELECT * FROM datphong WHERE id = $id
        ";
        return $this->db->row($sql);
    }
    
    function get_info_hotel($hotel_id){
        $sql = "
            SELECT
                c.*, h.*
            FROM city as c, hotel as h
            WHERE c.city_id = h.city_id
            AND h.hotel_id = $hotel_id
        ";
        return $this->db->row($sql);
    }
    
    function get_info_room($hotel_id, $room_id){
        return $this->db->row("SELECT * FROM room WHERE hotel_id = $hotel_id AND room_id = $room_id");
    }
}
