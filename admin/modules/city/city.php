<?php
class city extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('city_model','city');
        $this->pre_message = "";
        $this->cache_city();
    }
    
    function ds(){
        $data['title'] = "Tỉnh, Thành phố";
        $data['add'] = 'city/add';
        $config['base_url'] = base_url().'city/ds/';
        $config['suffix'] = '.html';
        $config['total_rows']   =  $this->city->get_num_city(0);
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   30; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->city->get_all_city($config['per_page'],segment(3,'int'),0);
        $data['pagination']    = $this->pagination->create_links(); 
        $this->load->templates('ds',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới thành phố";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'city/ds';
        $this->form_validation->set_rules('vdata[city_name]','Tỉnh, thành phố','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['city_url'] = vnit_change_title($vdata['city_name']);
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/img/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = '10000';
                $config['file_name'] =  $data['slug'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                       
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('error',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $vdata['icon'] = $result['file_name'];  
                    
                }                    
            }            
            if($this->db->insert('city',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'city/ds';
                }else{
                    $url = 'city/edit/'.$id;
                }
                redirect($url);                
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('add',$data);
    }
    
    function edit(){
        $id = segment(3,'int');
        $data['title'] = "Cập nhật thành phố";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'city/ds';
        $data['rs'] = $this->db->row("SELECT * FROM city WHERE city_id = $id");
        $this->form_validation->set_rules('vdata[city_name]','Tỉnh, thành phố','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['city_url'] = vnit_change_title($vdata['city_name']);
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/img/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = '10000';
                $config['file_name'] =  $data['slug'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                       
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('error',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $vdata['icon'] = $result['file_name'];  
                    
                }                    
            } 
            if($this->db->update('city',$vdata,array('city_id'=>$id))){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'city/ds';
                }else{
                    $url = 'city/edit/'.$id;
                }
                redirect($url);                
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = segment(3,'int');
        $total = $this->city->check_total_district($id);
        if($total > 0){
            $msg = "Thành phố này vẫn còn quận, huyện không thể xóa";
        }else{
            if($this->db->delete('city',array('city_id'=>$id))){
                $msg = "Xóa thành công";
            }else{
                $msg = "Xóa không thành công";
            }
        }
        $this->session->set_flashdata('message',$msg);
        redirect('city/ds');
    }
    
    // Quan Huyen
    function district(){
        $city_id = (int)$this->request->get['c'];

        $listcity = $this->city->get_list_city();
        if($city_id == 0){
            $city_id = $listcity[0]->city_id;
        }
        $row = $this->db->row("SELECT * FROM city WHERE city_id = $city_id");
        $data['listcity'] = $listcity;
        $data['city_id'] = $city_id;
        $data['title'] = "Quận huyện: ".$row->city_name;
        $data['add'] = 'city/add_district/'.$city_id;
        $config['base_url'] = base_url().'city/district/';
        $config['suffix'] = '?c='.$city_id;
        $config['total_rows']   =  $this->city->get_num_district($city_id);
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   30; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->city->get_all_district($config['per_page'],segment(3,'int'),$city_id);
        $data['pagination']    = $this->pagination->create_links(); 
        $this->load->templates('district',$data);
    }
    
    function add_district(){
        $city_id  = $this->uri->segment(3);
        $data['title'] = "Thêm mới quận huyện";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'city/district/?c='.$city_id;
        $data['listcity'] = $this->city->get_list_city();
        $this->form_validation->set_rules('vdata[city_name]','Tỉnh, thành phố','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['city_url'] = vnit_change_title($vdata['city_name']);
            if($this->db->insert('city',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'city/district/?c='.$vdata['parentid'];
                }else{
                    $url = 'city/edit_district/'.$vdata['parentid'].'/'.$id;
                }
                redirect($url);                
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('add_district',$data);
    }
    
    function edit_district(){
        $id = segment(4,'int');
        $city_id = segment(3,'int');
        $data['title'] = "Cập nhật Quận, Huyện";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'city/district/?c='.$city_id;
        $data['listcity'] = $this->city->get_list_city();
        $data['rs'] = $this->db->row("SELECT * FROM city WHERE city_id = $id");
        $this->form_validation->set_rules('vdata[city_name]','Quận, Huyện','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['city_url'] = vnit_change_title($vdata['city_name']);
            if($this->db->update('city',$vdata,array('city_id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'city/district/?c='.$vdata['parentid'];
                }else{
                    $url = 'city/edit_district/'.$vdata['parentid'].'/'.$id;
                }
                redirect($url);                
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit_district',$data);
    }
    
    function del_district(){
        $city_id = segment(3,'int');
        $id = segment(4,'int');
        if($this->db->delete('city',array('city_id'=>$id))){
            $msg = "Xóa thành công";
        }else{
            $msg = "Xóa không thành công";
        }
        $this->session->set_flashdata('message',$msg);
        redirect('city/district/?c='.$city_id);
    }
    
    
    function cache_city(){
        $list = $this->city->get_list_city();
        $total = count($list);
        $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* File Config_city \n* Date: ".date('d/m/y H:i:s').".\n**/";
        $str .= "\n\$config['total_city'] = $total;"; 
        $i = 1;
        foreach($list as $rs):
            $sub = $this->city->get_list_district($rs->city_id);
            $t_sub = count($sub);
            $city_id = $rs->city_id;
            $city_name = $rs->city_name;
            $city_url = $rs->city_url;
            $str .= "\n\$config['c_id_$i'] = $city_id;"; 
            $str .= "\n\$config['c_name_$i'] = '$city_name';"; 
            $str .= "\n\$config['c_url_$i'] = '$city_url';"; 
            $str .= "\n\$config['total_sub_$i'] = $t_sub;";
                $k = 1; 
                foreach($sub as $rs1):
                    $city_id1 = $rs1->city_id;
                    $city_name1 = $rs1->city_name;
                    $city_url1 = $rs1->city_url;
                    $str .= "\n\$config['c_id_".$city_id."_$k'] = $city_id1;"; 
                    $str .= "\n\$config['c_name_".$city_id."_$k'] = '$city_name1';"; 
                    $str .= "\n\$config['c_url_".$city_id."_$k'] = '$city_url1';"; 
                    $k++;
                endforeach;
        $i++;
        endforeach;
        $this->load->helper('file');
        write_file(ROOT.'site/config/config_city.php', $str); 
    }
}
