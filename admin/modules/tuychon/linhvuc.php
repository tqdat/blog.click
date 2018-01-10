<?php
class linhvuc extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('linhvuc_model','linhvuc');
        $this->write_linhvuc();
    }
    
    function dslv(){
        $data['title'] = "Danh sách lĩnh vực";
        $data['add'] = 'tuychon/linhvuc/ladd';
        $config['base_url'] = base_url().'tuychon/linhvuc/dslv/';
        $config['total_rows']   =  $this->linhvuc->get_num_loailinhvuc();
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   50; 
        $config['uri_segment'] = 4; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->linhvuc->get_all_loailinhvuc($config['per_page'],segment(4,'int'));
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('linhvuc/ds',$data);
    }
    
    function ledit(){
        $llv_id = segment(4,'int');
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tuychon/linhvuc/dslv';
        $data['rs'] = $this->linhvuc->get_llv_vi($llv_id);
        $data['en'] = $this->linhvuc->get_llv_en($llv_id);
        $data['title'] = "Cập nhật loại lĩnh vực";
        $this->form_validation->set_rules('vi_name','Loại lĩnh vực (vi)','required');
        $this->form_validation->set_rules('en_name','Loại lĩnh vực (en)','required');
        $this->form_validation->set_rules('order','Sắp xếp','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $order = $this->request->post['order'];
            $vi_name = $this->request->post['vi_name'];
            $en_name = $this->request->post['en_name'];
            $vdata['llv_order'] = $order;
            if($this->db->update('dl_loai_linhvuc',$vdata,array('llv_id'=>$llv_id))){
                 $vdata_vi['name'] = $vi_name;
                 $this->db->update('dl_loai_linhvuc_des',$vdata_vi,array('loai_linhvuc_id'=>$llv_id,'lang_id'=>1));
                 $vdata_en['name'] = $en_name;
                 $this->db->update('dl_loai_linhvuc_des',$vdata_en,array('loai_linhvuc_id'=>$llv_id,'lang_id'=>2));
                 $this->session->set_flashdata('message',"Lưu thành công");
                 redirect('tuychon/linhvuc/dslv');
            }
        }
        $data['message']= $this->pre_message;
        $this->load->templates('linhvuc/ledit',$data);
    }
    
    
    function ladd(){
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'tuychon/linhvuc/dslv';
        $data['rs'] = $this->linhvuc->get_llv_vi($llv_id);
        $data['en'] = $this->linhvuc->get_llv_en($llv_id);
        $data['title'] = "Thêm loại lĩnh vực";
        $this->form_validation->set_rules('vi_name','Loại lĩnh vực (vi)','required');
        $this->form_validation->set_rules('en_name','Loại lĩnh vực (en)','required');
        $this->form_validation->set_rules('order','Sắp xếp','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $order = $this->request->post['order'];
            $vi_name = $this->request->post['vi_name'];
            $en_name = $this->request->post['en_name'];
            $vdata['llv_order'] = $order;
            if($this->db->insert('dl_loai_linhvuc',$vdata)){
                $llv_id = $this->db->insert_id();
                 $vdata_vi['name'] = $vi_name;
                 $vdata_vi['loai_linhvuc_id'] = $llv_id;
                 $vdata_vi['lang_id'] = 1;
                 $this->db->insert('dl_loai_linhvuc_des',$vdata_vi);
                 $vdata_en['name'] = $en_name;
                 $vdata_en['loai_linhvuc_id'] = $llv_id;
                 $vdata_en['lang_id'] = 2;
                 $this->db->insert('dl_loai_linhvuc_des',$vdata_en);
                 $this->session->set_flashdata('message',"Lưu thành công");
                 redirect('tuychon/linhvuc/dslv');
            }
        }
        $data['message']= $this->pre_message;
        $this->load->templates('linhvuc/ladd',$data);
    }
    
    function ldel(){
        $llv_id= segment(4);
        if($this->db->delete('dl_loai_linhvuc',array('llv_id'=>$llv_id))){
            $this->db->delete('dl_loai_linhvuc_des',array('loai_linhvuc_id'=>$llv_id));
            $msg = "Xóa thành công";
        }else{
            $msg = "Xóa không thành công";
        }
         $this->session->set_flashdata('message',$msg);
         redirect('tuychon/linhvuc/dslv');
    }
    
    function write_linhvuc(){
        $this->load->helper('file');
        $list = $this->linhvuc->get_list_loailinhvuc(1);
        $list1 = $this->linhvuc->get_list_loailinhvuc(2);
        $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* Date: ".date('d/m/y H:i:s').".\n**/";
        $ar_id_vi = "";
        foreach($list as $rs):
            $llv_id = $rs->llv_id;
            $name = $rs->name;
            $ar_id_vi .= "array('id'=>'$llv_id','name'=>'$name'),\n";
           
            
        endforeach;
        $ar_id_vi  = rtrim($ar_id_vi,',');
        
        $ar_id_en = "";
        foreach($list1 as $rs):
            $llv_id = $rs->llv_id;
            $name = $rs->name;
            $ar_id_en .= "array('id'=>'$llv_id','name'=>'$name'),\n";
           
            
        endforeach;
        $ar_id_en  = rtrim($ar_id_en,',');
        
        $str .= "\n\$config['ar_lv_vi'] = array($ar_id_vi);"; 
        $str .= "\n\$config['ar_lv_en'] = array($ar_id_en);"; 
        write_file(ROOT.'site/config/cache/config_lv.php', $str);
    }
}
