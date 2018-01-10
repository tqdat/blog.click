<?php
class bank extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('bank_model','bank');
    }
    
    function ds(){
        $data['title'] = "Tài khoản ngân hàng";
        $data['add'] = 'bank/add';
        $data['list'] = $this->bank->get_all_bank();
        $this->load->templates('ds',$data);
    }
    
    function add(){
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'bank/ds';
        $data['title'] = "Thêm mới";
        $this->form_validation->set_rules('vdata[name]','Tên ngân hàng','required');
        $this->form_validation->set_rules('vdata[ctk]','Chủ tài khoản','required');
        $this->form_validation->set_rules('vdata[stk]','Số tài khoản','required');
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
                    $vdata['logo'] = $result['file_name'];  
                    $this->load->helper('vimg');
                    vnit_resize_image(ROOT.'data/tam/'.$vdata['logo'],ROOT.'data/img/'.$vdata['logo'],80,50,true);
                    unlink(ROOT.'data/tam/'.$vdata['logo']);
                }                    
            } 
            
            if($this->db->insert('bank',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'bank/ds';
                }else{
                    $url = 'bank/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('add',$data);
    }
    function edit(){
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'bank/ds';
        $id = $this->uri->segment(3);
        $data['rs'] = $this->db->row("SELECT * FROM bank WHERE id = $id");
        $data['title'] = "Cập nhật";
        $this->form_validation->set_rules('vdata[name]','Tên ngân hàng','required');
        $this->form_validation->set_rules('vdata[ctk]','Chủ tài khoản','required');
        $this->form_validation->set_rules('vdata[stk]','Số tài khoản','required');
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
                    $vdata['logo'] = $result['file_name'];  
                    vnit_resize_image(ROOT.'data/tam/'.$vdata['logo'],ROOT.'data/img/'.$vdata['logo'],80,50,true);
                    unlink(ROOT.'data/tam/'.$vdata['logo']);
                }                    
            }
            if($this->db->update('bank',$vdata,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'bank/ds';
                }else{
                    $url = 'bank/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = $this->uri->segment(3);
        if($this->db->delete('bank',array('id'=>$id))){
            $msg = "Xóa thành công";
        }else{
            $msg = "Xóa không thành công";
        }
        $this->session->set_flashdata('message',$msg);
        redirect('bank/ds');
    }
}