<?php
class quanhuyen extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('quanhuyen_model','quanhuyen');
        $this->load->model('tuychon_model','tuychon');
        $this->ip = $this->config->item('ip_webservice');
    }
    
    function ds(){
        $id = segment(4,'int');
        if($id == 0){
            redirect('tuychon/chauluc');
        }
        $tinh = $this->quanhuyen->get_tinhthanh($id);
        $data['id'] = $id;
        $data['back'] = 'tuychon/tinhthanh/ds';
        $data['tinh'] = $tinh;
        $data['title'] = "Danh sách quận, huyện thuộc: ".$tinh->city_name;
        $list = $this->quanhuyen->get_all_quanhuyen($id);
        $data['num'] = count($list);
        $data['list'] = $list;
        $this->load->templates('quanhuyen/ds',$data);
    }
    
    function edit(){
        $dt = $this->request->post['id'];
        $name = $this->request->post['name'];
        $parentid = $this->request->post['parentid'];
        $vdata['city_name'] = $name;
        if($dt == 0){
            $vdata['parentid'] = $parentid;
            $this->db->insert('city',$vdata);
            $dt = $this->db->insert_id();
        }else{
            $this->db->update('city',$vdata,array('city_id'=>$dt));
        }
    }
    
    function del(){
        $id = segment(5,'int');
        $st = segment(4,'int');
        if($this->db->delete('city',array('city_id'=>$id))){
            $msg = "Xóa thành công";
        }else{
            $msg = "Xóa không thành công";
        }
        $this->session->set_flashdata('message',$msg);
        redirect('tuychon/quanhuyen/ds/'.$st);
    }
}
