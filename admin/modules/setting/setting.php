<?php
class setting extends vnit{
    function __construct(){
        parent::__construct();
        $this->load->model('setting_model','setting');
    }
    
    function site(){
        $this->load->config('config_site');
        $data['title'] = "Cấu hình Website";
        $data['apply'] = true;
       $this->form_validation->set_rules('vdata[site_name]','Tên website','required');
        $this->form_validation->set_rules('vdata[site_email]','Email hệ thống','required');
		$this->form_validation->set_rules('vdata[site_facebook]','Facebook hệ thống','required');
		$this->form_validation->set_rules('vdata[site_skype]','Skype hệ thống','required');
		$this->form_validation->set_rules('vdata[site_google]','Google hệ thống','required');
        $this->form_validation->set_rules('site_close','Đóng website','required');
        $this->form_validation->set_rules('vdata[site_close_msg]','Nội dung đóng website','required');
        $this->form_validation->set_rules('vdata[site_des]','Miêu tả','required');
        $this->form_validation->set_rules('vdata[site_keyword]','Từ khóa','required');
        if($this->form_validation->run() === FALSE){
            $this->pre_message = validation_errors();
        }else{
            $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* File Config_site \n* Date: ".date('d/m/y H:i:s').".\n**/";
            $vdata = $this->request->post['vdata'];
            $site_name = $vdata['site_name'];
            $site_email = $vdata['site_email'];
			$site_facebook = $vdata['site_facebook'];
			$site_skype = $vdata['site_skype'];
			$site_google = $vdata['site_google'];
            $site_close = $this->request->post['site_close'];
            $site_message_close = $vdata['site_close_msg'];
            $site_des = $vdata['site_des'];
            $site_keyword = $vdata['site_keyword'];
            
            $str .= "\n\$config['site_name'] = '$site_name';";  
            $str .= "\n\$config['site_email'] = '$site_email';";  
			$str .= "\n\$config['site_facebook'] = '$site_facebook';";
			$str .= "\n\$config['site_skype'] = '$site_skype';";
			$str .= "\n\$config['site_google'] = '$site_google';";
            $str .= "\n\$config['site_close'] = $site_close;";  
            $str .= "\n\$config['site_close_msg'] = '$site_message_close';";  
            $str .= "\n\$config['site_des'] = '$site_des';";  
            $str .= "\n\$config['site_keyword'] = '$site_keyword';"; 

            $str .= "\n\n/* End of file config_site*/";
            $this->load->helper('file');
            if(write_file(APPPATH.'config/config_site.php', $str)){
                $this->session->set_flashdata('message','Lưu thành công');
                redirect('setting/site') ;     
            }else{
                $this->pre_message =" Lưu không thành công";
            }
        }
        $data['message'] = $this->pre_message;
        $this->load->templates('site',$data);
    }
    
    function home(){
        $this->load->config('config_city_home');
        $data['title'] = "Cấu hình trang chủ";
        
    }
    
    function seo(){
        $this->load->config('config_seo');
        $data['title'] = "Seo Code";
        $data['save'] = true;
        $data['cf_yahoo'] = $this->config->item('cf_yahoo');
        $data['cf_alexa'] = $this->config->item('cf_alexa');
        $data['cf_google_webmaster'] = $this->config->item('cf_google_webmaster');
        $data['cf_google_analytics'] = $this->config->item('cf_google_analytics');
        $this->form_validation->set_rules('seocode','seocode','required');
        $this->form_validation->set_rules('cf_yahoo','Tên website','');
        $this->form_validation->set_rules('cf_alexa','Đóng website','');
        $this->form_validation->set_rules('cf_google_webmaster','Thông báo đóng website','');
        $this->form_validation->set_rules('cf_google_analytics','Miêu tả','');
        if($this->form_validation->run() == FALSE){
            $this->pre_message = validation_errors();
        }else{
            $str = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n/**\n* File config_seo \n* Date: ".date('d/m/y H:i:s').".\n**/";
            $cf_yahoo = $this->request->post['cf_yahoo'];
            $cf_alexa = $this->request->post['cf_alexa'];
            $cf_google_webmaster = $this->request->post['cf_google_webmaster'];
            $cf_google_analytics = $this->request->post['cf_google_analytics'];
            $str .= "\n\$config['cf_yahoo'] = '$cf_yahoo';";  
            $str .= "\n\$config['cf_alexa'] = '$cf_alexa';";  
            $str .= "\n\$config['cf_google_webmaster'] = '$cf_google_webmaster';";  
            $str .= "\n\$config['cf_google_analytics'] = '$cf_google_analytics';";  
            
            $str .= "\n\n/* End of file config_seo*/";   
            $this->load->helper('file');
            write_file(APPPATH.'config/config_seo.php', $str);    
            $this->session->set_flashdata('message','Lưu thành công');
            redirect('setting/seo') ;     
        }
        $data['message'] = $this->pre_message;
        $this->_templates['page'] = 'seo';
        $this->load->templates($this->_templates['page'],$data);
    }
}
