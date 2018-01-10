<?php
class booking extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('booking_model','booking');
    }
    
    function ds(){
        $get = $this->request->get;
        $str = '';
        foreach($get as $key=>$val):
            $str .="&$key=$val";
        endforeach;
        $str = trim($str,'&');
        if($str == ''){
            $str_url = '';
        }else{
            $str_url = '?'.$str;
        }
        $data['get'] = $get;
        $data['str_suff'] = $str_url;
        $data['title'] = "Danh sách Booking";
        $config['base_url'] = base_url().'booking/ds/';
        $config['suffix'] = '/'.$str_url;
        $config['total_rows']   =  $this->booking->get_num_booking($get);
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   20; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->booking->get_all_booking($config['per_page'],segment(3,'int'),$get);
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('ds',$data);
    }
    
    function search(){
        $key = $this->request->post['key'];
        $date_begin = $this->request->post['date_begin'];
        $date_end = $this->request->post['date_end'];
        $trangthai_donhang = $this->request->post['trangthai_donhang'];
        $trangthai_thanhtoan = $this->request->post['trangthai_thanhtoan'];
        $str = '&key='.$key;
        $str .= '&begin='.$date_begin;
        $str .= '&end='.$date_end;
        $str .= '&status='.$trangthai_donhang;
        $str .= '&pay='.$trangthai_thanhtoan;
        $str = trim($str,'&');
        header( 'Location: '.site_url('booking/ds/').'?'.$str) ;
    }
    
    function edit(){
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'booking/ds';
        $id = $this->uri->segment(3);
        $rs = $this->db->row("SELECT * FROM booking WHERE id = $id");
        $data['rs'] = $rs;
        $data['title'] = "Mã đặt Tour: ".$data['rs']->code;
        $data['tour'] = $this->booking->get_tour_by_id($rs->tour_id);
        $this->form_validation->set_rules('order_status','order_status','');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata['order_status'] = $this->request->post['order_status'];
            $vdata['pay_status'] = $this->request->post['pay_status'];
            //$vdata['notes'] = $this->request->post['notes'];
            $vdata['ghichu'] = $this->request->post['ghichu'];
            if($this->db->update('booking',$vdata,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                redirect(uri_string());
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = $this->uri->segment(3);
        $page = $this->uri->segment(4);
        if($this->db->delete('booking',array('id'=>$id))){
            $this->db->delete('booking_detail',array('id'=>$id));
            $this->session->set_flashdata('message','Xóa thành công');
        }else{
            $this->session->set_flashdata('message','Xóa không thành công');
        }
        redirect('booking/ds/'.$page);
    }
}
