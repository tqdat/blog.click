<?php
class contact extends vnit{
    protected $_templates;
    function __construct(){
        parent::__construct();
        $this->load->config('config_contact');
        $this->load->model('contact_model','contact');
    }
    function index(){
        $data['title'] = 'Liên hệ';
        $data['save'] = true;       
        $data['contact_name'] = $this->config->item('contact_name');
        $data['contact_address'] = $this->config->item('contact_address');
        $data['lat'] = $this->config->item('contact_lat');
        $data['lng'] = $this->config->item('contact_lng');
        $data['contact_hotline'] = $this->config->item('contact_hotline');
        $data['contact_phone'] = $this->config->item('contact_phone');
        $data['contact_fax'] = $this->config->item('contact_fax');
        $data['contact_email'] = $this->config->item('contact_email');
        $data['contact_img'] = $this->config->item('contact_img');
        $data['contact_send_mail'] = $this->config->item('contact_send_mail');

        $this->form_validation->set_rules('contact_name','Tên website','');
        $this->form_validation->set_rules('contact_address','Địa chỉ','');

        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* File config_contact\n* Date: ".date('d/m/y H:i:s').".\n**/";
            $contact_name = $this->request->post['contact_name'];
            $contact_address = $this->request->post['contact_address'];
            $lat = $this->request->post['lat'];
            $lng = $this->request->post['lng'];
            $contact_phone = $this->request->post['contact_phone'];
            $contact_hotline = $this->request->post['contact_hotline'];
            $contact_fax = $this->request->post['contact_fax'];
            $contact_email = $this->request->post['contact_email'];
            $contact_img = $this->request->post['contact_img'];
            $contact_send_mail = $this->request->post['contact_send_mail'];

            $str .= "\n\$config['contact_name'] = '$contact_name';";  
            $str .= "\n\$config['contact_address'] = '$contact_address';";  
            $str .= "\n\$config['contact_lat'] = '$lat';";  
            $str .= "\n\$config['contact_lng'] = '$lng';";  
            $str .= "\n\$config['contact_hotline'] = '$contact_hotline';";  
            $str .= "\n\$config['contact_phone'] = '$contact_phone';";  
            $str .= "\n\$config['contact_fax'] = '$contact_fax';";  
            $str .= "\n\$config['contact_email'] = '$contact_email';";  
            $str .= "\n\$config['contact_img'] = '$contact_img';";    
            $str .= "\n\$config['contact_send_mail'] = '$contact_send_mail';";    
            
            $str .= "\n\n/* End of file config_contact*/";        
            $this->load->helper('file');
            write_file(ROOT.'site/config/config_contact.php', $str);    
            redirect('contact') ;     
        }
        $data['message'] = $this->pre_message;
        $this->_templates['page'] = 'index';
        $this->load->templates($this->_templates['page'],$data);
    }

      
      function listcontact(){
          $data['title'] = 'Danh sách liên hệ';
          $data['delete'] = true;
          $field = $this->uri->segment(4);
          $order = $this->uri->segment(5);   
          if($field =='' && $order == ''){
              $field = 'contactid';
              $order = 'desc';
          }       
          $config['suffix'] = '/'.$field.'/'.$order;            
          $config['base_url'] = base_url().'contact/listcontact/';  
          $config['total_rows']   =  $this->contact->get_num_contact();
          $data['num'] = $config['total_rows'];
          $config['per_page']  =   20;
          $config['uri_segment'] = 3; 
          $this->pagination->initialize($config);   
          $data['list'] =   $this->contact->get_all_contact($config['per_page'],segment(3,'int'));
          $data['pagination']    = $this->pagination->create_links(); 
          $this->_templates['page'] = 'list';
          $this->load->templates($this->_templates['page'],$data);
      }
      
      function edit(){
          $data['title'] = 'Chi tiết liên hệ';
          $data['save'] = true;
          $data['apply'] = true;
          $data['cancel'] = 'contact/listcontact';
          $id = segment(3,'int');
          $page = segment(4,'int');
          $data['rs'] = $this->db->row("SELECT * FROM contact WHERE contactid=".$id);
          $this->db->query("UPDATE contact SET is_read = 1 WHERE contactid=".$id);
          $this->form_validation->set_rules('subject','Tiêu đề','required');
          $this->form_validation->set_rules('content','Nội dung','required');
          if($this->form_validation->run() === FALSE){
              $this->pre_message = validation_errors();
          }else{
              $this->load->helper('mail');
              
              $to = $this->request->post['to'];
              $subject = $this->request->post['subject'];
              $message = $this->request->post['content'];
              $contact_name = $this->config->item('contact_name');
              $contact_email = $this->config->item('contact_email');
              if(!send($to,$subject,$message,$contact_name,$contact_email)){
                 $this->pre_message = "Gửi E-mail không thành công";
              }else{
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $this->request->post['option'];
                if($option == 'save'){
                   $url = 'contact/listcontact/'.$page;
                }else{
                    $url = uri_string();
                }
                redirect($url);                  
              }
          }
          $data['message'] = $this->pre_message;
          $this->_templates['page'] = 'edit';
          $this->load->templates($this->_templates['page'],$data);
      }
      
      // Xoa 1 ban ghi
      function del(){
          $id = segment(3,'int');
          $page = segment(4,'int');
             if($this->db->delete('contact', array('contactid'=>$id)))
                $this->session->set_flashdata('message','Đã xóa thành công');
            else $this->session->set_flashdata('message','Xóa không thành công');
          redirect('contact/listcontact/'.$page);
      }
      // Xoa nhieu ban ghi
      function dels(){
            if(!empty($_POST['ar_id']))
            {
                $page = (int)$this->request->post['page'];
                $ar_id = $this->request->post['ar_id'];
                for($i = 0; $i < sizeof($ar_id); $i ++) {
                    if ($ar_id[$i]){
                        if($this->db->delete('contact', array('contactid'=>$ar_id[$i])))
                        $this->session->set_flashdata('message','Đã xóa thành công');
                        else $this->session->set_flashdata('error','Xóa không thành công');
                    }
                }
            }
            redirect('contact/listcontact/'.$page);
      }      
  }
