<?php
class tour extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('tour_model','tour');
        $this->pre_message = "";
    }
    
    function ds(){
        $data['title'] = "Danh sách Tour";
        $data['add'] = 'tour/add';
        $cat_id = get_var('cat_id','int');
       // $key_word = get_var('key');
        $key_word = $_GET['key'];
        $data['key'] = $key_word;
        $get = $this->request->get;
        $str = '';
        foreach($get as $val=>$keys){
            $str .= '&'.$val.'='.$keys;
        }
        $str = trim($str,'&');
        $str_get = (count($get))?'?'.$str:'';
        $data['cat_id'] = $cat_id;
        
        $data['dscat'] = $this->tour->get_all_cat();
        $config['base_url'] = base_url().'tour/ds';
        $config['suffix'] = '.html'.$str_get;
        $config['total_rows']   =  $this->tour->get_num_tour($key_word, $cat_id);
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   20; 
        $config['uri_segment'] = 3; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->tour->get_all_tour($config['per_page'],segment(3,'int'),$key_word, $cat_id);
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('tour/ds',$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới Tour";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tour/ds';
        $data['dscat'] = $this->tour->get_all_cat(); 
        $data['img'] = $this->tour->get_all_img_tam();
        $data['list_city'] = $this->tour->get_all_city();
        $data['allmain'] = $this->tour->get_all_main();
        $data['chude'] = $this->tour->get_all_chude();
        // Form validation
        $this->form_validation->set_rules('vdata[title]','Tên Tour ','required');
        $this->form_validation->set_rules('vdata[vanchuyen]','Vận chuyển ','required');
        $this->form_validation->set_rules('vdata[lichtrinh]','Lịch trình ','required');
        $this->form_validation->set_rules('vdes[gioithieu]','','');
        $this->form_validation->set_rules('vdes[chuongtrinh]','','');
        $this->form_validation->set_rules('vdes[phuluc]','','');
        $this->form_validation->set_rules('vdata[cat_id]','','');
        $this->form_validation->set_rules('vdata[code]','Mã Tour','required');
        $this->form_validation->set_rules('vdata[ngay]','Số ngày','required');
        $this->form_validation->set_rules('vdata[dem]','Số đêm','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $ar_cat_id = $this->request->post['ar_cat_id'];
            $vdata = $this->request->post['vdata'];
            $str_cat = '';
            for($i = 0; $i < sizeof($ar_cat_id); $i++){
                $str_cat .=$ar_cat_id[$i].',';
            }
            $vdata['cat_id'] = rtrim($str_cat,',');
            $vdata['slug'] = vnit_change_title($vdata['title']);
            $vdata['created'] = time();
            //$vdata['price'] = str_replace('.','',$vdata['price']);
           // $vdata['price2'] = str_replace('.','',$vdata['price2']);
            $vdata['noibat'] = $this->request->post['noibat'];
            $vdata['khuyenmai'] = $this->request->post['khuyenmai'];
            /*$cat = $this->tour->get_cat_by_id($vdata['cat_id']);
            if($cat->parent_id == 0){
                $vdata['main_id'] = $cat->cat_id;
                $vdata['main_slug'] = $cat->slug;
                $vdata['cat_id'] = $cat->cat_id;
                $vdata['cat_slug'] = $cat->slug;
            }else{
                $subcat = $this->tour->get_cat_by_id($cat->parent_id); 
                $vdata['main_id'] = $subcat->cat_id;
                $vdata['main_slug'] = $subcat->slug;
                $vdata['cat_id'] = $cat->cat_id;
                $vdata['cat_slug'] = $cat->slug;
            } */
            if($this->db->insert('tour',$vdata)){
                $id = $this->db->insert_id();
                
                // Insert Tour des
                $vdes = $this->request->post['vdes'];
                $vdes['id'] = $id;
                $this->db->insert('tour_des',$vdes);
                    
                // Insert Bangia;
                $ar_begin = $this->request->post['ar_begin'];
                $ar_price = $this->request->post['ar_price'];
                $ar_price2 = $this->request->post['ar_price2'];
                for($i = 0; $i < sizeof($ar_price); $i++){
                    if($ar_price[$i]){
                        $vp['id'] = $id;
                        $vp['begin'] = $ar_begin[$i];
                        $vp['price'] = str_replace('.','',$ar_price[$i]);
                        $vp['price2'] = str_replace('.','',$ar_price2[$i]);
                        $this->db->insert('tour_price',$vp);
                    }
                }
                
                // Lich khoi hanh
                $date_begin = $this->request->post['date_begin'];
                $date_end = $this->request->post['date_end'];
                for($i = 0; $i < sizeof($date_begin); $i++){
                    $ngaydi = $date_begin[$i];
                    $ngayve = $date_end[$i];
                    if($ngaydi != '' && $ngayve != ''){    
                        $vlich['id'] = $id;
                        $vlich['ngaydi'] = strtotime($ngaydi);
                        $vlich['ngayve'] = strtotime($ngayve);
                        $this->db->insert('tour_lich',$vlich);
                    }
                }
                
                // Insert Tour Img
                foreach($data['img'] as $val):
                    $vimg['id'] = $id;
                    $vimg['path'] =  $val->path;
                    $this->db->insert('tour_img',$vimg);
                    $this->load->helper('vimg');
                    $folder_tam = ROOT.'data/tam/'.$val->path;
                    $folder_80 = ROOT.'data/tour/80/'.$val->path;
                    $folder_250 = ROOT.'data/tour/250/'.$val->path;
                    $folder_500 = ROOT.'data/tour/500/'.$val->path;
                    $this->load->helper('vimg');
                    vnit_resize_image($folder_tam,$folder_80,80,0,false);
                    vnit_resize_image($folder_tam,$folder_250,250,0,false);
                    vnit_resize_image($folder_tam,$folder_500,900,0,false);
                endforeach;
                $this->db->delete('tam',array('session_id'=>$this->session->sessionid()));
                
                $ar_id = $this->request->post['ar_id'];
                for($i = 0; $i < sizeof($ar_id); $i++){
                    $vl['local_id'] = $ar_id[$i];
                    $vl['id'] = $id;
                    $this->db->insert('tour_local',$vl);
                }
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'tour/ds';
                }else{
                    $url = 'tour/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('tour/add',$data);
    }
    
    function edit(){
        $id = segment(3,'int');
        $data['title'] = "Cập nhật Tour";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tour/ds';
        $data['rs'] = $this->tour->get_tour_by_id($id);
        $data['dscat'] = $this->tour->get_all_cat(); 
        $data['img'] = $this->tour->get_all_img($id);
        $data['ds_price'] = $this->tour->get_list_price($id);
        $data['list_city'] = $this->tour->get_all_city();
        $data['list_local'] = $this->tour->get_tour_local($id);
        $data['allmain'] = $this->tour->get_all_main();
        $data['chude'] = $this->tour->get_all_chude();
        $data['lich'] = $this->tour->get_all_lich($id);
        // Form validation

        $this->form_validation->set_rules('vdata[title]','Tên Tour ','required');
        $this->form_validation->set_rules('vdata[vanchuyen]','Vận chuyển ','required');
        $this->form_validation->set_rules('vdata[lichtrinh]','Lịch trình ','required');
        $this->form_validation->set_rules('vdata[gioithieu]','','');
        $this->form_validation->set_rules('vdata[chuongtrinh]','','');
        $this->form_validation->set_rules('vdata[phuluc]','','');
        $this->form_validation->set_rules('vdata[cat_id]','','');
        $this->form_validation->set_rules('vdata[code]','Mã Tour','required');
        $this->form_validation->set_rules('vdata[ngay]','Số ngày','required');
        $this->form_validation->set_rules('vdata[dem]','Số đêm','required');
        //$this->form_validation->set_rules('vdata[images]','Ảnh đại diện','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $ar_cat_id = $this->request->post['ar_cat_id'];
            $vdata = $this->request->post['vdata'];
            $str_cat = '';
            for($i = 0; $i < sizeof($ar_cat_id); $i++){
                $str_cat .=$ar_cat_id[$i].',';
            }
            $vdata['cat_id'] = rtrim($str_cat,',');
 
           // $vdata['slug'] = vnit_change_title($vdata['title']);
            //$vdata['price'] = str_replace('.','',$vdata['price']);
           // $vdata['price2'] = str_replace('.','',$vdata['price2']);
            $vdata['noibat'] = $this->request->post['noibat'];
            $vdata['khuyenmai'] = $this->request->post['khuyenmai'];
            /*
            $cat = $this->tour->get_cat_by_id($vdata['cat_id']);
            if($cat->parent_id == 0){
                $vdata['main_id'] = $cat->cat_id;
                $vdata['main_slug'] = $cat->slug;
                $vdata['cat_id'] = $cat->cat_id;
                $vdata['cat_slug'] = $cat->slug;
            }else{
                $subcat = $this->tour->get_cat_by_id($cat->parent_id); 
                $vdata['main_id'] = $subcat->cat_id;
                $vdata['main_slug'] = $subcat->slug;
                $vdata['cat_id'] = $cat->cat_id;
                $vdata['cat_slug'] = $cat->slug;
            }
            */
           $vdata['created'] = time();
            if($this->db->update('tour',$vdata,array('id'=>$id))){
                // Xoa bang gia
                $this->db->delete('tour_price',array('id'=>$id));
                // Insert Bangia;
                $ar_begin = $this->request->post['ar_begin'];
                $ar_price = $this->request->post['ar_price'];
                $ar_price2 = $this->request->post['ar_price2'];
                //var_dump($ar_price2); die();
                for($i = 0; $i < sizeof($ar_price); $i++){
                    if($ar_price[$i]){
                        $vp['id'] = $id;
                        $vp['begin'] = $ar_begin[$i];
                        $vp['price'] = str_replace('.','',$ar_price[$i]);
                        $vp['price2'] = str_replace('.','',$ar_price2[$i]);
                        $this->db->insert('tour_price',$vp);
                    }
                }
                
                // Tour des Update
                $vdes = $this->request->post['vdes'];
                $this->db->update('tour_des',$vdes,array('id'=>$id));
                
                // Del TOur Local
                $this->db->delete('tour_local',array('id'=>$id));
                $ar_id = $this->request->post['ar_id'];
                for($i = 0; $i < sizeof($ar_id); $i++){
                    $vl['local_id'] = $ar_id[$i];
                    $vl['id'] = $id;
                    $this->db->insert('tour_local',$vl);
                }
                
                // Xoa lich khoi hanh
                $this->db->delete('tour_lich',array('id'=>$id));
                $date_begin = $this->request->post['date_begin'];
                $date_end = $this->request->post['date_end'];
                for($i = 0; $i < sizeof($date_begin); $i++){
                    $ngaydi = $date_begin[$i];
                    $ngayve = $date_end[$i];
                    if($ngaydi != '' && $ngayve != ''){
                        $vlich['id'] = $id;
                        $vlich['ngaydi'] = strtotime($ngaydi);
                        $vlich['ngayve'] = strtotime($ngayve);
                        $this->db->insert('tour_lich',$vlich);
                    }
                }
                
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                    $page_ = (int)$this->uri->segment(4);
                   $url = 'tour/ds/'.$page_;
                }else{
                    $url = uri_string();
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('tour/edit',$data);
    }
    
    // Xoa tour
    function del(){
        $id = segment(3,'int');
        $list_img = $this->tour->get_all_img($id);
        if($this->db->delete('tour',array('id'=>$id))){
            $this->db->delete('tour_des',array('id'=>$id));
            $this->db->delete('tour_local',array('id'=>$id));
            foreach($list_img as $val):
                $path_80 = ROOT.'data/tour/80/'.$val->path;
                if(file_exists($path_80)){
                    unlink($path_80);
                }
                $path_250 = ROOT.'data/tour/250/'.$val->path;
                if(file_exists($path_250)){
                    unlink($path_250);
                }
                $path_500 = ROOT.'data/tour/500/'.$val->path;
                if(file_exists($path_500)){
                    unlink($path_500);
                }
            endforeach;
            $this->db->delete('tour_img',array('id'=>$id));
            $this->db->delete('tour_price',array('id'=>$id));
            $msg = "Xóa thành công";
        }else{
            $msg = "Xóa không thành công";
        }
        $this->session->set_flashdata('message',$msg);
        redirect('tour/ds');
    }
    
    function tour_hot(){
        $this->load->config('config_tour');
        $data['apply'] = true;
        $data['title'] = "Tour hot";
        $this->form_validation->set_rules('token','','');
        if($this->form_validation->run()){
            $id_tour = $this->request->post['id_tour'];
            $str_ ='';
            for($i = 0; $i < sizeof($id_tour); $i++){
                $str_ .=$id_tour[$i].',';
            }
            $str_ = rtrim($str_,',');
            $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* File Config_site \n* Date: ".date('d/m/y H:i:s').".\n**/";
            $str .= "\n\$config['top_tour'] = '$str_';";
            $this->load->helper('file');
            if(write_file(ROOT.'site/config/config_tour.php', $str)){
                $msg = 'Lưu thành công';
                    
            }else{
                $msg =" Lưu không thành công";
            }
            $this->session->set_flashdata('message',$msg);
            redirect('tour/tour_hot') ; 
            
        }
        $this->load->templates('tour/top',$data);
    }

    
    function get_local(){
        $this->load->library('pagi');
        $city_id = $this->request->post['city_id'];
        $data['city_id'] = $city_id;
        $limit = 20;
        $data['limit'] = $limit; 
        $offset = (int)$this->request->post['page_no']; 
        $data['offset'] = $offset;
        $num = $this->tour->get_num_local($city_id);
        $data['num'] = $num;
        if($offset!=0) 
            $start = ($offset - 1) * $limit;
        else
            $start = 0;   
        $data['list'] =   $this->tour->get_all_local($limit,$start,$city_id);
        $data['pagination']   = $this->pagi->page($num,$offset,$limit,'local');         
        $this->load->view('tour/diadanh',$data);
    }
    
    
    // Tai anh moi len
    function uploader(){
        $session_id = $this->uri->segment(3);
        $dir = ROOT.'data/tam/';
        $dir_admin = 'data/tam/';
        $size=$_FILES['Filedata']['size'];
        if($size>204857600)
        {
                $data['error'] = 1;
                $data['msg'] = "File quá lớn. Không thể tải lên";
        }            
        $filename = stripslashes($_FILES['Filedata']['name']);
        $i = strrpos($filename,".");
        if (!$i) { return ""; }
        $l = strlen($filename) - $i;
        $extension = substr($filename,$i+1,$l);                 
        $extension = strtolower($extension); 
        $file_name = str_replace($extension,'',$filename);
        $file_name = vnit_change_title($file_name);
        $filename = $dir.$file_name.'-'.time().'.'.$extension;
        $file_ext = $file_name.'-'.time().'.'.$extension;
        if (move_uploaded_file($_FILES['Filedata']['tmp_name'], $filename)) {
            $vdata['session_id'] = $session_id;
            $vdata['path'] = $file_ext;
            $vdata['time'] = time();
            $vdata['module'] = 'TOUR';
            $this->db->insert('tam',$vdata);
            $data['id'] = $this->db->insert_id();
            $data['error'] = 0;
            $data['filename'] = $file_ext;
            $data['msg'] = "Tải file lên thành công";
        } else {
            $data['error'] = 1;
            $data['msg'] = "Tải file lên không thành công";
        }
        echo json_encode($data);
    }
    
    function del_img_tam(){
        $img_id = $this->request->post['id'];
        $rs = $this->db->row("SELECT * FROM tam WHERE id = $img_id");
        $path = $rs->path;
        if($this->db->delete('tam',array('id'=>$img_id))){
            unlink(ROOT.'data/tam/'.$path);
        }
    }
    
   // Tai anh cap nhat
    function uploader_edit(){
        $id = $this->uri->segment(3);
        $dir = ROOT.'data/tam/';
        $dir_admin = 'data/tam/';
        $size=$_FILES['Filedata']['size'];
        if($size>204857600)
        {
                $data['error'] = 1;
                $data['msg'] = "File quá lớn. Không thể tải lên";
        }            
        $filename = stripslashes($_FILES['Filedata']['name']);
        $i = strrpos($filename,".");
        if (!$i) { return ""; }
        $l = strlen($filename) - $i;
        $extension = substr($filename,$i+1,$l);                 
        $extension = strtolower($extension); 
        $file_name = str_replace($extension,'',$filename);
        $file_name = vnit_change_title($file_name);
        $filename = $dir.$file_name.'-'.time().'.'.$extension;
        $file_ext = $file_name.'-'.time().'.'.$extension;
        if (move_uploaded_file($_FILES['Filedata']['tmp_name'], $filename)) {
            $vdata['id'] = $id;
            $vdata['path'] = $file_ext;
            $this->db->insert('tour_img',$vdata);
            $this->load->helper('vimg');
            $folder_tam = ROOT.'data/tam/'.$file_ext;
            $folder_80 = ROOT.'data/tour/80/'.$file_ext;
            $folder_250 = ROOT.'data/tour/250/'.$file_ext;
            $folder_500 = ROOT.'data/tour/500/'.$file_ext;
            $this->load->helper('vimg');
            vnit_resize_image($folder_tam,$folder_80,80,0,false);
            vnit_resize_image($folder_tam,$folder_250,250,0,false);
            vnit_resize_image($folder_tam,$folder_500,900,0,false);
            
            $data['id'] = $this->db->insert_id();
            $data['error'] = 0;
            $data['filename'] = $file_ext;
            $data['msg'] = "Tải file lên thành công";
        } else {
            $data['error'] = 1;
            $data['msg'] = "Tải file lên không thành công";
        }
        echo json_encode($data);
    }
    
    function del_img(){
        $img_id = $this->request->post['id'];
        $rs = $this->db->row("SELECT * FROM tour_img WHERE img_id = $img_id");
        $path = $rs->path;
        if($this->db->delete('tour_img',array('img_id'=>$img_id))){
            unlink(ROOT.'data/tour/80/'.$path);
            unlink(ROOT.'data/tour/250/'.$path);
            unlink(ROOT.'data/tour/500/'.$path);
        }
    }
} 