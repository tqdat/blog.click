<?php
class chude extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('chude_model','chude');
        $this->write_route();
    }
    
    function ds(){
        $data['title'] = "Chủ đề Tour";
        $data['add'] = 'chude/add';
        $data['list'] = $this->chude->get_all_loai();
        $this->load->templates('ds',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới chủ đề";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'chude/ds';
        $this->form_validation->set_rules('vdata[ten_chude]','Tên chủ đề','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['slug_chude'] = vnit_change_title($vdata['ten_chude']);
            if($this->db->insert('chude',$vdata)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'chude/ds';
                }else{
                    $url = 'chude/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('add',$data);
    }
    
    
    function edit(){
        $id = $this->uri->segment(3);
        $data['rs'] = $this->db->row("SELECT * FROM chude WHERE id_chude = $id");
        $data['title'] = "Cập nhật chủ đề Tour";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'chude/ds';
        $this->form_validation->set_rules('vdata[ten_chude]','Tên chủ đề','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['slug_chude'] = vnit_change_title($vdata['ten_chude']);
            if($this->db->update('chude',$vdata,array('id_chude'=>$id))){

                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'chude/ds';
                }else{
                    $url = 'chude/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = $this->uri->segment(3);
        $total = $this->chude->check_total_hotel($id);
        if($total > 0){
            $msg = "Không thể xóa. Vẫn còn tồn tại khách sạn trong chủ đề này!";
        }else{
            if($this->db->delete('chude',array('id_chude'=>$id))){
                $msg = "Xóa thành công";
            }else{
                $msg = "Xóa không thành công";
            }                                 
        }
        redirect('chude/ds');
    }
    
    function write_route(){
        $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* File Router_Tour \n* Date: ".date('d/m/y H:i:s').".\n**/";
        $list = $this->chude->get_all_loai();
        
        foreach($list as $rs):
            $slug =  $rs->slug_chude;
            $str .= "\n\$route['".$slug."'] = 'tour/chude';";
            $str .= "\n\$route['".$slug."/(:num)'] = 'tour/chude/$1';";
        endforeach;
        $this->load->helper('file');
        write_file(ROOT.'site/config/router/router_chude.php', $str);
    }
}
