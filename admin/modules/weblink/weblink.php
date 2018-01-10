<?php
class weblink extends vnit{
    function __construct(){
        parent::__construct();
        $this->pre_message = "";
    }
    
    function ds(){
        $data['title'] = "Liên kết website";
        $data['add'] = 'weblink/add';
        $data['list'] = $this->db->result("SELECT * FROM weblink ORDER BY id DESC");
        $this->load->templates('ds',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới liên kết";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'weblink/ds';
        $this->form_validation->set_rules('vdata[name]','Liên kết','required');
        $this->form_validation->set_rules('vdata[link]','Link','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/tam/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = '10000';
                $config['file_name'] =  vnit_change_title($vdata['name']);
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                       
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('error',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $vdata['images'] = $result['file_name'];  
                    $this->load->helper('vimg') ;
                    vnit_resize_image(ROOT.'data/tam/'.$vdata['images'],ROOT.'data/weblink/'.$vdata['images'],200,130,true);
                    unlink(ROOT.'data/tam/'.$vdata['images']);
                }                    
            }
            if($this->db->insert('weblink',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'weblink/ds';
                }else{
                    $url = 'weblink/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('add',$data);
    }
    
    function edit(){
        $data['title'] = "Cập nhật liên kết";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'weblink/ds';
        $id = segment(3,'int');
        $data['rs'] = $this->db->row("SELECT * FROM weblink WHERE id = $id");
        $this->form_validation->set_rules('vdata[name]','Liên kết','required');
        $this->form_validation->set_rules('vdata[link]','Link','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $id = $this->request->post['id'];
            $vdata = $this->request->post['vdata'];
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/tam/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = '10000';
                $config['file_name'] =  vnit_change_title($vdata['name']);
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                       
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('error',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $vdata['images'] = $result['file_name']; 
                    $this->load->helper('vimg') ;
                    vnit_resize_image(ROOT.'data/tam/'.$vdata['images'],ROOT.'data/weblink/'.$vdata['images'],200,130,true);
                    unlink(ROOT.'data/tam/'.$vdata['images']);
                }                    
            }
            if($this->db->update('weblink',$vdata,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'weblink/ds';
                }else{
                    $url = 'weblink/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = segment(3,'int');
        if($this->db->delete('weblink',array('id'=>$id))){
            $this->session->set_flashdata('message','Xóa thành công');
        }else{
            $this->session->set_flashdata('message','Xóa không thành công');
        }
        redirect('weblink/ds');
    }
}
