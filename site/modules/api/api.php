<?php
class api extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('api_model','api');
        $this->user_id = $this->session->data['user_id'];
        $this->session_id = $this->session->sessionid();
    }
    
    function rating(){
        $total = $this->request->post['total'];
        $tour_id = $this->request->post['tour_id'];
        $check_rating = $this->api->check_rating($this->session_id, $tour_id);
        if($check_rating){
             $vdata['session_id'] = $this->session_id;
             $vdata['tour_id'] = $tour_id;
             $vdata['timer'] = time();
             $vdata['total'] = $total;
             $this->db->insert('rating',$vdata);
             $tong = $this->api->total_row($tour_id);
             $total_rating = $this->api->total_score($tour_id);
             $vup['total_rate'] = $tong;
             $vup['rate'] = ($total_rating/$tong);
             $this->db->update('tour',$vup,array('id'=>$tour_id));
             $data['error'] = 0;
             $data['total_rate'] = $vup['total_rate'];
             $data['rate'] = number_format($vup['rate'],1,',','.');
             $data['per'] = ($vup['rate'] * 100)/5;
             $data['msg'] = "Xin cảm ơn bạn đã đánh giá thành công!";
        }else{
            $data['error'] = 1;
            $data['msg'] = "Bạn đã đánh giá tour này rồi<br>Xin cảm ơn!";
        }
        echo json_encode($data);
    }
    function addcomment(){
        $sess_captcha = $this->session->data['mabaove'];
        $captcha = $this->request->post['captcha'];
        if($sess_captcha==$captcha){
              $vdata = $this->request->post['vdata'];
              $vdata['time'] = time();
             
              if($this->db->insert('tour_comment',$vdata)){
                  $data['error'] = 0;
                  $data['msg'] = "Gửi đánh giá thành công! Cảm ơn quý khách!";
                  /*$html = '<li>';
                  $html .= '<div><b class="fullname">'.$vdata['fullname'].'</b> <span class="data">Ngày gửi: '.date('d/m/Y H:i',time()).'</span></div>';
                  $html .= '<div>'.$vdata['content'].'</div>';    
                  $html .= '<li>';
                  $data['html'] = $html;   */
                  //$data['total'] = $this->get_total($vdata['tour_id']);
                
              }else{
                  $data['error'] = 1;
                  $data['msg'] = "Gửi đánh giá không thành công!";
              }
              
       }else{  
            $data['error'] = 1;
            $data['msg'] = "Mã bảo vệ nhập không đúng";
        }
        //$tam = $this->captcha();  
        $data['img'] = 'http://www.danangxanh.com/api/captcha/'.time();
        echo json_encode($data);
    }
    function captcha(){
        $this->load->helper('captcha'); 
        create_image();
    }
    function get_total($id){
        return $this->db->query("SELECT id FROM tour_comment WHERE tour_id = $id")->num_rows();
    }

    function loadtour(){
        $catid = $this->request->post['catid'];
        $offset = $this->request->post['offset'];
        $limit = 18;
        $html ='';
        
       
        
        $tour = $this->api->get_all_catindex($catid,$limit,$offset);
       
        if (count($tour)>0){
            foreach($tour as $val):
                $price = $this->dnx->get_min_price($val->id);
                $khoihanh = $this->db->row("select * from city where city_id = $val->khoihanh");
                $html .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">';
                $html .=    '<div class="tour-box">';
                if($val->giamgia > 0){
                    $html .='<div class="tour-sale"><span>Giảm'.$val->giamgia.'%</span></div>';
                } $dem = "";
                if($val->dem > 0) {$dem = $val->dem;}
                
                $html .=     '<div class="tour-img">';
                $html .=        '<a title="'.$val->title.'" href="'.site_url($val->id.'-'.$val->slug).'">';
                $html .=            '<img class="img" alt="'.$val->title.'" src="'.base_url().'data/tour/500/'.$val->images.'"/>';
                $html .=        '</a>';
                $html .=        '<div>';
                $html .=            '<h5><a title=".'.$val->title.'" href="'.site_url($val->id.'-'.$val->slug).'"></h5>';
                $html .=            '<div><span class="pull-left">Thời gian</span><span class="pull-right">'.$val->ngay.' Ngày - '.$dem.' '.'đêm';
                $html .=            '<div class="clearfix"></div></div>';
                $html .=            '<div><span class="pull-left">Phương tiện:</span><span class="pull-right">'.$val->vanchuyen.'</span>';
                $html .=            '<div class="clearfix"></div></div>';
                $html .=            '<div><span class="pull-left">Khởi hành tại:</span><span class="pull-right">'.$khoihanh->city_name.'</span>';
                $html .=            '<div class="clearfix"></div></div>';
                $html .=            '<div><span class="pull-left">Giá:</span><span class="pull-right">'.number_format($price,0,'.','.').' VNĐ </span>';
                $html .=            '<div class="clearfix"></div></div>';
                $html .=            '<div class="row">';
                $html .=                '<div class="col-xs-6 text-left"><a class="book_btn" href="'.site_url($val->id.'-'.$val->slug).'">Chi tiết</a></div>';
                $html .=                '<div class="col-xs-6 text-right"><a href="'.site_url('dat-tour/'.$val->slug.'-'.$val->id).'" class="book_btn">Đặt tour</a></div>';
                $html .=            '</div>';
                $html .=         '</div>';
                $html .=     '</div>';
                $html .=     '<div class="tour-info">';
                $html .=        '<h3><a id="tour_50" title="'.$val->title.'" href="'.site_url($val->id.'-'.$val->slug).'">'.$val->title.'</a></h3>';
                $html .= '   <div style="padding:0 5px;"><span class="pull-left"><b>Phương tiện: </b></span><span class="pull-right">'.$val->vanchuyen.'</span>';
				$html .= '	<div class="clearfix"></div></div>';
				$ngaykhoihanh = ($val->ngaykhoihanh) ? $val->ngaykhoihanh : "Hằng ngày";
				$giatour = ($price) ? number_format($price,0,'.','.')." VNĐ" : "Liên hệ";
				$html .= '   <div style="padding:0 5px;"><span class="pull-left"><b>Thời gian: </b></span><span class="pull-right">'.$val->ngay.' Ngày '.$val->dem.' đêm </span>';
				$html .= '	<div class="clearfix"></div></div>';	
				$html .= '	<div style="padding:0 5px;"><span class="pull-left"><b>Ngày khởi hành: </b></span><span class="pull-right">'.$ngaykhoihanh.'</span>';
				$html .= '	<div class="clearfix"></div></div>';
                $html .= '	<div style="padding:0 5px;"><span class="pull-left"><b>Khởi hành tại: </b></span><span class="pull-right">'.$khoihanh->city_name.'</span>';
				$html .= '	<div class="clearfix"></div></div>';
                $html .=        '<div class="price">';
                $html .=            '<div class="pull-left">Giá: '.$giatour.'</div>';
                $html .=            '<div class="pull-right"><a class="read-more" href="'.site_url($val->id.'-'.$val->slug).'">Chi tiết</a></div>';
                $html .=            '<div class="clearfix"></div>';
 
                $html .=    '</div></div></div>';
                $html .= '</div>';
            endforeach;  
        }
            
        $data['html'] = $html;   
        $data['offset'] = $offset+18;    
        $data['total'] = $this->api->get_num_catindex($catid);
        echo json_encode($data);
    }

    function loadtour_chude(){
        $id_chude = $this->request->post['id_chude'];
        $offset = $this->request->post['offset'];
        $limit = 18;
        $html ='';
        
        $sql = "
            SELECT * FROM tour WHERE published = 1
        ";
        $sql .=" AND id_chude = $id_chude";
        $sql .=" ORDER BY id, noibat, khuyenmai DESC";
        if($limit !=0){
            $sql .=" limit $limit offset $offset";
        }
        
        $tour = $this->db->result($sql);
       
        if (count($tour)>0){
            foreach($tour as $val):
                $price = $this->dnx->get_min_price($val->id);
                $khoihanh = $this->db->row("select * from city where city_id = $val->khoihanh");
                $html .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">';
                $html .=    '<div class="tour-box">';
                if($val->giamgia > 0){
                    $html .='<div class="tour-sale"><span>Giảm'.$val->giamgia.'%</span></div>';
                } $dem = "";
                if($val->dem > 0) {$dem = $val->dem;}
                
                $html .=     '<div class="tour-img">';
                $html .=        '<a title="'.$val->title.'" href="'.site_url($val->id.'-'.$val->slug).'">';
                $html .=            '<img class="img" alt="'.$val->title.'" src="'.base_url().'data/tour/500/'.$val->images.'"/>';
                $html .=        '</a>';
                $html .=        '<div>';
                $html .=            '<h5><a title=".'.$val->title.'" href="'.site_url($val->id.'-'.$val->slug).'"></h5>';
                $html .=            '<div><span class="pull-left">Thời gian</span><span class="pull-right">'.$val->ngay.' Ngày - '.$dem.' '.'đêm';
                $html .=            '<div class="clearfix"></div></div>';
                $html .=            '<div><span class="pull-left">Phương tiện:</span><span class="pull-right">'.$val->vanchuyen.'</span>';
                $html .=            '<div class="clearfix"></div></div>';
                $html .=            '<div><span class="pull-left">Khởi hành tại:</span><span class="pull-right">'.$khoihanh->city_name.'</span>';
                $html .=            '<div class="clearfix"></div></div>';
                $html .=            '<div><span class="pull-left">Giá:</span><span class="pull-right">'.number_format($price,0,'.','.').' VNĐ </span>';
                $html .=            '<div class="clearfix"></div></div>';
                $html .=            '<div class="row">';
                $html .=                '<div class="col-xs-6 text-left"><a class="book_btn" href="'.site_url($val->id.'-'.$val->slug).'">Chi tiết</a></div>';
                $html .=                '<div class="col-xs-6 text-right"><a href="'.site_url('dat-tour/'.$val->slug.'-'.$val->id).'" class="book_btn">Đặt tour</a></div>';
                $html .=            '</div>';
                $html .=         '</div>';
                $html .=     '</div>';
                $html .=     '<div class="tour-info">';
                $html .=        '<h3><a id="tour_50" title="'.$val->title.'" href="'.site_url($val->id.'-'.$val->slug).'">'.$val->title.'</a></h3>';
                $html .= '<div style="padding:0 5px;"><span class="pull-left"><b>Thời gian: </b></span><span class="pull-right">'.$val->ngay.' Ngày '.$val->dem.' đêm </span>';
				$html .= '	<div class="clearfix"></div></div>';
				$html .= '	<div style="padding:0 5px;"><span class="pull-left"><b>Hình thức: </b></span><span class="pull-right">'.$val->hinhthuc.'</span>';
				$html .= '	<div class="clearfix"></div></div>';
				$html .= '	<div style="padding:0 5px;"><span class="pull-left"><b>Khởi hành tại: </b></span><span class="pull-right">'.$khoihanh->city_name.'</span>';
				$html .= '	<div class="clearfix"></div></div>';
                
                $html .=        '<div class="price">';
                $html .=            '<div class="pull-left">Giá: '.number_format($price,0,'.','.').' VNĐ</div>';
                $html .=            '<div class="pull-right"><a class="read-more" href="'.site_url($val->id.'-'.$val->slug).'">Chi tiết</a></div>';
                $html .=            '<div class="clearfix"></div>';
 
                $html .=    '</div></div></div>';
                $html .= '</div>';
            endforeach;  
        }
            
        $data['html'] = $html;   
        $data['offset'] = $offset+12;    
        $data['total'] = $this->api->get_num_catindex($id_chude);
        echo json_encode($data);
    }
    
}
