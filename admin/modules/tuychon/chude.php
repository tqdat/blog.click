<?php
class chude extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('chude_model','chude');
    }
    function ds(){
        $data['title'] = "Danh sách Chủ đề Tour";
        $data['add'] = 'tuychon/chude/add';
        $config['base_url'] = base_url().'tuychon/chude/ds/';
        $config['total_rows']   =  $this->chude->get_num_chude();
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   20; 
        $config['uri_segment'] = 4; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->chude->get_all_chude($config['per_page'],segment(4,'int'));
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('chude/ds',$data);
    }
    
    function edit(){
        $ctd_id = segment(4,'int');
        $page = segment(5,'int');
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tuychon/chude/ds';
        $data['rs'] = $this->chude->get_chude_vi($ctd_id);
        $data['en'] = $this->chude->get_chude_en($ctd_id);
        $data['title'] = "Cập nhật Chủ đề Tour";
        $this->form_validation->set_rules('vi_name','Chủ đề (vi)','required');
        $this->form_validation->set_rules('en_name','Chủ đề (en)','required');
        $this->form_validation->set_rules('order','Sắp xếp','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $order = $this->request->post['order'];
            $vi_name = $this->request->post['vi_name'];
            $en_name = $this->request->post['en_name'];
            $vdata['cdt_order'] = $order;
            if($this->db->update('dl_tour_chude',$vdata,array('cdt_id'=>$ctd_id))){
                 $vdata_vi['name'] = $vi_name;
                 $this->db->update('dl_tour_chude_des',$vdata_vi,array('tour_chude_id'=>$ctd_id,'lang_id'=>1));
                 $vdata_en['name'] = $en_name;
                 $this->db->update('dl_tour_chude_des',$vdata_en,array('tour_chude_id'=>$ctd_id,'lang_id'=>2));
                 $this->session->set_flashdata('message',"Lưu thành công");
                 redirect('tuychon/chude/ds/'.$page);
            }
        }
        $data['message']= $this->pre_message;
        $this->load->templates('chude/edit',$data);
    }
    
    
    function add(){
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tuychon/chude/dslv';
        $data['title'] = "Thêm mới Chủ đề Tour";
        $this->form_validation->set_rules('vi_name','Loại lĩnh vực (vi)','required');
        $this->form_validation->set_rules('en_name','Loại lĩnh vực (en)','required');
        $this->form_validation->set_rules('order','Sắp xếp','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $order = $this->request->post['order'];
            $vi_name = $this->request->post['vi_name'];
            $en_name = $this->request->post['en_name'];
            $vdata['cdt_order'] = $order;
            if($this->db->insert('dl_tour_chude',$vdata)){
                 $cdt_id = $this->db->insert_id();
                 $vdata_vi['name'] = $vi_name;
                 $vdata_vi['tour_chude_id'] = $cdt_id;
                 $vdata_vi['lang_id'] = 1;
                 $this->db->insert('dl_tour_chude_des',$vdata_vi);
                 $vdata_en['name'] = $en_name;
                 $vdata_en['tour_chude_id'] = $cdt_id;
                 $vdata_en['lang_id'] = 2;
                 $this->db->insert('dl_tour_chude_des',$vdata_en);
                 $this->session->set_flashdata('message',"Lưu thành công");
                 redirect('tuychon/chude/ds');
            }
        }
        $data['message']= $this->pre_message;
        $this->load->templates('chude/add',$data);
    }
    
    function del(){
        $cdt_id= segment(4,'int');
        $page= segment(5,'int');
        if($this->db->delete('dl_tour_chude',array('cdt_id'=>$cdt_id))){
            $this->db->delete('dl_tour_chude_des',array('tour_chude_id'=>$cdt_id));
            $msg = "Xóa thành công";
        }else{
            $msg = "Xóa không thành công";
        }
         $this->session->set_flashdata('message',$msg);
         redirect('tuychon/chude/ds/'.$page);
    }
}
