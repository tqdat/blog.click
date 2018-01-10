<?php
class hotro extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('hotro_model','hotro');
        $this->pre_message = "";
    }
    
    function ds(){
        $this->cache_hotro();
        $data['title'] = "Hỗ trợ trực tuyến";
        $data['add'] = 'hotro/add';
        $config['base_url'] = base_url().'hotro/ds/';
        $config['suffix'] = '.html';
        $config['total_rows']   =  $this->hotro->get_num_hotro();
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   30; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->hotro->get_all_hotro($config['per_page'],segment(3,'int'));
        $data['pagination']    = $this->pagination->create_links(); 
        $this->load->templates('ds',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'hotro/ds';
        $this->form_validation->set_rules('vdata[name]','Tên','required');
        $this->form_validation->set_rules('vdata[nick]','Nick','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/support';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = '10000';
                $config['file_name'] =  vnit_change_title($vdata['name']);
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                       
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('error',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $vdata['images'] = $result['file_name'];  
                }                    
            }            
            if($this->db->insert('support',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'hotro/ds';
                }else{
                    $url = 'hotro/edit/'.$id;
                }
                redirect($url);                
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('add',$data);
    }    
    
    function edit(){
        $id = $this->uri->segment(3);
        $data['title'] = "Cập nhật";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'hotro/ds';
        $data['rs'] = $this->db->row("SELECT * FROM support WHERE id = $id");
        $this->form_validation->set_rules('vdata[name]','Tên','required');
        $this->form_validation->set_rules('vdata[nick]','Nick','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/support';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = '10000';
                $config['file_name'] =  vnit_change_title($vdata['name']);
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                       
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('error',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $vdata['images'] = $result['file_name'];  
                }                    
            } 
            if($this->db->update('support',$vdata,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'hotro/ds';
                }else{
                    $url = 'hotro/edit/'.$id;
                }
                redirect($url);                
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit',$data);
    }    
    
    function del(){
        $id = $this->uri->segment(3);
        if($this->db->delete('support',array('id'=>$id))){
            $this->session->set_flashdata('message','Xóa thành công');
        }else{
            $this->session->set_flashdata('message','Xóa không thành công');
        }
        redirect('hotro/ds');        
    }
    
    function cache_hotro(){
        $list = $this->hotro->get_list_hotro(0);
        $str ='<div class="SubMenu_Support">';
        $str .='<div class="SLeft">';
            foreach($list as $rs):
            $name = $rs->name;
            $nick = $rs->nick;
            $str .='<div class="yahoo"><a href="ymsgr:sendIM?'.$nick.'">'.$name.'</a></div>';
            endforeach;
        $str .='</div>';
        $str .='<div class="SRight">';
        $list = $this->hotro->get_list_hotro(1);
            foreach($list as $rs):
            $name = $rs->name;
            $nick = $rs->nick;
            $str .='<div class="skype"><a href="skype:'.$nick.'?chat">'.$name.'</a></div>';
            endforeach;
        $str .='</div>';
        $str .='</div>';

        $this->load->helper('file');
        write_file(ROOT.'site/config/support.html', $str); 
    }    
}
