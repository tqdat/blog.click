<?php
class pricesearch extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('price_search_model','pricesearch');
    }
    
    function ds(){
        $data['title'] = "Tài khoản ngân hàng";
        $data['add'] = 'pricesearch/add';
        $data['list'] = $this->pricesearch->get_all_price_search();
        $this->load->templates('ds',$data);
    }
    
    function add(){
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'pricesearch/ds';
        $data['title'] = "Thêm mới";
        $this->form_validation->set_rules('vdata[price]','Giá tìm kiếm','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
       
            if($this->db->insert('price_search',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'pricesearch/ds';
                }else{
                    $url = 'pricesearch/edit/'.$id;
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
        $data['cancel'] = 'pricesearch/ds';
        $id = $this->uri->segment(3);
        $data['rs'] = $this->db->row("SELECT * FROM price_search WHERE id = $id");
        $data['title'] = "Cập nhật";
        $this->form_validation->set_rules('vdata[price]','Giá tìm kiếm','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            if($this->db->update('price_search',$vdata,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'pricesearch/ds';
                }else{
                    $url = 'pricesearch/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = $this->uri->segment(3);
        if($this->db->delete('price_search',array('id'=>$id))){
            $msg = "Xóa thành công";
        }else{
            $msg = "Xóa không thành công";
        }
        $this->session->set_flashdata('message',$msg);
        redirect('price_search/ds');
    }
}