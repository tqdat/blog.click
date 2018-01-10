<?php
class comment extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('comment_model','tourcomment');
    }
    
    function ds(){
        $data['title'] = "Quản lý Đánh giá Tour";
       // $data['add'] = 'tourcomment/add';
        $config['base_url'] = base_url().'tour/comment/'.$this->uri->segment(2).'/';
        $config['suffix'] = '.html';
        $config['total_rows']   =  $this->tourcomment->get_num_comment();
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   25; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] = $this->tourcomment->get_all_comment($config['per_page'],segment(3,'int'));
        $data['pagination']    = $this->pagination->create_links();
        
        $this->load->templates('comment/ds',$data);
    }
    
   
    function edit(){
        $id = $this->uri->segment(3);
        $data['rs'] = $this->db->row("SELECT * FROM tour_comment WHERE id = $id");
        $data['title'] = "Cập nhật Đánh giá Tour";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tour/comment/ds';
        $this->form_validation->set_rules('vdata[fullname]','Họ và tên','required');
        $this->form_validation->set_rules('vdata[content]','Nội dung','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            if($this->db->update('tour_comment',$vdata,array('id'=>$id))){

                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'tour/comment/ds';
                }else{
                    $url = 'tour/comment/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('comment/edit',$data);
    }
    
    function del(){
        $id = $this->uri->segment(3);
            if($this->db->delete('tour_comment',array('id'=>$id))){
                $msg = "Xóa thành công";
            }else{
                $msg = "Xóa không thành công";
            }                                 
        redirect('tour/comment/ds');
    }
    
}
