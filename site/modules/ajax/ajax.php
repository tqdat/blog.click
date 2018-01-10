<?php
class ajax extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('ajax_model','ajax');
    }
    
    function city(){
        $ct_id = $this->request->post['ct_id'];
        $html ='';
        $list = $this->lib->get_all_city($ct_id);
        foreach($list as $rs):
            $html .='<option value="'.$rs->city_id.'">'.$rs->city_name.'</option>';
        endforeach;
        $data['ds'] = $html;
        echo json_encode($data);
    }
    
    function mail_tour(){
        $id = $this->uri->segment(3);
        $data['title'] = "mail tour";
        $data['rs'] = $this->ajax->get_book_id($id);
        $data['val'] = $this->ajax->get_tour_by_id($data['rs']->tour_id);
        $this->load->view('mail_tour',$data);
    }
	function mail_datxe(){
        $book_xe_id = $this->uri->segment(3);
        $data['title'] = "mail xe";
        $data['info_mail'] = $this->db->row("SELECT * FROM book_xe WHERE id = '$book_xe_id' AND published = '1'");
        $this->load->view('mail_thuexe',$data);
    }
}