<?php
class vitri extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('vitri_model','vitri');
    }
    
    /******************************Main cat************************************/
    function ds(){
        $c = $this->request->get['c'];
        $d = $this->request->get['d'];
        $data['title'] = "Danh sách vị trí";
        $data['add'] = 'vitri/add';
        $data['allcity'] = $this->vitri->get_all_city();
        if($c == ''){
            $c = $data['allcity'][0]->catid;
        }
        $data['c'] = $c;
        $data['d'] = $d;
        $data['list'] = $this->vitri->get_all((int)$c, (int)$d);
        $data['diadiem'] = $this->vitri->get_diadiem($c);
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
        $data['cancel'] ='vitri/ds/';
        $data['title'] = "Thêm mới vị trí";
        $data['allcity'] = $this->vitri->get_all_city();
        $this->form_validation->set_rules('vdata[vitri_ten]','Vị trí','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['vitri_slug'] = vnit_change_title($vdata['vitri_ten']);
            
            if($this->db->insert('vitri',$vdata)){
                $catid = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'vitri/ds/?c='.$vdata['catid'].'&d='.$vdata['d_id'];
                }else{
                    $url = 'vitri/edit/'.$catid.'/?c='.$vdata['catid'].'&d='.$vdata['d_id'];
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
        $data['cancel'] ='vitri/ds/?c='.$this->request->get['c'].'&d='.$this->request->get['d'];
        $data['title'] = "Cập nhật vị trí";
        $data['rs'] = $this->db->row("SELECT * FROM vitri WHERE vitri_id = $id");
        $data['allcity'] = $this->vitri->get_all_city();
        $data['diadiem'] = $this->vitri->get_diadiem($data['rs']->catid);
        $this->form_validation->set_rules('vdata[vitri_ten]','Vị trí','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $catid = $this->request->post['catid'];
            $vdata = $this->request->post['vdata'];
            $vdata['vitri_slug'] = vnit_change_title($vdata['vitri_ten']);
            
            if($this->db->update('vitri',$vdata,array('vitri_id'=>$catid))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                    $url = 'vitri/ds/?c='.$vdata['catid'].'&d='.$vdata['d_id'];
                }else{
                    $url = 'vitri/edit/'.$catid.'/?c='.$vdata['catid'].'&d='.$vdata['d_id'];
                }
                redirect($url);
            }
        } 
        $data['message']  = $this->pre_message; 
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = segment(3,'int');
        $total = $this->vitri->total_hotel($id);
        if($total > 0){
            $this->session->set_flashdata("message",'Không thể xóa. Còn khách sạn ở vị trí này');
        }else{
            if($this->db->delete('vitri',array('vitri_id'=>$id))){
                $this->session->set_flashdata('message','Xóa thành công');
            }else{
                $this->session->set_fashdata('message','Xóa không thành công');
            }
        }
        redirect('vitri/ds/'.$catid);
    }
    
    function diadiem(){
        $catid = $this->request->post['catid'];
        $list = $this->vitri->get_diadiem($catid);
        $ds = '<option value="0">Chọn địa điểm</option>';
        foreach($list as $rs):
            $ds .='<option value="'.$rs->d_id.'">'.$rs->d_name.'</option>';
        endforeach;
        $data['ds'] = $ds;
        echo json_encode($data);
    }
}
