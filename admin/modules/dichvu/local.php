<?php
class local extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('local_model','local');
        $this->pre_message = "";
    }
    
    function ds(){
        $data['title'] = "Danh sách dịch vụ";
        $data['add'] = 'dichvu/local/add';
        $get = $this->request->get;
        if(count($get) > 0){
            $str ='?';
            foreach($get as $val=>$key){
                $str.=$val.'='.$key.'&';
            }
        }else{
            $str ='';
        }
        $str = trim($str,'&');
        $catid = get_var('catid','int');
        $city_id = get_var('city_id','int');
        $district_id = get_var('district_id','int');
        $key = $this->request->get['key'];
        $data['city_id'] = $city_id;
        $data['district_id'] = $district_id;
        $data['key'] = $key;
        $data['catid'] = $catid;
        $data['licat'] = $this->local->get_all_cat();
        $data['list_city'] = $this->local->get_all_city();
        
        $config['base_url'] = base_url().'dichvu/local/ds/';
        $config['suffix'] = '/'.$str;
        $config['total_rows']   =  $this->local->get_num_local($catid, $city_id, $district_id, $key);
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   15; 
        $config['uri_segment'] = 4; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->local->get_all_local($config['per_page'],segment(4,'int'),$catid, $city_id, $district_id, $key);
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('local/ds',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới thông tin du lịch";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'dichvu/local/ds';
        $data['listcity'] = $this->local->get_all_city();
        $data['listdistrict'] = $this->local->get_all_district($data['listcity'][0]->city_id);
        $data['dscat'] = $this->local->get_all_cat();
        $this->form_validation->set_rules('vdata[title]','Tên địa danh','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $this->load->helper('vimg');
            $vdata = $this->request->post['vdata'];
            $vdata['slug'] = vnit_change_title($vdata['title']);
            $vdata['content'] = $this->request->post['content'];
            $vdata['noibat'] = $this->request->post['noibat'];
            $vdata['city_slug'] = $this->local->get_url_city($vdata['city_id']);
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/service/500/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = '10000';
                $config['file_name'] =  $vdata['slug'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                       
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('error',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $img = $result['file_name'];
                    $vdata['images'] = $img;
                    vnit_resize_image(ROOT.'data/service/500/'.$img, ROOT.'data/service/80/'.$img, 80,0,false);
                    vnit_resize_image(ROOT.'data/service/500/'.$img, ROOT.'data/service/200/'.$img, 200,0,false);
                }                    
            }
            if($this->db->insert('dichvu',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'dichvu/local/ds/';
                }else{
                    $url = 'dichvu/local/edit/'.$id;
                }
                redirect($url);
            }
        } 
        $data['message']  = $this->pre_message;
        $this->load->templates('local/add',$data);
    }
    
    function edit(){
        $id = segment(4,'int');
        $page = segment(5,'int');
        $get = $this->request->get;
        if(count($get) > 0){
            $str ='?';
            foreach($get as $val=>$key){
                $str.=$val.'='.$key.'&';
            }
        }else{
            $str ='';
        }
        $str = trim($str,'&');
        $data['rs'] =  $this->db->row("SELECT * FROM dichvu WHERE id = $id");
        $data['title'] = "Cập nhật dịch vụ";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'dichvu/local/ds/'.$page.'/'.$str;
        $data['listcity'] = $this->local->get_all_city();
        $data['listdistrict'] = $this->local->get_all_district($data['rs']->city_id);
        $data['dscat'] = $this->local->get_all_cat();
        $this->form_validation->set_rules('vdata[title]','Tên địa danh','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $this->load->helper('vimg');
            $vdata = $this->request->post['vdata'];
            $vdata['slug'] = vnit_change_title($vdata['title']);
            $vdata['content'] = $this->request->post['content'];
            $vdata['noibat'] = $this->request->post['noibat'];
            $vdata['city_slug'] = $this->local->get_url_city($vdata['city_id']);
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/service/500/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = '10000';
                $config['file_name'] =  $vdata['slug'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                       
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('error',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $img = $result['file_name'];
                    $vdata['images'] = $img;
                    vnit_resize_image(ROOT.'data/service/500/'.$img, ROOT.'data/service/80/'.$img, 80,0,false);
                    vnit_resize_image(ROOT.'data/service/500/'.$img, ROOT.'data/service/200/'.$img, 200,0,false);
                }                    
            }
            if($this->db->update('dichvu',$vdata,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'dichvu/local/ds/'.$page.'/'.$str;
                }else{
                    $url = uri_string();
                }
                redirect($url);
            }
        } 
        $data['message']  = $this->pre_message;
        $this->load->templates('local/edit',$data);
    }
    
    function del(){
        $id = segment(4,'int');
        $page = segment(5,'int');
        $get = $this->request->get;
        if(count($get) > 0){
            $str ='?';
            foreach($get as $val=>$key){
                $str.=$val.'='.$key.'&';
            }
        }else{
            $str ='';
        }
        $str = trim($str,'&');        
        if($this->db->delete('dichvu',array('id'=>$id))){
            $msg = "Xóa thành công";
        }else{
            $msg = "Xóa không thành công";
        }
        $this->session->set_flashdata('message',$msg);
        redirect('dichvu/local/ds/'.$page.'/'.$str);
    }
}
