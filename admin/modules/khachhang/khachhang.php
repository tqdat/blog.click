<?php
class khachhang extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('khachhang_model','khachhang');
    }
    
    function ds(){
        $data['title'] = "Khách hàng";
        $data['add'] = 'khachhang/add';
        $config['base_url'] = base_url().'khachhang/ds/';
        $config['total_rows']   =  $this->khachhang->get_num_khachhang();
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   20; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->khachhang->get_all_khachhang($config['per_page'],segment(3,'int'));
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('index',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới khách hàng";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'khachhang/ds';
        $data['img'] = $this->khachhang->get_all_img_tam();
        $this->form_validation->set_rules('vdata[title]','Tiêu đề','required');
        $this->form_validation->set_rules('vdata[images]','Tiêu đề','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['slug'] = vnit_change_title($vdata['title']);
            if($this->db->insert('khachhang',$vdata)){
                $id = $this->db->insert_id();
                $this->load->helper('vimg');
                foreach($data['img'] as $val):
                    $vimg['id'] = $id;
                    $vimg['path'] =  $val->path;
                    $this->db->insert('khachhang_img',$vimg);
                    $folder_tam = ROOT.'data/tam/'.$val->path;
                    $folder_80 = ROOT.'data/khachhang/100/'.$val->path;
                    $folder_250 = ROOT.'data/khachhang/200/'.$val->path;
                    $folder_500 = ROOT.'data/khachhang/500/'.$val->path;
                    $default = ROOT.'data/khachhang/default/'.$val->path;
                    
                    copy($folder_tam, $default);
                    $this->load->helper('vimg');
                    vnit_resize_image($folder_tam,$folder_80,100,0,false);
                    vnit_resize_image($folder_tam,$folder_250,250,0,false);
                    vnit_resize_image($folder_tam,$folder_500,500,0,false);
                    unlink($folder_tam);
                endforeach;
                $this->db->delete('tam',array('session_id'=>$this->session->sessionid(),'module'=>'KH'));
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'khachhang/ds';
                }else{
                    $url = 'khachhang/edit/'.$id;
                }
                redirect($url);
            }
        }
        $this->load->templates('add',$data);
    }

    
    
    function edit(){
        $id = segment(3,'int');
        $page_ = segment(4,'int');
        $data['title'] = "Cập nhật khách hàng";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'khachhang/ds/'.$page_;
        $data['rs'] = $this->db->row("SELECT * FROM khachhang WHERE id = $id");
        $data['img'] = $this->khachhang->get_all_img($id);
        $this->form_validation->set_rules('vdata[title]','Tiêu đề','required');
        $this->form_validation->set_rules('vdata[images]','Tiêu đề','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['slug'] = vnit_change_title($vdata['title']);
            if($this->db->update('khachhang',$vdata,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'khachhang/ds/'.$page_;
                }else{
                    $url = uri_string();
                }
                redirect($url);
            }
        }
        $this->load->templates('edit',$data);
    }
    
    
    function del(){
        $id = segment(3,'int');
        $page_ = segment(4,'int');
        $listimg = $this->khachhang->get_all_img($id);
        if($this->db->delete('khachhang',array('id'=>$id))){
            foreach($listimg as $rs):
                $path_100 = ROOT.'data/khachhang/100/'.$rs->path;
                $path_200 = ROOT.'data/khachhang/200/'.$rs->path;
                $path_500 = ROOT.'data/khachhang/500/'.$rs->path;
                if(file_exists($path_100)){
                    unlink($path_100);
                }
                if(file_exists($path_200)){
                    unlink($path_200);
                }
                if(file_exists($path_500)){
                    unlink($path_500);
                }
            endforeach;
            $this->db->delete('khachhang_img',array('id'=>$id));
            $msg = "Xóa khách hàng thành công";
        }else{
            $msg = "Xóa khách hàng không thành công";
        }
        $this->session->set_flashdata('message',$msg);
        redirect('khachhang/ds/'.$page_);
    }
    
    // Tai anh moi len
    function uploader(){
        $session_id = $this->uri->segment(3);
        $dir = ROOT.'data/tam/';
        $dir_admin = 'data/tam/';
        $size=$_FILES['Filedata']['size'];
        if($size>204857600)
        {
            $data['error'] = 1;
            $data['msg'] = "File quá lớn. Không thể tải lên";
        }            
        $filename = stripslashes($_FILES['Filedata']['name']);
        $i = strrpos($filename,".");
        if (!$i) { return ""; }
        $l = strlen($filename) - $i;
        $extension = substr($filename,$i+1,$l);                 
        $extension = strtolower($extension); 
        $file_name = str_replace($extension,'',$filename);
        $file_name = vnit_change_title($file_name);
        $filename = $dir.$file_name.'-'.time().'.'.$extension;
        $file_ext = $file_name.'-'.time().'.'.$extension;
        if (move_uploaded_file($_FILES['Filedata']['tmp_name'], $filename)) {
            $vdata['session_id'] = $session_id;
            $vdata['path'] = $file_ext;
            $vdata['time'] = time();
            $vdata['module'] = 'KH';
            $this->db->insert('tam',$vdata);
            $data['id'] = $this->db->insert_id();
            $data['error'] = 0;
            $data['filename'] = $file_ext;
            $data['msg'] = "Tải file lên thành công";
        } else {
            $data['error'] = 1;
            $data['msg'] = "Tải file lên không thành công";
        }
        echo json_encode($data);
    }
    
    function del_img_tam(){
        $img_id = $this->request->post['id'];
        $rs = $this->db->row("SELECT * FROM tam WHERE id = $img_id");
        $path = $rs->path;
        if($this->db->delete('tam',array('id'=>$img_id))){
            unlink(ROOT.'data/tam/'.$path);
        }
    }
    
   // Tai anh cap nhat
    function uploader_edit(){
        $id = $this->uri->segment(3);
        $dir = ROOT.'data/tam/';
        $dir_admin = 'data/tam/';
        $size=$_FILES['Filedata']['size'];
        if($size>204857600)
        {
                $data['error'] = 1;
                $data['msg'] = "File quá lớn. Không thể tải lên";
        }            
        $filename = stripslashes($_FILES['Filedata']['name']);
        $i = strrpos($filename,".");
        if (!$i) { return ""; }
        $l = strlen($filename) - $i;
        $extension = substr($filename,$i+1,$l);                 
        $extension = strtolower($extension); 
        $file_name = str_replace($extension,'',$filename);
        $file_name = vnit_change_title($file_name);
        $filename = $dir.$file_name.'-'.time().'.'.$extension;
        $file_ext = $file_name.'-'.time().'.'.$extension;
        if (move_uploaded_file($_FILES['Filedata']['tmp_name'], $filename)) {
            $vdata['id'] = $id;
            $vdata['path'] = $file_ext;
            $this->db->insert('khachhang_img',$vdata);
            $this->load->helper('vimg');
            $folder_tam = ROOT.'data/tam/'.$file_ext;
            $folder_80 = ROOT.'data/khachhang/100/'.$file_ext;
            $folder_250 = ROOT.'data/khachhang/200/'.$file_ext;
            $folder_500 = ROOT.'data/khachhang/500/'.$file_ext;
            $default = ROOT.'data/khachhang/default/'.$file_ext;
                    
            copy($folder_tam, $default);
            $this->load->helper('vimg');
            vnit_resize_image($folder_tam,$folder_80,100,0,false);
            vnit_resize_image($folder_tam,$folder_250,250,0,false);
            vnit_resize_image($folder_tam,$folder_500,500,0,false);
            unlink($folder_tam);
            
            $data['id'] = $this->db->insert_id();
            $data['error'] = 0;
            $data['filename'] = $file_ext;
            $data['msg'] = "Tải file lên thành công";
        } else {
            $data['error'] = 1;
            $data['msg'] = "Tải file lên không thành công";
        }
        echo json_encode($data);
    }
    
    function del_img(){
        $img_id = $this->request->post['id'];
        $rs = $this->db->row("SELECT * FROM khachhang_img WHERE img_id = $img_id");
        $path = $rs->path;
        if($this->db->delete('khachhang_img',array('img_id'=>$img_id))){
            unlink(ROOT.'data/khachhang/100/'.$path);
            unlink(ROOT.'data/khachhang/200/'.$path);
            unlink(ROOT.'data/khachhang/500/'.$path);
            unlink(ROOT . 'data/khachhang/default/' . $path);
        }
    }
}
