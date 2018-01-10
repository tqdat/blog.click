<?php
class news extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('news_model','news');
        $this->load->helper('vimg');
        $this->pre_message = "";
    }
    
    function ds(){
        $this->write_cache();
        //$this->cache_tinmoi();
        //$this->cache_menu();
        //$this->cache_noibat();
        $data['title'] = "Quản lý bài viết";
        $data['delete'] = true;
        $data['add'] = 'news/add';
        $field = (get_var('field'))?get_var('field'):'id';
        $order = (get_var('order'))?get_var('order'):'desc';
        $key_word = $_GET['key'];
        $catid = get_var('catid','int');
        $data['key'] = $key_word;
        $data['catid'] = $catid;
        $data['field'] = $field;
        $data['order'] = $order;
        $data['page'] = get_var('page','int');
        $data['listcategory'] = $this->news->get_all_category();
        $config['base_url'] = base_url().'news/'.$this->uri->segment(2).'/';
        $config['suffix'] = '.html';
        $config['total_rows']   =  $this->news->get_num_news($key_word, $catid);
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   20; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->news->get_all_news($config['per_page'],segment(3,'int'),$field, $order,$key_word, $catid);
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('index',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới bài viết";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'news/ds';
        $data['listcategory'] = $this->news->get_all_category();
        // Form validation
        $this->form_validation->set_rules('data[title]','Tiêu đề','required');
        $this->form_validation->set_rules('data[catid]','','');
        $this->form_validation->set_rules('fulltext','','');
        $this->form_validation->set_rules('data[introtext]','','');
        $this->form_validation->set_rules('data[published]','','');
        $this->form_validation->set_rules('data[metakey]','','');
        $this->form_validation->set_rules('data[metadesc]','','');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $id = get_var('id','int');
            $data = $_POST['data'];
            $attr = $_POST['attr'];
            $data['slug'] = vnit_change_title($data['title']);
            $catinfo = $this->news->get_cat_by_id($data['catid']);
            if($catinfo->parent_id == 0){
                $data['main_id'] = $catinfo->cat_id;
                $data['main_slug'] = $catinfo->cat_slug;
                $data['catid'] = $catinfo->cat_id;
                $data['cat_slug'] = $catinfo->cat_slug;
            }else{
                $catinfo1 = $this->news->get_cat_by_id($catinfo->parent_id);
                $data['main_id'] = $catinfo1->cat_id;
                $data['main_slug'] = $catinfo1->cat_slug;
                $data['catid'] = $catinfo->cat_id;
                $data['cat_slug'] = $catinfo->cat_slug;
            }
            $data['fulltext'] = $_POST['fulltext'];
            $data['noibat'] = $_POST['noibat'];
            $data['created_by'] = $_SESSION['user_id'];
            $data['created'] = time();
            $data['attr'] ='';
            $data['attr'] .= 'show_intro='.$attr['show_intro'];
            $data['attr'] .= '&show_author='.$attr['show_author'];
            $data['attr'] .= '&show_date='.$attr['show_date'];
            $data['attr'] .= '&show_editdate='.$attr['show_editdate'];
            $data['attr'] .= '&show_print='.$attr['show_print'];
            $data['attr'] .= '&show_email='.$attr['show_email'];
            $data['attr'] .= '&show_comment='.$attr['show_comment'];
            $data['attr'] .= '&show_other='.$attr['show_other'];
            
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/news/default/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = '10000';
                $config['file_name'] =  $data['slug'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                       
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('error',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $data['images'] = $result['file_name'];  
                    vnit_resize_image(ROOT.'data/news/default/'.$data['images'],ROOT.'data/news/80/'.$data['images'],80,0,false);
                    vnit_resize_image(ROOT.'data/news/default/'.$data['images'],ROOT.'data/news/200/'.$data['images'],200,0,false);
                    vnit_resize_image(ROOT.'data/news/default/'.$data['images'],ROOT.'data/news/300/'.$data['images'],300,0,false);
                }                    
            }
            
            if($this->db->insert('news',$data)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'news/ds';
                }else{
                    $url = 'news/edit/'.$id;
                }
                redirect($url);
            }
        }

        $data['message'] = $this->pre_message;
        $this->load->templates('add',$data);
    }
    
    function edit(){
        $data['title'] = 'Cập nhật bài viết';
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'news/ds/'.$this->uri->segment(4);
        $id = segment(3,'int');
        $data['listcategory'] = $this->news->get_all_category();
        $data['rs'] = $this->news->get_news_by_id($id);
        $row = $this->db->row("SELECT * FROM category WHERE cat_id=".$data['rs']->catid);
        if($row->parent_id == 0){
            $cat = $row->cat_id;
        }else{
            $cat = $row->parent_id;
        }
        $data['channel'] = $this->news->get_list_channel($cat);        
        // Form validation
        $this->form_validation->set_rules('data[title]','Tiêu đề','required');
        $this->form_validation->set_rules('data[catid]','','');
        $this->form_validation->set_rules('fulltext','','');
        $this->form_validation->set_rules('data[introtext]','','');
        $this->form_validation->set_rules('data[published]','','');
        $this->form_validation->set_rules('data[metakey]','','');
        $this->form_validation->set_rules('data[metadesc]','','');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $data = $_POST['data'];
            $attr = $_POST['attr'];
           // $data['slug'] = vnit_change_title($data['title']);
            $catinfo = $this->news->get_cat_by_id($data['catid']);
            if($catinfo->parent_id == 0){
                $data['main_id'] = $catinfo->cat_id;
                $data['main_slug'] = $catinfo->cat_slug;
                $data['catid'] = $catinfo->cat_id;
                $data['cat_slug'] = $catinfo->cat_slug;
            }else{
                $catinfo1 = $this->news->get_cat_by_id($catinfo->parent_id);
                $data['main_id'] = $catinfo1->cat_id;
                $data['main_slug'] = $catinfo1->cat_slug;
                $data['catid'] = $catinfo->cat_id;
                $data['cat_slug'] = $catinfo->cat_slug;
            }
            $data['fulltext'] = $_POST['fulltext'];
            $data['noibat'] = $_POST['noibat'];
            $data['modified'] = time();
            $data['attr'] ='';
            $data['attr'] .= 'show_intro='.$attr['show_intro'];
            $data['attr'] .= '&show_author='.$attr['show_author'];
            $data['attr'] .= '&show_date='.$attr['show_date'];
            $data['attr'] .= '&show_editdate='.$attr['show_editdate'];
            $data['attr'] .= '&show_print='.$attr['show_print'];
            $data['attr'] .= '&show_email='.$attr['show_email'];
            $data['attr'] .= '&show_comment='.$attr['show_comment'];
            $data['attr'] .= '&show_other='.$attr['show_other'];
            if($_FILES["userfile"]["size"] > 0){
                $config['upload_path'] = ROOT.'data/news/default/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = '10000';
                $config['file_name'] =  $data['slug'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                       
                if ( !$this->upload->do_upload()){
                    $this->pre_message =  $this->upload->display_errors();
                    $this->session->set_flashdata('error',$this->pre_message);
                    redirect(uri_string());
                }else{                         
                    $result =  $this->upload->data();
                    $data['images'] = $result['file_name'];  
                    vnit_resize_image(ROOT.'data/news/default/'.$data['images'],ROOT.'data/news/80/'.$data['images'],80,0,false);
                    vnit_resize_image(ROOT.'data/news/default/'.$data['images'],ROOT.'data/news/200/'.$data['images'],200,0,false);
                    vnit_resize_image(ROOT.'data/news/default/'.$data['images'],ROOT.'data/news/300/'.$data['images'],300,0,false);
                }                    
            }
            
            if($this->db->update('news',$data,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                    $url = 'news/ds/'.$this->uri->segment(4);
                }else{
                    $url = uri_string();
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('edit',$data);
    }
    
    function del(){
        $id = $this->uri->segment(3);
        $rs = $this->news->get_news_by_id($id);
        if($rs->images != ''){
            if(file_exists(ROOT.'data/news/80/'.$rs->images)){
                unlink(ROOT.'data/news/80/'.$rs->images);
            }
            if(file_exists(ROOT.'data/news/200/'.$rs->images)){
                unlink(ROOT.'data/news/200/'.$rs->images);
            }
            if(file_exists(ROOT.'data/news/300/'.$rs->images)){
                unlink(ROOT.'data/news/300/'.$rs->images);
            }
            if(file_exists(ROOT.'data/news/default/'.$rs->images)){
                unlink(ROOT.'data/news/default/'.$rs->images);
            }
        }
        if($this->db->delete('news',array('id'=>$id))){
            $msg .="<p>Xóa bài viết ID <b>".$id."</b> thành công</p>";
        }else{
            $msg .="</p>Xóa bài viết ID <b>".$id."</b> không thành công</p>";
        }
        $this->session->set_flashdata('message',$msg);
        redirect('news/ds');
    }  
    
    
    function dels(){
        $ar_id = $_POST['ar_id'];
        $msg = "";
        for($i = 0; $i < sizeof($ar_id); $i++){
            $id = $ar_id[$i];
            $rs = $this->news->get_news_by_id($id);
            if($rs->images != ''){
                if(file_exists(ROOT.'data/news/80/'.$rs->images)){
                    unlink(ROOT.'data/news/80/'.$rs->images);
                }
                if(file_exists(ROOT.'data/news/200/'.$rs->images)){
                    unlink(ROOT.'data/news/200/'.$rs->images);
                }
                if(file_exists(ROOT.'data/news/300/'.$rs->images)){
                    unlink(ROOT.'data/news/300/'.$rs->images);
                }
                if(file_exists(ROOT.'data/news/default/'.$rs->images)){
                    unlink(ROOT.'data/news/default/'.$rs->images);
                }
            }
            if($this->db->delete('news',array('id'=>$id))){
                $msg .="<p>Xóa bài viết ID <b>".$id."</b> thành công</p>";
            }else{
                $msg .="</p>Xóa bài viết ID <b>".$id."</b> không thành công</p>";
            }
        }
        $this->session->set_flashdata('message',$msg);
        redirect(get_post_page());
    }
    
    function get_channel(){
        $catid = $this->request->get['catid'];
        $row = $this->db->row("SELECT * FROM category WHERE cat_id=".$catid);
        $ds = '<option value="0">Chọn kênh tin</option>';
        if($catid != 0){
            if($row->parent_id == 0){
                $cat = $row->cat_id;
            }else{
                $cat = $row->parent_id;
            }
            $list = $this->news->get_list_channel($cat);
            foreach($list as $rs):
            $ds .= '<option value="'.$rs->channel_id.'">'.$rs->channel_name.'</option>';
            endforeach;
        }
        $data['ds'] = $ds;
        echo json_encode($data);
    }
    
    
    function write_cache(){
        $this->load->helper('file');
        $listcat = $this->news->get_list_maincat();
        $total_cat = count($listcat);
        $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* Date: ".date('d/m/y H:i:s').".\n**/";
        $str .= "\n\$config['total_cat'] = $total_cat;";
        $i = 1;
        foreach($listcat as $val):
            $list = $this->news->get_list_top($val->cat_id);
            $catid = $val->cat_id;
            $catname = $val->cat_name;
            $catslug = $val->cat_slug;
            $str .= "\n\n//*******Begin Dem: $i********"; 
            $str .= "\n\$config['cat_id_$i'] = $catid;";
            $str .= "\n\$config['cat_name_$i'] = '$catname';";
            $str .= "\n\$config['cat_slug_$i'] = '$catslug';";
            
            $j = 1;
            foreach($list as $rs):
                $id = $rs->id;
                $title = str_replace(array("'",'"'),array('',''),$rs->title);
                $slug = $rs->slug;
                $img = $rs->images;
                $cat_id = $rs->catid;
                $cat_slug = $rs->cat_slug;
                $introtext = str_replace(array("'",'"'),array('',''),$rs->introtext);
                
                $str .= "\n\$config['id_".$i."_".$j."'] = $id;";
                $str .= "\n\$config['title_".$i."_".$j."'] = '$title';";
                $str .= "\n\$config['slug_".$i."_".$j."'] = '$slug';";
                $str .= "\n\$config['catid_".$i."_".$j."'] = $cat_id;";
                $str .= "\n\$config['catslug_".$i."_".$j."'] = '$cat_slug';";
                $str .= "\n\$config['images_".$i."_".$j."'] = '$img';";
                $str .= "\n\$config['intro_".$i."_".$j."'] = '$introtext';";
                
            $j++;    
            endforeach;
            $str .= "\n//*******END Dem: $i********\n\n"; 
        $i++;
        endforeach;
        write_file(ROOT.'site/config/config_news.php', $str);    
    }
    
    function cache_tinmoi(){
        $list = $this->news->get_tinmoi();
        $this->load->helper('file');
        $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* Date: ".date('d/m/y H:i:s').".\n**/";
        $i = 1;
        foreach($list as $rs):
                $id = $rs->id;
                $title = str_replace(array("'",'"'),array('',''),$rs->title);
                $slug = $rs->slug;
                $img = $rs->images;
                $cat_id = $rs->catid;
                $cat_slug = $rs->cat_slug;
                $introtext = str_replace(array("'",'"'),array('',''),$rs->introtext);
                
                $str .= "\n\$config['id_$i'] = $id;";
                $str .= "\n\$config['title_$i'] = '$title';";
                $str .= "\n\$config['slug_$i'] = '$slug';";
                $str .= "\n\$config['catid_$i'] = $cat_id;";
                $str .= "\n\$config['catslug_$i'] = '$cat_slug';";
                $str .= "\n\$config['images_$i'] = '$img';";
                $str .= "\n\$config['intro_$i'] = '$introtext';\n\n";

        $i++;
        endforeach;
        write_file(ROOT.'site/config/config_topnews.php', $str); 
    }
    
    function cache_noibat(){
        $list = $this->news->get_noibat(6);
        $this->load->helper('file');
        $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* Date: ".date('d/m/y H:i:s').".\n**/";
        $i = 1;
        foreach($list as $rs):
                $id = $rs->id;
                $title = str_replace(array("'",'"'),array('',''),$rs->title);
                $slug = $rs->slug;
                $img = $rs->images;
                $cat_id = $rs->catid;
                $cat_slug = $rs->cat_slug;
                $introtext = str_replace(array("'",'"'),array('',''),$rs->introtext);
                
                $str .= "\n\$config['nb_id_$i'] = $id;";
                $str .= "\n\$config['nb_title_$i'] = '$title';";
                $str .= "\n\$config['nb_slug_$i'] = '$slug';";
                $str .= "\n\$config['nb_catid_$i'] = $cat_id;";
                $str .= "\n\$config['nb_catslug_$i'] = '$cat_slug';";
                $str .= "\n\$config['nb_images_$i'] = '$img';";
                $str .= "\n\$config['nb_intro_$i'] = '$introtext';\n\n";

        $i++;
        endforeach;
        write_file(ROOT.'site/config/config_news_noibat.php', $str); 
    }    
    
    function cache_menu(){
        $list = $this->news->get_noibat();
        $imgTop = $list[0]->images;
        $linkTop = base_url_site().'tin-tuc/'.$list[0]->id.'/'.$list[0]->slug.'.html';
        $titleTop = $list[0]->title;
        $introTop = vnit_cut_string($list[0]->introtext,100);
        $this->load->helper('file');
        $str = "<div class=\"News_HightLight\">";
            $str .= "<div class=\"BlockTop\">";
                $str .= "<a class=\"img\" href=\"".$linkTop."\">";
                    $str .='<img alt="'.$titleTop.'" src="'.base_url_site().'data/news/300/'.$imgTop.'" style="display: inline;">';
                    $str .='<div class="title">'.$titleTop.'</div>';
                $str .= "</a>";
                $str .='<div>'.$introTop.'</div>';
            $str .= "</div>";
            $str .= '<div class="BlockRight">';
                $str .= '<ul>';
                for($i = 1; $i < count($list); $i++){
                    $rs = $list[$i];
                    $img = $rs->images;
                    $link = base_url_site().'tin-tuc/'.$rs->id.'/'.$rs->slug.'.html';
                    $title = $rs->title;
                    $str .='<li>';
                        $str .='<a class="imgR" href="'.$link.'">';
                            $str .='<img alt="'.$rs->title.'" src="'.base_url_site().'data/news/80/'.$img.'" style="display: inline;">';
                        $str .='</a>';
                        $str .='<a href="'.$link.'" class="title">'.$rs->title.'</a>';
                    $str .='</li>';
                }
                $str .= '</ul>';
            $str .= '</div>';
        $str .= "</div>";
        $str .= '<div class="News_Most">';
            $str .= '<h3>Tin xem nhiều nhất</h3>';
            $str .= '<ul>';
                $docnhieu = $this->news->get_docnhieu();
                foreach($docnhieu as $rs):
                    $title = $rs->title;
                    $link = base_url_site().'tin-tuc/'.$rs->id.'/'.$rs->slug.'.html';
                    $str .= '<li><a href="'.$link.'">'.$title.'</a></li>';
                endforeach;
            $str .= '</ul>';
        $str .= '</div>';

        write_file(ROOT.'site/config/news_top.html', $str);
    }
}
