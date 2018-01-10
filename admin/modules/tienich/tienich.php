<?php
class tienich extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('tienich_model','tienich');
        $this->pre_message = "";
    }
    
    function ds(){
        $data['title'] = "Tiện tích";
        $data['add'] = 'tienich/add';
        $data['list'] = $this->tienich->getmain();
        $this->load->templates('ds',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tienich/ds';
        $data['main'] = $this->tienich->getmain();
        $data['order'] = $this->tienich->maxorder();
        $this->form_validation->set_rules('vdata[name]','Tiêu đề','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            if($this->db->insert('tienich',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'tienich/ds';
                }else{
                    $url = 'tienich/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;        
        $this->load->templates('add',$data);
    }
    
    function edit(){
        $id = segment(3,'int');
        $data['title'] = "Cập nhật";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tienich/ds';
        $data['rs'] = $this->db->row("SELECT * FROM tienich WHERE id = $id");
        $data['main'] = $this->tienich->getmain();
        $this->form_validation->set_rules('vdata[name]','Tiêu đề','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            if($this->db->update('tienich',$vdata,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'tienich/ds';
                }else{
                    $url = 'tienich/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;        
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = segment(3,'int');
        if($this->db->delete('tienich',array('id'=>$id))){
            $this->db->delete('tienich',array('parent_id'=>$id));
            $msg = "Xóa thành công";
        }else{
            $msg = "Xóa không thành công";
        }
        $this->session->set_flashdata('message',$msg);
        redirect('tienich/ds');
    }
    
    function dsroom(){
        $data['title'] = "Tiện ích phòng";
        $data['add'] = 'tienich/addtype';
        $data['list'] = $this->tienich->get_all_roomtype();
        $this->load->templates('dsroom',$data);
    }
    
    function addtype(){
        $data['title'] = "Thêm tiên nghi phòng";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tienich/dsroom';
        $this->form_validation->set_rules('vdata[type_name]','Tiêu đề','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            if($this->db->insert('room_type',$vdata)){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'tienich/dsroom';
                }else{
                    $url = 'tienich/edittype/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;         
        $this->load->templates('addtype',$data);
    }
    
    function edittype(){
        $id = segment(3,'int');
        $data['title'] = "Cập nhật tiên nghi phòng";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tienich/dsroom';
        $data['rs'] = $this->db->row("SELECT * FROM room_type WHERE type_id = $id");
        $this->form_validation->set_rules('vdata[type_name]','Tiêu đề','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            if($this->db->update('room_type',$vdata,array('type_id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'tienich/dsroom';
                }else{
                    $url = 'tienich/edittype/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;         
        $this->load->templates('edittype',$data);
    }
    
    function deltype(){
        $id = segment(3,'int');
        $total = $this->tienich->get_total_type($id);
        if($total > 0){
            $msg = "Tiện ích này không thể xóa. Có liên quan tới phòng";
        }else{
            if($this->db->delete('room_type',array('type_id'=>$id))){
                $msg = "Xóa thành công";
            }else{
                $msg = "Xóa không thành công";
            }
        }                                     
        $this->session->set_flashdata('message',$msg);
        redirect('tienich/dsroom');
    }
}
