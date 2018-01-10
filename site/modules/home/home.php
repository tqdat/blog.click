
<?php
class home extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('home_model','home');
    }
    
    function index(){
	   $data['title'] = $this->config->item('site_name');
	   $data['des'] = $this->config->item('site_des');
	   $data['keyword'] = $this->config->item('site_keyword');
	  // $data['hotel_noibat'] = $this->home->get_hotel_noibat();
      // $data['tour_noibat'] = $this->home->get_tour_noibat();
	  // $data['thuexe'] = $this->db->result("SELECT * FROM thuexe WHERE published = 1 ORDER BY id DESC");
	  // $data['tour_khuyenmai'] = $this->home->get_tour_khuyenmai();
       //    $data['news_hot'] = $this->home->get_news_hot();
       $this->load->templates('index',$data,'home'); 
    }
}