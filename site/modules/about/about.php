
<?php
class about extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('about_model','about');
    }
    
    function index(){
	   $this->link[0] = 'Giới thiệu:gioi-thieu';
	   $data['gioithieu'] = $this->about->get_about();
        $data['keyword'] = $data['gioithieu']->keyword;
        $data['des'] = $data['gioithieu']->des;
       $data['title'] = $data['gioithieu']->title;
       $this->load->templates('index',$data); 
    }
   function quydinh(){
	   $data['title'] = "Chinh sach & Quy dinh� Tuấn Nguyễn Travel";
	    $this->link[0] = 'Giới thiệu:chinh-sach-quy-dinh';
	   $data['gioithieu'] = $this->about->get_quydinh();
       $this->load->templates('index',$data); 
    }
}