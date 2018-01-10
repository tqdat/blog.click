<?php
class category extends vnit{
    protected $_templates;
    function __construct(){
        parent::__construct();
        $this->load->model('category_model','category');
        $this->pre_message = "";
        $this->write_route();
    }
    
    function index(){
        
        $data['title'] = 'Quản lý danh mục Tour';
        $data['add'] = 'tour/category/add';
        $data['delete'] = true;             
        $data['list'] =   $this->category->get_all_category();
        $this->_templates['page'] = 'category/index';
        $this->load->templates($this->_templates['page'],$data);
    }
    
    function add(){
        $data['title'] = "Thêm mới danh mục Tour";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tour/category';
        $data['listmain'] = $this->category->get_all_category();
        // Form validation
        $this->form_validation->set_rules('vdata[name]','Tên danh mục Tour','required');
        $this->form_validation->set_rules('vdata[des]','','');
        $this->form_validation->set_rules('vdata[keyword]','','');
        $this->form_validation->set_rules('vdata[cat_order]','','');
        $this->form_validation->set_rules('vdata[parent_id]','','');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $vdata = $this->request->post['vdata'];
            $vdata['is_menu'] = $this->request->post['is_menu'];
            $vdata['is_homepage'] = $this->request->post['is_homepage'];
            $vdata['published'] = $this->request->post['published'];
            $vdata['slug'] = vnit_change_title($vdata['name']);
            if($this->db->insert('tour_cat',$vdata)){
                $cat_id  = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'tour/category';
                }else{
                    $url = 'tour/category/edit/'.$cat_id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->_templates['page'] = 'category/add';
        $this->load->templates($this->_templates['page'],$data);
    }
    
    function edit(){
        $data['title'] = 'Cập nhật danh mục Tour';
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tour/category';
        $id = segment(4,'int');
        $data['rs'] = $this->category->get_cat_by_id($id);
        $data['listmain'] = $this->category->get_all_category();
        $data['list'] = $this->category->get_category_by_lang($id);
        // Form validation
        $this->form_validation->set_rules('vdata[name]','Tên danh mục Tour ','required');
        $this->form_validation->set_rules('vdata[des]','','');
        $this->form_validation->set_rules('vdata[keyword]','','');
        $this->form_validation->set_rules('vdata[ordering]','','');
        $this->form_validation->set_rules('vdata[parent_id]','','');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors(); 
        }else{
            
            $vdata = $this->request->post['vdata'];
            $vdata['slug'] = vnit_change_title($vdata['name']);
            $vdata['is_menu'] = $this->request->post['is_menu'];
            $vdata['is_homepage'] = $this->request->post['is_homepage'];
            $vdata['published'] = $this->request->post['published'];
            if($this->db->update('tour_cat',$vdata,array('cat_id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'tour/category';
                }else{
                    $url = uri_string();
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->_templates['page'] = 'category/edit';
        $this->load->templates($this->_templates['page'],$data);
    }
    
    function save_order(){
        $id = $_POST['id'];
        for($i = 0 ; $i< sizeof($id);$i++){
            $menu['ordering'] = $_POST['order_'.$id[$i]];
            $this->db->update('tour_cat',$menu,array('cat_id'=>$id[$i]));
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
                    $total_cat = $this->category->get_num_cat($catid);
                    if($total_cat == 0){ // Cho phep xoa
                        // Kiem tra so luong bai viet trong chuyen muc
                        $total_news = $this->category->get_num_new($catid);
                        if($total_news == 0){ // Xóa bai viet
                            if($this->db->delete('tour_cat',array('cat_id'=>$catid))){
                                $this->db->delete('tour_cat_des',array('cat_id'=>$catid));
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
        redirect('tour/category');
    }
    
    function write_route(){
        $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* File Router_Tour \n* Date: ".date('d/m/y H:i:s').".\n**/";
        $list = $this->category->get_list_cat(0);
        
        foreach($list as $rs):
            $list1 = $this->category->get_list_cat($rs->cat_id);
            $slug =  $rs->slug;
            $str .= "\n\$route['".$slug."'] = 'tour/catindex';";
            $str .= "\n\$route['".$slug."/(:num)'] = 'tour/catindex/$1';";
            foreach($list1 as $rs1):
                $slug1 = $rs1->slug;
                $str .= "\n\$route['".$slug."/".$slug1."'] = 'tour/cat';";
                $str .= "\n\$route['".$slug."/".$slug1."/(:num)'] = 'tour/cat/$1';";
                $list12 = $this->category->get_list_cat($rs1->cat_id);
            	
            		foreach($list12 as $rs12):
                		$slug12 = $rs12->slug;
                		$str .= "\n\$route['".$slug."/".$slug1."/".$slug12."'] = 'tour/cat2';";
                		$str .= "\n\$route['".$slug."/".$slug1."/".$slug12."/(:num)'] = 'tour/cat2/$1';";
            		endforeach;
            endforeach;
        endforeach;
        /*
        foreach($list as $rs):
            $slug =  $rs->slug;
            $str .= "\n\$route['".$slug."/(:any)'] = 'tour/detail/$1';";
        endforeach;
        */
        $this->load->helper('file');
        write_file(ROOT.'site/config/router/router_tour.php', $str);
    }
}
