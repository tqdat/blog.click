<?php
class contact extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->config('config_contact');
        $this->pre_message = "";
    }
    
    function index(){
        $data['title'] = "Liên hệ";
        $this->link[0] = "Liên hệ:lien-he";
        $this->form_validation->set_rules('vdata[fullname]','Họ tên','required');
        $this->form_validation->set_rules('vdata[email]','Email','required');
        $this->form_validation->set_rules('vdata[title]','Tiêu đề','required');
        $this->form_validation->set_rules('vdata[content]','Nội dung','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['datesend'] = time();
            if($this->db->insert('contact',$vdata)){
                $send = $this->config->item('contact_send_mail');
                if($send == 1){
                    $this->load->helper('mail');
                    $to = $this->config->item('contact_email');
                    $name = $vdata['fullname'];
                    $form = $vdata['email'];
                    $subject = $vdata['title'];
                    $message = "<h3>Nội dung liên hệ</h3>";
                    $message .= $vdata['content'];
                    sendmail($name,$form,$to,$subject,$message);
                }
                $this->session->set_flashdata('message',"Gửi liên hệ thành công");
                redirect(uri_string());
            }else{
                $this->pre_message = "Liên hệ chưa được gửi. Vui lòng kiểm tra lại thông tin";
            }
        }
        $data['message']   = $this->pre_message;
        $this->load->templates('index',$data);
    }
    
    function map(){
        $this->load->library('gmap');
        $this->gmap->width = '700px';
        $this->gmap->height = '355px';
        $this->gmap->GoogleMapAPI(); 
        $this->gmap->setMapType('map'); 
        $name = $this->config->item('contact_name');
        $address = $this->config->item('contact_address');
        $phone = $this->config->item('contact_phone');
        $email = $this->config->item('contact_email');
        $this->gmap->addMarkerByAddress($address,$name,"<b>".$name."</b><br />".$address."<br />Điện thoại: ".$phone." <br />Email: ".$email);
        $data['headerjs'] = $this->gmap->getHeaderJS();
        $data['headermap'] = $this->gmap->getMapJS();
        $data['onload'] = $this->gmap->printOnLoad();
        $data['map'] = $this->gmap->printMap();
        $data['sidebar'] = $this->gmap->printSidebar();
        $data['message']   = $this->pre_message;
        $this->load->templates('map',$data,'pop');
    }
}
