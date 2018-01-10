<?php
class mapsite extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('mapsite_model','mapsite');
        //$this->load->library('sitemap');
    }
    
    function index(){
        $data['title'] = "1";
        include ROOT.'vcore/library/sitemap.php';
        $sitemap = new Sitemap(base_url_site());  
        $sitemap->setPath(ROOT); 
        $sitemap->setFilename('sitemap');
        $sitemap->addItem('', '0.01', 'daily', 'Today');
        $sitemap->addItem('khach-san-da-nang.html', '0.01', 'daily', 'Today');
        $sitemap->addItem('khach-san-hoi-an.html', '0.01', 'daily', 'Today');
        $sitemap->addItem('dia-danh.html', '0.01', 'daily', 'Today');

        $listpro = $this->mapsite->get_all_hotel();
        foreach($listpro as $rs):
        
        $sitemap->addItem('khach-san-'.$rs->city_url.'/'.$rs->slug.'-'.$rs->hotel_id.'.html', '0.8', 'daily', 'Today');
        endforeach;
        
        $dichvu = $this->mapsite->get_all_diadiem();
        foreach($dichvu as $rs):
        $sitemap->addItem('dia-danh-'.$rs->city_slug.'/l'.$rs->local_id.'/'.$rs->slug.'.html', '0.8', 'daily', 'Today');
        endforeach;

        $sitemap->createSitemapIndex(base_url(), 'Today');
        $this->session->set_flashdata('message','Tạo site map thành công');
        redirect();
    }
}
