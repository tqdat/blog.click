<?php
class about extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('about_model','about');
        $this->pre_message = "";
    }
    
    function index(){
        $data['title'] = "Giới thiệu";
        $data['add'] = 'about/add';
        $data['list'] = $this->about->get_all_about();
        $this->load->templates('index',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới giới thiệu";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = "about";
        $this->form_validation->set_rules('vdata[title]','Tiêu đề','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['slug'] = vnit_change_title($vdata['title']);
            if($this->db->insert('about',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'about';
                }else{
                    $url = 'about/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('add',$data);
    }
    
    function edit(){
        $id = segment(3,'int');
        $data['title'] = "Cập nhật giới thiệu";
        $data['save'] = true;
        //$data['apply'] = true;
        //$data['cancel'] = "about";
        $data['rs'] = $this->db->row("SELECT * FROM about WHERE id = $id");
        $this->form_validation->set_rules('vdata[title]','Tiêu đề','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['slug'] = vnit_change_title($vdata['title']);
            if($this->db->update('about',$vdata,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'about';
                }else{
                    $url = 'about/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = segment(3,'int');
        if($this->db->delete('about',array('id'=>$id))){
            $msg = "Xóa thành công";
        }else{
            $msg = "Xóa không thành công";
        }
        $this->session->set_flashdata('message',$msg);
        redirect('about');
    }
    
    function save_order(){
        $id = $_POST['id'];
        for($i = 0 ; $i< sizeof($id);$i++){
            $menu['ordering'] = $_POST['order_'.$id[$i]];
            $this->db->update('about',$menu,array('id'=>$id[$i]));
        }
    }
}