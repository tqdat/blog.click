<?php
class mailer extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('mailer_model','mailer');
    }
    
    function dangkytaikhoan(){
        $id = segment(3,'int');
        $data['rs'] = $this->mailer->get_info_account($id);
        $this->load->view('mail_dangky',$data);
    }
    
    function quenmatkhau(){
        $email = $this->uri->segment(3);
        $pass = vnit_random(8);
        $data['pass'] = $pass;
        $data['email'] = $email;
        $vdata['password'] = md5($pass);
        $this->db->update('user',$vdata,array('email'=>$email));
        $this->load->view('quenmatkhau',$data);
    }
    
    function datphong(){
        $id = segment(3,'int');
        $rs = $this->mailer->get_info_book($id);
        $hotel = $this->mailer->get_info_hotel($rs->hotel_id);
        $room = $this->mailer->get_info_room($rs->hotel_id, $rs->room_id);
        $data['rs'] = $rs;
        $data['hotel'] = $hotel;
        $data['room'] = $room;
        $this->load->view('datphong',$data);
    }
}