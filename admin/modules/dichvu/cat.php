<?php
class cat extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('cat_model','cat');
        $this->write_router();
        $this->pre_message = "";
    }
    
    function ds(){
        $data['title'] = "Danh mục dịch vụ";
        $data['add'] = 'dichvu/cat/add';
        $data['list'] = $this->cat->get_all_cat();
        $this->load->templates('cat/ds',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới danh mục dịch vụ";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'dichvu/cat/ds';
        $this->form_validation->set_rules('vdata[catname]','Tên danh mục','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['catslug'] = vnit_change_title($vdata['catname']);
            if($this->db->insert('danhmuc_dichvu',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'dichvu/cat/ds';
                }else{
                    $url = 'dichvu/cat/edit/'.$id;
                }
                redirect($url);                
            }
        }
        $this->load->templates('cat/add',$data);
    }
    
    function edit(){
        $id = segment(4,'int');
        $data['title'] = "Cập nhật danh mục dịch vụ";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'dichvu/cat/ds';
        $data['rs'] = $this->db->row("SELECT * FROM danhmuc_dichvu WHERE catid = $id");
        $this->form_validation->set_rules('vdata[catname]','Tên danh mục','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['catslug'] = vnit_change_title($vdata['catname']);
            if($this->db->update('danhmuc_dichvu',$vdata,array('catid'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'dichvu/cat/ds';
                }else{
                    $url = 'dichvu/cat/edit/'.$id;
                }
                redirect($url);                
            }
        }
        $this->load->templates('cat/edit',$data);
    }
    
    function del(){
        $id = $this->uri->segment(4);
        $total = $this->cat->check_total_diadanh($id);
        if($total > 0){
            $msg = "Danh mục này vẫn còn địa danh. Không xóa được";
        }else{
            if($this->db->delete('danhmuc_diadanh',array('catid'=>$id))){
                $msg = "Xóa thành công";
            }else{
                $msg = "Xóa không thành công";
            }
        }
        $this->session->set_flashdata('message',$msg);
        redirect('diadanh/cat/ds');        
    }
    
    
    function write_router(){
        $this->load->helper('file');
        $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* File router_dulich \n* Date: ".date('d/m/y H:i:s').".\n**/";
        $list = $this->cat->get_all_cat();
        $str .= "\n\$route['dich-vu'] = 'dichvu/index';";  
        $str .= "\n\$route['dich-vu/(:num)'] = 'dichvu/index/$1';";  
        foreach($list as $rs):
            $slug = $rs->catslug;
            $str .= "\n\$route['dich-vu/$slug'] = 'dichvu/cat';";      
            $str .= "\n\$route['dich-vu/$slug/(:num)'] = 'dichvu/cat/$1';"; 
            $str .= "\n\$route['dich-vu/$slug/(:num)/(:any)'] = 'dichvu/cat/$1/$2';"; 
            
        endforeach;
        $str .= "\n\$route['dich-vu/(:any)'] = 'dichvu/detail/$1';"; 
        write_file(ROOT.'site/config/router/router_dichvu.php', $str);
    }
    
}
