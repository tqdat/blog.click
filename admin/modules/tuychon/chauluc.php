<?php
class chauluc extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('chauluc_model','chauluc');
        $this->load->model('tuychon_model','tuychon');
    }    
    
    function ds(){
        $data['title'] = "Danh sách Châu lục";
        $data['add'] = 'tuychon/chauluc/add';
        $list = $this->tuychon->get_all_chauluc();
        $data['num'] = count($list);
        $data['list'] = $list;
        $this->load->templates('chauluc/ds',$data);
    }
    
    function edit(){
        $id = $this->request->post['id'];
        $name = $this->request->post['name'];
        $vdata['name'] = $name;
        if($this->db->update('dc_continent',$vdata,array('id'=>$id))){
            $data['error'] = 0;
        }else{
            $data['error'] = 1;
        }
        echo json_encode($data);
    }
    
    function del(){
        $id = segment(4,'int');
        $total = $this->tuychon->get_num_quocgia($id);
        if($total > 0){
            $msg = "Không thể xóa. Vẫn còn quốc gia tồn tại bên trong";
        }else{
            $msg = "Xóa thành công";
        }
        $this->session->set_flashdata('message',$msg);
        redirect('tuychon/chauluc/ds');
    }
}
