<?php
class tourcomment extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('tourcomment_model','tourcomment');
        $this->load->helper('vimg');
        $this->load->library('upload', $config);
    }
    
    function ds(){
        $data['delete'] = true;
        $data['title'] = "Quản lý Đánh giá Tour";
       // $data['add'] = 'tourcomment/add';
        $config['base_url'] = base_url().'tourcomment/'.$this->uri->segment(2).'/';
        $config['suffix'] = '.html';
        $config['total_rows']   =  $this->tourcomment->get_num_comment();
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   25; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] = $this->tourcomment->get_all_comment($config['per_page'],segment(3,'int'));
        $data['pagination']    = $this->pagination->create_links();
        
        $this->load->templates('ds',$data);
    }
    
   
    function edit(){
        $id = $this->uri->segment(3);
        $data['rs'] = $this->db->row("SELECT * FROM tour_comment WHERE id = $id");
        $data['title'] = "Cập nhật Đánh giá Tour";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tourcomment/ds';
        $this->form_validation->set_rules('vdata[fullname]','Họ và tên','required');
        $this->form_validation->set_rules('vdata[content]','Nội dung','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/comment/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = '10000';
                
                $this->upload->initialize($config);                     
//                $vdata['avatar'] = $result['file_name'];  
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('error',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $vdata['avatar'] = $result['file_name'];  
                }                    
            }
            if($this->db->update('tour_comment',$vdata,array('id'=>$id))){

                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'tourcomment/ds';
                }else{
                    $url = 'tourcomment/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = $this->uri->segment(3);
            if($this->db->delete('tour_comment',array('id'=>$id))){
                $msg = "Xóa thành công";
            }else{
                $msg = "Xóa không thành công";
            }                                 
        redirect('tourcomment/ds');
    }
 
    function dels(){
        $ar_id = $_POST['ar_id'];
        $msg = "";
        for($i = 0; $i < sizeof($ar_id); $i++){
            $id = $ar_id[$i];
            $rs = $this->tourcomment->get_comment_by_id($id);
            
            if($this->db->delete('tour_comment',array('id'=>$id))){
                $msg .="<p>Xóa bài viết ID <b>".$id."</b> thành công</p>";
            }else{
                $msg .="</p>Xóa bài viết ID <b>".$id."</b> không thành công</p>";
            }
        }
        $this->session->set_flashdata('message',$msg);
        redirect('tourcomment/ds');
    }
    
    
}
