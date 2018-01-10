<?php
class mod extends vnit{
    protected $_templates;
    function __construct() {
        parent::__construct();
        $this->load->model('mod_model','mod');
        $this->pre_message = "";
        $this->load->helper('xml');
    }
    
    function index(){
        redirect('mod/ds');
    }
    
    function ds(){
        $data['title'] = 'Quản lý Module';
        $data['add'] = 'mod/readadd';
        $data['delete'] = true;
        $field = ($this->request->get['f'] != '')?$this->request->get['f']:'id';
        $order = ($this->request->get['o'] != '')?$this->request->get['o']:'desc';
        $config['suffix'] = '/'.$field.'/'.$order;          
        $config['base_url'] = base_url().'mod/ds/';  
        $config['total_rows']   =  $this->mod->get_num_modules();
        $data['num'] = $config['total_rows'];
        $config['per_page']  =   30;
        $config['uri_segment'] = 3; 
        $this->pagination->initialize($config);   
        $data['list'] =   $this->mod->get_all_modules($config['per_page'],segment(4,'int'),$field,$order);
        $data['pagination']    = $this->pagination->create_links();        
        $this->_templates['page'] = 'index';
        $this->load->templates($this->_templates['page'],$data);
    }
    function readadd(){
        $data['title'] = 'Thêm mới Modules';
        $data['save'] = true;
        $data['cancel'] = 'cpmodules/listmodules';
        $handle = opendir(ROOT.'site/mod');
        if(!$handle){
            $this->session->set_flashdata('notice','Đường dẫn tới thư mục Modules không đúng');
        }
        $data['handle'] = $handle;
        // Form validation
        $this->form_validation->set_rules('modules_name','Tên Module','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            redirect('mod/add/?mod='.$this->request->post['modules_name']);
        }
        $data['message'] = $this->pre_message;
        $this->_templates['page'] = 'readmodules';
        $this->load->templates($this->_templates['page'],$data);
    }    
    function add(){
        $data['title'] = 'Thêm mới Modules';
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'mod/ds';
        $modules = $this->request->get['mod'];
        $data['module'] = $modules;
        $data['xml'] = simplexml_load_file(ROOT.'site/mod/'.$modules.'/'.$modules.'.xml'); 
        $data['position'] = simplexml_load_file(ROOT.'site/templates/templates.xml'); 
        $data['css'] = $this->mod->get_css();
        // Form validation
        $this->form_validation->set_rules('mod[title]','Tên module - vi','required');
        $this->form_validation->set_rules('mod[show_title]','Hiển thị tiêu đề','required');
        $this->form_validation->set_rules('mod[published]','Bật Module','required');
        $this->form_validation->set_rules('mod[position]','Vị trí hiển thị','required');
        $this->form_validation->set_rules('mod[params]','','');
        $this->form_validation->set_rules('mod[content]','','');
        $this->form_validation->set_rules('mod_en[content]','','');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $id = post_var('id','int');
            $mod = $this->request->post['mod'];


            $param = $this->request->post['param'];
            $html = '';
            if(is_array($param)){
                foreach($param as $v=>$k){
                    $html .='&'.$v.'='.$k;
                }
                $html .='&test=true';
            }else{
                $html .='test=true';
            }
            $mod['attr'] = trim($html,'&');
         
          
            if($this->db->insert('modules',$mod)){
                $id  = $this->db->insert_id();
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $this->request->post['option'];
                if($option == 'save'){
                    $url = 'mod/ds';
                }else{
                    $url = 'mod/edit/'.$id;
                }
                redirect($url);
            }
        }
        $data['message'] = $this->pre_message;
        $this->_templates['page'] = 'add';
        $this->load->templates($this->_templates['page'],$data);
    }
    
    function edit(){
        $id = $this->uri->segment(3);
        $data['title'] = 'Cập nhật Modules';
        $data['save'] = true;
        $data['apply'] = true;
        $data['cancel'] = 'mod/ds';        
        $data['rs'] = $this->mod->get_mod_by_id($id);
        //$data['list_position'] = $this->vdb->find_by_list('modules_position');
        $data['xml'] = simplexml_load_file(ROOT.'site/mod/'.$data['rs']->module.'/'.$data['rs']->module.'.xml');
        $data['position'] = simplexml_load_file(ROOT.'site/templates/templates.xml');
        $data['css'] = $this->mod->get_css($data['rs']->params);
        // Form validation
        $this->form_validation->set_rules('mod[title]','Tên module','required');
        $this->form_validation->set_rules('mod[show_title]','Hiển thị tiêu đề','required');
        $this->form_validation->set_rules('mod[published]','Bật Module','required');
        $this->form_validation->set_rules('mod[position]','Vị trí hiển thị','required');
        $this->form_validation->set_rules('mod[params]','','');
        $this->form_validation->set_rules('mod[content]','','');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $id = post_var('id','int');
            $mod = $this->request->post['mod'];
            $param = $this->request->post['param'];
            $html = '';
            if(is_array($param)){
                foreach($param as $v=>$k){
                    $html .='&'.$v.'='.$k;
                }
                $html .='&test=true';
            }else{
                $html .='test=true';
            }
             
            $mod['attr'] = trim($html,'&');

            
            if($this->db->update('modules',$mod,array('id'=>$id))){
                $this->session->set_flashdata('message','Lưu thành công');
                $option =  $this->request->post['option'];
                if($option == 'save'){
                   $url = 'mod/ds';
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

    // Xoa nhieu ban ghi
    function dels(){
        if(!empty($_POST['ar_id']))
        {
            $page = $this->request->post['page'];
            $ar_id = $this->request->post['ar_id'];
            for($i = 0; $i < sizeof($ar_id); $i ++) {
                if ($ar_id[$i]){
                    if($this->db->delete('modules', array('id'=>$ar_id[$i]))){
                        $this->session->set_flashdata('message','Đã xóa thành công');
                    }else{
                        $this->session->set_flashdata('error','Xóa không thành công');
                    }
                }
            }
        }
        redirect('mod/ds/'.$page);
    }
    function save_order(){
        $id = $this->request->post['id'];
        for($i = 0 ; $i< sizeof($id);$i++){
            $menu['ordering'] = $this->request->post['order_'.$id[$i]];
            $this->db->update('modules',$menu,array('id'=>$id[$i]));
        }
    }      
}
