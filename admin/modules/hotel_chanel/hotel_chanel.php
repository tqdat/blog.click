<?php
class hotel_chanel extends vnit{
    protected $_templates;
    function __construct(){
        parent::__construct();
        $this->load->model('hotel_chanel_model','hotel_chanel');
        $this->cache_menu();
    }
    
    function index(){
        $this->cache_menu();
        $data['title'] = 'Quản lý Danh mục';
        $data['add'] = 'hotel_chanel/add';
        $data['delete'] = true;             
        $data['list'] =   $this->hotel_chanel->get_all_hotel_chanel();
        $this->_templates['page'] = 'index';
        $this->load->templates($this->_templates['page'],$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới danh mục tin tức";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'hotel_chanel';
        $data['listmain'] = $this->hotel_chanel->get_all_hotel_chanel();
        // Form validation
        $this->form_validation->set_rules('data[cat_name]','Danh mục','required');
        $this->form_validation->set_rules('data[published]','Hiển thị','required');
        $this->form_validation->set_rules('data[cat_order]','','');
        $this->form_validation->set_rules('data[cat_des]','','');
        $this->form_validation->set_rules('data[cat_keyword]','','');
        $this->form_validation->set_rules('data[parent_id]','','');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $data = $_POST['data'];
            $data['cat_slug'] = vnit_change_title($data['cat_name']);
            if($this->db->insert('hotel_chanel',$data)){
                $id = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'hotel_chanel';
                }else{
                    $url = 'hotel_chanel/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->_templates['page'] = 'add';
        $this->load->templates($this->_templates['page'],$data);
    }
    
    function edit(){
        $data['title'] = 'Cập nhật danh mục tin tức';
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'hotel_chanel';
        $id = segment(3,'int');
        $data['rs'] = $this->hotel_chanel->get_cat_by_id($id);
        $data['listmain'] = $this->hotel_chanel->get_all_hotel_chanel();
        // Form validation
        $this->form_validation->set_rules('data[cat_name]','Danh mục','required');
        $this->form_validation->set_rules('data[published]','Hiển thị','required');
        $this->form_validation->set_rules('data[cat_order]','','');
        $this->form_validation->set_rules('data[cat_des]','','');
        $this->form_validation->set_rules('data[cat_keyword]','','');
        $this->form_validation->set_rules('data[parent_id]','','');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $data = $_POST['data'];
            $data['cat_slug'] = vnit_change_title($data['cat_name']);
            if($this->db->update('hotel_chanel',$data,array('cat_id'=>$id))){
                
                //Update news
                $vnews['cat_slug'] = $data['cat_slug'];
                $this->db->update('news',$vnews,array('catid'=>$id));
                
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'hotel_chanel';
                }else{
                    $url = uri_string();
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->_templates['page'] = 'edit';
        $this->load->templates($this->_templates['page'],$data);
    }
    
    function save_order(){
        $id = $_POST['id'];
        for($i = 0 ; $i< sizeof($id);$i++){
            $menu['cat_order'] = $_POST['order_'.$id[$i]];
            $this->db->update('hotel_chanel',$menu,array('cat_id'=>$id[$i]));
        }
    }

    // Xoa nhieu ban ghi
    function dels(){
        if(!empty($_POST['ar_id']))
        {
            $msg = "";
            $ar_id = $_POST['ar_id'];
            for($i = 0; $i < sizeof($ar_id); $i ++) {
                $catid = $ar_id[$i];
                if ($catid){
                    $total_cat = $this->hotel_chanel->get_num_cat($catid);
                    if($total_cat == 0){ // Cho phep xoa
                        // Kiem tra so luong bai viet trong chuyen muc
                        $total_news = $this->hotel_chanel->get_num_new($catid);
                        if($total_news == 0){ // Xóa bai viet
                            if($this->db->delete('hotel_chanel',array('cat_id'=>$catid))){
                                $msg .='<div>Chuyên mục: ID <b>'.$catid.'</b> xóa thành công</div>';
                            }else{
                                $msg .='<div>Chuyên mục: ID <b>'.$catid.'</b> không xóa thành công</div>';
                            }
                        }else{
                            $msg .='<div>Chuyên mục: ID <b>'.$catid.'</b> vẫn còn bài viết. Không thể xóa</div>';    
                        }
                    }else{
                        $msg .='<div>Chuyên mục: ID <b>'.$catid.'</b> vẫn còn chuyên mục con. Không thể xóa</div>';
                    }
                }
            }
        }
        $this->session->set_flashdata('message',$msg);
        redirect('hotel_chanel');
    }
    
    function cache_menu(){
        $this->load->helper('file');
        $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* File route_news \n* Date: ".date('d/m/y H:i:s').".\n**/";
        $list = $this->hotel_chanel->get_main_router(0);
        foreach($list as $rs):
            $sub = $list = $this->hotel_chanel->get_main_router($rs->cat_id);
            $slug = $rs->cat_slug;
            $str .= "\n\$route['".$slug."'] = 'khachsan/index';";  
            $str .= "\n\$route['".$slug."/(:num)'] = 'khachsan/index/$1';";  
            foreach($sub as $rs1):
                $slug1 = $rs1->cat_slug;
            $str .= "\n\$route['".$slug."/".$slug1."'] = 'khachsan/cat';";  
            $str .= "\n\$route['".$slug."/".$slug1."/(:num)'] = 'khachsan/cat/$1';";  
            endforeach;
        endforeach;
        $list1 = $this->hotel_chanel->get_main_router(0);
        foreach($list1 as $rs):
            $slug = $rs->cat_slug;
            $str .= "\n\$route['".$slug."/(:any)'] = 'khachsan/detail/$1';";
        endforeach;
        write_file(ROOT.'site/config/router/route_hotel.php', $str); 
    }
}
