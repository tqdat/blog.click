<?php
class news extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('news_model','news');
    }
    
    function index(){
        $slug = $this->uri->segment(1);
        $catinfo = $this->news->get_cat_by_slug($slug);
        $this->link[0] = $catinfo->cat_name.':'.$catinfo->cat_slug;
        $data['title'] = $catinfo->cat_name_seo;
        $data['des'] = $catinfo->cat_des;
        $data['keyword'] = $catinfo->cat_keyword;
        $config['base_url'] = base_url().$slug;
        $config['suffix'] = '.html';
        $config['total_rows']   =  $this->news->get_num_news($catinfo->cat_id);
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   12; 
        $config['uri_segment'] = 2; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->news->get_all_news($config['per_page'],segment(2,'int'),$catinfo->cat_id);
        $limit = 10;
        $offset =  segment(3,'int') + $config['per_page'];
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('index',$data);
    }
    
    function cat(){
        $slug = $this->uri->segment(2);
        $catinfo1 = $this->news->get_cat_by_slug_sub($slug);
        if(!$catinfo1){
            redirect();
        }
        $catinfo = $this->news->get_cat_by_id($catinfo1->parent_id);
        $data['catid'] = $cat->cat_id;
        $data['catinfo'] = $catinfo;
        $data['catinfo1'] = $catinfo1;
        $data['des'] = $catinfo1->cat_des;
        $data['keyword'] = $catinfo1->cat_keyword;
        $data['title'] = $catinfo1->cat_name_seo;
        $this->link[0] = $catinfo->cat_name.':'.$catinfo->cat_slug;
        $this->link[1] = $catinfo1->cat_name.':'.$catinfo->cat_slug.'/'.$catinfo1->cat_slug;
        $config['base_url'] = base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/';
        $config['suffix'] = '.html';
        $config['total_rows']   =  $this->news->get_num_news($catinfo1->cat_id);
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   12; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->news->get_all_news($config['per_page'],segment(3,'int'),$catinfo1->cat_id);
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('cat',$data);
        
    }
    
    function detail(){
        $id = end(explode('-',$this->uri->segment(2)));
        $rs = $this->db->row("SELECT * FROM news WHERE id = $id");
        if(!$rs){
            redirect();
        }
        $this->db->query("UPDATE news SET hits = hits + 1 WHERE id = $id");
        $urlref = $_SERVER["HTTP_REFERER"];
        if (strlen(strstr($urlref, 'facebook.com')) > 0) {
         	$this->db->query("UPDATE news SET hits_face = hits_face + 1 WHERE id = $id");
        }
         if (strlen(strstr($urlref, 'google.com')) > 0) {
         	$this->db->query("UPDATE news SET hits_google = hits_google + 1 WHERE id = $id");
        }
        $infocat1 = $this->news->get_cat_by_id($rs->catid);
        if($infocat1->parent_id != 0){
            $infocat = $this->news->get_cat_by_id($infocat1->parent_id);
        }
        $data['title'] = $rs->title;
        $data['des'] = $rs->metadesc;
        $data['keyword'] = $rs->metakey;
        $data['images'] = 'data/news/default/'.$rs->images;
        if($infocat){
              $this->link[0] = $infocat->cat_name.':'.$infocat->cat_slug;
              $this->link[1] = $infocat1->cat_name.':'.$infocat->cat_slug.'/'.$infocat1->cat_slug;
              $this->link[2] = $rs->title.':'.$infocat->cat_slug.'/'.$rs->slug.'-'.$rs->id;
        }else{
            $this->link[0] = $infocat1->cat_name.':'.$infocat1->cat_slug;
            $this->link[1] = $rs->title.':'.$infocat1->cat_slug.'/'.$rs->slug.'-'.$rs->id;
        }
        
        $data['rs'] = $rs;
        $data['tinmoi'] = $this->news->get_other_tinmoi($rs->id, $rs->catid); 
        $data['tincu'] = $this->news->get_other_tincu($rs->id, $rs->catid); 
        $this->load->templates('detail',$data);
        
    }
}
