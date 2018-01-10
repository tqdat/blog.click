<?php
class tour extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('tour_model','tour');
        $this->load->helper('barcode');
        $this->load->helper('mail');
      }
    function index(){
        $data['title'] = "Chùm tour du lịch đặc sắc nhất 2017";
        $this->link[0] = 'Tour:tour';
        $config['base_url'] = base_url().'tour	';
        $config['suffix'] = '.html';
        $config['per_page']  =   18; 
        $data['total_rows']   =  $this->tour->get_num_index();
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['listcat'] = $this->tour->get_list_cat(0);
        //$data['list'] =   $this->db->result("select * from tour where published= 1 order by id desc limit 18");
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('index',$data);
    }
    
    
    function catindex(){
        $slug1 = $this->uri->segment(1);
        $catinfo = $this->tour->get_cat_by_slug($slug1);
        $str_ar_cat = $this->tour->get_str_ar_cat($catinfo->cat_id);
        $data['str_ar_cat'] = $str_ar_cat;
        $data['title'] = $catinfo->name_small;
        $data['des'] = $catinfo->des;
        $data['keyword'] = $catinfo->keyword;
        $data['cat_id'] = $catinfo->cat_id;
        $this->link[0] = 'Tour:tour';
        $this->link[1] = $catinfo->name.':'.$catinfo->slug;
        $data['total_rows']   =  $this->tour->get_num_catindex($str_ar_cat);
        
//        $config['base_url'] = base_url().$slug1;
//        $config['suffix'] = '.html';
//        $config['total_rows']   =  $this->tour->get_num_catindex($str_ar_cat);
        $config['per_page']  =   18; 
//        $config['uri_segment'] = 2; 
//        $this->load->library('pagination');
//        $this->pagination->initialize($config);   
//        $data['list'] =   $this->tour->get_all_catindex($config['per_page'],segment(2,'int'),$str_ar_cat);
//        $data['pagination']    = $this->pagination->create_links();
        $data['list'] =   $this->tour->get_all_catindex($config['per_page'],segment(2,'int'),$str_ar_cat);
        $this->load->templates('catindex',$data	);
    }
    
    
    
    function cat(){
        $slug1 = $this->uri->segment(1);
        $slug2 = $this->uri->segment(2);
        $catinfo = $this->tour->get_cat_by_slug($slug2);
        $catinfo1 = $this->tour->get_cat_by_id($catinfo->parent_id);
        $str_ar_cat = $catinfo->cat_id;
        
        $data['title'] = ($catinfo->name_small) ? $catinfo->name_small : $catinfo->name;
        $data['des'] = $catinfo->des;
        $data['keyword'] = $catinfo->keyword;
        $data['cat_id'] = $catinfo->cat_id;
        $this->link[0] = 'Tour:tour';
        $this->link[1] = $catinfo1->name.':'.$catinfo1->slug;
        $this->link[2] = $catinfo->name.':'.$catinfo1->slug.'/'.$catinfo->slug;
        $config['base_url'] = base_url().$slug1.'/'.$slug2;
        $config['suffix'] = '.html';
        $data['total_rows']    =  $this->tour->get_num_catindex($str_ar_cat);
        $config['per_page']  =   18; 
        $config['uri_segment'] = 3; 
        $data['str_ar_cat'] = $str_ar_cat;
        //$this->load->library('pagination');
       // $this->pagination->initialize($config);   
        $data['list'] =   $this->tour->get_all_catindex($config['per_page'],segment(3,'int'),$str_ar_cat);
       // $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('catindex',$data);
    }
    function cat2(){
        $slug1 = $this->uri->segment(1);
        $slug2 = $this->uri->segment(2);
        $slug3 = $this->uri->segment(3);
        $catinfo = $this->tour->get_cat_by_slug($slug3);
        $catinfo1 = $this->tour->get_cat_by_slug($slug2);
        $catinfo2 = $this->tour->get_cat_by_slug($slug1);
        $str_ar_cat = $catinfo->cat_id;
        
        $data['title'] = ($catinfo->name_small) ? $catinfo->name_small : $catinfo->name;
        $data['des'] = $catinfo->des;
        $data['keyword'] = $catinfo->keyword;
        $data['cat_id'] = $catinfo->cat_id;
        $this->link[0] = 'Tour:tour';
        $this->link[1] = $catinfo2->name.':'.$catinfo2->slug;
        $this->link[2] = $catinfo1->name.':'.$catinfo2->slug.'/'.$catinfo1->slug;
        $config['base_url'] = base_url().$slug1.'/'.$slug2;
        $config['suffix'] = '.html';
        $data['total_rows']    =  $this->tour->get_num_catindex($str_ar_cat);
        $config['per_page']  =   18; 
        $config['uri_segment'] = 4; 
        $data['str_ar_cat'] = $str_ar_cat;
       // $this->load->library('pagination');
       // $this->pagination->initialize($config);   
        $data['list'] =   $this->tour->get_all_catindex($config['per_page'],segment(4,'int'),$str_ar_cat);
       // $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('catindex',$data);
    }
    function chude(){
        $slug1 = $this->uri->segment(1);
        $chude = $this->tour->get_chude_by_slug($slug1);
        $data['title'] = $chude->small_chude;
        $data['id_chude'] = $chude->id_chude;
        $data['des'] = $chude->des_chude;
        $data['keyword'] = $chude->keyword_chude;
        $this->link[0] = $chude->ten_chude.':'.$slug1;
        $data['total_rows']   =  $this->tour->get_num_chude($chude->id_chude); 
        $data['list'] =   $this->tour->get_all_chude(12,$chude->id_chude);
        $this->load->templates('chude',$data);
    }
    
    function detail(){
        $slug = $this->uri->segment(1);
        $id_ = explode('-',$slug);
        $id = $id_[0];
        $rs = $this->tour->get_tour_by_id($id);

        if(!$rs){
            redirect('tour');
        }
        $this->db->query("UPDATE tour SET hits = hits + 1 WHERE id = $id");
        $urlref = $_SERVER["HTTP_REFERER"];
        if (strlen(strstr($urlref, 'facebook.com')) > 0) {
         	$this->db->query("UPDATE tour SET hits_face = hits_face + 1 WHERE id = $id");
        }
         if (strlen(strstr($urlref, 'google.com')) > 0) {
         	$this->db->query("UPDATE tour SET hits_google = hits_google + 1 WHERE id = $id");
        }
        $this->link[0] = 'Tour:tour';
        $this->link[1] = $rs->title.':'.$rs->id.'-'.$rs->slug;
        $data['title'] = $rs->title_seo?$rs->title_seo:$rs->title;
        $data['images'] = 'data/tour/500/'.$rs->images;
        $data['des'] = $rs->gioithieu;
        $data['keyword'] = $rs->keyword;
        $data['rs'] = $rs;
		$data['price'] = $this->dnx->get_min_price($rs->id);
        $data['khoihanh'] = $this->tour->get_city_by_id($rs->khoihanh);
        $data['ketthuc'] = $this->tour->get_city_by_id($rs->ketthuc);
        $data['all_img'] = $this->tour->get_list_img($id);
        $data['ds_price'] = $this->tour->get_list_banggia($rs->id);
        if(!$rs->tourlienquan){
            $data['tour_lienquan'] = $this->tour->get_tour_lien_quan($rs->id, $rs->cat_id);
        } else {
            $data['tour_lienquan'] = $this->db->result("select * from tour where published = 1 and id in ($rs->tourlienquan)");
        }
            
        $data['lcomtotal'] = $this->tour->get_comment_total($id);
        
        $data['lcom'] = $this->tour->get_comment($rs->id);
        //Rating
        
        $data['total_rate'] = $data['lcomtotal'];
        $sum =$this->tour->get_sum_rating($id);
        $data['rating'] = $sum / $data['lcomtotal'];
        $this->load->templates('detail',$data);
    }
    
    function printer(){
        $id = $this->uri->segment(3);
        $rs = $this->tour->get_tour_by_id($id);

        if(!$rs){
            redirect('tour');
        }
        $this->link[0] = 'Tour:tour';
        $this->link[1] = $rs->title.':'.$rs->id.'-'.$rs->slug;
        $data['title'] = $rs->title;
        $data['images'] = 'data/tour/500/'.$rs->images;
        $data['des'] = $rs->gioithieu;
        $data['rs'] = $rs;
        $data['khoihanh'] = $this->tour->get_city_by_id($rs->khoihanh);
        $data['ketthuc'] = $this->tour->get_city_by_id($rs->ketthuc);
        $data['all_img'] = $this->tour->get_list_img($id);
        $data['ds_price'] = $this->tour->get_list_banggia($id);
        $data['tour_lienquan'] = $this->tour->get_tour_lien_quan($rs->id, $rs->cat_id);
        $this->load->templates('print',$data,'print');
    }
    function booking(){
        $slug2 = $this->uri->segment(2);
        $id = end(explode('-',$slug2));
        $rs = $this->tour->get_tour_by_id($id);
        $data['title'] = "Đặt Tour: ".$rs->title;
        $this->link[0] = 'Đặt Tour:dat-tour/'.$rs->slug.'-'.$rs->id;
        $data['rs'] = $rs;
		$data['price'] = $this->dnx->get_min_price($rs->id);
        $data['price_item'] = $this->tour->get_list_banggia($rs->id);
        $data['nganhang'] = $this->tour->get_all_bank();
        $this->form_validation->set_rules('fullname','Họ và tên','required');
        $this->form_validation->set_rules('address','Địa chỉ','required');
        $this->form_validation->set_rules('phone','Điện thoại','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('payment','Phương thức thanh toán','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $ar_name_nl = $this->request->post['ar_name_nl'];
            $ar_date_nl = $this->request->post['ar_date_nl'];
            $ar_name_te = $this->request->post['ar_name_te'];
            $ar_date_te = $this->request->post['ar_date_te'];
            $ar_name_eb = $this->request->post['ar_name_eb'];
            $ar_date_eb = $this->request->post['ar_date_eb'];
            $vdata['tour_id'] = $this->request->post['tour_id'];
            $vdata['fullname'] = $this->request->post['fullname'];
            $vdata['address'] = $this->request->post['address'];
            $vdata['phone'] = $this->request->post['phone'];
            $vdata['email'] = $this->request->post['email'];
            $vdata['notes'] = $this->request->post['notes'];
            $vdata['diemdon'] = $this->request->post['diemdon'];
            $vdata['payment'] = $this->request->post['payment'];
            $day = $this->request->post['day'];
            $month = $this->request->post['month'];
            $year = $this->request->post['year'];
            $vdata['date_to'] = strtotime($day.'-'.$month.'-'.$year);
            $vdata['date_add'] = time();
            $vdata['nguoilon'] = $this->request->post['adults'];
            $vdata['treem'] = $this->request->post['children'];
            $vdata['embe'] = $this->request->post['baby'];
            $scode = 'BOOKING-'.date('Ymd',time()).'-';
            $barcode = $this->tour->create_barcode($scode);
            $vdata['scode'] = $scode;
            $vdata['code'] = $barcode;
            $price = $this->dnx->getPriceBook($vdata['tour_id'],$vdata['nguoilon']);
            
            $total_nguoilon = ($price->price * $vdata['nguoilon']);
            $total_treen = (($price->price2)  * $vdata['treem'] );
            $vdata['total'] =  $total_nguoilon + $total_treen;
            
            if($this->db->insert('booking',$vdata)){
                $id_book = $this->db->insert_id();
               /* 
                for($i = 0; $i < sizeof($ar_name_nl); $i++){
                    if($ar_name_nl[$i] != ''){
                        $vdatas['fullname'] = $ar_name_nl[$i];
                        $vdatas['birthday'] = $ar_date_nl[$i];
                        $vdatas['id'] = $id_book;
                        $vdatas['type'] = 1;
                        $this->db->insert('booking_detail',$vdatas);
                    }
                }
                
                
                for($i = 0; $i < sizeof($ar_name_te); $i++){
                    if($ar_name_te[$i] != ''){
                        $vdatas['fullname'] = $ar_name_te[$i];
                        $vdatas['birthday'] = $ar_date_te[$i];
                        $vdatas['id'] = $id_book;
                        $vdatas['type'] = 2;
                        $this->db->insert('booking_detail',$vdatas);
                    }
                }  
                
                
                for($i = 0; $i < sizeof($ar_name_eb); $i++){
                    if($ar_name_eb[$i] != ''){
                        $vdatas['fullname'] = $ar_name_eb[$i];
                        $vdatas['birthday'] = $ar_date_eb[$i];
                        $vdatas['id'] = $id_book;
                        $vdatas['type'] = 3;
                        $this->db->insert('booking_detail',$vdatas);
                    }
                } 
                   */
                $this->session->set_flashdata('message','Đặt tour thành công. Thông tin đặt tour của quý khách đã được gửi về email: '.$vdata['email']);
                // Send mail cho khach hang
                $message = file_get_contents(base_url().'ajax/mail_tour/'.$id_book);
                $subject = "Thông tin đặt tour. Mã đặt tour: ".$barcode;
                if(sendmail($this->config->item('contact_name'),'sales@tuannguyentravel.com',$vdata['email'],$subject,$message)){
                    //sendmail($this->config->item('contact_name'),$this->config->item('contact_email'),$this->config->item('site_email'),$subject,$message);
                    sendmail($this->config->item('contact_name'),'sales@tuannguyentravel.com','nguyenphuongthu102@gmail.com' ,$subject,$message); 
                }
            }else{
                $this->session->set_flashdata('message','Đặt tour không thành công');
            }
           redirect(uri_string());
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('booking',$data);
    }
    
    
    function tour_price(){
        $qty = $this->request->get['qty'];
        $tn = $this->request->get['tn'];
        $id = $this->request->get['id'];
        $sql = "SELECT * FROM tour_price WHERE id = $id AND begin <= $qty ORDER BY begin DESC";
        $rs = $this->db->row($sql);
        $price1 =  $rs->price * $qty;
        $price2 = (($rs->price2)  * $tn );
        $data['price'] = number_format($price1 + $price2,0,'.','.');
        echo json_encode($data);
    }
}
