<?php
class bookxe extends vnit{
    function __construct(){
        parent::__construct();
    }
    function ds(){
      $data['title'] = "Đặt - thuê xe";
	  $data['list'] = $this->db->result("SELECT * FROM book_xe");
	  $this->load->templates('ds',$data);
    }
	function del(){
        $id = $this->uri->segment(3);
        $page = $this->uri->segment(4);
        if($this->db->delete('book_xe',array('id'=>$id))){
            $this->session->set_flashdata('message','Xóa thành công');
        }else{
            $this->session->set_flashdata('message','Xóa không thành công');
        }
        redirect('bookxe/ds/'.$page);
    }
}
