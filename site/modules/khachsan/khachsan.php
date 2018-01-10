
<?php
class khachsan extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('khachsan_model','khachsan');
    }
    
    function index(){
	    $slug = $this->uri->segment(1);
		$data['title'] = "Khách sạn";
		$this->link[0] = 'Khách sạn:khach-san';
        $config['base_url'] = base_url().$slug;
        $config['suffix'] = '.html';
        $config['total_rows']   =  $this->khachsan->get_num_hotel();
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   12; 
        $config['uri_segment'] = 2; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['hotel'] =   $this->khachsan->get_all_hotel($config['per_page'],segment(2,'int'));
        $limit = 12;
        $offset =  segment(2,'int') + $config['per_page'];
        $data['pagination']    = $this->pagination->create_links();
       $this->load->templates('index',$data); 
    }
	
	function cat(){
        $slug = $this->uri->segment(2);
        $catinfo = $this->khachsan->get_cat_by_slug($slug);
		$data['title'] = $catinfo->cat_name;
		$data['catinfo'] = $catinfo;
                $data['keyword'] = $catinfo->cat_keyword;
                $data['des'] = $catinfo->cat_des;
		$cat_id = $catinfo->cat_id;
		//$data['list'] = $this->khachsan->get_cat_hotel($cat_id);
		$config['base_url'] = base_url().'khach-san/'.$slug;
        $config['suffix'] = '.html';
        $this->link[0] = 'Khách sạn:khach-san';
         $this->link[1] = $catinfo->cat_name.':'.$catinfo->cat_slug;
        $config['total_rows']   =  $this->khachsan->get_num_hotel_cat($cat_id);
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   10; 
        $config['uri_segment'] = 2; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['hotel'] =   $this->khachsan->get_all_hotel_cat($config['per_page'],segment(3,'int'),$cat_id);
        $limit = 10;
        $offset =  segment(3,'int') + $config['per_page'];
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('index',$data); 
       // $this->load->templates('cat',$data);
        
    }
	
	function detail(){
        $id = end(explode('-',$this->uri->segment(2)));
        $rs = $this->db->row("SELECT * FROM hotel WHERE id = $id");
        if(!$rs){
            redirect();
        }
        $this->db->query("UPDATE hotel SET hits = hits + 1 WHERE id = $id");
        $data['title'] = $rs->title;
        $data['des'] = $rs->metadesc;
        $data['keyword'] = $rs->metakey;
        
        $data['rs'] = $rs;
        $this->load->templates('detail',$data);
        
    }
}