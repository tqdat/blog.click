<?php
class business extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('business_model','business');
        $this->pre_message = "";
    }
    
    function ds(){
        $this->cache_bussiness();
        $data['title'] = "Danh sách doanh nghiệp";
        $config['base_url'] = base_url().'/company/business/ds/';
        $config['suffix'] = '';
        $config['total_rows']   =  $this->business->get_num_business();
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   20;
        $config['uri_segment'] = 4; 
        $this->load->library('pagination');
        $this->pagination->initialize($config);   
        $data['list'] =   $this->business->get_all_business($config['per_page'],segment(4,'int'));
        $data['pagination']    = $this->pagination->create_links();
        $this->load->templates('business/ds',$data);
    }
    
    function edit(){
        $data['title'] = "Cập nhật doanh nghiệp";
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'company/business/ds';
        $id = segment(4,'int');
        $data['maincat'] = $this->business->get_maincat();
        $data['rs'] = $this->db->row("SELECT * FROM company WHERE id = $id");
        $data['subcat'] = $this->business->get_subcat($data['rs']->catid1);
        $data['district'] = $this->business->get_all_district();
        $this->form_validation->set_rules('vdata[name]','Tên doanh nghiệp','required');
        $this->form_validation->set_rules('vdata[catid1]','Lĩnh vực hoạt động cấp 1','required');
        $this->form_validation->set_rules('vdata[catid2]','Lĩnh vực hoạt động cấp 2','required');
        $this->form_validation->set_rules('vdata[masothue]','Mã số thuế','required');
        $this->form_validation->set_rules('vdata[email]','Email','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $id = $this->request->post['id'];
            $page = $this->request->post['page'];
            $vdata = $this->request->post['vdata'];
            $vdata['slug'] = vnit_change_title($vdata['name']);
            $vdata['noibat'] = $this->request->post['noibat'];
            if($this->db->update('company',$vdata,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $_POST['option'];
                if($option == 'save'){
                   $url = 'company/business/ds/'.$page;
                }else{
                    $url = uri_string();
                }
                redirect($url);
            }else{
                $this->pre_message = "Cập nhật không thành công";
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('business/edit',$data);
    }
    
    function maincat(){
        $id = get_var('catid','int');
        $html = '<option value="0">Lĩnh vực hoạt động cấp 2</option>';
        $list = $this->business->get_subcat($id);
        foreach($list as $rs):
            $html .='<option value="'.$rs->catid.'">'.$rs->catname.'</option>';
        endforeach;
        $data['ds'] = $html;
        echo json_encode($data);
    }
    
    function del(){
        $id = segment(4,'int');
        $page = $this->uri->segment(5);
        if($this->db->delete('company',array('id'=>$id))){
            $this->session->set_flashdata('message','Xóa thành công');
        }else{
            $this->session->set_flashdata('message','Xóa không thành công');
        }
        redirect('company/business/ds/'.$page);
        
    }
    
    function cache_bussiness(){
        $this->load->helper('file');
        $list = $this->business->get_all_noibat();
        $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* Date: ".date('d/m/y H:i:s').".\n**/";
        $str_ar = '';
        foreach($list as $rs):
            $str_ar .=$rs->id.',';
            $id = $rs->id;
            $name = $rs->name;
            $slug = $rs->slug;
            $logo = $rs->logo;
            $str .= "\n\$config['com_name_$id'] = '$name';";
            $str .= "\n\$config['com_slug_$id'] = '$slug';";
            $str .= "\n\$config['com_logo_$id'] = '$logo';\n";
        endforeach;
        $str_ar = trim($str_ar,',');
        $str .= "\n\$config['ar_com'] = array($str_ar);";
        write_file(ROOT.'site/config/config_com_noibat.php', $str); 
    }
}
