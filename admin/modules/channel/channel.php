<?php
class channel extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('channel_model','channel');
        $this->pre_message = "";
    }
    
    function ds(){
        $catid = get_var('catid','int');
        $data['listcat'] = $this->channel->get_all_cat();
        $data['title'] = "Danh sách kênh tin";
        $data['add'] = 'channel/add';
        $data['catid'] = $catid;
        $config['base_url'] = base_url().'channel/ds/';
        $config['suffix'] = '.html'.($catid != 0)?'?catid='.$catid:'';
        $config['total_rows']   =  $this->channel->get_num_channel($catid);
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   20; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->channel->get_all_channel($config['per_page'],segment(3,'int'),$catid);
        $data['pagination']    = $this->pagination->create_links();        
        $this->load->templates('channel/ds',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới kênh tin";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'channel/ds';
        $data['list'] = $this->channel->get_all_cat();
        $this->form_validation->set_rules('vdata[channel_name]','Kênh tin','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['channel_slug'] = vnit_change_title($vdata['channel_name']);
            $vdata['channel_date'] = time();
            if($this->db->insert('channel',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'channel/ds';
                }else{
                    $url = 'channel/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('channel/add',$data);
    }
    
    function edit(){
        $id = segment(3,'int');
        $page = segment(4,'int');
        $data['title'] = "Cập nhật kênh tin";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'channel/ds/'.$page;
        $data['list'] = $this->channel->get_all_cat();
        $data['rs'] = $this->db->row("SELECT * FROM channel WHERE channel_id = $id");
        $this->form_validation->set_rules('vdata[channel_name]','Kênh tin','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['channel_slug'] = vnit_change_title($vdata['channel_name']);
            if($this->db->update('channel',$vdata,array('channel_id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'channel/ds/'.$page;
                }else{
                    $url = uri_string();
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('channel/edit',$data);
    }
    
    function del(){
        $id = $this->uri->segment(3);
        $page = $this->uri->segment(4);
        if($this->db->delete('channel',array('channel_id'=>$id))){
            $this->session->set_flashdata('message','Xóa thành công');
        }else{
            $this->session->set_flashdata('message','Xóa không thành công');
        }
        redirect('channel/ds/'.$page);
    }
}
