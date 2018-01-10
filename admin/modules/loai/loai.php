<?php
class loai extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('loai_model','loai');
    }
    
    function ds(){
        $data['title'] = "Loại khách sạn";
        $data['add'] = 'loai/add';
        $data['list'] = $this->loai->get_all_loai();
        $this->load->templates('ds',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới Loại khách sạn";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'loai/ds';
        $this->form_validation->set_rules('vdata[ten_loai]','Loại khách sạn','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['slug_loai'] = vnit_change_title($vdata['ten_loai']);
            if($this->db->insert('loai',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'loai/ds';
                }else{
                    $url = 'loai/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('add',$data);
    }
    
    
    function edit(){
        $id = $this->uri->segment(3);
        $data['rs'] = $this->db->row("SELECT * FROM loai WHERE id_loai = $id");
        $data['title'] = "Cập nhật Loại khách sạn";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'loai/ds';
        $this->form_validation->set_rules('vdata[ten_loai]','Loại khách sạn','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['slug_loai'] = vnit_change_title($vdata['ten_loai']);
            if($this->db->update('loai',$vdata,array('id_loai'=>$id))){

                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'loai/ds';
                }else{
                    $url = 'loai/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = $this->uri->segment(3);
        $total = $this->loai->check_total_hotel($id);
        if($total > 0){
            $msg = "Không thể xóa. Vẫn còn tồn tại khách sạn trong loại này!";
        }else{
            if($this->db->delete('loai',array('id_loai'=>$id))){
                $msg = "Xóa thành công";
            }else{
                $msg = "Xóa không thành công";
            }                                 
        }
        redirect('loai/ds');
    }
}
