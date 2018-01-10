<?php
class category extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('category_model','category');
        $this->pre_message = "";
        $this->load->helper('vimg');
    }

    /******************************Main cat************************************/
    function maincat(){
        $data['title'] = "Danh sách danh mục chính";
        //$this->cache_menu();
        $this->cache_cat();
        $data['add'] = 'company/category/addmaincat';
        $data['list'] = $this->category->get_all_maincat();
        $this->load->templates('category/maincat',$data);
    }
    
    function addmaincat(){
        $data['title'] = "Thêm mới danh mục chính";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'company/category/maincat';
        $this->form_validation->set_rules('vdata[catname]','Danh mục','required');
        $this->form_validation->set_rules('vdata[ordering]','Sắp xếp','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            
            $vdata = $this->request->post['vdata'];
            $vdata['alias'] = vnit_change_title($vdata['catname']);
            if($this->db->insert('company_cat',$vdata)){
                $catid = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'company/category/maincat';
                }else{
                    $url = 'company/category/editmaincat/'.$catid;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('category/addmaincat',$data);
    }
    
    function editmaincat(){
        $data['title'] = "Cập nhật danh mục chính";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'company/category/miancat';
        $id = $this->uri->segment(4);
        $data['rs'] = $this->db->row("SELECT * FROM company_cat WHERE catid = $id");
        $this->form_validation->set_rules('vdata[catname]','Danh mục','required');
        $this->form_validation->set_rules('vdata[ordering]','Sắp xếp','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $catid = $this->request->post['catid'];
            $vdata = $this->request->post['vdata'];
            $vdata['alias'] = vnit_change_title($vdata['catname']);
            if($this->db->update('company_cat',$vdata,array('catid'=>$catid))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'company/category/maincat';
                }else{
                    $url = 'company/category/editmaincat/'.$catid;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('category/editmaincat',$data);
    }
    
    function save_order_maincat(){
        $id = $this->request->post['id'];
        for($i = 0; $i < sizeof($id); $i++){
            $vdata['ordering'] = $this->request->post['order_'.$id[$i]];
            $this->db->update('company_cat',$vdata,array('catid'=>$id[$i]));
        }
    }
    
    
    /*******************************Sub cat****************************************/
    
    function ds(){
        $id = $this->uri->segment(4);
        $row = $this->db->row("SElECT catname FROM company_cat WHERE catid = $id");
        $data['catid'] = $id;
        $data['title'] = "Danh mục thuộc: ".$row->catname;
        $data['delete']  = true;
        $data['add'] = 'company/category/add/'.$id;
        $data['back'] = 'company/category/maincat';
        $data['list'] = $this->category->get_list_cat($id);
        $this->load->templates('category/ds',$data);
    }
    
    function add(){
        $catid = $this->uri->segment(4);
        $maincat = $catid;
        $row = $this->db->row("SElECT catname FROM category WHERE catid = $catid");
        $data['catid'] = $catid;
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] ='pcat/ds/'.$catid;
        $data['title'] = "Thêm danh mục trong: ".$row->catname;
        $data['list'] = $this->category->get_all_maincat();
        $this->form_validation->set_rules('vdata[catname]','Tên danh mục','required');
        $this->form_validation->set_rules('vdata[ordering]','Sắp xếp','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            
            $vdata = $this->request->post['vdata'];
            $vdata['alias'] = vnit_change_title($vdata['catname']);
            if($this->db->insert('company_cat',$vdata)){
                $catid = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'company/category/ds/'.$maincat;
                }else{
                    $url = 'company/category/edit/'.$vdata['parent_id'].'/'.$catid;
                }
                redirect($url);
            }
        } 
        $data['message']  = $this->pre_message;
        $this->load->templates('category/add',$data);
    }
    
    function edit(){
        $catid = $this->uri->segment(4);
        $maincat = $catid;
        $row = $this->db->row("SElECT catname FROM company_cat WHERE catid = $catid");
        $id = $this->uri->segment(5);
        $data['catid'] = $catid;
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] ='company/category/ds/'.$maincat;
        $data['title'] = "Thêm danh mục trong: ".$row->catname;
        $data['list'] = $this->category->get_all_maincat();
        $data['rs'] = $this->db->row("SELECT * FROM company_cat WHERE catid = $id");
        $this->form_validation->set_rules('vdata[catname]','Tên danh mục','required');
        $this->form_validation->set_rules('vdata[ordering]','Sắp xếp','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $catid = $this->request->post['catid'];
            $vdata = $this->request->post['vdata'];
            $vdata['alias'] = vnit_change_title($vdata['catname']);
            
            if($this->db->update('company_cat',$vdata,array('catid'=>$catid))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'company/category/ds/'.$maincat;
                }else{
                   $url = 'company/category/edit/'.$maincat.'/'.$catid;
                }
                redirect($url);
            }
        } 
        $data['message']  = $this->pre_message; 
        $this->load->templates('category/edit',$data);
    }
    
    function delmaincat(){
        $id = segment(4,'int');
        $total = $this->category->get_total_company($id);
        if($total > 0){
            $this->session->set_flashdata('message','Vẫn con doanh nghiệp. Không thể xóa danh mục này');
        }else{
            if($this->db->delete('company_cat',array('catid'=>$id))){
                $this->session->set_flashdata('message','Xóa thành công');
            }else{
                $this->session->set_flashdata('message','Xóa không thành công');
            }
        }
        redirect('company/category/maincat');
    }
    
    function delsubcat(){
        $id = segment(5,'int');
        $catid = segment(4,'int');
        $total = $this->category->get_total_company_sub($id);
        if($total > 0){
            $this->session->set_flashdata('message','Vẫn con doanh nghiệp. Không thể xóa danh mục này');
        }else{
            if($this->db->delete('company_cat',array('catid'=>$id))){
                $this->session->set_flashdata('message','Xóa thành công');
            }else{
                $this->session->set_flashdata('message','Xóa không thành công');
            }
        }
        redirect('company/category/ds/'.$catid);
    }
    
    
    /********************Write Menu********************************/
    
    function cache_cat(){
        $this->load->helper('file');
        $list = $this->category->get_cache_main();
        $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* Date: ".date('d/m/y H:i:s').".\n**/";
        $total = count($list);
        $str .= "\n\$config['total_company'] = $total;\n\n";
        $i = 1; 
        foreach($list as $rs):
        $list1 = $this->category->get_cache_sub($rs->catid); 
            $j = 1;
            $tong_cap1 = count($list1);
            $catid1 = $rs->catid;
            $catname1 = $rs->catname;
            $slug1 = $rs->alias;
            $str .= "\n//**********Begin $i*************"; 
            $str .= "\n\$config['id_$i'] = $catid1;"; 
            $str .= "\n\$config['name_$i'] = '$catname1';"; 
            $str .= "\n\$config['slug_$i'] = '$slug1';";
            $str .= "\n\$config['total_$i'] = $tong_cap1;\n";  
            foreach($list1 as $rs1):
                $cat1_id = $rs1->catid;
                $cat1_name = $rs1->catname;
                $cat1_slug = $rs1->alias;
                $str .= "\n\$config['id_".$i."_".$j."'] = $cat1_id;";
                $str .= "\n\$config['name_".$i."_".$j."'] = '$cat1_name';";
                $str .= "\n\$config['slug_".$i."_".$j."'] = '$cat1_slug';";
                $j++;
            endforeach;
            $str .= "\n//**********END $i*************\n\n"; 
        $i++; 
        endforeach;
        write_file(ROOT.'site/config/config_company.php', $str); 
    }
}