<?php
class help extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('help_model','help');
        $this->pre_message = "";
    }
    
    function dscat(){
        $data['title'] = "Danh mục trợ giúp";
        $data['add'] = "help/addcat";
        $data['list'] = $this->help->get_all_cat();
        $this->load->templates('cat/index',$data);
    }
    
    function addcat(){
        $data['title'] = "Thêm danh mục trợ giúp";
        $data['apply'] = true;
        $data['save'] = true;
        $data['cancel'] = 'help/dscat';
        $this->form_validation->set_rules('vdata[catname]','Tiêu đề','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['alias'] = vnit_change_title($vdata['catname']);
            if($this->db->insert('help_cat',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'help/dscat';
                }else{
                    $url = 'help/editcat/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('cat/add',$data);
    }
    
    function editcat(){
        $data['title'] = "Cập nhật mục trợ giúp";
        $data['apply'] = true;
        $data['save'] = true;
        $data['cancel'] = 'help/dscat';
        $catid = $this->uri->segment(3);
        $data['rs'] = $this->db->row("SELECT * FROM help_cat WHERE catid = $catid");
        $this->form_validation->set_rules('vdata[catname]','Tiêu đề','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $id = $this->request->post['id'];
            $vdata = $this->request->post['vdata'];
            $vdata['alias'] = vnit_change_title($vdata['catname']);
            if($this->db->update('help_cat',$vdata,array('catid'=>$id))){

                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'help/dscat';
                }else{
                    $url = 'help/editcat/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('cat/edit',$data);
    }
    
    function save_order_cat(){
        $id = $_POST['id'];
        for($i = 0 ; $i< sizeof($id);$i++){
            $menu['ordering'] = $_POST['order_'.$id[$i]];
            $this->db->update('help_cat',$menu,array('catid'=>$id[$i]));
        }
    } 
    
    function delcat(){
        $id = $this->uri->segment(3);
        $total = $this->help->check_total_help($id);
        if($total > 0){
            $this->session->set_flashdata('message','Không xóa được. Vẫn còn mục trợ giúp trong danh mục này');
        }else{
            if($this->db->delete('help_cat',array('catid'=>$id))){
                $this->session->set_flashdata('message','Xóa thành công');    
            }else{
                $this->session->set_flashdata('message','Xóa không thành công');    
            }
        }
        redirect('help/dscat');
    }
    
    function ds(){
        $data['title'] = "Danh sách Tư vấn";
        $data['add'] = 'help/add';
        $data['catid'] = (int)$this->request->get['catid'];
        $data['listcat'] = $this->help->get_all_cat();
        $config['base_url'] = base_url().'help/ds/';
        if($data['catid'] != 0){
        $config['suffix'] = '?catid='.$data['catid'];
        }
        $config['total_rows']   =  $this->help->get_num_help($data['catid']);
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   20; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->help->get_all_help($config['per_page'],segment(3,'int'),$data['catid']);
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('index',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới Tư vấn";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'help/ds';
        $data['listcat'] = $this->help->get_all_cat();
        $this->form_validation->set_rules('vdata[title]','Tiêu đề','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['slug'] = vnit_change_title($vdata['title']);
            $vdata['content'] = $this->request->post['content'];
            if($this->db->insert('help',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'help/ds';
                }else{
                    $url = 'help/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('add',$data);
    }
    
    function edit(){
        $data['title'] = "Cập nhật Tư vấn";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'help/ds';
        $data['listcat'] = $this->help->get_all_cat();
        $id = $this->uri->segment(3);
        $data['rs'] = $this->db->row("SELECT * FROM help WHERE id = $id");
        $this->form_validation->set_rules('vdata[title]','Tiêu đề','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $id = $this->request->post['id'];
            $vdata = $this->request->post['vdata'];
            $vdata['slug'] = vnit_change_title($vdata['title']);
            $vdata['content'] = $this->request->post['content'];
            if($this->db->update('help',$vdata,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'help/ds';
                }else{
                    $url = 'help/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = $this->uri->segment(3);
        if($this->db->delete('help',array('id'=>$id))){
            $this->session->set_flashdata('message','Xóa thành công');
        }else{
            $this->session->set_flashdata('message','Xóa không thành công');
        }
        redirect('help/ds');
    }
    
    function save_order_help(){
        $id = $_POST['id'];
        for($i = 0 ; $i< sizeof($id);$i++){
            $menu['ordering'] = $_POST['order_'.$id[$i]];
            $this->db->update('help',$menu,array('id'=>$id[$i]));
        }
    }
}
