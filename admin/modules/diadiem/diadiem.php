<?php
class diadiem extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('diadiem_model','diadiem');
        $get = $this->request->get;
        $str = '';
        foreach($get as $key=>$val):
            $str .="&".$key."=".$val;
        endforeach;
        $this->str = ltrim($str,'&');
        $this->str = ($this->str == '')?'':"?".$this->str;
    }
    
    /******************************Main cat************************************/
    function ds(){
        $c = $this->request->get['c'];
        $s = $this->request->get['s'];
        $data['c'] = $c;
        $data['s'] = $s;
        $data['allcountry'] = $this->diadiem->get_all_quocgia();
        $country = $this->diadiem->get_item_quocgia($c);
        $city = $this->diadiem->get_item_city($s);
        $title = "Danh sách địa điểm: ";
        if($city){
            $title .= $city->city_name.', ';
        }
        $title .=$country->ct_name;
        $data['title'] = $title;  
        $data['add'] = 'diadiem/add/'.$this->str;
        $data['city'] = $this->diadiem->get_all_city($c);
        $config['base_url'] = base_url().'diadiem/ds/';
        $config['suffix'] = '/'.$this->str;
        $config['total_rows']   =  $this->diadiem->get_num($c, $s);
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   20; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->diadiem->get_all($config['per_page'],segment(3,'int'), $c, $s);
        $data['pagination']    = $this->pagination->create_links();
        
        $this->load->templates('ds',$data);
    }
    

    function save_order_maincat(){
        $id = $this->request->post['id'];
        for($i = 0; $i < sizeof($id); $i++){
            $vdata['ordering'] = $this->request->post['order_'.$id[$i]];
            $this->db->update('pcat',$vdata,array('catid'=>$id[$i]));
        }
    }

    
    function add(){
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] ='diadiem/ds/'.$this->str;
        $data['title'] = "Thêm mới địa điểm";
        
        $data['c'] = $this->request->get['c'];
        $data['s'] = $this->request->get['s'];
        $data['allcountry'] = $this->diadiem->get_all_quocgia();
        $data['city'] = $this->diadiem->get_all_city($data['c']);
        $this->form_validation->set_rules('vdata[d_name]','Địa điểm','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            //$vdata['d_slug'] = vnit_change_title($vdata['d_name']);
            
            if($this->db->insert('diadiem',$vdata)){
                $d_id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'diadiem/ds/?c='.$vdata['ct_id'].'&s='.$vdata['catid'];
                }else{
                    $url = 'diadiem/edit/'.$d_id.'/?c='.$vdata['ct_id'].'&s='.$vdata['catid'];
                }
                redirect($url);
            }
        } 
        $data['message']  = $this->pre_message;
        $this->load->templates('add',$data);
    }
    
    function edit(){
        $id = $this->uri->segment(3);
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] ='diadiem/ds/'.$this->str;
        $data['title'] = "Cập nhật địa điểm";
        $data['rs'] = $this->db->row("SELECT * FROM diadiem WHERE d_id = $id");
        $data['allcountry'] = $this->diadiem->get_all_quocgia();
        $data['city'] = $this->diadiem->get_all_city($data['rs']->ct_id);
        $this->form_validation->set_rules('vdata[d_name]','Địa điểm','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            if($this->db->update('diadiem',$vdata,array('d_id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'diadiem/ds/'.$this->str;
                }else{
                    $url = 'diadiem/edit/'.$id.'/?c='.$vdata['ct_id'].'&s='.$vdata['catid'];
                }
                redirect($url);
            }
        } 
        $data['message']  = $this->pre_message; 
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = segment(3,'int');
        if($this->db->delete('diadiem',array('d_id'=>$id))){
            $this->session->set_flashdata('message','Xóa thành công');
        }else{
            $this->session->set_fashdata('message','Xóa không thành công');
        }
        redirect('diadiem/ds/'.$this->str);
    }
    
    function ajax_city(){
        $ct_id = $this->request->post['ct_id'];
        $city_id = $this->request->post['city_id'];
        $list = $this->diadiem->get_all_city($ct_id);
        $str ='<option value="0">Chọn Tỉnh, Thành phố</option>';
        foreach($list as $rs):
            $select = ($rs->city_id == $city_id)?'selected="selected"':'';
            $str .='<option value="'.$rs->city_id.'" '.$select.'>'.$rs->city_name.'</option>';
        endforeach;
        $data['ds'] = $str;
        echo json_encode($data);
    }
    
    function save_order(){
        $id = $_POST['id'];
        for($i = 0 ; $i< sizeof($id);$i++){
            $menu['d_order'] = $_POST['order_'.$id[$i]];
            $this->db->update('diadiem',$menu,array('d_id'=>$id[$i]));
        }
    }
}
