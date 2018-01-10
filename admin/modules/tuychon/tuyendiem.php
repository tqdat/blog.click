<?php
class tuyendiem extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('tuyendiem_model','tuyendiem');
        $get = $this->request->get;
        $str = '?';
        foreach($get as $keys=>$val):
            $str .="&".$keys.'='.$val;
        endforeach;
        $this->str = $str;
    }
    
    function ds(){
        $loaihinh = $this->request->get['loaihinh'];
        $key = str_replace('+',' ',$this->request->get['key']);
        $st = $this->request->get['tinhthanh'];
        $ct = $this->request->get['quocgia'];
        $loaihinh = ($loaihinh == '')?'IN':$loaihinh;
        
        $data['loaihinh'] = $loaihinh;
        $data['st'] = $st;
        $data['ct'] = $ct;
        $data['key'] = $key;
        if($loaihinh == 'IN'){
            $tinh = ($st == '')?'':$st;
        }else{
            $tinh = ($ct == '')?'':$ct;
        }

        $data['title'] = "Danh sách Tuyến điểm";
        $data['add'] = 'tuychon/tuyendiem/add';
        $data['quocgia'] = $this->tuyendiem->get_all_quocgia();
        $data['tinhthanh'] = $this->tuyendiem->get_all_tinhthanh('VN');
        $config['base_url'] = base_url().'tuychon/tuyendiem/ds/';
        $config['suffix'] = $this->str;
        $config['total_rows']   =  $this->tuyendiem->get_num_tuyendiem($loaihinh, $tinh, $key);
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   20; 
        $config['uri_segment'] = 4; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->tuyendiem->get_all_tuyendiem($config['per_page'],segment(4,'int'),$loaihinh, $tinh, $key);
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('tuyendiem/ds',$data);
    }
    
    function edit(){
        $data['quocgia'] = $this->tuyendiem->get_all_quocgia();
        $data['tinhthanh'] = $this->tuyendiem->get_all_tinhthanh('VN');
        $td_id = segment(4,'int');
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tuychon/tuyendiem/ds';
        $data['rs'] = $this->tuyendiem->get_tuyendiem_vi($td_id);
        $data['en'] = $this->tuyendiem->get_tuyendiem_en($td_id);
        $data['title'] = "Cập nhật Tuyến điểm";
        $this->form_validation->set_rules('vi_name','Tuyến điểm (vi)','required');
        $this->form_validation->set_rules('en_name','Tuyến điểm (en)','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{

            $vi_name = $this->request->post['vi_name'];
            $en_name = $this->request->post['en_name'];
            $td_inbound = $this->request->post['td_inbound'];
            $tinhthanh = $this->request->post['tinhthanh'];
            $quocgia = $this->request->post['quocgia'];
            if($td_inbound == 'IN'){
                $vdata['td_state_id'] = $tinhthanh; 
            }else{
                $vdata['td_state_id'] = $quocgia;
            }
            $vdata['td_inbound'] = $td_inbound;
            if($this->db->update('dl_tour_tuyendiem',$vdata,array('td_id'=>$td_id))){
                 $vdata_vi['name'] = $vi_name;
                 $this->db->update('dl_tour_tuyendiem_des',$vdata_vi,array('tuyendiem_id'=>$td_id,'lang_id'=>1));
                 $vdata_en['name'] = $en_name;
                 $this->db->update('dl_tour_tuyendiem_des',$vdata_en,array('tuyendiem_id'=>$td_id,'lang_id'=>2));
                 $this->session->set_flashdata('message',"Lưu thành công");
                 redirect('tuychon/tuyendiem/ds/'.$this->str);
            }
        }
        $data['message']= $this->pre_message;
        $this->load->templates('tuyendiem/edit',$data);
    }
    
    
    function add(){
        $data['td_inbound_show'] = 'IN';
        $data['quocgia'] = $this->tuyendiem->get_all_quocgia();
        $data['tinhthanh'] = $this->tuyendiem->get_all_tinhthanh('VN');
        $td_id = segment(4,'int');
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tuychon/tuyendiem/ds';
        $data['title'] = "Thêm mới Tuyến điểm";
        $this->form_validation->set_rules('vi_name','Tuyến điểm (vi)','required');
        $this->form_validation->set_rules('en_name','Tuyến điểm (en)','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{

            $vi_name = $this->request->post['vi_name'];
            $en_name = $this->request->post['en_name'];
            $td_inbound = $this->request->post['td_inbound'];
            $tinhthanh = $this->request->post['tinhthanh'];
            $quocgia = $this->request->post['quocgia'];
            if($td_inbound == 'IN'){
                $vdata['td_state_id'] = $tinhthanh; 
            }else{
                $vdata['td_state_id'] = $quocgia;
            }
            $vdata['td_inbound'] = $td_inbound;
            if($this->db->insert('dl_tour_tuyendiem',$vdata)){
                $td_id = $this->db->insert_id();
                 $vdata_vi['name'] = $vi_name;
                 $vdata_vi['tuyendiem_id'] = $td_id;
                 $vdata_vi['lang_id'] = 1;
                 $this->db->insert('dl_tour_tuyendiem_des',$vdata_vi);
                 $vdata_en['name'] = $en_name;
                 $vdata_en['tuyendiem_id'] = $td_id;
                 $vdata_en['lang_id'] = 2;
                 $this->db->insert('dl_tour_tuyendiem_des',$vdata_en);
                 $this->session->set_flashdata('message',"Lưu thành công");
                 redirect('tuychon/tuyendiem/ds/'.$this->str);
            }
        }
        $data['message']= $this->pre_message;
        $this->load->templates('tuyendiem/add',$data);
    }
    
    function del(){
        $td_id= segment(4);
        if($this->db->delete('dl_tour_tuyendiem',array('td_id'=>$td_id))){
            $this->db->delete('dl_tour_tuyendiem_des',array('tuyendiem_id'=>$td_id));
            $msg = "Xóa thành công";
        }else{
            $msg = "Xóa không thành công";
        }
         $this->session->set_flashdata('message',$msg);
         redirect('tuychon/tuyendiem/ds/'.$this->str);
    }
}
