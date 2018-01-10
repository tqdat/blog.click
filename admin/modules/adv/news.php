<?php
class news extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('adv_model','adv');
        $this->pre_message = "";
    }
    
    function ds(){
        $data['title'] = "Danh sách quảng cáo trang tin tức";
        $data['add'] = 'adv/news/add';
        $data['list'] = $this->adv->get_list_news();
        $this->load->templates('news/index',$data);
    }
    
    function add(){
        $data['title'] = "Thêm quảng cáo trang tin tức";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'adv/news/ds';
        $data['listcat'] = $this->adv->get_all_cat_news();
        $data['vitri'] = $this->adv->get_all_news_vitri();
        $this->form_validation->set_rules('vdata[name]','Tên quảng cáo','required');
        $this->form_validation->set_rules('vdata[link]','Hình ảnh','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $ar_id = $this->request->post['ar_id'];
            $vdata = $this->request->post['vdata'];
            $begin_h = $this->request->post['begin_h'];
            $begin_i = $this->request->post['begin_i'];
            $begin = $this->request->post['begin'];
            $end_h = $this->request->post['end_h'];
            $end_i = $this->request->post['end_i'];
            $end = $this->request->post['end'];
            $vitri = $this->adv->get_item_vitri($vdata['vitri']);
            $vdata['width'] = $vitri->width;
            $vdata['height'] = $vitri->height;

            $vdata['date_begin'] = strtotime($begin.' '.$begin_h.':'.$begin_i);
            $vdata['date_end'] = strtotime($end.' '.$end_h.':'.$end_i);
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/adv/';
                $config['allowed_types'] = 'gif|jpg|png|swf';
                $config['max_size']    = '10000';
                $config['file_name'] =  vnit_change_title($vdata['name']);  
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('message',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $vdata['img'] = $result['file_name'];  
                    $vdata['ext'] = str_replace('.','',$result['file_ext']);
                }                    
            }
            if($this->db->insert('adv_news',$vdata)){
                $id = $this->db->insert_id();
                for($i = 0; $i < sizeof($ar_id); $i++){
                    $row = $ar_id[$i];
                    if($row){
                        $vcat['id'] = $id;
                        $vcat['catid'] = $row;
                        $this->db->insert('adv_news_cat',$vcat);
                    }
                }
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'adv/news/ds';
                }else{
                    $url = 'adv/news/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('news/add',$data);
    }
    
    function edit(){
        $data['title'] = "Cập nhật quảng cáo trang tin tức";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'adv/news/ds';
        $id = segment(4,'int');
        $data['rs'] = $this->db->row("SELECT * FROM adv_news WHERE id = $id");
        $data['listcat'] = $this->adv->get_all_cat_news();
        $data['vitri'] = $this->adv->get_all_news_vitri();
        $this->form_validation->set_rules('vdata[name]','Tên quảng cáo','required');
        $this->form_validation->set_rules('vdata[link]','Hình ảnh','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $id = $this->request->post['id'];
            $ar_id = $this->request->post['ar_id'];
            $vdata = $this->request->post['vdata'];
            $begin_h = $this->request->post['begin_h'];
            $begin_i = $this->request->post['begin_i'];
            $begin = $this->request->post['begin'];
            $end_h = $this->request->post['end_h'];
            $end_i = $this->request->post['end_i'];
            $end = $this->request->post['end'];
            $vitri = $this->adv->get_item_vitri($vdata['vitri']);
            $vdata['width'] = $vitri->width;
            $vdata['height'] = $vitri->height;
            $vdata['date_begin'] = strtotime($begin.' '.$begin_h.':'.$begin_i);
            $vdata['date_end'] = strtotime($end.' '.$end_h.':'.$end_i);
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/adv/';
                $config['allowed_types'] = 'gif|jpg|png|swf';
                $config['max_size']    = '10000';
                $config['file_name'] =  vnit_change_title($vdata['name']);
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('message',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $vdata['img'] = $result['file_name'];  
                    $vdata['ext'] = str_replace('.','',$result['file_ext']);
                }                    
            }
            if($this->db->update('adv_news',$vdata,array('id'=>$id))){
                $this->db->delete('adv_news_cat',array('id'=>$id));
                for($i = 0; $i < sizeof($ar_id); $i++){
                    $row = $ar_id[$i];
                    if($row){
                        $vcat['id'] = $id;
                        $vcat['catid'] = $row;
                        $this->db->insert('adv_news_cat',$vcat);
                    }
                }
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'adv/news/ds';
                }else{
                    $url = uri_string();
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('news/edit',$data);
    }
    
    function del(){
        $id = segment(4,'int');
        $rs = $this->db->row("SELECT * FROM adv_news WHERE id = $id");
        $img = $rs->img;
        if($this->db->delete('adv_news',array('id'=>$id))){
            if(file_exists(ROOT.'data/adv/'.$img)){
                unlink(ROOT.'data/adv/'.$img);
            }
            $this->session->set_flashdata('message','Xóa thành công');
        }else{
            $this->session->set_flashdata('message','Xóa không thành công');
        }
        redirect('adv/news/ds');
    } 
    
    function cache_adv(){
        $this->load->helper('file');
        $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* Date: ".date('d/m/y H:i:s').".\n**/";
        $list = $this->adv->get_is_home();
        
        foreach($list1 as $rs1):
            $cat2_id = $rs2->catid;
            $cat2_name = $rs2->name;
            $cat2_slug = $rs2->slugcat;
            $str .= "\n\$config['cat_".$catid."_".$i."_".$j."'] = $cat2_id;";
            $str .= "\n\$config['name_".$catid."_".$i."_".$j."'] = '$cat2_name';";
            $str .= "\n\$config['slug_".$catid."_".$i."_".$j."'] = '$cat2_slug';";  
        endforeach;
        
        write_file(ROOT.'site/config/cat/config_cat'.$rs->catid.'.php', $str);    
    }
}