<?php
class banner extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('banner_model','banner');
        $this->pre_message = "";
    }
    function ds(){
        $this->write_banner();
        $data['title'] = "Banner quảng cáo";
        $data['add'] = 'banner/add';
        $data['list'] = $this->banner->get_all_banner();
        $this->load->templates('index',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới Banner";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'banner/ds';
        $data['order']  = $this->banner->find_max();
        $this->form_validation->set_rules('vdata[name]','Tiêu đề','required');
        $this->form_validation->set_rules('vdata[link]','Link','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/banner/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = '10000';
                $config['file_name'] =  md5(rand(100,10000));  
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('message',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $vdata['images'] = $result['file_name'];  
                }                    
            }
            if($this->db->insert('banner',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'banner/ds';
                }else{
                    $url = 'banner/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('add',$data);
    }
    
    function edit(){
        $id = segment(3,'int');
        $data['title'] = "Cập nhật Banner";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'banner/ds';
        $data['rs']  = $this->db->row("SELECT * FROM banner WHERE id = $id");
        $this->form_validation->set_rules('vdata[name]','Tiêu đề','required');
        $this->form_validation->set_rules('vdata[link]','Link','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/banner/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = '10000';
                $config['file_name'] =  md5(rand(100,10000));  
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('message',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $vdata['images'] = $result['file_name'];  
                }                    
            }
            if($this->db->update('banner',$vdata,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'banner/ds';
                }else{
                    $url = 'banner/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit',$data);
    }    
    
    function del(){
        $id = segment(3,'int');
        if($this->db->delete('banner',array('id'=>$id))){
            $this->session->set_flashdata('message','Xóa thành công');
        }else{
            $this->session->set_flashdata('message','Xóa không thành công');
        }
        redirect('banner/ds');
    } 
    
    function save_order(){
        $id = $this->request->post['id'];
        for($i = 0; $i < sizeof($id); $i++){
            $vdata['ordering'] = $this->request->post['order_'.$id[$i]];
            $this->db->update('banner',$vdata,array('id'=>$id[$i]));
        }
    }
    
    function write_banner(){
        $this->load->helper('file');
        $str = '<div id="slider" class="nivoSlider">';
        $list = $this->banner->get_list_cache();
        foreach($list as $rs):
            $str .='<a href="'.$rs->link.'" title="'.$rs->name.'">';
            $str.='<img src="'.base_url_site().'data/banner/'.$rs->images.'" width="500" height="312"  alt="'.$rs->name.'">';
            $str.='</a>';
        endforeach;
        $str .='</div>';
        write_file(ROOT.'site/config/banner.html', $str);
    }
}
